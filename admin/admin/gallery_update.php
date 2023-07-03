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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
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
        if(isset($_GET["gallery_id"])){
            $id = $_GET["gallery_id"];
            $result = $con->query("SELECT * FROM tbl_gallery WHERE gallery_id =$id");
                if ($result->num_rows > 0) {
                    $data = $result->fetch_assoc();
                        $photo = $data["photo"];
                        $ticket = $data["gallery_ticket"];
                        $desc = $data["gallery_desc"];
                }else{
                    header("Location: gallery_list.php");
                }
        }else{
            header("Location: gallery_list.php");
        }
    ?>
    <!------------------------- İÇERİK MODÜL ------------------------->
    <div class="col-10">
        <h2>Galeri Güncelleme</h2>
        <form action="gallery_control.php" method="post">
            <input type="hidden" name="process" value="update">
            <input type="hidden" name="gallery_id" value="<?=$id?>">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Resim</label>
                <img src="../gallery/<?=$photo?>" height="200">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail2" class="form-label">Etiketler <sub>(her etiket arasına virgül koyarak yazınız)</sub></label>
                <input type="text" name="gallery_ticket" class="form-control" value="<?=$ticket?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Açıklama</label>
                <textarea name="gallery_desc" class="form-control" rows="5"><?=$desc?></textarea>
            </div>
            <button type="submit" class="btn btn-dark">GÜNCELLE</button>
        </form>
    </div>
    </div>
    <!------------------------- İÇERİK MODÜL ------------------------->

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