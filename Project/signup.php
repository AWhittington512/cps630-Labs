<?php session_start();?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<?php
function validation()
{
  require './phpScripts/DBConnect.php';
  $message = array();
  $emailDuplicate = false;
  if ($_POST) {
    if (empty($_POST["name"])) {
      array_push($message, "Name is required");
    }

    // validating the email
    // also checks for email duplicate
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      array_push($message, "Valid email is required");
    }
    $emailQuery = "SELECT * FROM user_info WHERE email = '".$_POST["email"]."'";
    $result = $connection->query($emailQuery);
    $row = $result->fetch_assoc();
    if (is_array($row) && count($row)>0) {
      $emailDuplicate = true;
    }
    // validating the password
    // check if password is > 8
    if (strlen($_POST["password"]) < 8) {
      array_push($message, "Password must be at least 8 characters");
    }

    // check if password contains letters and numbers
    if (!preg_match("/[a-z]/i", $_POST["password"])) {
      array_push($message, "Password must contain at least one letter");
    }

    if (!preg_match("/[0-9]/", $_POST["password"])) {
        array_push($message, "Password must contain at least one number");
    }

    // check if password exists
    if ($_POST["password"] !== $_POST["password_confirmation"]) {
        array_push($message, "Passwords must match");
    }

    if(!preg_match('/^[0-9]{10}+$/', $_POST["telephone"])) {
        array_push($message, "Invalid phone number");
    }

    if (!preg_match('/^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/', $_POST["postcode"])) {
        array_push($message, "Invalid postal code");
    }

    if ($emailDuplicate === true) {
      echo '
      <div class="container-fluid">
        <div class="card w-75 m-auto my-4 text-center">
          <div class="card-header">
            Sign Up Failed
          </div>
          <div class="card-body">
          <p class="card-text">There is already an account with this email, please use a different email address</p>
            <a href="index.php" class="btn btn-primary">Try again</a>
          </div>
        </div>
      </div>
    ';
    } else if ($message) {
      echo '
      <div class="container-fluid">
        <div class="card w-75 m-auto my-4 text-center">
          <div class="card-header">
            Sign Up Failed
          </div>
          <div class="card-body">
          <p class="card-text">';
            foreach ($message as $error) {
              echo $error . "<br>";
            }
        echo '</p>
            <a href="index.php" class="btn btn-primary">Try again</a>
          </div>
        </div>
      </div>
    ';
    }
    else if (!$message) {
      $name = $_POST["name"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $phone = $_POST["telephone"];
      $postal = $_POST["postcode"];
      $address = $_POST["streetaddr"] . ", " . $_POST["city"] . ", " . $_POST["province"] . " " . $postal;
      
      $query = "INSERT INTO user_info (UserName, Phone, Email, UserAddress, CityCode, PW) VALUES ('$name', '$phone', '$email', '$address', '$postal', '$password')";
      if ($connection->query($query) === true) {
        echo '
        <div class="container-fluid">
          <div class="card w-75 m-auto my-4 text-center">
            <div class="card-header">
              Sign Up Successful
            </div>
            <div class="card-body">
            <p class="card-text">Return to home to log in with your new account</p>
              <a href="index.php" class="btn btn-primary">Home</a>
            </div>
          </div>
        </div>
        ';
      } else {
        echo "Database error!";
      }
    }
  }
}
validation();

// $pass_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
?>