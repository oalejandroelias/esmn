<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Periodo extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    is_logged_in();
    validar_acceso();
    $this->load->model('Periodo_model');
    $this->load->model('Tipo_periodo_model');
  }

  /*
  * Listing of periodo
  */
  function index()
  {
    $data['periodos'] = $this->Periodo_model->get_all_periodo();

    $data['title'] = 'Periodos - ESMN';
    $data['page_title'] = 'Periodos';

    //validar botones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');

    $this->load->view('templates/header',$data);
    $this->load->view('periodo/index',$data);
    $this->load->view('templates/footer');
  }

  /*
  * Adding a new periodo
  */
  function add()
  {
    $this->form_validation->set_rules('id_tipo_periodo','Periodo','required|integer');
    $this->form_validation->set_rules('desde','Fecha Desde','required');
    $this->form_validation->set_rules('hasta','Fecha Hasta','required');

    if($this->form_validation->run())
    {
      $params = array(
        'id_tipo_periodo' => $this->input->post('id_tipo_periodo',TRUE),
        'desde' => date('Y-m-d', strtotime(str_replace('/', '-',$this->input->post('desde',TRUE)))),
        'hasta' => date('Y-m-d', strtotime(str_replace('/', '-',$this->input->post('hasta',TRUE)))),
      );

      $periodo_id = $this->Periodo_model->add_periodo($params);
      redirect('periodo/index');
    }
    else
    {
      $data['title'] = 'Nuevo Periodo - ESMN';
      $data['page_title'] = 'Nuevo Periodo';

      $data['all_tipo_periodo'] = $this->Tipo_periodo_model->get_all_tipo_periodo();

      $this->load->view('templates/header',$data);
      $this->load->view('periodo/add',$data);
      $this->load->view('templates/footer');
    }
  }

  /*
  * Editing a periodo
  */
  function edit($id)
  {
    // check if the periodo exists before trying to edit it
    $data['periodo'] = $this->Periodo_model->get_all_periodo(array('row'=>'periodo.id','value'=>$id));
    $data['periodo'] = (isset($data['periodo'][0])) ? $data['periodo'][0] : null;

    if(isset($data['periodo']['id']))
    {
      $this->form_validation->set_rules('id_tipo_periodo','Periodo','required|integer');
      $this->form_validation->set_rules('desde','Fecha Desde','required');
      $this->form_validation->set_rules('hasta','Fecha Hasta','required');

      if($this->form_validation->run())
      {
        $params = array(
          'id_tipo_periodo' => $this->input->post('id_tipo_periodo',TRUE),
          'desde' => date('Y-m-d', strtotime(str_replace('/', '-',$this->input->post('desde',TRUE)))),
          'hasta' => date('Y-m-d', strtotime(str_replace('/', '-',$this->input->post('hasta',TRUE)))),
        );

        $this->Periodo_model->update_periodo($id,$params);
        redirect('periodo/index');
      }
      else
      {
        $data['title'] = 'Editar Periodo - ESMN';
        $data['page_title'] = 'Editar Periodo -> '.$data['periodo']['descripcion'];

        $data['all_tipo_periodo'] = $this->Tipo_periodo_model->get_all_tipo_periodo();

        $this->load->view('templates/header',$data);
        $this->load->view('periodo/edit',$data);
        $this->load->view('templates/footer');
      }
    }
    else
    show_error('The periodo you are trying to edit does not exist.');
  }

  /*
  * Deleting periodo
  */
  function remove($id)
  {
    $periodo = $this->Periodo_model->get_periodo($id);

    // check if the periodo exists before trying to delete it
    if(isset($periodo['id']))
    {
      $this->Periodo_model->delete_periodo($id);
      redirect('periodo/index');
    }
    else
    show_error('The periodo you are trying to delete does not exist.');
  }

}
