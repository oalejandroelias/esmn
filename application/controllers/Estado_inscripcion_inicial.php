<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Estado_inscripcion_inicial extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    is_logged_in();
    validar_acceso();
    $this->load->model('estado_inscripcion_inicial_model');
  }

  /*
  * Listing of estado_inscripcion_inicial
  */
  function index()
  {
    $params['limit'] = RECORDS_PER_PAGE;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('estado_inscripcion_inicial/index?');
    $config['total_rows'] = $this->estado_inscripcion_inicial_model->get_all_estado_inscripcion_inicial_count();
    $this->pagination->initialize($config);

    $data['estado_inscripcion_inicial'] = $this->estado_inscripcion_inicial_model->get_all_estado_inscripcion_inicial($params);

    $data['page_title'] = 'Estados de cursado - ESMN';
    $data['title'] = 'Estados de cursado';

    //Botones de acciones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');

    $this->load->view('templates/header',$data);
    $this->load->view('estado_inscripcion_inicial/index',$data);
    $this->load->view('templates/footer');
  }

  /*
  * Adding a new estado_inscripcion_inicial
  */
  function add()
  {
    $this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');
    $this->form_validation->set_rules('nomenclatura','Nomenclatura','max_length[4]');
    $this->form_validation->set_rules('radio-stacked','Tipo inscripcion','required');
    //     $this->form_validation->set_rules('customControlValidation2','Es cursado');

    if($this->form_validation->run())
    {
        if($this->input->post('radio-stacked') == 'mesa')
        {
            $mesa=1;
            $cursado=0;
        }
        else {
            $mesa=1;
            $cursado=0;
        }
      $params = array(
        'nombre' => $this->input->post('nombre'),
        'nomenclatura' => $this->input->post('nomenclatura'),
         'es_mesa' => $mesa,
         'es_cursado' => $cursado
      );

      $estado_inscripcion_inicial_id = $this->estado_inscripcion_inicial_model->add_estado_inscripcion_inicial($params);
      redirect('estado_inscripcion_inicial/index');
    }
    else
    {
      $data['page_title'] = 'Nuevo estado de cursado - ESMN';
      $data['title'] = 'Nuevo estado de cursado';

      $this->load->view('templates/header',$data);
      $this->load->view('estado_inscripcion_inicial/add',$data);
      $this->load->view('templates/footer');
    }
  }

  /*
  * Editing a estado_inscripcion_inicial
  */
  function edit($id)
  {
    // check if the estado_inscripcion_inicial exists before trying to edit it
    $data['estado_inscripcion_inicial'] = $this->estado_inscripcion_inicial_model->get_estado_inscripcion_inicial($id);

    if(isset($data['estado_inscripcion_inicial']['id']))
    {
      $this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');
      $this->form_validation->set_rules('nomenclatura','Nomenclatura','max_length[4]');

      if($this->form_validation->run())
      {
        $params = array(
          'nombre' => $this->input->post('nombre'),
          'nomenclatura' => $this->input->post('nomenclatura'),
        );

        $this->estado_inscripcion_inicial_model->update_estado_inscripcion_inicial($id,$params);
        redirect('estado_inscripcion_inicial/index');
      }
      else
      {
        $data['page_title'] = 'Editar estado de cursado - ESMN';
        $data['title'] = 'Editar estado de cursado';

        $this->load->view('templates/header',$data);
        $this->load->view('estado_inscripcion_inicial/edit',$data);
        $this->load->view('templates/footer');
      }
    }
    else
    show_error('The estado_inscripcion_inicial you are trying to edit does not exist.');
  }

  /*
  * Deleting estado_inscripcion_inicial
  */
  function remove($id)
  {
    $estado_inscripcion_inicial = $this->estado_inscripcion_inicial_model->get_estado_inscripcion_inicial($id);

    // check if the estado_inscripcion_inicial exists before trying to delete it
    if(isset($estado_inscripcion_inicial['id']))
    {
      $this->estado_inscripcion_inicial_model->delete_estado_inscripcion_inicial($id);
      redirect('estado_inscripcion_inicial/index');
    }
    else
    show_error('The estado_inscripcion_inicial you are trying to delete does not exist.');
  }

}