<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// is_logged_in();
	}
	public function index()
	{
		$data['title']='Inicio - CeciliaESMN';
		$data['page_title']='Pagina Principal';

		$this->load->view('templates/header',$data);
		$this->load->view('inicio',$data);
		$this->load->view('templates/footer',$data);
	}

	public function subir_archivos(){
		include_once APPPATH . "libraries/google-api-php-client/vendor/autoload.php";
		$this->config->load('google');
		$google_config = $this->config->item('google');
		$client = new Google_Client();
		$client->setApplicationName($google_config['application_name']);
		$client->setClientId($google_config['client_id']);
		$client->setClientSecret($google_config['client_secret']);
		$client->setRedirectUri($google_config['redirect_uri']);
		$client->setApprovalPrompt('auto');
		$client->setAccessType('offline');

	// token de auto-renovacion de google playground
		$refresh_token = $google_config['refresh_token'];

		// si el token esta presente en la sesion
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$client->setAccessToken($refresh_token);
		}

		if($client->isAccessTokenExpired()){  // si expiro
			// se renueva el token
			$refreshToken = $client->refreshToken($refresh_token['refresh_token']);
			$_SESSION['access_token'] = $refreshToken;
		}

// accedemos al servicio de google drive
		$service = new Google_Service_Drive($client);
		$id_folder=DRIVE_FOLDER_ID; //id de carpeta esmn_uploads en drive

		// subimos un archivo ligero. (no lo va a encontrar pero sube uno vacio igual)
		DEFINE("TESTFILE", 'testfile-small.txt');
		if (!file_exists(TESTFILE)) {
			$fh = fopen(TESTFILE, 'w');
			fseek($fh, 1024 * 1024);
			fwrite($fh, "!", 1);
			fclose($fh);
		}
		// This is uploading a file directly, with no metadata associated.
		// 'parents' define el directorio padre del archivo, es decir donde se va a alojar en drive
		$file = new Google_Service_Drive_DriveFile(array('parents' => array($id_folder)));
		$file->setName(TESTFILE);
		$result = $service->files->create(
			$file,
			array(
				'data' => file_get_contents(TESTFILE),
				'mimeType' => finfo_file(finfo_open(FILEINFO_MIME_TYPE), TESTFILE), //tipo de archivo
				'uploadType' => 'media',
			)
		);
		// Now lets try and send the metadata as well using multipart!
		$file = new Google_Service_Drive_DriveFile(array('parents' => array($id_folder)));
		$file->setName("Hello World!");
		$result2 = $service->files->create(
			$file,
			array(
				'data' => file_get_contents(TESTFILE),
				'mimeType' => 'application/octet-stream',
				'uploadType' => 'multipart',
				// 'parents' => array($id_folder)
			)
		);
		echo '<a href="https://drive.google.com/open?id='.$result->id.'" target="_blank">'.$result->name.'></a></br>';
		echo '<a href="https://drive.google.com/open?id='.$result2->id.'" target="_blank">'.$result2->name.'></a>';
	}

}
