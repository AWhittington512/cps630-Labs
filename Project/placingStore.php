<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Invoice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <?php
  include 'navbar2.php';
  ?>

  <!-- <div class="d-inline-flex p-2"></div>Invoice #12345</div> -->
  <div class="container-fluid">
    <form method="POST" action="placingShip.php">
      <div class="row m-0">
        <div class="col">
          <div class="row p-2">
            <h1>Order</h1>
          </div>
          <div class="row p-2">
            <h2>Originating store</h2>
            <div class="container">
              <select class="form-select" name="store">
                <option value="Queen St W, Toronto">Queen St W, Toronto</option>
                <option value="CF Markville, Markham">CF Markville, Markham</option>
                <option value="Square One Shopping Centre, Mississauga">Square One Shopping Centre, Mississauga</option>
              </select>
            </div>
          </div>
          <div class="row p-2">
            <h2>Ship to</h2>
            <div class="row p-2">
              <div class="col">
                <input type="text" name="firstName" class="form-control" placeholder="First name" required>
              </div>
              <div class="col">
                <input type="text" name="lastName" class="form-control" placeholder="Last name" required>
              </div>
            </div>
            <input type="text" name="shippingAddr" class="form-control" placeholder="Address" required>
            <div class="row p-2">
              <div class="col">
                <input type="text" name="cityAddr" class="form-control" placeholder="City" required>
              </div>
              <div class="col col-sm-2">
                <select class="form-select" id="province" name="provinceAddr" required>
                  <option disabled>Province</option>
                  <option value="AB">AB</option>
                  <option value="BC">BC</option>
                  <option value="MB">MB</option>
                  <option value="NB">NB</option>
                  <option value="NL">NL</option>
                  <option value="NS">NS</option>
                  <option value="NT">NT</option>
                  <option value="NU">NU</option>
                  <option value="ON" selected>ON</option>
                  <option value="PE">PE</option>
                  <option value="QC">QC</option>
                  <option value="SK">SK</option>
                  <option value="YT">YT</option>
                </select>
              </div>
              <div class="col col-sm-3">
                <input type="text" class="form-control" name="postcodeAddr" placeholder="Postal Code" required>
              </div>
            </div>
          </div>

        </div>
        <div class="col col-sm-5 p-2">
          <div class="card w-75 rounded-3 m-auto">
            <table class="table bg-light m-auto rounded-3 text-center">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Size</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Price</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($_SESSION['cart'] as $cart_item) { ?>
                  <tr>
                    <td scope="row"><?php echo $cart_item['productID']; ?></td>
                    <td><?php echo $cart_item['productName']; ?></td>
                    <td><?php echo $cart_item['productSize']; ?></td>
                    <td><?php echo $cart_item['productQuantity']; ?></td>
                    <td>$<?php echo $cart_item['productPrice']; ?></td>
                    <input type='hidden' name='IDtoRemove' value=<?php echo $cart_item['productID'] ?>>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="w-75 m-auto" id="totals">
            <div class="d-flex justify-content-between p-2">
              <h5 class="fs-5">Subtotal</h5>
              <h5 class="fs-5">
                <?php echo $_SESSION['subtotal']; ?>
              </h5>
            </div>
            <div class="d-flex justify-content-between p-2">
              <h5 class="fs-5">Taxes</h5>
              <h5 class="fs-5">$<?php echo $_SESSION['taxes']; ?></h5>
            </div>
            <hr>
            <div class="d-flex justify-content-between p-2">
              <h4 class="fs-5">Total</h4>
              <h4 class="fs-5">$<?php echo $_SESSION['total']; ?></h4>
            </div>
          </div>
          <div class="d-flex justify-content-center m-2">
            <a href="cart.php" class="btn btn-outline-secondary w-auto"><- Back</a>
                <a href="placingShip.php">
                  <button type="submit" name="next" class="btn btn-outline-primary w-auto">Next -></button>
                </a>
          </div>
        </div>
      </div>
    </form>
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