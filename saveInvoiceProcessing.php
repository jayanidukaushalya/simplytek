<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

    $delivery_id = $_POST["di"];

    if (empty($delivery_id)) {
        echo "Shopping address is not defined, please add your shopping address";
    } else {

        $email = $_POST["e"];
        $order_id = $_POST["o"];
        $sub_total = $_POST["s"];
        $discount = $_POST["d"];
        $delivery = $_POST["l"];
        $net_total = $_POST["n"];

        $result = Database::search("SELECT c.`id` AS `id`, c.`qty` AS `cqty`, pc.`id` AS `pcid`, pc.`qty` AS `pcqty`  FROM `cart` c INNER JOIN `product_color` pc ON c.`product_color_id` = pc.`id` WHERE `register_email` = '" . $email . "' AND `status` = 1");
        $n = $result->num_rows;

        Database::iud("INSERT INTO `invoice`(`id`, `idate`, `subtotal`, `discount`, `nettotal`, `delivery`, `register_email`, delivery_address_id) VALUES('" . $order_id . "', CURRENT_TIMESTAMP, " . $sub_total . ", " . $discount . ", " . $net_total . ", " . $delivery . ", '" . $email . "', '" . $delivery_id . "')");

        for ($i = 0; $i < $n; $i++) {

            $data = $result->fetch_assoc();

            Database::iud("INSERT INTO `invoice_item`(`cart_id`, `invoice_id`) VALUES(" . $data["id"] . ", '" . $order_id . "')");
            Database::iud("UPDATE `cart` SET `status` = 0 WHERE `id` = " . $data["id"] . "");
            Database::iud("UPDATE `product_color` SET `qty` = " . $data["pcqty"] - $data["cqty"] . " WHERE `id` = " . $data["pcid"] . "");
        }

        echo "ok";
    }
} else {
    header("Location: index.php");
}
