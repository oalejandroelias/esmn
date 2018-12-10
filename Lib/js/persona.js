// al checkear "generar usuario" aparecen campos de usuario y un selector de permisos,
// si se quita, desaparecen los campos
function box_checked(checkbox){
  $('#formdiv_permisos').toggleClass('d-none');
  $('#formdiv_usuario').toggleClass('d-none');
  if (checkbox.is(':checked')) {
    $('#formdiv_permisos select').attr('required',true);
    $('#formdiv_usuario input').attr('required',true);
  }else {
    $('#formdiv_permisos select').attr('required',false);
    $('#formdiv_usuario input').attr('required',false);
  }
}
$('#checkbox_generar_usuario').change(function(){
  box_checked($(this));
});

// crear select de fecha nacimiento
if($('#fecha_nacimiento').length){
  $('#fecha_nacimiento').bootstrapBirthday({
    widget: {
      wrapper: {
        tag: 'div',
        class: 'row'
      },
      wrapperYear: {
        use: true,
        tag: 'div',
        class: 'col-sm-4',
        required: 'required'
      },
      wrapperMonth: {
        use: true,
        tag: 'div',
        class: 'col-sm-4'
      },
      wrapperDay: {
        use: true,
        tag: 'div',
        class: 'col-sm-4'
      },
      selectYear: {
        name: 'birthday[year]',
        class: 'form-control'
      },
      selectMonth: {
        name: 'birthday[month]',
        class: 'form-control'
      },
      selectDay: {
        name: 'birthday[day]',
        class: 'form-control'
      }
    },
    dateFormat: 'littleEndian',
    monthFormat: 'long',
    text: {
      year: "Año",
      month: "Mes",
      day: "Dia",
      months: {
        long: [
          "Enero",
          "Febrero",
          "Marzo",
          "Abril",
          "Mayo",
          "Junio",
          "Julio",
          "Agosto",
          "Septiembre",
          "Octubre",
          "Noviembre",
          "Diciembre"
        ]
      }
    }
  })
};

// validar datos del formulario
function validar_form(form){
  var selects = $("select[name^='birthday']"),
  year = $("select[name^='birthday[year]']").val(),
  month = $("select[name^='birthday[month]']").val(),
  day = $("select[name^='birthday[day]']").val();
  for (var i = 0; i < selects.length; i++) {
    if (selects[i].value == 0){
      $('span[data-error="fecha_nacimiento"]').removeClass('d-none');
      return false;
    }
  }
  var date = year+"-"+month+"-"+day;
  $("#fecha_nacimiento").val(date);
  $(form).find('button[type="submit"]').attr('disabled',true);
}

// obtener url de imagen y mostrarla en card_foto_perfil
function readURL(input,id_img) {
  if (input.files && input.files[0] && input.files[0].size < 10485760) { //controlar max_size de la imagen
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#'+id_img).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
    return true;
  }else {
    $('#'+id_img).attr('src', ''); //resetear imagen a mostrar
    return false;
  }
}

$("#card_foto_perfil input").change(function(e) {
  if (readURL(this,'img_foto_perfil')) { //mostrar imagen, o mostrar error
    $("#card_foto_perfil span").text("");
  }else {
    $("#card_foto_perfil span").text("El archivo es demasiado grande! (max 10M)");
    e.target.value = ""; //setear valor de input vacio
  }
});

$(document).ready(function(){
  //setear valores de fecha si vienen por post (repoblar)
  if ($("input[name='fecha_nacimiento']").val() != "") {
    var date = $("input[name='fecha_nacimiento']").val(),
    d = new Date(date),
    year = d.getFullYear().toString(),
    month = (d.getUTCMonth()+1).toString(),
    day = d.getUTCDate().toString();

    if (month.startsWith(0)) { month = month.substring(1); }
    if (day.startsWith(0)) { day = day.substring(1); }
    $("select[name^='birthday[year]']").val(year);
    $("select[name^='birthday[month]']").val(month);
    $("select[name^='birthday[day]']").val(day);
  }

  // si el checkbox generar_usuario viene por post:
  if ($('#checkbox_generar_usuario').length>0)
  {
    if ($('#checkbox_generar_usuario')[0].checked) box_checked();
  }
  else{
    $('#formdiv_permisos').toggleClass('d-none');
    $('#formdiv_usuario').toggleClass('d-none');
    $('#formdiv_permisos select').attr('required',true);
    $('#formdiv_usuario input').attr('required',true);
  }

  if($('#tabla_mapa').length){
    $('#tabla_mapa').after(datos_mapa);
  }
});

