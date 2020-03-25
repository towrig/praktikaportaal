<?php

    $_SESSION["lang"] = "ee";

    /*
    *   Fetches the fields specified in $arr from the database
    */
    function t($arr){
        $q_string = "?";
        $return_arr = array();
        for($i = 1; $i < $arr.length; $i++){
            $q_string .= ",?";
        }
        try {
            $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser , $dbpassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $conn->prepare('SELECT * FROM PageContent WHERE language = ? AND tag IN ('.$q_string.')');
            $query->execute(array_merge(array($_SESSION["lang"]),$arr));
            $data = $query -> fetchAll();
            foreach($data as $row){
                $key = array_search($row["tag"], $array);
                $return_arr[$key] = $row["content"];
            }
        } catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
        return $return_arr;
    }

?>
