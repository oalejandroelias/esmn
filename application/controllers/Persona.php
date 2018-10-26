<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Persona extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    validar_acceso();
    is_logged_in();
    $this->load->model('Persona_model');
    $this->load->model('Usuario_model');
    $this->load->model('Tipo_documento_model');
    $this->load->model('Ciudad_model');
    $this->load->model('Perfil_model');
    $this->load->model('Perfil_usuario_model');
  }

  /*
  * Listing of personas
  */
  function index()
  {
    $data['title']='Personas - CeciliaESMN';
    $data['page_title']='Personas';

    $params['limit'] = RECORDS_PER_PAGE;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('persona/index?');
    $config['total_rows'] = $this->Persona_model->get_all_personas_count();
    $this->pagination->initialize($config);

    $data['personas'] = $this->Persona_model->get_all_personas($params);
    $data['all_tipo_documento'] = $this->Tipo_documento_model->get_all_tipo_documento();
    $data['all_ciudades'] = $this->Ciudad_model->get_all_ciudades();

    //Botones de acciones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');

    $this->load->view('templates/header',$data);
    $this->load->view('persona/index',$data);
    $this->load->view('templates/footer',$data);
  }

  /*
  * Adding a new persona
  */

  function add()
  {
    $this->form_validation->set_rules('id_tipo_documento','Id Tipo Documento','required|integer');
    $this->form_validation->set_rules('numero_documento','Numero Documento','required|max_length[11]|integer');
    $this->form_validation->set_rules('nombre','Nombre','required|max_length[128]');
    $this->form_validation->set_rules('apellido','Apellido','required|max_length[128]');
    $this->form_validation->set_rules('domicilio','Domicilio','max_length[128]');
    $this->form_validation->set_rules('id_ciudad','Id Ciudad','integer');
    $this->form_validation->set_rules('telefono','Telefono','max_length[128]');
    $this->form_validation->set_rules('email','Email','max_length[128]|valid_email');

    if($this->form_validation->run())
    {

      $params = array(
        'id_tipo_documento' => $this->input->post('id_tipo_documento'),
        'id_ciudad' => $this->input->post('id_ciudad'),
        'numero_documento' => $this->input->post('numero_documento'),
        'nombre' => $this->input->post('nombre'),
        'apellido' => $this->input->post('apellido'),
        'domicilio' => $this->input->post('domicilio'),
        'telefono' => $this->input->post('telefono'),
        'email' => $this->input->post('email'),
        'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
      );
      if ($params['id_ciudad']=='') {$params['id_ciudad']=NULL;}

      $persona_id = $this->Persona_model->add_persona($params);

      //Creo el usuario
      if(isset($_POST['generar_usuario']))
      {
        $username= strtolower(substr($this->input->post('nombre'),0,1).$this->input->post('apellido'));

        $password = hash('sha512',$username.html_escape($this->input->post('numero_documento',TRUE)));
        $params_usuario= array(
          'id_persona' => $persona_id,
          'username' => $username,
          'password' => $password,
        );
// controlar username inexistente
        $usuario_id = $this->Usuario_model->add_usuario($params_usuario);

        $id_perfil = $this->input->post('id_perfil');
        $permisos = $this->Perfil_model->get_perfil($id_perfil)['permisos'];
        $params_perfil_usuario=array(
          'id_usuario' => $usuario_id,
          'id_perfil' => $this->input->post('id_perfil'),
        );

        $this->Perfil_usuario_model->add_perfil_usuario($params_perfil_usuario);
      }


      redirect('persona/index');
    }
    else
    {
      $data['title']='Agregar Persona - CeciliaESMN';
      $data['page_title']='Agregar Persona';

      $data['all_tipo_documento'] = $this->Tipo_documento_model->get_all_tipo_documento();
      $data['all_ciudades'] = $this->Ciudad_model->get_all_ciudades();
      $data['all_roles'] = $this->Perfil_model->get_all_perfiles();

      $data['js'] = array(
        '../bootstrap-birthday/bootstrap-birthday.min.js',
        'persona.js'
      );

      $this->load->view('templates/header',$data);
      $this->load->view('persona/add',$data);
      $this->load->view('templates/footer',$data);
    }
  }

  /*
  * Editing a persona
  */
  function edit($id)
  {
    $data['title']='Editar Persona - CeciliaESMN';
    $data['page_title']='Editar Persona';
    // check if the persona exists before trying to edit it
    $data['persona'] = $this->Persona_model->get_persona($id);

    if(isset($data['persona']['id']))
    {

      $this->form_validation->set_rules('id_tipo_documento','Id Tipo Documento','required|integer');
      $this->form_validation->set_rules('numero_documento','Numero Documento','required|max_length[11]|integer');
      $this->form_validation->set_rules('nombre','Nombre','required|max_length[128]');
      $this->form_validation->set_rules('apellido','Apellido','required|max_length[128]');
      $this->form_validation->set_rules('domicilio','Domicilio','max_length[128]');
      $this->form_validation->set_rules('id_ciudad','Id Ciudad','integer');
      $this->form_validation->set_rules('telefono','Telefono','max_length[128]');
      $this->form_validation->set_rules('email','Email','max_length[128]|valid_email');

      if($this->form_validation->run())
      {

        $params = array(
          'id_tipo_documento' => $this->input->post('id_tipo_documento'),
          'id_ciudad' => $this->input->post('id_ciudad'),
          'numero_documento' => $this->input->post('numero_documento'),
          'nombre' => $this->input->post('nombre'),
          'apellido' => $this->input->post('apellido'),
          'domicilio' => $this->input->post('domicilio'),
          'telefono' => $this->input->post('telefono'),
          'email' => $this->input->post('email'),
          'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
        );
        if ($params['id_ciudad']=='') {$params['id_ciudad']=NULL;}

        $this->Persona_model->update_persona($id,$params);
        redirect('persona/index');
      }
      else
      {
        $data['all_tipo_documento'] = $this->Tipo_documento_model->get_all_tipo_documento();
        $data['all_ciudades'] = $this->Ciudad_model->get_all_ciudades();

        $data['js'] = array('persona.js');

        $this->load->view('templates/header',$data);
        $this->load->view('persona/edit',$data);
        $this->load->view('templates/footer',$data);

      }
    }
    else
    show_error('The persona you are trying to edit does not exist.');
  }

  /*
  * Deleting persona
  */
  function remove($id)
  {
    $persona = $this->Persona_model->get_persona($id);

    // check if the persona exists before trying to delete it
    if(isset($persona['id']))
    {
      $this->Persona_model->delete_persona($id);
      redirect('persona/index');
    }
    else
    show_error('The persona you are trying to delete does not exist.');
  }

}
