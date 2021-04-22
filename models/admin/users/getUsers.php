<?php
    function getUsers(){
        require "config/connection.php";
        if($conn){
            $korisnici = "SELECT u.userid as idu,u.name as name,u.surname as surname, u.email as mail,u.username as userime, t.rolename as uloga1 FROM user u INNER JOIN role t ON u.roleId=t.RoleId WHERE t.rolename = 'user'";
            try{
                $users = $conn->query($korisnici)->fetchAll();
                return $users;
            }
            catch(PDOException $porukica){
                echo $porukica->getMessage();
            }
        }
    }
    function getAdmins(){
        require "config/connection.php";
        if($conn){
            $korisnici = "SELECT u.userid as idu,u.name as name,u.surname as surname, u.email as mail,u.username as userime, t.rolename as uloga1 FROM user u INNER JOIN role t ON u.roleId=t.RoleId WHERE t.rolename = 'admin'";
            try{
                $users = $conn->query($korisnici)->fetchAll();
                return $users;
            }
            catch(PDOException $porukica){
                echo $porukica->getMessage();
            }
        }
    }
?>