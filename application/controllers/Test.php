<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		$data['title']='test';
		// $this->load->view('templates/header',$data);
		// $this->load->view('test',$data);
		setlocale(LC_TIME,"es_ES.UTF-8");
		echo iconv('ISO-8859-2', 'UTF-8', strftime("%d de %B de %Y", strtotime('1992-12-10')));
		// $this->load->view('templates/footer',$data);
	}

	public function get_all_methods(){

	}
}
