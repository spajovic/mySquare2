<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['stiglo'])){
            $id = $_POST['id'];
            header("Content-type:application/json");
            require "../../../config/connection.php";
            if($conn){
                $query = "SELECT navid as id,navname as name,href as href FROM navigation WHERE navid = :id";
                $action = $conn->prepare($query);
                $action->bindParam(":id",$id);
                try{
                    $uspeh = $action->execute();
                    if($uspeh){
                        $item = $action->fetchAll();
                        echo json_encode($item);
                    }
                    else{
                        http_response_code(404);
                    }
                }
                catch(PDOException $msg){
                    echo $msg->getMessage();
                }
            }
        }
        else{
            header("../../../index.php");
        }

    }
    else{
        header("../../../index.php");
    }




?>