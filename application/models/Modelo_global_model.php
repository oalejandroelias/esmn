<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Modelo_global_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    
    public function select_from_query($query){
        $q = $this->db->query ( $query, false );
        if ($q->num_rows () > 0) {
            foreach ( ($q->result ()) as $row ) {
                $data [] = $row;
            }
            return $data;
        }
        
        return FALSE;
    }
    
    function fechas_de_intervalos($desde, $hasta, $where) {
        
        if($where != null)
        {
            $where='WHERE '.$where;
        }
        
        $query='SELECT * FROM ( SELECT DATE(ADDDATE(ADDDATE("'.$desde.'", INTERVAL 1 DAY), INTERVAL @i:=@i+1 DAY)) AS DIASENTREFECHAS FROM ( SELECT a.a FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c ) a JOIN (SELECT @i := -1) r1 WHERE @i < (TIMESTAMPDIFF(DAY,"'.$desde.'","'.$hasta.'" )) ) AS DIAS '.$where;
        $output = $this->select_from_query($query);
        
        return $output;
    }
    
}