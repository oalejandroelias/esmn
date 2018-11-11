<?php

class Materia_equivalente extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    is_logged_in();
    validar_acceso();
    $this->load->model('Materia_equivalente_model');
  }

  function ver_equivalencias(){
    if ($this->input->is_ajax_request() && !empty($_POST)) {
      $materias = $this->Materia_equivalente_model->get_materia_equivalente($_POST['id_materia']);
      echo json_encode($materias);
    }
    return false;
  }

  function add()
  {
    if (!empty($_POST)) {
      $params=array(
        'id_materia'=>$_POST['id_materia'],
        'id_equivalencia'=>$_POST['id_equivalencia'],
      );
      $this->Materia_equivalente_model->add_materia_equivalente($params);
      redirect('materia/index');
    }
  }

  function remove()
  {
    if ($this->input->is_ajax_request() && !empty($_POST)) {
      // como son equivalentes, al eliminar una equivalencia se hace en las 2 direcciones
      $this->Materia_equivalente_model->delete_materia_equivalente($_POST['id_equivalencia'],$_POST['id_materia']);
      $this->Materia_equivalente_model->delete_materia_equivalente($_POST['id_materia'],$_POST['id_equivalencia']);
    }
  }
}

 ?>
