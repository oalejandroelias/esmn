<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		  $this->load->model('Persona_model');
		print_r($this->Persona_model->get_historial_persona_mesa(1,false,13,"2018-12-10",true));
	}
}
