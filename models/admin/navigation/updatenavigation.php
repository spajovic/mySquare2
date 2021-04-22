<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['stiglo'])){
            $id = $_POST['id'];
            $value = $_POST['value'];
            $href = $_POST['href'];
            //regexi
            $href_provera = "/^[a-zA-Z0-9.\/?&=]{6,99}$/";
            $greske = [];
            if(!preg_match($href_provera,$href)){
                    $greske[] = "href is invalid";
            }
            if(count($greske)){
                foreach($greske as $gres){
                    echo $gres;
                }
            }
            else{
                require "../../../config/connection.php";
                if($conn){
                    $query = "UPDATE navigation SET href = :href,navname=:value WHERE navid = :id";
                    $action = $conn->prepare($query);
                    $action->bindParam(":id",$id);
                    $action->bindParam(":href",$href);
                    $action->bindParam(":value",$value);
                    try {
                        $uspeh = $action->execute();
                        if($uspeh){
                            echo "Successfully updated";
                            http_response_code(202);
                        }
                        else{
                            http_response_code(400);
                        }
                    } catch (PDOException $th) {
                        echo $th->getMessage();
                    }

                }
            }
        }
        else{
        header("Location:../../../index.php");

        }

    }
    else{
        header("Location:../../../index.php");
    }




?>