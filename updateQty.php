<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"]["email"])) {

    $qty = $_GET["qty"];
    $id = $_GET["id"];

    if ($qty == 0) {

        Database::iud("DELETE FROM `cart` WHERE `id` = " . $id . "");

        echo 24233;
    } else {

        $resultQty = Database::search("SELECT pc.`qty` FROM `cart` c INNER JOIN `product_color` pc ON c.`product_color_id` = pc.`id` WHERE c.`id` = " . $id . "");
        $dataQty = $resultQty->fetch_assoc();

        if (($dataQty["qty"] - ($qty - 1)) <= 0) {

            $item = ($qty) > 1 ? "items" : "item";

            echo "Only " . $dataQty["qty"] . " " . $item . " available";
        } else {

            Database::iud("UPDATE `cart` SET `qty` = " . $qty . " WHERE `id` = " . $id . "");

            echo 24233;
        }
    }
} else {
    header("Location: index.php");
}
