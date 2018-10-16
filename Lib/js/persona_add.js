/*datepicker*/
jQuery('.mydatepicker').datepicker();
jQuery('#datepicker-autoclose').datepicker({
  autoclose: true,
  todayHighlight: true,
  format: 'yyyy-mm-dd'
});



$('#checkbox_generar_usuario').change(function(){
  $('#copiar_permisos_de').toggleClass('d-none');
  if ($(this).is(':checked')) {
    $('#copiar_permisos_de select').attr('required',true);
  }else {
    $('#copiar_permisos_de select').attr('required',false);
  }
});
