/*datepicker*/
jQuery('.mydatepicker').datepicker({
  autoclose: true,
  todayHighlight: true,
  format: 'yyyy-mm-dd'
});

// al checkear "generar usuario" aparece un selector de permisos,
// si se quita, desaparece el selector
$('#checkbox_generar_usuario').change(function(){
  $('#copiar_permisos_de').toggleClass('d-none');
  if ($(this).is(':checked')) {
    $('#copiar_permisos_de select').attr('required',true);
  }else {
    $('#copiar_permisos_de select').attr('required',false);
  }
});

// crear select de fecha nacimiento
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
});

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
}

// obtener url de imagen y mostrarla en card_foto_perfil
function readURL(input,id_img) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#'+id_img).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#card_foto_perfil input").change(function() {
  readURL(this,'img_foto_perfil');
  $("#card_foto_perfil span").text("");
});

$(document).ready(function(){
  //setear valores de fecha si vienen por post (repoblar)
  if ($("input[name='fecha_nacimiento']").val() != "") {
    var date = $("input[name='fecha_nacimiento']").val(),
        year = $("input[name='fecha_nacimiento']").attr('data-valueyear'),
        month = $("input[name='fecha_nacimiento']").attr('data-valuemonth'),
        day = $("input[name='fecha_nacimiento']").attr('data-valueday');
    $("select[name^='birthday[year]']").val(year);
    $("select[name^='birthday[month]']").val(month);
    $("select[name^='birthday[day]']").val(day);
  }
});
