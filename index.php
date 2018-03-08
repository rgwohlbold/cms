<?php
    define("ADMIN", false);
    require_once "include/config.php";

    define("ARTICLESPERPAGE", 2);


    $page = getNumeric("page", "index.php", 0);
    $conn = getConnection();
    $count = getPageCount($conn);
    checkPageNumber($page, $count, "index.php");

require_once ROOTDIR . "template/top.php";
?>

<h1 class="page-header">Home</h1>

<?php

    // write articles from database
    $query = "SELECT id,title,text,time FROM articles ORDER BY time DESC LIMIT " . ARTICLESPERPAGE . " OFFSET " . ($page * ARTICLESPERPAGE);
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->bind_result($id, $title, $text, $time);
    $stmt->fetch();
    while ($title != NULL) {
        echo "<div class='panel'><h1><small>" . $title . "</small></h1>\n";
        echo $text . "<p>\n</div>\n";
        $stmt->bind_result($id, $title, $text, $time);
        $stmt->fetch();
    }
    $stmt->close();

?>

<div class='panel'>
    <div class="btn-group">

    <?php
        /* Previous page link */
        if ($page != 0) {
            echo "<a class='btn btn-primary' href='index.php?page=" . ($page - 1) . "'>Previous page</a>";
        }
        else {
            echo "<a class='btn btn-default disabled' disabled=''>Previous page </a>";
        }
    ?>

    <?php
        /* Next page link */
        if ($count > ARTICLESPERPAGE * ($page + 1)) {
            echo "<a class='btn btn-primary' href='index.php?page=" . ($page + 1) . "'>Next page</a>";
        }
        else {
            echo "<a class='btn btn-default disabled' disabled=''> Next page </a>";
        }
    ?>

    </div>

    <p><p>

    <small>
        <?php
            /* Page counter */
            echo "Page " . ($page+1) . "/" . ceil($count / ARTICLESPERPAGE);
        ?>
    </small>

</div>

<?php
    require_once constant("ROOTDIR") . "template/bottom.php";
?>
