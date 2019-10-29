<?php
function loadHTML($filename){
    $target = fopen($filename, "r") or die("Failed to open file!");
    $html_to_return = fread($target, filesize($filename));
    fclose($target);
    return $html_to_return;
}

//public variables
//currently unused cols: name,email,phone,tasks,experience,work_location,work_type,other,logopath,validationcode,heading,description,picturepath

$heading = "";
$pdf_path = "";
$participants = array();
$end_date_raw = "";
$editmode = false;
//contact
$email = "";
$name = "";
$phone = "";


try {
	$conn = new PDO('mysql:host=localhost;dbname=userdata', 'root', 'Kilud123');
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $data = array();
    if($_GET["e"]){
        $query = $conn->prepare('SELECT * FROM ProjectPosts WHERE id = ? AND edit_key = ?'); 
        $query->execute(array($_GET["c"], $_GET["e"]));
        $data = $query -> fetchAll();
        $editmode = true;
    }else{
        $query = $conn->prepare('SELECT * FROM ProjectPosts WHERE id = ?'); 
        $query->execute(array($_GET["c"]));
        $data = $query -> fetchAll();
    }
	foreach($data as $row){
		
		$heading = $row["title"];
		$pdf_path = "../../userdata/projects/".$row["pdf_path"];
        $end_date_raw = $row["end_date"];
        
		$name = $row["org_name"];
		$email = $row["org_email"];
        		
	}
    $query = "";
    if($editmode){
        $query = $conn->prepare('SELECT * FROM ProjectParticipants WHERE project_id = ?'); 
    }else{
        $query = $conn->prepare('SELECT * FROM ProjectParticipants WHERE project_id = ? AND is_accepted = 1'); 
    }
    $query->execute(array($_GET["c"]));
    $data = $query -> fetchAll();
    $i = 0;
    foreach($data as $row){
        $participants[$i] = $row["name"].";".$row["email"].";".$row["degree"].";".$row["skills"].";".$row["is_accepted"]; 
        $i+= 1;
    }
    $conn = null;
    $end_date = getdate(strtotime($end_date_raw));
    $end_date_string = $end_date["mday"].".".$end_date["mon"].".".$end_date["year"];
}catch (PDOException $e){
	echo "Connection failed: " . $e->getMessage();
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
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="../../vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../../css/creative.min.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../../css/custom.css" rel="stylesheet">
    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../../css/custom-form.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php echo loadHTML("../../frags/navbar.html"); ?>

    <!-- work.php -->
    <section>
        <div class="container work">

            <!-- start title-share -->
            <div class="row">
                <div class="col-lg-12 work-title" style="margin: 200px 0 0">
                    <h2><?php echo $heading; ?></h2>
                </div>
            </div> <!-- end -->
            <!-- start main-content -->
            <div class="row">
                <div class="col-lg-12 work-content">
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-12 embed-container">
                                <embed class="pdf-embed" type="application/pdf" src="<?php if(isset($pdf_path)){ echo "../../userdata/projects/".$pdf_path;}else{echo "../../userdata/projects/lorem-ipsum.pdf";} ?>" style="width: 100%; min-height: 500px;"></embed>
                                <p style="margin-top: 10px;">Kandideerimise lõpptähtaeg: <b><?php echo $end_date_string; ?></b></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end -->
            <!-- start footer -->
            <div class="row">

                <div class="col-lg-4 work-footer-contact">

                    <div class="row" style="overflow: hidden;">
                        <div class="col-lg-4">
                            <?php 
							if(!empty($avatar)){
								echo "<img src=".$avatar." style='width:100px; height:100px;border-radius: 50px;'>";
							}else{
								echo "<img src='../../img/portfolio/thumbnails/5.jpg' style='width:100px; height:100px;border-radius: 50px;'>";
							}
							?>
                        </div>
                        <div class="col-lg-8" style="overflow: hidden;">
                            <h5>Kontakt</h5>
                            <ul style="margin-left:-40px;">
                                <li><?php echo $name; ?></li>
                                <li><i class="fas fa-envelope"></i> <?php echo $email; ?></li>
                                <li><i class="fas fa-phone"></i> <?php echo $phone; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 work-footer-apply">
                    <p>Projektiga liitumiseks vajutage allolevat nuppu.</p>
                    <form id="project-apply" method="post" action="project_api.php">

                        <div class="form-group">
                            <label>Ees- ja perekonnanimi*:</label>
                            <input class="form-control" type="text" name="fullname" id="project_fullname" required>
                        </div>
                        <div class="form-group">
                            <label>Eriala*:</label>
                            <input class="form-control" type="text" name="degree" id="project_degree" required>
                        </div>
                        <div class="form-group">
                            <label>E-mail*:</label>
                            <input class="form-control" type="text" name="email" id="project_email" required>
                        </div>
                        <div class="form-group">
                            <label>Tugevused ja oskused:</label>
                            <textarea class="form-control" name="skills" id="skills" rows="2"></textarea>
                        </div>
                        <input type="hidden" name="hash" id="project_hash" value=<?php echo '"'.$_GET["c"].'"';?>>
                    </form>
                    <a class="btn btn-success btn-xl" onclick="join()">Liitu</a>
                    <a class="btn btn-success btn-xl" href="../../praktika">Loo profiil?</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="text-align:left; float:right;">
                    <p>JAGA LEHTE <i class="fas fa-share-square fa-1x"> </i></p>
                </div>
            </div>
        </div>
    </section>

    <section class="" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">

                    <h5 class="text-uppercase font-weight-bold mt-0">Liitunud üliõpilased<span class="tooltip_mark" data-toggle="tooltip" data-placement="right" title="Peale vajutades avaneb nende üliõpilaste info, kellel on profiil või lisainfo sisestatud. Profiili loomine pole projektiga liitumiseks kohustuslik">?</span></h5>
                    <hr class="divider light my-4">

                    <!-- reusable desing for work -->
                    <div class="row">
                        <?php 
                            $edit_button = "";
                            foreach ($participants as $p) {
                                $temp_arr = explode(";", $p);

                                if($editmode && $temp_arr[4] != 1){
                                    $edit_button = '<div class="btn-group btn-group-md align-self-center" role="group" aria-label="Basic example">
                                                        <span class="btn btn-sm btn-success edit_reg_b" data-action="approve" data-email="'.$temp_arr[1].'">Kinnita registreering</span>
                                                         <span class="btn btn-sm btn-danger edit_reg_b" data-action="decline" data-email="'.$temp_arr[1].'">Keeldu</span>
                                                    </div>';
                                }

                                $bigString = '<div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body text-left">
                                            <h6 class="card-title text-uppercase font-weight-bold mt-0">'.$temp_arr[0].'</h6>
                                            <p class="card-text">'.$temp_arr[2].'<br>'.$temp_arr[1].'</p>
                                            '.$edit_button.'
                                        </div>
                                    </div>
                                </div>';
                                echo $bigString;
                            }
                        ?>

                    </div>
                    <hr class="divider light my-4">

                </div>

            </div>
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
    <script src="../../js/creative.min.js"></script> -->
    <script type="text/javascript">
        var areasVisible = false;
        var editmode_key = "<?php echo $_GET["e"];?>";

        $(document).ready(function() {
            $(".edit_reg_b").on('click', function(event) {
                actionParticipant(event);
            });

            $('[data-toggle="tooltip"]').tooltip();
        });

        function join() {
            var form = $('#project-apply');
            if (areasVisible) {
                var formData = form.serialize();
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: formData
                }).done(function(response) {
                    console.log(response);
                    form.after("<div class='alert alert-success'>Edukas registreerimine! Emailile tuleb teavitus vastuvõtmise kohta.</div>");
                    form.css('display', 'none');
                }).fail(function(response) {
                    console.log(response);
                    form.after("<div class='alert alert-danger'>Ups! Midagi läks valesti registreerimisel.</div>");
                });

            } else {
                areasVisible = true;
                form.css('display', 'block');
            }
        }

        function actionParticipant(e) {
            let formData = new FormData();
            formData.append("edit_key", editmode_key);
            formData.append("email", $(e.currentTarget).data('email'));
            formData.append("action", $(e.currentTarget).data('action'));

            $.ajax({
                type: 'POST',
                url: 'project_api.php',
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(function(response) {
                console.log(response);
                $(e.currentTarget).css("display", "none");

            }).fail(function(response) {
                console.log(response);
            });
        }

    </script>

</body>

</html>