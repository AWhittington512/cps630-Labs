<?php session_start(); ?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Cart</title>
  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛒</text></svg>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgEhxoik76va_nhG6KsA4DTa5JBr_Iz0I&callback=initMap"></script>
</head>

<?php include "navbar2.php" ?>

<div class="container my-4">
  <h1 class="text-center lead fs-2 m-4"><?php echo $_SESSION['username'] ?>'s Cart</h1>
  <div class="card w-75 rounded-3 m-auto">
    <table class="table bg-light m-auto rounded-3 text-center">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Size</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        <tr class="">
          <td scope="row">1</td>
          <td>T-Shirt</td>
          <td>S</td>
          <td>1</td>
          <td>$19.99</td>
          <td><button class="btn btn-danger btn-sm">Remove</button></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="w-75 m-auto" id="totals">
    <div class="d-flex justify-content-between p-2">
      <h5 class="fs-5">Subtotal</h5>
      <h5 class="fs-5">$19.99</h5>
    </div>
    <div class="d-flex justify-content-between p-2">
      <h5 class="fs-5">Taxes</h5>
      <h5 class="fs-5">$<?php echo round(19.99 * 0.13, 2);?></h5>
    </div>
    <hr>
    <div class="d-flex justify-content-between p-2">
      <h4 class="fs-5">Total</h4>
      <h4 class="fs-5">$<?php echo round(19.99 * 1.13, 2);?></h4>
    </div>
  </div>
  <div class="d-flex w-75 m-auto">
    <div class="m-auto">
      <button class="btn btn-success d-block m-auto my-2" (click)="this.clearCart()">Update cart</button>
    </div>
    <div class="m-auto">
      <button class="btn btn-danger d-block m-auto my-2" (click)="this.clearCart()">Clear cart</button>
    </div>
    <div class="m-auto">
      <a class="btn btn-outline-primary d-block m-auto my-2" type="submit" href="placingStore.php">Checkout</a>
    </div>
  </div>
</div>