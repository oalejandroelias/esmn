<?php
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

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

  function __construct()
  {
    parent::__construct();
    include_once APPPATH . "libraries/vendor/autoload.php";
    $this->load->model('Mensaje_model');
    $this->load->model('Usuario_model');
    $this->load->model('Persona_model');

    $this->version = new Version2X(URL.':8080',$this::CONTEXT);
    $this->client = new Client($this->version);
  }

  public function index()
  {
    $id_usuario_actual = $this->session->userdata('usuario_id');
    $data['title'] = 'Test';
    $data['page_title'] = 'Test';

    $this->load->view('templates/header',$data);
    $this->load->view('test',$data);
    $this->load->view('templates/footer');
  }

  public function get_chat_contact(){
    if($this->input->is_ajax_request()){
      $id_usuario_actual = $this->session->userdata('usuario_id');
      $chat_contact = $this->Mensaje_model->get_chat_contact($id_usuario_actual);
      echo json_encode($chat_contact);
    }
  }

  public function get_message(){
    if($this->input->is_ajax_request()){
      $id_usuario = $this->input->post('idUsuario');
      $id_usuario_actual = $this->session->userdata('usuario_id');
      $id_chat = $this->generate_id_chat($id_usuario,$id_usuario_actual);
      $messages = $this->Mensaje_model->get_mensajes_chat($id_chat);
      echo json_encode($messages);
    }
  }

  public function generate_id_chat($id_usuario,$id_usuario_actual){
    if ($id_usuario_actual < $id_usuario) {
      $id_chat = $id_usuario_actual."_".$id_usuario;
    }else {
      $id_chat = $id_usuario."_".$id_usuario_actual;
    }
    return $id_chat;
  }

  public function send_message(){
    if($this->input->is_ajax_request()){
      $id_usuario = $this->input->post('idUsuario');
      $id_usuario_actual = $this->session->userdata('usuario_id');
      $remitente = $this->Usuario_model->get_usuario($id_usuario_actual);
      $receptor = $this->Usuario_model->get_usuario($id_usuario);

      if (!empty($receptor) && $id_usuario != $id_usuario_actual) {
        $id_chat = $this->generate_id_chat($id_usuario,$id_usuario_actual);
        $params = array(
          'id_chat' => $id_chat,
          'id_usuario_remitente' => $id_usuario_actual,
          'id_usuario_destino' => $id_usuario,
          'texto' => html_escape($this->input->post('msg'))
        );
        $result = $this->Mensaje_model->send($params);

        if ($result > 0) {
          // enviar mensaje al socket node
          $socketReceptor = ($receptor['online'] == 1) ? $receptor['id_socket'] : '';

          $this->client->initialize();
          $this->client->emit("message",
          ['msg' => html_escape($this->input->post('msg')),
          'class' => 'success',
          'to' => $this->input->post('idUsuario'),
          'toSocket' => $socketReceptor,
          'from' => $id_usuario_actual,
          'fromNombre' => $remitente['nombre'],
          'fromApellido' => $remitente['apellido'],
          'fromFoto' => $remitente['foto'],
          'fromSocket' => $this->input->post('idSocket')
          ]);
          $this->client->close();
          echo 'success';
        }else {
          echo 'error';
        }
      }
      else {
        echo 'error: id';
      }
    }
  }

  public function chat(){
    $this->load->view('chat',$data);
  }

}
