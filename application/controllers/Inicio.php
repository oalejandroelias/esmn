<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	public function __construct(){
		parent::__construct();
		is_logged_in();
		validar_acceso();
	}

	public function index()
	{
		$data['title']='Inicio - CeciliaESMN';
		$data['page_title']='Pagina Principal';

		$this->load->view('templates/header',$data);
		$this->load->view('inicio',$data);
		$this->load->view('templates/footer',$data);
	}

}
