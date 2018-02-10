<?php
define("ADMIN", true);
require_once "../include/config.php";

$id = getNumeric("id", "index.php");

$conn = getConnection();

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Update article
    if ($_POST["action"] === "Update article") {

        if ($_POST["title"] !== "") {
            $stmt = $conn->prepare("UPDATE articles SET title=?, text=? WHERE id=?");
            $stmt->bind_param("sss", $_POST["title"], $_POST["content"], $id);
            $stmt->execute();
            $stmt->close();
            $msg = "<p class='success'>Article successfully updated!</p>";
        }
        else {
            $msg = "<p class='failure'>The title cannot be empty!</p>";
            $text = $_POST["content"];
            $title = "";
        }
    }

    // Delete article
    elseif ($_POST["action"] === "Delete article") {
        $stmt = $conn->prepare("DELETE FROM articles WHERE id=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("Location: ./index.php?m=1");
        exit();
    }

    // Why are you sending a POST request???
    else {
        $conn->close();
        header("./article.php?id=" . $id);
        exit();
    }
}

if (!isset($text)) {
    // Get article information from database
    $stmt = $conn->prepare("SELECT title,text FROM articles WHERE id=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->bind_result($title, $text);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
}

require_once ROOTDIR . "template/publictop.php";
?>

<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<h1>Edit Article</h1>

<?php
    if (isset($msg)) {
        echo $msg;
    }
?>

<form method="post">
    <label>Title</label><input type="text" name="title" value='<?php echo $title; ?>'><br>
    <textarea name="content" style="width: 100%;"><?php echo $text ?></textarea><br>
    <input name="action" type="submit" value="Update article"><br>
    <input name="action" type="submit" value="Delete article">
</form>

<?php
require_once ROOTDIR . "template/publicbottom.php";
?>