<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index($id_curso)
	{
		$this->load->model('Curso_model');
		$this->load->model('Asiste_model');
		$data['curso'] = $this->Curso_model->get_curso($id_curso);
		$data['asistencia'] = $this->Asiste_model->get_all_asiste($id_curso);
		$data['diascursado'] = json_decode($data['asistencia'][0]['diascursado']);
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=nombre_archivo.xls');
		 $this->load->view('test',$data);
	}
}
