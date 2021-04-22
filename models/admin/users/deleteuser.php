<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['stiglo']){
            require '../../../config/connection.php';
            $id = $_POST['id'];
            if($conn){
                $upit = "DELETE FROM user WHERE userid = :id";
                $delete = $conn->prepare($upit);
                $delete->bindParam(":id",$id);
                try{
                    $uspeh = $delete->execute();
                    if($uspeh){
                        echo "User deleted successfully";
                        http_response_code(202);
                    }
                    else{
                        http_response_code(404);
                    }
                }
                catch(PDOException $mssg){
                    echo $mssg;
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