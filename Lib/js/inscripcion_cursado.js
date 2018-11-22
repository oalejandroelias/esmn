function sendForm(form){
  var id_materia = $("[name='id_curso'] option:selected").attr('data-idmateria');
  $("[name='id_materia']").val(id_materia);
  return;
}

function editarCalificacion(btn){
    var id_row = $(btn).attr('data-id'),
    calificacion_actual = $(btn).attr('data-calificacion');
    $("#tdCalificacion"+id_row).html('<input type="number" class="form-control" value="'+calificacion_actual+'" maxlength="3"/>');
    $(btn).addClass('d-none');
    $("#btnGroupCalificacion"+id_row).removeClass('d-none');
    // $("#"+id).parent().prev().html('<button id="cancelCalificacion'+id+'" type="submit" class="btn btn-secondary btn-sm btn-block"><i class="fa fa-remove" aria-hidden="true"></i></button>');
    // $("#"+id).parent().html('<button id="updateCalificacion'+id+'" type="submit" class="btn btn-warning btn-sm btn-block"><i class="fa fa-save" aria-hidden="true"></i></button>');
    // row[1].innerHTML='<input class="form-control form-control-sm" type="text" name="nombre" autocomplete="off" value="'+calificacion_actual+'" required="required" maxlength="24">';
    // $("#cancelCategoria"+id).on('click', function () {
    //   // $(this).parent().parent().html(tr);
    //   return false;
    // });
    // $("#updateCalificacion"+id).on('click', function () {
    //   var nombre = (row[1].children[0].value);

      // $.ajax({
      //   type:'POST',
      //   url:url_editar_categoria,
      //   async: true,
      //   data: { idcategoria,nombre },
      //   success:function (respuesta) {
      //     $("#modal_calificacion_success h6").text(respuesta);
      //     $("#modal_calificacion_success").modal();
      //     setTimeout(function() {
      //       window.location.href = url_admin_categoria;
      //     }, 1500);
      //   }, error:function () {
      //     alert('error');
      //   }
      // });
    // });
  }
