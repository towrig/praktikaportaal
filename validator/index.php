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
	
	$validationcode = $_GET["key"];
	$action = $_GET["action"];
	$table = $_GET["t"]; //0 for People, 1 for WorkPosts
	$heading = "";
	$paragraph = "";
	
	try {
		$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if($action == "add"){
			if($table == 0){
				$query = $conn->prepare('UPDATE People SET isvalidated = true WHERE validationcode = ?');
			}else{
				$query = $conn->prepare('UPDATE WorkPosts SET isvalidated = true WHERE validationcode = ?');
			}
			
		} else if($action == "remove"){
			if($table == 0){
				$query = $conn->prepare('SELECT cvpath, picturepath FROM People WHERE validationcode = ?');
				$query->execute(array($validationcode));
				$data = $query -> fetchAll();
				foreach($data as $row){
					unlink("../userdata/cvs/".$row["cvpath"]);
					unlink("../userdata/pictures/".$row["picturepath"]);
				}
				$query = $conn->prepare('DELETE FROM People WHERE validationcode = ?');
				
			}else{
				$query = $conn->prepare('SELECT logopath, picturepath FROM WorkPosts WHERE validationcode = ?');
				$query->execute(array($validationcode));
				$data = $query -> fetchAll();
				foreach($data as $row){
					unlink("../userdata/pictures/".$row["logopath"]);
					unlink("../userdata/pictures/".$row["picturepath"]);
				}
				$query = $conn->prepare('DELETE FROM WorkPosts WHERE validationcode = ?');
			}
		}
		$res = $query->execute(array($validationcode));
		$heading = "Tehtud!";
		$paragraph = "Sinu postitus on nüüd aktiveeritud!";
	}
	catch(PDOException $e){
		$paragraph = "Ühendus ebaõnnestus: " . $e->getMessage();
		$heading = "Ups!";
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
    <!--<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../css/creative.min.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../css/custom.css?v=2" rel="stylesheet">

</head>
<body>

	<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="../">Praktikavahenduste keskkond</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#about">Kuidas valida?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#services">Kuidas areneda?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#portfolio">Miks ...?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#contact">Kontakt</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
	
	<div id="page-content">
		
		<section class="page-section bg-primary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <hr class="divider light my-4">
                    <h2><?php echo $heading; ?></h2>
                    <p><?php echo $paragraph; ?></p>
                    <hr class="divider light my-4">

                </div> <!-- .col-->
                
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section>

	</div>

	
</body>
</html>