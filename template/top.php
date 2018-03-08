<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <meta name="viewport" content="width=device-width, scale=1.0">
    <meta charset="utf-8">
    <title>simplecms</title>
</head>
<body>
<nav class="navbar navbar-static-top navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="<?php echo HTTPDIR ?>index.php">Home</a></li>
            <li><a href="<?php echo HTTPDIR ?>about.php">About</a></li>
            <li><a href="<?php echo HTTPDIR ?>contact.php">Contact</a></li>
            <?php
            if (isset($_SESSION["username"])) {
                echo "<li><a href='" . HTTPDIR . "admin/'>Admin</a></li>";
            }
            ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php
            if (isset($_SESSION["username"])) {
                echo "<li><a href='" . HTTPDIR . "admin/logout.php'>Logout</a></li>";
            }
            else {
                echo "<li><a href='" . HTTPDIR . "login.php'>Login</a></li>";
            }
            ?>
        </ul>
    </div>
</nav>
<div class="container">