<?php
    function kom_provera($id){
        require "config/connection.php";
        $upitKomentar = "SELECT r.comment as komentar,u.username as nickname FROM review r INNER JOIN user u ON r.userid = u.userid WHERE r.buildingid=:id";
        $dohvatiKomentar = $conn->prepare($upitKomentar);
        $dohvatiKomentar->bindParam(":id",$id);
        try{
            $uspesnost = $dohvatiKomentar->execute();
            if($uspesnost && $dohvatiKomentar->rowCount()>0){
                $komentari = $dohvatiKomentar->fetchAll();
                foreach($komentari as $comm){
                    $nik = $comm['nickname'];
                    $vrednostKomentara = $comm['komentar'];
                    echo"
                    <div class='card card-kom'>
                    <div class='card-body'>
                        <h5 class='card-title usernameKom'> $nik</h5>
                        <p class='card-text vrednostKom'>- &nbsp;$vrednostKomentara</p>
                    </div>
                </div>
                    ";
                }  
            }
            else{
                echo "<div class='card card-kom'>
                <div class='card-body'>
                    <span>There are no comments...</span>
                </div>
            </div>";
            }
        }
        catch(PDOException $mssg){
            echo $mssg;
        }
    }
    function dmgKom($id){
        echo '<button type="button" class="btn btn-info dgmKom" data-toggle="modal" data-target="#exampleModal">Leave a comment</button>';
        echo "<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>New comment</h5>
              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
            </div>
            <div class='modal-body'>
              <form>
                <div class='form-group'>
                  <label for='komentar' class='col-form-label'>Comment:</label>
                  <textarea class='form-control' id='komentar'></textarea>
                  <small id='komentarHelp' class='form-text text-muted'>Comment must include at least 3 words</small>
                </div>
              </form>
            </div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
              <button type='button' class='btn btn-primary' id='dugme-komentar' data-id='$id'>Send message</button>
            </div>
          </div>
        </div>
      </div>";
    }
?>