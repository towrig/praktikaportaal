<?php
    
    $CFG = new stdClass();
    $CFG->docroot = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
    if (!is_readable($CFG->docroot . 'config.php')) {
        // If it is not readable then exit.
        exit;
    }
    require($CFG->docroot . 'config.php');
    $CFG = (object)array_merge((array)$cfg, (array)$CFG);
    $wwwroot = $CFG->wwwroot;

    $dbhost = $CFG->dbhost;
    $dbname = $CFG->dbname;
    $dbuser = $CFG->dbuser;
    $dbpassword = $CFG->dbpasswd;

    function returnContent($tag, $language){
        $returntext = "";
        $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare('SELECT * FROM PageContent WHERE location_tag = ? AND language = ?');
        $query->execute(array($tag, $language));
        $data = $query -> fetchAll();
        foreach($data as $row){
            $returntext .= $row["content"];
            break;
        }
        return $returntext;
    }



?>