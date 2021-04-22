<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if($_POST['stiglo']){
            $id = $_POST['id'];
            require "../../../config/connection.php";
            if($conn){
                $query = "DELETE FROM navigation WHERE navid=:id";
                $action = $conn->prepare($query);
                $action->bindParam(":id",$id);
                try{
                    $uspeh = $action->execute();
                    if($uspeh){
                        echo "Successfully delted";
                        http_response_code(202);
                    }
                    else{
                        http_response_code(400);
                    }
                }
                catch(PDOException $msg){
                    echo $msg->getMessage();
                }
            }
        }
        else{
        header("Location:../../../index.php");

        }
    }
    else{
        header("Location:../../../index.php");
    }



?>