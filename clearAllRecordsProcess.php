<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

    $email = $_SESSION["user"]["email"];

    $result = Database::search("SELECT it.`id` FROM `invoice` i INNER JOIN `invoice_item` it WHERE i.`register_email` = '" . $email . "'");
    $n = $result->num_rows;

    for ($i = 0; $i < $n; $i++) {

        $data = $result->fetch_assoc();

        Database::iud("UPDATE `invoice_item` SET `status` = 0 WHERE `id` = " . $data["id"] . "");

        echo 4522;
    }
} else {
    header("Location: index.php");
}
