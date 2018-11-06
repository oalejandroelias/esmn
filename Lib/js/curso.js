// obtener dias de un periodo, por nombre (en ingles, Mon, Tue, etc)
// generar tabla (calendario)
function getDaysPeriod(fecha_inicio,fecha_fin,daysWeek){
  $.ajax({
    type:'POST',
    url:ruta+'curso/get_days_period',
    data: {fecha_inicio,fecha_fin,daysWeek},
    success:function (respuesta){
      // console.log(respuesta);
      var obj = JSON.parse(respuesta);

      for (var i = 0; i < obj.length; i++) {
        $("#tablaDiasCursado thead tr").append('<th class="text-center rotate90deg">\
        <span class="rotate90deg font-weight-bold">\
        '+obj[i].date+' '+transalteDay(obj[i].day,'largo')+'\
        </span>\
        </th>');

        $("#tablaDiasCursado tbody tr").append('<td class="cell-diacursado" data-cellnum="'+i+'"><div></div></td>');
      }
    },
    error:function (respuesta){
      console.log('error: '+respuesta);
    }
  });
}

// llamar a getDaysPeriod cuando cambie la seleccion de dias de semana
$('[name^="dayWeek"]').change(function(){
  $("#tablaDiasCursado thead tr").html('');
  $("#tablaDiasCursado tbody tr").html('');

  if ($('[name="id_periodo"]').val() && $("[name='dayWeek[]']:checked").val()) {
    var fecha_inicio = $('[name="id_periodo"] option:selected').attr('data-inicio'),
        fecha_fin = $('[name="id_periodo"] option:selected').attr('data-fin'),
        daysWeek = [];

    $("[name='dayWeek[]']:checked").each(function(){
      daysWeek.push($(this).val());
    });

    getDaysPeriod(fecha_inicio,fecha_fin,daysWeek);

  }else return false;
});

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
