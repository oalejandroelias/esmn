<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Inscripcion_carrera_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  /*
  * Get inscripcion_carrera by id_persona
  */
  function get_inscripcion_carrera($id_persona)
  {
    return $this->db->get_where('inscripcion_carrera',array('id_persona'=>$id_persona))->row_array();
  }

  /*
  * Get all inscripcion_carrera
  */
  function get_all_inscripcion_carrera($where = array())
  {
    $this->db->select('id_persona,id_carrera,carrera.nombre AS "nombre_carrera",
    persona.nombre AS "nombre_persona",persona.apellido AS "apellido_persona"');
    $this->db->from('inscripcion_carrera');
    $this->db->join('carrera', 'carrera.id = inscripcion_carrera.id_carrera', 'inner');
    $this->db->join('persona', 'persona.id = inscripcion_carrera.id_persona', 'inner');
    $this->db->order_by('nombre_carrera', 'desc');

    if(isset($where) && !empty($where))
    {
      $this->db->where($where['row'], $where['value']);
    }
    $query = $this->db->get();
    return $query->result_array();
  }

  /*
  * function to add new inscripcion_carrera
  */
  function add_inscripcion_carrera($params)
  {
    $this->db->insert('inscripcion_carrera',$params);
    return $this->db->insert_id();
  }

  /*
  * function to update inscripcion_carrera
  */
  function update_inscripcion_carrera($id_persona,$params)
  {
    $this->db->where('id_persona',$id_persona);
    return $this->db->update('inscripcion_carrera',$params);
  }

  /*
  * function to delete inscripcion_carrera
  */
  function delete_inscripcion_carrera($id_persona)
  {
    return $this->db->delete('inscripcion_carrera',array('id_persona'=>$id_persona));
  }
}