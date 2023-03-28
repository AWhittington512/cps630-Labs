<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
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
        $connection->query("UPDATE ".$_POST["tableName"]." SET ".$_POST["changeColumnName"]." = ".$_POST["updateValue"]." WHERE ".$_POST["conditionColumnName"]." = ".$_POST["condition"]);

        echo('
          <div class="container">
            Records updated.
          </div>
        ');
      }
    ?>
    <div class="container">
        <h1>Update Records In Database</h1>

        <form action="update.php" method="POST">
            <div class="mb-3">
                <label for="tableName" class="form-label">UPDATE</label>
                <input type="text" class="form-control" id="tableName" name="tableName" aria-describedby="idHelp" required>
                <label for="changeColumnName" class="form-label">SET</label>
                <input type="text" class="form-control" id="changeColumnName" name="changeColumnName" aria-describedby="idHelp" required>
                <label for="updateValue" class="form-label">=</label>
                <input type="text" class="form-control" id="updateValue" name="updateValue" aria-describedby="idHelp" required>
                <label for="conditionColumnName" class="form-label">WHERE</label>
                <input type="text" class="form-control" id="conditionColumnName" name="conditionColumnName" required>
                <label for="condition" class="form-label">=</label>
                <input type="text" class="form-control" id="condition" name="condition" required>
            </div>
            <button type="submit" name="SubmitButton" class="btn btn-outline-success d-block m-auto my-2">Update Records</button>
        </form>

  </div>
</body>
</html>
