<?php
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        if($user['role'] == "admin"){
            include "models/admin/buildings/getbuildinginfo.php";
            include "models/admin/comments/getcommentsinfo.php";
            include "models/admin/users/getUsers.php";
            include "models/admin/votes/getvotes.php";
            include "models/admin/navigation/getNav.php";
            $buildings = getBuildings();
            $komentari = getComments();
            $users = getUsers();
            $admins = getAdmins();
            $rezultati = getResults();
            $navigacija = getNav();
            include "models/admin/statistics/functions.php";
            $info = pristupStranama_procenat();
            ?>
            <!-- STATISTIKA O POSECENOSTI STRANICA -->
            <h4 class="bazaNaslovi">Statistics</h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Home</th>
                    <th scope="col">Building</th>
                    <th scope="col">Login</th>
                    <th scope="col">Register</th>
                    <th scope="col">Author</th>
                    <th scope="col">Question</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="col"><?=$info['home']?>%</th>
                        <th scope="col"><?=$info['building']?>%</th>
                        <th scope="col"><?=$info['login']?>%</th>
                        <th scope="col"><?=$info['register']?>%</th>
                        <th scope="col"><?=$info['author']?>%</th>
                        <th scope="col"><?=$info['question']?>%</th>
                    </tr>
                </tbody>
            </table>
            <!-- UPRAVLJANJE ZGRADAMA -->
            <h4 class="bazaNaslovi">Buildings</h4>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#insert-modal" id="insertDgm1">Create new building</button>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Category</th>
                    <th scope="col">Builder</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Location</th>
                    <th scope="col">Construction</th>
                    <th scope="col">UPDATE</th>
                    <th scope="col">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($buildings as $hvat) :?>
                        <tr>
            <td><?= $hvat['id'] ?></td>
            <td><?= $hvat['kategorija'] ?></td>
            <td><?= $hvat['graditelj'] ?></td>
            <td><?= $hvat['name'] ?></td>
            <td><?= $hvat['price'] ?></td>
            <td><?= $hvat['location'] ?></td>
            <td><?= $hvat['gradnja'] ?></td>
            <td><button type="button" class="btn btn-info dgmUp" data-toggle="modal" data-target="#update-modal" data-id = "<?=$hvat['id']?>">Update</button></td>
                <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" >Update</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- FORMA ZA UPDATE -->
                            <form method="post" action="updateZgrada.php">
                            <div class="form-group">
                                <label for="ddl-update" class="col-form-label">Builder:</label>
                                <select id="ddl-update">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ddl-update1" class="col-form-label">Category:</label>
                                <select id="ddl-update1">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="update-name">Name:</label>
                                <input class="form-control" type="text" id="update-name">
                                <small id="imeHelp3" class="form-text text-muted">Name can only include letters, first letter must be capital, max 29 characters</small>
                            </div>
                            <div class="form-group">
                                <label for="update-price">Price:</label>
                                <input class="form-control" type="text" id="update-price">
                                <small id="imeHelp3" class="form-text text-muted">price must be in ****.00 format, and maximum of 10 digits before dot</small>
                            </div>
                            <div class="form-group">
                                <label for="update-location">Location:</label>
                                <input class="form-control" type="text" id="update-location">
                                <small id="imeHelp4" class="form-text text-muted">Only letters and max of 29 charachters, location must be in format "city_name, state_name"</small>
                            </div>
                            <div class='form-group'>
                                      <label for='infoDug' class='col-form-label'>Info</label>
                                      <textarea class='form-control' id='infoDug'></textarea>
                                      <small id='infoDugHelp' class='form-text text-muted'>Info must include at least 3 words</small>
                            </div>
                            <div class="form-group">
                                <label for="ddl-update2">Under Construction:</label>
                                <select id="ddl-update2">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <input type="hidden" id="sakriveno">
                            <button type="button" class="btn btn-primary" id="update-dugme">Update</button>
                            </form>
                            <!-- Kraj forme -->
                        </div>
                        </div>
                    </div>
                </div>
            <td><button type="button" class="btn btn-info dgmDelete" data-id="<?= $hvat['id'] ?>">Delete</button></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
                        <!-- FORMA ZA INSERT ZGRADE -->
                        <div class="modal fade" id="insert-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" >Insert</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- FORMA ZA INSERT -->
                            <form enctype="multipart/form-data" id="forma-insert" method="POST" action="models/admin/buildings/createbuilding.php">
                            <div class="form-group">
                                <label for="ddl-insert" class="col-form-label">Builder:</label>
                                <select id="ddl-insert" name="gradid">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ddl-insert1" class="col-form-label">Category:</label>
                                <select id="ddl-insert1" name="katid">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="insert-name">Name:</label>
                                <input class="form-control" type="text" id="insert-name" name="ime">
                                <small id="imeHelp3" class="form-text text-muted">Name can only include letters, first letter must be capital, max 29 characters</small>
                            </div>
                            <div class="form-group">
                                <label for="insert-price">Price:</label>
                                <input class="form-control" type="text" id="insert-price" name="cena">
                                <small id="imeHelp3" class="form-text text-muted">Price must be in ****.00 format, and maximum of 10 digits before dot</small>
                            </div>
                            <div class="form-group">
                                <label for="insert-location">Location:</label>
                                <input class="form-control" type="text" id="insert-location" name="lokacija">
                                <small id="imeHelp4" class="form-text text-muted">Only letters and max of 29 charachters, location must be in format "city_name, state_name"</small>
                            </div>
                            <div class='form-group'>
                                      <label for='infoDug1' class='col-form-label'>Info</label>
                                      <textarea class='form-control' id='infoDug1' name="longtxt1"></textarea>
                                      <small id='infoDugHelp' class='form-text text-muted'>Info must include at least 3 words</small>
                            </div>
                            <div class="form-group">
                                <label for="insert-src">Picture src:</label>
                                <input class="form-control" type="file" id="insert-src" name="slika">
                                <small id="imeHelp3" class="form-text text-muted">Picture must have .jpg extension and have maximum size of 600kb</small>
                            </div>
                            <div class="form-group">
                                <label for="ddl-insert2">Under Construction:</label>
                                <select id="ddl-insert2" name="konst">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <input type="submit" value="Insert new building" class="btn btn-primary" name="stiglo">
                            </form>
                            <!-- Kraj forme -->
                        </div>
                        </div>
                    </div>
                </div>
            <!-- KRAJ UPRAVLJANJA ZGRADAMA -->
            <!-- UPRAVLJANJE NAVIGACIJOM -->
            <h4 class="bazaNaslovi">Navigation</h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">href</th>
                    <th scope="col">UPDATE</th>
                    <th scope="col">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach($navigacija as $nav) :?>
                        <tr>
                        <td scope="col"><?=$nav['id']?></td>
                        <td scope="col"><?=$nav['name']?></td>
                        <td scope="col"><?=$nav['href']?></td>
                        <td scope="col">
                            <button type="button" class="btn btn-info updateNav" data-toggle="modal" data-target="#exampleModal" data-id="<?=$nav['id']?>">Update</button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update navigation Item</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Value</label>
                                        <input type="text" class="form-control" id="nav-value">
                                        <small id="imeHelp5" class="form-text text-muted">Maximum of 32 char.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">href</label>
                                        <input type="text" class="form-control" id="nav-href">
                                        <small id="imeHelp4" class="form-text text-muted">No spaces allowed, maximum of 99 char.</small>

                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="hidden" class="sakriveno1">
                                    <button type="button" class="btn btn-primary navIzmena">Update</button>
                                </div>
                                </div>
                            </div>
                            </div>
                        </td>
                        <td><button type="button" class="btn btn-info navDelete" data-id="<?=$nav['id']?>">Delete</button></td>
                        </tr>
                        <?php endforeach ?>
                    </tr>
                </tbody>
            </table>
            <!-- KRAJ UPRAVLJANJA NAVIGACIJOM -->

            <!-- UPRAVLJANJE KOMENTARIMA -->
            <h4 class="bazaNaslovi">Reviews</h4>
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Content</th>
                    <th scope="col">Remove</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($komentari as $kom) : ?>
                    <tr>
                        <td><?= $kom['id'] ?></td>
                        <td><?= $kom['ime'] ?></td>
                        <td><?= $kom['prezime'] ?></td>
                        <td><?= $kom['mail'] ?></td>
                        <td><?= $kom['imence'] ?></td>
                        <td><?= $kom['uloga'] ?></td>
                        <td><?= $kom['komentar'] ?></td>
                        <td><button type="button" class="btn btn-info komDelete" data-id="<?= $kom['id'] ?>">Delete</button></td>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>
            <!-- KRAJ SA UPRAVLJANJEM KOMENTARA -->

            <!-- UPRAVLJANJE KORISNICIMA -->
            <h4 class="bazaNaslovi">Users</h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $usr) : ?>
                    <tr>
                        <td><?= $usr['idu'] ?></td>
                        <td><?= $usr['name'] ?></td>
                        <td><?= $usr['surname'] ?></td>
                        <td><?= $usr['mail'] ?></td>
                        <td><?= $usr['userime'] ?></td>
                        <td><?= $usr['uloga1'] ?></td>
                        <td><button type="button" class="btn btn-info userDelete" data-id="<?= $usr['idu'] ?>">Delete</button></td></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- KRAJ UPRAVLJANJA KORISNICIMA -->

            <!-- UVID U ADMINE STRANE -->
            <h4 class="bazaNaslovi">Admins</h4>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($admins as $usr) : ?>
                    <tr>
                        <td><?= $usr['idu'] ?></td>
                        <td><?= $usr['name'] ?></td>
                        <td><?= $usr['surname'] ?></td>
                        <td><?= $usr['mail'] ?></td>
                        <td><?= $usr['userime'] ?></td>
                        <td><?= $usr['uloga1'] ?></td>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- KRAJ UVIDA U ADMINE STRANE -->

            <!-- UVID U REZULTATE ANKETE -->
            <h4 class="bazaNaslovi">Vote results :</h4>
            <table class="table vote-result">
                <thead>
                    <tr>
                        <th scope="col">Number of votes</th>
                        <th scope="col">Average grade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="col"><?= $rezultati['broj'] ?></td>
                        <td scope="col"><?= $rezultati['prosek'] ?></td>
                    </tr>
                </tbody>
            </table>

<?php
        }
        else{
            header('Location:../../index.php');
        }
    }
    else{
        header('Location:../../index.php');
    }

?>