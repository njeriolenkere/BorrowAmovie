<?php

session_start();

?>
<!DOCTYPE html>

<html>

    <head>
    
        <title>Find Us</title>
        
        <meta charset="utf-8"/>
    
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="Lab4.css"/>
        <style>
      #map {
        height: 400px;
        width: 50%;
        
       }
    </style>
    
    </head>
    
    <body>
    
        <div id="wrap">
            
            <?php 
            
            include('header.php');
            
            ?>
     <div class="lid">    

                                        
 
            <h3>Our Location</h3>
            <p> We are always in the shop so feel free to pay us a visit.</p>
    <div id="map" ></div>
    <script>
      function initMap() {
        var uluru = {lat: 57.782576, lng: 14.171874};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDF81SsHOkOQin-dqYED04PmRQ3NJCl7FE&callback=initMap">
    </script>   

        
        <h2> <strong> Our contacts </strong></h5>
        <p>
            Tel: (+46) 7609 409 38
           
        </p>  
        <p>
            
            Email: movielovers@gmail.com
        
        </p>           
            
           <footer>
              <?php include "footer.php";?> 
               
           </footer>
            
            
        
        </div>
            </div>
                
                </div>
    
    </body>

</html>

 