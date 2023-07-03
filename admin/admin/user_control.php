<?php include "../connect.php" ?>
<?php if (!$_SESSION["permission"]) {
    header("Location: index.php");
} ?>
<?php
    if(isset($_POST["process"])){
        $process = $_POST["process"];
    }else if(isset($_GET["process"])){
        $process = $_GET["process"];
    }else {
        header("Location: panel.php");
    }

    if($process == "add"){
        $username = $_POST["username"];
        $name = $_POST["user_name"];
        $pass = $_POST["user_password"];

        $result = $con->query("INSERT INTO tbl_user (user_name, username, user_password) VALUES ('$username', '$name', '$pass')");
        header("Location: user_list.php");
    }else if($process == "update"){
        $id = $_POST["user_id"];
        $username = $_POST["username"];
        $name = $_POST["user_name"];
        $pass = $_POST["user_password"];

        $result = $con->query("UPDATE tbl_user SET username = '$username', user_name='$name', user_password='$pass' WHERE user_id = '$id'");
        header("Location: user_list.php");
    }else if($process == "delete"){
        $id = $_GET["user_id"];
        $result = $con->query("DELETE FROM tbl_user WHERE user_id = $id");
        header("Location: user_list.php");
    }else {
        header("Location: panel.php");
    }
?>