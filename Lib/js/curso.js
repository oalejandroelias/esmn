// obtener dias de un periodo, por nombre (en ingles, Mon, Tue, etc)
// generar tabla (calendario)
function getDaysPeriod(fecha_inicio,fecha_fin,daysWeek){
  return $.ajax({
    type:'POST',
    url:RUTA+'curso/get_days_period',
    data: {fecha_inicio,fecha_fin,daysWeek},
    // async: false,
    success:function (respuesta){
      var obj = JSON.parse(respuesta);
      globalDiasCursado = obj;
      makeTable(obj);
    },
    error:function (respuesta){
      console.log('error: '+respuesta);
    }
  });
}

// construir tabla
function makeTable(obj){
  for (var i = 0; i < obj.length; i++) {
    $("#tablaDiasCursado thead tr").append('<th class="text-center rotate">\
    <div><span class="font-weight-bold">\
    '+obj[i].date+' '+transalteDay(obj[i].day,'largo')+'\
    </span></div>\
    </th>');

    $("#tablaDiasCursado tbody tr").append('<td data-cellid="'+i+'" data-cellstate="0" onclick="changeState(this)"><span class="font-weight-bold"></span></td>');
    if (obj[i].state != 0) {
      changeState($('td[data-cellid="'+i+'"]')[0],false);
    }
  }

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

    // getDaysPeriod(fecha_inicio,fecha_fin,daysWeek);
    getDaysPeriod(fecha_inicio,fecha_fin,daysWeek).done(function(){
      // setear valor de diascursado como json para enviar por post
      $('input[name="diascursado"]').val(JSON.stringify(globalDiasCursado));
    })


  }else {
    $('#table-reference').addClass('d-none');
    $('input[name="diascursado"]').val('');
    return false};
  });

  // cambiar estado de un dia (al hacer click en una celda)
  // cell -> objeto celda
  // recargar -> si es necesario recargar el value de diascursado, por defecto true
  function changeState(cell,recargar = true){
    var actual_state = parseInt($(cell).attr('data-cellstate'));
    var set_state = actual_state+1;
    var idCell = $(cell).attr('data-cellid');

    if (set_state > 1) { //cambiar si agregamos mas estados, por ahora hay 1
      $(cell).attr('data-cellstate','0'); // 0=estado normal, clases normales
      set_state = 0;
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
    if (recargar) {
      globalDiasCursado[idCell].state = set_state;
      globalDiasCursado[idCell].state_description = state_description;

      // setear valor de diascursado como json para enviar por post
      $('input[name="diascursado"]').val(JSON.stringify(globalDiasCursado));
    }

  }

// animar formulario para mostrar carga de datos de curso o de catedra
  function slideForm(btn){
    $("#div-curso").toggle('slide');
    $("#div-catedra").toggleClass('d-none');
    $('button[type="submit"]').toggleClass('d-none');
    if ($(btn).text()=='Continuar') {
      $(btn).text('Regresar');
    }else {
      $(btn).text('Continuar');
    }

  }

// construir tabla al editar
  $(document).ready(function(){
    if ($('input[name="edit"]').length > 0) {
      var objDiasCursado = JSON.parse($('input[name="diascursado"]').val());
      globalDiasCursado = objDiasCursado;
      makeTable(objDiasCursado);
    }
  });
