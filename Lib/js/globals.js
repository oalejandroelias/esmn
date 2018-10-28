// RUTA DEL SITIO:
ruta="http://localhost/esmn/";

// Basic Table
$('#zero_config').DataTable({
  "language": {
    // "url": "/esmn/Lib/matrix-admin-bt4/assets/libs/datatables/i18n/dataTables.spanish.lang"
    "sProcessing":     "Procesando...",
  	"sLengthMenu":     "Mostrar _MENU_ registros",
  	"sZeroRecords":    "No se encontraron resultados",
  	"sEmptyTable":     "Ningún dato disponible en esta tabla",
  	"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  	"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
  	"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
  	"sInfoPostFix":    "",
  	"sSearch":         "Buscar:",
  	"sUrl":            "",
  	"sInfoThousands":  ",",
  	"sLoadingRecords": "Cargando...",
  	"oPaginate": {
  		"sFirst":    "Primero",
  		"sLast":     "Último",
  		"sNext":     "Siguiente",
  		"sPrevious": "Anterior"
  	},
  	"oAria": {
  		"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
  		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
  	}
  }
});

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
