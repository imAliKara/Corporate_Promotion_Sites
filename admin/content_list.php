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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
            <h2>İçerik Listesi <a class="btn_add" href="content_add.php"><i class="bi bi-file-earmark-plus-fill"></i></a></h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Link</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="sortable">
                    <?php
                    $layer[0] = "Ana Menü";
                    $result = $con->query("SELECT * FROM tbl_content WHERE content_category=0");
                    if ($result->num_rows > 0) {
                        while ($data = $result->fetch_assoc()) {
                            $layer[$data["content_id"]] = $data["content_link"];
                        }
                    }
                    ?>
                    <?php
                    $result = $con->query("SELECT * FROM tbl_content ORDER BY content_place");
                    if ($result->num_rows > 0) {
                        while ($data = $result->fetch_assoc()) {
                    ?>
                            <tr id="<?= $data["content_id"] ?>">
                                <td><?= $data["content_id"] ?></td>
                                <td><?= $data["content_title"] ?></td>
                                <td><?= $data["content_link"] ?></td>
                                <td><?= $layer[$data["content_category"]] ?></td>
                                <td>
                                    <?php if ($data["content_active"]) { ?>
                                        <a href="content_control.php?process=active&durum=0&content_id=<?= $data["content_id"] ?>"><i class="bi bi-eye-fill  text-dark"></i></a>
                                    <?php } else { ?>
                                        <a href="content_control.php?process=active&durum=1&content_id=<?= $data["content_id"] ?>"><i class="bi bi-eye-slash-fill text-secondary"></i></a>
                                    <?php } ?>
                                    <a href="content_update.php?content_id=<?= $data["content_id"] ?>"><i class="bi bi-pencil-square text-success"></i></a>
                                    <a href="content_control.php?process=delete&content_id=<?= $data["content_id"] ?>"><i class="bi bi-trash-fill  text-danger"></i></a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
            <form action="content_control.php" method="post">
                <input type="hidden" name="sort" id="sort" value="">
                <input type="hidden" name="process" value="orderby">
                <br>
                <input type="submit" value="SIRALA">
            </form>
        </div>
    </div>
    <!------------------------- İÇERİK MODÜL ------------------------->

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
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
