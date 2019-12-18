<?php
class Asiste extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    is_logged_in();
    validar_acceso();
    $this->load->model('Asiste_model');
    $this->load->model('Curso_model');
  }

  function control($id_curso){
    $data['curso'] = $this->Curso_model->get_curso($id_curso);

    if(isset($data['curso']['id'])){
      $data['title'] = 'Asistencia - ESMN';
      $data['page_title'] = 'Asistencia';

      $data['asistencia'] = $this->Asiste_model->get_all_asiste($id_curso);
      if (empty($data['asistencia'])) {
        $this->session->set_flashdata('error', 'No existen personas inscriptas en este curso.');
        redirect('curso/index');
      }
      $data['diascursado'] = json_decode($data['asistencia'][0]['diascursado']);

      $data['css'] = array('curso.css');
      $data['js'] = array('asiste.js');

      $this->load->view('templates/header',$data);
      $this->load->view('asiste/control',$data);
      $this->load->view('templates/footer');

    }
    else
    show_error('The asiste you are trying to load does not exist.');
  }

  function imprimir_asistencia($id_curso){
    $data['curso'] = $this->Curso_model->get_curso($id_curso);
    $data['asistencia'] = $this->Asiste_model->get_all_asiste($id_curso);
    $data['diascursado'] = json_decode($data['asistencia'][0]['diascursado']);
    header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
    header('Content-Disposition: attachment; filename=nombre_archivo.xls');
    $this->load->view('asiste/imprimir_asistencia',$data);
  }

  function guardar(){
    if ($this->input->is_ajax_request() && !empty($_POST)) {
      $id_persona = $this->input->post('id_persona',TRUE);
      $id_curso = $this->input->post('id_curso',TRUE);
      $asistencia = $this->input->post('diascursado',TRUE);

      $diasFeriado = array_count_values(array_column($asistencia, 'state'))[1];
      $diasNormales = count($asistencia) - $diasFeriado;
      $diasTotal = count($asistencia);
      $diasAsiste = 0;

      for ($i=0; $i < $diasTotal; $i++) {
        if ($asistencia[$i]['state'] == 2 || $asistencia[$i]['state'] == 3) {
          $diasAsiste++;
        }
      }
      $porcentaje = round($diasAsiste*100/$diasNormales);
      $faltas = $diasNormales - $diasAsiste;

      $params = array(
        'asistencia' => json_encode($asistencia),
        'porcentaje' => $porcentaje,
        'faltas'=> $faltas,
      );

      $respuesta = $this->Asiste_model->update_asiste($id_persona,$id_curso,$params);
      echo json_encode($respuesta);
    }
    return false;
  }

}
