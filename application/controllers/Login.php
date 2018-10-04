<?php
class Login extends CI_Controller {

  public function __construct(){
      parent::__construct();
      $this->load->model('usuario_model', 'usuario', TRUE);
      $this->load->library('form_validation');
      $this->load->helper('security');
  }
  public function index($request_uri=""){
      is_logged_in_login();//comprobar si ya se esta logeado en este controlador
      $data['title'] = 'Login - ESMN';
      $data['token'] = $this->token();
      $data['css'] = array('css/login.css');
      $data['request_uri'] = $request_uri;
      // $this->load->view('templates/header',$data);
      $this->load->view('usuario/login',$data);
      // $this->load->view('templates/footer');
  }

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

    public function token(){
      $token = md5(uniqid(rand(),true));
      $this->session->set_userdata('token',$token);
      return $token;
    }

    public function logout(){
       $this->session->sess_destroy();
       session_write_close();
       redirect(base_url('login/index'));
    }

}
