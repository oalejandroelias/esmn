<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Persona_tutor extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    is_logged_in();
    validar_acceso();
    $this->load->model('Persona_tutor_model');
    $this->load->model('Tipo_documento_model');
    $this->load->model('Tutor_model');
    $this->load->model('Persona_model');
  }

  /*
  * Listing of persona_tutor
  */
  function index()
  {
    $data['persona_tutor'] = $this->Persona_tutor_model->get_all_persona_tutor();

    $data['_view'] = 'persona_tutor/index';
    $this->load->view('layouts/main',$data);
  }

// ver y agregar relaciones de una persona
  function relacion($id_persona){
    $this->form_validation->set_rules('id_persona','id_persona','required|integer');
    $this->form_validation->set_rules('id_responsable','Persona Responsable','required|integer');
    $this->form_validation->set_rules('id_tutor','Tipo Tutor','required|integer');
    if($this->form_validation->run())
    {
      $params = array(
        'id_persona' => $this->input->post('id_persona'),
        'id_responsable' => $this->input->post('id_responsable'),
        'id_tutor' => $this->input->post('id_tutor'),
      );

      $persona_tutor_id = $this->Persona_tutor_model->add_persona_tutor($params);
      redirect('persona_tutor/relacion/'.$id_persona);

    }else {
      $data['relacion'] = $this->Persona_tutor_model->get_persona_tutor($id_persona);
      $data['persona'] = $this->Persona_model->get_persona($id_persona);

      $data['title'] = 'Tutores/Encargados - ESMN';
      $data['page_title'] = 'Relaciones con '.$data['persona']['nombre'].' '.$data['persona']['apellido'];

      $data['personas'] = $this->Persona_model->get_all_personas();
      $data['all_tutores'] = $this->Tutor_model->get_all_tutores();
      $data['all_tipo_documento'] = $this->Tipo_documento_model->get_all_tipo_documento();

      $this->load->view('templates/header',$data);
      $this->load->view('persona_tutor/relacion',$data);
      $this->load->view('templates/footer');
    }
  }

  /*
  * Adding a new persona_tutor
  */
  // function add()
  // {
  //   if(isset($_POST) && count($_POST) > 0)
  //   {
  //     $params = array(
  //       'id_persona' => $this->input->post('id_persona'),
  //       'id_responsable' => $this->input->post('id_responsable'),
  //       'id_tutor' => $this->input->post('id_tutor'),
  //     );
  //
  //     $persona_tutor_id = $this->Persona_tutor_model->add_persona_tutor($params);
  //     redirect('persona_tutor/relacion/');
  //   }
  //   else
  //   {
  //     $this->load->model('Tutor_model');
  //     $data['all_tutores'] = $this->Tutor_model->get_all_tutores();
  //
  //     $data['_view'] = 'persona_tutor/add';
  //     $this->load->view('layouts/main',$data);
  //   }
  // }

  /*
  * Editing a persona_tutor
  */
  function edit($id_persona)
  {
    // check if the persona_tutor exists before trying to edit it
    $data['persona_tutor'] = $this->Persona_tutor_model->get_persona_tutor($id_persona);

    if(isset($data['persona_tutor']['id_persona']))
    {
      if(isset($_POST) && count($_POST) > 0)
      {
        $params = array(
          'id_tutor' => $this->input->post('id_tutor'),
        );

        $this->Persona_tutor_model->update_persona_tutor($id_persona,$params);
        redirect('persona_tutor/index');
      }
      else
      {
        $this->load->model('Tutor_model');
        $data['all_tutores'] = $this->Tutor_model->get_all_tutores();

        $data['_view'] = 'persona_tutor/edit';
        $this->load->view('layouts/main',$data);
      }
    }
    else
    show_error('The persona_tutor you are trying to edit does not exist.');
  }

  /*
  * Deleting persona_tutor
  */
  function remove($id_persona,$id_responsable)
  {
      $this->Persona_tutor_model->delete_persona_tutor($id_persona,$id_responsable);
      redirect('persona_tutor/relacion/'.$id_persona);
  }

}
