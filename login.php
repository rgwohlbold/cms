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

require_once ROOTDIR . "template/publictop.php";
?>

<h1>Login</h1>
<?php
if ($wrongPassword) {
    echo "<p class='failure'>Wrong username or password!</p>";
}
?>

<form method="POST", action="./login.php">

<label>Username</label>
<input type="text" name="username"><br>
<label>Password</label>
<input type="password" name="password"><br>
<input type="submit" value="Login" />

</form>

<?php
require_once ROOTDIR . "template/publicbottom.php";
?>