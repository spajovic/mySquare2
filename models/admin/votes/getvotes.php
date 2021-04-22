<?php
    function getResults(){
        require "config/connection.php";
        if($conn){
            $queryVote = "SELECT COUNT(voteid) as broj,ROUND(AVG(result),2) as prosek FROM votes";
            try{
                $rezultatVotes = $conn->query($queryVote)->fetch();
                return $rezultatVotes;
            }
            catch(PDOException $mms){
                echo $mms->getMessage();
            }
        }
    }
?>