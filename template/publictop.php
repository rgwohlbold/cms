<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo HTTPDIR ?>css/main.css">
        <meta name="viewport" content="width=device-width, scale=1.0">
        <meta charset="utf-8">
        <title>simplecms</title>
    </head>
    <body>
        <div id="container">
            <div id="navbar">
                <ul>
                    <a href="<?php echo HTTPDIR?>index.php"><li>Home</li></a>
                    <a href="<?php echo HTTPDIR?>about.php"><li>About</li></a>
                    <a href="<?php echo HTTPDIR?>contact.php"><li>Contact</li></a>
                    <?php
                    if (isset($_SESSION["username"])) {
                        echo "<a href='" . HTTPDIR . "admin/'><li>Admin</li></a>";
                    }
                    
                    if (isset($_SESSION["username"])) {
                        echo "<a href='" . HTTPDIR . "admin/logout.php'><li>Logout</li></a>";
                    }
                    else {
                        echo "<a href='" . HTTPDIR . "login.php'><li>Login</li></a>";
                    }
                    ?>
                </ul>
            </div>
            <div id="content">