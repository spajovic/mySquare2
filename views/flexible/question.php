<?php
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $id = $user['id'];
        if($user['role'] == 'user'){
            include "models/korisnik/proveraglasanja.php";
            $provera = provera($id);
            if($provera){
                header("Location:index.php");
            }
            else{
                include "models/log/upisulog.php";
                pristup_strani();
?>
<div class="container">
        <div class="row d-flex justify-content-around">
            <div class="col-lg-7" id="anketa">
         
                <div class="card">
                        <div class="card-header">
                            <span class="span-naslov">Vote |</span>
                        </div>
                        <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="ddl-vote" class="labela-input" >Let us know, how would u rate your current living space :</label>
                                <select id="ddl-vote">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-primary" id="dgmVote">Vote</button>
                        </form>
                        </div>
                </div>

            </div>
        </div>
    </div>
<?php
            }
           

        }
        else{
            header("Location:index.php");
        }
    }     
        
?>