// RUTA DEL SITIO:
ruta="http://localhost/esmn/";

// Basic Table
$('#zero_config').DataTable();

// For select 2
$(".select2").select2();

// cargar modal de confirmacion de borrado
$('a[data-confirm="remove"]').click(function(){
  var action_url = this.href;
  $('div[data-modal="remove"]').load(ruta+"Lib/modals/modal_remove.html",function(result){
    $("#modal_remove").modal();
    $('#modal_remove button.btn-danger').attr('onclick',"location.href='"+action_url+"'");
  });
  return false;
});
