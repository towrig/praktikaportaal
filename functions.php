<?php

//language needs to be handled differently, this is temporary
$_SESSION["lang"] = "ee";


/*
*   Fetches stuff based on $arr.
*/
function t($arr, $dbhost, $dbname, $dbuser, $dbpassword)
{
    $q_string = "?"; // Initialize querystring as ?
    $return_arr = array(); // Initialize the return array
    for ($i = 1; $i < $arr . length; $i++) { // Iterate over the parameter $arr
        $q_string .= ",?"; // Adds .? to query string for each pass of iteration
    }
    echo $q_string;
    try {
        $conn = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname . ';charset=utf8', $dbuser, $dbpassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare('SELECT * FROM PageContent WHERE language = ? AND tag IN (' . $q_string . ')');
        echo $query;
        $query->execute(array_merge(array($_SESSION["lang"]), $arr));
        echo $query;
        $data = $query->fetchAll();
        echo $data;
        foreach ($data as $row) {
            echo $row;
            $key = array_search($row["tag"], $arr);
            echo $key;
            echo $arr[$key];
            echo $row["content"];
            $return_arr[$arr[$key]] = $row["content"];
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $return_arr;
}

?>
