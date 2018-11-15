<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Materia_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * obtiene una materia a partir del id
     */
    function get_materia($id)
    {
        return $this->db->get_where('materia',array('id'=>$id))->row_array();
    }

    /*
     * obtiene las materias y las cuenta
     */
    function get_all_materias_count()
    {
        $this->db->from('materia');
        return $this->db->count_all_results();
    }

    /*
     * Obtiene todas las materias
     */
    function get_all_materias($params = array(),$where = array())
    {
        $this->db->select('materia.id AS "materia_id",id_carrera,carrera.nombre AS "nombre_carrera",
        materia.nombre AS "nombre_materia",codigo_anio,regimen_cursado,carga_horaria,
        regimen_aprobacion,tipo_catedra, materia.activo');
        $this->db->from('materia');
        $this->db->join('carrera', 'carrera.id = materia.id_carrera', 'inner');
        $this->db->order_by('materia_id', 'desc');
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
        // return $this->db->get('materia')->result_array();
    }




    /*
     * funcion para agregar una nueva materia
     */
    function add_materia($params)
    {
        $this->db->insert('materia',$params);
        return $this->db->insert_id();
    }

    /*
     * funcion para actualizar una materia
     */
    function update_materia($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('materia',$params);
    }

    /*
     * funcion para elimnar una materia a partir del id
     */
    function delete_materia($id)
    {
        return $this->db->delete('materia',array('id'=>$id));
    }
}
