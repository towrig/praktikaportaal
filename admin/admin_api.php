<?php 
$response = "";

if(!empty($_POST)){
    $conn = new PDO('mysql:host=localhost;dbname=userdata', 'root', 'Kilud123');
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
}else{
    http_response_code(403);
    echo "Vigane päring!";
}
?>