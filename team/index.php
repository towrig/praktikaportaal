<?php

    function loadHTML($filename){
        $target = fopen($filename, "r") or die("Failed to open file!");
        $html_to_return = fread($target, filesize($filename));
        fclose($target);
        return $html_to_return;
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../css/creative.min.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../css/custom.css?v=2" rel="stylesheet">

</head>

<body id="page-top">

    <?php echo loadHTML("../frags/navbar.html"); ?>
	
	<div id="page-content">
	
    <section class="page-section bg-primary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <hr class="divider light my-4">
                    <h2 class="text-white text-uppercase font-weight-bold mt-0">Projektid ja Tiimid</h2>
                    <p class="text-white-75 font-weight-light mb-5">Teosta oma praktika DELTAki projektis ja kasuta oma kogemusi ja teadmisi reaalsete probleemide lahendamiseks!</p>
          
					<p class="text-white-75">
						Projektitaotluse esitamise tähtajad on 1. oktoober ja 1. märts.<br>
						Üliõpilaste registreerumine projektidesse toimub 8.-14. oktoober ja märts.<br>
						Projektid alustavad kaks korda aastas - 15. oktoobril ja 15. märtsil!<br>
						Kuidas täita projektitaotlust? VAATA <a class="text-white" href="https://docs.google.com/document/d/17CI47SEDeFnIVwmLptqmgXLR4OTgO5w_lIqJDqjbpBc/edit" target="_blank" rel="noopener noreferrer">SIIA!</a>
					</p>
                    <hr class="divider light my-4">

                </div> <!-- .col-->
                <div class="col-lg-3">
                	<a class="toggleMenu btn-lg" href="../userdata/Projektipraktika_taotlusvorm.docx" download>
					  PROJEKTIVORM<span class="tooltip_mark" data-toggle="tooltip" data-placement="right" title="Täitmiseks lae alla">?</span>
					</a>
                </div>
				<div class="col-lg-3">
					<a id="formToggler" class="toggleMenu btn-lg" onclick="openModal()">Esita projekt!</a>
				</div>

            </div> <!-- .row -->
        </div> <!-- .container -->
    </section>

	
	<section id="profiles">
		<div class="container">

			<div class="row"> 
				<?php
				try {
					$conn = new PDO('mysql:host=localhost;dbname=userdata', 'root', 'Kilud123');
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$query = $conn->prepare('SELECT * FROM ProjectPosts WHERE isactivated = ?');
					$query->execute(array(1));
					$data = $query -> fetchAll();
					foreach($data as $row){
						
						//currently unused cols: work
						$title = $row["title"];
						$start_date = $row["start_date"];
						$end_date = getdate(strtotime($row["end_date"]));
    					$end_date_string = $end_date["mday"].".".$end_date["mon"].".".$end_date["year"];
						$id = $row["id"];

						$org_name = $row["org_name"];
						$org_email = $row["org_email"];

						$bigstring = '
						<div class="col-md-12">
							<div class="card">
								<div class="p-2">
									<a class="project-link" href="viewproject?c='.$id.'">
									<div class="row">
										<div class="col-md-12 d-flex"><!-- content -->
											<h5 class="align-self-center">'.$title.'</h5>
										</div>
										<div class="col-md-8 d-flex">
											<h6 class="align-self-center">Kandideerimise lõpptähtaeg: <b>'.$end_date_string.'</b></h6>
										</div>
										<div class="col-md-4 d-flex"> <!-- buttons -->
											<div class="btn-group btn-group-md align-self-center">
												<span class="btn btn-sm btn-success" href="viewproject?c='.$id.'">Liitu!</span>
											</div>	
										</div>
									</div>
									</a>
								</div>
							</div>
						</div>';
						$bigstring = str_replace("\n","",$bigstring);
						$bigstring = str_replace("\t","",$bigstring);
						echo $bigstring;
						
						
					}
				} catch (PDOException $e){
					echo "Connection failed: " . $e->getMessage();
				}
				
				?>
			</div>
		</div>
	</section>
	
	</div>

    <div id="main">
    </div>

    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    	<div class="modal-dialog" role="document">
	    	<div class="modal-content">

	    		<div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Esita projekt</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
		      	</div>
			    <div class="modal-body">
			    	<div class="row">
			    		<div class="col-lg-12">
			    			<form method="POST" action="viewproject/project_api.php" enctype="multipart/form-data" id="project_submission">
			    				<div class="form-group">
			    					<label>Projekti pealkiri<span class="tooltip_mark" data-toggle="tooltip" data-placement="right" title="Pealkirja maksimaalne pikkus 85 tähemärki">?</span></label>
			    					<input type="text" name="project_title" class="form-control" maxlength="85">
			    				</div>
			    				<div class="form-group">
			    					<label>Projekti PDF:</label>
			    					<input type="file" name="project_pdf" id="project_pdf">
			    				</div>
			    				<div class="form-group">
			    					<label>Teie nimi:</label>
			    					<input type="text" name="project_org_name" class="form-control">
			    					<label>Teie email:</label>
			    					<input type="text" name="project_org_email" class="form-control">
			    				</div>
			    				<div class="form-group">
			    					<input type="button" name="submit-form" class="btn btn-success" onclick="ajaxSubmit()" value="Registreeri!">
			    				</div>
			    			</form>
			    			
			    		</div>
			    	</div>
			    </div>

	    	</div>
	    </div>
	</div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Custom scripts for this template
    <script src="../js/creative.min.js"></script> -->

    <script type="text/javascript">
    	$(document).ready(function(){
    		$('[data-toggle="tooltip"]').tooltip();
    	});

    	function ajaxSubmit(){
    		var form = $('#project_submission');
            let formData = new FormData(document.getElementById('project_submission'));

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                cache: false,
		        contentType: false,
		        processData: false,
                data: formData
            }).done(function(response){
                console.log(response);
                form.after("<div class='alert alert-success'>Aitäh! Teie projekt kiidetakse heaks hiljemalt nädala jooksul.</div>");
                form.css('display', 'none');
            }).fail(function(response){
                console.log(response);
                form.after("<div class='alert alert-danger'>Ups! Midagi läks valesti registreerimisel. Proovige uuesti.</div>");
            });
    	}

    	function openModal(){
    		var modal = $('.modal').first();
    		modal.modal('show');
    	}
    </script>

</body>

</html>