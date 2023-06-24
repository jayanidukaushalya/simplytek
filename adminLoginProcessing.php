<?php

session_start();

require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];

if (empty($email)) {
    echo "Username is Required!";
} else if (empty($password)) {
    echo "Password is Required!";
} else {

    $result = Database::search("SELECT * FROM `admin` WHERE `email` = '".$email."' AND `password` = '".$password."'");
    $n = $result->num_rows;

    if ($n == 1) {

        $data = $result->fetch_assoc();

        $_SESSION["admin"] = $data;

        echo 42321;

    } else {
        echo "Invalid Username or Password, Please try again with correct Username and Password";
    }

}
?>