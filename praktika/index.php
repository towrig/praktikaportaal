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

    <title>Praktikavahenduste keskkond - Üliõpilane</title>

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
    <link href="../css/custom.css?v=4" rel="stylesheet">

</head>

<body id="page-top" class="practice">

    <?php echo loadHTML("../frags/navbar.html"); ?>

    <div id="main"></div>

    <div id="page-content">
        <section class="page-section bg-primary">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <hr class="divider light my-4">
                        <h2 class="text-white text-uppercase font-weight-bold mt-0">Üliõpilane</h2>
                        <p class="text-white-75 font-weight-light mb-5">
                            Tutvu praktika- ja tööpakkumistega või liitu DELTAki projektiga!
                            Sul on projektiidee? Esita see juba täna ja koos leiame Sulle meeskonna ja juhendaja!
                            Loe rohkem DELTAki projektist siit (tuleb link kuhugi)!
                        </p>
                        <hr class="divider light my-4">
                    </div> <!-- .col-->
                    <div class="col-lg-3">
                        <span id="formToggler" class="toggleMenu btn-lg" onclick="openModal()">Lisa profiil!<span class="tooltip_mark" data-toggle="tooltip" data-placement="right" title="Profiili lisamisel jääb see süsteemi kuueks kuuks.´Sinu profiil on nähtav organisatsiooni alamlehel">?</span></span>
                    </div>
                    <div class="col-lg-3">
                        <a id="formToggler" class="toggleMenu btn-lg" href="../team" style="text-decoration: none !important; color: black;">Esita oma PROJEKTIidee kohe!</a>
                        <p style="font-size:12px">Projektitaotluse esitamise tähtaeg on 1. oktoober ja 1. märts!</p>
                    </div>


                </div> <!-- .row -->
            </div> <!-- .container -->
        </section>
        <!-- Portfolio Section -->
        <section class="" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"></div>
                    <div class="col-lg-6 text-center" style="border-right: 1px solid #f4623a;">

                        <!-- reusable design for work -->
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p>Praktika- ja tööpakkumised</p>
                            </div>
                            <?php
						
							try {
								$conn = new PDO('mysql:host=localhost;dbname=userdata', 'root', 'Kilud123');
								// set the PDO error mode to exception
								$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$query = $conn->prepare('SELECT heading,description,validationcode,picturepath FROM WorkPosts WHERE isvalidated = ?'); 
								$query->execute(array(1));
								$data = $query -> fetchAll();
								foreach($data as $row){
									//currently unused cols: name,email,phone,tasks,experience,work_location,work_type,other,logopath
									$heading = $row["heading"];
									$description = $row["description"];
									$validationcode = $row["validationcode"];
									$picurl = "../userdata/pictures/".$row["picturepath"];
									
									$bigstring = '<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="card" style="background: linear-gradient(to top, #faa41a 40%, rgba(255,255,255,.6)), url('.$picurl.');">
                                                        <a href="../tootaja/kuulutus?c='.$validationcode.'">
														<div class="card-body text-left">
															<h6 class="card-title text-uppercase font-weight-bold mt-0">'.$heading.'</h6>
															<p class="card-text">'.$description.'</p>
														</div>
                                                        </a>
													</div>
												</div>';
									
									echo $bigstring;
								}
								
							} catch(PDOException $e){
								echo "Connection failed: " . $e->getMessage();
							}
						?>

                        </div>
                        <hr class="divider light my-4">
                    </div>
                    <div class="col-lg-6 text-center">

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p>Projektid</p>
                            </div>
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
														<div class="btn-group btn-group-md align-self-center" role="group" aria-label="Basic example">
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

                </div>
            </div>
        </section>
    </div>

    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Esita soov praktikale!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">

                        <form class="row <?php if ($form_success){ echo "hidden"; }?>" action="prax_api.php" method="post" enctype="multipart/form-data" id="form_student">

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <img src="../userdata/blank_profile_pic.png" style="width:100px; height:100px;border-radius: 50px;" id="profileImg">
                                    <label for="pilt">Pilt</label>
                                    <input type="file" class="form-control-file <?php if(!empty($_POST) && !$removeing) { if(!$pic_success) { echo "is-invalid"; } } ?>" id="student_pilt" name="pilt">
                                    <div class='invalid-feedback'>Sisesta pilt!</div>
                                </div>
                            </div>

                            <div class="col-lg-8">

                                <div class="form-group">
                                    <label for="name">Ees- ja perekonnanimi*</label>
                                    <input type="text" class="form-control <?php if(!empty($_POST) && !$removeing) { if($name == "") { echo "is-invalid"; } } ?>" id="name" name="name" <?php echo "value='".htmlspecialchars($name)."'";?>>
                                    <div class='invalid-feedback'>Sisesta oma nimi!</div>
                                </div>
                                <div class="form-group">
                                    <label for="work">Eriala*</label>
                                    <input type="text" class="form-control <?php if(!empty($_POST) && !$removeing) { if($major != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="major" name="major" <?php echo "value='".htmlspecialchars($major)."'";?>>
                                </div>
                                <div class="form-group">
                                    <label for="work">Instituut*</label>
                                    <input type="text" class="form-control <?php if(!empty($_POST) && !$removeing) { if($institute != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="institute" name="institute" <?php echo "value='".htmlspecialchars($institute)."'";?>>
                                </div>
                                <div class="form-group">
                                    <label for="email">Kontakt ehk Email*</label>
                                    <input type="email" class="form-control <?php if(!empty($_POST)) { if($email_valid) { echo "is-valid"; }else{ echo "is-invalid"; } }?>" id="email" aria-describedby="emailHelp" name="email" <?php echo "value='".htmlspecialchars($email)."'";?>>
                                </div>
                                <div class="form-group">
                                    <label for="CV">CV</label>
                                    <input type="file" class="form-control-file <?php if(!empty($_POST) && !$removeing) { if(!$cv_success) { echo "is-invalid"; } } ?>" id="CV" name="cv">
                                    <div class='invalid-feedback'>Sisesta CV!</div>
                                </div>

                            </div>

                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label for="work">Soovitav praktika/töö valdkond*</label>
                                    <input type="text" class="form-control <?php if(!empty($_POST) && !$removeing) { if($work != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="work" name="work" <?php echo "value='".htmlspecialchars($work)."'";?>>
                                </div>
                                <div class="form-group">
                                    <label for="oskused">Tugevused/oskused*</label>
                                    <textarea class="form-control" id="oskused" rows="3" name="oskused"><?php if(!empty($_POST)) {echo htmlspecialchars($oskused);}?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kogemused">Kogemused</label>
                                    <textarea class="form-control" id="kogemused" rows="3" name="kogemused"><?php if(!empty($_POST)) {echo htmlspecialchars($kogemused);}?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="location">Soovitud asukoht</label>
                                    <input type="text" class="form-control <?php if(!empty($_POST) && !$removeing) { if($location != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="location" name="location" <?php echo "value='".htmlspecialchars($location)."'";?>>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input <?php if(!empty($_POST) && !$removeing) { if($checkpoint) { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="checkpoint" name="checkpoint" required="required">
                                        <label class="custom-control-label" for="checkpoint">Olen teadlik, et andmeid näidatakse avalikult…*</label>
                                    </div>
                                    </divWS>
                                    <button type="button" class="btn btn-success btn-lg js-ajax btn-form" data-value="add">Lae üles!</button>
                                    <button type="button" class="btn btn- btn-lg js-scroll-trigger btn-form" data-value="remove">Soovin end andmebaasist eemaldada</button>

                                </div>

                        </form>

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

    <!-- Custom scripts for this template
    <script src="../js/creative.min.js"></script>-->

    <script>
        $(document).ready(function() {
            $('.js-modal').on('click', openModal);
            $('.js-ajax').on('click', function(e) {
                ajaxSubmit(e);
            });

            $('[data-toggle="tooltip"]').tooltip();

            $("#student_pilt").change(function() {
                readURL2(this, "#profileImg");
            });
        });

        function openModal(e) {
            var modal = $('.modal').first();
            modal.modal('show');
        }

        function ajaxSubmit(e) {
            var action = $(e.currentTarget).data("value");
            var form = $('#form_student');
            let formData = new FormData(document.getElementById('form_student'));
            formData.append("action", action);

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(function(response) {
                console.log(response);
                form.after("<div class='alert alert-success'>Aitäh! Teie emailile tuleb postituse aktiveerimislink!</div>");
                form.css('display', 'none');
            }).fail(function(response) {
                console.log(response);
                form.after("<div class='alert alert-danger'>Ups! Midagi läks valesti registreerimisel.</div>");
            });
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

    </script>

</body>

</html>
