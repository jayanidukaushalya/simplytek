<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

    $id = $_GET["id"];

    Database::iud("UPDATE `invoice_item` SET `status` = 0 WHERE `id` = ".$id."");

    echo 2131;

} else {
    header("Location: index.php");
}

?>