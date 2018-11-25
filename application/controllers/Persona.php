<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Persona extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    is_logged_in();
    validar_acceso();
    $this->load->model('Persona_model');
    $this->load->model('Usuario_model');
    $this->load->model('Tipo_documento_model');
    $this->load->model('Ciudad_model');
    $this->load->model('Perfil_model');
    $this->load->model('Perfil_usuario_model');
    $this->load->model('inscripcion_materia_model');
  }

  public function cargar_y_configurar_googlemaps_library($busqueda_direccion=array()){
    $this->load->library('Googlemaps');
    $config['zoom'] = 'auto';
    //AIzaSyCOnpDL1OhCIE-a2oxHx2WVUTMNOhn5aSY
    //AIzaSyBVZDs2iHSsTy8S--XKdIJE3bHN8i45u5U
    //AIzaSyC4rZigdVYVLesCSP95tkJqxBbIw-Gvzcg
    $config['apiKey'] = 'AIzaSyCOnpDL1OhCIE-a2oxHx2WVUTMNOhn5aSY';

    if(count($busqueda_direccion)>0){
      $config['places'] = TRUE;
      $config['placesAutocompleteInputID'] = $busqueda_direccion['id_input_vista'];
      $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
      $config['placesAutocompleteOnChange'] = $busqueda_direccion['funcion_js_vista'];
    }

    $this->googlemaps->initialize($config);
  }


  public function obtener_latlong_de_direccion(){
    $direccion  = $this->input->post('direccion');
    $gmaps='';

    if(!$gmaps || $gmaps == null){
      $this->cargar_y_configurar_googlemaps_library();
      $gmaps =  $this->googlemaps;
    }

    $latlong = $gmaps->get_lat_long_from_address($direccion);

    $result = ['success' => '1','lat' => $latlong[0], 'long' => $latlong[1]];
    echo json_encode($result);
    exit;
    //exit

  }

  /*
  * Listing of personas
  */
  function index()
  {
    $data['title']='Personas - CeciliaESMN';
    $data['page_title']='Personas';
    setlocale(LC_TIME,"es_ES.UTF-8"); //fechas en espaï¿½ol

    $params['limit'] = RECORDS_PER_PAGE;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('persona/index?');
    $config['total_rows'] = $this->Persona_model->get_all_personas_count();
    $this->pagination->initialize($config);

    $data['personas'] = $this->Persona_model->get_all_personas($params);
    //$data['all_tipo_documento'] = $this->Tipo_documento_model->get_all_tipo_documento();
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
    //$this->load->library('Googlemaps');

    $data_vista = array('id_input_vista'=>'field-PER_CALLE','funcion_js_vista'=>'cargar_datos_de_busqueda_direccion_gmaps()');
    $this->cargar_y_configurar_googlemaps_library($data_vista);

    $this->form_validation->set_rules('id_tipo_documento','Id Tipo Documento','required|integer');
    $this->form_validation->set_rules('numero_documento','Numero Documento','required|max_length[11]|integer');
    $this->form_validation->set_rules('nombre','Nombre','required|max_length[128]');
    $this->form_validation->set_rules('apellido','Apellido','required|max_length[128]');
    $this->form_validation->set_rules('domicilio','Domicilio','max_length[128]');
    $this->form_validation->set_rules('id_ciudad','Id Ciudad','integer');
    $this->form_validation->set_rules('telefono','Telefono','max_length[128]');
    $this->form_validation->set_rules('email','Email','max_length[128]|valid_email');
    $this->form_validation->set_rules('fecha_nacimiento','Fecha de nacimiento','required');
    //para creacion de usuario:
    $this->form_validation->set_rules('username','Nombre de usuario','max_length[128]|is_unique[usuario.username]');

    $config['upload_path']= './files/images/';
    $config['allowed_types']= 'gif|jpg|png|jpeg';
    $config['max_size']= 10240;
    $config['max_filename']= 200;
    $config['file_ext_tolower']= TRUE;
    $this->load->library('upload', $config);

    if (!empty($_FILES)) {
      if ($_FILES['foto_perfil']['error']!==0) {
        $imagen = TRUE;
      }else {
        $imagen = $this->upload->do_upload('foto_perfil');
        $file_name = $this->upload->data('file_name');
        $imagen_path = base_url('files/images/'.$file_name);
        $imagen_real_path = APPPATH.'../files/images/'.$file_name;

        //include Drive library and upload file to Drive
        $this->load->library('drive');
        $this->drive->upload_file(array(array('file_path'=>$imagen_real_path,'file_name'=>$file_name))); //call function
      }
    }

    if($this->form_validation->run() && $imagen)
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
      if (isset($imagen_path)) {$params['foto']= $imagen_path;}

      if ($params['id_ciudad']=='') {$params['id_ciudad']=NULL;}
      // var_dump($params);exit;

      $persona_id = $this->Persona_model->add_persona($params);

      //Creo el usuario
      if(isset($_POST['generar_usuario']))
      {
        // $username= strtolower(substr($this->input->post('nombre'),0,1).$this->input->post('apellido'));

        $password = hash('sha512',$this->input->post('username').html_escape($this->input->post('password',TRUE)));
        $params_usuario= array(
          'id_persona' => $persona_id,
          'username' => $this->input->post('username'),
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

      $this->session->set_flashdata('crear', 'Nueva persona creada');
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
      $data['css'] = array('persona.css');

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
    $data_vista = array('id_input_vista'=>'field-PER_CALLE','funcion_js_vista'=>'cargar_datos_de_busqueda_direccion_gmaps()');
    $this->cargar_y_configurar_googlemaps_library($data_vista);
    // check if the persona exists before trying to edit it
    $data['persona'] = $this->Persona_model->get_persona($id);

    if(isset($data['persona']['id']))
    {
      if ($this->session->userdata('usuario_id')=='1' || $this->session->userdata('persona_id')==$id) {

        $this->form_validation->set_rules('id_tipo_documento','Id Tipo Documento','required|integer');
        $this->form_validation->set_rules('numero_documento','Numero Documento','required|max_length[11]|integer');
        $this->form_validation->set_rules('nombre','Nombre','required|max_length[128]');
        $this->form_validation->set_rules('apellido','Apellido','required|max_length[128]');
        $this->form_validation->set_rules('domicilio','Domicilio','max_length[128]');
        $this->form_validation->set_rules('id_ciudad','Id Ciudad','integer');
        $this->form_validation->set_rules('telefono','Telefono','max_length[128]');
        $this->form_validation->set_rules('email','Email','max_length[128]|valid_email');
        $this->form_validation->set_rules('fecha_nacimiento','Fecha de nacimiento','required');
        $this->form_validation->set_rules('username','Nombre de usuario','max_length[128]|is_unique[usuario.username]');

        $config['upload_path']= './files/images/';
        $config['allowed_types']= 'gif|jpg|png|jpeg';
        $config['max_size']= 10240;
        $config['max_filename']= 200;
        $config['file_ext_tolower']= TRUE;
        $this->load->library('upload', $config);

        if (!empty($_FILES)) {
          if ($_FILES['foto_perfil']['error']!==0) {
            $imagen = TRUE;
          }else {
            $imagen = $this->upload->do_upload('foto_perfil');
            $file_name = $this->upload->data('file_name');
            $imagen_path = base_url('files/images/'.$file_name);
            $imagen_real_path = APPPATH.'../files/images/'.$file_name;

            //include Drive library and upload file to Drive
            $this->load->library('drive');
            $this->drive->upload_file(array(array('file_path'=>$imagen_real_path,'file_name'=>$file_name))); //call function
          }
        }

        if($this->form_validation->run() && $imagen)
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
          if (isset($imagen_path)) {$params['foto']= $imagen_path;}

          if ($params['id_ciudad']=='') {$params['id_ciudad']=NULL;}

          $this->Persona_model->update_persona($id,$params);
          $this->session->set_flashdata('editar', 'Se guardaron los cambios');
          redirect('persona/index');
        }
        else
        {
          $data['title']='Editar Persona - CeciliaESMN';
          $data['page_title']='Editar -> '.$data['persona']['nombre'].' '.$data['persona']['apellido'];

          $data['all_tipo_documento'] = $this->Tipo_documento_model->get_all_tipo_documento();
          $data['all_ciudades'] = $this->Ciudad_model->get_all_ciudades();
          $data['all_roles'] = $this->Perfil_model->get_all_perfiles();
          $data['usuario'] = $this->Persona_model->get_usuario_de_persona($id);


          $data['js'] = array(
            '../bootstrap-birthday/bootstrap-birthday.min.js',
            'persona.js'
          );
          $data['css'] = array('persona.css');

          $this->load->view('templates/header',$data);
          $this->load->view('persona/edit',$data);
          $this->load->view('templates/footer',$data);

        }
      }
      else
      show_error('No tienes permiso para entrar aqui!');
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
      // $respuesta = $this->Persona_model->delete_persona($id);
      // if (!$respuesta) { //controlar errores, la configuracion del proyecto tiene que estar en modo produccion!
      //     $this->session->set_flashdata('eliminar', 'No se puede eliminar la persona. Error de dependencia');
      //     redirect('persona/index');
      // }
      $this->Persona_model->update($id,array('activo'=>0));
      $this->session->set_flashdata('eliminar', 'Persona eliminada');
      redirect('persona/index');
    }
    else
    show_error('The persona you are trying to delete does not exist.');
  }


  function ver_historial($id) {

    $data['persona'] = $this->Persona_model->get_persona($id);

    $carrera= $this->input->post('id_carrera');

    $data['js'] = array(
        'persona.js'
    );

    $data['title']='Personas - CeciliaESMN';
    $data['page_title']='Estudiante - '.$data['persona']['nombre'].' '.$data['persona']['apellido'];
    setlocale(LC_TIME,"es_ES.UTF-8"); //fechas en espaï¿½ol

    $params['limit'] = RECORDS_PER_PAGE;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('persona/index?');
    $config['total_rows'] = $this->Persona_model->get_all_personas_count();
    $this->pagination->initialize($config);

    $data['carreras_iscripcion'] = $this->Persona_model->get_carreras_inscriptas($id);
    if($carrera == null)
    {
        $carrera= $data['carreras_iscripcion'][0]['id'];
    }
    $data['datos_persona'] = $this->Persona_model->get_historial_persona_curso($id, $carrera);
    $data['datos_mesas'] = $this->Persona_model->get_historial_persona_mesa($id, $carrera);

    $data['all_tipo_documento'] = $this->Tipo_documento_model->get_all_tipo_documento();
    $data['tipo_documento']="";
    foreach ($data['all_tipo_documento'] as $tipo_doc)
    {
        if($tipo_doc['id'] == $data['persona']['id_tipo_documento'])
        {
            $data['tipo_documento']=$tipo_doc['nombre'];
        }
    }
    $data['all_ciudades'] = $this->Ciudad_model->get_all_ciudades();

    //Botones de acciones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');

    $this->load->view('templates/header',$data);
    $this->load->view('persona/ver_historial',$data);
    $this->load->view('templates/footer',$data);



  }

}

?>