function cargar_datos_de_busqueda_direccion_gmaps(){
  $.ajax({
    type: 'POST',
    url: ruta+'Persona/obtener_latlong_de_direccion',
    data: {direccion: $('#field-PER_CALLE').val()},
    dataType: 'html',
    success: function(data){
      var response =  jQuery.parseJSON(data);
      if(response.success==1){

        var myLatlng = new google.maps.LatLng(response.lat, response.long);

        var markerOptions = {
          map: map,
          position: myLatlng,
          draggable: true            			};
          marker_0.setPosition(null);
          marker_0 = createMarker_map(markerOptions);
          map.setCenter(myLatlng);

        }
      }
    });

  }
  //function guardar_coordenadas(nueva_latitud,nueva_longitud){
  //$('#field-PER_LONGITUD_DOMICILIO').val(nueva_longitud);
  //$('#field-PER_LATITUD_DOMICILIO').val(nueva_latitud);
  //}

  // comprobar alumno regular y generar certificado
  function getRegularidad(id_persona){
    var opt = $('select[name="id_carrera"] option');
    var options = '';
    for (var i = 0; i < opt.length; i++) {
      options=options+'<option value='+opt[i].value+'>'+opt[i].innerText+'</option>';
    }

    $.confirm({
      title: 'Seleccione una Carrera',
      content: '' +
      '<form class="form-horizontal">' +
      '<div class="form-group">' +
      '<label></label>' +
      '<select name="id_carrera" class="form-control" required>' +
      options +
      '</select>' +
      '</div>' +
      '</form>',
      buttons: {
        formSubmit: {
          text: 'Enviar',
          btnClass: 'btn-blue',
          action: function () {
            var id_carrera = this.$content.find('[name="id_carrera"]').val();
            // $.alert(id_carrera);
            $.ajax({
              type: 'POST',
              url: ruta+'Persona/getRegularidad',
              data: {id_persona,id_carrera},
              success: function(respuesta){
                var obj= JSON.parse(respuesta);
                if (obj) {
                  $.confirm({
                    title: 'Correcto!',
                    type: 'green',
                    content: obj.nombre+' '+obj.apellido+' es un alumno regular. Puede imprimir el certificado a continuacion',
                    buttons: {
                      print:{
                        text: 'Imprimir',
                        btnClass: 'btn-primary',
                        action: function () {
                          imprimirCertificadoRegular(obj);
                        }
                      },
                      Cancelar: function () {
                      }
                    }
                  });
                }else {
                  $.alert({
                    title: 'Atencion!',
                    type: 'red',
                    content: 'Falta cumplir requisitos para ser REGULAR en la carrera seleccionada',
                  });
                  // $.alert('Falta cumplir requisitos para ser REGULAR en la carrera seleccionada');
                }

              },
              error:function (respuesta){
                console.log('error: '+respuesta);
              }
            });
          }
        },
        Cancelar: function () {
          //close
        },
      }
    });
  }

  function imprimirCertificadoRegular(obj){
    var nombreDoc = 'Certificado_Alumno_Regular_'+obj.nombre+'_'+obj.apellido+'.pdf';
    var year = moment().year();
    var month = moment().month();
    var day = moment().date();
    if (day==1) {
      var dia = 'Al '+day+' dia';
    }else {
      var dia = 'A los '+day+' dias';
    }
    var mes = transalteMonth(month);
    var texto = dia+' del mes de '+mes+' de '+year+' se extiende el Certificado de Alumno Regular Correspondiente '+
    'a '+obj.nombre+' '+obj.apellido+' '+obj.tipo_documento+': '+obj.numero_documento+' que se encuentra inscripto a la carrera '+obj.carrera+
    ' del plan: '+obj.id_carrera+' del nivel: '+obj.nivel+' cuyo estado de alumno es REGULAR para ser presentado ante quien corresponda';
    var dd = {
      content: [
        {
          text: 'Certificado de Alumno Regular',
          style: 'header'
        },
        {
          text: [texto],
          style: 'contenido',
        }
      ],
      styles: {
        header: {
          fontSize: 16,
          alignment: 'center',
          font: 'Helvetica',
        },
        contenido:{
          margin: [30, 20, 30, 20],
          fontSize: 14,
          alignment: 'justify',
          font: 'Helvetica',
        }
      }

    }
    pdfMake.fonts = { //importar fuentes desde archivo vfs
      Helvetica: {
        normal: 'Helvetica.ttf'
      }
    };
    // console.log(dd);
    pdfMake.createPdf(dd).download(nombreDoc);
  }


  function getConstancia(id_persona){
    var opt = $('select[name="id_carrera"] option');
    var options = '';
    for (var i = 0; i < opt.length; i++) {
      options=options+'<option value='+opt[i].value+'>'+opt[i].innerText+'</option>';
    }

    $.confirm({
      title: 'Seleccione una Carrera',
      content: '' +
      '<form class="form-horizontal">' +
      '<div class="form-group">' +
      '<label></label>' +
      '<select name="id_carrera" class="form-control" required>' +
      options +
      '</select>' +
      '</div>' +
      '</form>',
      buttons: {
        formSubmit: {
          text: 'Enviar',
          btnClass: 'btn-blue',
          action: function () {
            var id_carrera = this.$content.find('[name="id_carrera"]').val();
            // $.alert(id_carrera);
            $.ajax({
              type: 'POST',
              url: ruta+'Persona/getConstancia',
              data: {id_persona,id_carrera},
              success: function(respuesta){
                var obj= JSON.parse(respuesta);
                // console.log(obj);
                if (obj) {
                  $.confirm({
                    title: 'Correcto!',
                    type: 'green',
                    content: obj.nombre+' '+obj.apellido+' Puede imprimir la constancia a continuacion',
                    buttons: {
                      print:{
                        text: 'Imprimir',
                        btnClass: 'btn-primary',
                        action: function () {
                          imprimirConstanciaExamen(obj);
                        }
                      },
                      Cancelar: function () {
                      }
                    }
                  });
                }else {
                  $.alert({
                    title: 'No se puede emitir la constancia.',
                    type: 'red',
                    content: 'El alumno no asistio a la mesa.',
                  });
                }

              },
              error:function (respuesta){
                console.log('error: '+respuesta);
              }
            });
          }
        },
        Cancelar: function () {
          //close
        },
      }
    });
  }

  function imprimirConstanciaExamen(obj){
    var nombreDoc = 'Constancia_Examen'+obj.nombre+'_'+obj.apellido+'.pdf';
    var year = moment().year();
    var month = moment().month();
    var day = moment().date();
    if (day==1) {
      var dia = 'Al '+day+' dia';
    }else {
      var dia = 'A los '+day+' dias';
    }
    var mes = transalteMonth(month);
    var texto = dia+' del mes de '+mes+' de '+year+' se extiende el Constancia de Examen Correspondiente '+
    'a alumno/a '+obj.nombre+' '+obj.apellido+' '+obj.tipo_documento+': '+obj.numero_documento+' que se encuentra inscripto a la carrera '+obj.carrera+
    ' del plan: '+obj.id_carrera+' del nivel: '+obj.nivel+' que rindio el examen final de la materia: '+obj.materia_nombre;
    var dd = {
      content: [
        {
          text: 'Constancia de Examen',
          style: 'header'
        },
        {
          text: [texto],
          style: 'contenido',
        }
      ],
      styles: {
        header: {
          fontSize: 16,
          alignment: 'center',
          font: 'Helvetica',
        },
        contenido:{
          margin: [30, 20, 30, 20],
          fontSize: 14,
          alignment: 'justify',
          font: 'Helvetica',
        }
      }

    }
    pdfMake.fonts = { //importar fuentes desde archivo vfs
      Helvetica: {
        normal: 'Helvetica.ttf'
      }
    };
    // console.log(dd);
    pdfMake.createPdf(dd).download(nombreDoc);
  }

  function getAnalitico(id_persona){
    var opt = $('select[name="id_carrera"] option');
    var options = '';
    for (var i = 0; i < opt.length; i++) {
      options=options+'<option value='+opt[i].value+'>'+opt[i].innerText+'</option>';
    }
    $.confirm({
      title: 'Seleccione una carrera',
      content: '' +
      '<form class="form-horizontal">' +
      '<div class="form-group">' +
      '<label></label>' +
      '<select name="id_carrera" class="form-control" required>' +
      options +
      '</select>' +
      '</div>' +
      '</form>',
      buttons: {
        formSubmit: {
          text: 'Enviar',
          btnClass: 'btn-blue',
          action: function () {
            var id_carrera = this.$content.find('[name="id_carrera"]').val();
            // $.alert(id_carrera);
            $.ajax({
              type: 'POST',
              url: ruta+'Persona/getAnalitico',
              data: {id_persona,id_carrera},
              success: function(respuesta){
                var obj= JSON.parse(respuesta);
                // console.log(obj);
                if (obj) {
                  imprimirAnalitico(obj);
                }else {
                  $.alert('El alumno no tiene todas las materias aprobadas!');
                }

              },
              error:function (respuesta){
                console.log('error: '+respuesta);
              }
            });
          }
        },
        Cancelar: function () {
          //close
        },
      }
    });
  }

  function imprimirAnalitico(obj){
    // console.log(obj);
    var body = [];
    var row = new Array();
    row.push({text: 'Materia', style: 'head'});
    row.push({text: 'Estado', style: 'head'});
    row.push({text: 'Calificacion', style: 'head'});
    body.push(row);

    for (var key in obj) //la variable fue creada en el controlador
    {
      if (obj.hasOwnProperty(key))
      {
        var data = obj[key];
        var row = new Array();
        row.push({text: data.materia_nombre.toString(), style: 'body'});
        row.push({text: data.final_nombre.toString(), style: 'body'});
        row.push({text: data.calificacion.toString(), style: 'body'});
        body.push(row);
      }
    }

    var nombreDoc = 'Analitico_'+obj[0].nombre+'_'+obj[0].apellido+'.pdf';
    var year = moment().year();
    var month = moment().month();
    var day = moment().date();
    var dd = {
      content: [
        {
          text: 'Neuquen, '+day+' de '+month+' de '+year+'.-',
          style: 'header'
        },
        {
          text: 'Ref.: Certificado de Estudios',
          style: 'header'
        },
        {
          text: 'Res.: '+obj[0].id_carrera,
          style: 'header'
        },
        {
          style: 'contenido',
          text: ['La Dirección de la Escuela Superior de Música del Neuquén, deja constancia que el/la ',
          'alumno/a '+obj[0].nombre+' '+obj[0].apellido+' '+obj[0].tipo_documento+': '+obj[0].numero_documento+', ha cursado y  aprobado  en este Establecimiento ',
          'las asignaturas correspondientes al Nivel '+obj[0].nivel+', que se detallan:'
        ]
      },
      {
        style: 'table',
        table: {
          widths: ['*','*','*'], //ancho de las columnas
          body: body //array creado mas arriba
        },
        layout: {
          hLineWidth: function (i, node) { // layout provista por pdfmake:
            return (i === 0 || i === node.table.body.length) ? 1 : 0.5;
          },
          vLineWidth: function (i, node) {
            return (i === 0 || i === node.table.widths.length) ? 1 : 0.5;
          },
          hLineColor: function (i, node) {
            return (i === 0 || i === node.table.body.length) ? 'black' : 'gray';
          },
          vLineColor: function (i, node) {
            return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray';
          },
        }
      }
    ],
    styles: {
      header: {
        fontSize: 16,
        alignment: 'center',
        font: 'Helvetica',
      },
      contenido:{
        margin: [30, 20, 30, 20],
        fontSize: 14,
        alignment: 'justify',
        font: 'Helvetica',
      },
      table: {
          font: 'Helvetica',
          margin: [0, 0, 0, 15],
        },
    }

  }
  pdfMake.fonts = { //importar fuentes desde archivo vfs
    Helvetica: {
      normal: 'Helvetica.ttf'
    }
  };
  // console.log(dd);
  pdfMake.createPdf(dd).download(nombreDoc);
}
