<<?php

class Materia_correlativa_model extends CI_Model
{
  function __construct() {
    parent::__construct();
  }

  function get_equivalencia($id_materia)
  {
    $query = $this->db->query("SELECT id_materia,id_equivalencia,
      M1.nombre AS 'nombre_materia',M2.nombre AS 'nombre_equivalencia'
      FROM materia_equivalencia
      JOIN materia AS M1 ON Equivalencia.id_materia=M1.id
      JOIN materia AS M2 ON Equivalencia.id_correlativa=M2.id
      WHERE Equivalencia.id_materia=$id_materia
      ORDER BY id_materia DESC");
      return $query->result();

    }

    function get_all_equivalencia_count()
    {
      $this->db->from('equivalencia');
      return $this->db->count_all_results();
    }

    function get_all_equivalencia($params = array())
    {
      $this->db->order_by('id_materia', 'desc');
      if(isset($params) && !empty($params))
      {
        $this->db->limit($params['limit'], $params['offset']);
      }
      return $this->db->get('equivalencia')->result_array();
    }

    function add_equivalencia($params)
    {
      $this->db->insert('equivalencia',$params);
      return $this->db->insert_id();
    }


    function update_equivalencia($id_materia,$params)
    {
      $this->db->where('id_materia',$id_materia);
      return $this->db->update('equivalencia',$params);
    }

    function delete_materia_correlativa($id_materia,$id_equivalencia)
    {
      return $this->db->delete('equivalencia',array('id_materia'=>$id_materia,'id_equivalencia'=>$id_equivalencia));
    }
  }

 ?>
