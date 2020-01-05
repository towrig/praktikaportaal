<!DOCTYPE html>
<html lang="en">
<?php $title="Praktikapakkumised"; include_once './../templates/header.php';?>
<body id="page-top" class="practiceoffers">
    <?php include_once './../templates/top-navbar.php';?>
    <div id="main"></div>
    <div id="page-content">
      <section class="page-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
               <h1 class="text-uppercase font-weight-bold mt-5 mb-3">Praktikapakkumised</h1>
            </div>
            <div class="col-lg-4">
              <p class="font-weight-light mb-5">Otsid praktikanti, töötajat või meeskonda? Lisa oma pakkumine või projektiidee juba täna!</p>
              <a href="#" class="text-uppercase font-weight-bold">Vaata rohkem siit!</a>
            </div> <!-- .col-->
            <div class="col-lg-2">
              <a id="formToggler" class="toggleMenu text-uppercase">Lisa pakkumine<!--<span class="tooltip_mark" data-toggle="tooltip" data-placement="right" title="Esitatud pakkumised aeguvad lõpptähtaja möödumisel">?</span>--></a>
            </div>
            <div class="col-lg-12">
              <h5 class="text-uppercase text-center font-weight-bold mt-3">Aktiivsed pakkumised</h5>
            </div>
          </div> <!-- .row -->
        </div> <!-- .container -->
      </section>

	
	<section id="profiles">
		<div class="container">
			<div class="row">
                <div id="carouselPager" class="carousel slide col-md-12">
                  <div class="carousel-inner">
                    <div class="carousel-item active">                    
                    <?php
                        try {
                            $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
                            // set the PDO error mode to exception
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $query = $conn->prepare('SELECT * FROM WorkPosts WHERE isvalidated = ?'); 
                            $query->execute(array(1));
                            $data = $query -> fetchAll();
                            
                            $j = 0;
                            $max_per_page = 5;
                            $pages = 1;
                            $queue = false;
                            foreach($data as $row){
                                
                                $heading = $row["heading"];
                                $description = $row["description"];
                                $tasks = $row["tasks"];
                                $skills = $row["experience"];
                                $work_name = $row["work_name"];
                                $work_desc = $row["work_description"];
                                $location = $row["work_location"];
                                $other = $row["other"];
                                $website = $row["work_website"];
                                $email = $row["email"];
                                $name = $row["name"];
                                $phone = $row["phone"];
                                
                                $validationcode = $row["validationcode"];
                                $picurl = "../userdata/pictures/".$row["logopath"];
                                $uploaded = date('d\<\b\r\>M\<\b\r\>Y', strtotime($row["datetime_uploaded"]));
                                $reg_end = $row["end_date"];
                                $views = $row["views"];
                                
                                if($queue){
                                    echo '</div><div class="carousel-item">';
                                    $queue = false;
                                    $pages++;
                                }

                                $bigstring = '<div class="col-lg-12 js-view-modal" 
                                                data-pic="'.$picurl.'"
                                                data-heading="'.$heading.'"
                                                data-description="'.$description.'"
                                                data-tasks="'.$tasks.'"
                                                data-skills="'.$skills.'"
                                                data-work_name="'.$work_name.'"
                                                data-work_desc="'.$work_desc.'"
                                                data-location="'.$location.'"
                                                data-other="'.$other.'"
                                                data-website="'.$website.'"
                                                data-email="'.$email.'"
                                                data-name="'.$name.'"
                                                data-phone="'.$phone.'"
                                                data-reg_end="'.$reg_end.'"
                                                >
                                                <div class="row">
                                                  <div class="col-lg-1 text-uppercase font-weight-bold">
                                                    <p>'.$uploaded.'</p>
                                                  </div>
                                                    <div class="col-lg-2 work-banner-crop">
                                                      <img src="'.$picurl.'" alt="Ettevõtte logo">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a>
                                                          <h6 class="text-uppercase font-weight-bold mt-0">'.$heading.'</h6>
                                                        </a>
                                                        <p class="m-0 p-0 card-text font-weight-light">'.$description.'</p>                                                          
                                                    </div>
                                                  <div class="col-lg-3">
                                                    <p class="m-0 p-0 font-weight-light"><b>Pakkuja:</b> '.$work_name.'</p>
                                                    <p class="m-0 p-0 font-weight-light"><b>Asukoht:</b> '.$location.'</p>
                                                    <p class="m-0 p-0 font-weight-light"><b>Tähtaeg:</b> '.$reg_end.'</p>
                                                  </div>
                                                  <div class="col-lg-2 text-center apply">
                                                    <a class="text-uppercase font-weight-bold">Kandideeri</a>
                                                    <p>Vaatamisi <span class="views font-weight-bold">'.$views.'</span></p>
                                                  </div>
                                                </div>
                                              </div>';

                                echo $bigstring;
                                $j++;
                                if ($j == $max_per_page){
                                    $j = 0;
                                    $queue = true;
                                }
                            }

                        } catch(PDOException $e){
                            echo "Connection failed: " . $e->getMessage();
                        }
                    ?>
                    </div>
                  </div>
                </div>
                <nav aria-label="Pager" class="col-md-12 mt-5">
                  <ul class="pagination justify-content-center">
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
	</section>
	
	</div>

    <div id="main">
    </div>

    <!-- modals -->
    <div id="regModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="container">

                        <form class="needs-validation row" action="./work_api.php" method="post" enctype="multipart/form-data" id="form_work">

                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="name">Kuulutuse pealkiri</label>
                                    <input required type="text" class="form-control" id="heading" name="heading">
                                    <div class='invalid-feedback'>Palun lisa pealkiri</div>
                                </div>
                                <div class="form-group">
                                    <label for="organization">Organisatsioon</label>
                                    <input required type="text" class="form-control" id="organization" name="organization">
                                    <div class='invalid-feedback'>Palun lisage teie organisatsiooni nimi</div>
                                </div>
                                <div class="form-group">
                                    <label for="work">Registreerimise lõpptähtaeg</label>
                                    <input required type="text" class="form-control" id="datepicker" name="date">
                                    <div class='invalid-feedback'>Palun sisestage registreerimise lõpptähtaeg</div>
                                </div>
                                <div class="form-group">
                                    <label for="work">Teie nimi</label>
                                    <input required type="text" class="form-control" id="name" name="name">
                                    <div class='invalid-feedback'>Palun sisestage oma nimi</div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Teie e-mail</label>
                                    <input required type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                                    <div class='invalid-feedback'>Vajame sinu meiliaadressi, et sulle kinnituslink saata</div>
                                </div>
                                <div class="form-group">
                                    <label for="work">Teie telefoninumber</label>
                                    <input required type="text" class="form-control" id="phone" name="phone">
                                    <div class='invalid-feedback'>Palun sisestage oma nimi</div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="pilt" class="">Pilt</label>
                                    <div id="preview">
                                        <img id="profileImg" src="../userdata/blank_profile_pic.png" height="200" alt="Image preview...">
                                    </div>
                                    <div class="upload-btn-wrapper">
                                        <button class="btn">Lae ülesse oma organisatsiooni logo</button>
                                        <input type="file" accept="image/*" class="form-control-file" id="pilt" name="pilt_full" onchange="previewFile()">
                                    </div>
                                    <div class='invalid-feedback'>Sisesta logo!</div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="work_desc">Organisatsiooni tutvustus</label>
                                    <textarea required class="form-control" id="work_desc" name="work_desc" rows="3"></textarea>
                                    <div class='invalid-feedback'>Palun anna ettevõttele teada, mis eriala sa õpid</div>
                                </div>
                                <div class="form-group">
                                    <label for="website">Veebiaadress</label>
                                    <input required type="text" class="form-control" id="website" name="website">
                                    <div class='invalid-feedback'>Ära unusta märkida, mis valdkonnas soovid töötada</div>
                                </div>
                                <div class="form-group">
                                    <label for="location">Asukoht</label>
                                    <input required type="text" class="form-control" id="location" name="location">
                                    <div class='invalid-feedback'>Ole hea ja anna teada, kus töökoht asub</div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Töökoha tutvustus</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tasks">Tööülesanded</label>
                                    <textarea class="form-control" id="tasks" name="tasks" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="skills">Vajalikud oskused ja kogemused</label>
                                    <textarea class="form-control" id="skills" name="skills" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="other">Muu oluline info</label>
                                    <textarea class="form-control" id="other" name="other" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkpoint" name="checkpoint" required="required">
                                        <label class="custom-control-label" for="checkpoint">Olen teadlik, et andmeid näidatakse avalikult…*</label>
                                    </div>
                                </div>
                                <button id="submit-all" type="submit" class="mt-3 text-center text-uppercase btn btn-lg btn-primary font-weight-light js-ajax">Lisa pakkumine</button>
                            </div>

                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <div id="viewModal" class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-8 col-info">
                                <h2 class="post-heading"></h2>
                                <h5>Tutvustus</h5>
                                <p class="post-description"></p>
                                <h5>Tööülesanded</h5>
                                <p class="post-tasks"></p>
                                <h5>Vajalikud oskused ja kogemused</h5>
                                <p class="post-skills"></p>
                            </div>

                            <div class="col-lg-4 col-contact">
                                <div class="post-img-container"></div>
                                <h5>Kontakt</h5>
                                <span class="post-org-name"></span>
                                <span class="post-org-loc"></span>
                                <p class="post-org-description"></p>
                                <span class="post-org-website"></span>
                                <span class="post-contact-name"></span>
                                <span class="post-contact-email"></span>
                                <span class="post-contact-phone"></span>
                                <span class="post-other"></span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include_once './../templates/footer.php';?>
    <script src="https://unpkg.com/cropperjs"></script>
    <script type="text/javascript">
    	$(document).ready(function(){

    		$('.toggleMenu').on('click', openRegModal);
            $('.js-view-modal').on('click', openViewModal);
            $('#submit-all').on('click', ajaxSubmit);
          
            //$('[data-toggle="tooltip"]').tooltip();
            $("#datepicker").datepicker({
              showWeek: true,
              dateFormat: 'dd-mm-yy'
            });
            
            //pagination
    		$("#category").change(function(){

    			if($("#category").val() == "date"){
    				$("#date_order").show();
    				$("#locations").hide();
    			}else{
    				$("#date_order").hide();
    				$("#locations").show();
    			}
    		});
            $('.pagination .page-item').on('click', paginatorClick);
            $('#carouselPager').carousel({
                interval: false,
                wrap: false
            });
            $('#carouselPager').on('slide.bs.carousel', function(e){
                $('.pagination .page-item').eq(e.from+1).toggleClass('active');
                $('.pagination .page-item').eq(e.to+1).toggleClass('active');
            })

    	});
        
        function paginatorClick(e){
            console.log('moving');
            var carousel = $('#carouselPager');
            var target = $(e.currentTarget);
            var index = target.data('index');
            carousel.carousel(index);
        }
        
        function openViewModal(e){
            var target = $(e.currentTarget);
    		var modal = $('#viewModal');

            //get values here
            var pic = target.data('pic');
            var heading = target.data('heading');
            var description = target.data('description');
            var tasks = target.data('tasks');
            var skills = target.data('skills');
            var other = target.data('other');
            var work_name = target.data('work_name');
            var work_desc = target.data('work_desc');
            var work_loc = target.data('location');
            var website = target.data('website');
    		var name = target.data('name');
    		var email = target.data('email');
            var phone = target.data('phone');
            
            //attach values
            $(".post-heading").html(heading);
            $(".post-description").html(description);
            $(".post-tasks").html(tasks);
            $(".post-skills").html(skills);
            console.log("pic: "+pic);
            $(".post-img-container").css("background-image", "url("+pic+")");
            $(".post-org-name").html(work_name);
            $(".post-org-loc").html(work_loc);
            $(".post-org-description").html(work_desc);
            $(".post-org-website").html(website);
            $(".post-contact-name").html(name);
            $(".post-contact-email").html(email);
            $(".post-contact-phone").html(phone);
            $(".post-other").html(other);
            
            handleCookies(email);
    		modal.modal('show');
        }
    	
        function openRegModal(){
    		var modal = $('#regModal');
    		modal.modal('show');
    	}
        function ajaxSubmit(e) {
            e.preventDefault();
            e.stopPropagation();
            var form = $('#form_work');
            var formData = new FormData(document.getElementById('form_work'));
            formData.append("action", "addpost");
            formData.delete("pilt_full");
            if (blobImg != undefined)
                formData.append("logo", blobImg, "profilepic.jpg");

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
                setTimeout(function() {
                    modal.modal("hide");
                }, 3000);
            }).fail(function(response) {
                console.log(response);
                form.addClass('was-validated');
                form.before('<div class="alert alert-danger alert-dismissible fade show" role="alert">\
                              <strong>Viga!</strong> ' + response.responseText + '\
                              <button type="button" class="close" data-dismiss="alert" aria-label="Sulge">\
                                <span aria-hidden="true">&times;</span>\
                              </button>\
                            </div>');
            });
        }
        
        function handleCookies(email){
            var val = getCookie(email);
            console.log(email+";"+val);
            if (val == "" || val == "first")
                setCookie(email, "first");
        }
        
        function previewFile() {
            var preview = document.querySelector('#preview');
            var files = document.querySelector('input[type=file]').files[0];

            function readAndPreview(file) {
                // Make sure `file.name` matches our extensions criteria
                if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    var reader = new FileReader();
                    reader.addEventListener("load", function() {
                        var image = document.getElementById('profileImg');
                        image.height = 100;
                        image.title = file.name;
                        image.src = this.result;
                        preview.appendChild(image);
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
        
        function setCookie(cname, cvalue) {
            document.cookie = cname + "=" + cvalue + ";path=/";
            var formData = new FormData();
            formData.append("action", "addview");
            formData.append("email", cname);
            $.ajax({
                type: 'POST',
                url: './work_api.php',
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(function(response) {
                console.log("added view!");
            }).fail(function(response) {
                console.log(response);
            });
        }
        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                  c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                  return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        
    </script>

</body>

</html>
