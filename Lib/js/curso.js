// obtener dias de un periodo, por nombre (en ingles, Mon, Tue, etc)
// generar tabla (calendario)
function getDaysPeriod(fecha_inicio,fecha_fin,daysWeek){
  $.ajax({
    type:'POST',
    url:ruta+'curso/get_days_period',
    data: {fecha_inicio,fecha_fin,daysWeek},
    success:function (respuesta){
      var obj = JSON.parse(respuesta);
      globalDiasCursado = obj;
      // console.log(obj);

      for (var i = 0; i < obj.length; i++) {
        $("#tablaDiasCursado thead tr").append('<th class="text-center rotate">\
        <div><span class="font-weight-bold">\
        '+obj[i].date+' '+transalteDay(obj[i].day,'largo')+'\
        </span></div>\
        </th>');

        $("#tablaDiasCursado tbody tr").append('<td data-cellid="'+i+'" data-cellstate="0" onclick="changeState(this)"><span class="font-weight-bold"><i class=""></i></span></td>');
      }
    },
    error:function (respuesta){
      console.log('error: '+respuesta);
    }
  });
}

// llamar a getDaysPeriod cuando cambie la seleccion de dias de semana o periodo
$('[name^="dayWeek"],[name="id_periodo"]').change(function(){
  $("#tablaDiasCursado thead tr").html('');
  $("#tablaDiasCursado tbody tr").html('');

  if ($('[name="id_periodo"]').val() && $("[name='dayWeek[]']:checked").val()) {
    $('#table-reference').removeClass('d-none');

    var fecha_inicio = $('[name="id_periodo"] option:selected').attr('data-inicio'),
    fecha_fin = $('[name="id_periodo"] option:selected').attr('data-fin'),
    daysWeek = [];

    $("[name='dayWeek[]']:checked").each(function(){
      daysWeek.push($(this).val());
    });

    getDaysPeriod(fecha_inicio,fecha_fin,daysWeek);

    // setear valor de diascursado como json para enviar por post
    $('input[name="diascursado"]').val(JSON.stringify(globalDiasCursado));

  }else {
    $('#table-reference').addClass('d-none');
    return false};
  });

  // cambiar estado de un dia (al hacer click en una celda)
  function changeState(cell){
    var actual_state = parseInt($(cell).attr('data-cellstate'));
    var set_state = actual_state+1;
    var idCell = $(cell).attr('data-cellid');

    if (set_state > 1) { //cambiar si agregamos mas estados, por ahora hay 1
      $(cell).attr('data-cellstate','0'); // 0=estado normal, clases normales
    }else {
      $(cell).attr('data-cellstate',set_state);
    }

    // cambia el color de una celda de la tabla, segun el estado y modificar objeto JSON globalDiasCursado
    $(cell).removeClass();
    $(cell).first().children().removeClass();
    switch (set_state) {
      case 0: // para dias normales
        var state_description = 'Clases normales';
        break;
      case 1: // para dias feriados
        $(cell).addClass('bg-danger');
        $(cell).first().children().addClass('mdi mdi-calendar-remove mdi-24');
        var state_description = 'Dia Feriado';
        break;
      default:

    }

    // modificar json:
    globalDiasCursado[idCell].state = idCell;
    globalDiasCursado[idCell].state_description = state_description;

    // setear valor de diascursado como json para enviar por post
    $('input[name="diascursado"]').val(JSON.stringify(globalDiasCursado));

  }


  // traducir dias
  // day = nombre corto o largo en ingles (Mon,Thu,etc)
  // mode puede ser respuesta en nombre 'corto' o 'largo'
  function transalteDay(day,mode){
    var day = day.toLowerCase();
    switch (day) {
      case 'mon':
      case 'monday':
      var translation = (mode=='corto') ? 'Lun' : 'Lunes';
      break;
      case 'tue':
      case 'tuesday':
      var translation = (mode=='corto') ? 'Mar' : 'Martes';
      break;
      case 'wed':
      case 'wednesday':
      var translation = (mode=='corto') ? 'Mie' : 'Miercoles';
      break;
      case 'thu':
      case 'thursday':
      var translation = (mode=='corto') ? 'Jue' : 'Jueves';
      break;
      case 'fri':
      case 'friday':
      var translation = (mode=='corto') ? 'Vie' : 'Viernes';
      break;
      case 'sat':
      case 'saturday':
      var translation = (mode=='corto') ? 'Sab' : 'Sabado';
      break;
      case 'sun':
      case 'sunday':
      var translation = (mode=='corto') ? 'Dom' : 'Domingo';
      break;

      default:
      var translation = false;
    }
    return translation;
  }

  // $(document).ready(function(){
  //   $("[name='dayWeek[]']:checked").change();
  // });
