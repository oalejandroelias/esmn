<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Perfil extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    is_logged_in();
    validar_acceso();
    $this->load->model('Perfil_model');
  }

  /*
  * Listing of perfiles
  */
  function index()
  {
    $data['title']='Perfiles - CeciliaESMN';
    $data['page_title']='<span class="m-r-10 mdi mdi-account-convert"> Perfiles</span>';
    $data['perfiles'] = $this->Perfil_model->get_all_perfiles();

    //Botones de acciones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');

    //$data['_view'] = 'perfil/index';
    $this->load->view('templates/header',$data);
    $this->load->view('perfil/index',$data);
    $this->load->view('templates/footer',$data);
  }

  /*
  * Adding a new perfil
  */
  function add()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');

    if($this->form_validation->run())
    {
      $params = array(
        'nombre' => $this->input->post('nombre'),
        'permisos' => $this->input->post('permisos'),
      );

      $perfil_id = $this->Perfil_model->add_perfil($params);
      redirect('Perfil/index');
    }
    else
    {
      $data['title'] = 'Agregar perfil - CeciliaESMN';
      $data['page_title'] = 'Agregar perfil';

      $this->load->view('templates/header',$data);
      $this->load->view('perfil/add',$data);
      $this->load->view('templates/footer',$data);
    }
  }

  /*
  * Editing a perfil
  */
  function edit($id)
  {
    //validar_acceso();
    // check if the perfil exists before trying to edit it
    $data['perfil'] = $this->Perfil_model->get_perfil($id);

    if(isset($data['perfil']['id']))
    {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');

      if($this->form_validation->run())
      {
        $params = array(
          'nombre' => $this->input->post('nombre'),
          'permisos' => $this->input->post('permisos'),
        );

        $this->Perfil_model->update_perfil($id,$params);
        $this->session->set_flashdata('editar', 'Se guardaron los cambios');
        redirect('Perfil/index');
      }
      else
      {
        $data['title'] = 'Editar perfil - CeciliaESMN';
        $data['page_title'] = 'Editar perfil';

        $this->load->view('templates/header',$data);
        $this->load->view('perfil/edit',$data);
        $this->load->view('templates/footer',$data);
      }
    }
    else
    show_error('The perfil you are trying to edit does not exist.');
  }

  /*
  * Deleting perfil
  */
  function remove($id)
  {
    //validar_acceso();
    //$id = $this->input->get('id');
    $perfil = $this->Perfil_model->get_perfil($id);

    // check if the perfil exists before trying to delete it
    if(isset($perfil['id']))
    {
      $this->Perfil_model->delete_perfil($id);
      $this->session->set_flashdata('eliminar', 'Perfil eliminado');
      redirect('Perfil/index');
    }
    else
    show_error('The perfil you are trying to delete does not exist.');
  }

  // editar permisos del rol $id
  public function edit_permission($id){

    //validar_acceso();
    $data['perfil'] = $this->Perfil_model->get_perfil($id);

    if(isset($data['perfil']['id'])){
      // permisos del rol en array()
      $permisos_rol = json_decode($data['perfil']['permisos'],true);

      // se crea un arreglo asociativo con todos los controladores y sus respectivos metodos
      $this->load->helper('file');
      // obtener nombres de controladores (clases)
      $controllers = get_filenames( APPPATH . 'controllers/' );
      foreach( $controllers as $k => $v ){
        if( strpos( $v, '.php' ) === FALSE) {
          unset( $controllers[$k] );
        }
      }

      foreach( $controllers as $controller ){
        include_once APPPATH . 'controllers/' . $controller;
        // obtener nombres de metodos y construir un arreglo asociativo
        $methods = get_class_methods( str_replace( '.php', '', $controller ) );

        foreach( $methods as $method ){
          if ($method!='__construct' && $method!='get_instance') {
            $class = str_replace('.php', '', $controller); //nombre de la clase

            $key='0';
            // machea clase y metodo con los permisos del rol,
            // si existe y el valor de la clave es igual a 1, corresponde un checked
            if (isset($permisos_rol[$class]) && array_key_exists($method,$permisos_rol[$class])) {
              $key = $permisos_rol[$class][$method];
            }
            $checked = ($key=='1' ? 'checked' : '');
            $permisos[$class][$method] = $checked;
          }
        }
      }

      // si $_POST no esta vacio, se actualizan los permisos del rol
      if (!empty($_POST) && isset($_POST['permisos'])) {
        $params = array(
          'permisos' => json_encode($this->input->post('permisos')),
        );
        // guardar permisos en formato json
        $this->Perfil_model->update_perfil($id,$params);

        // recargar permisos del usuario actual
        if ($this->session->userdata('id_perfil')==$id) {
          $this->session->unset_userdata('permisos');
          $this->session->set_userdata($params);
        }

        redirect('perfil/index');

      }else {
        $data['permisos'] = $permisos;
        $data['title'] = 'Editar permisos - CeciliaESMN';
        $data['page_title'] = "Editar permisos de ".$data['perfil']['nombre'];

        $data['js'] = array('edit_permission.js');

        $this->load->view('templates/header',$data);
        $this->load->view('perfil/edit_permission',$data);
        $this->load->view('templates/footer',$data);
      }

    }
    else
    show_error('The perfil you are trying to edit does not exist.');

  }

}
