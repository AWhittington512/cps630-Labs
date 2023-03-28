<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛒</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgEhxoik76va_nhG6KsA4DTa5JBr_Iz0I&callback=initMap"></script>

    <?php
      include "phpScripts/DBConnect.php";
    ?>
</head>
<body>
    <?php
      if (isset($_SESSION['email'])) {
        include 'navbar2.php';
      } else {
        include 'navbar.php';
      }

      if(isset($_POST['orderSubmitButton']))
      {
        include "phpScripts/DBConnect.php";
        $connection->query("INSERT INTO Order_Info (OrderID, DateIssued, DateReceived, TotalPrice, PaymentCode, UserID, TripID, ReceiptID)
          VALUES (".$_POST["orderid"].",".$_POST["dateIssued"].",".$_POST["dateReceived"].",".$_POST["totalPrice"].",".$_POST["paymentCode"].",".$_POST["userID"].",".$_POST["tripID"].",".$_POST["receiptID"].")");

        echo('
          <div class="container">
            Record inserted.
          </div>
        ');
      }
      elseif(isset($_POST['itemSubmitButton']))
      {
        include "phpScripts/DBConnect.php";
        $connection->query("INSERT INTO Item (ItemID, ItemName, ItemPrice, MadeIn, DeptCode, ItemImageURL)
          VALUES (".$_POST["itemID"].",".$_POST["itemName"].",".$_POST["itemPrice"].",".$_POST["madeIn"].",".$_POST["deptCode"].",".$_POST["itemImageURL"].")");

        echo('
          <div class="container">
            Record inserted.
          </div>
        ');
      }
      elseif(isset($_POST['userSubmitButton']))
      {
        include "phpScripts/DBConnect.php";
        $connection->query("INSERT INTO User_Info (UserID, UserName, Phone, Email, UserAddress, CityCode, LoginID, PW, Balance, Administrator)
          VALUES (".$_POST["userID"].",".$_POST["userName"].",".$_POST["phone"].",".$_POST["email"].",".$_POST["userAddress"].",".$_POST["cityCode"].",".$_POST["loginID"].",".$_POST["PW"].$_POST["balance"].",".$_POST["administrator"].")");

        echo('
          <div class="container">
            Record inserted.
          </div>
        ');
      }
      elseif(isset($_POST['tripSubmitButton']))
      {
        include "phpScripts/DBConnect.php";
        $connection->query("INSERT INTO Trip (TripID, SourceCode, DestinationCode, Distance, TruckID, TotalPrice)
          VALUES (".$_POST["tripID"].",".$_POST["sourceCode"].",".$_POST["destinationCode"].",".$_POST["distance"].",".$_POST["truckID"].",".$_POST["totalPrice"].")");

        echo('
          <div class="container">
            Record inserted.
          </div>
        ');
      }
      elseif(isset($_POST['truckSubmitButton']))
      {
        include "phpScripts/DBConnect.php";
        $connection->query("INSERT INTO Truck (TruckID, TruckCode, AvailabilityCode)
          VALUES (".$_POST["truckID"].",".$_POST["truckCode"].",".$_POST["availabilityCode"].")");

        echo('
          <div class="container">
            Record inserted.
          </div>
        ');
      }
      elseif(isset($_POST['shoppingSubmitButton']))
      {
        include "phpScripts/DBConnect.php";
        $connection->query("INSERT INTO Shopping (ReceiptID, StoreCode, TotalPrice)
          VALUES (".$_POST["receiptID"].",".$_POST["storeCode"].",".$_POST["totalPrice"].")");

        echo('
          <div class="container">
            Record inserted.
          </div>
        ');
      }
      elseif(isset($_POST['cartSubmitButton']))
      {
        include "phpScripts/DBConnect.php";
        $connection->query("INSERT INTO Shopping_Cart (UserID, ItemID, Quantity)
          VALUES (".$_POST["userID"].",".$_POST["itemID"].",".$_POST["quantity"].")");

        echo('
          <div class="container">
            Record inserted.
          </div>
        ');
      }
    ?>
    <div class="container">
        <h1>Insert Into Database</h1>

        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="databaseSelectMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Choose Database
            </button>
            <div class="dropdown-menu" aria-labelledby="databaseSelectMenuButton">
            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#orderModal">Order_Info</button>
            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#itemModal">Item</button>
            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#userDBModal">User_Info</button>
            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#tripModal">Trip</button>
            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#truckModal">Truck</button>
            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#shoppingModal">Shopping</button>
            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#cartModal">Shopping_Cart</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderModal" aria-hidden="true" aria-labelledby="logInModalLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 lead">Insert into Order_Info table</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <form action="insert.php" method="POST">
              <div class="mb-3">
                <label for="orderid" class="form-label">OrderID</label>
                <input type="text" class="form-control" id="orderid" name="orderid" aria-describedby="idHelp" required>
              </div>
              <div class="mb-3">
                <label for="dateIssued" class="form-label">DateIssued</label>
                <input type="date" class="form-control" id="dateIssued" name="dateIssued" required>
              </div>
              <div class="mb-3">
                <label for="dateReceived" class="form-label">DateReceived</label>
                <input type="date" class="form-control" id="dateReceived" name="dateReceived" required>
              </div>
              <div class="mb-3">
                <label for="totalPrice" class="form-label">TotalPrice</label>
                <input type="number" class="form-control" id="totalPrice" name="totalPrice" step="any" required>
              </div>
              <div class="mb-3">
                <label for="paymentCode" class="form-label">PaymentCode</label>
                <input type="number" class="form-control" id="paymentCode" name="paymentCode" required>
              </div>
              <div class="mb-3">
                <label for="userID" class="form-label">UserID</label>
                <input type="number" class="form-control" id="userID" name="userID" required>
              </div>
              <div class="mb-3">
                <label for="tripID" class="form-label">TripID</label>
                <input type="number" class="form-control" id="tripID" name="tripID" required>
              </div>
              <div class="mb-3">
                <label for="receiptID" class="form-label">ReceiptID</label>
                <input type="number" class="form-control" id="receiptID" name="receiptID" required>
              </div>
              <button type="submit" name="orderSubmitButton" class="btn btn-outline-success d-block m-auto my-2">Insert</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="itemModal" aria-hidden="true" aria-labelledby="logInModalLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 lead">Insert into Item table</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <form action="insert.php" method="POST">
              <div class="mb-3">
                <label for="itemID" class="form-label">ItemID</label>
                <input type="number" class="form-control" id="itemID" name="itemID" aria-describedby="idHelp" required>
              </div>
              <div class="mb-3">
                <label for="itemName" class="form-label">ItemName</label>
                <input type="text" class="form-control" id="itemName" name="itemName" required>
              </div>
              <div class="mb-3">
                <label for="itemPrice" class="form-label">ItemPrice</label>
                <input type="number" step="any" class="form-control" id="itemPrice" name="itemPrice" required>
              </div>
              <div class="mb-3">
                <label for="madeIn" class="form-label">MadeIn</label>
                <input type="text" class="form-control" id="madeIn" name="madeIn" required>
              </div>
              <div class="mb-3">
                <label for="deptCode" class="form-label">DeptCode</label>
                <input type="number" class="form-control" id="deptCode" name="deptCode" required>
              </div>
              <div class="mb-3">
                <label for="itemImageURL" class="form-label">ItemImageURL</label>
                <input type="text" class="form-control" id="itemImageURL" name="itemImageURL" required>
              </div>
              <button type="submit" name="itemSubmitButton" class="btn btn-outline-success d-block m-auto my-2">Insert</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="userDBModal" aria-hidden="true" aria-labelledby="logInModalLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 lead">Insert into User_Info table</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <form action="insert.php" method="POST">
              <div class="mb-3">
                <label for="userID" class="form-label">UserID</label>
                <input type="number" class="form-control" id="userID" name="userID" aria-describedby="idHelp" required>
              </div>
              <div class="mb-3">
                <label for="userName" class="form-label">UserName</label>
                <input type="text" class="form-control" id="userName" name="userName" required>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" step="any" class="form-control" id="phone" name="phone" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="userAddress" class="form-label">UserAddress</label>
                <input type="text" class="form-control" id="userAddress" name="userAddress" required>
              </div>
              <div class="mb-3">
                <label for="cityCode" class="form-label">CityCode</label>
                <input type="number" class="form-control" id="cityCode" name="cityCode" required>
              </div>
              <div class="mb-3">
                <label for="loginID" class="form-label">LoginID</label>
                <input type="text" class="form-control" id="loginID" name="loginID" required>
              </div>
              <div class="mb-3">
                <label for="PW" class="form-label">PW</label>
                <input type="text" class="form-control" id="PW" name="PW" required>
              </div>
              <div class="mb-3">
                <label for="balance" class="form-label">Balance</label>
                <input type="number" class="form-control" id="balance" name="balance" step="any" required>
              </div>
              <div class="mb-3">
                <label for="administrator" class="form-label">Administrator (Y/N)</label>
                <input type="text" class="form-control" id="administrator" name="administrator" required>
              </div>
              <button type="submit" name="userSubmitButton" class="btn btn-outline-success d-block m-auto my-2">Insert</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="tripModal" aria-hidden="true" aria-labelledby="logInModalLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 lead">Insert into Trip table</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <form action="insert.php" method="POST">
              <div class="mb-3">
                <label for="tripID" class="form-label">TripID</label>
                <input type="number" class="form-control" id="tripID" name="tripID" aria-describedby="idHelp" required>
              </div>
              <div class="mb-3">
                <label for="sourceCode" class="form-label">SourceCode</label>
                <input type="number" class="form-control" id="sourceCode" name="sourceCode" required>
              </div>
              <div class="mb-3">
                <label for="destinationCode" class="form-label">DestinationCode</label>
                <input type="number" class="form-control" id="destinationCode" name="destinationCode" required>
              </div>
              <div class="mb-3">
                <label for="distance" class="form-label">Distance</label>
                <input type="number" step="any" class="form-control" id="distance" name="distance" required>
              </div>
              <div class="mb-3">
                <label for="truckID" class="form-label">TruckID</label>
                <input type="number" class="form-control" id="truckID" name="truckID" required>
              </div>
              <div class="mb-3">
                <label for="totalPrice" class="form-label">TotalPrice</label>
                <input type="number" step="any" class="form-control" id="totalPrice" name="totalPrice" required>
              </div>
              <button type="submit" name="tripSubmitButton" class="btn btn-outline-success d-block m-auto my-2">Insert</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="truckModal" aria-hidden="true" aria-labelledby="logInModalLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 lead">Insert into Truck table</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <form action="insert.php" method="POST">
              <div class="mb-3">
                <label for="truckID" class="form-label">TruckID</label>
                <input type="number" class="form-control" id="truckID" name="truckID" aria-describedby="idHelp" required>
              </div>
              <div class="mb-3">
                <label for="truckCode" class="form-label">TruckCode</label>
                <input type="number" class="form-control" id="truckCode" name="truckCode" required>
              </div>
              <div class="mb-3">
                <label for="availabilityCode" class="form-label">AvailabilityCode</label>
                <input type="number" class="form-control" id="availabilityCode" name="availabilityCode" required>
              </div>
              <button type="submit" name="truckSubmitButton" class="btn btn-outline-success d-block m-auto my-2">Insert</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="shoppingModal" aria-hidden="true" aria-labelledby="logInModalLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 lead">Insert into Shopping table</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <form action="insert.php" method="POST">
              <div class="mb-3">
                <label for="receiptID" class="form-label">ReceiptID</label>
                <input type="number" class="form-control" id="receiptID" name="receiptID" aria-describedby="idHelp" required>
              </div>
              <div class="mb-3">
                <label for="storeCode" class="form-label">StoreCode</label>
                <input type="number" class="form-control" id="storeCode" name="storeCode" required>
              </div>
              <div class="mb-3">
                <label for="totalPrice" class="form-label">TotalPrice</label>
                <input type="number" step="any" class="form-control" id="totalPrice" name="totalPrice" required>
              </div>
              <button type="submit" name="shoppingSubmitButton" class="btn btn-outline-success d-block m-auto my-2">Insert</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="cartModal" aria-hidden="true" aria-labelledby="logInModalLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 lead">Insert into Shopping_Cart table</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <form action="insert.php" method="POST">
              <div class="mb-3">
                <label for="userID" class="form-label">UserID</label>
                <input type="number" class="form-control" id="userID" name="userID" aria-describedby="idHelp" required>
              </div>
              <div class="mb-3">
                <label for="itemID" class="form-label">ItemID</label>
                <input type="number" class="form-control" id="itemID" name="itemID" required>
              </div>
              <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
              </div>
              <button type="submit" name="cartSubmitButton" class="btn btn-outline-success d-block m-auto my-2">Insert</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>
</html>
