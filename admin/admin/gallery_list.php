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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <!------------------------- HEADER ------------------------->
    <?php include "header.php" ?>
    <!------------------------- HEADER ------------------------->

    <!------------------------- SIDEBAR ------------------------->
    <div class="row">
    <?php include "sidebar.php" ?>
    <!------------------------- SIDEBAR ------------------------->

    
    <!------------------------- İÇERİK MODÜL ------------------------->
    <div class="col-10">
        <h2>Galeri Listesi <a class="btn_add" href="gallery_add.php"><i class="bi bi-folder-plus"></i></a></h2>
            <div id="sortable">
                <?php
                $result = $con->query("SELECT * FROM tbl_gallery ORDER BY gallery_place");
                if ($result->num_rows > 0) {
                    while ($data = $result->fetch_assoc()) {
                        ?>
                <div class="photos" id="<?= $data["gallery_id"] ?>">
                    <img src="../gallery/<?= $data["photo"] ?>">
                    <div class="icon">
                        <?php if ($data["gallery_active"]) { ?>
                        <a href="gallery_control.php?process=active&durum=0&gallery_id=<?= $data["gallery_id"] ?>"><i class="bi bi-eye-fill  text-dark"></i></a>
                        <?php } else { ?>
                            <a href="gallery_control.php?process=active&durum=1&gallery_id=<?= $data["gallery_id"] ?>"><i class="bi bi-eye-slash-fill text-secondary"></i></a>
                            <?php } ?>
                        <a href="gallery_update.php?gallery_id=<?= $data["gallery_id"] ?>"><i class="bi bi-pencil-square text-success"></i></a>
                        <a href="#" onClick="if(confirm('Gerçekten silmek istiyor musunuz?')){document.location = 'gallery_control.php?process=delete&gallery_id=<?= $data["gallery_id"] ?>'}"><i class="bi bi-trash-fill  text-danger"></i></a>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
            <form action="gallery_control.php" method="post">
                <input type="hidden" name="sort" id="sort" value="">
                <input type="hidden" name="process" value="orderby">
                <br>
                <input type="submit" value="SIRALA" src="">
            </form>
    </div>
    </div>
    <!------------------------- İÇERİK MODÜL ------------------------->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#sortable").sortable({
                stop: function(event, ui) {
                    var place = '';
                    $("#sortable tr").each(function(index) {
                        place = place + ',' + $(this).attr("id");
                    });

                    $("#sort").attr('value', place);
                }
            });
        });
    </script>
</body>
</html>