<?php
    function getComments(){
        require "config/connection.php";
        if($conn){
            $querykom = "SELECT r.comment as komentar,r.reviewid as id,u.name as ime,u.surname as prezime, u.email as mail,u.username as imence, t.rolename as uloga FROM review r INNER JOIN user u ON r.userId=u.UserId INNER JOIN role t ON u.roleId=t.RoleId";
            try{
                $komentari = $conn->query($querykom)->fetchAll();
                return $komentari;
            }
            catch(PDOException $err){
                echo($err);
            }
        }
    }
?>