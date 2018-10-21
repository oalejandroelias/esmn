<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Carrera_model extends CI_Model
{

  //metodo contructor del modelo
  function __construct()
  {
    parent::__construct();
  }

  /*
  * obtener carrera a partir del id que ingresa como parametro
  */
  function get_carrera($id)
  {
    return $this->db->get_where('carrera',array('id'=>$id))->row_array();
  }

  /*
  * cuenta el listado total de carreras
  */
  function get_all_carreras_count()
  {
    $this->db->from('carrera');
    return $this->db->count_all_results();
  }

  /*
  * obtiene todas las carreras
  */
  function get_all_carreras($params = array(),$where = array())
  {

    $this->db->select('carrera.id AS "carrera_id",carrera.nombre AS "carrera_nombre",
    id_nivel,nivel.nombre AS "nivel",acta,fecha');
    $this->db->from('carrera');
    $this->db->join('nivel', 'nivel.id = carrera.id_nivel', 'inner');
    $this->db->order_by('carrera_id', 'desc');
    if(isset($params) && !empty($params))
    {
      $this->db->limit($params['limit'], $params['offset']);
    }
    if(isset($where) && !empty($where))
    {
      $this->db->where($where['row'], $where['value']);
    }


    $query = $this->db->get();
    return $query->result_array();
  }

  /*
  * funcion que agrega una nueva carrera
  */
  function add_carrera($params)
  {
    $this->db->insert('carrera',$params);
    return $this->db->insert_id();
  }

  /*
  * funcion que actualiza los datos de la carrera
  */
  function update_carrera($id,$params)
  {
      $this->db->where('id',$id);
      return $this->db->update('carrera',$params);
  }

  /*
  * funcion que elimina la carrera a partir del id ingresado por parametro
  */
  function delete_carrera($id)
  {
    return $this->db->delete('carrera',array('id'=>$id));
  }
}