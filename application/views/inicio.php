<div class="row">
  <div class="col-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?=$page_title?></h5>
        <?php
        echo "<pre>";
        print_r($this->session->userdata());
        echo "</pre>";
        ?>
      </div>

    </div>
  </div>

</div>

  <!-- Mapa -->
  <style type="text/css">
    #mapa { height: 500px; }
    </style>
     <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
     <!-- Mapa -->

     <!-- Mapa -->
  <div id="mapa"></div>


   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOnpDL1OhCIE-a2oxHx2WVUTMNOhn5aSY&callback=initMap"></script>
    <script type="text/javascript">
    function initialize() {
      var marcadores = [
  
        ['Escuela de musica', -38.952516, -68.059611]
      ];
      var map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 14,
        center: new google.maps.LatLng(-38.952516, -68.059611),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      
      var infowindow = new google.maps.InfoWindow();
      var marker, i;
      for (i = 0; i < marcadores.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
          map: map
        });
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(marcadores[i][0]);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
 <!-- Mapa -->
  </div>