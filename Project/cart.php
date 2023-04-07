<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

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

<?php
include "navbar2.php";
if (isset($_POST['remove'])) {
  for ($i = 0; $i <= count($_SESSION['cart']); $i++) {
    if ($_SESSION['cart'][$i]['productID'] == $_POST['IDtoRemove']) {
      unset($_SESSION['cart'][$i]);
      header("Refresh:0");
    }
  }
} 
if (isset($_POST['clearCart'])) {
  unset($_SESSION['cart']);
  header("Refresh:0");
}

function getSubtotal() {
  $total = 0;
  foreach ($_SESSION['cart'] as $cart_item) {
    $total += (float) $cart_item['productPrice'] * $cart_item['productQuantity'];
  }
  return $total;
}

function getTaxes($value) {
  return (float) round($value * 0.13, 2);
}

function getTotal($sub, $tax) {
  return (float) round($sub + $tax, 2);
}

function setPrices($subtotal, $taxes, $total) {
  $_SESSION['subtotal'] = $subtotal;
  $_SESSION['taxes'] = $taxes; 
  $_SESSION['total'] = $total;
}
?>

<div class="container my-4">
  <form method="POST">
    <h1 class="text-center lead fs-2 m-4"><?php echo $_SESSION['username'] ?>'s Cart</h1>
    <div class="card w-75 rounded-3 m-auto">
      <?php if (!empty($_SESSION['cart'])) { ?>
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
            <?php
            foreach ($_SESSION['cart'] as $cart_item) { ?>
              <tr>
                <td scope="row"><?php echo $cart_item['productID']; ?></td>
                <td><?php echo $cart_item['productName']; ?></td>
                <td><?php echo $cart_item['productSize']; ?></td>
                <td><?php echo $cart_item['productQuantity']; ?></td>
                <td>$<?php echo $cart_item['productPrice']; ?></td>
                <input type='hidden' name='IDtoRemove' value=<?php echo $cart_item['productID'] ?>>
                <td><button class="btn btn-danger btn-sm" name="remove" type="submit">Remove</button></td>
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
          <?php echo getSubtotal(); ?>
        </h5>
      </div>
      <div class="d-flex justify-content-between p-2">
        <h5 class="fs-5">Taxes</h5>
        <h5 class="fs-5">$<?php echo getTaxes(getSubtotal()); ?></h5>
      </div>
      <hr>
      <div class="d-flex justify-content-between p-2">
        <h4 class="fs-5">Total</h4>
        <h4 class="fs-5">$<?php echo getTotal(getSubtotal(), getTaxes(getSubtotal())) ?></h4>
        <?php setPrices(getSubtotal(), getTaxes(getSubtotal()), getTotal(getSubtotal(), getTaxes(getSubtotal()))); ?>
      </div>
    </div>
    <div class="d-flex w-25 m-auto">
      <div class=" m-auto">
        <button class="btn btn-danger d-block m-auto my-2" name="clearCart" type="submit">Clear cart</button>
      </div>
      <div class=" m-auto">
        <a class="btn btn-outline-primary d-block m-auto my-2" name="checkout" type="submit" href="placingStore.php">Checkout</a>
      </div>
    </div>
  <?php
      } else { ?>
    <div class="card text-center p-2">Your cart is empty.</div>
  <?php
      }
  ?>
  </form>
</div>