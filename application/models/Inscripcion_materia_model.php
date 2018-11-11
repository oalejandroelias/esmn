<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Inscripcion_materia_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get inscripcion_materia by id
     */
    function get_inscripcion_materia($id)
    {
        return $this->db->get_where('inscripcion_materia',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all inscripcion_materia
     */
    function get_all_inscripcion_materia()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('inscripcion_materia')->result_array();
    }
    
    function get_all_inscripcion_materia_cursado()
    {
        
        
        $this->db->select('inscripcion_materia.id as id_inscripcion_materia, id_persona, id_curso, inscripcion_materia.id_materia, id_mesa, estado_inscripcion_inicial.nombre as nombre_estado_inicial, id_estado_final, calificacion,
                            materia.nombre as nombre_materia, persona.nombre as nombre_persona, persona.apellido as apellido_persona,
                            persona.numero_documento as numero_documento, estado_inscripcion_inicial.nombre as nombre_estado_cursado');
        $this->db->from('inscripcion_materia');
        $this->db->join('curso', 'inscripcion_materia.id_curso = curso.id', 'inner');
        $this->db->join('materia ', 'inscripcion_materia.id_materia  = materia .id', 'inner');
        $this->db->join('persona ', 'inscripcion_materia.id_persona  = persona .id', 'inner');
        $this->db->join('estado_inscripcion_inicial ', 'inscripcion_materia.id_estado_inicial  = estado_inscripcion_inicial .id', 'inner');
        $this->db->where('inscripcion_materia.id_curso=0');
        //$this->db->order_by('carrera_id', 'desc');
        
        
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_all_inscripcion_materia_mesa()
    {
        
        
        $this->db->select('id_persona, id_curso, inscripcion_materia.id_materia, id_mesa, id_estado_inicial, id_estado_final, calificacion, mesa.fecha as fecha_mesa,
                            materia.nombre as nombre_materia, persona.nombre as nombre_persona, persona.apellido as apellido_persona, 
                            persona.numero_documento as numero_documento, estado_inscripcion_inicial.nombre as nombre_estado_cursado');
        $this->db->from('inscripcion_materia');
        $this->db->join('mesa', 'inscripcion_materia.id_mesa = mesa.id', 'inner');
        $this->db->join('materia ', 'inscripcion_materia.id_materia  = materia .id', 'inner');
        $this->db->join('persona ', 'inscripcion_materia.id_persona  = persona .id', 'inner');
        $this->db->join('estado_inscripcion_inicial ', 'inscripcion_materia.id_estado_inicial  = estado_inscripcion_inicial .id', 'inner');
        $this->db->where('inscripcion_materia.id_curso=0');
        //$this->db->order_by('carrera_id', 'desc');
       
        
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
        
    /*
     * function to add new inscripcion_materia
     */
    function add_inscripcion_materia($params)
    {
        $this->db->insert('inscripcion_materia',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update inscripcion_materia
     */
    function update_inscripcion_materia($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('inscripcion_materia',$params);
    }
    
    /*
     * function to delete inscripcion_materia
     */
    function delete_inscripcion_materia($id)
    {
        return $this->db->delete('inscripcion_materia',array('id'=>$id));
    }
}