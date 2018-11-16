function cargar_datos_de_busqueda_direccion_gmaps(){
    $.ajax({
    		type: 'POST',
            url: ruta+'/Persona/obtener_latlong_de_direccion',
	        data: {direccion: $('#field-PER_CALLE').val()},
	        dataType: 'html',
	        success: function(data){
	        	var response =  data;
	        	if(response.success==1){
                
                       var myLatlng = new google.maps.LatLng(response.lat, response.long);
                
                     var markerOptions = {
            				map: map,
            				position: myLatlng,
            				draggable: true
            			};
            			marker_0 = createMarker_map(markerOptions);
                        map.setCenter(myLatlng);
                
	        	}
              }
	   });
                
}