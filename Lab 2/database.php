<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "testnew";
$connection = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno()) {
    echo "Connection failed.";
    die(mysqli_connect_error());
} else {
    echo "<h3>Connection established.</h3>";
}
?>