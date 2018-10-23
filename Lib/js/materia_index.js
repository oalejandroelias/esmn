// ver materias correlativas
function ver_correlativas(id_materia){
  $.ajax({
    type:'POST',
    url:ruta+'materia_correlativa/ver_correlativas',
    data: {id_materia},
    success:function (respuesta){
      // console.log(respuesta);
      var obj = JSON.parse(respuesta); //respuesta a objeto
      $('#modal_correlativas div[data-respuesta=""]').html(''); //vaciar contenido respuesta

      $('#modal_correlativas form input[type="hidden"]').val(id_materia);

      if (obj.length > 0) {
        $('#modal_correlativas .modal-title').text("Materias Correlativas"); //mensaje general

        // mostrar materias en lista
        $('#modal_correlativas div[data-respuesta=""]').append('<ul class="list-group list-group-flush"></ul>');
        for (var i = 0; i < obj.length; i++) {
          $('#modal_correlativas div[data-respuesta=""] ul').append('<li class="list-group-item">'+obj[i].nombre_correlativa+' \
          <button class="btn btn-danger btn-xs float-right" title="Eliminar" onclick="eliminar_correlativa('+id_materia+','+obj[i].id_correlativa+',this)">\
          <i class="fas fa-times"></i>\
          </button>\
          </li>');
        }
        $('#modal_correlativas div[data-respuesta=""] ul').after('<hr>'); //separador
      }else {
        $('#modal_correlativas .modal-title').text('No existen correlatividades.');//mensaje general
      }
      $('#modal_correlativas').modal(); //abrir modal
    },
    error:function (respuesta){
      console.log('error: '+respuesta);
    }
  });
}

function eliminar_correlativa(id_materia,id_correlativa,btn){
  $.ajax({
    type:'POST',
    url:ruta+'materia_correlativa/remove',
    data: {id_materia,id_correlativa},
    success:function (respuesta){
      btn.parentElement.remove(); //eliminar <li>
    },
    error:function (respuesta){
      console.log('error: '+respuesta);
    }
  });
}
