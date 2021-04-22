<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['stiglo'])){
            header("Content-Type: application/json");
            $id = $_POST['id'];
            require "../../../config/connection.php";
            if($conn){
                $query = "SELECT builderid as gradid, categoryid as katid, name as ime, price as cena, location as lokacija,info as duzi, underconstruction as konst FROM buildings WHERE buildingid = :id";
                $action = $conn->prepare($query);
                $action->bindParam(":id",$id);
                try{
                    $uspeh = $action->execute();
                    if($uspeh && $action->rowCount()==1){
                        $zgrada = $action->fetch();
                        http_response_code(200);
                        echo json_encode($zgrada);
                    }
                }
                catch(PDOException $mssg){
                    echo $mssg;
                }
            }   
        }
    }
    else{
        header('location:../../../index.php');
    }
?>