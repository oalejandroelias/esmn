<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Tipo_documento extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    is_logged_in();
    validar_acceso();
    $this->load->model('Tipo_documento_model');
  }

  /*
  * Listing of tipo_documento
  */
  function index()
  {
    $data['tipo_documento'] = $this->Tipo_documento_model->get_all_tipo_documento();

    $data['page_title'] = 'Tipos de documento - ESMN';
    $data['title'] = 'Tipos de documento';

    //Botones de acciones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');

    $this->load->view('templates/header',$data);
    $this->load->view('tipo_documento/index',$data);
    $this->load->view('templates/footer');
  }

  /*
  * Adding a new tipo_documento
  */
  function add()
  {
    $this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');

    if($this->form_validation->run())
    {
      $params = array(
        'nombre' => $this->input->post('nombre'),
      );

      $tipo_documento_id = $this->Tipo_documento_model->add_tipo_documento($params);
      $this->session->set_flashdata('crear', 'Nueva tipo de documento creada');
      redirect('tipo_documento/index');
    }
    else
    {
      $data['page_title'] = 'Tipos de documento - ESMN';
      $data['title'] = 'Tipos de documento';

      $this->load->view('templates/header',$data);
      $this->load->view('tipo_documento/add',$data);
      $this->load->view('templates/footer');
    }
  }

  /*
  * Editing a tipo_documento
  */
  function edit($id)
  {
    // check if the tipo_documento exists before trying to edit it
    $data['tipo_documento'] = $this->Tipo_documento_model->get_tipo_documento($id);

    if(isset($data['tipo_documento']['id']))
    {
      $this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');

      if($this->form_validation->run())
      {
        $params = array(
          'nombre' => $this->input->post('nombre'),
        );

        $this->Tipo_documento_model->update_tipo_documento($id,$params);
        $this->session->set_flashdata('editar', 'Se guardaron los cambios');
        redirect('tipo_documento/index');
      }
      else
      {
        $data['page_title'] = 'Tipos de documento - ESMN';
        $data['title'] = 'Tipos de documento';

        $this->load->view('templates/header',$data);
        $this->load->view('tipo_documento/edit',$data);
        $this->load->view('templates/footer');
      }
    }
    else
    show_error('The tipo_documento you are trying to edit does not exist.');
  }

  /*
  * Deleting tipo_documento
  */
  function remove($id)
  {
    $tipo_documento = $this->Tipo_documento_model->get_tipo_documento($id);

    // check if the tipo_documento exists before trying to delete it
    if(isset($tipo_documento['id']))
    {
      $this->Tipo_documento_model->delete_tipo_documento($id);
      $this->session->set_flashdata('eliminar', 'Tipo documento eliminado');
      redirect('tipo_documento/index');
    }
    else
    show_error('The tipo_documento you are trying to delete does not exist.');
  }

}
