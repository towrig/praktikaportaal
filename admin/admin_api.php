<?php 
// Load config.php
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

$response = "";

if(!empty($_POST) && $_POST["edit_key"]){
    $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->prepare('SELECT * FROM editkeys WHERE keyname = ?');
    $query->execute(array($_POST["edit_key"]));
    $data = $query -> fetchAll();
	foreach($data as $row){
        $response .= $row["hashCode"];
        break;
    }
    
    http_response_code(200);
    echo $response;
}else if(!empty($_POST) && $_POST["edit_text_id"]){
    
}else{
    http_response_code(403);
    echo "Vigane päring!";
}
?>