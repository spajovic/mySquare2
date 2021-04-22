<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['stiglo']){
            require '../../../config/connection.php';
            $id = $_POST['id'];
            if($conn){
                $upit = "DELETE FROM buildings WHERE buildingid = :id";
                $delete = $conn->prepare($upit);
                $delete->bindParam(":id",$id);
                try{
                    $uspeh = $delete->execute();
                    if($uspeh){
                        echo "Building deleted successfully";
                        http_response_code(200);
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
        else{
            header('Location:../../../index.php');

        }
    }
    else{
        header('Location:../../../index.php');
    }
?>