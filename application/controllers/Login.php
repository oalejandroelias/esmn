<?php
class Login extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->config->load('google'); //config de parametros de google
    $this->load->model('usuario_model', 'usuario', TRUE);
    $this->load->helper('security');
  }
  public function index($request_uri=""){
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
    $data['css'] = array('css/login.css');
    $data['request_uri'] = $request_uri;
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
      $dataSession = array(
        'is_logued_in' => TRUE,
        'access_token' => $client->getAccessToken(),
        'usuario_id' => $userData->id,
        'nombre' => $userData->givenName,
        'apellido' => $userData->familyName,
        'email' => $userData->email,
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
    if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')){
      $this->form_validation->set_rules('username', 'Usuario', 'required|trim|max_length[128]');
      $this->form_validation->set_rules('password', 'Contraseña', 'required|trim|max_length[128]');
      $request_uri = $this->input->post('request_uri',TRUE);

      if($this->form_validation->run() == FALSE){
        $this->index($request_uri);
      }else{
        $username = html_escape($this->input->post('username',TRUE)); //TRUE habilita el filtro xss
        $password = hash('sha512',$username.html_escape($this->input->post('password',TRUE)));
        $check_user = $this->usuario->login($username,$password);
        if($check_user == TRUE){
          $data = array(
            'is_logued_in' => TRUE,
            'usuario_id' => $check_user->usuario_id,
            'username' => $check_user->username,
            'persona_id' => $check_user->persona_id,
            'nombre' => $check_user->nombre,
            'apellido' => $check_user->apellido,
            'tipo_documento' => $check_user->tipo_documento,
            'numero_documento' => $check_user->numero_documento,
            'id_perfil' => $check_user->id_perfil,
            'email' => $check_user->email,
            'permisos' => $check_user->permisos,
          );
          $this->session->set_userdata($data);
          if ($request_uri!="") {
            $request_uri = str_replace('-','/',$request_uri);
            redirect($request_uri);
          }else {
            redirect(base_url('inicio'));
          }
        }
      }
    }else{
      redirect(base_url('login'));
    }
  }

// token para el formulario. Esto evita que usuarios no autorizados intenten loguearse a traves de otro dominio.
  public function token(){
    $token = md5(uniqid(rand(),true));
    $this->session->set_userdata('token',$token);
    return $token;
  }

// destruir sesion
  public function logout(){
    $this->session->sess_destroy();
    session_write_close();
    redirect(base_url('login/index'));
  }

}
