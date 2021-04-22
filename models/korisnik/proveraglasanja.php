<?php
    function provera($id){
        require 'config/connection.php';
            if($conn){
                // Da li je user vec glasao
                $kveri = "SELECT userid FROM votes WHERE userid = :id ";
                $provera = $conn->prepare($kveri);
                $provera->bindParam(":id",$id);
                try{
                    $uspeh1 = $provera->execute();
                    if($uspeh1 && $provera->rowCount() > 0){
                        return 1;
                    }
                    else{
                        return 0;
                    }
                }
                catch(PDOException $nesto){
                    echo $nesto;
                }
            }
    }
?>