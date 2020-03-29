<?php

    if(!empty($_POST) && !empty($_POST["lang"])){
        if($_POST["lang"] == "ee"){
            $_SESSION["lang"] = "eng";
        }else{
            $_SESSION["lang"] = "ee";
        }
        http_response_code(200);
        echo "OK!";
    }else{
        http_response_code(403);
        echo "Bad request!";
    }

?>
