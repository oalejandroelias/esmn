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
        $this->load->model('Asiste_model');
        $this->load->model('Mesa_model');
    }
    
    /*
     * Listing of inscripcion_materia
     */
    function index()
    {
        //Index de inscripcion de mesas de materia
        $data['title'] = 'Inscripciones a Mesas - ESMN';
        $data['page_title'] = 'Inscripciones a Mesas';
        
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
                'fecha' =>$mesa['fecha']
            );
            
            $inscripcion_materia_id = $this->Inscripcion_materia_model->add_inscripcion_materia($params);
            $this->session->set_flashdata('crear', 'Nueva inscripción a mesa creada');
            redirect('inscripcion_materia/index');
        }
        else
        {
            $data['title'] = 'Nueva Inscripcion - ESMN';
            $data['page_title'] = 'Inscribir un alumno a una mesa';
            
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
                //Obtengo los datos de mesa
                $mesa=$this->Mesa_model->get_mesa($this->input->post('id_mesa'));
                $params = array(
                    'id_persona' => $this->input->post('id_persona'),
                    'id_curso' => $this->input->post('id_curso'),
                    'id_materia' => $mesa['id_materia'],
                    'id_mesa' =>  $this->input->post('id_mesa'),
                    'id_estado_inicial' => $this->input->post('id_estado_inicial'),
                    'calificacion' => null,
                    'fecha' => $mesa['fecha'],
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
                $data['all_mesas'] = $this->Mesa_model->get_all_mesas();
                $data['all_materias'] = $this->Materia_model->get_all_materias();
                $data['all_estados'] = $this->Estado_inscripcion_inicial_model->get_all_estado_inscripcion_inicial_mesa();
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
            $this->session->set_flashdata('eliminar', 'Inscripcion a mesa anulada');
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
        $this->form_validation->set_rules('id_curso','Curso de Materia','required|integer');
        $this->form_validation->set_rules('id_persona','Persona / Alumno','required|integer|callback_check_inscripcion['.$this->input->post('id_curso').']');
        $this->form_validation->set_message('check_inscripcion','La persona ya se encuentra registrada en este curso!');
        
        if($this->form_validation->run())
        {
            $curso=$this->Curso_model->get_curso($this->input->post('id_curso'));
            $params = array(
                'id_persona' => $this->input->post('id_persona'),
                'id_curso' => $this->input->post('id_curso'),
                'id_materia' => $this->input->post('id_materia'),
                'id_mesa' => null,
                'id_estado_inicial' => 1, // 1 = CURSANDO
                'calificacion' => null,
                'fecha' =>null,
                'id_estado_final' => null,
            );
            
            $inscripcion_materia_id = $this->Inscripcion_materia_model->add_inscripcion_materia($params);
            
            // crear registro de "asiste a curso"
            $params_asiste = array(
                'id_curso' => $this->input->post('id_curso'),
                'id_persona' => $this->input->post('id_persona'),
                'porcentaje' => null,
            );
            $id_asiste = $this->Asiste_model->add_asiste($params_asiste);
            
            $this->session->set_flashdata('crear', 'Nueva inscripción a cursado creada');
            redirect('inscripcion_materia/index_inscripcion_cursado');
        }
        else
        {
            $data['title'] = 'Nueva Inscripcion - ESMN';
            $data['page_title'] = 'Inscribir un alumno a un curso';
            
            $data['personas'] = $this->Persona_model->get_all_personas();
            $data['all_materias'] = $this->Materia_model->get_all_materias();
            $data['all_estados_inicial'] = $this->Estado_inscripcion_inicial_model->get_all_estado_inscripcion_inicial();
            $data['all_cursos'] = $this->Curso_model->get_all_curso();
            
            $data['js'] = array('inscripcion_cursado.js');
            
            $this->load->view('templates/header',$data);
            $this->load->view('inscripcion_materia/add_inscripcion_cursado',$data);
            $this->load->view('templates/footer');
        }
    }
    
    // funcion comprobar si una persona ya esta registrada en un curso
    function check_inscripcion($id_persona,$id_curso){
        $query = $this->Inscripcion_materia_model->check_inscripcion($id_persona,$id_curso);
        return (!empty($query)) ? false : true;
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
                    'id_estado_inicial' => $data['inscripcion_materia']['id_estado_inicial']
                );
                
                $this->Inscripcion_materia_model->update_inscripcion_materia($id,$params);
                $this->session->set_flashdata('editar', 'Se guardaron los cambios');
                redirect('inscripcion_materia/index_inscripcion_cursado');
            }
            else
            {
                $data['title'] = 'Editar Inscripcion - ESMN';
                $data['page_title'] = 'Editar inscripcion al curso';
                
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
