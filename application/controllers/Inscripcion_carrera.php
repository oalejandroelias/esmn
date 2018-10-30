<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Inscripcion_carrera extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Inscripcion_carrera_model');
    $this->load->model('Persona_model');
    $this->load->model('Carrera_model');
  }

  /*
  * Listing of inscripcion_carrera
  */
  function index()
  {
    $data['title'] = 'Inscripciones a Carreras - ESMN';
    $data['page_title'] = 'Inscripciones a Carreras';

    $data['inscripcion_carrera'] = $this->Inscripcion_carrera_model->get_all_inscripcion_carrera();

    //Botones de acciones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');

    $this->load->view('templates/header',$data);
    $this->load->view('inscripcion_carrera/index',$data);
    $this->load->view('templates/footer');
  }

  /*
  * Adding a new inscripcion_carrera
  */
  function add()
  {
    $this->form_validation->set_rules('id_persona','Persona / Alumno','required|integer');
    $this->form_validation->set_rules('id_carrera','Carrera / Plan','required|max_length[11]');

    if($this->form_validation->run())
    {
      $params = array(
        'id_persona' => $this->input->post('id_persona'),
        'id_carrera' => $this->input->post('id_carrera'),
      );

      $inscripcion_carrera_id = $this->Inscripcion_carrera_model->add_inscripcion_carrera($params);
      redirect('inscripcion_carrera/index');
    }
    else
    {
      $data['title'] = 'Nueva Inscripcion - ESMN';
      $data['page_title'] = 'Inscribir un alumno a una carrera';

      $data['personas'] = $this->Persona_model->get_all_personas();
      $data['all_carreras'] = $this->Carrera_model->get_all_carreras();

      $this->load->view('templates/header',$data);
      $this->load->view('inscripcion_carrera/add',$data);
      $this->load->view('templates/footer');
    }
  }

  /*
  * Editing a inscripcion_carrera
  */
  function edit($id_persona)
  {
    // check if the inscripcion_carrera exists before trying to edit it
    $data['inscripcion_carrera'] = $this->Inscripcion_carrera_model->get_inscripcion_carrera($id_persona);

    if(isset($data['inscripcion_carrera']['id_persona']))
    {
      if(isset($_POST) && count($_POST) > 0)
      {
        $params = array(
        );

        $this->Inscripcion_carrera_model->update_inscripcion_carrera($id_persona,$params);
        redirect('inscripcion_carrera/index');
      }
      else
      {
        $data['_view'] = 'inscripcion_carrera/edit';
        $this->load->view('layouts/main',$data);
      }
    }
    else
    show_error('The inscripcion_carrera you are trying to edit does not exist.');
  }

  /*
  * Deleting inscripcion_carrera
  */
  function remove($id_persona)
  {
    $inscripcion_carrera = $this->Inscripcion_carrera_model->get_inscripcion_carrera($id_persona);

    // check if the inscripcion_carrera exists before trying to delete it
    if(isset($inscripcion_carrera['id_persona']))
    {
      $this->Inscripcion_carrera_model->delete_inscripcion_carrera($id_persona);
      redirect('inscripcion_carrera/index');
    }
    else
    show_error('The inscripcion_carrera you are trying to delete does not exist.');
  }

}