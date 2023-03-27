<?php
session_start();?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  require './phpScripts/DBConnect.php';

  $stmt = $connection->prepare("SELECT * FROM user_info WHERE Email = ? AND PW = ?");
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $_SESSION['username'] = $row['UserName'];
      $_SESSION['email'] = $row['Email'];
      $_SESSION['phone'] = $row['Phone'];
      $_SESSION['address'] = $row['UserAddress'];
      $_SESSION['postcode'] = $row["CityCode"];
      $_SESSION['balance'] = $row['Balance'];
    }
    header("Location: ./index.php");
  } else {
    echo '
      <div class="container-fluid">
        <div class="card w-75 m-auto my-4 text-center">
          <div class="card-header">
            Log In Failed
          </div>
          <div class="card-body">
          <p class="card-text">Your log in credentials are incorrect or do not exist</p>
            <a href="index.php" class="btn btn-primary">Try again</a>
          </div>
        </div>
      </div>
    ';
  }

  $stmt->close();
  $connection->close();
}
