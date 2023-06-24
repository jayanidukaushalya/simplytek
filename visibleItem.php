<?php

session_start();

require "connection.php";

if (isset($_SESSION["admin"])) {

    $id = $_GET["id"];

    Database::iud("UPDATE `product` SET `status` = 1 WHERE `id` = '".$id."'");
    echo 3333;
} else {
    header("Location: adminLogin.php");
}
