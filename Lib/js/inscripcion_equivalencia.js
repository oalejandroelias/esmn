$("select[name='id_materia']").change(function(){
  var id_materia = $(this).val();
  if (id_materia) {
    $.ajax({
      type:'POST',
      url:RUTA+'materia_equivalente/ver_equivalencias',
      data: {id_materia},
      success:function (respuesta){
        // console.log(respuesta);
        var obj = JSON.parse(respuesta); //respuesta a objeto
        $('select[name="id_equivalencia"]').html(''); //vaciar select
        if (obj.length > 0) {
          // mostrar materias en lista
          for (var i = 0; i < obj.length; i++) {
            var mostrar = true;
            if (id_materia == obj[i].id_materia) {
              var nombre = obj[i].nombre_equivalencia+' ('+obj[i].carrera_equivalencia+')';
            }else {
              var nombre = obj[i].nombre_materia+' ('+obj[i].carrera_materia+')';
              if (obj[i].bidireccional == 0) {
                var mostrar = false;
              }
            }
            if (mostrar) {
              $('select[name="id_equivalencia"]').append('<option value="'+obj[i].id_equivalencia+'">'+nombre+'</option>');
            }
          }
          if ($('select[name="id_equivalencia"] option').length > 0) {
            $('#spanIdMateria').text('');
            $("#divEquivalentes").removeClass('d-none');
          }else {
            $('#spanIdMateria').text('No existen equivalencias.');
            $("#divEquivalentes").addClass('d-none');
          }
        }else {
          $('#spanIdMateria').text('No existen equivalencias.');
          $("#divEquivalentes").addClass('d-none');
        }
      },
      error:function (respuesta){
        console.log('error: '+respuesta);
      }
    });
  }
});
$(document).ready(function(){
  $("select[name='id_materia']").change();
});
