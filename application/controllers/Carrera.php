<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Carrera extends CI_Controller{
  //constructor de clase carrera
  function __construct()
  {
    parent::__construct();
    validar_acceso();
    is_logged_in();
    $this->load->model('Carrera_model');
  }

  /*
  * Listado de carreras
  */
  function index()
  {
    $data['title'] = 'Carrera - ESMN';
    $data['page_title'] = 'Carrera';
    $params['limit'] = RECORDS_PER_PAGE;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('carrera/index?');
    $config['total_rows'] = $this->Carrera_model->get_all_carreras_count();
    $this->pagination->initialize($config);

    $data['carreras'] = $this->Carrera_model->get_all_carreras($params);
    //Botones de acciones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');
    $this->load->view('templates/header',$data);
    $this->load->view('carrera/index',$data);
    $this->load->view('templates/footer');
  }

  /*
  * Funcion que permite agregar nueva carrera al listado
  */
  function add()
  {
    $this->form_validation->set_rules('id','Codigo de Plan','required|max_length[11]|is_unique[carrera.id]');
    $this->form_validation->set_rules('nombre','Nombre','required|max_length[128]');
    $this->form_validation->set_rules('acta','Acta','max_length[256]');
    $this->form_validation->set_rules('id_nivel','Id Nivel','required');

    if($this->form_validation->run())
    {
      $params = array(
        'id' => $this->input->post('id'),
        'id_nivel' => $this->input->post('id_nivel'),
        'nombre' => $this->input->post('nombre'),
        'acta' => $this->input->post('acta'),
        'fecha' => $this->input->post('fecha'),
      );

      $carrera_id = $this->Carrera_model->add_carrera($params);
      redirect('carrera/index');
    }
    else
    {
      $this->load->model('Nivel_model');
      $data['all_niveles'] = $this->Nivel_model->get_all_niveles();
      $data['js'] = array('carrera_add.js');

      $data['title'] = 'Carrera - ESMN';
      $data['page_title'] = 'Carrera';

      $this->load->view('templates/header',$data);
      $this->load->view('carrera/add',$data);
      $this->load->view('templates/footer',$data);
    }
  }

  /*
  * Metodo para editar del listado una carrera
  */
  function edit($id)
  {
    // controla que la carrera exista
    $data['carrera'] = $this->Carrera_model->get_carrera($id);

    if(isset($data['carrera']['id']))
    {
      $this->form_validation->set_rules('id','Codigo de Plan','required|max_length[11]');
      $this->form_validation->set_rules('nombre','Nombre','required|max_length[128]');
      $this->form_validation->set_rules('acta','Acta','max_length[256]');
      $this->form_validation->set_rules('id_nivel','Id Nivel','required');

      $carrera_exist = $this->Carrera_model->get_carrera($this->input->post('id'));
      if($this->form_validation->run() && ($data['carrera']['id'] == $this->input->post('id') || !isset($carrera_exist['id'])))
      {
        $params = array(
          'id' => $this->input->post('id'),
          'id_nivel' => $this->input->post('id_nivel'),
          'nombre' => $this->input->post('nombre'),
          'acta' => $this->input->post('acta'),
          'fecha' => $this->input->post('fecha'),
        );

        // if ($data['carrera']['id'] == $this->input->post('id') || !isset($carrera_exist['id'])) {
          $this->Carrera_model->update_carrera($id,$params);
          redirect('carrera/index');
        // }

      }
      else
      {
        $this->load->model('Nivel_model');
        $data['all_niveles'] = $this->Nivel_model->get_all_niveles();

        $data['title'] = 'Carrera - ESMN';
        $data['page_title'] = 'Carrera';
        $this->load->view('templates/header',$data);
        $this->load->view('carrera/edit',$data);
        $this->load->view('templates/footer');
      }
    }
    else
    show_error('No se puede borrar la carrera.');
  }

  /*
  * Funcion que permite eliminar una carrera si esta exite
  */
  function remove($id)
  {
    $carrera = $this->Carrera_model->get_carrera($id);

    // Comprueba si existe la carrera antes de intentar borrarla.
    if(isset($carrera['id']))
    {
      $this->Carrera_model->delete_carrera($id);
      redirect('carrera/index');
    }
    else
    show_error('La carrera que quiere borrar no existe.');
  }

}
