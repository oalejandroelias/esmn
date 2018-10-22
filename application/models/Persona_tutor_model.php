<?php
/*
* Generated by CRUDigniter v3.2
* www.crudigniter.com
*/

class Persona_tutor_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  /*
  * Get persona_tutor by id_persona
  */
  function get_persona_tutor($id_persona)
  {
    $query = $this->db->query("SELECT id_persona,id_responsable,id_tutor,tutor.nombre AS 'nombre_tutor',
      P1.nombre AS 'nombre_persona',P1.apellido AS 'apellido_persona',
      P2.nombre AS 'nombre_responsable',P2.apellido AS 'apellido_responsable'
      FROM persona_tutor
      RIGHT JOIN persona AS P1 ON persona_tutor.id_persona=P1.id
      RIGHT JOIN persona AS P2 ON persona_tutor.id_responsable=P2.id
      JOIN tutor ON persona_tutor.id_tutor=tutor.id
      WHERE id_persona=$id_persona
      ORDER BY id_persona");
      return $query->result();
      // return $this->db->get_where('persona_tutor',array('id_persona'=>$id_persona))->row_array();
    }

    /*
    * Get all persona_tutor
    */
    function get_all_persona_tutor()
    {
      $this->db->order_by('id_persona', 'desc');
      return $this->db->get('persona_tutor')->result_array();
    }

    /*
    * function to add new persona_tutor
    */
    function add_persona_tutor($params)
    {
      $this->db->insert('persona_tutor',$params);
      return $this->db->insert_id();
    }

    /*
    * function to update persona_tutor
    */
    function update_persona_tutor($id_persona,$params)
    {
      $this->db->where('id_persona',$id_persona);
      return $this->db->update('persona_tutor',$params);
    }

    /*
    * function to delete persona_tutor
    */
    function delete_persona_tutor($id_persona)
    {
      return $this->db->delete('persona_tutor',array('id_persona'=>$id_persona));
    }
  }
