<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Tribunal_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get tribunal by id_mesa
     */
    function get_tribunal($id_mesa)
    {
        return $this->db->get_where('tribunal',array('id_mesa'=>$id_mesa))->row_array();
    }

    /*
     * Get all tribunales
     */
    function get_all_tribunales()
    {
      $this->db->select('id_mesa,id_persona,nombre,apellido');
      $this->db->from('tribunal');
      $this->db->join('persona', 'persona.id = tribunal.id_persona','inner');
      $this->db->order_by('id_mesa', 'desc');

      if(isset($where) && !empty($where))
      {
          $this->db->where($where['row'], $where['value']);
      }
      $query = $this->db->get();
      return $query->result_array();
    }

    /*
     * function to add new tribunal
     */
    function add_tribunal($params)
    {
        $this->db->insert('tribunal',$params);
        return $this->db->insert_id();
    }

    /*
     * function to update tribunal
     */
    function update_tribunal($id_mesa,$params)
    {
        $this->db->where('id_mesa',$id_mesa);
        return $this->db->update('tribunal',$params);
    }

    /*
     * function to delete tribunal
     */
    function delete_tribunal($id_mesa)
    {
        return $this->db->delete('tribunal',array('id_mesa'=>$id_mesa));
    }
}
