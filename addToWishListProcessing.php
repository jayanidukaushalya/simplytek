<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

    $id = $_GET["id"];
    $color = $_GET["c"];
    $email = $_SESSION["user"]["email"];

    if ($color != null) {

        $result = Database::search("SELECT * FROM `wish` w INNER JOIN `product_color` pc ON w.`product_color_id` = pc.`id` WHERE w.`register_email` = '" . $_SESSION["user"]["email"] . "' AND pc.`color_id` = " . $color . " AND pc.`product_id` = " . $id . "");
        $n = $result->num_rows;

        if ($n == 0) {

            $resultProduct = Database::search("SELECT * FROM `product_color` WHERE `color_id` = " . $color . " AND `product_id` = " . $id . "");
            $dataProduct = $resultProduct->fetch_assoc();

            Database::iud("INSERT INTO `wish`(`register_email`, `product_color_id`, `wdate`) VALUES('" . $email . "', " . $dataProduct["id"] . ", CURRENT_TIMESTAMP)");

            echo 41232;
        } else {

            echo "This product already exists in wish list!";
        }
    } else {

        echo "Please select a colour";
    }
} else {
    header("Location: index.html");
}
