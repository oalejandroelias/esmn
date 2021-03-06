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
//if ($.fn.DataTable.isDataTable( '#zero_config' )) {
if (dtable.rows().length>0) {
  mostrarTodo();

  // forzar mostrar tooltip en tablas
  $('#zero_config').on('draw.dt', function() {
    $('[data-toggle="tooltip"]').tooltip(); // Or your function for tooltips
  });
}

// For select 2
$(".select2").select2({width: 'resolve'});
$(".select2-selection.select2-selection--single").css("height",'34px');
$(".select2-selection.select2-selection--single").children().css("height",'34px');

// cargar modal de confirmacion de borrado para etiquetas <a>
$('#zero_config').on('click','a[data-confirm="remove"]',function(){
  var action_url = this.href;
  $('div[data-modal="remove"]').load(RUTA+"Lib/modals/modal_remove.html",function(result){
    $("#modal_remove").modal();
    $('#modal_remove button.btn-danger').attr('onclick',"location.href='"+action_url+"'");
  });
  return false;
});

// deshabilitar botones de guardado para evitar datos repetidos
function disableBtn(btn){
  $(btn).attr('disabled',true);
  return;
}

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

// traducir meses
// month = numero del mes (donde 0=enero)
function transalteMonth(month){
  switch (month) {
    case 0:
    var translation = 'Enero';
    break;
    case 1:
    var translation = 'Febrero';
    break;
    case 2:
    var translation = 'Marzo';
    break;
    case 3:
    var translation = 'Abril';
    break;
    case 4:
    var translation = 'Mayo';
    break;
    case 5:
    var translation = 'Junio';
    break;
    case 6:
    var translation = 'Julio';
    break;
    case 7:
    var translation = 'Agosto';
    break;
    case 8:
    var translation = 'Septiembre';
    break;
    case 9:
    var translation = 'Octubre';
    break;
    case 10:
    var translation = 'Noviembre';
    break;
    case 11:
    var translation = 'Diciembre';
    break;

    default:
    var translation = false;
  }
  return translation;
}

// efecto 'luminoso'
function highlight(element) {
  element.addClass('highlight');
  setTimeout(function() {
    $('.highlight').removeClass('highlight');
  }, 2000);
}

// Sharing sessionStorage between tabs for secure multi-tab authentication
(function() {

  if (!sessionStorage.length) {
    // Ask other tabs for session storage
    localStorage.setItem('getSessionStorage', Date.now());
  };

  window.addEventListener('storage', function(event) {

    //console.log('storage event', event);

    if (event.key == 'getSessionStorage') {
      // Some tab asked for the sessionStorage -> send it

      localStorage.setItem('sessionStorage', JSON.stringify(sessionStorage));
      localStorage.removeItem('sessionStorage');

    } else if (event.key == 'sessionStorage' && !sessionStorage.length) {
      // sessionStorage is empty -> fill it

      var data = JSON.parse(event.newValue),
      value;

      for (key in data) {
        sessionStorage.setItem(key, data[key]);
      }
    }
  });

  window.onbeforeunload = function() {
    //sessionStorage.clear();
  };
})();
