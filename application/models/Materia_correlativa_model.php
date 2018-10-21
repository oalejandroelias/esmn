<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Materia_correlativa_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get materia_correlativa by id_materia
     */
    function get_materia_correlativa($id_materia)
    {
        return $this->db->get_where('materia_correlativa',array('id_materia'=>$id_materia))->row_array();
    }

    /*
     * Get all materias_correlativas count
     */
    function get_all_materias_correlativas_count()
    {
        $this->db->from('materia_correlativa');
        return $this->db->count_all_results();
    }

    /*
     * Get all materias_correlativas
     */
    function get_all_materias_correlativas($params = array())
    {
        $this->db->order_by('id_materia', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('materia_correlativa')->result_array();
    }

    /*
     * function to add new materia_correlativa
     */
    function add_materia_correlativa($params)
    {
        $this->db->insert('materia_correlativa',$params);
        return $this->db->insert_id();
    }

    /*
     * function to update materia_correlativa
     */
    function update_materia_correlativa($id_materia,$params)
    {
        $this->db->where('id_materia',$id_materia);
        return $this->db->update('materia_correlativa',$params);
    }

    /*
     * function to delete materia_correlativa
     */
    function delete_materia_correlativa($id_materia)
    {
        return $this->db->delete('materia_correlativa',array('id_materia'=>$id_materia));
    }
}
