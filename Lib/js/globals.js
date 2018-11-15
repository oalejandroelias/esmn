// RUTA DEL SITIO:
ruta="http://localhost/esmn/";

$('#menu-administracion').perfectScrollbar();
/*datepicker*/
jQuery('.mydatepicker').datepicker({
  autoclose: true,
  todayHighlight: true,
  zIndexOffset: 50,
  format: 'dd/mm/yyyy'
});

// controlar fechas desde-hasta
// http://www.dotnetqueries.com/Article/106/bootstrap-datetimepicker-startdate-enddate-validation
$('.mydatepicker-start').on("change", function(){
   //when chosen from_date, the end date can be from that point forward
   var startVal = $('.mydatepicker-start').val();
   $('.mydatepicker-end').data('datepicker').setStartDate(startVal);
});
$('.mydatepicker-end').on("change", function(){
   //when chosen end_date, start can go just up until that point
   var endVal = $('.mydatepicker-end').val();
   $('.mydatepicker-start').data('datepicker').setEndDate(endVal);
});

// Basic Table
var dtable = $('#zero_config').DataTable({
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

// mostrar filas ocultas
 function mostrarTodo(){
   // determinar registros inactivos o deshabilitados, y ocultarlos
   dtable.rows().eq(0).each( function ( index ) {
      var row = dtable.row( index );
      var rowNode = row.node();
      var activo = $(rowNode).attr('data-activo');
      if (typeof activo !== typeof undefined && activo !== false && activo!=1) {
        $(row.node()).toggleClass("d-none");
      }
    });
 }
 mostrarTodo();

// For select 2
$(".select2").select2({width: 'resolve'});
$(".select2-selection.select2-selection--single").css("height",'34px');
$(".select2-selection.select2-selection--single").children().css("height",'34px');

// cargar modal de confirmacion de borrado para etiquetas <a>
$('#zero_config').on('click','a[data-confirm="remove"]',function(){
  var action_url = this.href;
  $('div[data-modal="remove"]').load(ruta+"Lib/modals/modal_remove.html",function(result){
    $("#modal_remove").modal();
    $('#modal_remove button.btn-danger').attr('onclick',"location.href='"+action_url+"'");
  });
  return false;
});

// traducir dias
// day = nombre corto o largo en ingles (Mon,Thu,etc)
// mode puede ser respuesta en nombre 'corto' o 'largo'
function transalteDay(day,mode){
  var day = day.toLowerCase();
  switch (day) {
    case 'mon':
    case 'monday':
    var translation = (mode=='corto') ? 'Lun' : 'Lunes';
    break;
    case 'tue':
    case 'tuesday':
    var translation = (mode=='corto') ? 'Mar' : 'Martes';
    break;
    case 'wed':
    case 'wednesday':
    var translation = (mode=='corto') ? 'Mie' : 'Miercoles';
    break;
    case 'thu':
    case 'thursday':
    var translation = (mode=='corto') ? 'Jue' : 'Jueves';
    break;
    case 'fri':
    case 'friday':
    var translation = (mode=='corto') ? 'Vie' : 'Viernes';
    break;
    case 'sat':
    case 'saturday':
    var translation = (mode=='corto') ? 'Sab' : 'Sabado';
    break;
    case 'sun':
    case 'sunday':
    var translation = (mode=='corto') ? 'Dom' : 'Domingo';
    break;

    default:
    var translation = false;
  }
  return translation;
}
