<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Search</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🛒</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgEhxoik76va_nhG6KsA4DTa5JBr_Iz0I&callback=initMap"></script>
</head>
<body>
    <?php
      if (isset($_SESSION['email'])) {
        include 'navbar2.php';
      } else {
        include 'navbar.php';
      }
    ?>
    <div class="container">

        <h1>
            Search Results:
        </h1>

        <?php if (isset($_POST['SubmitButton'])) : ?>

            <?php
                include "phpScripts/DBConnect.php";

                $result = $connection->query("SELECT * FROM Order_Info WHERE OrderID = ".$_POST["orderID"]);
                if ($result->num_rows != 0) {
                    $row = $result->fetch_assoc();
                    
                    echo('
                        <table class="table">
                            <thead>
                                <tr>
                    ');

                    foreach(array_keys($row) as $column)
                    {
                        echo('
                            <th scope="col">'.$column.'</th>
                        ');
                    }

                    echo('
                            </tr>
                        </thead>
                        <tbody>
                    ');

                    do
                    {
                        echo('
                            <tr>
                        ');
                        foreach($row as $value)
                        {
                            echo('
                                <td>'.$value.'</td>
                            ');
                        }
                        echo('
                            </tr>
                        ');
                    } while ($row = $result->fetch_assoc());

                    echo('
                            </tbody>
                        </table>
                    ');
                }
                else
                {
                    echo("No rows were found for that query.");
                }
            ?>

        <?php else : ?>

            Please enter a search query.

        <?php endif ?>
    </div>
</body>
</html>
