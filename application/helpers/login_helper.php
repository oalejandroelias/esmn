<?php
// comprobar session
function is_logged_in() {
    // Get current CodeIgniter instance
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $logued = $CI->session->userdata('is_logued_in');
    if ( !isset($logued) || false)
    // $CI->db->get_where('usuario',array('id'=>$CI->session->userdata('usuario_id')))->row_array()['online'] == '0')
    {
      $request_uri = $CI->uri->uri_string;
      $request_uri = str_replace('/','-',$request_uri);
      redirect('login/logout/'.$request_uri);
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
    $clase=ucfirst($CI->uri->rsegments[1]);
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

function validar_opcion($opcion)
{
    $CI =& get_instance();
    $salida=false;
    $clase=$opcion;
    $accion="index";

    $permisos=json_decode($_SESSION['permisos']);

    if(isset($permisos->$clase->$accion))
    {
        //Si existe segments[2] es porque viene de un edit, add, etc.
        $salida=true;

    }
    else
    {
        $salida=false;
    }

    return $salida;
}
function validar_opcion_inscripcion_materia($opcion)
{
    $CI =& get_instance();
    $salida=false;

    $clase='Inscripcion_materia';
    $accion=$opcion;

    $permisos=json_decode($_SESSION['permisos']);

    if(isset($permisos->$clase->$accion))
    {
        //Si existe segments[2] es porque viene de un edit, add, etc.
        $salida=true;

    }
    else
    {
        $salida=false;
    }

    return $salida;
}

function validar_botones($accion)
{
    $CI =& get_instance();


    //$clase=$CI->uri->segments[1];

    $clase=ucfirst($CI->uri->rsegments[1]);
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
