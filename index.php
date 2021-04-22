<?php
    require_once "config/connection.php";
    if($conn){
        include "views/fixed/head.php";
        include "views/fixed/nav.php";

        if(!isset($_GET['page'])){
            include "views/flexible/pocetna.php";
        }
        else{
            switch($_GET['page']){
                case "building" :
                    include "views/flexible/building.php";
                break;
                case "register" :
                    include "views/flexible/register.php";
                break;
                case "login" :
                    include "views/flexible/login.php";
                break;
                case "logout" :
                    include "models/korisnik/logout.php";
                break;
                case "question" :
                    include "views/flexible/question.php";
                break;  
                case "author" :
                    include "views/flexible/author.php";
                break;
                break; 
                case "admin" :
                    include "views/flexible/admin.php";
                break;         
                default :
                    include "views/flexible/pocetna.php";
                break;
            }
        }

        include "views/fixed/footer.php";
    }
?>