<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Order completed</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <?php
  if (isset($_SESSION['email'])) {
    include 'navbar2.php';
  } else {
    include 'navbar.php';
  }
  ?>

  <div class="container text-center">
    <div class="row align-items-center">
      <h2>Hi name, order #number has been received!</h2>
      <h3>You can view your invoice <a href="invoice.html#number">here</a></h3>
      <p>Truck #number has been assigned to your order.</p>
    </div>
    <div id="map-canvas" class="row"></div>
    <div class="row justify-content-center">
      <a href="index.html" class="btn btn-outline-primary w-auto">Back</a>
    </div>
  </div>
</body>

</html>

<style>
  * {
    margin: 0;
    padding: 0;
  }

  #map-canvas {
    height: 300px;
    width: 300px;
    margin: 2em auto;
    box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;
    border-radius: 1em;
  }

  button,
  input[type="submit"] {
    transition: all 200ms ease;
    font-family: sans-serif;
    background-color: white;
    color: black;
    border: 1px solid;
    padding: 1em;
    cursor: pointer;
    border-radius: 0.5em;
  }

  h1,
  h2,
  h3 {
    font-weight: 300;
  }

  button:hover,
  input[type="submit"]:hover {
    background-color: #4285f4;
  }
</style>

<script>
  var resultMarker, geocoder, map, pointA, pointB, lat, lng;

  function initMap() {
    pointA = {
      lat: 43.65800227880846,
      lng: -79.37824216664713
    };
    pointB = {
      lat: 43.652817020875794,
      lng: -79.38178268258154
    };
    (myOptions = {
      zoom: 7,
      center: pointB,
    }),
    (map = new google.maps.Map(
      document.getElementById("map-canvas"),
      myOptions
    )),
    // Instantiate a directions service.
    (directionsService = new google.maps.DirectionsService()),
    (directionsDisplay = new google.maps.DirectionsRenderer({
      map: map,
    }));

    // get route from A to B
    calculateAndDisplayRoute(
      directionsService,
      directionsDisplay,
      pointA,
      pointB
    );
  }

  function calculateAndDisplayRoute(
    directionsService,
    directionsDisplay,
    pointA,
    pointB
  ) {

    directionsService.route({
        origin: pointA,
        destination: pointB,
        avoidTolls: true,
        avoidHighways: false,
        travelMode: google.maps.TravelMode.DRIVING,
      },
      function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
          directionsDisplay.setDirections(response);
        } else {
          window.alert("Directions request failed due to " + status);
        }
      }
    );
  }

  function codeAddress(coords) {
    geocoder.geocode({
      address: coords
    }, function(results, status) {
      if (status == "OK") {
        map.setCenter(results[0].geometry.location);
        if (!resultMarker) {
          resultMarker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location,
          });

          var resultInfo = new google.maps.InfoWindow({
            content: "<h3>Geocoding Search Result</h3><p>" + coords + "</p>",
          });
          resultMarker.addListener("click", () => {
            resultInfo.open(map, resultMarker);
          });
          resultInfo.open(map, resultMarker);
        } else {
          // Move marker
          resultMarker.setPosition(results[0].geometry.location);
        }
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(getCoords);
    } else {
      alert("Geolocation is not supported by this browser");
    }
  }

  function getCoords(position) {
    address = position.coords.latitude + ", " + position.coords.longitude;
    codeAddress(address);
  }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJxUi5ZgzqycwNyxR4W7JjPTqmT935IEE&callback=initMap"></script>