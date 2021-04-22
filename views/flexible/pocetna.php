<?php

$strana = isset($_GET['page'])? $_GET['page'] : 1;

include "models/zgrade/getbuildings.php";
$zgrade = dohvatizgrade($strana);
$brojStranica = paginacija();
include "models/log/upisulog.php";
pristup_strani();
?>

<div class="container">

<div class="row">
  <div class="col-lg-3">

    <h1 class="my-4" id="naslov">Our properties</h1>
    <div class="list-group" id="kategorije">
      
    </div>
    

  </div>

  <div class="col-lg-9">
    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox" id="slajdza">
          <div class="carousel-item active">
            <img class="d-block img-fluid" src="assets/img/slajder1.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="assets/img/slajder2.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="assets/img/slajder3.jpg" alt="Third slide">
          </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <div class="row" id="zgrade">
      <!-- Ispis zgrada -->
      <?php foreach($zgrade as $zgrada) : ?>
        <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="index.php?page=building&&id=<?= $zgrada['id']?>"><img class="card-img-top" src="assets/img/<?=$zgrada['src']?>" alt="<?=$zgrada['alt']?>"></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="index.php?page=building&&id=<?= $zgrada['id']?>" data-id="<?=$zgrada['id']?>"><?= $zgrada['ime'] ?></a>
            </h4>
            <h5 class="cenazgrade"><?= $zgrada['cena']?> $</h5>
            <p class="card-text"><?= $zgrada['sinfo']?>...</p>
          </div>
          <div class="card-footer">
            <a href="index.php?page=building&&id=<?= $zgrada['id']?>" data-id="<?=$zgrada['id']?>">More info -></a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <!-- Zgrade gotove -->
<nav aria-label="Page navigation example">
        <ul class="pagination">
            <!-- ISPIS PAGINACIJE -->
            <?php for($i = 1; $i <= $brojStranica;$i++) :?>
            <li class="page-item"><a class="page-link" href="index.php?page=<?=$i?>"><?=$i?></a></li>
            <?php endfor;?>
            <!-- Zavrsen ispis paginacije -->
        </ul>
    </nav>
    </div>
  </div>
</div>

</div>
