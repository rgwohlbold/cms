<?php
define("ADMIN", true);
require_once "../include/config.php";
require_once ROOTDIR . "template/publictop.php";

define("ARTICLESPERPAGE", 50);

$page = getNumeric("page", "index.php", 0);
$conn = getConnection();
$count = getPageCount($conn);
checkPageNumber($page, $count, "list.php");

$stmt = $conn->prepare("SELECT id,title,time FROM articles ORDER BY time DESC LIMIT " . ARTICLESPERPAGE . " OFFSET " . ($page * ARTICLESPERPAGE));
$stmt->execute();
$stmt->bind_result($id, $title, $time);
$stmt->fetch();
echo "<ul>";
while ($title != NULL) {
    echo "<li><a href='article.php?id=" . $id . "'>" . $title . "</a></li>";
    $stmt->bind_result($id, $title, $time);
    $stmt->fetch();
}
$stmt->close();
echo "</ul>";


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

require_once ROOTDIR . "template/publicbottom.php";
?>