<?php
    define("ADMIN", true);
    require_once "../include/config.php";
    require_once ROOTDIR . "template/top.php";

    define("ARTICLESPERPAGE", 50);

    $page = getNumeric("page", "index.php", 0);
    $conn = getConnection();
    $count = getPageCount($conn);
    checkPageNumber($page, $count, "list.php");
?>

<h1 class="page-header">All articles</h1>

<ul>
<?php
    $stmt = $conn->prepare("SELECT id,title,time FROM articles ORDER BY time DESC LIMIT " . ARTICLESPERPAGE . " OFFSET " . ($page * ARTICLESPERPAGE));
    $stmt->execute();
    $stmt->bind_result($id, $title, $time);
    $stmt->fetch();
    while ($title != NULL) {
        echo "<li><a href='article.php?id=" . $id . "'>" . $title . "</a></li>";
        $stmt->bind_result($id, $title, $time);
        $stmt->fetch();
    }
    $stmt->close();
?>
</ul>

<div class='panel'>
    <small>
        <?php
            echo "Page " . ($page+1) . "/" . (floor($count / ARTICLESPERPAGE) + 1);
        ?>
    </small>
    <p>
        <?php
            if ($page != 0) {
                echo "<a href='index.php?page=" . ($page - 1) . "'>Previous page</a>";
            }
        ?>
    </p>
    <p>
        <?php
            if ($count > ARTICLESPERPAGE * ($page + 1)) {
                echo "<a href='index.php?page=" . ($page + 1) . "'>Next page</a>";
            }
        ?>
    </p>

</div>

<a href="index.php" class="btn btn-default">Back to menu</a>

<?php
    require_once ROOTDIR . "template/bottom.php";
?>