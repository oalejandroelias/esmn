<?php
setlocale(LC_TIME,"es_ES.UTF-8"); //fechas en español

//ejemplo de ecuacion para calcular cantidad de dias en un periodo
// para usar en construccion de json "diascursado" en tabla curso

$fecha_inicio = new DateTime('2018-03-05');
$fecha_fin = new DateTime('2018-06-29');

$dias_semana = array('martes','jueves'); //2

$interval = $fecha_inicio->diff($fecha_fin);
$dias_total = $interval->days; //116

// print_r($interval);

function countDaysByName($dayName, $start, $end)
{
    $count = 0;
    $interval = new \DateInterval('P1D');
    $period = new \DatePeriod($start, $interval, $end);

    foreach($period as $day){
        if($day->format('D') === ucfirst(substr($dayName, 0, 3))){
            $count ++;
        }
    }
    return $count;
}
// echo countDaysByName('Tue',$fecha_inicio,$fecha_fin)." dias Martes y ";
// echo countDaysByName('Thu',$fecha_inicio,$fecha_fin)." dias Jueves";

 ?>
