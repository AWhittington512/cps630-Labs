<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $artwork = include "array_database.php"; ?>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Lab2Part1.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
      rel="stylesheet"
    />

    <style>  
        table, th, td {
            border: 0.1em rgb(244, 132, 132) solid;
        }
    </style>

    <title>Lab02</title>
  </head>
  <body>
    <!-- HEADING + DESCRIPTION-->
    <div class="heading">
      <h2>Art Work Database</h2>
    </div>

    <div class="container">
      <!-- BOX FOR ARTWORK DISPLAY -->
      <div class="box">
        <div id="record">
          <?php if (isset($_POST["saveRecord"])): ?>
            <h2>Submitted Art Work Record:</h2>
            <p>
                <?php 
                    $record = array(
                        "Genre" => $_POST["genre"],
                        "Type" => $_POST["type"],
                        "Subject" => $_POST["subject"],
                        "Specification" => $_POST["specification"],
                        "Year" => $_POST["year"],
                        "Museum" => $_POST["museum"]
                    );
                    $artwork[] = $record;
                    
                    file_put_contents('array_database.php',  '<?php return ' . var_export($artwork, true) . '; ?>');

                    echo "<table><tr><th>Genre</th><th>Type</th><th>Subject</th><th>Specification</th><th>Year</th><th>Museum</th></tr>\n<tr>";

                    echo "<td>" . $record["Genre"] . "</td>";
                    echo "<td>" . $record["Type"] . "</td>";
                    echo "<td>" . $record["Subject"] . "</td>";
                    echo "<td>" . $record["Specification"] . "</td>";
                    echo "<td>" . $record["Year"] . "</td>";
                    echo "<td>" . $record["Museum"] . "</td>";
                ?>
            </p>
          <?php elseif (isset($_POST["getRecord"])): ?>
            <h2>Found Art Work Record:</h2>
            <p>
                <?php 
                    $index = $_POST["index"];
                    $record = $artwork[$index];

                    echo "<table><tr><th>Genre</th><th>Type</th><th>Subject</th><th>Specification</th><th>Year</th><th>Museum</th></tr>\n<tr>";

                    echo "<td>" . $record["Genre"] . "</td>";
                    echo "<td>" . $record["Type"] . "</td>";
                    echo "<td>" . $record["Subject"] . "</td>";
                    echo "<td>" . $record["Specification"] . "</td>";
                    echo "<td>" . $record["Year"] . "</td>";
                    echo "<td>" . $record["Museum"] . "</td>";
                ?>
            </p>
          <?php endif ?>
        </div>
      </div>
    </div>
  </body>
</html>