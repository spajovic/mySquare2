<?php
  include "models/navigacija/getnav.php";
  $nav_izlogovan = nav_izlogovan();
  $nav_ulogovan = nav_ulogovan();
  session_start();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">mySquare</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
          <!-- ispis linkova u zavisnosti od prisustva sesije -->
            <?php  if(!isset($_SESSION['user'])){?>
              <ul class="navbar-nav ml-auto">
              <?php foreach($nav_izlogovan as $nav) :?>
              <li class="nav-item">
                <a class="nav-link" href="<?=$nav['href']?>"><?=$nav['naziv']?></a>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php } ?>
            <?php  if(isset($_SESSION['user'])){?>
              <ul class="navbar-nav ml-auto">
              <?php foreach($nav_ulogovan as $nav) :?>
              <li class="nav-item">
                <a class="nav-link" href="<?=$nav['href']?>"><?=$nav['naziv']?></a>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php } ?>
            <!-- kraj -->
      </div>
    </div>
  </nav>