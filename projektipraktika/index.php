<!DOCTYPE html>
<?php
    include_once './../templates/header.php';
    $t_pieces = t(array("projektipak_title","projektipak_desc","forms_consent"),$dbhost,$dbname,$dbuser,$dbpassword);
    $title = $t_pieces["projektipak_title"];
    $description = $t_pieces["projektipak_desc"];
    $forms_consent = $t_pieces["forms_consent"];
    //for smaller buttons, unworthy of the database
    if($_SESSION["lang"] == "ee"){
        $arc_active = "Esitatud projektid";
        $arc_inactive = "Lõpetatud projektid";
        $add_project = "Esita projekt";
        $check_timetable = "Vaata ajakava siit!";
    }else{
        $arc_active = "Submitted projects";
        $arc_inactive = "Finished projects";
        $add_project = "Submit project";
        $check_timetable = "Check timetable here!";
    }
?>

<body id="page-top" class="project">
    <?php include_once './../templates/top-navbar.php';?>
    <div id="main"></div>
    <div id="page-content">
        <section class="page-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="text-uppercase font-weight-bold mt-5 mb-3" data-aos="fade-right"><?php echo $title;?></h1>
                    </div>
                    <div class="col-lg-4"  data-aos="fade-right">
                        <p class="font-weight-light">
                           <?php echo $description; ?>
                        </p>
                        <a href="#" class="text-uppercase font-weight-bold" onclick="timeTableModal(); gtag('event', 'Vaata ajakava',{'event_category': 'Projektid','event_label':'Vaata ajakava siit'});"><?php echo $check_timetable; ?></a>
                    </div> <!-- .col-->

                    <div class="col-lg-2"  data-aos="zoom-in-right">
                        <span id="formToggler" class="toggleMenu text-uppercase" onclick="openModal(); gtag('event', 'Ava',{'event_category': 'Projektid','event_label':'Esita projekt'});"><?php echo $add_project; ?></span>
                    </div>
                    <div class="col-lg-12">
                        <h5 class="text-uppercase text-center font-weight-bold mt-5"  data-aos="fade-down"><span class="arc-active active"><?php echo $arc_active; ?></span> / <span class="arc-inactive"><?php echo $arc_inactive; ?></span></h5>
                    </div>

                </div> <!-- .row -->
            </div> <!-- .container -->
        </section>


        <section class="mb-5 profiles-current" id="profiles">
            <div class="container" data-aos="fade-down">
                <div class="row">
                    <div id="carouselPager" class="carousel slide col-md-12">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="">
                                    <div class="row">
                                        <?php

                                        if($_SESSION["lang"] == "ee"){
                                            $sub_display_text = "Esitaja:";
                                            $org_display_text = "Asutus:";
                                            $team_display_text = "Meeskond:";
                                            $view_display_text = "Vaata";
                                        }else{
                                            $sub_display_text = "Submitter:";
                                            $org_display_text = "Organisation:";
                                            $team_display_text = "Team:";
                                            $view_display_text = "View";
                                        }

                                try {
                                    $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser , $dbpassword);
                                    // set the PDO error mode to exception
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $query = $conn->prepare('SELECT * FROM ProjectPosts WHERE isactivated = ? ORDER BY id DESC');
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
                                        
                                        $reg_result = 0;
                                        if($row["reg_start"] != null && $row["reg_end"] != null){
                                            $today = strtotime(date("Y/m/d"));
                                            $reg_opens = strtotime($row["reg_start"]);
                                            $reg_closes = strtotime($row["reg_end"]);
                                            echo "<!-- ".$reg_opens." < ".$today." > ".$reg_closes." -->";
                                            if ($today >= $reg_opens && $today < $reg_closes){
                                                $reg_result = 1;
                                            }
                                        }
                                        
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
                                        
                                        //temp, delete soon
                                        if($organisation == "Kogo galerii"){
                                            $amount = 7;
                                        }else if($id == 21){
                                            $amount = 5;
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
                                        data-reg_open="'.$reg_result.'"
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
                                          <p class="mb-0"><b>'.$sub_display_text.'</b> '.$org_name.'</p>
                                          <p class="mb-0"><b>'.$org_display_text.'</b> '.$organisation.'</p>
                                          <p class=""><b>'.$team_display_text.'</b> '.$amount.'/'.$max_part.' </p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-12">
                                      <a class="project-link font-weight-bold text-uppercase">
                                        '.$view_display_text.'
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

        <section class="mb-5 profiles-past" style="display:none">
            <div class="container" data-aos="fade-down">
                <div class="row">
                    <div id="carouselPager" class="carousel slide col-md-12">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="">
                                    <div class="row">
                                        <?php

                                        if($_SESSION["lang"] == "ee"){
                                            $sub_display_text = "Esitaja:";
                                            $org_display_text = "Asutus:";
                                            $team_display_text = "Meeskond:";
                                            $view_display_text = "Vaata";
                                        }else{
                                            $sub_display_text = "Submitter:";
                                            $org_display_text = "Organisation:";
                                            $team_display_text = "Team:";
                                            $view_display_text = "View";
                                        }

                                try {
                                    $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser , $dbpassword);
                                    // set the PDO error mode to exception
                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $query = $conn->prepare('SELECT * FROM ArchivedProjects ORDER BY id DESC');
                                    $query->execute(array());
                                    $data = $query -> fetchAll();
                                    $j = 0;
                                    $max_per_page = 6;
                                    $pages = 1;
                                    $queue = false;
                                    foreach($data as $row){

                                        $organisation = $row["organisation"];
                                        $org_name = $row["org_name"];
                                        $name = $row["name"];
                                        $goals = $row["goals"];
                                        $actions = $row["actions"];
                                        $results = $row["results"];

                                        if($queue){
                                            echo '</div></div></div><div class="carousel-item"><div class="container"><div class="row">';
                                            $queue = false;
                                            $pages++;
                                        }
                                        $bigstring = '
                                        <div class="col-md-4 js-modal-arc"
                                        data-org_name="'.$org_name.'"
                                        data-organisation="'.$organisation.'"
                                        data-title="'.$name.'"
                                        data-goals="'.$goals.'"
                                        data-actions="'.$actions.'"
                                        data-results="'.$results.'"
                                        >
                                            <div class="card mb-3 p-4">
                                <div class="row">
                                  <div class="col-md-12">
                                    <h6 class="text-uppercase">'.$name.'</h6>
                                  </div>
                                </div>
                                  <div class="card-footer pb-3">
                                    <div class="col-md-12">
                                      <div class="row">
                                        <div class="col-lg-12">
                                          <p class="mb-0"><b>'.$sub_display_text.'</b> '.$org_name.'</p>
                                          <p class="mb-0"><b>'.$org_display_text.'</b> '.$organisation.'</p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-12">
                                      <a class="project-link font-weight-bold text-uppercase">
                                        '.$view_display_text.'
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
                            <?php
                                if($_SESSION["lang"] == "ee"){
                                    $form_info_text = "Projektivorm";
                                    $form_intro_text = 'Antud aknas saad kiirelt tutvuda ning eelvaadelda projekti taotlusvormi, mille palume järgnevalt allalaadida ning ka ära täita. Seejärel palume liikuda järgmisele viigule "Esita projekt" ning täita sealne kontaktvorm, et saaksime teiega vajadusel ühendust võtta ning lõpetuseks ootame eeltäitud vormi PDF kujul.';
                                    $form_download_text = "Projektivormi allalaadimiseks vajuta ";
                                    $form_download_text_2 = "siia";
                                    $form_heading_text = "Projekti pealkiri *";
                                    $form_name_text = "Teie nimi *";
                                    $form_email_text = "Teie email *";
                                    $form_org_text = "Organisatsiooni nimi *";
                                    $form_team_text = "Meeskonna suurus (max 10) *";
                                    $form_pdf_text = "Lae üles täidetud projektivorm PDF formaadis *";
                                    $consent_form_area = "Olen teadlik, et kõik vormi sisestatud isikuandmed avalikustatakse Futulabi kodulehel. Tutvu adnmekaitsetingimustega ";
                                    $consent_link_text = "siit";
                                    $close_text = "Sulge";
                                    $iframe_link = "https://docs.google.com/document/d/e/2PACX-1vQFHziWjHPO9fMbDZu7l7TaLq7PFA8COQRc_pz0CludNNmuONrd0NkUokj_QvJQTXEj7Jq5-IZrdrej/pub?embedded=true";
                                    $dl_link = "../userdata/projekti_taotlusvorm.docx";
                                }
                                else{
                                    $form_info_text = "Project form";
                                    $form_intro_text = 'In this window you can look through the project form, download it and fill out. Next click on the submit project, fill the contact form, upload the previously filled project form in pdf and submit.';
                                    $form_download_text = "TO DOWNLOAD THE PROJECT FORM CLICK ";
                                    $form_download_text_2 = "HERE";
                                    $form_heading_text = "Project headline *";
                                    $form_name_text = "Your name *";
                                    $form_email_text = "Your e-mail *";
                                    $form_org_text = "Organisation name *";
                                    $form_team_text = "The size of the project team (max 10) *";
                                    $form_pdf_text = "Upload the filled project form in PDF format *";
                                    $consent_form_area = "I am aware that the personal data uploaded by users onto the form will be published on Futulab. Read the data protection policy ";
                                    $consent_link_text = "here";
                                    $close_text = "Close";
                                    $iframe_link = "https://docs.google.com/document/d/e/2PACX-1vQJMVD-6aqp8Cinqy8E_94m_xXDG3XMYlh-VAYBbt97IdJPWT8BpSSfMOGl8dy52g/pub?embedded=true";
                                    $dl_link = "../userdata/project_form.docx";
                                }
                            ?>
                            <form method="POST" action="./project_api.php" enctype="multipart/form-data" id="project_submission">
                                <nav class="nav nav-pills flex-column flex-sm-row " id="pills-tab" role="tablist">
                                    <a class="flex-sm-fill text-sm-center nav-link active text-uppercase text-weight-bold" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><span><?php echo $form_info_text; ?></span></a>
                                    <a class="flex-sm-fill text-sm-center nav-link text-uppercase text-weight-bold" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"><span><?php echo $add_project; ?></span></a>
                                </nav>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="form-group">
                                            <p class="mt-4">
                                                <?php echo $form_intro_text; ?>
                                            </p>
                                            <h4 class="text-center my-3">
                                                <!--<i class="fa fa-4x fa-download"></i>--><label><?php echo $form_download_text; ?><a class="btn btn-lg btn-primary" href="<?php echo $dl_link; ?>" download="" onclick="gtag('event', 'Lae alla',{'event_category': 'Projektid','event_label':'Lae alla projekti taotlusvorm'});"><?php echo $form_download_text_2; ?></a></label></h4>
                                            <iframe width="100%" height="500px" src="<?php echo $iframe_link; ?>"></iframe>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="form-group mt-3">
                                            <p class="alert alert-warning font-weight-normal"><?php echo $forms_consent; ?></p>
                                            <label><?php echo $form_heading_text; ?></label>
                                            <input required type="text" name="project_title" class="form-control" maxlength="85">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label><?php echo $form_name_text; ?></label>
                                                <!--<input type="text" name="project_org_name" class="form-control">-->
                                                <input required type="text" name="project_org_personal_name" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label><?php echo $form_email_text; ?></label>
                                                <input required type="text" name="project_org_personal_email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label><?php echo $form_org_text; ?></label>
                                                <input required type="text" name="project_org_name" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label><?php echo $form_team_text; ?></label>
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
                                                <button class="btn"><?php echo $form_pdf_text; ?></button>
                                                <input required type="file" name="project_pdf" id="project_pdf" onchange="showFileName(this.files)">
                                            </div>

                                        </div>
                                      <div class="form-group">
                                          <div class="custom-control custom-checkbox">
                                              <input type="checkbox" class="custom-control-input" id="checkpoint_projekt" name="checkpoint_projekt" required="required">
                                              <label class="custom-control-label text-left" for="checkpoint_projekt"><?php echo $consent_form_area; ?><a href="<?php echo $wwwroot;?>andmekaitsetingimused" target="_blank"><?php echo $consent_link_text; ?></a>.</label>
                                          </div>
                                      </div>
                                        <div class="form-group mt-3 text-center">
                                          <button type="submit" name="submit-form" class="text-center text-uppercase btn btn-primary btn-lg" onclick="gtag('event', 'Salvesta',{'event_category': 'Projektid','event_label':'Esita projekt'});" value="Esita projekt" id="regButton"><?php echo $add_project; ?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                 <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $close_text; ?></button>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $close_text; ?></button>
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
                        <a class="flex-sm-fill text-sm-center nav-link text-uppercase text-weight-bold" id="post-participants-tab" data-toggle="pill" href="#post-participants" role="tab" aria-controls="post-participants" aria-selected="false" style="display: none;"><span>Liitu</span></a>
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
                                <?php
                                    if($_SESSION["lang"] == "ee"){
                                        $reg_field_name = "Ees- ja perekonnanimi *";
                                        $reg_field_cur = "Eriala *";
                                        $reg_field_email = "E-mail *";
                                        $reg_field_str = "Tugevused ja oskused";
                                        $reg_field_join = "Liitu";
                                        $reg_field_joined = "Liitunud üliõpilased: ";
                                    }
                                    else{
                                        $reg_field_name = "First and last name *";
                                        $reg_field_cur = "Curriculum *";
                                        $reg_field_email = "E-mail *";
                                        $reg_field_str = "Strengths and skills";
                                        $reg_field_join = "Join";
                                        $reg_field_joined = "Joined students: ";
                                    }
                                ?>
                                <form class="needs-validation" id="project-join" method="POST" action="./project_api.php">
                                    <div class="form-group">
                                        <p class="alert alert-warning font-weight-normal"><?php echo $forms_consent; ?></p>
                                        <label><?php echo $reg_field_name; ?></label>
                                        <input class="form-control" type="text" name="fullname" id="project_fullname" required>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $reg_field_cur; ?></label>
                                        <input class="form-control" type="text" name="degree" id="project_degree" required>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $reg_field_email; ?></label>
                                        <input class="form-control" type="text" name="email" id="project_email" required>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $reg_field_str; ?></label>
                                        <textarea class="form-control" name="skills" id="skills" rows="2"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkpoint" name="checkpoint" required="required">
                                            <label class="custom-control-label text-left" for="checkpoint"><?php echo $consent_form_area; ?><a href="<?php echo $wwwroot;?>andmekaitsetingimused" target="_blank"><?php echo $consent_link_text; ?></a>.</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="hash" id="project_hash">
                                    <div class="join-container text-center">
                                        <button type="submit" class="btn btn-primary" id="joinButton"><?php echo $reg_field_join; ?></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-12"><h5 class="text-center"><?php echo $reg_field_join; ?>(<span class="field-participants"></span>)</h5></div>
                            <div class="col-lg-12 participants-container"><div class="container"><div class="row justify-content-center"></div></div></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $close_text; ?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewArcModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="post-heading"></h2>
                        </div>
                        <!-- join and contact-->
                        <div class="col-lg-8 my-2">
                            <p class="field-goals my-4"></p>
                            <p class="field-actions my-4"></p>
                            <p class="field-results my-4"></p>
                        </div>
                        <div class="col-lg-4">
                            <h5 class="field-organiser"></h5>
                            <h5 class="field-org_name"></h5>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $close_text; ?></button>
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
            $('.js-modal-arc').on('click', arcModal);

            $('.arc-active').on('click', function(){
                $('.profiles-current').show();
                $('.profiles-past').hide();
                $('.arc-active').addClass("active");
                $('.arc-inactive').removeClass("active");
            });
            $('.arc-inactive').on('click', function(){
                $('.profiles-current').hide();
                $('.profiles-past').show();
                $('.arc-active').removeClass("active");
                $('.arc-inactive').addClass("active");
            });

            $('[data-toggle="tooltip"]').tooltip();

            $('.pagination .page-item').on('click', paginatorClick);
            $('#carouselPager').carousel({
                interval: false,
                wrap: false
            });
            $('#carouselPager').on('slide.bs.carousel', function(e) {
                $('.pagination .page-item').eq(e.from + 1).toggleClass('active');
                $('.pagination .page-item').eq(e.to + 1).toggleClass('active');
            });
            
            $('#viewModal').on('hide.bs.modal', function (e) {
                $('#post-home').addClass('show').addClass('active');
                $('#post-participants').removeClass('show').removeClass('active');
                $('#post-home-tab').addClass('show').addClass('active');
                $('#post-participants-tab').removeClass('show').removeClass('active');
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
                form.after("<div class='alert alert-danger'>Ups! Midagi läks valesti registreerimisel: "+response.responseText+"</div>");
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
            //var pdf_path = 'https://docs.google.com/viewer?url=https://praktika.ut.ee/userdata/projects/' + target.data("pdf_path");
            var pdf_path = "../js/pdf/web/viewer.html?file=<?php echo $wwwroot;?>userdata/projects/" + target.data("pdf_path");
            var org_name = target.data("org_name");
            var org_email = target.data("org_email");
            var organisation = target.data("organisation");
            var max_part = target.data("max_part");
            var amount = target.data("amount");
            var reg_open = target.data("reg_open");
            var reg_tab = $('#post-participants-tab');
            if(reg_open == 1){
                reg_tab.show();
            }else{
                reg_tab.hide();
            }
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
            /*modal.find('.pdf-container').empty();
            var options = {
              pdfOpenParams: { view: 'FitH', scrollbar: '1', toolbar: '0', statusbar: '1', messages: '0', navpanes: '0' },
              fallbackLink: '<p>Antud veebilehitseja ei toeta PDFi vaatamist otse lehe sees. Palun laadige PDF alla ning avage eraldi. <a href="[url]">Lae alla PDF</a></p>'
            };
            PDFObject.embed('./../userdata/projects/' + target.data("pdf_path"), ".pdf-container", options);*/
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

        function arcModal(e){
            var target = $(e.currentTarget);
            var modal = $('#viewArcModal');

            var org_name = target.data("org_name");
            var organisation = target.data("organisation");
            var title = target.data("title");
            var goals = target.data("goals");
            var actions = target.data("actions");
            var results = target.data("results");

            modal.find('.post-heading').html(title);
            modal.find('.field-organiser').html(organisation);
            modal.find('.field-org_name').html(org_name);
            modal.find('.field-goals').html(goals);
            modal.find('.field-actions').html(actions);
            modal.find('.field-results').html(results);

            modal.modal("show");
        }

        function createParticipant(arr) {
            var name = arr[0];
            var email = arr[1];
            var degree = arr[2];
            var skills = arr[3];
            return $('<div>').addClass("col-lg-3 participant m-2").html("<h6>" + name + "</h6>" + "<p>" + degree + "</p>");
        }

        function showFileName(files) {
              try {
                  var fname = document.getElementById("upload-data");
                  fname.innerHTML = files[0].name + " (" + (files[0].size / 1024).toFixed(2) + "KB)";
                  document.getElementById("project_pdf").parentElement.appendChild(fname);
              } catch (err) {
                  var fname = document.createElement("div");
                  fname.classList.add("pt-3");
                  fname.id = "upload-data";
                  fname.innerHTML = files[0].name + " (" + (files[0].size / 1024).toFixed(2) + "KB)";
                  document.getElementById("project_pdf").parentElement.appendChild(fname);
              }
          }

    </script>

</body>

</html>
