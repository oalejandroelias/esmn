<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Periodo_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get periodo by id
     */
    function get_periodo($id)
    {
        return $this->db->get_where('periodo',array('id'=>$id))->row_array();
    }


    function get_all_periodos_count()
    {
        $this->db->from('periodo');
        return $this->db->count_all_results();
    }

    /*
     * Get all periodo
     */
    function get_all_periodo($where = array())
    {
      $this->db->select('periodo.id,id_tipo_periodo,descripcion,desde,hasta');
      $this->db->from('periodo');
      $this->db->join('tipo_periodo', 'periodo.id_tipo_periodo = tipo_periodo.id', 'inner');
      $this->db->order_by('periodo.id', 'desc');
      if(isset($where) && !empty($where))
      {
        $this->db->where($where['row'], $where['value']);
      }
      $query = $this->db->get();
      return $query->result_array();
    }

    /*
     * function to add new periodo
     */
    function add_periodo($params)
    {
        $this->db->insert('periodo',$params);
        return $this->db->insert_id();
    }

    /*
     * function to update periodo
     */
    function update_periodo($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('periodo',$params);
    }

    /*
     * function to delete periodo
     */
    function delete_periodo($id)
    {
        return $this->db->delete('periodo',array('id'=>$id));
    }
}
