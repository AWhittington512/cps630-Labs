<?php

if (empty($_POST["name"])) {
    die("Name is required");
}

// validating the email
if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

// validating the password
// check if password is > 8
if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

// check if password contains letters and numbers
if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

// check if password exists
if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

// create a password hash
$pass_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

