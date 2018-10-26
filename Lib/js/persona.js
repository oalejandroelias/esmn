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

$('#fecha_nacimiento').bootstrapBirthday({
  widget: {
    wrapper: {
      tag: 'div',
      class: 'row'
    },
    wrapperYear: {
      use: true,
      tag: 'div',
      class: 'col-sm-4'
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
      name: 'fecha_nacimiento[year]',
      class: 'form-control'
    },
    selectMonth: {
      name: 'fecha_nacimiento[month]',
      class: 'form-control'
    },
    selectDay: {
      name: 'fecha_nacimiento[day]',
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
