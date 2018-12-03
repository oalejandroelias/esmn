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

    /*HISTORIAL CURSADO*/
    function get_historial_persona_curso($id, $id_carrera)
    {
        $this->db->select('persona.id AS persona_id, inscripcion_materia.id as inscripcion_materia_id, materia.nombre as materia_nombre,
                            materia.id_carrera as id_carrera, estado_inscripcion_inicial.nombre as nombre_inicial, inscripcion_materia.calificacion,
                            estado_inscripcion_final.nombre as final_nombre, inscripcion_materia.fecha');
        $this->db->from('inscripcion_materia');
        $this->db->join('persona', 'inscripcion_materia.id_persona=persona.id', 'inner');
        $this->db->join('curso', 'curso.id=inscripcion_materia.id_curso', 'inner');
        $this->db->join('materia', 'materia.id = curso.id_materia', 'inner');
        $this->db->join('tipo_documento', 'persona.id_tipo_documento = tipo_documento.id', 'inner');
        $this->db->join('estado_inscripcion_inicial', 'estado_inscripcion_inicial.id = inscripcion_materia.id_estado_inicial', 'left');
        $this->db->join('estado_inscripcion_final', 'estado_inscripcion_final.id = inscripcion_materia.id_estado_final', 'left');

        $this->db->where('persona.id='.$id.' AND (inscripcion_materia.id_curso IS NOT null or inscripcion_materia.id_estado_final=5) AND materia.id_carrera LIKE "'.$id_carrera.'"');

        //$this->db->group_by('inscripcion_materia.id ', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    /*HISTORIAL MESAS*/
    function get_historial_persona_mesa($id, $id_carrera)
    {
        $this->db->select('persona.id AS persona_id, inscripcion_materia.id as inscripcion_materia_id, materia.nombre as materia_nombre,
                            materia.id_carrera as id_carrera, estado_inscripcion_inicial.nombre as nombre_inicial, inscripcion_materia.calificacion,
                            estado_inscripcion_final.nombre as final_nombre, inscripcion_materia.fecha');
        $this->db->from('inscripcion_materia');
        $this->db->join('persona', 'inscripcion_materia.id_persona=persona.id', 'inner');
        //$this->db->join('curso', 'curso.id=inscripcion_materia.id_curso', 'inner');
        $this->db->join('mesa', 'mesa.id=inscripcion_materia.id_mesa', 'inner');
        $this->db->join('materia', 'materia.id = mesa.id_materia', 'inner');
        $this->db->join('tipo_documento', 'persona.id_tipo_documento = tipo_documento.id', 'inner');
        $this->db->join('estado_inscripcion_inicial', 'estado_inscripcion_inicial.id = inscripcion_materia.id_estado_inicial', 'left');
        $this->db->join('estado_inscripcion_final', 'estado_inscripcion_final.id = inscripcion_materia.id_estado_final', 'left');

        $this->db->where('persona.id='.$id.' AND inscripcion_materia.id_mesa IS NOT null AND materia.id_carrera LIKE "'.$id_carrera.'"');

        //$this->db->group_by('inscripcion_materia.id ', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    // comprobar regularidad
    function check_regularidad($id_persona,$id_carrera){
      $this->db->select('persona.nombre, persona.apellido, tipo_documento.nombre as "tipo_documento",
       persona.numero_documento, carrera.nombre as "carrera",carrera.id as "id_carrera", nivel.nombre as "nivel",inscripcion_materia.fecha');
      $this->db->from('persona');
      $this->db->join('tipo_documento', 'persona.id_tipo_documento = tipo_documento.id', 'inner');
      $this->db->join('inscripcion_materia', 'inscripcion_materia.id_persona=persona.id', 'inner');
      $this->db->join('materia', 'materia.id=inscripcion_materia.id_materia', 'inner');
      $this->db->join('carrera', 'carrera.id=materia.id_carrera', 'inner');
      $this->db->join('nivel', 'nivel.id=carrera.id_nivel ', 'inner');
      $this->db->join('inscripcion_carrera', 'inscripcion_carrera.id_persona=persona.id and inscripcion_carrera.id_carrera=carrera.id', 'inner');
      $this->db->where('persona.id='.$id_persona.' AND carrera.id="'.$id_carrera.'" AND (inscripcion_materia.fecha BETWEEN concat(year(curdate()),"-03-01") and curdate())');

      $query = $this->db->get();
      return $query->result_array();
    }

    function get_usuario_de_persona($id)
    {
        $this->db->select('id, id_persona, username, password, activo');
        $this->db->from('usuario');
        $this->db->where('usuario.id_persona='.$id);

        $query = $this->db->get();
        return $query->result_array();
    }

    function get_carreras_inscriptas($id_persona) {

        $this->db->select('carrera.id, carrera.id_nivel, carrera.nombre');
        $this->db->from('persona');
        $this->db->join('inscripcion_carrera', 'inscripcion_carrera.id_persona=persona.id', 'inner');
        $this->db->join('carrera', 'carrera.id=inscripcion_carrera.id_carrera', 'inner');
        $this->db->where('persona.id='.$id_persona);

        $query = $this->db->get();
        return $query->result_array();

    }
}
