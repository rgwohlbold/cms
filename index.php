<?php
define("ADMIN", false);
require_once "include/config.php";

define("ARTICLESPERPAGE", 2);


$page = getNumeric("page", "index.php", 0);
$conn = getConnection();
$count = getPageCount($conn);
checkPageNumber($page, $count, "index.php");


require_once ROOTDIR . "template/publictop.php";
echo "<h1>Home</h1>";

// write articles from database
$query = "SELECT id,title,text,time FROM articles ORDER BY time DESC LIMIT " . ARTICLESPERPAGE . " OFFSET " . ($page * ARTICLESPERPAGE);
$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($id, $title, $text, $time);
$stmt->fetch();
while ($title != NULL) {
    echo "<div class='article'><h3>" . $title . "</h3>";
    echo "<p>" . $text . "</p></div>";
    $stmt->bind_result($id, $title, $text, $time);
    $stmt->fetch();
}
$stmt->close();

// write the page navigator
echo "<div id='navigator'>";
echo "Page " . ($page+1) . "/" . (floor($count / ARTICLESPERPAGE) + 1);
echo "<p>";
if ($page != 0) {
    echo "<a href='index.php?page=" . ($page - 1) . "'>Previous page</a>";
}
echo "</p>";
if ($count > ARTICLESPERPAGE * ($page + 1)) {
    echo "<a href='index.php?page=" . ($page + 1) . "'>Next page</a>";
}
echo "</div>";

require_once constant("ROOTDIR") . "template/publicbottom.php";
?>
