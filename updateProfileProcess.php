<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

    $fname = $_GET["f"];
    $lname = $_GET["l"];
    $mobile = $_GET["m"];

    if (empty($fname)) {
        echo "First Name is Required";
    } else if (strlen($fname) > 45) {
        echo "First Name character length should be lower than 45";
    } else if (empty($lname)) {
        echo "Last Name is Required";
    } else if (strlen($lname) > 45) {
        echo "Last Name character length should be lower than 45";
    } else if (empty($mobile)) {
        echo "Mobile Number is Required";
    } else if (strlen($mobile) > 10) {
        echo "Mobile Name character length should be lower than 45";
    } else {

        Database::iud("UPDATE `register` SET `fname` = '".$fname."', `lname` = '".$lname."', `mobile` = '".$mobile."' WHERE `email` = '".$_SESSION["user"]["email"]."'");

        echo 98252;
    }

} else {
    header("Location: index.php");
}

?>