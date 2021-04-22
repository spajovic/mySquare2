<?php
    session_start();
    if(isset($_SESSION['user'])){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['stiglo'])){
            $vote = $_POST['vote'];
            $user = $_SESSION['user'];
            $id = $user['id'];
            require "../../config/connection.php";
            if($conn){
                $query = "INSERT INTO votes VALUES(NULL,:vote,:id)";
                $upisi = $conn->prepare($query);
                $upisi->bindParam(":vote",$vote);
                $upisi->bindParam(":id",$id);
                try{
                    $uspeh = $upisi->execute();
                    if($uspeh){
                        http_response_code(201);
                        echo "Voted Successfully";
                    }
                    else{
                        echo "Something went wrong";
                    }
                }
                catch(PDOException $sms){
                    echo $sms;
                }

            }
            

        }
        else{
        header('Location:../../index.php');
        }
    }
    else{
        header('Location:../../index.php');
    }
}


?>