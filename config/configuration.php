<?php
    // Definisanje apsolutne putanje
    define("ABSOLUTE_PATH",$_SERVER['DOCUMENT_ROOT']);

    // Definisanje fajlova
    define("ENV_FILE",ABSOLUTE_PATH."/config/.env");
    
    @ define("DBNAME",env("DBNAME"));
    @ define("SERVER",env("SERVER"));
    @ define("USERNAME",env("USERNAME"));
    @ define("PASSWORD",env("PASSWORD"));

    function env($naziv){
        $vrednost = "";
        $otvaranje = fopen(ENV_FILE,"r");
        $podaci = file(ENV_FILE);
    
        foreach($podaci as $key=>$value){
            $konfig = explode('=',$value);
            if($konfig[0] == $naziv){
                $vrednost = trim($konfig[1]);
            }
        }
        return $vrednost;
    }
?>