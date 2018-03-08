<?php

// Get number of articles from database
function getPageCount($conn) { 
    $stmt = $conn->prepare("SELECT COUNT(*) FROM articles");
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    return $count;
}

// Gets numeric parameter, redirecting to $redirect on error
// It returns $default if it is specified
function getNumeric($name, $redirect, $default=NULL) {
    if (isset($_GET[$name])) {
        if (!is_numeric($_GET[$name]) || $_GET[$name] < 0) {
            header("Location: ./" . $redirect);
            exit();
        }
        return $_GET[$name];
    }
    if ($default === NULL) {
        header("Location: ./" . $redirect);
        exit();
    }
    return $default;
}

function checkPageNumber($page, $count, $redirect) {

    //page number to high
    if ($count / ARTICLESPERPAGE <= $page) {
        if ($page != 0) {
            if ($redirect !== NULL) {
                header("Location: ./index.php");
            }
            exit();
        }
        return false;
    }
    return true;
}

?>
