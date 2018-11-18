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
      $('#modal_correlativas form select option').prop("disabled",false); //habilitar todos las opciones del select

      $('#modal_correlativas form input[type="hidden"]').val(id_materia); //setear valor del input hidden del form
      $('#modal_correlativas form select option[value="'+id_materia+'"]').prop("disabled",true); //deshabilitar opcion de materia elegida

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
          $('#modal_correlativas form select option[value="'+obj[i].id_correlativa+'"]').prop("disabled",true);//deshabilitar opcion de materia ya listada
        }
        $('#modal_correlativas div[data-respuesta=""] ul').after('<hr>'); //separador
      }else {
        $('#modal_correlativas .modal-title').text('No existen correlatividades.');//mensaje general
      }
      $('#modal_correlativas').modal(); //abrir modal
      $('#modal_correlativas form select').select2(); //construir select
    },
    error:function (respuesta){
      console.log('error: '+respuesta);
    }
  });
}

$("#modal_correlativas").on("hidden.bs.modal", function () {
  $('#modal_correlativas form select').select2('destroy'); //limpiar select
});

function eliminar_correlativa(id_materia,id_correlativa,btn){
  $.confirm({
    title: 'Alerta!',
    content: 'Seguro de querer eliminar el elemento?',
    buttons: {
      Cancelar: {
        btnClass: 'btn btn-success',
        action : function () {
          // $.alert('Cancelado!');
        }
      },
      Continuar: {
        btnClass: 'btn btn-danger',
        action: function () {
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
        },
      }
    }
  });
}

// funciones materias Equivalentes
function ver_equivalencias(id_materia){
  $.ajax({
    type:'POST',
    url:ruta+'materia_equivalente/ver_equivalencias',
    data: {id_materia},
    success:function (respuesta){
      // console.log(respuesta);
      var obj = JSON.parse(respuesta); //respuesta a objeto
      $('#modal_equivalencias div[data-respuesta=""]').html(''); //vaciar contenido respuesta
      $('#modal_equivalencias form select option').prop("disabled",false); //habilitar todos las opciones del select

      $('#modal_equivalencias form input[type="hidden"]').val(id_materia); //setear valor del input hidden del form
      $('#modal_equivalencias form select option[value="'+id_materia+'"]').prop("disabled",true); //deshabilitar opcion de materia elegida

      if (obj.length > 0) {
        $('#modal_equivalencias .modal-title').text("Materias Equivalentes"); //mensaje general

        // mostrar materias en lista
        $('#modal_equivalencias div[data-respuesta=""]').append('<ul class="list-group list-group-flush"></ul>');
        for (var i = 0; i < obj.length; i++) {
          if (id_materia == obj[i].id_materia) {
            var nombre = obj[i].nombre_equivalencia+' ('+obj[i].carrera_equivalencia+')';
          }else {
            var nombre = obj[i].nombre_materia+' ('+obj[i].carrera_materia+')';
          }
          $('#modal_equivalencias div[data-respuesta=""] ul').append('<li class="list-group-item">'+nombre+' \
          <button class="btn btn-danger btn-xs float-right" title="Eliminar" onclick="eliminar_equivalencia('+obj[i].id_materia+','+obj[i].id_equivalencia+',this)">\
          <i class="fas fa-times"></i>\
          </button>\
          </li>');
          $('#modal_equivalencias form select option[value="'+obj[i].id_equivalencia+'"]').prop("disabled",true);//deshabilitar opcion de materia ya listada
        }
        $('#modal_equivalencias div[data-respuesta=""] ul').after('<hr>'); //separador
      }else {
        $('#modal_equivalencias .modal-title').text('No existen equivalencias.');//mensaje general
      }
      $('#modal_equivalencias').modal(); //abrir modal
      $('#modal_equivalencias form select').select2(); //construir select
    },
    error:function (respuesta){
      console.log('error: '+respuesta);
    }
  });
}

$("#modal_equivalencias").on("hidden.bs.modal", function () {
  $('#modal_equivalencias form select').select2('destroy'); //limpiar select
});

function eliminar_equivalencia(id_materia,id_equivalencia,btn){
  $.confirm({
    title: 'Alerta!',
    content: 'Seguro de querer eliminar el elemento?',
    buttons: {
      Cancelar: {
        btnClass: 'btn btn-success',
        action : function () {
          // $.alert('Cancelado!');
        }
      },
      Continuar: {
        btnClass: 'btn btn-danger',
        action: function () {
          $.ajax({
            type:'POST',
            url:ruta+'materia_equivalente/remove',
            data: {id_materia,id_equivalencia},
            success:function (respuesta){
              // console.log(respuesta);
              btn.parentElement.remove(); //eliminar <li>
            },
            error:function (respuesta){
              console.log('error: '+respuesta);
            }
          });
        },
      }
    }
  });
}
