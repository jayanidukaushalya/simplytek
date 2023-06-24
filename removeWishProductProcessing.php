<?php

session_start();

require "connection.php";

if (isset($_SESSION["user"])) {

    $id = $_GET["id"];

    $result = Database::search("SELECT * FROM `wish` WHERE `id` = ".$id."");
    $n = $result->num_rows;

    if ($n == 1) {

        Database::iud("DELETE FROM `wish` WHERE `id` = ".$id."");

        echo 54578;

    }

} else {
    header("Location: index.html");
}

?>