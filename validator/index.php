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
		$heading = "Tehtud";
		$paragraph = "Postitus aktiveeritud";
	}
	catch(PDOException $e){
		$paragraph = "Ühendus ebaõnnestus: " . $e->getMessage();
		$heading = "Ups!";
	}

?>
<!DOCTYPE html>
<html lang="en">
<?php $title="Postitus aktiveeritud!"; $description=""; include_once './../templates/header.php';?>
<body id="validated" class="validated">
    <?php include_once './../templates/top-navbar.php';?>
    <div id="main"></div>
    <header id="masthead" class="masthead d-flex flex-wrap">
      <div id="page-content" class="container">
        <section class="page-section">
          <div class="bg-container">
            <div class="img-cont"></div>
          </div>
          <div class="container">
            <div class="row text-uppercase">
              <div class="col-lg-3 col-md-12">
                <h2 class="mb-5"><span><?php echo $heading; ?></span><br><?php echo $paragraph; ?></h2>
              </div>
              <!-- .col-->
            </div> <!-- .row -->
          </div> <!-- .container -->
        </section>
      </div>
    </header>
  <!-- Footer -->
  <?php include_once './../templates/footer.php';?>
</body>
</html>
