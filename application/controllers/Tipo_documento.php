<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Tipo_documento extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        validar_acceso();
        is_logged_in();
        $this->load->model('Tipo_documento_model');
    }

    /*
     * Listing of tipo_documento
     */
    function index()
    {
        $data['tipo_documento'] = $this->Tipo_documento_model->get_all_tipo_documento();    

        $data['_view'] = 'tipo_documento/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new tipo_documento
     */
    function add()
    {
        $this->load->library('form_validation');

		$this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');

		if($this->form_validation->run())
        {
            $params = array(
				'nombre' => $this->input->post('nombre'),
            );

            $tipo_documento_id = $this->Tipo_documento_model->add_tipo_documento($params);
            redirect('tipo_documento/index');
        }
        else
        {
            $data['_view'] = 'tipo_documento/add';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Editing a tipo_documento
     */
    function edit($id)
    {
        // check if the tipo_documento exists before trying to edit it
        $data['tipo_documento'] = $this->Tipo_documento_model->get_tipo_documento($id);

        if(isset($data['tipo_documento']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('nombre','Nombre','required|max_length[64]');

			if($this->form_validation->run())
            {
                $params = array(
					'nombre' => $this->input->post('nombre'),
                );

                $this->Tipo_documento_model->update_tipo_documento($id,$params);
                redirect('tipo_documento/index');
            }
            else
            {
                $data['_view'] = 'tipo_documento/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The tipo_documento you are trying to edit does not exist.');
    }

    /*
     * Deleting tipo_documento
     */
    function remove($id)
    {
        $tipo_documento = $this->Tipo_documento_model->get_tipo_documento($id);

        // check if the tipo_documento exists before trying to delete it
        if(isset($tipo_documento['id']))
        {
            $this->Tipo_documento_model->delete_tipo_documento($id);
            redirect('tipo_documento/index');
        }
        else
            show_error('The tipo_documento you are trying to delete does not exist.');
    }

}
