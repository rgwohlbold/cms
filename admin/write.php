<?php
define("ADMIN", true);
require_once "../include/config.php";

// 0 -> neutral, 1 -> success, 2 -> failure
$success = 0;
$text = "";

if (isset($_POST["title"]) && $_POST["title"] === "") {
    $text = $_POST["content"];
    $success = 3;
}

if (isset($_POST["title"], $_POST["content"]) && $success == 0) {
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO articles VALUES (NULL, ?, ?, ?, NOW())");
    $stmt->bind_param("sss", $_SESSION["uid"], $_POST["title"], $_POST["content"]);
    $stmt->execute();
    $stmt->close();

    if ($conn->errno == 0) {
        $success = 2;
    }
    else {
        $success = 3;
    }
    header("Location: ./index.php?m=" . $success);
    exit();
}
require_once ROOTDIR . "template/publictop.php";
?>

<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<h1>New article</h1>

<?php
    if ($success == 1) {
        echo "<p class='success'>Article successfully created!</p>";
    } 
    elseif ($success == 2) {
        echo "<p class='failure'>An error occured while processing the article. Please try again later!</p>";
    }
    elseif ($success == 3) {
        echo "<p class='failure'>The title cannot be empty!</p>";
    }
?>

<form method="post">
    <label>Title</label><input type="text" name="title"></input><br>
    <textarea name="content" style="width: 100%;"><?php echo $text ?></textarea><br>
    <input type="submit" value="Post article"</input>
</form>

<?php
require_once ROOTDIR . "template/publicbottom.php";
?>