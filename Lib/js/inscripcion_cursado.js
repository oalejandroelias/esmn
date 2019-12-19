function sendForm(form){
  var id_materia = $("[name='id_curso'] option:selected").attr('data-idmateria');
  $("[name='id_materia']").val(id_materia);
  return;
}

// advertencia de primero cargar asistencia antes de cargar nota
function noCalifica(id_curso){
  $.alert({
      title: 'Debe cargar primero la asistencia!',
      content: 'Puede ir al control de asistencias del curso haciendo click <a href="'+RUTA+'asiste/control/'+id_curso+'">aqui</a>',
      type: 'orange',
      buttons: {
          Ok: function(){}
      }
  });
}

// alternar botones de cambiar calificacion
function toggleCalificacion(btn){
    var id_row = $(btn).attr('data-id'),
    calificacion_actual = $(btn).attr('data-calificacion'),
    action = $(btn).attr('data-action');

    if (action == 'editar') {
      $("#tdCalificacion"+id_row).html('<input id="inputCalificacion'+id_row+'" type="number" class="form-control" value="'+calificacion_actual+'" maxlength="3"/>');
      $("#cambiarCalificacion"+id_row).addClass('d-none');
      $("#btnGroupCalificacion"+id_row).removeClass('d-none');
    }else if (action == 'cancelar') {
      $("#tdCalificacion"+id_row).html(calificacion_actual);
      $("#btnGroupCalificacion"+id_row).addClass('d-none');
      $("#cambiarCalificacion"+id_row).removeClass('d-none');
    }
  }

// guardar cambios en la vista de la tabla y en la base de datos
$('#zero_config').on('click','button[id^="guardarCalificacion"]',function(){
    var id_row = $(this).attr('data-id');
    var tipo = $(this).attr('data-tipo');
    var calificacion = $("#inputCalificacion"+id_row).val();

    $.ajax({
      type:'POST',
      url:RUTA+'inscripcion_materia/cambiarCalificacion',
      data: { id_row,calificacion,tipo },
      success:function (respuesta) { // devuelve un estado o false
        var obj = JSON.parse(respuesta);
        // console.log(obj);
        if (obj) {
          $("#cancelarCalificacion"+id_row).attr('data-calificacion',calificacion).click();
          $("#cambiarCalificacion"+id_row).attr('data-calificacion',calificacion);
          $("#tdCalificacion"+id_row).html(calificacion);

          var estado_inicial = $("#tdEstado"+id_row).attr('data-estadoinicial');
          $("#tdEstado"+id_row).html(estado_inicial+' > '+obj.nombre);
          highlight($("#tdCalificacion"+id_row));
          highlight($("#tdEstado"+id_row));
        }
      }, error:function () {
        alert('error');
      }
    });
  });
