<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Curso_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get curso by id
     */
    function get_curso($id)
    {
        return $this->db->get_where('curso',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all curso
     */
    function get_all_curso()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('curso')->result_array();
    }
        
    /*
     * function to add new curso
     */
    function add_curso($params)
    {
        $this->db->insert('curso',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update curso
     */
    function update_curso($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('curso',$params);
    }
    
    /*
     * function to delete curso
     */
    function delete_curso($id)
    {
        return $this->db->delete('curso',array('id'=>$id));
    }
}
