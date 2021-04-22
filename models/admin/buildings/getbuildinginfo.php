<?php
    function getBuildings(){
        require "config/connection.php";
        if($conn){
            $upit = "SELECT b.buildingid as id,b.categoryId as katid,b.builderId as gradid,k.categoryName as kategorija,g.builderName as graditelj,b.name as name,b.price as price ,b.location as location ,b.underconstruction as gradnja FROM builder g INNER JOIN buildings b ON b.builderId = g.builderId INNER JOIN category k ON b.categoryId = k.categoryId";
            try{
                $uhvatisve = $conn->query($upit)->fetchAll();
                return $uhvatisve;
            }
            catch(PDOException $mssg){
                echo $mssg->getMessage();
            }
        }
    }
?>