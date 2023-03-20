<?php 
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    require './phpScripts/DBConnect.php';
    
    $stmt = $connection->prepare("SELECT * FROM user_info WHERE Email = ? AND PW = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION['username'] = $row['UserName'];
            $_SESSION['email'] = $row['Email'];
            $_SESSION['phone'] = $row['Phone'];
            $_SESSION['address'] = $row['UserAddress'];
            $_SESSION['postcode'] = $row["CityCode"];
            $_SESSION['balance'] = $row['Balance'];
        }
        echo 'login successful';
        header("Location: ./index.php");
    } else {
    echo "login failed";
    }

    $stmt->close();
    $connection->close();
}
?>