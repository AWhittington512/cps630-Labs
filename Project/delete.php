<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
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

      if(isset($_POST['SubmitButton']))
      {
        include "phpScripts/DBConnect.php";
        $connection->query("DELETE FROM ".$_POST["tableName"]." WHERE ".$_POST["columnName"]." = ".$_POST["condition"]);

        echo('
          <div class="container">
            Records deleted.
          </div>
        ');
      }
    ?>
    <div class="container">
        <h1>Delete From Database</h1>

        <form action="delete.php" method="POST">
            <div class="mb-3">
                <label for="tableName" class="form-label">DELETE FROM</label>
                <input type="text" class="form-control" id="tableName" name="tableName" aria-describedby="idHelp" required>
                <label for="columnName" class="form-label">WHERE</label>
                <input type="text" class="form-control" id="columnName" name="columnName" required>
                <label for="condition" class="form-label">=</label>
                <input type="text" class="form-control" id="condition" name="condition" required>
            </div>
            <button type="submit" name="SubmitButton" class="btn btn-outline-success d-block m-auto my-2">Delete Records</button>
        </form>

  </div>
</body>
</html>
