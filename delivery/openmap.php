<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Current Location on Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
    crossorigin=""/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.min.css" />
    <!-- <link rel="stylesheet" href="delivery.css"> -->
    <style>
      
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
   
      /* Add some basic styling to the map container */
      #map-container {
        width: auto;
        height: 300px;
        margin:auto;
        margin:10px 20px 10px 20px;
        z-index: 2;
      }
      #contain{
        font-family: 'Poppins', sans-serif;
        margin: auto;
        align-items: center;
        text-align: center;
      }
      .nav-bar a{
        background:#06C167;
      }
      @media screen and (max-width: 600px) {
       #map-container {
       height: 200px;
       }
      }
    </style>
  </head>
  <body>
  <header>
        <div class="logo">Howdy <b style="color: #06C167;">Donor</b></div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li><a href="delivery.php">Home</a></li>
                <li><a href="#" class="active">map</a></li>
                <li><a href="deliverymyord.php" >myorders</a></li>
                <!-- <li ><a href="fooddonate.html"  >Donate</a></li> -->
            </ul>
        </nav>
    </header>
    <br>
    <script>
        hamburger=document.querySelector(".hamburger");
        hamburger.onclick =function(){
            navBar=document.querySelector(".nav-bar");
            navBar.classList.toggle("active");
        }
    </script>
    <div id="contain">
    <h3> Current Location </h3>
    <div id="map-container"></div>
    <div id="city-name"></div>
    <div id="address"></div>
    <br>
    <!-- <h3>Ip address details</h3>
    <p>Your IP address : <span id="ip"></span></p>
    <table style="margin:auto">

  <tr>
    <td>Ip version</td>  
    <td>:</td>
    <td id="version"></td>
  </tr>
    <tr><td>your country </td>  
    <td>:</td>
    <td id="country"></td>
  </tr>
  </table> -->
</div>


    <!-- Load the LeafletJS library and JavaScript code for displaying the map and user's location -->
   
    <script>
      // Initialize the map and user's location marker
      function initMap() {
        // Retrieve the map container element
        var mapContainer = document.getElementById("map-container");
        
        // Create a new map centered on the user's location
        navigator.geolocation.getCurrentPosition(function(position) {
          var userLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          
          var map = L.map(mapContainer).setView(userLocation, 15);
          
          // Add the OpenStreetMap tile layer to the map
          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
            tileSize: 512,
            zoomOffset: -1
          }).addTo(map);
          
          // Add a marker at the user's location
          var marker = L.marker(userLocation).addTo(map);
          marker.bindPopup("<b>You are here!</b>").openPopup();
          
         // Add a circle to indicate the accuracy of the user's location
        // var accuracy = L.circle(userLocation, {
        //   radius: position.coords.accuracy,
        //   fillColor: "#0074D9",
        //   fillOpacity: 0.2,
        //    stroke: false
        // }).addTo(map);
     
          
          
          // Retrieve the city name using OpenStreetMap API
            var url =
              "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=" +
              userLocation.lat +
              "&lon=" +
              userLocation.lng;
            fetch(url)
              .then(function (response) {
                return response.json();
              })
              .then(function (data) {
                // Display the city name on the web page
                var cityName = data.address.city || data.address.town;
                var cityNameElement = document.getElementById("city-name");
                cityNameElement.innerHTML = "You are in " + cityName;
              
              });
                 // Use reverse geocoding to get the user's address
          fetch(url)
            .then(response => response.json())
            .then(data => {
              document.getElementById("address").innerHTML = `You are at ${data.display_name}`;
            });
        }, function() {
          // Handle errors when retrieving the user's location
          alert("Error: The Geolocation service failed.");
        });
      }
    </script>

    <script>
      function getVisitorLocation() {
  // make API request to ipinfo.io to retrieve location data
  fetch("https://ipapi.co/json/")
    .then(response => response.json())
    .then(data => {
      // retrieve location information from API response
      var country = data.country;
      var region = data.region;
      var city = data.city;
      var postalCode = data.postal;
      var ip = data.ip;
      var version=data.version;
     

      // display location information to user
     document.getElementById("country").innerHTML =country; 
   
     document.getElementById("ip").innerHTML = ip;
      document.getElementById("version").innerHTML = version;
   
    })
    .catch(error => {
      console.log("Error retrieving location data: " + error);
    });
}

// call function to get visitor's location information
getVisitorLocation();
    </script>
    


    <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"></script>
    <footer class="footer">
        <div class="footer-left col-md-4 col-sm-6">
          <p class="about">
            <span> About us</span>The basic concept of Howdy Donor is to collect the donations from donors and distribute to  the  needy people accross Canada .
     </p>
        
        </div>
        <div class="footer-center col-md-4 col-sm-6">
          <div>
            <p><span> Contact</span> </p>
            
          </div>
          <div>
        
            <p> (+1) 123 456 7890</p>
            
          </div>
          <div>
            <!-- <i class="fa fa-envelope" style="font-size: 17px;
            line-height: 38px; color:white;"></i> -->
            <p><a href="#"> HowdyDonor@gmail.com</a></p>
          </div>
          
          <div class="sociallist">
            <ul class="social">
            <li><a href="https://www.facebook.com/TheAkshayaPatraFoundation/"><img src="https://i.ibb.co/x7P24fL/facebook.png"></a></li>
            <li><a href="https://twitter.com/globalgiving"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png"></a></li>
            <li><a href="https://www.instagram.com/charitism/"><img src="https://i.ibb.co/ySwtH4B/instagram.png"></a></li>
            <li><a href="https://web.whatsapp.com/"><i class="fa fa-whatsapp" style="font-size:50px;color: black;"></i></a></li>
           </ul>
          </div>
        </div>
        <div class="footer-right col-md-4 col-sm-6">
          <h2> Howdy<span> Donor</span></h2>
          <!-- <h2>Howdy Donor</h2> -->
          <p class="menu">
            <a href="#"> Home</a> |
            <a href="about.html"> About</a> |
            <a href="profile.php"> Profile</a> |
            <a href="contact.html"> Contact</a>
          </p>
          <p class="name"> Howdy Donor &copy 2024</p>
        </div>
      </footer>
  </body>
</html>
