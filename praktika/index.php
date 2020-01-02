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
                        Lisa profiil ning leia endale sobiv praktikakoht!<br>
                        Praktika kogemus suurendab üliõpilaste edukat tööle kandideerimist, võib olla Sinu järgmiseks töökohaks ning saada aimu, milliseid oskusi ja teadmisi tööandjad väärtustavad.
                    </p>
                    <a href="#" class="text-uppercase font-weight-bold">Lisatud profiil säilib kuus kuud</a>
                  </div> 
                    <div class="col-lg-2">
                        <span id="formToggler" class="toggleMenu text-uppercase" onclick="openModal()">Lisa profiil</span>
                  </div>
                  <div class="col-lg-12">
                    <h5 class="text-uppercase text-center font-weight-bold mt-5">Liitunud</h5>
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
                            <div id="carouselPager" class="carousel slide col-md-12">
                              <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="container">
                                        <div class="row">
                                            <?php
                                                // Function to show maxchars if to much text
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
                                                    $j = 0;
                                                    $max_per_page = 12;
                                                    $pages = 1;
                                                    $queue = false;
                                                    foreach($data as $row){

                                                        // Everything on new lines
                                                        $name = $row["name"];
                                                        $name_br = str_replace(" ", "<br>", $name);
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
                                                        
                                                        if($queue){
                                                            echo '<div class="carousel-item"><div class="container"><div class="row">';
                                                            $queue = false;
                                                        }
                                                        
                                                        $bigstring = '
                                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                                            <div class="flip-div">
                                                                <div class="flip-main">
                                                                    <div class="front">
                                                                        <div class="card">
                                                                            <p><img class="" src="'.$pic.'" alt="'.$name.'" title="'.$name.'"></p>
                                                                            <div class="card-body pb-2">
                                                                                <p class="card-title font-weight-bold">'.$name_br.'</p>
                                                                                <p class="card-text font-weight-light">'.$degree.'</p>
                                                                                <p class="card-text font-weight-light text-primary">'.$work.'</p>
                                                                            </div>
                                                                            <a href="#" class=""><i class="arrow-front"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="back">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <p class="card-title font-weight-bold">'.$name_br.'</p>
                                                                                <p class="card-text font-weight-light">'.$degree.'</p>
                                                                                <p class="card-text font-weight-light">'.$work.'</p>
                                                                                <p class="font-weight-bold mb-0">Tugevused</p>
                                                                                <p class="card-text font-weight-light">'.$tugevused.'</p>
                                                                                <p class="font-weight-bold mb-0">Kogemused</p>
                                                                                <p class="card-text font-weight-light">'.$kogemused.'</p>
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
                                                        $j++;
                                                        if ($j == $max_per_page){
                                                            $pages++;
                                                            $j = 0;
                                                            $queue = true;
                                                            echo "</div></div></div>";
                                                        }

                                                    }
                                                } catch (PDOException $e){
                                                    echo "Connection failed: " . $e->getMessage();
                                                }
                                            ?>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <nav aria-label="Pager" class="col-md-12">
                              <ul class="pagination">
                                <li class="page-item" data-index="prev">
                                  <a class="page-link" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                </li>
                                <?php
                                  for($i=0; $i < $pages; $i++){
                                      echo '<li class="page-item '.($i == 0 ? "active" : "").'" data-index="'.$i.'"><a class="page-link">'.($i+1).'</a></li>';
                                  }
                                ?>
                                <li class="page-item" data-index="next">
                                  <a class="page-link" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </li>
                              </ul>
                            </nav>
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

                        <form class="needs-validation row <?php if ($form_success){ echo "hidden"; }?>" action="./prax_api.php" method="post" enctype="multipart/form-data" id="form_student">

                            <div class="col-lg-8">

                                <div class="form-group">
                                    <label for="name">Ees- ja perekonnanimi</label>
                                    <input required type="text" class="form-control <?php if(!empty($_POST)) { if($name == "") { echo "is-invalid"; } else {echo "is-valid";} } ?>" id="name" name="name">
                                    <div class='invalid-feedback'>Palun lisa oma nimi</div>
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input required type="email" class="form-control <?php if(!empty($_POST)) { if($email_valid) { echo "is-valid"; }else{ echo "is-invalid"; } }?>" id="email" aria-describedby="emailHelp" name="email">
                                  <div class='invalid-feedback'>Vajame sinu meiliaadressi, et sulle kinnituslink saata</div>
                                </div>
                                <div class="form-group">
                                    <label for="work">Eriala</label>
                                    <input required type="text" class="form-control <?php if(!empty($_POST)) { if($major != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="major" name="major">
                                  <div class='invalid-feedback'>Palun anna ettevõttele teada, mis eriala sa õpid</div>
                                </div>
                            </div>
                          
                          <div class="col-lg-4">
                                <div class="form-group">
                                    <!--<img src="../userdata/blank_profile_pic.png" id="profileImg">-->
                                    <label for="pilt" class="<?php if(!empty($_POST)) { if(!$pic_success) { echo "is-invalid"; } } ?>">Pilt</label>
                                    <!--<input type="file" onchange="previewFile()"><br>-->
                                  <div id="preview">
                                    <img id="profileImg" src="../userdata/blank_profile_pic.png" height="200" alt="Image preview...">
                                  </div>
                                  <div class="upload-btn-wrapper">
                                    <button class="btn">Lae ülesse oma profiili pilt</button>
                                    <input type="file" accept="image/*" class="form-control-file <?php if(!empty($_POST)) { if(!$cv_success) { echo "is-invalid"; } } ?>" id="pilt" name="pilt_full" onchange="previewFile()">
                                    <div class='invalid-feedback'>Lae profiilipilt!</div>
                                  </div>

                                    <!--<div class="dropzone" id="my-awesome-dropzone" name="pilt"></div>-->
                                    <div class='invalid-feedback'>Sisesta pilt!</div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="work">Instituut</label>
                                    <input required type="text" class="form-control <?php if(!empty($_POST)) { if($institute != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="institute" name="institute">
                                    <div class='invalid-feedback'>Ole hea ja anna teada, mis instituudist sa oled</div>
                                </div>
                                <div class="form-group">
                                    <label for="work">Soovitav praktika/töö valdkond</label>
                                    <input required type="text" class="form-control <?php if(!empty($_POST)) { if($work != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="work" name="work">
                                    <div class='invalid-feedback'>Ära unusta märkida, mis valdkonnas soovid töötada</div>
                                </div>
                                <div class="form-group">
                                    <label for="oskused">Tugevused/oskused</label>
                                    <textarea required class="form-control  <?php if(!empty($_POST)) { if($work != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="oskused" rows="3" name="oskused"></textarea>
                                    <div class='invalid-feedback'>Palun anna ettevõttele teada, mis eriala sa õpid</div>
                                </div>
                                <div class="form-group">
                                    <label for="kogemused">Kogemused</label>
                                    <textarea class="form-control" id="kogemused" rows="3" name="kogemused"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="location">Soovitud asukoht</label>
                                    <input type="text" class="form-control <?php if(!empty($_POST)) { if($location != "") { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="location" name="location">
                                </div>
                                <div class="form-group text-center">
                                    <div class="upload-btn-wrapper">
                                      <button class="btn">Lae ülesse oma CV</button>
                                      <input type="file" class="form-control-file <?php if(!empty($_POST)) { if(!$cv_success) { echo "is-invalid"; } } ?>" id="cv" name="cv" onchange="showFileName(this.files)">
                                      <div class='invalid-feedback'>Lae ülesse oma CV</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input <?php if(!empty($_POST)) { if($checkpoint) { echo "is-valid"; }else{ echo "is-invalid"; } } ?>" id="checkpoint" name="checkpoint" required="required">
                                        <label class="custom-control-label" for="checkpoint">Olen teadlik, et andmeid näidatakse avalikult…*</label>
                                    </div>
                                </div>
                              <button id="submit-all" type="submit" class="mt-3 text-center text-uppercase btn btn-lg btn-primary font-weight-light js-ajax" data-value="add">Lisa profiil</button>
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
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <script>
      //Dropzone.autoDiscover = false;
      // Global FormData

      var blobImg;
      try{

      }catch(err){
        console.log(err);
      }
        $(document).ready(function() {
            $('.js-modal').on('click', openModal);
            $('.js-open-cv').on('click', openCV);
            $('.js-ajax').on('click', function(e) {
                ajaxSubmit(e);
            });
            $( ".flip-div" ).click(function() {
                $( this ).toggleClass( "hover" );
            });
            
            $('.pagination .page-item').on('click', paginatorClick);
            $('#carouselPager').carousel({
                interval: false,
                wrap: false
            });
            $('#carouselPager').on('slide.bs.carousel', function(e){
                $('.pagination .page-item').eq(e.from+1).toggleClass('active');
                $('.pagination .page-item').eq(e.to+1).toggleClass('active');
            });
            
        });
        
        function paginatorClick(e){
            console.log('moving');
            var carousel = $('#carouselPager');
            var target = $(e.currentTarget);
            var index = target.data('index');
            carousel.carousel(index);
        }

        function openCV(e) {
            var modal = $('.modal-cv').first();
            var target = $(e.currentTarget);
            var cvpath = $(target).data('cv');

            var cvembed = $('<embed>').attr({'src':cvpath+'#toolbar=0','type':'application/pdf'}).css('width', '100%').css('min-height', '512px').html('<div class="alert alert-warning">Antud veebilehtiseja ei toeta PDFi avamist aknas. Palun lae PDF alla <a href="'+cvpath+'" target="_blank"><strong>siit</strong>.</a></div>');
            modal.find('.modal-body').empty();
            modal.find('.modal-body').html(cvembed);

            modal.modal('show');
        }

        function openModal(e) {
            if (e !== undefined && e.target !== this)
                return;
            var modal = $('.modal').first();
            modal.modal('show');

            /*var myDropzone = new Dropzone("#my-awesome-dropzone", {
              paramName: "pilt",
              autoProcessQueue: false,
              url: "./prax_api.php",
              parallelUploads: 3,
              maxFiles: 1,
              addRemoveLinks: true,
              dictDefaultMessage: "Lae oma pilt ülesse siit!",
              dictRemoveFile: "Eemalda pilt",
              dictMaxFilesExceeded: "Lubatud on vaid üks pilt",
              dictInvalidFileType: "Lubatud vaid pildifailid",
              acceptedFiles: "image/jpg, image/png",
              dictFileTooBig: "Lisatud {{filename}} ületab lubatud {{maxFilesize}} suurust.",
              maxFilesize: 5,
              thumbnailWidth: 200,
              thumbnailHeight: 200,
              thumbnailMethod: 'contain',
              resizeWidth: 256,
              resizeMimeType: 'image/jpeg',
              resizeMethod: 'contain',
              resizeQuality: 0.7,

              transformFile: function(file, done) {
                var myDropZone = this;
                // Create the image editor overlay
                var editor = document.createElement('div');
                editor.classList.add("cropper-overlay");
                // Create the confirm button
                var confirm = document.createElement('button');
                confirm.textContent = 'Lõika';
                confirm.classList.add("btn");
                confirm.classList.add("btn-primary");
                confirm.classList.add("text-uppercase");
                confirm.classList.add("btn-cropper-overlay");

                confirm.addEventListener('click', function() {
                  // Get the canvas with image data from Cropper.js
                  var canvas = cropper.getCroppedCanvas({
                    width: 256,
                    height: 256
                  });

                  // Turn the canvas into a Blob (file object without a name)
                  canvas.toBlob(function(blob) {
                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                      blob,
                      myDropZone.options.thumbnailWidth,
                      myDropZone.options.thumbnailHeight,
                      myDropZone.options.thumbnailMethod,
                      false,
                      function(dataURL) {
                        // Update the Dropzone file thumbnail
                        myDropZone.emit('thumbnail', file, dataURL);
                        // Return modified file to dropzone
                        done(blob);
                      }
                    );
                  });
                  // Remove the editor from view
                  editor.parentNode.removeChild(editor);
                });
                editor.appendChild(confirm);
                // Load the image
                var image = new Image();
                image.src = URL.createObjectURL(file);
                editor.appendChild(image);
                // Append the editor to the page
                document.body.appendChild(editor);
                // Create Cropper.js and pass image
                var cropper = new Cropper(image, {
                  aspectRatio: 1
                });
              } ,
                // The setting up of the dropzone
              init: function() {
                var myDropzoneInit = this;

                // First change the button to actually tell Dropzone to process the queue.
                document.getElementById("submit-all").addEventListener("click", function(e) {
                  // Make sure that the form isn't actually being sent.
                  //let formData = new FormData(document.getElementById('form_student'));
                  e.preventDefault();
                  e.stopPropagation();
                  myDropzoneInit.processQueue();
                });

                this.on("sending", function(file, xhr, formData) {

                  var action = $('.js-ajax').data("value");
                  formData.append("action", action);

                  var data = $('#form_student').serializeArray();
                  $.each(data, function(key, el) {
                      formData.append(el.name, el.value);
                  });
                  // Have to add CV file seperately in order to POST it with others
                  var cv = document.getElementById("cv");
                  formData.append("cv", cv.files[0]);
                });

                this.on("success", function(file, response) {
                  var form = $('#form_student');

                  console.log(response);
                  form.before('<div class="alert alert-success alert-dismissible fade show" role="alert">\
                                <strong>Aitäh!</strong> Teie emailile tuleb postituse aktiveerimislink!\
                                <button type="button" class="close" data-dismiss="alert" aria-label="Sulge">\
                                  <span aria-hidden="true">&times;</span>\
                                </button>\
                              </div>');
                  form.css('display', 'none');
                  form.trigger("reset");
                  setTimeout(function() {modal.modal("hide");},3000);
                });

               this.on("error", function(file, response) {
                 console.log(response);
                  var form = $('#form_student');
                  form.addClass('was-validated');
                  form.before('<div class="alert alert-danger alert-dismissible fade show" role="alert">\
                              <strong>Viga!</strong> ' + response + '\
                              <button type="button" class="close" data-dismiss="alert" aria-label="Sulge">\
                                <span aria-hidden="true">&times;</span>\
                              </button>\
                            </div>');
               });
                this.on("addedfile", function(file) {
                  console.log("A file was just added");
                });

              }
            });*/
        }
      function ajaxSubmit(e) {
            var action = $(e.currentTarget).data("value");
            var form = $('#form_student');
            e.preventDefault();
            e.stopPropagation();
        let formData = new FormData(document.getElementById('form_student'));
            formData.append("action", action);
            /*var data = $('#form_student').serializeArray();
            $.each(data, function(key, el) {
              if (el.value == "") {
                // If value empty then do not append
              } else {
                formData.append(el.name, el.value);
              }
            });*/
            formData.delete("pilt_full");
            formData.append("pilt",blobImg,"profilepic.jpg");
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
                form.trigger("reset");
                setTimeout(function() {modal.modal("hide");},3000);
            }).fail(function(response) {
                console.log(response);
                form.addClass('was-validated');
                form.before('<div class="alert alert-danger alert-dismissible fade show" role="alert">\
                              <strong>Viga!</strong> ' + response + '\
                              <button type="button" class="close" data-dismiss="alert" aria-label="Sulge">\
                                <span aria-hidden="true">&times;</span>\
                              </button>\
                            </div>');
            });
        }

      function showFileName(files) {
        try {
          var fname = document.getElementById("cv-upload-data");
          fname.innerHTML = files[0].name +" ("+ (files[0].size/1024).toFixed(2) + "KB)";
          document.getElementById("cv").parentElement.appendChild(fname);
        } catch(err) {
          var fname = document.createElement("div");
          fname.classList.add("pt-3");
          fname.id = "cv-upload-data";
          fname.innerHTML = files[0].name +" ("+ (files[0].size/1024).toFixed(2) + "KB)";
          document.getElementById("cv").parentElement.appendChild(fname);
        }
      }
      
      function previewFile() {
        var preview = document.querySelector('#preview');
        var files   = document.querySelector('input[type=file]').files[0];

        function readAndPreview(file) {
          // Make sure `file.name` matches our extensions criteria
          if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
            var reader = new FileReader();
            reader.addEventListener("load", function () {
              var image = document.getElementById('profileImg');
              image.height = 100;
              image.title = file.name;
              image.src = this.result;
              preview.appendChild( image );
            }, false);
            reader.readAsDataURL(file);
          }
        }
        if (files) {
          readAndPreview(files);
          var editor = document.createElement('div');
          editor.classList.add("cropper-overlay");
          // Create the confirm button
          var confirm = document.createElement('button');
          confirm.textContent = 'Kärbi';
          confirm.classList.add("btn");
          confirm.classList.add("btn-primary");
          confirm.classList.add("text-uppercase");
          confirm.classList.add("btn-cropper-overlay");

          confirm.addEventListener('click', function() {
            // Get the canvas with image data from Cropper.js
            var canvas = cropper.getCroppedCanvas({
              width: 256,
              height: 256
            });

            // Turn the canvas into a Blob (file object without a name)
            canvas.toBlob(function(blob) {
              // Set #profileImg src to blob and use blobImg global to use later in formData
              document.getElementById('profileImg').src = URL.createObjectURL(blob);
              blobImg = blob;
            });
            // Remove the editor from view
            editor.parentNode.removeChild(editor);
          });
          editor.appendChild(confirm);
          // Load the image
          var image = new Image();
          image.src = URL.createObjectURL(files);
          editor.appendChild(image);
          // Append the editor to the page
          document.body.appendChild(editor);
          // Create Cropper.js and pass image
          var cropper = new Cropper(image, {
            aspectRatio: 1
          });
        }
      }

    </script>

</body>

</html>
