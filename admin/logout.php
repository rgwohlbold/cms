<?php
    define("ADMIN", true);
    require_once "../include/config.php";

    unset($_SESSION["username"]);
    header("Location: " . HTTPDIR);
?>