<?php
    define("ADMIN", true);
    require_once "../include/config.php";
    require_once ROOTDIR . "template/top.php";

    $header = "Welcome, " . $_SESSION["username"] . "!";

    if (isset($_GET["m"])) {
        if ($_GET["m"] == 1) {
            $alert = "<div class='alert alert-success'>Article successfully deleted!</div>";
        } else if ($_GET["m"] == 2) {
            $alert = "<div class='alert alert-success'>Article successfully created!</div>";
        } else if ($_GET["m"] == 3) {
            $alert = "<div class='alert alert-success'>Article successfully deleted!</div>";
        }
    } else {
        $alert = "";
    }
?>

<h1 class='page-header'>
    <?php echo $header; ?>
</h1>

<?php
    echo $alert;
?>

<div class="panel">
    <a href="write.php">Write a new article</a><p>
</div>
<div class="panel">
    <a href="list.php">All articles</a><p>
</div>

<?php
    require_once ROOTDIR . "template/bottom.php";
?>