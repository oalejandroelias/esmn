<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Asiste_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get asiste by id
     */
    function get_asiste($id)
    {
        return $this->db->get_where('asiste',array('id'=>$id))->row_array();
    }

    /*
     * Get all asiste
     */
    function get_all_asiste()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('asiste')->result_array();
    }

    /*
     * function to add new asiste
     */
    function add_asiste($params)
    {
        $this->db->insert('asiste',$params);
        return $this->db->insert_id();
    }

    /*
     * function to update asiste
     */
    function update_asiste($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('asiste',$params);
    }

    /*
     * function to delete asiste
     */
    function delete_asiste($id)
    {
        return $this->db->delete('asiste',array('id'=>$id));
    }
}