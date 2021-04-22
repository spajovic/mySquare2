<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(isset($_POST['stiglo'])){
                $gradid = $_POST['gradid'];
                $katid = $_POST['katid'];
                $ime = $_POST['ime'];
                $cena = $_POST['cena'];
                $lokacija= $_POST['lokacija'];
                $longtxt = $_POST['longtxt'];
                $konst = $_POST['konst'];
                $id = $_POST['id'];
                $proveraIme = "/^[A-ZĐŠŽĆČa-zđšžćč0-9\s]{2,29}$/";
                $proveraCene = "/^[0-9]{1,10}.00$/";
                $proveraLokacije = "/^[A-ZĐŠŽĆČ][a-zđšžćč]{1,40},\s{0,1}[A-ZĐŠŽĆČ][a-zđšžćč]{1,40}$/";
                $proveraInfo = "/^[a-zđšžćčA-ZĐŠŽĆČ.,;!?:'\%\-\.]{1,} [a-zđšžćčA-ZĐŠŽĆČ.,:?;!]{1,} .+$/";
                $greske = [];
                if(!preg_match($proveraIme,$ime)){
                    $greske[] = "Name is invalid";
                }
                if(!preg_match($proveraCene,$cena)){
                    $greske[] = "Price is invalid";
                }
                if(!preg_match($proveraLokacije,$lokacija)){
                    $greske[] = "Location is invalid";
                }
                if(!preg_match($proveraInfo,$longtxt)){
                    $greske[] = "Long info is invalid";
                }
                if(count($greske)){
                    foreach($greske as $err){
                        echo $err;
                    }
                }
                else{
                    require "../../../config/connection.php";
                    if($conn){
                        $kveri = "UPDATE buildings SET builderid = :gradid,categoryid = :katid,name = :ime,price = :cena,location = :lokacija,info = :longtxt,underconstruction = :konst WHERE buildingid = :id";
                        $promeni = $conn->prepare($kveri);
                        $promeni->bindParam(":gradid",$gradid);
                        $promeni->bindParam(":katid",$katid);
                        $promeni->bindParam(":ime",$ime);
                        $promeni->bindParam(":cena",$cena);
                        $promeni->bindParam(":lokacija",$lokacija);
                        $promeni->bindParam(":longtxt",$longtxt);
                        $promeni->bindParam(":konst",$konst);
                        $promeni->bindParam(":id",$id);
                        try{
                            $uspeh = $promeni->execute();
                            if($uspeh){
                                echo "Updated successfully";
                                http_response_code(202);
                            }
                            else{
                                http_response_code(400);
                            }
                        }
                        catch(PDOException $mssg){
                            echo $mssg->getMessage();
                        }
                    }
                }
        }
        else{
            header("Location:'../../../index.php'");

        }
    }
    else{   
        header("Location:'../../../index.php'");
    }
?>