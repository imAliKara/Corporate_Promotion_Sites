<div id="carouselExampleCaptions" class="carousel slide">
  <?php
  $result = $con->query("SELECT * FROM tbl_news WHERE news_active=1 ORDER BY news_place");
  if ($result->num_rows > 0) {?>
  <div class="carousel-indicators">
    <?php for($i=0;$i<$result->num_rows;$i++){?>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?=$i?>" <?=($i==0)?'class="active" aria-current="true"':''?> aria-label="Slide"></button>
    <?php } ?>
  </div>
  <div class="carousel-inner">
  <?php
  $say=0;
    while ($data = $result->fetch_assoc()) { 
      $say++;
      ?>
    <div class="carousel-item <?=($say==1)?'active':''?>">
      <img src="./news/<?=$data["news_photo"]?>" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5><?=$data["news_title"]?></h5>
        <p><?=$data["news_ozet"]?></p>
        <a class="btn btn-dark" href="news_detail.php?news_id=<?=$data["news_id"]?>">Daha Fazla</a>
      </div>
    </div>
    <?php
    }
  }
  ?>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Önceki</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Sonraki</span>
  </button>
</div>