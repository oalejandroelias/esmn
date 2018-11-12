$(document).ready(function(){
  var rows = $("span[id^='cursoSpan']");
  for (var i = 0; i < rows.length; i++) {
    var span = rows[i];
    var obj = JSON.parse(rows[i].innerText);
    var dias = [];
    for (var i = 0; i < obj.length; i++) {
      dias.push(transalteDay(obj[i],'largo'));
    }
    span.innerText = dias.join(", ");
  }
});
