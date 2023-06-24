<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

    $email = $_SESSION["user"]["email"];
    $delivery_id = $_GET["did"];

    if (empty($delivery_id)) {

    } else {
        $order_id = uniqid();
        $array;

        $result = Database::search("SELECT c.`name`, r.`fname` AS `reg_fname`, r.`lname` AS `reg_lname`, r.`mobile` AS `reg_mobile` FROM `delivery_address` d INNER JOIN `city` c ON d.`city_id` = c.`id` INNER JOIN `register` r ON d.`register_email` = r.`email` WHERE d.`id` = " . $delivery_id . "");
        $n = $result->num_rows;
        $data = $result->fetch_assoc();

        $array["reg_fname"] = $data["reg_fname"];
        $array["reg_lname"] = $data["reg_lname"];
        $array["reg_mobile"] = $data["reg_mobile"];
        $array["email"] = $email;
        $array["oid"] = $order_id;

        echo json_encode($array);
    }
} else {
    header("Location: index.php");
}
