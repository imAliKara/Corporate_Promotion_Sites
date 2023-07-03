<?php include "../connect.php" ?>
<?php if(! $_SESSION["permission"]){header("Location: index.php");}?>
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

    <!------------------------- İÇERİK MODÜL ------------------------->
    <div class="col-10">
        <h2>Kullanıcı Listesi <a class="btn_add" href="user_add.php"><i class="bi bi-person-fill-add"></i></a></h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>İsim</th>
                    <th>Kullanıcı Adı</th>
                    <th>Kullanıcı Şifre</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $con->query("SELECT * FROM tbl_user");
                if ($result->num_rows > 0) {
                    while ($data = $result->fetch_assoc()) {
                        ?>
                <tr>
                    <td>
                        <?= $data["user_id"] ?>
                    </td>
                    <td>
                        <?= $data["user_name"] ?>
                    </td>
                    <td>
                        <?= $data["username"] ?>
                    </td>
                    <td>
                        <?= $data["user_password"] ?>
                    </td>
                    <td>
                        <a href=""><i class="bi bi-eye-fill  text-dark"></i></a>
                        <a href="user_update.php?user_id=<?= $data["user_id"] ?>"><i class="bi bi-pencil-square text-success"></i></a>
                        <a href="user_control.php?process=delete&user_id=<?= $data["user_id"] ?>"><i class="bi bi-trash-fill  text-danger"></i></a>
                    </td>
                </tr>
                <?php }
                } ?>
            </tbody>
        </table>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>