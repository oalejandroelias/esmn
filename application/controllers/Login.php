<?php
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

class Login extends CI_Controller {

  const CONTEXT = [
    'context' => [
      'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false
      ]
    ]
  ];

  private $version;
  private $client;

  public function __construct(){
    parent::__construct();
    include_once APPPATH . "libraries/vendor/autoload.php";
    $this->config->load('google'); //config de parametros de google
    $this->load->model('usuario_model', 'usuario', TRUE);
    $this->load->helper('security');

    $this->version = new Version2X(URL.':8080',$this::CONTEXT);
    $this->client = new Client($this->version);
  }
  public function index($request_uri="",$auto_logout = false){
    is_logged_in_login();//comprobar si ya se esta logeado en este controlador

    // Login con API de google
    include_once APPPATH . "libraries/google-api-php-client/vendor/autoload.php";
    $google_config = $this->config->item('google');
    // Create Client Request to access Google API
    $client = new Google_Client();
    $client->setApplicationName($google_config['application_name']);
    $client->setClientId($google_config['client_id']);
    $client->setClientSecret($google_config['client_secret']);
    $client->setRedirectUri($google_config['redirect_uri']);
    $client->setDeveloperKey($google_config['api_key']);
    $client->addScope($google_config['scopes']['userinfo.mail']);

    // comprobar estado de sesion de google
    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      $client->setAccessToken($_SESSION['access_token']);
      redirect(base_url('inicio'));
    }

    $authUrl = $client->createAuthUrl(); //crea la url hacia el form de inicio de sesion de google
    $data['authUrl'] = $authUrl;

    $data['title'] = 'Login - ESMN';
    $data['token'] = $this->token(); //token para form de usuario registrado
    $this->session->set_userdata('ci_token',$data['token']);
    $data['css'] = array('login.css');
    $data['request_uri'] = $request_uri;
    $data['auto_logout'] = $auto_logout;
    $this->load->view('usuario/login',$data);
  }

  // login con google. Este es el metodo al que apunta la api de google
  public function oauth2callback(){
    include_once APPPATH . "libraries/google-api-php-client/vendor/autoload.php";
    $google_config = $this->config->item('google');
    // Create Client Request to access Google API
    $client = new Google_Client();
    $client->setApplicationName($google_config['application_name']);
    $client->setClientId($google_config['client_id']);
    $client->setClientSecret($google_config['client_secret']);
    $client->setRedirectUri($google_config['redirect_uri']);
    $client->setDeveloperKey($google_config['api_key']);
    $client->addScope($google_config['scopes']['userinfo.mail']);

    // obtener datos de google
    $objOAuthService = new Google_Service_Oauth2($client);

    if (isset($_GET['code'])) { //si se obtuvo el codigo de acceso, se cargan los datos de sesion
      $client->authenticate($_GET['code']);
      $userData = $objOAuthService->userinfo->get();

      $this->load->model('perfil_model', 'perfil', TRUE);
      $perfil = $this->perfil->get_perfil(4); //4 = invitado

      $dataSession = array(
        'is_logued_in' => TRUE,
        'access_token' => $client->getAccessToken(),
        'usuario_id' => $userData->id,
        'nombre' => $userData->givenName,
        'apellido' => $userData->familyName,
        'email' => $userData->email,
        'id_perfil' => $perfil['id'], //invitado
        'nombre_perfil' => $perfil['nombre'],
        'permisos' => $perfil['permisos']
      );
      $this->session->set_userdata($dataSession);
    }

    // se renueva el token aunque se este logueado
    if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      $client->setAccessToken($_SESSION['access_token']);
    }
    redirect(base_url());
  }

  // login para usuarios registrados. Carga datos del usuario en variable de sesion en caso de exito y redirige.
  public function login(){
    if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('ci_token')){
      $this->form_validation->set_rules('username', 'Usuario', 'required|trim|max_length[128]');
      $this->form_validation->set_rules('password', 'Contraseña', 'required|trim|max_length[128]');
      $request_uri = $this->input->post('request_uri',TRUE);

      if($this->form_validation->run() == FALSE){
        $this->index($request_uri);
      }else{
        $username = html_escape($this->input->post('username',TRUE)); //TRUE habilita el filtro xss
        // hash sha512 usuario+password (evita hash identicos para passwords iguales)
        $password = hash('sha512',$username.html_escape($this->input->post('password',TRUE)));

        $check_user = $this->usuario->login($username,$password); //buscar usuario en la base
        if($check_user){
          if ($check_user->activo==0) { //si el usuario esta deshabilitado no puede loguearse
            $this->session->set_flashdata('usuario_incorrecto','El usuario esta deshabilitado por el administrador.');
            redirect(base_url().'login','refresh');
          }
          $data = array( //cargar variables de session
            'is_logued_in' => TRUE,
            'usuario_id' => $check_user->usuario_id,
            'username' => $check_user->username,
            'persona_id' => $check_user->persona_id,
            'nombre' => $check_user->nombre,
            'apellido' => $check_user->apellido,
            'tipo_documento' => $check_user->tipo_documento,
            'numero_documento' => $check_user->numero_documento,
            'email' => $check_user->email,
            'id_perfil' => $check_user->id_perfil,
            'nombre_perfil' => $check_user->nombre_perfil,
            'permisos' => $check_user->permisos,
          );
          $this->session->set_userdata($data);

          // actualizar estado 'online' y 'ci_token':
          $params = array('online'=>1,'ci_token'=>$this->session->userdata('ci_token'));
          $result = $this->usuario->update_usuario($check_user->usuario_id, $params);

          $this->client->initialize();
          $session_token = $this->token();
          $this->client->emit("token", [
            'id_usuario' => $check_user->usuario_id,
            'token' => $session_token
          ]
        );
          $this->client->close();

          $this->session->set_flashdata('sessionStorage', $session_token);

          if ($request_uri!="") { // redirige al usuario a la pagina en la que estaba (si la sesion se cerro por inactividad)
            $request_uri = str_replace('-','/',$request_uri);
            redirect($request_uri);
          }else {
            redirect(base_url('inicio'));
          }
        }else {
          // datos incorrectos
          $this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
          redirect(base_url().'login','refresh');
        }
      }
    }else{
      redirect(base_url('login'));
    }
  }

  // token para el formulario. Esto evita que usuarios no autorizados intenten loguearse a traves de otro dominio.
  public function token(){
    $token = md5(uniqid(rand(),true));
    // $this->session->set_userdata('token',$token);
    return $token;
  }

  // destruir sesion
  public function logout($request_uri = ''){
    $this->client->initialize();
    $this->client->emit("untoken", ['id_usuario' => $this->session->userdata('usuario_id')]);
    $this->client->close();

    $this->session->sess_destroy();
    session_write_close();
    redirect('login/index/'.$request_uri);
  }

}
