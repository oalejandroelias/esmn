<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Ciudad extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('Ciudad_model');
    $this->load->model('Provincia_model');
  }

  /*
  * Listing of ciudades
  */
  function index()
  {
    $data['title'] = 'Ciudades - ESMN';
    $data['page_title'] = 'Ciudades';
    $params['limit'] = RECORDS_PER_PAGE;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('ciudad/index?');
    $config['total_rows'] = $this->Ciudad_model->get_all_ciudades_count();
    $this->pagination->initialize($config);

    $data['ciudades'] = $this->Ciudad_model->get_all_ciudades($params);
    $data['all_provincias'] = $this->Provincia_model->get_all_provincias();

    $this->load->view('templates/header',$data);
    $this->load->view('ciudad/index',$data);
    $this->load->view('templates/footer');
  }

  /*
  * Adding a new ciudad
  */
  function add()
  {

    $this->form_validation->set_rules('id_provincia','Provincia','required');
    $this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');

    if($this->form_validation->run())
    {
      $params = array(
        'id_provincia' => $this->input->post('id_provincia'),
        'nombre' => $this->input->post('nombre'),
      );

      $ciudad_id = $this->Ciudad_model->add_ciudad($params);
      redirect('ciudad/index');
    }
    else
    {
      $data['title'] = 'Nueva Ciudad - ESMN';
      $data['page_title'] = 'Nueva Ciudad';
      $data['all_provincias'] = $this->Provincia_model->get_all_provincias();
      $this->load->view('templates/header',$data);
      $this->load->view('ciudad/add',$data);
      $this->load->view('templates/footer');
    }
  }

  /*
  * Editing a ciudad
  */
  function edit($id)
  {
    // check if the ciudad exists before trying to edit it
    $data['ciudad'] = $this->Ciudad_model->get_ciudad($id);
    $data['all_provincias'] = $this->Provincia_model->get_all_provincias();

    if(isset($data['ciudad']['id']))
    {

      $this->form_validation->set_rules('id_provincia','Provincia','required');
      $this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');

      if($this->form_validation->run())
      {
        $params = array(
          'id_provincia' => $this->input->post('id_provincia'),
          'nombre' => $this->input->post('nombre'),
        );

        $this->Ciudad_model->update_ciudad($id,$params);
        redirect('ciudad/index');
      }
      else
      {
        $data['title'] = 'Editar Ciudad - ESMN';
        $data['page_title'] = 'Editar Ciudad';
        $this->load->view('templates/header',$data);
        $this->load->view('ciudad/edit',$data);
        $this->load->view('templates/footer');
      }
    }
    else
    show_error('The ciudad you are trying to edit does not exist.');
  }

  /*
  * Deleting ciudad
  */
  function remove($id)
  {
    $ciudad = $this->Ciudad_model->get_ciudad($id);

    // check if the ciudad exists before trying to delete it
    if(isset($ciudad['id']))
    {
      $this->Ciudad_model->delete_ciudad($id);
      redirect('ciudad/index');
    }
    else
    show_error('The ciudad you are trying to delete does not exist.');
  }

}
