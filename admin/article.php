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
                $msg = "<div class='alert alert-success'>Article successfully updated!</div>";
            }
            else {
                $title = "";
                $text = $_POST["content"];
                $msg = "<div class='alert alert-danger'>Title cannot be empty.</div>";
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

    require_once ROOTDIR . "template/top.php";
?>

<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<h1 class="page-header">Edit Article</h1>

<?php
    if (isset($msg)) {
        echo $msg;
    }
?>

<div class="panel">
    <form method="post">

        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" id="title" type="text" name="title" value='<?php echo $title; ?>'>
        </div>
        <textarea name="content" rows="8" class="form-control">
            <?php
                echo $text
            ?>
        </textarea><p>
        <div class="btn-group">
            <a href="list.php" class="btn btn-default">Back to list</a>
            <input name="action" type="submit" class="btn btn-success" value="Update article">
            <input name="action" type="submit" class="btn btn-danger" value="Delete article">
        </div>
    </form>
</div>

<?php
    require_once ROOTDIR . "template/bottom.php";
?>