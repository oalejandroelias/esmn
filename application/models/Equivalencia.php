<<?php

class Equivalencia extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    validar_acceso();
    is_logged_in();
    $this->load->model('Equivalencia_model');
  }

  function index()
  {
    $params['limit'] = RECORDS_PER_PAGE;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('equivalencia/index?');
    $config['total_rows'] = $this->Equivalencia_model->get_all_equivalencia_count();
    $this->pagination->initialize($config);

    $data['equivalencia'] = $this->Equivalencia_model->get_all_equivalencia($params);

    $data['title'] = 'Materias Equivalentes - ESMN';
    $data['page_title'] = 'Materias de Equivalencias';
    $this->load->view('templates/header',$data);
    $this->load->view('equivalencia/index',$data);
    $this->load->view('templates/footer');
  }


  function ver_Equivalencias(){
    if ($this->input->is_ajax_request() && !empty($_POST)) {
      $materias = $this->Equivalencia_model->get_equivalencia($_POST['id_materia']);
      echo json_encode($materias);
    }
    return false;
  }

  function add()
  {
    if (!empty($_POST)) {
      $params=array(
        'id_materia'=>$_POST['id_materia'],
        'id_Equivalencia'=>$_POST['id_equivalencia'],
      );
      $this->Equivalencia_model->add_equivalencia($params);
      redirect('Equivalencia/index');
    }
  }

  function remove()
  {
    if ($this->input->is_ajax_request() && !empty($_POST)) {
      $this->Materia_correlativa_model->delete_Equivalencia($_POST['id_equivalencia'],$_POST['id_materia']);
    }
  }
}

 ?>
