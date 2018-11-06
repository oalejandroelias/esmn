<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Perfil_usuario extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    is_logged_in();
    validar_acceso();
    $this->load->model('Perfil_usuario_model');
    $this->load->model('Usuario_model');
    $this->load->model('Persona_model');
  }
  /*
  * Listing of perfil_usuario
  */
  function index($id_usuario)
  {
    $data['usuario']=$this->Usuario_model->get_usuario($id_usuario);

    if (isset($data['usuario']['usuario_id'])) {
      $page_title = ($this->session->userdata('usuario_id')==$id_usuario) ? "Mi perfil -> " : "Perfil de ";

      $data['title']='Perfil - CeciliaESMN';
      $data['page_title']=$page_title.$data['usuario']['nombre'].' '.$data['usuario']['apellido'];

      $data['persona'] = $this->Persona_model->get_persona($data['usuario']['persona_id']);

      $this->load->view('templates/header',$data);
      $this->load->view('perfil_usuario/index',$data);
      $this->load->view('templates/footer');
    }else {
      show_error("El perfil al que esta intentando acceder no existe!");
    }

  }

  /*
  * Adding a new perfil_usuario
  */
  function add()
  {
    if(isset($_POST) && count($_POST) > 0)
    {
      $params = array(
        'permisos' => $this->input->post('permisos'),
      );

      $perfil_usuario_id = $this->Perfil_usuario_model->add_perfil_usuario($params);
      redirect('perfil_usuario/index');
    }
    else
    {
      $data['_view'] = 'perfil_usuario/add';
      $this->load->view('layouts/main',$data);
    }
  }

  /*
  * Editing a perfil_usuario
  */
  function edit($id_usuario)
  {
    // check if the perfil_usuario exists before trying to edit it
    $data['perfil_usuario'] = $this->Perfil_usuario_model->get_perfil_usuario($id_usuario);

    if(isset($data['perfil_usuario']['id_usuario']))
    {
      if(isset($_POST) && count($_POST) > 0)
      {
        $params = array(
          'permisos' => $this->input->post('permisos'),
        );

        $this->Perfil_usuario_model->update_perfil_usuario($id_usuario,$params);
        redirect('perfil_usuario/index');
      }
      else
      {
        $data['_view'] = 'perfil_usuario/edit';
        $this->load->view('layouts/main',$data);
      }
    }
    else
    show_error('The perfil_usuario you are trying to edit does not exist.');
  }

  /*
  * Deleting perfil_usuario
  */
  function remove($id_usuario)
  {
    $perfil_usuario = $this->Perfil_usuario_model->get_perfil_usuario($id_usuario);

    // check if the perfil_usuario exists before trying to delete it
    if(isset($perfil_usuario['id_usuario']))
    {
      $this->Perfil_usuario_model->delete_perfil_usuario($id_usuario);
      redirect('perfil_usuario/index');
    }
    else
    show_error('The perfil_usuario you are trying to delete does not exist.');
  }

  //     // editar permisos del rol $id
  //     public function edit_permission($id_usuario,$id_perfil)
  //     {
  //       //validar_acceso();
  //       $data['perfil_usuario'] = $this->Perfil_usuario_model->get_perfil_usuario($id_usuario,$id_perfil);

  //       if(isset($data['perfil_usuario']['id_usuario']) && isset($data['perfil_usuario']['id_perfil'])){
  //         // permisos del rol en array()
  //         $permisos_rol = json_decode($data['perfil_usuario']['permisos'],true);

  //         // se crea un arreglo asociativo con todos los controladores y sus respectivos metodos
  //         $this->load->helper('file');
  //         // obtener nombres de controladores (clases)
  //         $controllers = get_filenames( APPPATH . 'controllers/' );
  //         foreach( $controllers as $k => $v ){
  //           if( strpos( $v, '.php' ) === FALSE) {
  //             unset( $controllers[$k] );
  //           }
  //         }

  //         foreach( $controllers as $controller ){
  //           include_once APPPATH . 'controllers/' . $controller;
  //           // obtener nombres de metodos y construir un arreglo asociativo
  //           $methods = get_class_methods( str_replace( '.php', '', $controller ) );

  //           foreach( $methods as $method ){
  //             if ($method!='__construct' && $method!='get_instance') {
  //               $class = str_replace('.php', '', $controller); //nombre de la clase

  //               $key='0';
  //               // machea clase y metodo con los permisos del rol,
  //               // si existe y el valor de la clave es igual a 1, corresponde un checked
  //               if (isset($permisos_rol[$class]) && array_key_exists($method,$permisos_rol[$class])) {
  //                 $key = $permisos_rol[$class][$method];
  //               }
  //               $checked = ($key=='1' ? 'checked' : '');
  //               $permisos[$class][$method] = $checked;
  //             }
  //           }
  //         }

  //         // si $_POST no esta vacio, se actualizan los permisos del rol
  //         if (!empty($_POST) && isset($_POST['permisos'])) {
  //           $params = array(
  //             'permisos' => json_encode($this->input->post('permisos')),
  //           );
  //           // guardar permisos en formato json
  //           $this->Perfil_usuario_model->update_perfil_usuario($id_usuario,$id_perfil,$params);
  //           redirect('usuario/index');

  //         }else {
  //           $data['permisos'] = $permisos;
  //           $data['title'] = 'Editar permisos - CeciliaESMN';
  //           $data['page_title'] = "Editar permisos de usuario";

  //           $this->load->view('templates/header',$data);
  //           $this->load->view('perfil_usuario/edit_permission',$data);
  //           $this->load->view('templates/footer',$data);
  //         }

  //       }
  //       else
  //       show_error('The perfil you are trying to edit does not exist.');

  //     }

}
