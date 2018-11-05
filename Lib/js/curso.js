// obtener dias de un periodo, por nombre (en ingles, Mon, Tue, etc)
function getDaysPeriod(fecha_inicio,fecha_fin,daysWeek){
  $.ajax({
    type:'POST',
    url:ruta+'curso/get_days_period',
    data: {fecha_inicio,fecha_fin,daysWeek},
    success:function (respuesta){
      console.log(respuesta);
    },
    error:function (respuesta){
      console.log('error: '+respuesta);
    }
  });
}

$('[name^="dayWeek"]').change(function(){
  if ($('[name="id_periodo"]').val()) {
    var fecha_inicio = $('[name="id_periodo"] option:selected').attr('data-inicio'),
        fecha_fin = $('[name="id_periodo"] option:selected').attr('data-fin'),
        daysWeek = [];

    $("[name='dayWeek[]']:checked").each(function(){
      daysWeek.push($(this).val());
    });

    getDaysPeriod(fecha_inicio,fecha_fin,daysWeek);

  }else return false;
});
