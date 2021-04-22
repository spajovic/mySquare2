<?php
        function dohvatiZgradu($id){
            require "config/connection.php";
            $query = "SELECT  b.buildingId as id ,b.name as ime,b.location as lokacija ,b.price as cena ,b.Info as info ,c.builderName as graditelj,b.underconstruction as konstrukcija,p.src as src,p.alt as alt FROM buildings b INNER JOIN builder c ON b.builderId = c.builderId INNER JOIN picture p ON b.buildingid = p.buildingid WHERE b.buildingId = :id";
            $dohvati = $conn->prepare($query);
            $dohvati->bindParam(":id",$id);
            try{
                $akcija = $dohvati->execute();
                $broj = $dohvati->rowCount();
                if(!$akcija ){
                    http_response_code(404);
                }
                else if($broj < 1){
                    header("Location: 404.php");
                }
                else{
                    $zgrada = $dohvati->fetch();
                    return $zgrada;
                }
            }
            catch(PDOException $msg){
                echo $msg;
            }
        }
?>