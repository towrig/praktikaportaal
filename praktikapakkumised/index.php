<!DOCTYPE html>
<html lang="en">
<?php
  $title="Praktikapakkumised |";
  $description = "Otsid praktikanti või tulevast töötajat? Lisa praktikapakkumine ja näita ennast motiveeritud tööandjana. Praktika on suurepärane võimalus koostööks ülikooliga, et leida parimaid tulevasi töötajaid.";
  include_once './../templates/header.php';
?>

<body id="page-top" class="practiceoffers">
    <?php include_once './../templates/top-navbar.php';?>
    <div id="main"></div>
    <div id="page-content">
        <section class="page-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="text-uppercase font-weight-bold mt-5 mb-3" data-aos="fade-right">Praktika&shy;pakkumised</h1>
                    </div>
                    <div class="col-lg-3">
                        <p class="font-weight-light mb-5" data-aos="fade-right"><?php echo $description; ?></p>
                    </div> <!-- .col-->
                    <div class="col-lg-2" data-aos="fade-in-right">
                        <a id="formToggler" class="toggleMenu text-uppercase" onclick="gtag('event', 'Ava',{'event_category': 'Praktikapakkumised','event_label':'Ava lisa pakkumine'});">Lisa pakkumine</a>
                    </div>
                    <div class="col-lg-12">
                        <h5 class="text-uppercase text-center font-weight-bold mt-5" data-aos="fade-down">Aktiivsed pakkumised</h5>
                    </div>
                </div> <!-- .row -->
            </div> <!-- .container -->
        </section>


        <section class="mb-5" id="profiles">
            <div class="container" data-aos="fade-down">
                <div class="row">
                    <div id="carouselPager" class="carousel slide col-md-12">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <?php

                        function truncate($text, $chars = 25) {
                            if (strlen($text) <= $chars) {
                                return $text;
                            }
                            $text = $text." ";
                            $text = substr($text,0,$chars);
                            $text = substr($text,0,strrpos($text,' '));
                            $text = $text."...";
                            return $text;
                        }

                        try {
                            $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser , $dbpassword);
                            // set the PDO error mode to exception
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $query = $conn->prepare('SELECT * FROM WorkPosts WHERE isvalidated = ? AND end_date >= NOW() ORDER BY id DESC');
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
                                
                                $id = $row["id"];
                                $validationcode = $row["validationcode"];
                                $picurl = "../userdata/pictures/".$row["logopath"];
                                //$uploaded = date('d\<\b\r\>M\<\b\r\>Y', strtotime($row["datetime_uploaded"]));
                                setlocale(LC_TIME, "et_EE.utf8");
                                $uploaded = strftime('%d<br>%b<br>%Y', strtotime($row["datetime_uploaded"]));
                                $reg_end = ($row["end_date"]!="0000-00-00 00:00:00")?date('d.m.Y',strtotime($row["end_date"])):"-";
                                $views = $row["views"];
                                
                                if($queue){
                                    echo '</div><div class="carousel-item">';
                                    $queue = false;
                                    $pages++;
                                }

                                $bigstring = '<div class="col-lg-12 practiceoffer" data-aos="fade-down">
                                                <div class="row">
                                                  <div class="col-lg-1 col-md-1 col-sm-1 text-uppercase font-weight-bold work-date-added">
                                                    <p>'.$uploaded.'</p>
                                                  </div>
                                                    <div class="col-lg-2 col-md-11 col-sm-11 work-banner-crop">
                                                      <img src="'.$picurl.'" alt="Ettevõtte logo">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a class="js-view-modal" href="javascript:void(0);"
                                                          data-id="'.$id.'"
                                                          data-pic="'.$picurl.'"
                                                          data-heading="'.$heading.'"
                                                          data-description="'.htmlspecialchars($description).'"
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
                                                          data-reg_end="'.$reg_end.'">
                                                          <h6 class="text-uppercase font-weight-bold mt-0">'.$heading.'</h6>
                                                        </a>
                                                        <pre class="m-0 p-0 card-text font-weight-light">'.truncate(strip_tags($description), 128).'</pre>
                                                    </div>
                                                  <div class="col-lg-3 col-7">
                                                    <p class="m-0 p-0 font-weight-light"><b>Pakkuja:</b> '.$work_name.'</p>
                                                    <p class="m-0 p-0 font-weight-light"><b>Asukoht:</b> '.$location.'</p>
                                                    <p class="m-0 p-0 font-weight-light"><b>Tähtaeg:</b> '.$reg_end.'</p>
                                                  </div>
                                                  <div class="col-lg-2 text-center apply col-5">
                                                    <a class="text-uppercase js-view-modal font-weight-bold" onclick="gtag(\'event\', \'Vaata\',{\'event_category\': \'Praktikapakkumised\',\'event_label\':\'Vaata modaali\'});"  href="javascript:void(0);"
                                                          data-id="'.$id.'"
                                                          data-pic="'.$picurl.'"
                                                          data-heading="'.$heading.'"
                                                          data-description="'.htmlspecialchars($description).'"
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
                                                          data-reg_end="'.$reg_end.'">Vaata</a>
                                                    <p class="mt-1">Vaatamisi <span class="views font-weight-bold">'.$views.'</span></p>
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

                            <div class="col-lg-7">
                                <div class="form-group">
                                    <p class="alert alert-warning font-weight-normal">Futulab on vabatahtlik praktika keskkond. Kõik vormi sisestatud isikuandmed avalikustatakse kodulehel.</p>
                                    <label for="name">Kuulutuse pealkiri *</label>
                                    <input required type="text" class="form-control" id="heading" name="heading">
                                    <div class='invalid-feedback'>Palun lisa pealkiri</div>
                                </div>
                                <div class="form-group my-1">
                                    <label class="mr-sm-2">Valdkond *</label>
                                    <select class="custom-select mr-sm-2" id="workfield" name="workfield">
                                        <option value="Määramata" selected>Määramata</option>
                                        <option value="Arvestusala">Arvestusala</option>
                                        <option value="Ehitus">Ehitus</option>
                                        <option value="Energeetika ja kaevandamine">Energeetika ja kaevandamine</option>
                                        <option value="Haridus ja teadus">Haridus ja teadus</option>
                                        <option value="Info- ja kommunikatsioonitehnoloogia">Info- ja kommunikatsioonitehnoloogia</option>
                                        <option value="Kaubandus, rentimine ja parandus">Kaubandus, rentimine ja parandus</option>
                                        <option value="Keemia-, kummi-, plasti- ja ehitusmaterjalitööstus">Keemia-, kummi-, plasti- ja ehitusmaterjalitööstus</option>
                                        <option value="Kultuur ja loometegevus">Kultuur ja loometegevus</option>
                                        <option value="Majutus, toitlustus ja turism">Majutus, toitlustus ja turism</option>
                                        <option value="Metalli- ja masinatööstus">Metalli- ja masinatööstus</option>
                                        <option value="Metsandus ja puidutööstus">Metsandus ja puidutööstus</option>
                                        <option value="Õigus">Õigus</option>
                                        <option value="Personali- ja administratiivtöö ning ärinõustamine">Personali- ja administratiivtöö ning ärinõustamine</option>
                                        <option value="Põllumajandus ja toiduainetööstus">Põllumajandus ja toiduainetööstus</option>
                                        <option value="Rõiva-, tekstiili- ja nahatööstus">Rõiva-, tekstiili- ja nahatööstus</option>
                                        <option value="Sotsiaaltöö">Sotsiaaltöö</option>
                                        <option value="Tervishoid">Tervishoid</option>
                                        <option value="Transport, logistika ning mootorsõidukid">Transport, logistika ning mootorsõidukid</option>
                                        <option value="Vee- ja jäätmemajandus ning keskkond">Vee- ja jäätmemajandus ning keskkond</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="website">Pakkumise link</label>
                                    <input type="text" class="form-control" id="website" name="website">
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="pilt" class="">Logo</label>
                                    <div id="preview">
                                        <img id="profileImg" src="../userdata/blank_profile_pic.png" height="200" alt="Image preview...">
                                    </div>
                                    <div class="upload-btn-wrapper">
                                        <button class="btn">Lae üles oma organisatsiooni logo *</button>
                                        <input required type="file" accept="image/*" class="form-control-file" id="pilt" name="pilt_full" onchange="previewFile()">
                                    </div>
                                    <div class='invalid-feedback'>Sisesta logo!</div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group text-center">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn">Lae üles töökuulutus PDF formaadis</button>
                                        <input type="file" name="post_pdf" id="post_pdf" onchange="showFileName(this.files)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Pakkumise tutvustus *</label>
                                    <textarea required class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <div class="form-group pdf-hide">
                                    <label for="tasks">Ülesanded</label>
                                    <textarea class="form-control" id="tasks" name="tasks" rows="3"></textarea>
                                </div>
                                <div class="form-group pdf-hide">
                                    <label for="skills">Ootused</label>
                                    <textarea class="form-control" id="skills" name="skills" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="work">Tähtaeg *</label>
                                    <input required type="text" class="form-control" id="datepicker" name="date">
                                </div>
                                <div class="form-group">
                                    <label for="organization">Ettevõte *</label>
                                    <input required type="text" class="form-control" id="organization" name="organization">
                                </div>
                                <div class="form-group">
                                    <label for="work">Kontaktisiku nimi *</label>
                                    <input required type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Kontaktemail *</label>
                                    <input required type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                                    <div class='invalid-feedback'>Vajame sinu meiliaadressi, et sulle kinnituslink saata</div>
                                </div>
                                <div class="form-group">
                                    <label for="location">Asukoht *</label>
                                    <input required type="text" class="form-control" id="location" name="location">
                                </div>
                                <div class="form-group">
                                    <label for="other">Info kandideerimiseks</label>
                                    <textarea class="form-control" id="other" name="other" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkpoint" name="checkpoint" required="required">
                                        <label class="custom-control-label text-left" for="checkpoint">Olen teadlik, et kõik vormi sisestatud isikuandmed avalikustatakse Futulabi kodulehel. Tutvu andmekaitsetingimustega <a href="<?php echo $wwwroot;?>andmekaitsetingimused" target="_blank">siit</a>.</label>
                                    </div>
                                </div>
                                <button id="submit-all" type="submit" class="mt-3 text-center text-uppercase btn btn-lg btn-primary font-weight-light js-ajax" onclick="gtag('event', 'Salvesta',{'event_category': 'Praktikapakkumised','event_label':'Lisa pakkumine'});">Lisa pakkumine</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sulge</button>
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

                            <div class="col-lg-7 col-info">
                                <h2 class="post-heading"></h2>
                                <h6><span class="post-org-name"></span></h6>
                                <h5 class="unmigrate">Tööülesanded ja ootused praktikandile *</h5>
                                <h5 class="migrate">Tutvustus</h5>
                                <div class="post-description"></div>
                                <h5 class="migrate">Tööülesanded</h5>
                                <div class="post-tasks migrate"></div>
                                <h5 class="migrate">Vajalikud oskused ja kogemused</h5>
                                <div class="post-skills migrate"></div>
                                <h5>Muu oluline info</h5>
                                <div class="post-other"></div>
                            </div>

                            <div class="col-lg-5 col-contact">
                                <div class="post-img-container"></div>
                                <h5>Tähtaeg</h5>
                                <div class="post-deadline"></div>
                                <h5>Asukoht</h5>
                                <div class="post-org-loc"></div>
                                <!--<h5 class="post-org-name"></h5>-->
                                <h5>Kontakt</h5>
                                <div class="post-contact-container">
                                    <span class="post-contact-name"></span>
                                    <span class="post-contact-email"></span>
                                    <span class="post-contact-phone"></span>
                                    <span class="post-org-website" style="overflow:hidden"></span>
                                </div>
                                <h5>Ettevõtte kirjeldus</h5>
                                <div class="post-org-description"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sulge</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include_once './../templates/footer.php';?>
    <script src="https://unpkg.com/cropperjs"></script>
    <script type="text/javascript">
        var blobImg;
        $(document).ready(function() {

            $('.toggleMenu').on('click', openRegModal);
            $('.js-view-modal').on('click', openViewModal);
            $('#submit-all').on('click', ajaxSubmit);

            //$('[data-toggle="tooltip"]').tooltip();
            $("#datepicker").datepicker({
                showWeek: true,
                dateFormat: 'dd-mm-yy'
            });

            // Text Editors
            /*
            $('#description').trumbowyg({
                autogrow: true
            });
            */
            $('.trumbowyg-button-pane').css('display', 'none');
            $('.trumbowyg-box').focusout(function(event) {
                $(this).find('.trumbowyg-button-pane').fadeOut(200);
            });
            $('.trumbowyg-box').focusin(function(event) {
                $(this).find('.trumbowyg-button-pane').fadeIn(200);
            });


            // Pagination
            $("#category").change(function() {

                if ($("#category").val() == "date") {
                    $("#date_order").show();
                    $("#locations").hide();
                } else {
                    $("#date_order").hide();
                    $("#locations").show();
                }
            });
            $('.pagination .page-item').on('click', paginatorClick);
            $('#carouselPager').carousel({
                interval: false,
                wrap: false
            });
            $('#carouselPager').on('slide.bs.carousel', function(e) {
                $('.pagination .page-item').eq(e.from + 1).toggleClass('active');
                $('.pagination .page-item').eq(e.to + 1).toggleClass('active');
            })

        });

        function paginatorClick(e) {
            var carousel = $('#carouselPager');
            var target = $(e.currentTarget);
            var index = target.data('index');
            carousel.carousel(index);
        }

        function openViewModal(e) {
            var target = $(e.currentTarget);
            var modal = $('#viewModal');

            //get values here
            var id = target.data('id');
            var pic = target.data('pic');
            var heading = target.data('heading');
            var description = $("<div/>").html(target.data('description')).text();
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
            var deadline = target.data('reg_end');

            //attach values
            $(".post-heading").html(heading);
            $(".post-description").html("<pre>" + description + "</pre>");
            $(".post-tasks").html("<pre>" + tasks + "</pre>");
            $(".post-skills").html("<pre>" + skills + "</pre>");
            $(".post-img-container").html("<img src='" + pic + "'>");
            $(".post-org-name").html(work_name);
            $(".post-org-loc").html(work_loc);
            $(".post-org-description").html("<pre>" + work_desc + "</pre>");
            $(".post-org-website").html("<a target='_blank' href='" + website + "'>" + website + "</a>");
            $(".post-contact-name").html(name);
            $(".post-contact-email").html(email);
            $(".post-contact-phone").html(phone);
            $(".post-other").html("<pre>" + other + "</pre>");
            $(".post-deadline").html(deadline);
            handleCookies(id);

            if (tasks == "" && skills == "") {
                $(".migrate").hide();
            } else {
                $(".migrate").show();
                $(".unmigrate").hide();
            }

            modal.modal('show');
        }

        function openRegModal() {
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
                form.after("<div class='alert alert-success'>Aitäh! Kontaktisiku emailile tuleb postituse aktiveerimislink!</div>");
                form.css('display', 'none');
                form.trigger("reset");
                setTimeout(function() {
                    modal.modal("hide");
                }, 3000);
            }).fail(function(response) {
                form.addClass('was-validated');
                form.before('<div class="alert alert-danger alert-dismissible fade show" role="alert">\
                              <strong>Viga!</strong> ' + response.responseText + '\
                              <button type="button" class="close" data-dismiss="alert" aria-label="Sulge">\
                                <span aria-hidden="true">&times;</span>\
                              </button>\
                            </div>');
            });
        }

        function handleCookies(id) {
            var val = getCookie(id);
            if (val == "" || val == "first")
                setCookie(id, "first");
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
                    aspectRatio: 1.77
                });
            }
        }

        function setCookie(cname, cvalue) {
            document.cookie = cname + "=" + cvalue + ";path=/";
            var formData = new FormData();
            formData.append("action", "addview");
            formData.append("id", cname);

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
            for (var i = 0; i < ca.length; i++) {
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

        function showFileName(files) {
              try {
                  var fname = document.getElementById("upload-data");
                  fname.innerHTML = files[0].name + " (" + (files[0].size / 1024).toFixed(2) + "KB)";
                  document.getElementById("post_pdf").parentElement.appendChild(fname);
                  $(".pdf-hide").hide();
              } catch (err) {
                  var fname = document.createElement("div");
                  fname.classList.add("pt-3");
                  fname.id = "upload-data";
                  fname.innerHTML = files[0].name + " (" + (files[0].size / 1024).toFixed(2) + "KB)";
                  document.getElementById("post_pdf").parentElement.appendChild(fname);
                  $(".pdf-hide").hide();
              }
          }

    </script>

</body>

</html>
