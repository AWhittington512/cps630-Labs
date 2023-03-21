<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <?php
    if (isset($_SESSION['email'])) {
      include 'navbar2.php';
    } else {
      include 'navbar.html';
    }
    ?>
  <div class="bg-primary bg-gradient d-flex align-items-center justify-content-center flex-column" style="height:300px;">
    <h1 class="display-4 text-white">About Us</h1>
    <p class="text-white lead">General and contact information of our team</p>
  </div>
  <div class="container-fluid d-flex justify-content-center flex-wrap p-4">
    <div class="card text-bg-light m-4 shadow" style="max-width: 17rem;">
      <div class="card-header bg-white text-center">
        <img src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" width="50%">
      </div>
      <div class="card-body">
        <h5 class="card-title lead fs-4">Adam Whittington</h5>
        <p class="card-subtitle">adam.whittington@torontomu.ca</p>
      </div>
    </div>
    <div class="card text-bg-light m-4 shadow" style="max-width: 17rem;">
      <div class="card-header bg-white text-center">
        <img src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" width="50%">
      </div>
      <div class="card-body">
        <h5 class="card-title lead fs-4">Bill Wang</h5>
        <p class="card-subtitle">bill.wang@torontomu.ca</p>
      </div>
    </div>
    <div class="card text-bg-light m-4 shadow" style="max-width: 17rem;">
      <div class="card-header bg-white text-center">
        <img src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" width="50%">
      </div>
      <div class="card-body">
        <h5 class="card-title lead fs-4">Michelle Vu</h5>
        <p class="card-subtitle">michelle.vu@torontomu.ca</p>
      </div>
    </div>
    <div class="card text-bg-light m-4 shadow" style="max-width: 17rem;">
      <div class="card-header bg-white text-center">
        <img src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" width="50%">
      </div>
      <div class="card-body">
        <h5 class="card-title lead fs-4">Maheen Rathod</h5>
        <p class="card-subtitle">maheen.rathod@torontomu.ca</p>
      </div>
    </div>
    <div class="card text-bg-light m-4 shadow" style="max-width: 17rem;">
      <div class="card-header bg-white text-center">
        <img src="https://t4.ftcdn.net/jpg/02/29/75/83/360_F_229758328_7x8jwCwjtBMmC6rgFzLFhZoEpLobB6L8.jpg" width="50%">
      </div>
      <div class="card-body">
        <h5 class="card-title lead fs-4">Peter Tran</h5>
        <p class="card-subtitle">khang.tran@torontomu.ca</p>
      </div>
    </div>
  </div>
</body>

</html>
