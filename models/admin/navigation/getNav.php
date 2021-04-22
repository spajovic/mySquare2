<?php
    function getNav(){
        require "config/connection.php";
        if($conn){
            $query = "SELECT navid as id,navname as name,href as href FROM navigation";
            try{
                $items = $conn->query($query)->fetchAll();
                if($items){
                    return $items;
                }
                else{
                    http_response_code(404);
                }
            }
            catch(PDOException $sms){
                echo $sms->getMessage();
            }
        }
    }


?>