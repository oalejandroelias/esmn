<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function index()
	{
		$data['title']='test';
		// $this->load->view('templates/header',$data);
		$this->load->view('test',$data);
		// $this->load->view('templates/footer',$data);
	}
}
