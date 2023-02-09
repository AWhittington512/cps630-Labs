<?php
$artwork = array();

if(isset($_POST["saveRecord"])) {
    $record = array(
        "Genre" => $_POST["genre"],
        "Type" => $_POST["type"],
        "Subject" => $_POST["subject"],
        "Specification" => $_POST["specification"],
        "Year" => $_POST["year"],
        "Museum" => $_POST["museum"]
    );
    array_push($artwork, $record);
}

if(isset($_POST["clearRecord"])) {
    $artwork = array();
}

if(isset($_POST["getRecord"])) {
    $index = $_POST["index"];
    $record = $artwork[$index];
    echo "Genre: " . $record["Genre"] . "<br>";
    echo "Type: " . $record["Type"] . "<br>";
    echo "Subject: " . $record["Subject"] . "<br>";
    echo "Specification: " . $record["Specification"] . "<br>";
    echo "Year: " . $record["Year"] . "<br>";
    echo "Museum: " . $record["Museum"] . "<br>";
}
?>
