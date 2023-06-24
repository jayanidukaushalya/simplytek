<?php

require "connection.php";

$email = $_POST["e"];
$newpassword = $_POST["n"];
$repassword = $_POST["r"];
$code = $_POST["v"];

if (empty($newpassword)) {
    echo "New Password required!";
} else if (strlen($newpassword) > 20) {
    echo "Password must not be at greater than 20 Characters!";
} else if (empty($newpassword)) {
    echo "Re-Type Password required!";
} else if (strcmp($newpassword, $repassword) < 0) {
    echo "Various Passwords are entered, re-check and enter same values for password fields!";
} else if (empty($code)) {
    echo "Verification code required!";
} else {

    $result = Database::search("SELECT * FROM `register` WHERE `vcode` = '".$code."' AND `email` = '".$email."'");
    $n = $result->num_rows;

    if ($n == 1) {
        echo "success";
        Database::iud("UPDATE `register` SET `password` = '".$newpassword."' WHERE `email` = '".$email."'");
    } else {
        echo "Invalid verification code, please try again!";
    }

}

?>