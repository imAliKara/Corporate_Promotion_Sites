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
    $ticket = $_POST["gallery_ticket"];
    $desc = $_POST["gallery_desc"];
    $photo = $_FILES["photo"]["name"];
    $photo_files = $_FILES["photo"]["tmp_name"];
    move_uploaded_file($photo_files, "../gallery/" . $photo);
    $result = $con->query("INSERT INTO tbl_gallery (photo, gallery_ticket, gallery_desc) VALUES ('$photo', '$ticket', '$desc')");
    header("Location: gallery_list.php");
} else if ($process == "update") {
    $id = $_POST["gallery_id"];
    $ticket = $_POST["gallery_ticket"];
    $desc = $_POST["gallery_desc"];
    $result = $con->query("UPDATE tbl_gallery SET gallery_ticket='$ticket', gallery_desc='$desc' WHERE gallery_id='$id'");
    header("Location: gallery_list.php");
} else if ($process == "delete") {
    $id = $_GET["gallery_id"];
    $result = $con->query("SELECT * FROM tbl_gallery WHERE gallery_id =$id");
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        unlink('../gallery/' . $data["photo"]);
        $result = $con->query("DELETE FROM tbl_gallery WHERE gallery_id='$id'");
    }
    header("Location: gallery_list.php");
} else if ($process == "active") {
    $id = $_GET["gallery_id"];
    $durum = $_GET["durum"];
    $result = $con->query("UPDATE tbl_gallery SET gallery_active='$durum' WHERE gallery_id='$id'");
    header("Location: gallery_list.php");
} else if ($process == "orderby") {
    $sort = '0'. $_POST["sort"];
    if (!empty($sort)) {
        $place = explode(',' , $sort);
        foreach ($place as $key => $myp) {
            $result = $con->query("UPDATE tbl_gallery SET gallery_place=$key WHERE gallery_id='$myp'");
        }
        header("Location: gallery_list.php");
    } else {
        header("Location: gallery_list.php");
    }
} else {
    header("Location: panel.php");
}
?>