<?php
    function nav_izlogovan(){
        require "config/connection.php";
        $element1 = "Home";
        $element2 = "Register";
        $element3 = "Log In";
        $element4 = "Author";
        if($conn){
            $upit = "SELECT navName as naziv,href as href FROM navigation WHERE navName IN (:element1,:element2,:element3,:element4)";
            $action = $conn->prepare($upit);
            $action->bindParam(":element1",$element1);
            $action->bindParam(":element2",$element2);
            $action->bindParam(":element3",$element3);
            $action->bindParam(":element4",$element4);

            try{
                $uspeh = $action->execute();
                if($uspeh){
                    $elementi = $action->fetchAll();
                    return $elementi;
                }
            }
            catch(PDOException $i){
                echo $i->getMessage();
            }

        }
    }

    function nav_ulogovan(){
        require "config/connection.php";
        $element1 = "Home";
        $element2 = "Log out";
        $element3 = "Author";
        if($conn){
            $upit = "SELECT navName as naziv,href as href FROM navigation WHERE navName IN (:element1,:element2,:element3)";
            $action = $conn->prepare($upit);
            $action->bindParam(":element1",$element1);
            $action->bindParam(":element2",$element2);
            $action->bindParam(":element3",$element3);
            try{
                $uspeh = $action->execute();
                if($uspeh){
                    $elementi = $action->fetchAll();
                    return $elementi;
                }
            }
            catch(PDOException $i){
                echo $i->getMessage();
            }

        }
    }


?>