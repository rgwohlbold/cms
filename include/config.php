<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// Insert information here
define("HOSTNAME", "");
define("USERNAME", "");
define("PASSWORD", "");
define("DATABASE", "");

define("ROOTDIR", __DIR__ . "/../");
define("HTTPDIR", "/cms/");


if (ADMIN) {
    if (!isset($_SESSION["username"])) {
        header("Location: " . HTTPDIR . "login.php");
        exit();
    }
}

function getConnection() {
    return new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);
}

require_once 'common.php'

?>
