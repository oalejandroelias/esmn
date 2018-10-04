<?php
// comprobar session
function is_logged_in() {
    // Get current CodeIgniter instance
    $CI =& get_instance();
    $request_uri = $CI->uri->uri_string;
    $request_uri = str_replace('/','-',$request_uri);
    // We need to use $CI->session instead of $this->session
    $logued = $CI->session->userdata('is_logued_in');
    if (!isset($logued)) {
      // redirect(base_url('login'));
      redirect('login/index/'.$request_uri);
    }else {
      return true;
    }
}

function is_logged_in_login(){
    $CI =& get_instance();
    $logued = $CI->session->userdata('is_logued_in');
    if ($CI->router->fetch_class()=='login' && isset($logued)) {
        redirect(base_url('inicio'));
    }
}
