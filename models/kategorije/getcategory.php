<?php
    if($_POST['uspelo']){
        require_once "../../config/connection.php";
        header("Content-Type: application/json");
        if($conn){
            $query = "SELECT categoryId,categoryName FROM category";
            try{
                $kategorije = $conn->query($query)->fetchAll();
                echo json_encode($kategorije);
            }
            catch(PDOException $mssg){
                echo $mssg;
            }
        }
    }
    else{
        header("Location:../../index.php");
    }
?>