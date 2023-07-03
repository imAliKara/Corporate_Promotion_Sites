<div class="container">
  <footer class="container d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-body-secondary">&copy; 2023 KARA Ltd. Şti., Tüm Hakkı Saklıdır</p>
    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <img class="logo" src="logo.png" alt="">
    </a>
    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="index.php" class="nav-link px-2 text-body-secondary">Anasayfa</a></li>
      <?php
      $result = $con->query("SELECT * FROM tbl_content WHERE content_place=0 and content_active ORDER BY content_place");
      if ($result->num_rows > 0) {
        while ($data = $result->fetch_assoc()) {?>
        <li class="nav-item"><a href="content_detail.php?content_id=<?= $data["content_id"] ?>" class="nav-link px-2 text-body-secondary"><?= $data["content_link"] ?></a></li>
        <?php
        }
      }?>
    </ul>
  </footer>
</div>