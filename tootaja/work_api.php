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

//sends post activation email
function sendMail($key, $target, $heading){ //add $target
	$form_success = true;
	$from = 'admin@praktika.ut.ee';

	$subject = 'Valideerimislink: '.$heading;
    $message = 'Tere!<br><br>Olete lisanud TÜ praktika keskkonda pakkumise “'.$heading.'”. Palun kinnitage pakkumise lisamine vajutades <a href="http://praktika.ut.ee/validator?key='.$key.'&action=add&t=1">kliki siia!</a>. Pärast kinnitamist läheb pakkumine kodulehele üles.<br><br>Heade soovidega<br>praktika.ut.ee';

	//add additional headers if required (X-Mailer etc.)
	$headers = "From: ".$from."\r\n";
	$headers .= "Content-type: text/html; charset=utf-8"."\r\n";
	return mail($target, $subject, $message, $headers);
}
$response = "";
if(!empty($_POST) && $_POST["action"] == "addpost"){
	
	//general
	$heading = $_POST["heading"];
	$description = $_POST["description"];
	$tasks = $_POST["tasks"];
	$skills = $_POST["skills"];
	$other = $_POST["other"];
    
    //org specific
    $work_name = $_POST["organization"];
    $location = $_POST["location"];
    $work_desc = $_POST["work_desc"];
    $website = $_POST["website"];
	
    //poster specific
	$email = $_POST["email"];
	$name = $_POST["name"];
	$phone = $_POST["phone"];
    
    //other
	$checkpoint = ($_POST["checkpoint"] == null ? false : true);
	$logo = $_FILES["logo"];
    $end_date = $_POST["date"];
	
	$passedValidation = true;
	
	//basic ones
	if(!isset($checkpoint) || empty($heading) || empty($description) || empty($tasks) || empty($skills) || empty($work_name) || empty($work_desc)
		|| empty($location) || empty($website) || empty($name) || empty($phone)){
		$passedValidation = false;
	}
	
	//email
	if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
		$passedValidation = false;
        $response .= "Invalid e-mail!";
	}
    
    //parse end_date
    if(!empty($end_date)){
        $dt = explode('-',$end_date);
        $converted = $dt[1].'-'.$dt[0].'-'.$dt[2];
        $end_date = date("Y-m-d h:i:s",strtotime($converted));
    }else{
        $passedValidation = false;
        $response .= "Invalid end_date!";
    }
	
	//paths to be used later
	$logoPath = null;
    $logo_success = true;
	
	//files
	if($passedValidation){
		if(!empty($logo)){
			
			if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK){
				$fileName = $_FILES['logo']['name'];
				$fileNameCmps = explode(".", $fileName);
				$fileExtension = strtolower(end($fileNameCmps));
				$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
				$allowedfileExtensions = array('jpg', 'png');
				if (in_array($fileExtension, $allowedfileExtensions)){ //later mby $_FILES['uploadedFile']['size'] < 4000 or sth...
					
					$dest_path = '../userdata/pictures/'.$newFileName;
					
					if(move_uploaded_file($_FILES['logo']['tmp_name'], $dest_path)){
					  $logoPath = $newFileName;
					}else{
                      $logo_success = false;
                    }
				
				}
			}
		}
        else{
            $passedValidation = false;
            $response .= "No logo!";
        }
	}
	
	//after validation, log into database and send data
	if($passedValidation && $logo_success){
		
		//cryptographically secure key
		$validationcode = bin2hex(random_bytes(16));

		try {
			$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected to PDO successfully"; 
			$query = $conn->prepare('INSERT INTO WorkPosts(name,email,phone,heading,description,tasks,experience,work_name,work_location,work_description,work_website,other,logopath,validationcode,datetime_uploaded,end_date)
			VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?, NOW(),?);');
			$query->execute(array($name, $email, $phone, $heading, $description, $tasks, $skills, $work_name, $location, $work_desc, $website, $other, $logoPath, $validationcode, $end_date));
			$success = sendMail($validationcode, $email, $heading);
            if($success){
                http_response_code(200);
                echo $response."OK!";
            }else{
                http_response_code(403);
                echo "Tekkis viga kirja saatmisel! Info:".print_r(error_get_last());   
            }
		}
		catch(PDOException $e){
			$error_code = $e->getCode();
			if($error_code == "23000"){
                http_response_code(403);
				echo "E-mail like this exists already!";
			}else{
                http_response_code(403);
				echo "Connection failed: " . $e->getMessage();
			}
		}
		
	}
    else{
        if(!$logo_success)
            $response .= "Logo upload failed!";
        http_response_code(403);
        echo $response; 
    }
	
}
else if(!empty($_POST) && $_POST["action"] == "viewadd"){ //increase the amount of views a post has
    http_response_code(403);
    echo "Pole implementeeritud!";
}

?>