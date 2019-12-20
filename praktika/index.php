<!DOCTYPE html>
<html lang="en">
<?php $title="Üliõpilane"; include_once './../templates/header.php';?>

<body id="page-top" class="practice">

    <?php include_once './../templates/top-navbar.php';?>

    <div id="main"></div>

    <div id="page-content">
      
        <section class="page-section">
            <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <h1 class="text-uppercase font-weight-bold mt-5 mb-3">Üliõpilane</h1>
                  </div>
                  <div class="col-lg-4">
                    <p class="font-weight-light">
                        Tutvu praktika- ja tööpakkumistega või liitu DELTAki projektiga!
                        Sul on projektiidee? Esita see juba täna ja koos leiame Sulle meeskonna ja juhendaja!
                        Loe rohkem DELTAki projektist siit (tuleb link kuhugi)!
                    </p>
                    <a href="#" class="text-uppercase font-weight-bold">Loe rohkem siit!</a>
                  </div> 
                    <div class="col-lg-2">
                        <span id="formToggler" class="toggleMenu text-uppercase" onclick="openModal()">Lisa profiil</span>
                  </div>
                  <div class="col-lg-12">
                    <h5 class="text-uppercase text-center font-weight-bold mt-3">Liitunud</h5>
                  </div>
                        
                        <?php

                            $locations = array();

                            try {
                                $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);

                                // set the PDO error mode to exception
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                //echo "Connected to PDO successfully"; 
                                $query = $conn->prepare('SELECT DISTINCT location FROM People WHERE isvalidated = ? ');
                                $query->execute(array(1));

                                $data = $query -> fetchAll();
                                foreach($data as $row){
                                    $locations[] = $row["location"];
                                }

                            }
                            catch(PDOException $e){
                                $error_code = $e->getCode();
                                if($error_code == "23000"){
                                    //do something to clarify an email like this exists already.
                                }else{
                                    echo "Connection failed (code: $error_code): " . $e->getMessage();
                                }
                            }

                        ?>   
                        <!--
                        <form class="col-md-12 mb-4" target="_self" method="post" enctype="multipart/form-data">
                                <div class="form-row mb-2">

                                    <div class="col-md-12">
                                        <small>Aeg/Asukoht</small>
                                        <select class="form-control form-control-sm" name="cat" id="category">
                                            <option value="date" <?php if($_POST["cat"] == "date") echo 'selected="selected"'; ?>>
                                                Kuupäev
                                            </option>
                                            <option value="location" <?php if($_POST["cat"] == "location") echo 'selected="selected"'; ?>>
                                                Asukoht
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-12" id="date_order" <?php if($_POST["cat"] == "date") echo 'style="display:none;"'; ?>>
                                        <small>Aeg</small>
                                        <select class="form-control form-control-sm" name="date_order" >
                                            <option value="new">
                                                Uuemad
                                            </option>
                                            <option value="old">
                                                Vanemad
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-12" id="locations" <?php if($_POST["cat"] == "location") echo 'style="display:none;"'; ?>>
                                        <small>Asukohad</small>
                                        <select class="form-control form-control-sm" name="locations">
                                            <?php
                                                foreach($locations as $loc){
                                                    $loc_op = '<option value="'.$loc.'">
                                                                    '.$loc.'
                                                                </option>';
                                                    echo $loc_op;
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <input type="hidden" name="selected_sort" value="date">
                                        <button class="btn btn-primary" type="submit">Sorteeri</button>
                                    </div>

                                </div>
                            </form>-->
                        

                </div> <!-- .row -->
            </div> <!-- .container -->
        </section>
        <!-- Portfolio Section -->
        <section class="" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"></div>
                    <div class="col-lg-12">
                        <div class="row">
                            
                      </div>

                        <div class="row">
                            <?php
                          
                          function substringwords($text, $maxchar = 40, $end = "..."){
                            if (strlen($text) > $maxchar || $text = '') {
                              $words = preg_split('/\s/', $text);
                              $output = '';
                              $i = 0;
                              while (1) {
                                $length = strlen($output) + strlen($words[$i]);
                                if ($length > $maxchar) {
                                  break;
                                }
                                else {
                                  $output .= " " . $words[$i];
                                  ++$i;
                                }
                              }
                              $output .= " " . $end;
                            }
                            else {
                              $output = $text;
                            }
                            return $output;
                          }
                            try {
                                $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
                                // set the PDO error mode to exception
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                if(!empty($_POST)){
                                    $cat = $_POST["cat"];
                                    $location = $_POST["locations"];
                                    $date = $_POST["date_order"];

                                    $queryString = "";
                                    if($cat == "date"){
                                        $queryString.="ORDER BY datetime_uploaded ";
                                        if($date == "new"){
                                            $queryString.="DESC";
                                        }else{
                                            $queryString.="ASC";
                                        }
                                        $query = $conn->prepare('SELECT * FROM People WHERE isvalidated = ? '+$queryString);
                                        $query->execute(array(1));
                                    }else{
                                        $query = $conn->prepare('SELECT * FROM People WHERE isvalidated = ? AND location = ?');
                                        $query->execute(array(1, $location));
                                    }

                                }else{
                                    $query = $conn->prepare('SELECT * FROM People WHERE isvalidated = ?');
                                    $query->execute(array(1));
                                }
                                $data = $query -> fetchAll();
                                foreach($data as $row){

                                    // Everything on new lines
                                    $name = str_replace(" ", "<br>", $row["name"]);
                                    $degree = $row["major"]."<br>".$row["institute"];

                                    $pic = "../userdata/pictures/".$row["picturepath"]; //https://dummyimage.com/1000x1000/fff/aaa
                                    if($row["picturepath"]==""){
                                       $pic ="../userdata/blank_profile_pic.png";
                                    }
                                    $cv = "../userdata/cvs/".$row["cvpath"];
                                    $email = $row["email"];
                                    $tugevused = $row["skills"];
                                    $kogemused = $row["experience"];
                                    $work = $row["work"];
                                    $asukoht = $row["location"]; 

                                    //bullet list creator
                                    $parsed_kogemused = "<ul>";
                                    foreach(explode("\n", $kogemused) as $line){
                                        $parsed_kogemused .= "<li>$line</li>";
                                    }
                                    $parsed_kogemused .= "</ul>";
                                    unset($line);

                                    $bigstring = '
                                    <div class="col-xs-12 col-sm-6 col-md-2">
                                        <div class="flip-div">
                                            <div class="flip-main">
                                                <div class="front">
                                                    <div class="card">
                                                        <p><img class="" src="'.$pic.'" alt="'.$name.'"></p>
                                                        <div class="card-body pb-2">
                                                            <p class="card-title font-weight-bold">'.$name.'</p>
                                                            <p class="card-text font-weight-light">'.$degree.'</p>
                                                            <p class="card-text font-weight-light text-primary">'.$work.'</p>
                                                        </div>
                                                        <a href="#" class=""><i class="arrow-front"></i></a>
                                                    </div>
                                                </div>
                                                <div class="back">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <p class="card-title font-weight-bold">'.$name.'</p>
                                                            <p class="card-text font-weight-light">'.$degree.'</p>
                                                            <p class="card-text font-weight-light">'.$work.'</p>
                                                            <p class="font-weight-bold">Tugevused:</p>
                                                            <p class="card-text font-weight-light">'.substringwords($tugevused).'</p>
                                                            <p class="font-weight-bold">Kogemused:</p>
                                                            <p class="card-text font-weight-light">'.substringwords($kogemused).'</p>
                                                            <!-- Leaving this in in case we still want this CV and e-mail button -->
                                                             <!--<div class="btn-group btn-group-md align-self-center" role="group" aria-label="Basic example">----
                                                                <a class="btn btn-sm btn-info js-open-cv" data-cv="'.$cv.'"><i class="far fa-file-pdf"></i></a>
                                                                <a class="btn btn-sm btn-success" href="mailto:'.$email.'"><i class="far fa-envelope"></i></a>
                                                            </div>	-->
                                                            
                                                        </div>
                                                        <div class="links">
                                                          <a href="mailto:'.$email.'" class="text-uppercase">Saada kiri</a>
                                                          <a href="#" class="text-uppercase js-open-cv" data-cv="'.$cv.'">Vaata CV\'d</a>
                                                        </div>
                                                        <i class="arrow-front"></i>
                                                    </div>
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

                </div>
            </div>
        </section>
    </div>

    <!-- modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="container">

                        <form class="row <?php if ($form_success){ echo "hidden"; }?>" action="prax_api.php" method="post" enctype="multipart/form-data" id="form_student">

                            

                            <div class="col-lg-8">

                                <div class="form-group">
                                    <label for="name">Ees- ja perekonnanimi*</label>
                                    <input type="text" class="form-control <?php if(!empty($_POST) && !$removeing) { if($name == "") { echo "is-invalid"; } } ?>" id="name" name="name" <?php echo "value='".htmlspecialchars($name)."'";?>>
                                    <div class='invalid-feedback'>Sisesta oma nimi!</div>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail*</label>
                                    <input type="email" class="form-control <?php if(!empty($_POST)) { if($email_valid) { echo "is-valid"; }else{ echo "is-invalid"; } }?>" id="email" aria-describedby="emailHelp" name="email" <?php echo "value='".htmlspecialchars($email)."'";?>>
                                </div>
                                <div class="form-group">
                                    <label for="work">Eriala*</label>
                                    <input type="text" class="form-control <?php if(!empty($_POST) && !$removeing) { if($major != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="major" name="major" <?php echo "value='".htmlspecialchars($major)."'";?>>
                                </div>

                            </div>
                          
                          <div class="col-lg-4">
                                <div class="form-group">
                                    <img src="../userdata/blank_profile_pic.png" id="profileImg">
                                    <label for="pilt">Pilt</label>
                                    <input type="file" class="form-control-file <?php if(!empty($_POST) && !$removeing) { if(!$pic_success) { echo "is-invalid"; } } ?>" id="student_pilt" name="pilt">
                                    <div class='invalid-feedback'>Sisesta pilt!</div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="work">Instituut*</label>
                                    <input type="text" class="form-control <?php if(!empty($_POST) && !$removeing) { if($institute != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="institute" name="institute" <?php echo "value='".htmlspecialchars($institute)."'";?>>
                                </div>
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
                                    <label for="CV">CV</label>
                                    <input type="file" class="form-control-file <?php if(!empty($_POST) && !$removeing) { if(!$cv_success) { echo "is-invalid"; } } ?>" id="CV" name="cv">
                                    <div class='invalid-feedback'>Sisesta CV!</div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input <?php if(!empty($_POST) && !$removeing) { if($checkpoint) { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="checkpoint" name="checkpoint" required="required">
                                        <label class="custom-control-label" for="checkpoint">Olen teadlik, et andmeid näidatakse avalikult…*</label>
                                    </div>
                                </div>
                                <input type="button" class="mt-3 text-center text-uppercase btn js-ajax" data-value="add" value="Lae üles!">
                              </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade modal-cv" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">CV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <?php include_once './../templates/footer.php';?>

    <script>
        $(document).ready(function() {
            $('.js-modal').on('click', openModal);
            $('.js-open-cv').on('click', openCV);
            $('.js-ajax').on('click', function(e) {
                ajaxSubmit(e);
            });

            $('[data-toggle="tooltip"]').tooltip();

            $("#student_pilt").change(function() {
                readURL2(this, "#profileImg");
            });
           $( ".flip-div" ).click(function() {
            $( this ).toggleClass( "hover" );
            console.log("Initialized", $(this));
          });
        });

        function openCV(e) {
            var modal = $('.modal-cv').first();
            var target = $(e.currentTarget);
            var cvpath = $(target).data('cv');

            var cvembed = $('<embed>').attr('src', cvpath).css('width', '100%').css('min-height', '512px');
            modal.find('.modal-body').empty();
            modal.find('.modal-body').html(cvembed);

            modal.modal('show');
        }

        function openModal(e) {
            if (e !== undefined && e.target !== this)
                return;
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
