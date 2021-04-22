<?php
    function all_pages(){
        return 
            ['author','building','login','register','question'];
    }

    function pristupStranama_procenat(){
        $niz = [];
        $author = 0;
        $sum = 0;
        $home = 0;
        $building = 0;
        $login = 0;
        $register = 0;
        $question = 0;
        $day = strtotime("1 day ago");
        define("LOG_FILE1",ABSOLUTE_PATH."/data/log.txt");

        @$log = file(LOG_FILE1);
        if(count($log)){
            foreach($log as $item){
                $part = explode("\t",$item);
                $url = explode(".php",$part[0]);
                if(strpos($url[1],'&')){
                    $strana = explode("&",$url[1])[0];
                    $strana = explode("=",$strana);
                    $strana = $strana[1];

                }
                else{
                    $strana = $url[1];
                    if(!$strana == ''){
                        $strana = explode("=",$strana)[1];
                    }
                }
                @$time = strtotime($part[1]);
                if(@$time >= $day){
                    switch($strana){
                        case "" :
                            $home++;
                            $sum++;
                        break;
                        case "author":
                            $author++;
                            $sum++;
                        break;
                        case "building":
                            $building++;
                            $sum++;
                        case "login":
                            $login++;
                            $sum++;
                        break;
                        case "register":
                            $register++;
                            $sum++;
                        break;
                        case "question":
                            $question++;
                            $sum++;
                        break;
                    }
                }
            }
            if($sum > 0){
                $niz['author'] = round($author*100/$sum,2);
                $niz['home'] = round($home*100/$sum,2);
                $niz['login'] = round($login*100/$sum,2);
                $niz['register'] = round($register*100/$sum,2);
                $niz['question'] = round($question*100/$sum,2);
                $niz['building'] = round($building*100/$sum,2);
            }
        }
        return $niz;
    }
?>