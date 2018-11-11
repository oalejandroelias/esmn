<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Estado_inscripcion_inicial_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  /*
  * Get estado_inscripcion_inicial by id
  */
  function get_estado_inscripcion_inicial($id)
  {
    return $this->db->get_where('estado_inscripcion_inicial',array('id'=>$id))->row_array();
  }

  /*
  * Get all estado_inscripcion_inicial count
  */
  function get_all_estado_inscripcion_inicial_count()
  {
    $this->db->from('estado_inscripcion_inicial');
    return $this->db->count_all_results();
  }

  /*
  * Get all estado_inscripcion_inicial
  */
  function get_all_estado_inscripcion_inicial($params = array())
  {
    $this->db->order_by('id', 'desc');
    if(isset($params) && !empty($params))
    {
      $this->db->limit($params['limit'], $params['offset']);
    }
    return $this->db->get('estado_inscripcion_inicial')->result_array();
  }
  
  function get_all_estado_inscripcion_inicial_mesa($params = array())
  {
      $this->db->order_by('id', 'desc');
      $this->db->where('es_mesa=1');
      if(isset($params) && !empty($params))
      {
          $this->db->limit($params['limit'], $params['offset']);
      }
      return $this->db->get('estado_inscripcion_inicial')->result_array();
  }

  /*
  * function to add new estado_inscripcion_inicial
  */
  function add_estado_inscripcion_inicial($params)
  {
    $this->db->insert('estado_inscripcion_inicial',$params);
    return $this->db->insert_id();
  }

  /*
  * function to update estado_inscripcion_inicial
  */
  function update_estado_inscripcion_inicial($id,$params)
  {
    $this->db->where('id',$id);
    return $this->db->update('estado_inscripcion_inicial',$params);
  }

  /*
  * function to delete estado_inscripcion_inicial
  */
  function delete_estado_inscripcion_inicial($id)
  {
    return $this->db->delete('estado_inscripcion_inicial',array('id'=>$id));
  }
}
