<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Tutor extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    validar_acceso();
    is_logged_in();
    $this->load->model('Tutor_model');
  }

  /*
  * Listing of tutores
  */
  function index()
  {
    $params['limit'] = RECORDS_PER_PAGE;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('tutor/index?');
    $config['total_rows'] = $this->Tutor_model->get_all_tutores_count();
    $this->pagination->initialize($config);

    $data['tutores'] = $this->Tutor_model->get_all_tutores($params);

    $data['page_title'] = 'Tutores - ESMN';
    $data['title'] = 'Tutores';

    //Botones de acciones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');

    $this->load->view('templates/header',$data);
    $this->load->view('tutor/index',$data);
    $this->load->view('templates/footer');
  }

  /*
  * Adding a new tutor
  */
  function add()
  {
    $this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');

    if($this->form_validation->run())
    {
      $params = array(
        'nombre' => $this->input->post('nombre'),
      );

      $tutor_id = $this->Tutor_model->add_tutor($params);
      redirect('tutor/index');
    }
    else
    {
      $data['page_title'] = 'Tutores - ESMN';
      $data['title'] = 'Tutores';

      $this->load->view('templates/header',$data);
      $this->load->view('tutor/add',$data);
      $this->load->view('templates/footer');
    }
  }

  /*
  * Editing a tutor
  */
  function edit($id)
  {
    // check if the tutor exists before trying to edit it
    $data['tutor'] = $this->Tutor_model->get_tutor($id);

    if(isset($data['tutor']['id']))
    {
      $this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');

      if($this->form_validation->run())
      {
        $params = array(
          'nombre' => $this->input->post('nombre'),
        );

        $this->Tutor_model->update_tutor($id,$params);
        redirect('tutor/index');
      }
      else
      {
        $data['page_title'] = 'Tutores - ESMN';
        $data['title'] = 'Tutores';

        $this->load->view('templates/header',$data);
        $this->load->view('tutor/edit',$data);
        $this->load->view('templates/footer');
      }
    }
    else
    show_error('The tutor you are trying to edit does not exist.');
  }

  /*
  * Deleting tutor
  */
  function remove($id)
  {
    $tutor = $this->Tutor_model->get_tutor($id);

    // check if the tutor exists before trying to delete it
    if(isset($tutor['id']))
    {
      $this->Tutor_model->delete_tutor($id);
      redirect('tutor/index');
    }
    else
    show_error('The tutor you are trying to delete does not exist.');
  }

}