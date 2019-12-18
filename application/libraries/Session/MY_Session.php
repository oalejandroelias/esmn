<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Session extends CI_Session
{

public function __construct() {
    parent::__construct();
}

function sess_destroy() {
    //update the Online filed as required
    $CI =& get_instance();
    $id_usuario_actual = $CI->session->userdata('usuario_id');
    if ($id_usuario_actual) {
      $CI->db->update('usuario', array('online' => 0), array('id'=>$id_usuario_actual));
    }
    $ci_token = $CI->session->userdata('token');
    if ($ci_token) {
      $CI->db->update('usuario', array('ci_token' => ''), array('ci_token'=>$ci_token));
    }
    //call the parent
    parent::sess_destroy();
}

/**
 * Session regenerate
 *
 * Legacy CI_Session compatibility method
 *
 * @param	bool	$destroy	Destroy old session data flag
 * @return	void
 */
public function sess_regenerate($destroy = FALSE)
{
  if ($destroy) {
    file_put_contents("/var/www/html/esmn/log.sess_regenerate", json_encode($_SESSION));
  }
  $_SESSION['__ci_last_regenerate'] = time();
  session_regenerate_id($destroy);
}

}
