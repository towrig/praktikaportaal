<?php

// Load config.php
$CFG = new stdClass();
// Two level deep
$CFG->docroot = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR;
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

function sendMail(){
    
}

//Mail to praktika.ut.ee to notify that a participant has registered to a project
function sendNotificationMail($target, $data){ //add $target
	$form_success = true;
	$to = 'praktika@ut.ee'; //replace with $target
	$from = 'noreply@praktika.ut.ee';
	$subject = 'Registreerimine projekti '.$data;
	$message = 'Keegi registreeris projekti '.$data.'.';

	//add additional headers if required (X-Mailer etc.)
	$headers = "From: ".$from."\r\n";
	$headers .= "Content-type: text/html; charset=utf-8"."\r\n";
	mail($to, $subject, $message, $headers) || print_r(error_get_last());
	
}

//Mail to participant (accepted/not accepted)
function sendMail($target, $data, $is_accepted){ //add $target
	$form_success = true;
	$from = 'noreply@praktika.ut.ee';
	$subject = 'Registreerimine projekti';
	$message = 'Tervitus!';
	if($is_accepted){
		$message .= 'Teie registreerimine projekti on kinnitatud!';
	}else{
		$message .= 'Tere!\r\n\r\nTeie liitumine projektiga “Projekti pealkiri” on heaks kiidetud. ÕISi lisatakse projektipraktika automaatselt projekti lõpuseminari ajaks.\r\n\r\nHeade soovidega\r\npraktika.ut.ee';
	}
    $message = wordwrap($message, 70, "\r\n");
	//add additional headers if required (X-Mailer etc.)
	$headers = "From: ".$from."\r\n";
	$headers .= "Content-type: text/html; charset=utf-8"."\r\n";
	mail($target, $subject, $message, $headers) || print_r(error_get_last());
	
}
//runs when participant registers to project
if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["hash"]){
	$response = "";
	$name = $_POST["fullname"];
	$email = $_POST["email"];
	$degree = $_POST["degree"];
	$skills = $_POST["skills"];
	$hash = $_POST["hash"];
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		http_response_code(403);
		echo "Tekkis viga! Vea kirjeldus: ".$e->getMessage();
		return 0;
	}
	try {
		$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = $conn->prepare('INSERT INTO ProjectParticipants(project_id, name, email, degree, skills, has_profile, is_accepted) VALUES (?,?,?,?,?,0,0)'); 
		$query->execute(array($hash, $name, $email, $degree, $skills));
		$conn = null;
		sendNotificationMail("praktika@ut.ee", $hash);
		http_response_code(200);
		echo response.";hash:".$hash;
	}catch (PDOException $e){
		http_response_code(403);
		echo "Tekkis viga! Vea kirjeldus: ".$e->getMessage();
	}

}
//runs when a project is posted
else if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["project_title"]){ 
	$response = "";
	$title = $_POST["project_title"];
    $max_part = intval($_POST["max_part"]);
	$org_name = $_POST["project_org_name"];
	$org_email = $_POST["project_org_email"];
	$pdf = $_FILES["project_pdf"];
	$pdf_path = "";

	$editkey = md5(time().$title);

	if (isset($pdf) && $pdf['error'] === UPLOAD_ERR_OK){
		$fileName = $pdf['name'];
		$fileNameCmps = explode(".", $fileName);
		$fileExtension = strtolower(end($fileNameCmps));
		$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
		$allowedfileExtensions = array('pdf');
		if (in_array($fileExtension, $allowedfileExtensions)){ //later mby $_FILES['uploadedFile']['size'] < 4000 or sth...
			
			$dest_path = '../../userdata/projects/'.$newFileName;
			if(move_uploaded_file($pdf['tmp_name'], $dest_path)){
			  $pdf_path = $newFileName;
			  $response .= "pdf-uploaded: true;";
			}else{
			  $response .= "pdf-uploaded: false;";
			}
			
		}
	}else{
		http_response_code(403);
		echo "Faili üleslaadimisel tekkis viga!";
		return 0;
	}

	try {
		$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = $conn->prepare('INSERT INTO ProjectPosts(start_date, pdf_path, title, org_email, org_name, isactivated, edit_key, max_part) VALUES (NOW(),?,?,?,?,?,?,?)'); 
		$query->execute(array($pdf_path, $title, $org_email, $org_name, 0, $editkey, $max_part));
		$conn = null;
		http_response_code(200);
		echo $response;
	}catch (PDOException $e){
		http_response_code(403);
		echo "Tekkis viga! Vea kirjeldus: ".$e->getMessage();
	}

}
//runs when participant approved or not approved
else if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["edit_key"]){ 
	$response="Edit_key:".$_POST["edit_key"].";";
	try {
		$project_id = "";
		$project_name = '';
		$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = $conn->prepare('SELECT * FROM ProjectPosts WHERE edit_key = ?'); 
		$query->execute(array($_POST["edit_key"]));
		$data = $query -> fetchAll();
		foreach ($data as $row) {
			$project_id = $row["id"];
			$project_name .= $row["title"];
		}
		$conn = null;
		$response .= "ID:".$project_id;
		if(isset($project_id)){
			$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if($_POST["action"] == "approve"){
				$query = $conn->prepare('UPDATE ProjectParticipants SET is_accepted = 1 WHERE email = ? AND project_id = ?'); 
				$query->execute(array($_POST["email"], $project_id));
				$conn = null;
                sendMail($_POST["email"], $project_name, true);
				http_response_code(200);
				echo "OK! Reponse:".$response;
			}else{
				$query = $conn->prepare('DELETE FROM ProjectParticipants WHERE email = ? AND project_id = ?'); 
				$query->execute(array($_POST["email"], $project_id));
				$conn = null;
                sendMail($_POST["email"], $project_name, false);
				http_response_code(200);
				echo "OK! Reponse:".$response;
			}
		}
	}catch (PDOException $e){
		http_response_code(403);
		echo "Tekkis viga! Vea kirjeldus: ".$e->getMessage();
	}
}
//something has gone terribly wrong
else{
	http_response_code(403);
	echo "Tekkis viga! Proovige uuesti.";
}


?>