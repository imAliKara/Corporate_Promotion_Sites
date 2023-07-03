<?php include "../connect.php" ?>
<?php if (!$_SESSION["permission"]) {
    header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KARA Teknoloji - Admin Panel</title>
    <link rel="stylesheet" href="panel_style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="richtexteditor/richtexteditor/rte_theme_default.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="richtexteditor/richtexteditor/rte.js"></script>
    <script type="text/javascript" src="richtexteditor/richtexteditor/plugins/all_plugins.js"></script>
</head>

<body>
    <!------------------------- HEADER ------------------------->
    <?php include "header.php" ?>
    <!------------------------- HEADER ------------------------->

    <!------------------------- SIDEBAR ------------------------->
    <div class="row">
    <?php include "sidebar.php" ?>
    <!------------------------- SIDEBAR ------------------------->

    <?php
    if (isset($_GET["news_id"])) {
        $g_id = $_GET["news_id"];

        $result = $con->query("SELECT * FROM tbl_news WHERE news_id=$g_id");
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            
            $photo = $data["news_photo"];
            $title = $data["news_title"];
            $ozet = $data["news_ozet"];
            $detail = $data["news_detail"];
        } else {
            header("Location: news_list.php");
        }
    } else {
        header("Location: news_list.php");
    }
    ?>
    <!------------------------- İÇERİK MODÜL ------------------------->
    <div class="col-10">
        <h2>Haber Güncelleme</h2>
        <form action="news_control.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="process" value="update">
            <input type="hidden" name="news_id" value="<?=$g_id?>">
            <input type="hidden" name="news_photo_old" value="<?=$photo?>">
            <div class="mb-3">
                <label for="exampleInputTitle" class="form-label">Haber Başlık</label>
                <input type="text" name="news_title" class="form-control" value="<?=$title?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputTitle" class="form-label">Haber Resim (Güncellemek için seçmeyiniz)</label>
                <br><img src="../news/<?=$photo?>" height="100">
                <input type="file" name="news_photo" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputOzet" class="form-label">Haber Özet</label>
                <textarea name="news_ozet" class="form-control" rows="5"><?=$ozet?></textarea>
            </div>
            <div class="mb-3">
                <label for="exampleInputDetail" class="form-label">Haber Detay</label>
                <textarea id="rich" name="news_detail" class="form-control"><?=$detail?></textarea>
            </div>
            <button type="submit" class="btn btn-dark">GÜNCELLE</button>
        </form>
    </div>
    </div>
    <!------------------------- İÇERİK MODÜL ------------------------->

    <script>
    var editor1 = new RichTextEditor("#rich");
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
        crossorigin="anonymous"></script>
</body>

</html>