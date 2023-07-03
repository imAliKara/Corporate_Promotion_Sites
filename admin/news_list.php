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
            <h2>Haber Listesi <a class="btn_add" href="news_add.php"><i class="bi bi-newspaper"></i></a></h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Haber</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="sortable">
                    <?php
                    $result = $con->query("SELECT * FROM tbl_news ORDER BY news_place");
                    if ($result->num_rows > 0) {
                        while ($data = $result->fetch_assoc()) {
                            ?>
                            <tr id="<?= $data["news_id"] ?>">
                                <td>
                                    <?= $data["news_id"] ?>
                                </td>
                                <td>
                                    <img class="news__photo" src="../news/<?= $data["news_photo"] ?>">
                                    <strong><?= $data["news_title"] ?></strong><br>
                                    <?= $data["news_ozet"] ?>
                                </td>
                                <td>
                                    <?php if ($data["news_active"]) { ?>
                                        <a href="news_control.php?process=active&durum=0&news_id=<?= $data["news_id"] ?>"><i class="bi bi-eye-fill  text-dark"></i></a>
                                    <?php } else { ?>
                                        <a href="news_control.php?process=active&durum=1&news_id=<?= $data["news_id"] ?>"><i class="bi bi-eye-slash-fill text-secondary"></i></a>
                                    <?php } ?>
                                    <a href="news_update.php?news_id=<?= $data["news_id"] ?>"><i class="bi bi-pencil-square text-success"></i></a>
                                    <a href="news_control.php?process=delete&news_id=<?= $data["news_id"] ?>"><i class="bi bi-trash-fill  text-danger"></i></a>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                </tbody>
            </table>
            <form action="news_control.php" method="post">
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
                        place = place + ',' + $(this).attr('id');
                    });

                    $("#sort").attr('value', place);
                }
            });
        });
    </script>
</body>

</html>
