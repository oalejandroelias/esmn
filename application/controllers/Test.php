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

	public function get_all_methods(){
		$this->load->helper('file');

$controllers = get_filenames( APPPATH . 'controllers/' );

foreach( $controllers as $k => $v )
{
		if( strpos( $v, '.php' ) === FALSE)
		{
				unset( $controllers[$k] );
		}
}

echo '<ul>';

foreach( $controllers as $controller )
{
		echo '<li>"' . str_replace( '.php', '', $controller ) . '":{<ul>';

		include_once APPPATH . 'controllers/' . $controller;

		$methods = get_class_methods( str_replace( '.php', '', $controller ) );

		foreach( $methods as $method )
		{
				echo '<li>"' . $method . '":"1",</li>';
		}

		echo '</ul></li>},';
}

echo '</ul>';
	}
}
