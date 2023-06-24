<?php

session_start();

if (isset($_SESSION["admin"])) {

    $_SESSION["admin"] = null;

    session_destroy();

    header("Location: adminLogin.php");
}
