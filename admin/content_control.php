<?php include "../connect.php" ?>
<?php if (!$_SESSION["permission"]) {
    header("Location: index.php");
} ?>
<?php
if (isset($_POST["process"])) {
    $process = $_POST["process"];
} else if (isset($_GET["process"])) {
    $process = $_GET["process"];
} else {
    header("Location: panel.php");
}

if ($process == "add") {
    $place = $_POST["content_place"];
    $title = $_POST["content_title"];
    $link = $_POST["content_link"];
    $detail = $_POST["content_detail"];
    $result = $con->query("INSERT INTO tbl_content (content_place, content_title, content_link, content_detail) VALUES ('$place', '$title', '$link', '$detail')");
    header("Location: content_list.php");
} else if ($process == "update") {
    $id = $_POST["content_id"];
    $place = $_POST["content_place"];
    $title = $_POST["content_title"];
    $link = $_POST["content_link"];
    $detail = $_POST["content_detail"];
    $result = $con->query("UPDATE tbl_content SET content_place = '$place', content_title='$title', content_link='$link', content_detail='$detail' WHERE content_id = '$id'");
    header("Location: content_list.php");
} else if ($process == "delete") {
    $id = $_GET["content_id"];
    $result = $con->query("DELETE FROM tbl_content WHERE content_id = $id");
    header("Location: content_list.php");
} else if ($process == "active") {
    $id = $_GET["content_id"];
    $durum = $_GET["durum"];
    $result = $con->query("UPDATE tbl_content SET content_active='$durum' WHERE content_id='$id'");
    header("Location: content_list.php");
} else if ($process == "orderby") {
    $sort = '0'. $_POST["sort"];
    if (!empty($sort)) {
        $place = explode(',' , $sort);
        foreach ($place as $key => $myp) {
            $result = $con->query("UPDATE tbl_content SET content_place=$key WHERE content_id='$myp'");
        }
        header("Location: content_list.php");
    } else {
        header("Location: content_list.php");
    }
} else {
    header("Location: panel.php");
}
?>