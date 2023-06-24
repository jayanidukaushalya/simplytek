<?php

session_start();

require "connection.php";

$email = $_SESSION["user"]["email"];

if (isset($email)) {

    $fname = $_GET["f"];
    $lname = $_GET["l"];
    $address = $_GET["a"];
    $city = $_GET["c"];
    $mobile = $_GET["m"];
    $isEmpty = $_GET["e"];

    if (empty($fname)) {
        echo "First Name is Required";
    } else if (strlen($fname) > 45) {
        echo "Invalid First Name";
    } else if (empty($lname)) {
        echo "Last Name is Required";
    } else if (strlen($lname) > 45) {
        echo "Invalid Last Name";
    } else if (empty($address)) {
        echo "Shopping Address is Required";
    } else if (strlen($address) > 100) {
        echo "Invalid Shopping Address";
    } else if (empty($city)) {
        echo "Please select a City";
    } else if (empty($mobile)) {
        echo "Mobile Number is Required";
    } else if (strlen($mobile) > 100) {
        echo "Invalid Mobile Number";
    } else {

        if ($isEmpty) {

            Database::iud("INSERT INTO `delivery_address`(`fname`, `lname`, `mobile`, `address`, `city_id`, `register_email`) VALUES('" . $fname . "', '" . $lname . "', '" . $mobile . "', '" . $address . "', " . $city . ", '" . $email . "')");
        } else {

            Database::iud("UPDATE `delivery_address` SET `fname` = '" . $fname . "', `lname` = '" . $lname . "', `mobile` = '" . $mobile . "', `address` = '" . $address . "', `city_id` = " . $city . " WHERE `register_email` = '" . $email . "'");
        }

        echo 2112;
    }
} else {
    header("Location: index.html");
}
