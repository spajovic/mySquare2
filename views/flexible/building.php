<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        include "models/post/getbuilding.php";
        $zgrada = dohvatiZgradu($id);
        include "models/log/upisulog.php";
        pristup_strani();
    }
    else{
        header("Location:../../index.php");
    }
?>
 <div class="container">
<div class="row">
    <div class="col-lg-9">
            <div class="card mt-4">
            <img class="card-img-top img-fluid" src="assets/img/<?php echo $zgrada['src'];?>" alt="<?php echo $zgrada['alt'];?>">
            <div class="card-body">
                <h3 class="card-title naslovzgrade"><?php echo $zgrada['ime'];?></h3>
                <h4 class="cenazgrade"><?php echo $zgrada['cena'];?> $</h4>
                <p class="card-text"><?php echo $zgrada['info'];?></p>
                <h6 class="ozgradi"><b>Builder</b>: <?php echo $zgrada['graditelj'];?></h6>
                <h6 class="ozgradi"><b>Location</b>: <?php echo $zgrada['lokacija'];?></h6>
                <h6>
                    <?php
                        $konstrukcija = $zgrada['konstrukcija'];
                        if($konstrukcija){
                            echo "<del>READY TO BE USED</del>";
                        }
                        else{
                            echo "<h5 class='spremno'>READY TO BE USED</h5>";
                        }
                    ?>
                </h6>
            </div>
            </div>
            <!-- /.card -->
            <div class="card card-outline-secondary my-4">
                <div class="card-header">
                    <span id="naslov-komentar">Property reviews</span></br>
                    <small>(you must be logged in to comment)</small>
                </div>
                <div class="card-body">
                    <?php
                        include "models/komentari/dohvaranjekom.php";
                        kom_provera($id);
                    ?>
                    <?php   
                        if(isset($_SESSION['user'])){
                           dmgKom($id);
                        }
                        else{
                            echo '<a href="index.php?page=login" class="btn btn-info">Log In</a>';
                        }  
                    ?>
                    
                </div>
                </div>
        <!-- /.card -->

    </div>
<!-- /.col-lg-9 -->

</div>

</div>