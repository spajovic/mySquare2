<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if($_POST['stiglo']){
            $ime = $_POST['ime'];
            // rad sa uploadovanom slikom
            $slika = $_FILES['slika'];
            $tmp_name = $slika['tmp_name'];
            $name = $slika['name'];
            $name = time().'_'.$name;
            $size = $slika['size'];
            $type = $slika['type'];
            if($slika['size'] == 0){
                echo "<b>You must upload picture</b>";
                die;
            }
            if($size > 800*1024){
                echo "<b>Image size exetnds maximum size allowed.";
                die;
            }
            if(!$type == 'image/jpeg'){
                echo "<b>Picture must be .jpeg</b>";
                die;
            }
            define("PUTANJA","../../../assets/img/");
            $putanja1 = PUTANJA.'original/'.$name;
            $uploaded = move_uploaded_file($tmp_name,$putanja1);
            if($uploaded){
                $dimenzije = getimagesize($putanja1);
                $width = $dimenzije[0];
                $height = $dimenzije[1];
                $new_width = 700;
                $new_height = 400;
                $platno = imagecreatetruecolor($new_width,$new_height);
                $stara_slika = imagecreatefromjpeg($putanja1);
                imagecopyresampled($platno,$stara_slika,0,0,0,0,$new_width,$new_height,$width,$height);
                $nova_slika_naziv = 'new_'.time().'_gradjevina.jpg';
                $putanja2 = PUTANJA.$nova_slika_naziv;
                imagejpeg($platno,$putanja2,100);
                unset($putanja1);
            }
            else{
                echo "Failed to upload picture, try again later";
            }
            // kraj slike
            $gradid = $_POST['gradid'];
            $katid = $_POST['katid'];
            $cena = $_POST['cena'];
            $lokacija = $_POST['lokacija'];
            $longtxt1 = $_POST['longtxt1'];
            $konst = $_POST['konst'];
            $gresak = [];
            $proveraIme = "/^[A-ZĐŠŽĆČa-zđšžćč0-9\s]{2,29}$/";
            $proveraCene = "/^[0-9]{1,10}.00$/";
            $proveraLokacije = "/^[A-ZĐŠŽĆČ][a-zđšžćč]{1,40},\s{0,1}[A-ZĐŠŽĆČ][a-zđšžćč]{1,40}$/";
            $proveraInfo = "/^[a-zđšžćčA-ZĐŠŽĆČ.,;!?:'\%\-\.]{1,} [a-zđšžćčA-ZĐŠŽĆČ.,:?;!]{1,} .+$/";

            if(!preg_match($proveraIme,$ime)){
                $gresak[] = "Name is invalid";
            }
            if(!preg_match($proveraCene,$cena)){
                $gresak[] = "Price is invalid";
            }
            if(!preg_match($proveraLokacije,$lokacija)){
                $gresak[] = "Price is invalid";
            }
            if(!preg_match($proveraInfo,$longtxt1)){
                $gresak[] = "Long info is invalid";
            }
            if(count($gresak)){
                foreach($gresak as $err){
                    echo $err;
                }
            }
            else{
                require "../../../config/connection.php";
                if($conn){
                    $query = "INSERT INTO buildings VALUES(null,:katid,:gradid,:ime,:longtxt1,:cena,:lokacija,:konst)";
                    $insert = $conn->prepare($query);
                    $insert->bindParam(":katid",$katid);
                    $insert->bindParam(":gradid",$gradid);
                    $insert->bindParam(":ime",$ime);
                    $insert->bindParam(":longtxt1",$longtxt1);
                    $insert->bindParam(":cena",$cena);
                    $insert->bindParam(":lokacija",$lokacija);
                    $insert->bindParam(":konst",$konst);
                    try{
                        $uspeh = $insert->execute();
                        if($uspeh){
                           $query1 = "SELECT buildingid FROM buildings ORDER BY buildingid DESC LIMIT 1";
                           $zadnji = $conn->query($query1)->fetch();
                           if($zadnji['buildingid']){
                            $id = $zadnji['buildingid'];
                            $slikaquery = "INSERT INTO picture VALUES(:id,:src,'property')";
                            $ubacisliku = $conn->prepare($slikaquery);
                            $ubacisliku->bindParam(":id",$id);
                            $ubacisliku->bindParam(":src",$nova_slika_naziv);
                            try{
                                $uspeh1 = $ubacisliku->execute();
                                if($uspeh1){
                                    echo "Successfully inserted, go back to admin page!";
                                }
                            }
                            catch(PDOException $poruka){
                                echo $poruka;
                            }
                           }
                        }
                    }
                    catch(PDOException $mssg){
                        echo $mssg;
                    }
                }
            }
        }
        else{
            header('Location:../../../index.php');

        }
    }
    else{
        header('Location:../../../index.php');
    }
?>