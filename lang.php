<?php
    session_start();
    if(!empty($_POST) && !empty($_POST["lang"])){
        $p_lang = $_SESSION["lang"];
        if($_SESSION["lang"] == "ee"){
            $_SESSION["lang"] = "eng";
        }else{
            $_SESSION["lang"] = "ee";
        }
        http_response_code(200);
        echo "OK!prev lang:".$p_lang.";new lang:".$_SESSION["lang"];
    }else{
        http_response_code(403);
        echo "Bad request!";
    }

?>
