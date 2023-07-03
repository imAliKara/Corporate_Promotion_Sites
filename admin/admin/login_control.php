<?php include "../connect.php" ?>
<?php
$_SESSION["id"] = "";
$_SESSION["name"] = "";
$_SESSION["permission"] = false;

if (isset($_POST["username"]) && isset($_POST["user_password"])) {
    $f_name = $_POST["username"];
    $f_password = $_POST["user_password"];

    $result = $con->query("SELECT * FROM tbl_user WHERE username='$f_name' AND user_password='$f_password'");
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        $_SESSION["id"] = $data["user_id"];
        $_SESSION["name"] = $data["user_name"];
        $_SESSION["permission"] = true;

        header("Location: panel.php");
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
?>