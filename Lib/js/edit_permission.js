// alternar seleccion de checkboxs por clase
function check_all(a){
  var checkboxs = $(a).parent().next()[0].getElementsByTagName('input');
  var value = $(a).attr('data-a');

  if (value=='on') {
    for (var i = 0; i < checkboxs.length; i++) {
      checkboxs[i].checked=true;
    }
    $(a).attr('data-a','off');

  }else {
    for (var i = 0; i < checkboxs.length; i++) {
      checkboxs[i].checked=false;
    }
    $(a).attr('data-a','on');
  }
}
