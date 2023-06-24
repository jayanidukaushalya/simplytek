<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

    $r1 = $_POST["r1"];
    $r2 = $_POST["r2"];
    $r3 = $_POST["r3"];
    $r4 = $_POST["r4"];
    $r5 = $_POST["r5"];
    $review = $_POST["r6"];
    $pid = $_POST["id"];
    $itId = $_POST["itId"];
    $email = $_SESSION["user"]["email"];

    if (empty($r1) && empty($r2) && empty($r3) && empty($r4) && empty($r5)) {

        echo "Rate item first using stars";
    } else if (empty($review)) {

        echo "Please add a comment";
    } else {

        if (!empty($r1)) {

            Database::iud("INSERT INTO `rate`(`value`, `review`, `product_id`, `register_email`) VALUES(" . $r1 . ", '" . $review . "', " . $pid . ", '" . $email . "')");
        } else if (!empty($r2)) {

            Database::iud("INSERT INTO `rate`(`value`, `review`, `product_id`, `register_email`) VALUES(" . $r2 . ", '" . $review . "', " . $pid . ", '" . $email . "')");
        } else if (!empty($r3)) {

            Database::iud("INSERT INTO `rate`(`value`, `review`, `product_id`, `register_email`) VALUES(" . $r3 . ", '" . $review . "', " . $pid . ", '" . $email . "')");
        } else if (!empty($r4)) {

            Database::iud("INSERT INTO `rate`(`value`, `review`, `product_id`, `register_email`) VALUES(" . $r4 . ", '" . $review . "', " . $pid . ", '" . $email . "')");
        } else if (!empty($r5)) {

            Database::iud("INSERT INTO `rate`(`value`, `review`, `product_id`, `register_email`) VALUES(" . $r5 . ", '" . $review . "', " . $pid . ", '" . $email . "')");
        }

        Database::iud("UPDATE `invoice_item` SET `status` = 0 WHERE `id` = " . $itId . "");

        echo 21132;
    }
} else {
    header("Location: index.php");
}
