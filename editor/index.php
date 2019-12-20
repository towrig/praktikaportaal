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
function sendMail($key, $target, $heading, $action){ //add $target
	$form_success = true;
	$from = 'admin@praktika.ut.ee';

	$subject = 'Valideerimislink: '.$heading;
    $message = 'Tere!<br><br>Olete lisanud TÜ praktika keskkonda pakkumise “'.$heading.'”. Palun kinnitage pakkumise lisamine vajutades <a href="http://praktika.ut.ee/validator?key='.$key.'&action=add&t=1">kliki siia!</a>. Pärast kinnitamist läheb pakkumine kodulehele üles.<br><br>Heade soovidega<br>praktika.ut.ee';

	//add additional headers if required (X-Mailer etc.)
	$headers = "From: ".$from."\r\n";
	$headers .= "Content-type: text/html; charset=utf-8"."\r\n";
	mail($target, $subject, $message, $headers) || print_r(error_get_last());	
}
function loadHTML($filename){
    $target = fopen($filename, "r") or die("Failed to open file!");
    $html_to_return = fread($target, filesize($filename));
    fclose($target);
    return $html_to_return;
}

//for form validation
$heading = "";
$description = "";
$tasks = "";
$oskused = "";
$pilt = "";
$logo = "";
$work_desc = "";
$location = "";
$type = "";
$other = "";
$website = "";
//contact
$email = "";
$name = "";
$phone = "";
$checkpoint = "";

//for form visuals etc...
$removeing = false;
$email_valid = false;
$pic_success = true;
$logo_success = true;
$form_success = false;

