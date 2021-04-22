<?php
    function pristup_strani(){
        define("LOG_FILE",ABSOLUTE_PATH."/data/log.txt");
        $putanja = LOG_FILE;
        @ $open = fopen($putanja,"a");
        if($open){
            $uri = $_SERVER['REQUEST_URI'];
            $date = date('d-m-Y H:i:s');
            $adresa = $_SERVER['REMOTE_ADDR'];
            @fwrite($open,"$uri\t$date\t$adresa\t\n");
            @fclose($open);
        }
    }
?>


