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
    $title = $_POST["news_title"];
    $ozet = $_POST["news_ozet"];
    $detail = $_POST["news_detail"];
    $photo = $_FILES["news_photo"]["name"];
    $yol = $_FILES["news_photo"]["tmp_name"];
    move_uploaded_file($yol, "../news/" . $photo);
    $result = $con->query("INSERT INTO tbl_news (news_title, news_ozet, news_detail, news_photo) VALUES ('$title', '$ozet', '$detail', '$photo')");
    header("Location: news_list.php");
} else if ($process == "update") {
    $id = $_POST["news_id"];
    $title = $_POST["news_title"];
    $ozet = $_POST["news_ozet"];
    $detail = $_POST["news_detail"];
    $old_photo = $_POST["news_photo_old"];
    if (! empty($_FILES["news_photo"]["name"])) {
        if($old_photo!="yok.jpg"){
            unlink('../news/' . $old_photo);
        }
        $photo = $_FILES["news_photo"]["name"];
        $yol = $_FILES["news_photo"]["tmp_name"];
        move_uploaded_file($yol, "../news/" . $photo);
        $old_photo = $photo;
    }
    $result = $con->query("UPDATE tbl_news SET news_title='$title', news_ozet='$ozet', news_detail='$detail', news_photo='$old_photo' WHERE news_id = '$id'");
    header("Location: news_list.php");
} else if ($process == "delete") {
    $id = $_GET["news_id"];
    $result = $con->query("SELECT * FROM tbl_news WHERE news_photo<>'yok.jpg' and news_id=$id");
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        unlink('../news/' . $data['news_photo']);
    }
    $result = $con->query("DELETE FROM tbl_news WHERE news_id = $id");
    header("Location: news_list.php");
} else if ($process == "active") {
    $id = $_GET["news_id"];
    $durum = $_GET["durum"];
    $result = $con->query("UPDATE tbl_news SET news_active='$durum' WHERE news_id='$id'");
    header("Location: news_list.php");
} else if ($process == "orderby") {
    $sort = '0'.$_POST["sort"];
    if (!empty($sort)) {
        $place = explode(',', $sort);
        foreach ($place as $key => $myp) {
            $result = $con->query("UPDATE tbl_news SET news_place=$key WHERE news_id='$myp'");
        }
        header("Location: news_list.php");
    } else {
        header("Location: news_list.php");
    }
} else {
    header("Location: panel.php");
}
?>