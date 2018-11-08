<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Curso extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    is_logged_in();
    validar_acceso();
    $this->load->model('Curso_model');
    $this->load->model('Materia_model');
    $this->load->model('Periodo_model');
    $this->load->model('Carrera_model');
    $this->load->model('Modelo_global_model');

  }

  /*
  * Listing of curso
  */
  function index()
  {
    $data['cursos'] = $this->Curso_model->get_all_curso();

    $data['title'] = 'Cursos - ESMN';
    $data['page_title'] = 'Curso';

    //validar botones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');

    // script de correlatividades
    //$data['js'] = array('curso_index.js');

    $this->load->view('templates/header',$data);
    $this->load->view('curso/index',$data);
    $this->load->view('templates/footer');
  }

  /*
  * Adding a new curso
  */
  function add()
  {
    $this->form_validation->set_rules('id_materia','Materia','required|integer');
    $this->form_validation->set_rules('id_periodo','Periodo','required|integer');
    $this->form_validation->set_rules('dayWeek[]','Dias de semana','required');
    $this->form_validation->set_rules('diascursado','Json dias de cursado','required');

    if($this->form_validation->run())
    {
      // $dias_cursado=$this->input->post('dayWeek[]');
      // $dias=json_encode($this->input->post('dayWeek[]'));
      $datos_periodo=$this->Periodo_model->get_Periodo($this->input->post('id_periodo',TRUE));
      $desde=$datos_periodo['desde'];
      $hasta=$datos_periodo['hasta'];
      // $where='';
      // foreach ($dias_cursado as $dia)
      // {
      //     $where.=' or dayofweek(DIASENTREFECHAS) = '.$dia;
      //
      // }
      // $where= substr($where, 4);

      //$dias_cursado_string=json_encode($this->Modelo_global_model->fechas_de_intervalos($desde, $hasta, $where));
      // $dias_cursado_string=$dias;
      $dias_cursado = getDaysPeriod($desde,$hasta,$this->input->post('dayWeek[]',TRUE));

      $params = array(
        'id_materia' => $this->input->post('id_materia',TRUE),
        'id_periodo' => $this->input->post('id_periodo',TRUE),
        'diascursado' => $this->input->post('diascursado',TRUE),
        'diassemana' => json_encode($this->input->post('dayWeek[]')),
      );

      $curso_id = $this->Curso_model->add_curso($params);
      $this->session->set_flashdata('crear', 'Nuevo curso creado');
      redirect('curso/index');
    }

    else
    {
      $data['title'] = 'Nuevo Curso - ESMN';
      $data['page_title'] = 'Nuevo Curso';

      $data['all_materias'] = $this->Materia_model->get_all_materias();
      $data['all_periodos'] = $this->Periodo_model->get_all_periodo();

      $data['js'] = array('curso.js');
      $data['css'] = array('curso.css');

      $this->load->view('templates/header',$data);
      $this->load->view('curso/add',$data);
      $this->load->view('templates/footer');
    }
  }

  function get_days_period(){
    if ($this->input->is_ajax_request() && !empty($_POST)) {
      $dias_cursado = getDaysPeriod($_POST['fecha_inicio'],$_POST['fecha_fin'],$this->input->post('daysWeek[]',TRUE));
      echo json_encode($dias_cursado);
    }
    return false;
  }

  /*
  * Editing a curso
  */
  function edit($id)
  {
    $data['curso'] = $this->Curso_model->get_all_curso(array('row'=>'curso.id','value'=>$id))[0];
    // print_r($data['curso']);exit;
    if(isset($data['curso']['curso_id']))
    {
      $this->form_validation->set_rules('id_materia','Materia','required|integer');
      $this->form_validation->set_rules('id_periodo','Periodo','required|integer');
      $this->form_validation->set_rules('dayWeek[]','Dayweek','required');
      $this->form_validation->set_rules('diascursado','Json dias de cursado','required');

      if($this->form_validation->run())
      {
        $params = array(
          'id_materia' => $this->input->post('id_materia',TRUE),
          'id_periodo' => $this->input->post('id_periodo',TRUE),
          'diascursado' => $this->input->post('diascursado',TRUE),
          'diassemana' => json_encode($this->input->post('dayWeek[]')),
        );

        $this->Curso_model->update_curso($id,$params);
        $this->session->set_flashdata('editar', 'Se guardaron los cambios');
        redirect('curso/index');
      }
      else
      {
        $data['title'] = 'Editar curso - ESMN';
        $data['page_title'] = 'Editar Curso -> '.$data['curso']['nombre'];

        $data['all_materias'] = $this->Materia_model->get_all_materias();
        $data['all_periodos'] = $this->Periodo_model->get_all_periodo();

        $data['js'] = array('curso.js');
        $data['css'] = array('curso.css');

        $this->load->view('templates/header',$data);
        $this->load->view('curso/edit',$data);
        $this->load->view('templates/footer');
      }
    }

    else
    show_error('The curso you are trying to edit does not exist.');
  }

  /*
  * Deleting curso
  */
  function remove($id)
  {
    $curso = $this->Curso_model->get_curso($id);

    // check if the curso exists before trying to delete it
    if(isset($curso['id']))
    {
      $this->Curso_model->delete_curso($id);
      redirect('curso/index');
    }
    else
    show_error('The curso you are trying to delete does not exist.');
  }

}
