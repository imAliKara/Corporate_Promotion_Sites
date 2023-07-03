<?php include "connect.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KARA Teknoloji</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="buyukfoto position-fixed">
        <img src="./gallery/photo1.jpg">
        <p></p>
    </div>
    <!------------------------- HEADER ------------------------->
    <?php include "header.php" ?>
    <!------------------------- HEADER ------------------------->

    <!------------------------- SLIDER ------------------------->
    <?php include "slider.php" ?>
    <!------------------------- SLIDER -------------------------->

    <?php
    if (!empty($_GET["content_id"])) {
      $id = $_GET["content_id"];
      $result = $con->query("SELECT * FROM tbl_content WHERE content_id=$id AND content_active=1");
      if ($result->num_rows > 0) {
        $data = $result->fetch_assoc(); ?>
        <!------------------------- GALLERY ------------------------->
    <div class="container mt-5 fotolar">
        <h3><?=$data["content_title"]?></h3><hr>
         <div align="left"><?=$data["content_detail"]?></div>
    </div>
    <?php
      } else {
        header("Location: index.php");
      }
    } else {
      header("Location: index.php");
    }
    ?>
    <!------------------------- GALLERY ------------------------->

    <!------------------------- FOOTER -------------------------->
    <?php include "footer.php" ?>
    <!------------------------- FOOTER -------------------------->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
      $(".buyukfoto").click(function(){
          $(this).fadeOut();
      });

      $(".fotolar img").click(function(){
          var kucuksrc = $(this).attr("src");
          var kucukyazi = $(this).attr("alt");
          $(".buyukfoto img").attr("src",kucuksrc);
          $(".buyukfoto p").text(kucukyazi);
          $(".buyukfoto").fadeIn();
      });
  </script>
</body>
</html>