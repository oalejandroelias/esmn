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
