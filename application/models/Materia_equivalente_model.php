<?php

class Materia_equivalente_model extends CI_Model
{
  function __construct() {
    parent::__construct();
  }

  function get_materia_equivalente($id_materia)
  {
    $query = $this->db->query("SELECT id_materia,id_equivalencia,
      M1.nombre AS 'nombre_materia',M1.id_carrera AS 'carrera_materia',
      M2.nombre AS 'nombre_equivalencia',M2.id_carrera AS 'carrera_equivalencia',bidireccional
      FROM materia_equivalente
      JOIN materia AS M1 ON materia_equivalente.id_materia=M1.id
      JOIN materia AS M2 ON materia_equivalente.id_equivalencia=M2.id
      WHERE materia_equivalente.id_materia=$id_materia or materia_equivalente.id_equivalencia=$id_materia
      ORDER BY id_materia DESC");
      return $query->result();

    }

    function get_all_materias_equivalentes_count()
    {
      $this->db->from('materia_equivalente');
      return $this->db->count_all_results();
    }

    function get_all_materias_equivalentes($params = array())
    {
      $this->db->order_by('id_materia', 'desc');
      if(isset($params) && !empty($params))
      {
        $this->db->limit($params['limit'], $params['offset']);
      }
      return $this->db->get('materia_equivalente')->result_array();
    }

    function add_materia_equivalente($params)
    {
      $this->db->insert('materia_equivalente',$params);
      return $this->db->insert_id();
    }


    function update_materia_equivalente($id_materia,$params)
    {
      $this->db->where('id_materia',$id_materia);
      return $this->db->update('materia_equivalente',$params);
    }

    function delete_materia_equivalente($id_materia,$id_equivalencia)
    {
      return $this->db->delete('materia_equivalente',array('id_materia'=>$id_materia,'id_equivalencia'=>$id_equivalencia));
    }
  }

 ?>
