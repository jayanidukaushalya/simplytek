<?php

require "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];

if (empty($email)) {
    echo "Email is Required!";
} else if (strlen($email) > 50) {
    echo "Email character length should be lower than 50";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid Email";
} else if (empty($password)) {
    echo "Password is Required!";
} else if (strlen($password) < 5) {
    echo "Password character length should be a value between 5 and 20";
} else if (strlen($password) > 20) {
    echo "Password character length should be a value between 5 and 20";
} else {

    $resultSet = Database::search("SELECT * FROM `register` WHERE `email` = '" . $email . "'");
    $n = $resultSet->num_rows;

    if ($n == 0) {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `register`(`email`, `password`, `date_time`, `status`) VALUES('" . $email . "', '" . $password . "', '" . $date . "', 1)");

        echo "65668";
    } else {
        echo "User already exists!";
    }
}
