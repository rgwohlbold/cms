<?php
define("ADMIN", true);
require_once "../include/config.php";
require_once ROOTDIR . "template/publictop.php";

echo "<h1>Welcome, " . $_SESSION["username"] . "!</h1>";

if (isset($_GET["m"])) {
    switch ($_GET["m"]) {
        case 1:
            echo "<p class='success'>Article successfully deleted!</p>";
            break;
        case 2:
            echo "<p class='success'>Article successfully created!</p>";
            break;
        case 3:
            echo "<p class='failure'>An error occured.</p>";
    }
}

?>
<a href="write.php">Write a new article</a><p>
<a href="list.php">All articles</a>

<?php
require_once ROOTDIR . "template/publicbottom.php";
?>