<!DOCTYPE html>
<html lang="en">
    
<?php

$title="Kuulutus"; 
    // Two levels deep
include_once './../../templates/header.php';
    
//public variables
//currently unused cols: name,email,phone,tasks,experience,work_location,work_type,other,logopath,validationcode,heading,description,picturepath

$heading = "";
$description = "";
$tasks = "";
$exp = "";
$pilt = "";
$logo = "";
$work_desc = "";
$work_location = "";
$other = "";
$website = "";
//contact
$email = "";
$name = "";
$phone = "";

try {
	$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query = $conn->prepare('SELECT * FROM WorkPosts WHERE validationcode = ?'); 
	$query->execute(array($_GET["c"]));
	$data = $query -> fetchAll();
	foreach($data as $row){
		
		$heading = $row["heading"];
		$description = $row["description"];
		$tasks = $row["tasks"];
		$exp = $row["experience"];
		$logo = $row["logopath"];
		$pilt = $row["picturepath"];
		$work_desc = $row["work_description"];
		$work_location = $row["work_location"];
		$name = $row["name"];
		$email = $row["email"];
		$phone = $row["phone"];
		$work_type = $row["work_type"];
		$other = $row["other"];
        $website = $row["work_website"];
	}
}catch (PDOException $e){
	echo "Connection failed: " . $e->getMessage();
}

?>
<body id="page-top">

    <?php include_once './../../templates/top-navbar.php';?>

    <!-- work.php -->
    <section>
        <div class="container work" style="margin-top: 20px">
            <!-- start banner -->
            <div class="row">
                <div class="col-lg-4 org-logo-container">
                    <?php 
                        if(!empty($logo)){
                            echo "<img src='../../userdata/pictures/".$logo."' style='border-radius: 50%'>";
                        }else{
                            echo "<img src='../userdata/blank_profile_pic.png' style='border-radius: 50%'>";
                        }
                    ?>
                </div>
                <div class="col-lg-8">
                    <h5>Töökoha asukoht</h5>
                    <p>Töö asub aadressil: <br><?php echo $work_location; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="work-banner" <?php if(!empty($pilt)) echo "style='background-image:url(../../userdata/pictures/".$pilt.")'"?>></div>
                </div>
            </div> <!-- end -->
            <!-- start title-share -->
            <div class="row">
                <div class="col-lg-12 work-title">
                    <h2><?php echo $heading; ?></h2>
                </div>
            </div> <!-- end -->
            <!-- start main-content -->
            <div class="row">
                <div class="col-lg-4 work-aside">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-12">
                                <h2>Kandideeri: saada oma cv ja motivatsioonikiri</h2>
                                <h3>Kontaktisik</h3>
                                <ul style="margin-left:-40px;">
                                    <li><?php echo $name; ?></li>
                                    <li><i class="fas fa-envelope"></i> <?php echo $email; ?></li>
                                    <li><i class="fas fa-phone"></i> <?php echo $phone; ?></li>
                                </ul>
                                <div class="work-share">
                                    <div>
                                        <i class="fas fa-share fa-2x"></i>
                                        <i class="fab fa-facebook-f fa-2x"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 work-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 work-content-intro">
                                <h4>Praktika/tööpakkumise kirjeldus</h4>
                                <p><?php echo $description; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 work-content-tasks">
                                <h4>Tööülesanded:</h4>
                                <?php echo $tasks; ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 work-content-skills">
                                    <h4>Vajalikud oskused/kogemused:</h4>
                                    <?php echo $exp; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 work-content-sources">
                                    <h4>Muu oluline info:</h4>
                                    <?php echo $other; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 work-aside-intro">
                                    <h5>Organisatsiooni tutvustus:</h5>
                                    <p><?php echo $work_desc; ?></p>
                                    <h5>Koduleht:</h5>
                                    <p><?php echo $website; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end -->

        </div>
    </section>


    <!-- Call to Action Section -->
    <!--
  <section class="page-section bg-dark text-white">
    <div class="container text-center">
      <h2 class="mb-4">Free Download at Start Bootstrap!</h2>
      <a class="btn btn-light btn-xl" href="https://startbootstrap.com/themes/creative/">Download Now!</a>
    </div>
  </section>-->

    <!-- Contact Section -->

    <!--
<div class="row">
        <div class="col-lg-4 ml-auto text-center">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <div>+1 (202) 555-0149</div>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i> 
-->
    <!-- Make sure to change the email address in anchor text AND the link below! -->
    <!--         <a class="d-block" href="mailto:praktikamajanduses@ut.ee">praktikamajaduses@ut.ee</a>
        </div>
      </div>
    </div>-->
    <!--</section>-->

    <!-- Footer -->
    <footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">Copyright &copy; 2019 - Start Bootstrap</div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template
    <script src="../../js/creative.min.js"></script>-->

</body>

</html>