if(!empty($_POST) && $_POST["submit"] == "add"){
	
	//text & simple stuff
	$heading = $_POST["heading"];
	$description = $_POST["description"];
	$tasks = $_POST["tasks"];
	$oskused = $_POST["oskused"];
	$location = $_POST["location"];
	$work_desc = $_POST["work_desc"];
	$type = $_POST["type"];
	$other = $_POST["other"];
	$website = $_POST["website"];
	
	$email = $_POST["email"];
	$name = $_POST["name"];
	$phone = $_POST["phone"];
	$checkpoint = ($_POST["checkpoint"] == null ? false : true);
	
	//harder things to parse
	$pilt = $_FILES["pilt"];
	$logo = $_FILES["logo"];
	
	$passedValidation = true;
	
	//basic ones
	if(!isset($checkpoint) || empty($heading) || empty($description) || empty($tasks) || empty($oskused) 
		|| empty($location) || empty($type) || empty($website) || empty($name) || empty($phone)){
		$passedValidation = false;
	}
	
	//email
	if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
		$passedValidation = false;
	}else{
		$email_valid = true;
	}
	
	//paths to be used later
	$picPath = null;
	$logoPath = null;
	
	//files
	if($passedValidation){
		if(!empty($logo) && !empty($pilt)){
			
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
					}else{
                      $pic_success = false;
                    }
				
				}
			}
			
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
	}
	
	//after validation, log into database and send data
	if($passedValidation){
		
		//cryptographically secure key
		$validationcode = bin2hex(random_bytes(16));

		try {
			$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected to PDO successfully"; 
			$query = $conn->prepare('INSERT INTO WorkPosts(name,email,phone,heading,description,tasks,experience,work_location,work_description,work_type,work_website,other,picturepath,logopath,validationcode,datetime_uploaded) 
			VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, NOW());');
			$query->execute(array($name, $email, $phone, $heading, $description, $tasks, $oskused, $location, $work_desc, $type, $website, $other, $picPath, $logoPath, $validationcode));
			
			sendMail($validationcode, $email, $heading, "add");
			$form_success = True;
		}
		catch(PDOException $e){
			$error_code = $e->getCode();
			if($error_code == "23000"){
				//do something to clarify an email like this exists already.
			}else{
				echo "Connection failed: " . $e->getMessage();
			}
		}
		
	}
	
}else if($_GET["e"]){
	
	$e_key = $_GET["e"];
	$edit_success = false;
	
	try {
		$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected to PDO successfully"; 
		$query = $conn->prepare('SELECT * FROM WorkPosts WHERE validationcode = ?');
		$query->execute(array($e_key));
		$data = $query -> fetchAll();
		foreach($data as $row){
			$heading = $row["heading"];
			$description = $row["description"];
			$tasks = $row["tasks"];
			$oskused = $row["experience"];
			$pilt = $row["picturepath"];
			$logo = $row["logopath"];
			$work_desc = $row["work_description"];
			$location = $row["work_location"];
			$type = $row["work_type"];
			$other = $row["other"];
			$website = $row["work_website"];
			$email = $row["email"];
			$name = $row["name"];
			$phone = $row["phone"];
			break;
		}
		$edit_success = true;
	}
	catch(PDOException $e){
		$error_code = $e->getCode();
		echo "Connection failed (code: $error_code): " . $e->getMessage();
	}
	
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Praktikavahenduste keskkond</title>

    <!-- Font Awesome Icons -->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../css/creative.min.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../css/custom.css" rel="stylesheet">
    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../css/custom-form.css" rel="stylesheet">

    <link rel="stylesheet" href="../js/trumbowyg/ui/trumbowyg.min.css">
    <style>
        .trumbowyg-editor,
        .trumbowyg-box {
            min-height: 100px !important;
        }

    </style>

</head>

<body id="page-top">

    <?php echo loadHTML("../frags/navbar.html"); ?>
  <div id="main"></div>
  <div id="main"></div>
  <div id="main"></div>
  <div id="main"></div>
  <div id="main"></div>
    <!-- work.php -->
    <section>
        <form class="container work" target="_self" method="post" enctype="multipart/form-data">
            <!-- start banner -->
            <div class="row">
                <div class="col-lg-12">
                  <!--
                    <div class="work-banner" id="bannerTag" style="<?php if(!empty($_POST) || $edit_success){ if ($pilt != "") {echo "background-image: url(../userdata/pictures/".$pilt.");";} } ?>"></div>-->
                </div> <!-- image -->
                <div class="col-lg-12 col-md-12">
                    <!--<label for="pilt">Banner*:</label>
                    <input type="file" class="form-control-file <?php if(!empty($_POST)) { if(!$pic_success) { echo "is-invalid"; } } ?>" id="pilt" name="pilt">
                    <div class='invalid-feedback'>Sisesta banner!</div>-->
                </div>

                <div class="col-lg-12 col-md-12 type_container">
                    <!--<label for="type">Kuulutuse tüüp*</label>
                    <select class="form-control" id="type" name="type">
                        <option>Praktika</option>
                        <option>Töökoht</option>
                    </select>-->
                </div>
            </div> <!-- end -->
            <!-- start title-share -->
            <div class="row">
                <div class="col-lg-12 work-title">
                    <h2>
                        <input type="text" class="form-control <?php if(!empty($_POST) || $edit_success) { if($heading == "") { echo "is-invalid"; } } ?>" id="heading" name="heading" <?php if (!empty($_POST) || $edit_success) echo "value='".htmlspecialchars($heading)."'";?> placeholder="Sisesta kuulutuse pealkiri...">
                    </h2>
                </div>
            </div> <!-- end -->
            <!-- start main-content -->
            <div class="row">
                <div class="col-lg-4 work-aside">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 work-aside-place">
                                <h5>Asukoht</h5>
                                <p>
                                    <span><input type="text" class="form-control <?php if(!empty($_POST) || $edit_success) { if($location != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="location" name="location" <?php if (!empty($_POST) || $edit_success) echo "value='".htmlspecialchars($location)."'";?>></span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 work-aside-place">
                                <h5>Kandideerimise tähtaeg*</h5>
                                <input type="text" id="datepicker" name="end_date">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-12 work-aside-logo">
                                <h5>Logo*</h5>
                                <img src="<?php if(!empty($_POST) || $edit_success){ if ($logo != "") {echo "../userdata/pictures/".$logo;} }else {echo "../userdata/blank_profile_pic.png";} ?>" id="logoTag">
                                <input type="file" class="form-control-file <?php if(!empty($_POST) || $edit_success) { if(!$logo_success) { echo "is-invalid"; } } ?>" id="logo" name="logo">
                                <div class='invalid-feedback'>Sisesta Logo!</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 work-aside-intro">
                                <h5>Organisatsiooni tutvustus*</h5>
                                <p>
                                    <textarea class="form-control <?php if(!empty($_POST) || $edit_success) { if($work_desc != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="work_desc" name="work_desc">
									<?php if (!empty($_POST) || $edit_success) echo htmlspecialchars($work_desc);?>
									</textarea>
                                </p>
                                <h5>Veebiaadress:*</h5>
                                <p>
                                    <input type="text" class="form-control <?php if(!empty($_POST) || $edit_success) { if($website != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="website" name="website" <?php if (!empty($_POST) || $edit_success) echo "value='".htmlspecialchars($website)."'";?>>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 work-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 work-content-intro">
                                <h4>Töökoha tutvustus*</h4>
                                <p>
                                    <textarea class="form-control" id="kirjeldus" name="description">
									<?php if (!empty($_POST) || $edit_success){echo htmlspecialchars($description);}?>
									</textarea>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 work-content-tasks">
                                <h4>Tööülesanded:*</h4>
                                <p>
                                    <textarea class="form-control" id="tooulesanded" name="tasks">
									<?php if (!empty($_POST) || $edit_success){echo htmlspecialchars($tasks);}?>
									</textarea>
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 work-content-skills">
                                    <h4>Vajalikud oskused ja kogemused:*</h4>
                                    <p>
                                        <textarea class="form-control" id="oskused" name="oskused">
										<?php if (!empty($_POST) || $edit_success){echo htmlspecialchars($oskused);}?>
										</textarea>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 work-content-sources">
                                    <h4>Muu oluline info:</h4>
                                    <textarea class="form-control" id="other" name="other">
									<?php if (!empty($_POST) || $edit_success){echo htmlspecialchars($other);}?>
									</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end -->
            <!-- start footer -->
            <div class="row">

                <div class="col-lg-4 work-footer-contact">

                    <div class="row" style="overflow: hidden;">
                        <div class="col-lg-12" style="overflow: hidden;">
                            <h5>Kontakt*</h5>
                            <ul style="margin-left:-40px;">
                                <li>
                                    <input type="text" class="form-control <?php if(!empty($_POST) || $edit_success) { if($website != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="name" name="name" <?php if (!empty($_POST) || $edit_success) echo "value='".htmlspecialchars($name)."'";?>>
                                </li>
                                <li><i class="fas fa-envelope"></i>
                                    <input type="email" class="form-control <?php if(!empty($_POST)) { if($email_valid) { echo "is-valid"; }else{ echo "is-invalid"; } }?>" id="email" aria-describedby="emailHelp" name="email" <?php if (!empty($_POST) || $edit_success) echo "value='".htmlspecialchars($email)."'";?>>
                                </li>
                                <li><i class="fas fa-phone"></i>
                                    <input type="text" class="form-control <?php if(!empty($_POST) || $edit_success) { if($phone != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="phone" name="phone" <?php if (!empty($_POST) || $edit_success) echo "value='".htmlspecialchars($phone)."'";?>>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 work-footer-apply">

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input <?php if(!empty($_POST) || $edit_success) { if($checkpoint) { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="checkpoint" name="checkpoint">
                        <label class="custom-control-label" for="checkpoint">*Olen teadlik, et andmeid näidatakse avalikult…</label>
                    </div>

                    <button type="submit" class="btn btn-success btn-xl" name="submit" value="add">Lae mind andmebaasi</button>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="text-align:left; float:right;">
                    <p>JAGA LEHTE <i class="fas fa-share-square fa-1x"> </i></p>
                </div>
            </div>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">Copyright &copy; 2019 - Start Bootstrap</div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template
    <script src="../js/creative.min.js"></script> -->

    <script src="../js/trumbowyg/trumbowyg.min.js"></script>
    <script>
        //$("#datepicker").datepicker();

        var FORM_SUCCESS = <?php echo ($form_success)?"true":"false";?>;
        if (FORM_SUCCESS) {
            $('.type_container').after("<div class='alert alert-success'>Aitäh! Teie emailile tuleb postituse aktiveerimislink!</div>");
        }

        $('#kirjeldus').trumbowyg({
            autogrow: true
        });
        $('#tooulesanded').trumbowyg({
            autogrow: true
        });
        $('#oskused').trumbowyg({
            autogrow: true
        });
        $('#other').trumbowyg({
            autogrow: true
        });
        $('#work_desc').trumbowyg({
            autogrow: true
        });

        function readURL(input, target) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(target).css('background-image', 'url(' + e.target.result + ')');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURL2(input, target) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(target).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#logo").change(function() {
            readURL2(this, "#logoTag");
        });
        $("#pilt").change(function() {
            readURL(this, ".work-banner");
        });
        $("#profile").change(function() {
            readURL2(this, "#profileTag");
        });

        $('.trumbowyg-button-pane').css('display', 'none');
        $('.trumbowyg-box').focusout(function(event) {
            $(this).find('.trumbowyg-button-pane').fadeOut(200);
        });
        $('.trumbowyg-box').focusin(function(event) {
            $(this).find('.trumbowyg-button-pane').fadeIn(200);
        });

    </script>

</body>

</html>
