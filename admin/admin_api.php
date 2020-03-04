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

function notifyProjectPoster($to, $heading){
	$from = 'noreply@praktika.ut.ee';
    $subject = 'Praktikaportaali projekt';
    $message = 'Tere!<br><br>Teie projekt “'.$heading.'” on heaks kiidetud. Vaata kindlasti projektipraktika ajakava <a href="https://docs.google.com/document/d/e/2PACX-1vT7B16RNai2EJQrSf8PDTHWFiGHwrQB_MF1jhhZwo61Ox9HWJDBlL_IEFBOkHnNzvczU7R1jAy1xOc4/pub?embedded=true">siit</a>.<br><br>Heade soovidega<br>praktika.ut.ee';
    $headers = "From: ".$from."\r\n";
	$headers .= "Content-type: text/html; charset=utf-8"."\r\n";
    mail($to, $subject, $message, $headers) || print_r(error_get_last());
}

$response = "";
if(!empty($_POST) && $_POST["edit_key"] && $_POST["activateProject"]){
    $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser , $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->prepare('UPDATE ProjectPosts SET isactivated = ? WHERE edit_key = ?');
    $query->execute(array(1, $_POST["edit_key"]));
    
    notifyProjectPoster($_POST["email"],$_POST["title"]);
    
    http_response_code(200);
    echo $response;
}
else if(!empty($_POST) && $_POST["edit_key"]){
    $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser , $dbpassword);
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
}
else if(!empty($_POST) && $_POST["edit_text_id"]){
    
}
//archiving posts logic
else if(!empty($_POST) && $_POST["archiving"] == 1){
    
    $name = $_POST["project-name"];
    $goal = $_POST["project-goal"];
    $actions = $_POST["project-actions"];
    $results = $_POST["project-results"];
    $postId = $_POST["project-id"];
    
    try {
        $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser , $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare('INSERT INTO ArchivedProjects(name,goal,actions,results,postId) VALUES(?,?,?,?,?);');
        $query->execute(array($name, $goal, $actions, $results, $postId));
        $query = $conn->prepare('DELETE FROM ProjectPosts WHERE id = ?;');
        $query->execute(array($postId));
        http_response_code(200);
        echo $response."OK!";
        $conn = null;
        
    }
    catch(PDOException $e){
        http_response_code(403);
        echo "Connection failed: " . $e->getMessage();
    }
    
}
//updating registration opening info
else if (!empty($_POST) && $_POST["reg_update"] == 1){
    
    $reg_start = date("Y-m-d h:i:s",strtotime($_POST["reg_start"]));
    $reg_end = date("Y-m-d h:i:s",strtotime($_POST["reg_end"]));
    $postId = $_POST["post_id"];
    
    try {
        $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser , $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare('UPDATE ProjectPosts SET reg_start = ?, reg_end = ? WHERE id = ?');
        $query->execute(array($reg_start, $reg_end, $postId));
        http_response_code(200);
        echo $response."OK!";
        $conn = null;
    }
    catch(PDOException $e){
        http_response_code(403);
        echo "Connection failed: " . $e->getMessage();
    }
    
    
}
else{
    http_response_code(403);
    echo "Vigane päring!";
}
?>
