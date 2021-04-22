<?php
    include_once "configuration.php";
    try{
        $dsn = "mysql:host=".SERVER.";dbname=".DBNAME;
        $password = PASSWORD;
        $username = USERNAME;
        @ $conn = new PDO($dsn,$username,$password);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $msg){
        $msg->getMessage();
        echo $msg;
    }
?>