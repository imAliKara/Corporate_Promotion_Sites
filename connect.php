<?php
if (!isset($_SESSION)) {
    session_start();
}

//$con = mysqli_connect("localhost", "root", "", "db_yonetim");

$con = mysqli_connect("sql301.infinityfree.com", "if0_34396916", "DvNXr9g3tJpcny1", "if0_34396916_yonetim");
if (mysqli_connect_errno()) {
    echo "Error connecting to MYSQL: " . mysqli_connect_error();
    exit();
}
?>