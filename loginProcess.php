<?php

session_start();

require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberme = $_POST["r"];

if (empty($email)) {
    echo "Email is Required!";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email";
} else if (empty($password)) {
    echo "Password is Required!";
} else {

    $resultSet = Database::search("SELECT * FROM `register` WHERE `email` = '" . $email . "' AND `password` = '".$password."'");
    $n = $resultSet->num_rows;

    if ($n == 1) {

        echo "69887";

        $data = $resultSet->fetch_assoc();
        $_SESSION["user"] = $data;

        if ($rememberme == "true") {
            setcookie("email", $email, time() + (60 * 60 * 24 * 15));
            setcookie("password", $password, time() + (60 * 60 * 24 * 15));
        } else {
            setcookie("email", "", -1);
            setcookie("password", "", -1);
        }

    } else {
        echo "Invalid email or password!";
    }
}
