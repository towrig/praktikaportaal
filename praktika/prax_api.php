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

//error reporting for testing
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

//sends both removal and activation emails.
function sendMail($key, $target, $action){ //add $target
	$form_success = true;
	$to = $target; //replace with $target
	$from = 'admin@praktika.ut.ee';
	if($action == "remove"){
		$subject = 'Eemaldamislink';
		$message = 'Vajuta sellele lingile et eemaldada oma postitus praktikaportaalis: <a href="http://praktika.ut.ee/validator?key='.$key.'&action=remove&t=0">kliki siia!</a>';
	}else{
		$subject = 'Valideerimislink';
		$message = 'Vajuta sellele lingile et aktiveerida oma postitus praktikaportaalis: <a href="http://praktika.ut.ee/validator?key='.$key.'&action=add&t=0">kliki siia!</a>';
	}
	//add additional headers if required (X-Mailer etc.)
	$headers = "From: ".$from."\r\n";
	$headers .= "Content-type: text/html; charset=utf-8"."\r\n";
	mail($to, $subject, $message, $headers) || print_r(error_get_last());
	
}

$removeing = false;
$email_valid = false;
$pic_success = false;
$cv_success = false;
$form_success = false;
$response = "";

if(!empty($_POST) && $_POST["action"] == "add"){
	
	//text & simple stuff
	$name = $_POST["name"];
	$email = $_POST["email"];
	$institute = $_POST["institute"];
	$major = $_POST["major"];
	$oskused = $_POST["oskused"];
	$kogemused = $_POST["kogemused"];
	$work = $_POST["work"];
	$location = $_POST["location"];
	$checkpoint = ($_POST["checkpoint"] == null ? false : true);
	
	//harder things to parse
	$pilt = $_FILES["pilt"];
	$cv = $_FILES["cv"];
	
	//start validating the form (name, oppekava, pilt, cv, töö, asukoht, email, checked)
	$passedValidation = true;
	
	$response .= "Testing for validation...";
	//basic ones
	if((!isset($checkpoint) && $checkpoint) || empty($name) || empty($major) || empty($institute) || empty($work) || empty($oskused)){
		$passedValidation = false;
		$response .= "Failed!";
	}
	
	//email
	if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
		$passedValidation = false;
	}else{
		$email_valid = true;
	}
	$response .= "Pased: ";
	$response .= $passedValidation ? 'true' : 'false';
	
	//paths to be used later
	$picPath = null;
	$cvPath = null;
	
	//files
	if($passedValidation){
		if(!empty($cv) || !empty($pilt)){
			
			//pilt
			if (isset($_FILES['pilt']) && $_FILES['pilt']['error'] === UPLOAD_ERR_OK){
				$fileName = $_FILES['pilt']['name'];
				$fileNameCmps = explode(".", $fileName);
				$fileExtension = strtolower(end($fileNameCmps));
				$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
				$allowedfileExtensions = array('jpg', 'png');
				if (in_array($fileExtension, $allowedfileExtensions)){ //later mby $_FILES['uploadedFile']['size'] < 4000 or sth...
					
					$dest_path = '../userdata/pictures/'.$newFileName;
					
					if(move_uploaded_file($_FILES['pilt']['tmp_name'], $dest_path)){
					  $picPath = $newFileName;
					  $pic_success = true;
					}else{
					  $passedValidation = false;
					}
				
				}
			}
			
			//cv
			if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK){
				$fileName = $_FILES['cv']['name'];
				$fileNameCmps = explode(".", $fileName);
				$fileExtension = strtolower(end($fileNameCmps));
				$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
				$allowedfileExtensions = array('doc','docx','txt','pdf', 'odf');
				if (in_array($fileExtension, $allowedfileExtensions)){ //later mby $_FILES['uploadedFile']['size'] < 4000 or sth...
					
					$dest_path = '../userdata/cvs/'.$newFileName;
					
					if(move_uploaded_file($_FILES['cv']['tmp_name'], $dest_path)){
					  $cvPath = $newFileName;
					  $cv_success = true;
					}else{
					  $passedValidation = false;
					}
				
				}
			}
		}
	}

	//after validation, log into database and send data
	if($passedValidation){
		
		//cryptographically secure key
		$validationcode = bin2hex(random_bytes(16));
		$response .= "generated key...";
		try {
			$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected to PDO successfully"; 
			$query = $conn->prepare('INSERT INTO People(name, email, skills, experience, institute, major, work, location, picturepath, cvpath, validationcode, datetime_uploaded) VALUES(?,?,?,?,?,?,?,?,?,?,?,NOW())');
			$query->execute(array($name, $email, $oskused, $kogemused, $institute, $major, $work , $location, $picPath, $cvPath, $validationcode));
			
			//echo "sending validation email...";
			sendMail($validationcode, $email, "add");
			http_response_code(200);
			$response .= "OK!";
			echo $response;
		}catch(PDOException $e){
			$error_code = $e->getCode();
			if($error_code == "23000"){
				http_response_code(403);
				echo "Tekkis viga! Vea kirjeldus: Sellise emailiga postitus juba eksisteerib!";
			}else{
				http_response_code(403);
				echo "Tekkis viga! Vea kirjeldus: ".$e->getMessage();
			}
		}
		
	}else{
		http_response_code(403);
		echo "Tekkis viga! Vea kirjeldus: ".$response;
	}
	
}else if(!empty($_POST) && $_POST["action"] == "remove"){
	
	$removeing = true;
	$email = $_POST["email"];
	
	if(!empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL)){
		$email_valid = true;
	}
	
	if($email_valid){
		try {
			$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected to PDO successfully"; 
			$query = $conn->prepare('SELECT validationcode FROM People WHERE email = ?');
			$query->execute(array($email));
			
			$validationcode = "";
			$data = $query -> fetchAll();
			foreach($data as $row){
				$validationcode = $row["validationcode"];
			}
			
			//echo "sending validation email...";
			if($validationcode != ""){
				sendMail($validationcode, $email, "remove");
			}else{
				echo "No such entry.";
			}
		}
		catch(PDOException $e){
			$error_code = $e->getCode();
			echo "Connection failed (code: $error_code): " . $e->getMessage();
		}
	}
	
}


?>