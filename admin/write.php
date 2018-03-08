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
    require_once ROOTDIR . "template/top.php";
?>

<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<h1 class="page-header">New article</h1>

<?php
    if ($success == 1) {
        echo "<div class='alert alert-success'>Article successfully created!</div>";
    } 
    elseif ($success == 2) {
        echo "<div class='alert alert-danger'>An error occured. Please try again later.</div>";
    }
    elseif ($success == 3) {
        echo "<div class='alert alert-danger'>Please provide a title.</div>";
    }
?>

<div class="panel">
    <form method="post">
        <div id="form-group">
            <label for="title">Title:</label>
            <input class="form-control" id="title" type="text" name="title"></input><br>
        </div>
        <textarea name="content" rows="8" style="width: 100%;"><?php echo $text ?></textarea><br>
        <div class="btn-group">
            <a href="index.php" class="btn btn-default">Back to menu</a>
            <input class="btn btn-success" type="submit" value="Post article"</input>
        </div>
    </form>
</div>

<?php
    require_once ROOTDIR . "template/bottom.php";
?>