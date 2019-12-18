<?php

class File_upload extends Exception
{
  public function __construct() {
    parent::__construct(); 
  }

  function upload_exeption($code)
  {
    switch ($code) {
      case 0:
      $message = array('code' => 'UPLOAD_ERR_OK', 'msg' => 'No hay error, fichero subido con éxito.');
      break;
      case 1:
      $message = array('code' => 'UPLOAD_ERR_INI_SIZE', 'msg' => 'El fichero subido excede la directiva upload_max_filesize de php.ini.');
      break;
      case 2:
      $message = array('code' => 'UPLOAD_ERR_FORM_SIZE', 'msg' => 'El fichero subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML.');
      break;
      case 3:
      $message = array('code' => 'UPLOAD_ERR_PARTIAL', 'msg' => 'El fichero fue sólo parcialmente subido.');
      break;
      case 4:
      $message = array('code' => 'UPLOAD_ERR_NO_FILE', 'msg' => 'No se subió ningún fichero.');
      break;
      case 6:
      $message = array('code' => 'UPLOAD_ERR_NO_TMP_DIR', 'msg' => 'Falta la carpeta temporal.');
      break;
      case 7:
      $message = array('code' => 'UPLOAD_ERR_CANT_WRITE', 'msg' => 'No se pudo escribir el fichero en el disco.');
      break;
      case 8:
      $message = array('code' => 'UPLOAD_ERR_EXTENSION', 'msg' => 'Una extensión de PHP detuvo la subida de ficheros.');
      break;

      default:
      $message = "Unknown upload error";
      break;
    }
    return $message;
  }
}
