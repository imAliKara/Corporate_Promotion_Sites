<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img class="logo" src="logo.png" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="index.php">Anasayfa</a></li>
        <?php
        $result = $con->query("SELECT * FROM tbl_content WHERE content_place=0 AND content_active=1 ORDER BY content_place");
        if ($result->num_rows > 0) {
          while ($data = $result->fetch_assoc()) {
            $menu = $con->query("SELECT * FROM tbl_content WHERE content_place=" . $data["content_id"] . " AND content_active=1 ORDER BY content_place");
            if ($menu->num_rows > 0) {?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $data["content_link"] ?>
              </a>
              <ul class="dropdown-menu">
                <?php
                while ($menus = $menu->fetch_assoc()) {
                ?>
                <li><a class="dropdown-item" href="content_detail.php?content_id=<?= $menus["content_id"] ?>"><?=$menus["content_link"]?></a></li>
                <?php
              }?>
              </ul>
            </li>
            <?php
          } else { ?>
          <li class="nav-item"><a class="nav-link" href="content_detail.php?content_id=<?= $data["content_id"] ?>"><?= $data["content_link"] ?></a></li>
          <?php
          }
        }
        } ?>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Ara" aria-label="Search">
          <button class="btn btn-outline-dark" type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>
  </div>
</nav>