<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Provincia extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    is_logged_in();
    validar_acceso();
    $this->load->model('Provincia_model','Provincia',TRUE);
  }

  /*
  * Listing of provincias
  */
  function index()
  {
    $data['title'] = 'Provincias - ESMN';
    $data['page_title'] = 'Provincias';

    $data['provincias'] = $this->Provincia->get_all_provincias();

    //Botones de acciones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');

    $this->load->view('templates/header',$data);
    $this->load->view('provincia/index',$data);
    $this->load->view('templates/footer');

  }

  /*
  * Adding a new provincia
  */
  function add()
  {
    $this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');

    if($this->form_validation->run())
    {
      $params = array(
        'nombre' => $this->input->post('nombre'),
      );

      $provincia_id = $this->Provincia->add_provincia($params);
      $this->session->set_flashdata('crear', 'Nueva provincia creada');
      redirect('provincia/index');
    }
    else
    {
      $data['title'] = 'Nueva Provincia - ESMN';
      $data['page_title'] = 'Nueva Provincia';
      $this->load->view('templates/header',$data);
      $this->load->view('provincia/add');
      $this->load->view('templates/footer');
    }
  }

  /*
  * Editing a provincia
  */
  function edit($id)
  {
    // check if the provincia exists before trying to edit it
    $data['provincia'] = $this->Provincia->get_provincia($id);

    if(isset($data['provincia']['id']))
    {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');

      if($this->form_validation->run())
      {
        $params = array(
          'nombre' => $this->input->post('nombre'),
        );

        $this->Provincia->update_provincia($id,$params);
        $this->session->set_flashdata('editar', 'Se guardaron los cambios');
        redirect('provincia/index');
      }
      else
      {
        $data['title'] = 'Editar Provincia - ESMN';
        $data['page_title'] = 'Editar Provincia';
        $this->load->view('templates/header',$data);
        $this->load->view('provincia/edit',$data);
        $this->load->view('templates/footer',$data);
      }
    }
    else
    show_error('The provincia you are trying to edit does not exist.');
  }

  /*
  * Deleting provincia
  */
  function remove($id)
  {
    $provincia = $this->Provincia->get_provincia($id);

    // check if the provincia exists before trying to delete it
    if(isset($provincia['id']))
    {
      $this->Provincia->delete_provincia($id);
      $this->session->set_flashdata('eliminar', 'Provincia eliminada');
      redirect('provincia/index');
    }
    else
    show_error('The provincia you are trying to delete does not exist.');
  }

}
