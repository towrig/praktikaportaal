<!DOCTYPE html>
<html lang="en">

<?php $title="Üliõpilased"; include_once './../templates/header.php';?>

<body id="page-top" class="practice">

    <?php include_once './../templates/top-navbar.php';?>

    <div id="main"></div>

    <div id="page-content">
        <section class="page-section bg-primary">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <hr class="divider light my-4">
                        <h2 class="text-white text-uppercase font-weight-bold mt-0">Üliõpilane 222</h2>
                        <p class="text-white font-weight-light mb-5">
                            Tutvu praktika- ja tööpakkumistega või liitu DELTAki projektiga!
                            Sul on projektiidee? Esita see juba täna ja koos leiame Sulle meeskonna ja juhendaja!
                            Loe rohkem DELTAki projektist siit (tuleb link kuhugi)!
                        </p>
                        <hr class="divider light my-4">
                    </div> <!-- .col-->
                    <div class="col-md-6 d-flex flex-column align-self-center">
                    <div class="mlr-8">
                        <span id="formToggler" class="toggleMenu btn-lg" onclick="openModal()">Lisa profiil!<span class="tooltip_mark" data-toggle="tooltip" data-placement="right" title="Profiili lisamisel jääb see süsteemi kuueks kuuks.´Sinu profiil on nähtav organisatsiooni alamlehel">?</span></span>
                    </div>
                        </div>

                </div> <!-- .row -->
            </div> <!-- .container -->
        </section>
        <!-- Portfolio Section -->
        <section class="" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12"></div>
                    <div class="col-lg-12 text-center">
                        <div class="row">
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

                            <form class="col-md-12 mb-4" target="_self" method="post" enctype="multipart/form-data">
                                <div class="form-row mb-2">

                                    <div class="col-md-3">
                                        <select class="form-control form-control-sm" name="cat" id="category">
                                            <option value="date" <?php if($_POST["cat"] == "date") echo 'selected="selected"'; ?>>
                                                Kuupäev
                                            </option>
                                            <option value="location" <?php if($_POST["cat"] == "location") echo 'selected="selected"'; ?>>
                                                Asukoht
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-3" id="date_order" <?php if($_POST["cat"] == "date") echo 'style="display:none;"'; ?>>
                                        <select class="form-control form-control-sm" name="date_order" >
                                            <option value="new">
                                                Uuemad
                                            </option>
                                            <option value="old">
                                                Vanemad
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-3" id="locations" <?php if($_POST["cat"] == "location") echo 'style="display:none;"'; ?>>
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

                                    <div class="col-md-3">
                                        <input type="hidden" name="selected_sort" value="date">
                                        <button class="btn btn-primary" type="submit">Sorteeri</button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="row">
                            <?php
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

                                    //currently unused cols: 
                                    $name = $row["name"];
                                    $degree = $row["major"]." | ".$row["institute"];
                                    $pic = "../userdata/pictures/".$row["picturepath"]; //https://dummyimage.com/1000x1000/fff/aaa
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
                                    <div class="col-md-12">
                                        <div class="card js-modal" data-pic="'.$pic.'" data-name="'.$name.'" data-degree="'.$degree.'" data-skills="'.$tugevused.'" data-experience="'.$kogemused.'" data-loc="'.$asukoht.'" data-email="'.$email.'" data-work="'.$work.'">
                                            <div class="p-2">

                                                <div class="row">
                                                    <div class="col-md-2"><!-- picture -->
                                                        <img class="card-img-top" style="max-height: 50px; width:100px;" src="'.$pic.'" alt="Card image cap">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-md-12 d-flex"><!-- content -->
                                                            <h5 class="align-self-center">'.$name.'</h5>
                                                        </div>
                                                        <div class="col-md-12 d-flex">
                                                            <h6 class="align-self-center">'.$degree.'</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 d-flex"> <!-- buttons -->
                                                        <div class="btn-group btn-group-md align-self-center" role="group" aria-label="Basic example">
                                                            <a class="btn btn-sm btn-light js-open-cv" data-cv="'.$cv.'"><i class="far fa-file-pdf"></i> Vaata CV-d</a>
                                                            <a class="btn btn-sm btn-success" href="mailto:'.$email.'"><i class="far fa-envelope"></i> Võta ühendust</a>
                                                        </div>	
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

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Lisa profiil</h5>
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
                                    <label for="email">Kontakt ehk Email*</label>
                                    <input type="email" class="form-control <?php if(!empty($_POST)) { if($email_valid) { echo "is-valid"; }else{ echo "is-invalid"; } }?>" id="email" aria-describedby="emailHelp" name="email" <?php echo "value='".htmlspecialchars($email)."'";?>>
                                </div>


                            </div>

                            <div class="col-lg-12">
                                 <div class="form-group">
                                    <label for="work">Eriala*</label>
                                    <input type="text" class="form-control <?php if(!empty($_POST) && !$removeing) { if($major != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="major" name="major" <?php echo "value='".htmlspecialchars($major)."'";?>>
                                </div>
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
                                <button type="button" class="btn btn-success btn-lg js-ajax btn-form" data-value="add">Lae üles!</button>
                                <button type="button" class="btn btn- btn-lg js-scroll-trigger btn-form" data-value="remove">Soovin end andmebaasist eemaldada</button>


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
            $('.js-open-cv').on('click', openCV);
            $('.js-ajax').on('click', function(e) {
                ajaxSubmit(e);
            });

            $('[data-toggle="tooltip"]').tooltip();

            $("#student_pilt").change(function() {
                readURL2(this, "#profileImg");
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
            if (e.target !== this)
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
