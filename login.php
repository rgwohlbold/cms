<?php
    define("ADMIN", false);
    require_once "include/config.php";

    $wrongPassword = false;

    if (isset($_POST["username"], $_POST["password"])) {
        $conn = new mysqli(constant("HOSTNAME"), constant("USERNAME"), constant("PASSWORD"), constant("DATABASE"));
        $stmt = $conn->prepare('SELECT id,password FROM users WHERE username=?');
        $stmt->bind_param("s", $_POST["username"]);
        $stmt->execute();
        $stmt->bind_result($id, $result);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($_POST["password"], $result)) {
            header("Location: admin/");
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["uid"] = $id;
            exit();
        }
        else {
            $wrongPassword = true;
        }
    }

    require_once ROOTDIR . "template/top.php";
?>

<h1 class="page-header">Login</h1>
<?php
if ($wrongPassword) {
    echo "<p class='alert alert-danger'>Wrong username or password!</p>";
}
?>

<form method="POST" action="./login.php">
    <div class="formgroup">
        <label for="uname">Username</label>
        <input id="uname" class="form-control" type="text" name="username"><br>
    </div>
    <div class="formgroup">
        <label for="pwd">Password</label>
        <input type="password" class="form-control" name="password"><br>
    </div>
    <input type="submit" class="btn btn-default btn-success" value="Login" />
</form>

<?php
    require_once ROOTDIR . "template/bottom.php";
?>