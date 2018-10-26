<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Materia extends CI_Controller{
  // funcion contructor de controlador clase materia
  function __construct()
  {
    parent::__construct();
    validar_acceso();
    is_logged_in();
    $this->load->model('Materia_model');
    $this->load->model('Carrera_model');
  }

  /*
  * listado de materias
  */
  function index()
  {
    $params['limit'] = RECORDS_PER_PAGE;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('materia/index?');
    $config['total_rows'] = $this->Materia_model->get_all_materias_count();
    $this->pagination->initialize($config);

    $data['materias'] = $this->Materia_model->get_all_materias($params);

    $data['title'] = 'Materias - ESMN';
    $data['page_title'] = 'Materia';

    //validar botones
    $data['boton_edit']=validar_botones('edit');
    $data['boton_add']=validar_botones('add');
    $data['boton_remove']=validar_botones('remove');

    // script de correlatividades
    $data['js'] = array('materia_index.js');

    $this->load->view('templates/header',$data);
    $this->load->view('materia/index',$data);
    $this->load->view('templates/footer');
  }

  /*
  * funcion que permite agregar una nueva materia
  */
  function add()
  {
    $this->form_validation->set_rules('carrera_id','Codigo de Plan','required|max_length[11]');
    $this->form_validation->set_rules('nombre','Nombre','required|max_length[128]|is_unique[materia.nombre]');
    $this->form_validation->set_rules('codigo_anio','Codigo Anio','max_length[24]');
    $this->form_validation->set_rules('regimen_cursado','Regimen Cursado','max_length[24]');
    $this->form_validation->set_rules('regimen_aprobacion','Regimen Aprobacion','max_length[24]');
    $this->form_validation->set_rules('carga_horaria','Carga Horaria','integer');
    $this->form_validation->set_rules('tipo_catedra','Tipo Catedra','max_length[24]');

    if($this->form_validation->run())
    {
      $params = array(
        'id_carrera' => $this->input->post('carrera_id'),
        'nombre' => $this->input->post('nombre'),
        'codigo_anio' => $this->input->post('codigo_anio'),
        'regimen_cursado' => $this->input->post('regimen_cursado'),
        'regimen_aprobacion' => $this->input->post('regimen_aprobacion'),
        'carga_horaria' => $this->input->post('carga_horaria'),
        'tipo_catedra' => $this->input->post('tipo_catedra'),
      );

      $materia_id = $this->Materia_model->add_materia($params);
      $this->session->set_flashdata('crear', 'Nueva materia creada');
      redirect('materia/index');
    }
    else
    {
      $data['title'] = 'Materia - ESMN';
      $data['page_title'] = 'Materia';
      $data['all_carreras'] = $this->Carrera_model->get_all_carreras();

      $this->load->view('templates/header',$data);
      $this->load->view('materia/add',$data);
      $this->load->view('templates/footer');
    }
  }

  /*
  * funcion que permite editar una Materia
  */
  function edit($id)
  {
    //Comprueba si existe la materia antes de intentar editarla.
    $data['materia'] = $this->Materia_model->get_materia($id);

    if(isset($data['materia']['id']))
    {

      $this->form_validation->set_rules('id_carrera','Id Carrera','required|max_length[11]');
      $this->form_validation->set_rules('nombre','Nombre','required|max_length[128]');
      $this->form_validation->set_rules('codigo_anio','Codigo Anio','max_length[24]');
      $this->form_validation->set_rules('regimen_cursado','Regimen Cursado','max_length[24]');
      $this->form_validation->set_rules('regimen_aprobacion','Regimen Aprobacion','max_length[24]');
      $this->form_validation->set_rules('carga_horaria','Carga Horaria','integer');
      $this->form_validation->set_rules('tipo_catedra','Tipo Catedra','max_length[24]');

      if($this->form_validation->run())
      {
        $params = array(
          'id_carrera' => $this->input->post('id_carrera'),
          'nombre' => $this->input->post('nombre'),
          'codigo_anio' => $this->input->post('codigo_anio'),
          'regimen_cursado' => $this->input->post('regimen_cursado'),
          'regimen_aprobacion' => $this->input->post('regimen_aprobacion'),
          'carga_horaria' => $this->input->post('carga_horaria'),
          'tipo_catedra' => $this->input->post('tipo_catedra'),
        );

        $this->Materia_model->update_materia($id,$params);
        $this->session->set_flashdata('editar', 'Se guardaron los cambios');
        redirect('materia/index');
      }
      else
      {
        $data['title'] = 'Materia - ESMN';
        $data['page_title'] = 'Materia';

        $this->load->view('templates/header',$data);
        $this->load->view('materia/edit',$data);
        $this->load->view('templates/footer');
      }
    }
    else
    show_error('La materia que intenta editar, no existe.');
  }

  /*
  * Funcion que permite eliminar una materia
  */
  function remove($id)
  {
    $materia = $this->Materia_model->get_materia($id);

    // Comprueba si la materia existe antes de intentar borrarla.
    if(isset($materia['id']))
    {
      $this->Materia_model->delete_materia($id);
      $this->session->set_flashdata('eliminar', 'Materia eliminada');
      redirect('materia/index');
    }
    else
    show_error('La materia que está intentando eliminar no existe.');
  }

}
