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
    function get_asiste($id_curso)
    {
      $this->db->select('asiste.id,asiste.id_estado,asiste.id_persona,
      persona.nombre,persona.apellido,numero_documento,id_materia,id_periodo,materia.nombre AS "materia",
      curso.id AS "id_curso",diascursado,diassemana,curso.activo,tipo_periodo.descripcion AS "periodo",desde,hasta');
      $this->db->from('asiste');
      $this->db->join('persona', 'persona.id = asiste.id_persona','right');
      $this->db->join('curso', 'curso.id = asiste.id_curso','right');
      $this->db->join('materia', 'materia.id = curso.id_materia','right');
      $this->db->join('periodo', 'periodo.id = curso.id_periodo','right');
      $this->db->join('tipo_periodo', 'tipo_periodo.id = periodo.id_tipo_periodo','right');
      $this->db->order_by('persona.nombre', 'desc');
      $this->db->where(array('curso.id' => $id_curso, 'asiste.id IS NOT NULL' => NULL));

      $query = $this->db->get();
      return $query->result_array();
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
    function update_asiste($id_persona,$id_curso,$params)
    {
        $this->db->where(array('id_persona'=>$id_persona,'id_curso'=>$id_curso));
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
