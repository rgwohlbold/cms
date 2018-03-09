<?php
    define("ADMIN", false);
    require_once "include/config.php";

    define("ARTICLESPERPAGE", 2);


    /* Calculate page count */
    $page = getNumeric("page", "index.php", 0);
    $conn = getConnection();
    $count = getPageCount($conn);
    if ($count == 0)
        $count = 1;
    checkPageNumber($page, $count, "index.php");

    /* Previous page link */
    if ($page != 0) {
        $prev_page_element = "<a class='btn btn-primary' href='index.php?page=" . ($page - 1) . "'>Previous page</a>";
    }
    else {
        $prev_page_element = "<a class='btn btn-default disabled' disabled=''>Previous page </a>";
    }

    /* Next page link */
    if ($count > ARTICLESPERPAGE * ($page + 1)) {
        $next_page_element = "<a class='btn btn-primary' href='index.php?page=" . ($page + 1) . "'>Next page</a>";
    }
    else {
        $next_page_element = "<a class='btn btn-default disabled' disabled=''> Next page </a>";
    }

    $page_count_element = "Page " . ($page+1) . "/" . ceil($count / ARTICLESPERPAGE);

    /* Get articles from database */
    $article_element = "";
    // write articles from database
    $query = "SELECT id,title,text,time FROM articles ORDER BY time DESC LIMIT " . ARTICLESPERPAGE . " OFFSET " . ($page * ARTICLESPERPAGE);
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->bind_result($id, $title, $text, $time);
    $stmt->fetch();
    while ($title != NULL) {
        $article_element += "<div class='panel'><h1><small>" . $title . "</small></h1>\n";
        $article_element += $text . "<p>\n</div>\n";
        $stmt->bind_result($id, $title, $text, $time);
        $stmt->fetch();
    }
    $stmt->close();



    require_once ROOTDIR . "template/top.php";
?>

<h1 class="page-header">Home</h1>

<?php
    echo $article_element;
?>

<div class='panel'>
    <div class="btn-group">

    <?php
        echo $prev_page_element;
        echo $next_page_element;
    ?>

    </div>
    <p><p>
    <small>
        <?php echo $page_count_element; ?>
    </small>

</div>

<?php
    require_once constant("ROOTDIR") . "template/bottom.php";
?>
