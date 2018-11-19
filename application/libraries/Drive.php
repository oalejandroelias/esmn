<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drive{
  // public function __construct(){
  //   parent::__construct();
  //   is_logged_in();
  //   validar_acceso();
  // }

  public function upload_file($files = array()){
    include_once APPPATH . "libraries/google-api-php-client/vendor/autoload.php";
    $CI =& get_instance(); //codeigniter superobject to interact with native resources
    $CI->config->load('google');
    $google_config = $CI->config->item('google');
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
    // DEFINE("TESTFILE", 'testfile-small.txt');
    // if (!file_exists(TESTFILE)) {
    //   $fh = fopen(TESTFILE, 'w');
    //   fseek($fh, 1024 * 1024);
    //   fwrite($fh, "!", 1);
    //   fclose($fh);
    // }
    // This is uploading a file directly, with no metadata associated.
    // 'parents' define el directorio padre del archivo, es decir donde se va a alojar en drive
    $resp = array();
    foreach ($files as $file) {
      $google_file = new Google_Service_Drive_DriveFile(array('parents' => array($id_folder)));
      $google_file->setName($file['file_name']);

      $result = $service->files->create(
        $google_file,
        array(
          'data' => file_get_contents($file['file_path']),
          'mimeType' => finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file['file_path']), //tipo de archivo
          'uploadType' => 'multipart',
        )
      );
      
      $params = array('id'=>$result->id,'name'=>$result->name);
      array_push($resp,$params);
    }

    return $resp;
  }
}
