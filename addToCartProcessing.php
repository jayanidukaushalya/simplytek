<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

    $id = $_GET["id"];
    $color = $_GET["c"];
    $email = $_SESSION["user"]["email"];

    if ($color != null) {

        $result = Database::search("SELECT * FROM `cart` c INNER JOIN `product_color` pc ON c.`product_color_id` = pc.`id` WHERE c.`register_email` = '" . $_SESSION["user"]["email"] . "' AND pc.`color_id` = " . $color . " AND pc.`product_id` = " . $id . " AND c.`status` = 1");
        $n = $result->num_rows;

        if ($n == 0) {

            $resultProduct = Database::search("SELECT * FROM `product_color` WHERE `color_id` = " . $color . " AND `product_id` = " . $id . " AND `qty` > 0");
            $nProduct = $resultProduct->num_rows;

            if ($nProduct == 1) {

                $dataProduct = $resultProduct->fetch_assoc();

                Database::iud("INSERT INTO `cart`(`register_email`, `product_color_id`, `cdate`) VALUES('" . $email . "', " . $dataProduct["id"] . ", CURRENT_TIMESTAMP)");
    
                echo 41232;

            } else if ($nProduct == 0) {

                echo "This Product is Out of Stock, You can add this product to Wishlist for buy after restock";

            }

            
        } else {

            echo "This product already exists in cart!";
        }
    } else {

        echo "Please select a colour";
    }
} else {
    header("Location: index.html");
}
