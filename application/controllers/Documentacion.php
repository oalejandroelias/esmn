<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Documentacion extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    validar_acceso();
    is_logged_in();
    $this->load->model('Persona_model');
    $this->load->model('Documentacion_model');
  }

  /*
  * Listing of documentacion
  */
  function index()
  {
    $params['limit'] = RECORDS_PER_PAGE;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('documentacion/index?');
    $config['total_rows'] = $this->Documentacion_model->get_all_documentacion_count();
    $this->pagination->initialize($config);

    $data['documentacion'] = $this->Documentacion_model->get_all_documentacion($params);

    $data['title'] = 'Documentacion - ESMN';
    $data['page_title'] = 'Documentacion';

    //Botones de acciones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');

    $this->load->view('templates/header',$data);
    $this->load->view('documentacion/index',$data);
    $this->load->view('templates/footer');
  }

  function ver($id_persona){
    $data['documentacion'] = $this->Documentacion_model->get_all_documentacion(array(),array('row'=>'persona.id','value'=>$id_persona));
    $nombre = $data['documentacion'][0]['nombre'];
    $apellido = $data['documentacion'][0]['apellido'];
    $numero_documento = $data['documentacion'][0]['numero_documento'];

    $data['title'] = 'Documentacion - ESMN';
    $data['page_title'] = 'Documentacion - '.$nombre.' '.$apellido.' ('.$numero_documento.')';

    $this->load->view('templates/header',$data);
    $this->load->view('documentacion/ver',$data);
    $this->load->view('templates/footer');
  }

  /*
  * Adding a new documentacion
  */
  function add()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('id_persona','Id Persona','required|integer');
    $this->form_validation->set_rules('genero','Genero','max_length[24]');

    if($this->form_validation->run())
    {
      $params = array(
        'id_persona' => $this->input->post('id_persona'),
        'genero' => $this->input->post('genero'),
        'fecha_inscripcion' => $this->input->post('fecha_inscripcion'),
        'fotocopia_dni' => $this->input->post('fotocopia_dni'),
        'titulo_primario' => $this->input->post('titulo_primario'),
        'titulo_secundario' => $this->input->post('titulo_secundario'),
        'otros_titulos' => $this->input->post('otros_titulos'),
        'foto_carnet' => $this->input->post('foto_carnet'),
        'certificado_nacimiento' => $this->input->post('certificado_nacimiento'),
        'beca' => $this->input->post('beca'),
        'certificado_jucaid' => $this->input->post('certificado_jucaid'),
        'medicacion' => $this->input->post('medicacion'),
        'enfermedad' => $this->input->post('enfermedad'),
        'trabajo' => $this->input->post('trabajo'),
      );

      $documentacion_id = $this->Documentacion_model->add_documentacion($params);
      redirect('documentacion/index');
    }
    else
    {
      $this->load->model('Persona_model');
      $data['all_personas'] = $this->Persona_model->get_all_personas();

      $data['page_title'] = 'Documentacion - ESMN';
      $data['title'] = 'Documentacion';

      $this->load->view('templates/header',$data);
      $this->load->view('documentacion/add',$data);
      $this->load->view('templates/footer');
    }
  }

  /*
  * Editing a documentacion
  */
  function edit($id)
  {
    // check if the documentacion exists before trying to edit it
    $data['documentacion'] = $this->Documentacion_model->get_documentacion($id);

    if(isset($data['documentacion']['id']))
    {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('id_persona','Id Persona','required|integer');
      $this->form_validation->set_rules('genero','Genero','max_length[24]');

      if($this->form_validation->run())
      {
        $params = array(
          'id_persona' => $this->input->post('id_persona'),
          'genero' => $this->input->post('genero'),
          'fecha_inscripcion' => $this->input->post('fecha_inscripcion'),
          'fotocopia_dni' => $this->input->post('fotocopia_dni'),
          'titulo_primario' => $this->input->post('titulo_primario'),
          'titulo_secundario' => $this->input->post('titulo_secundario'),
          'otros_titulos' => $this->input->post('otros_titulos'),
          'foto_carnet' => $this->input->post('foto_carnet'),
          'certificado_nacimiento' => $this->input->post('certificado_nacimiento'),
          'beca' => $this->input->post('beca'),
          'certificado_jucaid' => $this->input->post('certificado_jucaid'),
          'medicacion' => $this->input->post('medicacion'),
          'enfermedad' => $this->input->post('enfermedad'),
          'trabajo' => $this->input->post('trabajo'),
        );

        $this->Documentacion_model->update_documentacion($id,$params);
        redirect('documentacion/index');
      }
      else
      {
        $this->load->model('Persona_model');
        $data['all_personas'] = $this->Persona_model->get_all_personas();

        $data['page_title'] = 'Documentacion - ESMN';
        $data['title'] = 'Documentacion';

        $this->load->view('templates/header',$data);
        $this->load->view('documentacion/edit',$data);
        $this->load->view('templates/footer');
      }
    }
    else
    show_error('The documentacion you are trying to edit does not exist.');
  }

  /*
  * Deleting documentacion
  */
  function remove($id)
  {
    $documentacion = $this->Documentacion_model->get_documentacion($id);

    // check if the documentacion exists before trying to delete it
    if(isset($documentacion['id']))
    {
      $this->Documentacion_model->delete_documentacion($id);
      redirect('documentacion/index');
    }
    else
    show_error('The documentacion you are trying to delete does not exist.');
  }

}