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
        $this->load->model('Estado_inscripcion_inicial_model');
        $this->load->model('Curso_model');
        $this->load->model('Mesa_model');
    }

    /*
     * Listing of inscripcion_materia
     */
    function index()
    {
        //Index de inscripcion de mesas de materia
        $data['title'] = 'Inscripciones a Materias - ESMN';
        $data['page_title'] = 'Inscripciones a Materias';

        $data['inscripcion_materia'] = $this->Inscripcion_materia_model->get_all_inscripcion_materia_mesa();

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
        $this->form_validation->set_rules('id_mesa','Mesa','required|max_length[11]');
        $this->form_validation->set_rules('id_estado_inicial','Estado','required|max_length[11]');

        if($this->form_validation->run())
        {
            
            $mesa=$this->Mesa_model->get_mesa($this->input->post('id_mesa'));
            $params = array(
                'id_persona' => $this->input->post('id_persona'),
                'id_curso' => null,
                'id_materia' => $mesa['id_materia'],
                'id_mesa' => $this->input->post('id_mesa'),
                'id_estado_inicial' => $this->input->post('id_estado_inicial'),
                'calificacion' => null,
                'fecha' =>null
            );

            $inscripcion_materia_id = $this->Inscripcion_materia_model->add_inscripcion_materia($params);
            $this->session->set_flashdata('crear', 'Nueva inscripción a mesa creada');
            redirect('inscripcion_materia/index');
        }
        else
        {
            $data['title'] = 'Nueva Inscripcion - ESMN';
            $data['page_title'] = 'Inscribir un alumno a una materia';

            $data['personas'] = $this->Persona_model->get_all_personas();
            $data['all_mesas'] = $this->Mesa_model->get_all_mesas();
            $data['all_materias'] = $this->Materia_model->get_all_materias();
            $data['all_estados'] = $this->Estado_inscripcion_inicial_model->get_all_estado_inscripcion_inicial_mesa();

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
                $mesa=$this->Mesa_model->get_mesa($this->input->post('id_mesa'));
                $params = array(
					'id_persona' => $this->input->post('id_persona'),
					'id_curso' => $this->input->post('id_curso'),
					'id_materia' => $this->input->post('id_materia'),
					'id_mesa' => $this->input->post('id_mesa'),
					'id_estado_inicial' => $this->input->post('id_estado_inicial'),
					'calificacion' => $this->input->post('calificacion'),
					'fecha' => $this->input->post('fecha'),
                );

                $this->Inscripcion_materia_model->update_inscripcion_materia($id,$params);
                $this->session->set_flashdata('editar', 'Se guardaron los cambios');
                redirect('inscripcion_materia/index');
            }
            else
            {
                $data['title'] = 'Nueva Inscripcion - ESMN';
                $data['page_title'] = 'Editar inscripcion de mesa';
                
                $data['personas'] = $this->Persona_model->get_all_personas();
                $data['all_materias'] = $this->Materia_model->get_all_materias();
                $this->load->view('templates/header',$data);
                $this->load->view('inscripcion_materia/edit',$data);
                $this->load->view('templates/footer');
                
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
            $this->session->set_flashdata('eliminar', 'Carrera eliminada');
            redirect('inscripcion_materia/index');
        }
        else
            show_error('The inscripcion_materia you are trying to delete does not exist.');
    }
    
    function index_inscripcion_cursado()
    {
        //index de inscripcion de cursados de materia
        $data['title'] = 'Inscripciones a cursado de Materias - ESMN';
        $data['page_title'] = 'Inscripciones a cursado de  Materias';
        
        $data['inscripcion_materia'] = $this->Inscripcion_materia_model->get_all_inscripcion_materia_cursado();
        
        //Botones de acciones
        $data['boton_edit']=validar_botones('edit');
        $data['boton_add']=validar_botones('add');
        $data['boton_remove']=validar_botones('remove');
        
        $this->load->view('templates/header',$data);
        $this->load->view('inscripcion_materia/index_inscripcion_cursado',$data);
        $this->load->view('templates/footer');
    }
    
    function add_inscripcion_cursado()
    {
        $this->form_validation->set_rules('id_persona','Persona / Alumno','required|integer');
        $this->form_validation->set_rules('id_curso','Curso de Materia','required|max_length[11]');
        
        
        
        if($this->form_validation->run())
        {
            $curso=$this->Curso_model->get_curso($this->input->post('id_curso'));
            $params = array(
                'id_persona' => $this->input->post('id_persona'),
                'id_curso' => $this->input->post('id_curso'),
                'id_materia' => $curso['id_materia'],
                'id_mesa' => null,
                'id_estado_inicial' => 1,
                'calificacion' => null,
                'fecha' =>null,
                'id_estado_final' => 0,
            );
            
            $inscripcion_materia_id = $this->Inscripcion_materia_model->add_inscripcion_materia($params);
            $this->session->set_flashdata('crear', 'Nueva inscripción a cursado creada');
            redirect('inscripcion_materia/index_inscripcion_cursado');
        }
        else
        {
            $data['title'] = 'Nueva Inscripcion - ESMN';
            $data['page_title'] = 'Inscribir un alumno a una materia';
            
            $data['personas'] = $this->Persona_model->get_all_personas();
            $data['all_materias'] = $this->Materia_model->get_all_materias();
            $data['all_estados_inicial'] = $this->Estado_inscripcion_inicial_model->get_all_estado_inscripcion_inicial();
            $data['all_cursos'] = $this->Curso_model->get_all_curso();
            
            $this->load->view('templates/header',$data);
            $this->load->view('inscripcion_materia/add_inscripcion_cursado',$data);
            $this->load->view('templates/footer');
        }
    }
    
    function edit_inscripcion_cursado($id)
    {
        // check if the inscripcion_materia exists before trying to edit it
        $data['inscripcion_materia'] = $this->Inscripcion_materia_model->get_inscripcion_materia($id);
        //Obtengo los datos del curso
        
        if(isset($data['inscripcion_materia']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)
            {
                //Obtengo los datos del nuevo curso
                $curso=$this->Curso_model->get_curso($this->input->post('id_curso'));
                $params = array(
                    'id_persona' => $this->input->post('id_persona'),
                    'id_curso' => $this->input->post('id_curso'),
                    'id_materia' => $curso['id_materia'],
                    'id_mesa' => null,
                    'id_estado_inicial' => 1,
                    'calificacion' => null,
                    'fecha' => null,
                    'id_estado_inicial' => 0
                );
                
                $this->Inscripcion_materia_model->update_inscripcion_materia($id,$params);
                $this->session->set_flashdata('editar', 'Se guardaron los cambios');
                redirect('inscripcion_materia/index_inscripcion_cursado');
            }
            else
            {
                $data['title'] = 'Eidtar Inscripciones a Materias - ESMN';
                $data['page_title'] = 'Inscripciones a Materias';
                
                $data['personas'] = $this->Persona_model->get_all_personas();
                $data['all_materias'] = $this->Materia_model->get_all_materias();
                $data['all_estados_inicial'] = $this->Estado_inscripcion_inicial_model->get_all_estado_inscripcion_inicial();
                $data['all_cursos'] = $this->Curso_model->get_all_curso();
                
                $this->load->view('templates/header',$data);
                $this->load->view('inscripcion_materia/edit_inscripcion_cursado',$data);
                $this->load->view('templates/footer'); 
                
            }
        }
        else
            show_error('The inscripcion_materia you are trying to edit does not exist.');
    }
    
    function remove_inscripcion_cursado($id)
    {
        $inscripcion_materia = $this->Inscripcion_materia_model->get_inscripcion_materia($id);
        
        // check if the inscripcion_materia exists before trying to delete it
        if(isset($inscripcion_materia['id']))
        {
            $this->Inscripcion_materia_model->delete_inscripcion_materia($id);
            
            $this->session->set_flashdata('eliminar', 'Carrera eliminada');
            redirect('inscripcion_materia/index_inscripcion_cursado');

        }
        else
            show_error('The inscripcion_materia you are trying to delete does not exist.');
    }

}
