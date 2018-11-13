$("td[data-onclick='1']").click(function(){
  var actual_state = parseInt($(this).attr('data-state'));

  $(this).removeClass();
  $(this).first().children().removeClass();
  switch (actual_state) {
    case 0:
    $(this).attr('data-state','2');
    $(this).first().children().addClass('mdi mdi-check mdi-24 text-info');
    $(this).attr("title","Asistencia Ok");
    break;
    case 2:
    $(this).attr('data-state','3');
    $(this).first().children().addClass('mdi mdi-flag mdi-24 text-info');
    $(this).attr("title","Falta justificada");
    break;
    case 3:
    $(this).attr('data-state','0');
    $(this).first().children().addClass('mdi mdi-close mdi-24 text-secondary');
    $(this).attr("title","Inasistencia");
    break;
    default:
  }
});

function check_all(td){
  var id_persona = $(td).attr("data-idpersona");
  var tds = $("td[data-idpersona='"+id_persona+"'][data-onclick='1']");
  for (var i = 0; i < tds.length; i++) {
    tds[i].click();
  }
}
