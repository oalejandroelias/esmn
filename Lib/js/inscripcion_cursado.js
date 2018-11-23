function sendForm(form){
  var id_materia = $("[name='id_curso'] option:selected").attr('data-idmateria');
  $("[name='id_materia']").val(id_materia);
  return;
}

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

  $("[id^='guardarCalificacion']").on('click', function () {
    var id_row = $(this).attr('data-id');
    var calificacion = $("#inputCalificacion"+id_row).val();

    $.ajax({
      type:'POST',
      url:ruta+'inscripcion_materia/cambiarCalificacion',
      data: { id_row,calificacion },
      success:function (respuesta) {
        var obj = JSON.parse(respuesta);
        // console.log(obj);
        if (obj) {
          $("#cancelarCalificacion"+id_row).attr('data-calificacion',calificacion).click();
          $("#cambiarCalificacion"+id_row).attr('data-calificacion',calificacion);
          $("#tdCalificacion"+id_row).html(calificacion);
          highlight($("#tdCalificacion"+id_row));
        }
      }, error:function () {
        alert('error');
      }
    });
  });
