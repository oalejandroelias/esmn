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

function validar_acceso()
{
    $CI =& get_instance();
    
    
    //$clase=$CI->uri->segments[1];
    $clase=$CI->uri->rsegments[1];
    $accion2=$CI->uri->rsegments[2];

    $permisos=json_decode($_SESSION['permisos']);

    //$existe_permiso=$permisos->$clase->$accion;
    $existe_permiso=$permisos->$clase->$accion2;

    if(!isset($existe_permiso))
    {
        //Si existe segments[2] es porque viene de un edit, add, etc.
        if(!isset($CI->uri->segments[2]))
        {
            redirect('inicio');
            exit;
        }
        else {
            redirect($clase);
            exit;
        }
        
    }
}


function validar_botones($accion)
{
    $CI =& get_instance();
    
    
    //$clase=$CI->uri->segments[1];
    $clase=$CI->uri->rsegments[1];
    //$accion2=$CI->uri->rsegments[2];
    
    $permisos=json_decode($_SESSION['permisos']);
    
    //$existe_permiso=$permisos->$clase->$accion;
    if (isset($permisos->$clase->$accion))
    {
        return true;
    }
    else {
        return false;
    }
    
    
}
