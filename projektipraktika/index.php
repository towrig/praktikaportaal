<!DOCTYPE html>
<html lang="en">
<?php
  $title="Projektid |";
  $description = "Otsid oma ideele lahendust? Lisa projekt ning meie moodustame tiimi, kus erinevate õppekavade üliõpilased koostöös aitavad leida parimaid lahendusi.";
  include_once './../templates/header.php';
?>

<body id="page-top" class="project">
    <?php include_once './../templates/top-navbar.php';?>
    <div id="main"></div>
    <div id="page-content">
        <section class="page-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="text-uppercase font-weight-bold mt-5 mb-3" data-aos="fade-right">Projektid</h1>
                    </div>
                    <div class="col-lg-4"  data-aos="fade-right">
                        <p class="font-weight-light">
                           <?php echo $description; ?>
                        </p>
                        <a href="#" class="text-uppercase font-weight-bold" onclick="timeTableModal(); gtag('event', 'Vaata ajakava',{'event_category': 'Projektid','event_label':'Vaata ajakava siit'});">Vaata ajakava siit!</a>
                    </div> <!-- .col-->

                    <div class="col-lg-2"  data-aos="zoom-in-right">
                        <span id="formToggler" class="toggleMenu text-uppercase" onclick="openModal(); gtag('event', 'Ava',{'event_category': 'Projektid','event_label':'Esita projekt'});">Esita projekt</span>
                    </div>
                    <div class="col-lg-12">
                        <h5 class="text-uppercase text-center font-weight-bold mt-3"  data-aos="fade-down">Esitatud projektid</h5>
                    </div>

                </div> <!-- .row -->
            </div> <!-- .container -->
        </section>


        <section class="mb-5" id="profiles">
            <div class="container"  data-aos="fade-down">
                <div class="row">
                    <div id="carouselPager" class="carousel slide col-md-12">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="">
                                    <div class="row">
                                        <?php
                                try {
                                    $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser , $dbpassword);
                                    // set the PDO error mode to exception
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $query = $conn->prepare('SELECT * FROM ProjectPosts WHERE isactivated = ?');
                                    $query->execute(array(1));
                                    $data = $query -> fetchAll();
                                    $j = 0;
                                    $max_per_page = 6;
                                    $pages = 1;
                                    $queue = false;
                                    $participants = array();
                                    foreach($data as $row){

                                        $title = $row["title"];
                                        $start_date = $row["start_date"];
                                        $id = $row["id"];

                                        $organisation = $row["organisation"];
                                        $org_name = $row["org_name"];
                                        $org_email = $row["org_email"];
                                        $pdf_path = $row["pdf_path"];
                                        $max_part = $row["max_part"];
                                        
                                        $query = $conn->prepare('SELECT * FROM ProjectParticipants WHERE project_id = ? AND is_accepted = 1');
                                        $query->execute(array($id));
                                        $data = $query -> fetchAll();
                                        $post_participants = array();
                                        $amount = 0;
                                        foreach($data as $row){
                                            $p = array($row["name"], $row["email"], $row["degree"], $row["skills"]);
                                            array_push($post_participants, $p);
                                            $amount++;
                                        }
                                        $participants[$id] = $post_participants;
                                        if($queue){
                                            echo '</div></div></div><div class="carousel-item"><div class="container"><div class="row">';
                                            $queue = false;
                                            $pages++;
                                        }
                                        $bigstring = '
                                        <div class="col-md-4 js-modal"
                                        data-id="'.$id.'"
                                        data-pdf_path="'.$pdf_path.'"
                                        data-org_name="'.$org_name.'"
                                        data-org_email="'.$org_email.'"
                                        data-organisation="'.$organisation.'"
                                        data-title="'.$title.'"
                                        data-start_date="'.$start_date.'"
                                        data-max_part="'.$max_part.'"
                                        data-amount="'.$amount.'"
                                        >
                                            <div class="card mb-3 p-4">
                                <div class="row">
                                  <div class="col-md-12">
                                    <h6 class="text-uppercase">'.$title.'</h6>
                                  </div>
                                </div>
                                  <div class="card-footer pb-3">
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
                                      <a class="project-link font-weight-bold text-uppercase">
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
                                        $j++;
                                        if ($j == $max_per_page){
                                            $j = 0;
                                            $queue = true;
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

    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="./project_api.php" enctype="multipart/form-data" id="project_submission">
                                <nav class="nav nav-pills flex-column flex-sm-row " id="pills-tab" role="tablist">
                                    <a class="flex-sm-fill text-sm-center nav-link active text-uppercase text-weight-bold" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><span>Projektivorm</span></a>
                                    <a class="flex-sm-fill text-sm-center nav-link text-uppercase text-weight-bold" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><span>Esita projekt</span></a>
                                </nav>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="form-group">
                                            <p class="mt-4">Antud aknas saad kiirelt tutvuda ning eelvaadelda projekti taotlusvormi, mille palume järgnevalt allalaadida ning ka ära täita. Seejärel palume liikuda järgmisele viigule "Esita projekt" ning täita sealne kontaktvorm, et saaksime teiega vajadusel ühendust võtta ning lõpetuseks ootame eeltäitud vormi PDF kujul."

                                            </p>
                                            <h4 class="text-center my-3">
                                                <!--<i class="fa fa-4x fa-download"></i>--><label>Projektivormi allalaadimiseks vajuta <a class="btn btn-lg btn-primary" href="../userdata/projekti_taotlusvorm.docx" download="" onclick="gtag('event', 'Lae alla',{'event_category': 'Projektid','event_label':'Lae alla projekti taotlusvorm'});">siia</a></label></h4>
                                            <iframe width="100%" height="500px" src="https://docs.google.com/document/d/e/2PACX-1vQFHziWjHPO9fMbDZu7l7TaLq7PFA8COQRc_pz0CludNNmuONrd0NkUokj_QvJQTXEj7Jq5-IZrdrej/pub?embedded=true"></iframe>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="form-group mt-3">
                                            <p class="alert alert-info font-weight-normal text-muted">Kõik vormi sisestatud isikuandmed avalikustatakse Futulabi kodulehel</p>
                                            <label>Projekti pealkiri</label>
                                            <input required type="text" name="project_title" class="form-control" maxlength="85">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Teie nimi</label>
                                                <!--<input type="text" name="project_org_name" class="form-control">-->
                                                <input required type="text" name="project_org_personal_name" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Teie email</label>
                                                <input required type="text" name="project_org_personal_email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label>Organisatsiooni nimi</label>
                                                <input required type="text" name="project_org_name" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Meeskonna suurus (max 10)</label>
                                                <select required name="max_part" class="form-control">
                                                    <option selected>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                    <option>6</option>
                                                    <option>7</option>
                                                    <option>8</option>
                                                    <option>9</option>
                                                    <option>10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <div class="upload-btn-wrapper">
                                                <button class="btn">Lae ülesse täidetud projektivorm PDF formaadis</button>
                                                <input required type="file" name="project_pdf" id="project_pdf">
                                            </div>

                                        </div>
                                      <div class="form-group">
                                          <div class="custom-control custom-checkbox">
                                              <input type="checkbox" class="custom-control-input" id="checkpoint" name="checkpoint" required="required">
                                              <label class="custom-control-label text-left" for="checkpoint">Olen teadlik, et kõik vormi sisestatud isikuandmed avalikustatakse Futulabi kodulehel. Tutvu privaatsuspoliitikaga <a href="<?php echo $wwwroot;?>privaatsuspoliitika" target="_blank">siit</a>.</label>
                                          </div>
                                      </div>
                                        <div class="form-group mt-3 text-center">
                                            <input type="submit" name="submit-form" class="text-center text-uppercase btn btn-lg" onclick="gtag('event', 'Salvesta',{'event_category': 'Projektid','event_label':'Esita projekt'});" value="Esita projekt" id="regButton">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                 <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sulge</button>
                            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="timeTableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <iframe width="100%" height="500px" src="https://docs.google.com/document/d/e/2PACX-1vT7B16RNai2EJQrSf8PDTHWFiGHwrQB_MF1jhhZwo61Ox9HWJDBlL_IEFBOkHnNzvczU7R1jAy1xOc4/pub?embedded=true"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sulge</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <nav class="nav nav-pills flex-column flex-sm-row " id="pills-tab" role="tablist">
                        <a class="flex-sm-fill text-sm-center nav-link active text-uppercase text-weight-bold" id="post-home-tab" data-toggle="pill" href="#post-home" role="tab" aria-controls="post-home" aria-selected="true"><span>Projekt</span></a>
                        <a class="flex-sm-fill text-sm-center nav-link text-uppercase text-weight-bold" id="post-participants-tab" data-toggle="pill" href="#post-participants" role="tab" aria-controls="post-participants" aria-selected="false"><span>Liitu</span></a>
                    </nav>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active row" id="post-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="col-lg-12">
                                <h2 class="post-heading"></h2>
                            </div>
                            <!-- join and contact-->
                            <div class="col-lg-4">
                                <p class="field-organiser"></p>
                                <p class="field-org_name"></p>
                                <p class="field-org_email"></p>
                            </div>
                            <div class="col-lg-12 pdf-container">
                            </div>
                        </div>
                        <div class="tab-pane fade show row" id="post-participants" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="col-lg-12 my-3">
                                <form class="needs-validation" id="project-join" method="POST" action="./project_api.php">
                                    <div class="form-group">
                                        <p class="alert alert-info font-weight-normal text-muted">Kõik vormi sisestatud isikuandmed avalikustatakse Futulabi kodulehel</p>
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
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkpoint" name="checkpoint" required="required">
                                            <label class="custom-control-label text-left" for="checkpoint">Olen teadlik, et kõik vormi sisestatud isikuandmed avalikustatakse Futulabi kodulehel. Tutvu privaatsuspoliitikaga <a href="<?php echo $wwwroot;?>privaatsuspoliitika" target="_blank">siit</a>.</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="hash" id="project_hash">
                                    <div class="join-container text-center">
                                        <button type="submit" class="btn btn-primary" id="joinButton">Liitu</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12"><h5 class="text-center">Liitunud üliõpilased: (<span class="field-participants"></span>)</h5></div>
                            <div class="col-lg-12 participants-container"><div class="container"><div class="row justify-content-center"></div></div></div>
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

    <script type="text/javascript">        
        $(document).ready(function() {
            $('#joinButton').on('click', joinProject);
            $('#regButton').on('click', ajaxSubmit);
            
            $('.js-modal').on('click', viewModal);

            $('[data-toggle="tooltip"]').tooltip();

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
        
        var participants = <?php echo json_encode($participants);?>;

        function paginatorClick(e) {
            var carousel = $('#carouselPager');
            var target = $(e.currentTarget);
            var index = target.data('index');
            carousel.carousel(index);
        }

        function ajaxSubmit(e) {
            e.preventDefault();
            e.stopPropagation();
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
                form.trigger("reset");
                form.after("<div class='alert alert-success'>Aitäh! Teie projekt kiidetakse heaks hiljemalt nädala jooksul.</div>");
                form.css('display', 'none');
            }).fail(function(response) {
                form.addClass('was-validated');
                form.after("<div class='alert alert-danger'>Ups! Midagi läks valesti registreerimisel:"+response.responseText+"</div>");
            });
        }
        
        function joinProject(e) {
            e.preventDefault();
            e.stopPropagation();
            var form = $('#project-join');
            var formData = new FormData(document.getElementById('project-join'));
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(function(response) {
                form.trigger("reset");
                form.after('<div class="alert alert-success alert-dismissible fade show">Projektiga liitumise kinnitus tuleb Teile emaili peale mõne päeva jooksul. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                form.css('display', 'none');
            }).fail(function(response) {
                form.addClass('was-validated');
                form.after('<div class="alert alert-danger alert-dismissible fade show">Ups! Midagi läks valesti registreerimisel.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            });
        }

        function openModal() {
            var modal = $('.modal').first();
            modal.modal('show');
        }

        function timeTableModal() {
            var modal = $('#timeTableModal');
            modal.modal('show');
        }

        function viewModal(e) {
            var target = $(e.currentTarget);
            var modal = $('#viewModal');
            var post_participants = participants[target.data("id")];
            modal.find('#project_hash').val(target.data("id"));

            //get vars
            var title = target.data("title");
            var start_date = target.data("start_date");
            var pdf_path = 'https://docs.google.com/viewer?url=http://praktika.ut.ee/userdata/projects/' + target.data("pdf_path");
            var org_name = target.data("org_name");
            var org_email = target.data("org_email");
            var organisation = target.data("organisation");
            var max_part = target.data("max_part");
            var amount = target.data("amount");

            //attach vars
            modal.find('.post-heading').html(title);
            modal.find('.field-organiser').html(organisation);
            modal.find('.field-org_name').html(org_name);
            modal.find('.field-org_email').html(org_email);
            modal.find('.field-participants').html(amount + "/" + max_part);
            if (amount < max_part) {
                modal.find('#project-join').show();
            }else{
                modal.find('#project-join').hide();
            }

            //attach pdf
            var pdf_embed = $('<iframe>').attr({
                'src': pdf_path + '&embedded=true',
                'type': 'application/pdf'
            }).css('width', '100%').css('min-height', '512px');
            modal.find('.pdf-container').empty();
            modal.find('.pdf-container').html(pdf_embed);

            //add participants
            var p_c = modal.find('.participants-container .container .row');
            p_c.empty();
            if (post_participants.length != 0) {
                for (var i = 0; i < post_participants.length; i++) {
                    p_c.append(createParticipant(post_participants[i]));
                }
            }
            modal.modal('show');
        }

        function createParticipant(arr) {
            var name = arr[0];
            var email = arr[1];
            var degree = arr[2];
            var skills = arr[3];
            return $('<div>').addClass("col-lg-3 participant m-2").html("<h6>" + name + "</h6>" + "<p>" + degree + "</p>");
        }

    </script>

</body>

</html>
