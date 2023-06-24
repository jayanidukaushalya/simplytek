<?php

session_start();

require "connection.php";

if (isset($_SESSION["admin"])) {

    $category = $_POST["cat"];
    $brand = $_POST["b"];
    $condition = $_POST["con"];
    $name = $_POST["n"];
    $price = $_POST["pr"];
    $discount = $_POST["di"];
    $description = $_POST["de"];

    $length = sizeof($_FILES);
    $main = $_POST["main"];

    $color = $_POST["col"];
    $qty = $_POST["q"];

    $count = $_POST["count"];

    $arrC = array();
    $arrQ = array();

    if ($count > 0) {
        for ($i = 1; $i <= $count; $i++) {
            $arrC[$i] = $_POST["col-" . $i];
        }

        for ($i = 1; $i <= $count; $i++) {
            $arrQ[$i] = $_POST["q-" . $i];
        }
    }

    if ($category == 0) {

        echo "Please select a category";
    } else if ($brand == 0) {

        echo "Please select a brand";
    } else if ($condition == 0) {

        echo "Please select a condition";
    } else if (empty($name)) {

        echo "Product name is required!";
    } else if (strlen($name) > 45) {

        echo "Product name is out of length!";
    } else if (empty($price)) {

        echo "Product price is required!";
    } else if (!is_numeric($price)) {

        echo "Invalid product price!";
    } else if (empty($discount)) {

        echo "Product discount is required!";
    } else if (!is_numeric($discount)) {

        echo "Invalid product discount!";
    } else if ($main == 0) {

        echo "Please select a main image!";
    } else if (empty($description)) {

        echo "Product description is required!";
    } else if (strlen($description) > 500) {

        echo "Product description is out of length!";
    } else if ($color == 0) {

        echo "Please select a colour!";
    } else if (empty($qty)) {

        echo "Product quantity is required!";
    } else if (!is_numeric($qty)) {

        echo "invalid product quantity!";
    } else {
        $date = date("Y-m-d H:i:s");
        $id = mt_rand();

        Database::iud("INSERT INTO `product`(`id`, `name`, `price`, `rdate`, `description`, `discount`, `condition_id`, `category_id`, `brand_id`) VALUES('" . $id . "','" . $name . "', '" . $price . "',  '" . $date . "',  '" . $description . "',   '" . $discount . "',   '" . $condition . "',   '" . $category . "',   '" . $brand . "')");

        Database::iud("INSERT INTO `product_color`(`qty`, `color_id`, `product_id`) VALUES('" . $qty . "', '" . $color . "', '" . $id . "')");

        if ($count > 0) {
            for ($i = 1; $i <= $count; $i++) {
                Database::iud("INSERT INTO `product_color`(`qty`, `color_id`, `product_id`) VALUES('" . $arrQ[$i] . "', '" . $arrC[$i] . "', '" . $id . "')");
            }
        }

        $allowExtensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        $mainImg = $_FILES["image0"];
        $fileExtensionMain = $mainImg["type"];

        if (in_array($fileExtensionMain, $allowExtensions)) {

            $newExtensionMain;

            if ($fileExtensionMain == "image/jpg") {
                $newExtensionMain = ".jpg";
            } else if ($fileExtensionMain == "image/jpeg") {
                $newExtensionMain = ".jpeg";
            } else if ($fileExtensionMain == "image/png") {
                $newExtensionMain = ".png";
            } else if ($fileExtensionMain == "image/svg+xml") {
                $newExtensionMain = ".svg";
            }

            $fileNameMain = "resources//productImg//" . uniqid() . $newExtensionMain;
            move_uploaded_file($mainImg["tmp_name"], $fileNameMain);

            Database::iud("INSERT INTO `img`(`path`, `product_id`, `main`) VALUES('" . $fileNameMain . "', '" . $id . "', 1)");

            for ($i = 1; $i < $length; $i++) {

                if (isset($_FILES["image" . $i])) {

                    $otherImg = $_FILES["image" . $i];
                    $fileExtension = $otherImg["type"];

                    if (in_array($fileExtension, $allowExtensions)) {

                        $newExtension;

                        if ($fileExtension == "image/jpg") {
                            $newExtension = ".jpg";
                        } else if ($fileExtension == "image/jpeg") {
                            $newExtension = ".jpeg";
                        } else if ($fileExtension == "image/png") {
                            $newExtension = ".png";
                        } else if ($fileExtension == "image/svg+xml") {
                            $newExtension = ".svg";
                        }

                        $fileName = "resources//productImg//" . uniqid() . $newExtension;
                        move_uploaded_file($otherImg["tmp_name"], $fileName);

                        Database::iud("INSERT INTO `img`(`path`, `product_id`, `main`) VALUES('" . $fileName . "', '" . $id . "', 0)");
                    } else {

                        echo "Invalid image type!";
                    }
                }
            }
            echo 21312;
        }
    }
} else {
    header("Location: adminLogin.php");
}
