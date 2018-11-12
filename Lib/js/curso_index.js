$(document).ready(function(){
  var rows = $("span[id^='cursoSpan']");
  for (var i = 0; i < rows.length; i++) {
    var span = rows[i];
    var obj = JSON.parse(rows[i].innerText);
    var dias = [];
    for (var j = 0; j < obj.length; j++) {
      dias.push(transalteDay(obj[j],'largo'));
    }
    span.innerText = dias.join(", ");
  }
});
