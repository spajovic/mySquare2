<?php
    function dohvatizgrade($broj){
        require "config/connection.php";
        if($conn){
            $limit = 6;
            $start = ($broj - 1)*$limit;
            $query = "SELECT b.buildingId as id,b.name as ime,b.price as cena ,b.categoryid as kat,SUBSTR(b.info FROM 1 FOR 180) as sinfo,p.src as src,p.alt as alt FROM buildings b INNER JOIN picture p ON b.buildingid = p.buildingid LIMIT $start,$limit";
            $action = $conn->prepare($query);
            try{
                $uspeh = $action->execute();
                if($uspeh && $action->rowCount() >= 1){
                    $tekstovi = $action->fetchAll();
                        http_response_code(202);
                        return $tekstovi;
                }
                else{
                    http_response_code(404);
                }
            }
            catch(PDOException $p){
                http_response_code(404);
            }
        }
    }

    function paginacija(){
        require "config/connection.php";
        if($conn){
                    $limit = 6;
                    $query = "SELECT count(buildingId) as broj FROM buildings";
                    try{
                        $broj = $conn->query($query);
                        $ukupanBroj = $broj->fetch();
                        $total = $ukupanBroj['broj'];
                        $brojStranica = ceil($total/$limit);
                        return $brojStranica;
                    }
                    catch(PDOException $p){
                        echo $p->getMessage();
                    }
        }
    }
?>