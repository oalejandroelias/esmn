<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Persona_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get persona by id
     */
    function get_persona($id)
    {
        return $this->db->get_where('persona',array('id'=>$id))->row_array();
    }

    /*
     * Get all personas count
     */
    function get_all_personas_count()
    {
        $this->db->from('persona');
        return $this->db->count_all_results();
    }

    /*
     * Get all personas
     */
    function get_all_personas($params = array(),$where = array())
    {
      $this->db->select('persona.id AS "persona_id",tipo_documento.nombre AS "tipo_documento",
                        ciudad.nombre AS "ciudad",numero_documento,persona.nombre,apellido,
                        domicilio,telefono,email,fecha_nacimiento,foto,persona.activo');
      $this->db->from('persona');
      $this->db->join('tipo_documento', 'tipo_documento.id = persona.id_tipo_documento', 'join');
      $this->db->join('ciudad', 'ciudad.id = persona.id_ciudad', 'left');
      $this->db->order_by('persona_id', 'desc');
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
        // return $this->db->get('persona')->result_array();
    }

    /*
     * function to add new persona
     */
    function add_persona($params)
    {
        $this->db->insert('persona',$params);
        return $this->db->insert_id();
    }

    /*
     * function to update persona
     */
    function update_persona($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('persona',$params);
    }

    /*
     * function to delete persona
     */
    function delete_persona($id)
    {
        return $this->db->delete('persona',array('id'=>$id));
    }

    function get_historial_persona($id)
    {
        $this->db->select('persona.id AS persona_id, inscripcion_materia.id as inscripcion_materia_id, materia.nombre as materia_nombre,
                            materia.id_carrera as id_carrera, estado_inscripcion_inicial.nombre as nombre_inicial, inscripcion_materia.calificacion,
                            estado_inscripcion_final.nombre as final_nombre');
        $this->db->from('inscripcion_materia');
        $this->db->join('persona', 'inscripcion_materia.id_persona=persona.id', 'inner');
        $this->db->join('curso', 'curso.id=inscripcion_materia.id_curso', 'inner');
        $this->db->join('materia', 'materia.id = curso.id_materia', 'inner');
        $this->db->join('tipo_documento', 'persona.id_tipo_documento = tipo_documento.id', 'inner');
        $this->db->join('estado_inscripcion_inicial', 'estado_inscripcion_inicial.id = inscripcion_materia.id_estado_inicial', 'left');
        $this->db->join('estado_inscripcion_final', 'estado_inscripcion_final.id = inscripcion_materia.id_estado_final', 'left');

        $this->db->where('persona.id='.$id.' AND inscripcion_materia.id_curso IS NOT null');

        //$this->db->group_by('inscripcion_materia.id ', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        $query = $this->db->get();
        return $query->result_array();
        // return $th
    }

    function get_usuario_de_persona($id)
    {
        $this->db->select('id, id_persona, username, password, activo');
        $this->db->from('usuario');
        $this->db->where('usuario.id_persona='.$id);

        $query = $this->db->get();
        return $query->result_array();
    }
}
