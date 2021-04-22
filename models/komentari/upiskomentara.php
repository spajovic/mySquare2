<?php
    session_start();
    if(isset($_POST['stiglo']) && isset($_SESSION['user'])){
        $id = $_POST['zgradaId'];
        $komentar = $_POST['komentar'];
        $covek = $_SESSION['user'];
        $covekId = $covek['id'];
        $proveraKomentar = "/^[a-zđšžćčA-ZĐŠŽĆČ.,;!?:'\%\-\.]{1,} [a-zđšžćčA-ZĐŠŽĆČ.,:?;!]{1,} .+$/";
        if(!preg_match($proveraKomentar,$komentar)){
            echo "Malo gresak";
        }
        else{
            require "../../config/connection.php";
            if($conn){
                $upit = "INSERT INTO review VALUES(null,:id,:userid,:komentar)";
                $upisKom = $conn->prepare($upit);
                $upisKom->bindParam(":id",$id);
                $upisKom->bindParam(":userid",$covekId);
                $upisKom->bindParam(":komentar",$komentar);
                try{
                    $uspelo = $upisKom->execute();
                    if($uspelo){
                        http_response_code(201);
                        echo "Successfully commented, please refresh page";
                    }
                }
                catch(PDOException $mssg){
                    echo $mssg;
                }
            }
        }
    }
    else{
        header("Location:../../index.php");
    }

?>