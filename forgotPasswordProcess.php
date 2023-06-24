<?php

require "connection.php";

require "email/PHPMailer.php";
require "email/SMTP.php";
require "email/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET["e"];

if (empty($email)) {
    echo "Email is require!";
} else {

    $result = Database::search("SELECT * FROM `register` WHERE `email` = '" . $email . "'");
    $n = $result->num_rows;

    if ($n == 1) {

        $code = uniqid();

        Database::iud("UPDATE `register` SET `vcode` = '" . $code . "' WHERE `email` = '" . $email . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'javainstitutevideos@gmail.com';
        $mail->Password = 'uohuwerrttpwmzrr';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('javainstitutevideos@gmail.com', 'Reset Password');
        // $mail->addReplyTo('************************', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'eShop Forgot Password Verification Code';
        $bodyContent = '<h1 style="color:green">Your Verification code is '.$code.'</h1>';
        $mail->Body    = $bodyContent;

        if ($mail->send()) {
            echo "success";
        } else {
            echo "Verification process failed!";
        }

    } else {
        echo "Invalid Email address!";
    }
}

?>
