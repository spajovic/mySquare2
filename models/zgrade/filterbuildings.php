<?php
    if($_GET['id']){
        require_once "../../config/connection.php";
        header("Content-Type: application/json");
        $id = $_GET['id'];
        $upit = "SELECT b.buildingId as id,b.name as name,b.price as price,SUBSTR(b.info FROM 1 FOR 180) as sinfo,b.categoryid as categoryid,p.src as src,p.alt as alt FROM buildings b INNER JOIN picture p ON b.buildingid = p.buildingid WHERE b.categoryId = :id";
        $filter = $conn->prepare($upit);
        $filter->bindParam(":id",$id);
        try{
            $upit = $filter->execute();
            if($upit){
                $podaci = $filter->fetchAll();
                echo json_encode($podaci);
                http_response_code(202);
            }
            else{
                http_response_code(404);
            }
        }
        catch(PDOException $msg){
            http_response_code(404);
        }
    }
    else{
        header('Location:../../index.php');
    }
?>