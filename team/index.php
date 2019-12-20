<!DOCTYPE html>
<html lang="en">
<?php $title="Projektid"; include_once './../templates/header.php';?>
<body id="page-top" class="project">
    <?php include_once './../templates/top-navbar.php';?>
    <div id="main"></div>
    <div id="page-content">
        <section class="page-section">
            <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                     <h1 class="text-uppercase font-weight-bold mt-5 mb-3">Projektid</h1>
                  </div>
                  <div class="col-lg-4">
                    <p class="font-weight-light">
                      Lisa oma projektiidee ja erinevate erialade üliõpilased töötavad koos, et viia ellu Sinu jaoks oluline ja üliõpilastele väljakutset pakkuv projekt. </p>
                    <p class="font-weight-light">
                        Projektitaotluste esitamise viimane tähtaeg on <b>02.03!</b>
                        <br>Üliõpilased saavad projektidega liituda <b>09.-15.03.</b>
                    </p>
                    <a href="#" class="text-uppercase font-weight-bold">Vaata ajakava siit!</a>
                  </div> <!-- .col-->
                  
                  <div class="col-lg-2">
                    <span id="formToggler" class="toggleMenu text-uppercase" onclick="openModal()">Esita projekt<!--<span class="tooltip_mark" data-toggle="tooltip" data-placement="right" title="Profiili lisamisel jääb see süsteemi kuueks kuuks.´Sinu profiil on nähtav organisatsiooni alamlehel">?</span>--></span>
                  </div>
                  <div class="col-lg-12">
                    <h5 class="text-uppercase text-center font-weight-bold mt-3">Esitatud projektid</h5>
                  </div>

                </div> <!-- .row -->
            </div> <!-- .container -->
        </section>


        <section id="profiles">
            <div class="container">
                <div class="row">
                    <?php
				try {
					$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$query = $conn->prepare('SELECT * FROM ProjectPosts WHERE isactivated = ?');
					$query->execute(array(1));
					$data = $query -> fetchAll();
					foreach($data as $row){
						
						$title = utf8_encode($row["title"]);
						$start_date = $row["start_date"];
						$end_date = getdate(strtotime($row["end_date"]));
    					$end_date_string = $end_date["mday"].".".$end_date["mon"].".".$end_date["year"];
						$id = $row["id"];
                        
                        $organisation = utf8_encode($row["organisation"]);
						$org_name = utf8_encode($row["org_name"]);
						$org_email = $row["org_email"];
                        
                        //get current registered users to show.
                        $max_part = $row["max_part"];
                        $amount = "";
                        $query = $conn->prepare('SELECT COUNT(*) AS amount FROM ProjectParticipants WHERE project_id = ? AND is_accepted = 1');
				        $query->execute(array($id));
                        $data = $query -> fetchAll();
					    foreach($data as $row){
                            $amount = $row["amount"];
                        }

						$bigstring = '
						<div class="col-md-4">
							<div class="card">
                <div class="row">
                  <div class="col-md-12">
                    <h6 class="text-uppercase">'.$title.'</h6>
                  </div>
                </div>
                  <div class="card-footer">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-lg-12">
                          <p class="mb-0"><b>Esitaja:</b> '.$org_name.'</p>
                          <p class="mb-0"><b>Asutus:</b> '.$organisation.'</p>
                          <p class=""><b>Meeskond:</b> '.$amount.'/'.$max_part.' </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <a class="project-link font-weight-bold text-uppercase" href="viewproject?c='.$id.'">
                        Vaata
                      </a>
                      <i class="front-arrow text-right"></i>
                    </div>
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
   <div id="main">
    </div>

    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

                
                <div class="modal-body">
                 
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="viewproject/project_api.php" enctype="multipart/form-data" id="project_submission">
                                <nav class="nav nav-pills flex-column flex-sm-row " id="pills-tab" role="tablist">
                                  <a class="flex-sm-fill text-sm-center nav-link active text-uppercase text-weight-bold" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><span>Projektivorm</span></a>
                                  <a class="flex-sm-fill text-sm-center nav-link text-uppercase text-weight-bold"  id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><span>Esita projekt</span></a>
                                </nav>
                                <div class="tab-content" id="pills-tabContent">
                                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">                                <div class="form-group">
                                    <h4 class="text-center my-3"><!--<i class="fa fa-4x fa-download"></i>--><label>Projektivormi allalaadimiseks vajuta <a href="../userdata/Projektipraktika_taotlusvorm.docx" download>siia.</a></label></h4>
                                    <iframe src="../userdata/projekti-alus.pdf#toolbar=0" width="100%" height="500px"></iframe>
                                </div>
                                  </div>
                                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="form-group mt-3">
                                      <label>Projekti pealkiri:</label>
                                          <input type="text" name="project_title" class="form-control" maxlength="85">
                                      </div>

                                      <div class="form-group">
                                          <label>Teie nimi:</label>
                                          <!--<input type="text" name="project_org_name" class="form-control">-->
                                          <input type="text" name="project_org_personal_name" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label>Teie email:</label>
                                          <input type="text" name="project_org_personal_email" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label>Organisatsiooni nimi:</label>
                                          <input type="text" name="project_org_name" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label>Meeskonna suurus (max 10):</label>
                                          <input type="text" name="max_part" class="form-control">
                                      </div>
                                      <div class="form-group">
                                          <label>Lae täidetud projektivorm PDF formaadis:</label>
                                          <input type="file" name="project_pdf" id="project_pdf">
                                      </div>
                                      <div class="form-group mt-3">
                                          <input type="button" name="submit-form" class="text-center text-uppercase btn" onclick="ajaxSubmit()" value="Esita">
                                      </div>
                                  </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once './../templates/footer.php';?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        function ajaxSubmit() {
            var form = $('#project_submission');
            let formData = new FormData(document.getElementById('project_submission'));

            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(function(response) {
                console.log(response);
                form.after("<div class='alert alert-success'>Aitäh! Teie projekt kiidetakse heaks hiljemalt nädala jooksul.</div>");
                form.css('display', 'none');
            }).fail(function(response) {
                console.log(response);
                form.after("<div class='alert alert-danger'>Ups! Midagi läks valesti registreerimisel. Proovige uuesti.</div>");
            });
        }

        function openModal() {
            var modal = $('.modal').first();
            modal.modal('show');
        }

    </script>

</body>

</html>
