// cambiar iconos de las celdas.
// realizar llamada a updateJson para actualizar asistencia de la persona
$("td[data-onclick='1']").click(function(){
  $("button[data-modify]").attr('disabled',false);
  var actual_state = parseInt($(this).attr('data-state'));
  var id_persona = $(this).attr('data-idpersona');
  var fecha = $(this).attr('data-fecha');

  $(this).removeClass();
  $(this).first().children().removeClass();
  switch (actual_state) {
    case 0:
    var state = 1;
    var state_description = "Dia Feriado";
    $(this).first().children().addClass('mdi mdi-calendar-remove mdi-24 text-danger');
    break;
    case 1:
    var state = 2;
    var state_description = "Asistencia Ok";
    $(this).first().children().addClass('mdi mdi-check mdi-24 text-info');
    break;
    case 2:
    var state = 3;
    var state_description = "Falta justificada";
    $(this).first().children().addClass('mdi mdi-flag mdi-24 text-info');
    break;
    case 3:
    var state = 0;
    var state_description = "Inasistencia";
    $(this).first().children().addClass('mdi mdi-close mdi-24 text-secondary');
    break;
    default:
  }
  $(this).attr('data-state',state);
  $(this).attr("title",state_description);
  updateJson(state,state_description,fecha,id_persona);
});

//  actualizar data-asistencia de la persona
function updateJson(state,state_description,fecha,id_persona){
  var obj = JSON.parse($("td[data-idpersona='"+id_persona+"'][data-asistencia]").attr('data-asistencia'));

  let arr = obj.find((o, i) => {
    if (o.date === fecha) {
      // obj[i] = { date: 'new string', value: 'this', other: 'that' };
      o.state = state;
      o.state_description = state_description;
      return true; // stop searching
    }
  });
  $("td[data-idpersona='"+id_persona+"'][data-asistencia]").attr('data-asistencia',JSON.stringify(obj));
}

// alternar todas las celdas de una fila al hacer click en un nombre
function check_all(td){
  var id_persona = $(td).attr("data-idpersona");
  var tds = $("td[data-idpersona='"+id_persona+"'][data-onclick='1']");
  for (var i = 0; i < tds.length; i++) {
    tds[i].click();
  }
}

// guardar cambios.
// se actualizan los dias "clases normales" no marcados como inasistencias
function guardar(){
  $("button[data-modify]").attr('disabled',true);
  var tdPersonas = $("td[data-idpersona][data-asistencia]");
  var id_curso = $("input[name='id_curso']").val();

  $.each(tdPersonas, function (index, item) {
    var id_persona = $(item).attr('data-idpersona');
    var diascursado = JSON.parse($(item).attr('data-asistencia'));

    diascursado.find((o, i) => {
      if (o.state === '0') {
        o.state_description = "Inasistencia";
      }
    });

    $.ajax({
      type:'POST',
      url:ruta+'asiste/guardar',
      data: {id_persona,id_curso,diascursado},
      success:function (respuesta){
        // respuestaAjaxSave = JSON.parse(respuesta);
      },
      error:function (respuesta){
        console.log('error: '+respuesta);
      }
    });
  });

  $.alert({
      title: 'Listo!',
      content: 'Los datos se han almacenado correctamente.',
      type: 'green',
      buttons: {
        back:{
          text: 'Volver a cursos',
          btnClass: 'btn-success',
          action: function(){location.href = ruta+'curso';}
        },
        continue: {
          text: 'Seguir editando',
          action: function(){}
        }
      }
  });
}
