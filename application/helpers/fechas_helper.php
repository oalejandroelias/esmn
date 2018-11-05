<?php
setlocale(LC_TIME,"es_ES.UTF-8"); //fechas en español

//ejemplo de ecuacion para calcular cantidad de dias en un periodo
// para usar en construccion de json "diascursado" en tabla curso

// $fecha_inicio = new DateTime('2018-03-05');
// $fecha_fin = new DateTime('2018-06-29');
//
// $dias_semana = array('Tue','Thu'); //2
//
// $interval = $fecha_inicio->diff($fecha_fin);
// $dias_total = $interval->days; //116

// cuenta los dias por nombre, dentro de un periodo
// $dayName = string('Tue')
// $start = string('2018-03-05');
// $end = string('2018-06-29');
// retorna int() dias.
function countDaysByName($dayName, $start, $end)
{
    $count = 0;
    $interval = new \DateInterval('P1D');
    $period = new \DatePeriod(new DateTime($start), $interval, new DateTime($end));

    foreach($period as $day){
        if($day->format('D') === ucfirst(substr($dayName, 0, 3))){
            $count ++;
        }
    }
    return $count;
}

// obtener dias de un periodo, por nombre (en ingles, Mon, Tue, etc)
// $fecha_inicio = string('2018-03-05')
// $fecha_fin = string('2018-06-29');
// $daysWeek = array('Tue','Thu');
// retorna un arreglo con los dias.
function getDaysPeriod($fecha_inicio,$fecha_fin,$daysWeek){
  // generar periodo
  $period = new DatePeriod(
    new DateTime($fecha_inicio),
    new DateInterval('P1D'),
    new DateTime($fecha_fin)
  );

  $arr_days = array(); //arreglo de dias con $daysWeek
  
  foreach ($period as $key => $value) {
    if (in_array($value->format('D'),$daysWeek)){
      $arr_days[$value->format('Y-m-d')] = array();
      array_push($arr_days[$value->format('Y-m-d')],$value->format('D'));
    }
  }

  return $arr_days;
}
// print_r(getDaysPeriod('2018-03-05','2018-06-29',array('Tue','Thu')));
 ?>
