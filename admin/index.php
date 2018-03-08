<?php
    define("ADMIN", true);
    require_once "../include/config.php";
    require_once ROOTDIR . "template/top.php";
?>

<h1 class='page-header'>
    <?php
        echo "Welcome, " . $_SESSION["username"] . "!";
    ?>
</h1>

<?php
    if (isset($_GET["m"])) {
        switch ($_GET["m"]) {
            case 1:
                echo "<div class='alert alert-success'>Article successfully deleted!</div>";
                break;
            case 2:
                echo "<div class='alert alert-success'>Article successfully created!</div>";
                break;
            case 3:
                echo "<div class='alert alert-danger'>An error occured.</div>";
        }
    }
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