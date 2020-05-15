<?php

    //sets language if unset
    if(!isset($_SESSION["lang"])){
        $_SESSION["lang"] = "ee";
    }

    if(!isset($_SESSION["admin"])){
        $_SESSION["admin"] = false;
    }

    /*
    *   Fetches stuff based on $arr.
    */
    function create_editmode($key, $content){
        $bigstring = '<div class="admin-info-change">
                        <textarea id="content-'.$key.'">'.$content.'</textarea>
                        <button class="btn btn-sm btn-success admin-change-content" data-key="'.$key.'">Uuenda</button>
                      </div>';
        return $bigstring;
    }
    function t($arr,$dbhost,$dbname,$dbuser,$dbpassword){
        $uneditables = array("fp-mh_h1","fp-mh1.0","fp-mh1.1", "fp-mh1.2","fp-mh2", "fp-mh3", "fp-mh_h2",
                             "fp-mh2.0", "fp-mh2.1", "fp-mh2.2", "fp-mh_h3", "fp-mh_text", "fp-mh_title",
                             "fp-mh3.0", "fp-mh3.1", "fp-mh3.2", "fp-mh4", "fp-mh5",
                             "top-navb1", "top-navb2", "top-navb3");
        $q_string = "?";
        $return_arr = array();
        for($i = 1; $i < count($arr); $i++){
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
                $key = array_search($row["tag"], $arr);
                if($_SESSION["admin"] && !in_array($row["tag"], $uneditables)){
                    $return_arr[$arr[$key]] = create_editmode($row["tag"], $row["content"]);
                }else{
                    $return_arr[$arr[$key]] = $row["content"];
                }
            }
        } catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
        return $return_arr;
    }

?>
