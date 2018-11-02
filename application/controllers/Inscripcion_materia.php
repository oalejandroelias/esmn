<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Inscripcion_materia extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        is_logged_in();
    		validar_acceso();
        $this->load->model('Persona_model');
        $this->load->model('Inscripcion_materia_model');
        $this->load->model('Materia_model');
    }

    /*
     * Listing of inscripcion_materia
     */
    function index()
    {
        $data['title'] = 'Inscripciones a Materias - ESMN';
        $data['page_title'] = 'Inscripciones a Materias';

        $data['inscripcion_materia'] = $this->Inscripcion_materia_model->get_all_inscripcion_materia();

        //Botones de acciones
        $data['boton_edit']=validar_botones('edit');
        $data['boton_add']=validar_botones('add');
        $data['boton_remove']=validar_botones('remove');

        $this->load->view('templates/header',$data);
        $this->load->view('inscripcion_materia/index',$data);
        $this->load->view('templates/footer');
    }

    /*
     * Adding a new inscripcion_materia
     */
    function add()
    {
        $this->form_validation->set_rules('id_persona','Persona / Alumno','required|integer');
        $this->form_validation->set_rules('id_materia','materia / Plan','required|max_length[11]');

        if($this->form_validation->run())
        {
            $params = array(
                'id_persona' => $this->input->post('id_persona'),
                'id_materia' => $this->input->post('id_materia'),
            );

            $inscripcion_materia_id = $this->Inscripcion_materia_model->add_inscripcion_materia($params);
            redirect('inscripcion_materia/index');
        }
        else
        {
            $data['title'] = 'Nueva Inscripcion - ESMN';
            $data['page_title'] = 'Inscribir un alumno a una materia';

            $data['personas'] = $this->Persona_model->get_all_personas();
            $data['all_materias'] = $this->Materia_model->get_all_materias();

            $this->load->view('templates/header',$data);
            $this->load->view('inscripcion_materia/add',$data);
            $this->load->view('templates/footer');
        }
    }

    /*
     * Editing a inscripcion_materia
     */
    function edit($id)
    {
        // check if the inscripcion_materia exists before trying to edit it
        $data['inscripcion_materia'] = $this->Inscripcion_materia_model->get_inscripcion_materia($id);

        if(isset($data['inscripcion_materia']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)
            {
                $params = array(
					'id_persona' => $this->input->post('id_persona'),
					'id_curso' => $this->input->post('id_curso'),
					'id_materia' => $this->input->post('id_materia'),
					'id_mesa' => $this->input->post('id_mesa'),
					'id_estado' => $this->input->post('id_estado'),
					'calificacion' => $this->input->post('calificacion'),
					'fecha' => $this->input->post('fecha'),
                );

                $this->Inscripcion_materia_model->update_inscripcion_materia($id,$params);
                redirect('inscripcion_materia/index');
            }
            else
            {
                $data['_view'] = 'inscripcion_materia/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The inscripcion_materia you are trying to edit does not exist.');
    }

    /*
     * Deleting inscripcion_materia
     */
    function remove($id)
    {
        $inscripcion_materia = $this->Inscripcion_materia_model->get_inscripcion_materia($id);

        // check if the inscripcion_materia exists before trying to delete it
        if(isset($inscripcion_materia['id']))
        {
            $this->Inscripcion_materia_model->delete_inscripcion_materia($id);
            redirect('inscripcion_materia/index');
        }
        else
            show_error('The inscripcion_materia you are trying to delete does not exist.');
    }

}
