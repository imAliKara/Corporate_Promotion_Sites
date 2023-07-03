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
    if (isset($_GET["content_id"])) {
        $id = $_GET["content_id"];
    } else {
        header("Location: content_list.php");
    }

    $result = $con->query("SELECT * FROM tbl_content WHERE content_id =$id");
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $place = $data["content_place"];
        $title = $data["content_title"];
        $link = $data["content_link"];
        $detail = $data["content_detail"];
    } else {
        header("Location: content_list.php");
    }
    ?>
    <!------------------------- İÇERİK MODÜL ------------------------->
    <div class="col-10">
        <h2>İçerik Güncelleme</h2>
        <form action="content_control.php" method="post">
            <input type="hidden" name="process" value="update">
            <input type="hidden" name="content_id" value="<?= $id ?>">
            <div class="mb-3">
                <label for="exampleInputLink" class="form-label">Kategori</label>
                <select name="content_place" class="form-control">
                    <option <?= ($place == 0) ? 'selected' : '' ?> value="0">Ana Menü</option>
                    <?php
                    $result = $con->query("SELECT * FROM tbl_content WHERE content_place=0 AND content_id<>$id");
                    if ($result->num_rows > 0) {
                        while ($data = $result->fetch_assoc()) {
                            ?>
                            <option <?= ($place == $data["content_id"]) ? 'selected' : '' ?> value="<?= $data["content_id"] ?>"><?= $data["content_link"] ?></option>
                        <?php }
                    } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputTitle" class="form-label">İçerik Başlık</label>
                <input type="text" name="content_title" class="form-control" value="<?= $title ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputLink" class="form-label">İçerik Link</label>
                <input type="text" name="content_link" class="form-control" value="<?= $link ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputDetail" class="form-label">İçerik Detay</label>
                <textarea id="rich" name="content_detail" class="form-control"><?= $detail ?></textarea>
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