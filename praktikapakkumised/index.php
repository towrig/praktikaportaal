<!DOCTYPE html>
<?php
    include_once './../templates/header.php';
    $t_pieces = t(array("praktikapak_title","praktikapak_desc","forms_consent"),$dbhost,$dbname,$dbuser,$dbpassword);
    $title = $t_pieces["praktikapak_title"];
    $description = $t_pieces["praktikapak_desc"];
    $forms_consent = $t_pieces["forms_consent"];

    //sorting
    $query_string_sort = "";
    $sorting_wf = false;
    $sorting_loc = false;
    $sorting_lang = false;
    if(isset($_GET["sort_wf"]) && $_GET["sort_wf"] != "Määramata"){
        $query_string_sort .= " AND workfield = ?";
        $sorting_wf = true;
    }
    if(isset($_GET["sort_loc"]) && $_GET["sort_loc"] != "none"){
        $query_string_sort .= " AND LOWER(work_location) = ?";
        $sorting_loc = true;
    }

    if(isset($_GET["sort_lang"]) && $_GET["sort_lang"] != "none"){
        $query_string_sort .= " AND lang = ?";
        $sorting_lang = true;
    }

    if($_SESSION["lang"] == "ee"){
        $active_offers = "Aktiivsed pakkumised";
        $add_offer = "Lisa pakkumine";
        $sort_text = "Sorteeri";
        $sort_workfield = "Valdkond";
        $sort_location = "Asukoht";
        $sort_language = "Keel";
        $lang_ee = "eesti";
        $lang_eng = "inglise";
    }
    else{
        $active_offers = "Active offers";
        $add_offer = "Submit offer";
        $sort_text = "Sort";
        $sort_workfield = "Field";
        $sort_location = "Location";
        $sort_language = "Language";
        $lang_ee = "Estonian";
        $lang_eng = "English";
    }

    //fields
    $wf_fields = array();
    if($_SESSION["lang"] == "ee"){
        $wf_fields["Määramata"] = "Määramata";
        $wf_fields["Arvestusala"] = "Arvestusala";
        $wf_fields["Ehitus"] = "Ehitus";
        $wf_fields["Energeetika ja kaevandamine"] = "Energeetika ja kaevandamine";
        $wf_fields["Haridus ja teadus"] = "Haridus ja teadus";
        $wf_fields["Info- ja kommunikatsioonitehnoloogia"] = "Info- ja kommunikatsioonitehnoloogia";
        $wf_fields["Kaubandus, rentimine ja parandus"] = "Kaubandus, rentimine ja parandus";
        $wf_fields["Keemia-, kummi-, plasti- ja ehitusmaterjalitööstus"] = "Keemia-, kummi-, plasti- ja ehitusmaterjalitööstus";
        $wf_fields["Kultuur ja loometegevus"] = "Kultuur ja loometegevus";
        $wf_fields["Majutus, toitlustus ja turism"] = "Majutus, toitlustus ja turism";
        $wf_fields["Metalli- ja masinatööstus"] = "Metalli- ja masinatööstus";
        $wf_fields["Metsandus ja puidutööstus"] = "Metsandus ja puidutööstus";
        $wf_fields["Õigus"] = "Õigus";
        $wf_fields["Personali- ja administratiivtöö ning ärinõustamine"] = "Personali- ja administratiivtöö ning ärinõustamine";
        $wf_fields["Põllumajandus ja toiduainetööstus"] = "Põllumajandus ja toiduainetööstus";
        $wf_fields["Rõiva-, tekstiili- ja nahatööstus"] = "Rõiva-, tekstiili- ja nahatööstus";
        $wf_fields["Sotsiaaltöö"] = "Sotsiaaltöö";
        $wf_fields["Tervishoid"] = "Tervishoid";
        $wf_fields["Transport, logistika ning mootorsõidukid"] = "Transport, logistika ning mootorsõidukid";
        $wf_fields["Vee- ja jäätmemajandus ning keskkond"] = "Vee- ja jäätmemajandus ning keskkond";
    }
    else{
        $wf_fields["Määramata"] = "Unselected";
        $wf_fields["Arvestusala"] = "Accounting";
        $wf_fields["Ehitus"] = "Construction";
        $wf_fields["Energeetika ja kaevandamine"] = "Energy and mining";
        $wf_fields["Haridus ja teadus"] = "Education and research";
        $wf_fields["Info- ja kommunikatsioonitehnoloogia"] = "ICT";
        $wf_fields["Kaubandus, rentimine ja parandus"] = "Trade, rentals, repair";
        $wf_fields["Keemia-, kummi-, plasti- ja ehitusmaterjalitööstus"] = "Chemicals, rubber, plastic, construction materials";
        $wf_fields["Kultuur ja loometegevus"] = "Culture and creative industries";
        $wf_fields["Majutus, toitlustus ja turism"] = "Accommodation, catering, tourism";
        $wf_fields["Metalli- ja masinatööstus"] = "Metal products, machinery";
        $wf_fields["Metsandus ja puidutööstus"] = "Forestry, timber";
        $wf_fields["Õigus"] = "Security, law";
        $wf_fields["Personali- ja administratiivtöö ning ärinõustamine"] = "HR, business consultancy";
        $wf_fields["Põllumajandus ja toiduainetööstus"] = "Agriculture, food industry";
        $wf_fields["Rõiva-, tekstiili- ja nahatööstus"] = "Apparel, textile";
        $wf_fields["Sotsiaaltöö"] = "Social work";
        $wf_fields["Tervishoid"] = "Health care";
        $wf_fields["Transport, logistika ning mootorsõidukid"] = "Transportation, logistics, motor vehicles";
        $wf_fields["Vee- ja jäätmemajandus ning keskkond"] = "Water, waste and environmental management";
    }

    //form
    if($_SESSION["lang"] == "ee"){
        $form_heading = "Kuulutuse pealkiri *";
        $form_heading_warning = "Palun lisa pealkiri";
        $form_workfield = "Valdkond *";
        $form_weblink = "Pakkumise link";
        $form_pdf_text = "Lisa praktikapakkumise pdf";
        $form_org_logo_text = "Lisa organisatsiooni logo *";
        $form_org_logo_text_warning = "Sisesta logo!";
        $form_intro_text = "Pakkumise tutvustus *";
        $form_tasks_text = "Ülesanded";
        $form_skills_text = "Ootused";
        $form_date_text = "Tähtaeg *";
        $form_org_text = "Ettevõte *";
        $form_name_text = "Kontaktisiku nimi *";
        $form_email_text = "Kontaktemail *";
        $form_email_text_warning = "Vajame sinu meiliaadressi, et sulle kinnituslink saata";
        $form_location_text = "Asukoht *";
        $form_lang = "Keel *";
        $form_reg_info_text = "Info kandideerimiseks";
        $consent_form_area = "Olen teadlik, et kõik vormi sisestatud isikuandmed avalikustatakse Futulabi kodulehel. Tutvu adnmekaitsetingimustega ";
        $consent_link_text = "siit";
        $close_text = "Sulge";
    }
    else{
        $form_heading = "Headline *";
        $form_heading_warning = "Please add the headline";
        $form_workfield = "Field *";
        $form_weblink = "Link to internship offer";
        $form_pdf_text = "Upload the offer in PDF format";
        $form_org_logo_text = "Upload your company logo *";
        $form_org_logo_text_warning = "Upload logo!";
        $form_intro_text = "Short description of the internship *";
        $form_tasks_text = "Assignments for intern";
        $form_skills_text = "Expectations for  intern";
        $form_date_text = "Deadline *";
        $form_org_text = "Company *";
        $form_name_text = "Name of the contact person *";
        $form_email_text = "Contact e-mail *";
        $form_email_text_warning = "Your e-mail is required for the e-mail confirmation link";
        $form_location_text = "Location *";
        $form_lang = "Language *";
        $form_reg_info_text = "Application information";
        $consent_form_area = "I am aware that the personal data uploaded by users onto the form will be published on Futulab. Read the data protection policy ";
        $consent_link_text = "here";
        $close_text = "Close";
    }
?>

<body id="page-top" class="practiceoffers">
    <?php include_once './../templates/top-navbar.php';?>
    <div id="main"></div>
    <div id="page-content">
        <section class="page-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="text-uppercase font-weight-bold mt-5 mb-3" data-aos="fade-right"><?php echo $title;?></h1>
                    </div>
                    <div class="col-lg-3">
                        <p class="font-weight-light mb-5" data-aos="fade-right"><?php echo $description; ?></p>
                    </div> <!-- .col-->
                    <div class="col-lg-2" data-aos="fade-in-right">
                        <a id="formToggler" class="toggleMenu text-uppercase" onclick="gtag('event', 'Ava',{'event_category': 'Praktikapakkumised','event_label':'Ava lisa pakkumine'});"><?php echo $add_offer; ?></a>
                    </div>
                    <div class="col-lg-12">
                        <h5 class="text-uppercase text-center font-weight-bold mt-5" data-aos="fade-down"><?php echo $active_offers; ?></h5>
                    </div>
                    <div class="offset-md-1 col-lg-11 p-3 text-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-3 col-sm-12">
                                    <span class="text-uppercase h6 sort-label"><?php echo $sort_location; ?></span>
                                    <select class="custom-select mr-sm-2" id="sort-loc">
                                        <option value="none" selected>...</option>
                                        <?php
                                            try{
                                                $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser , $dbpassword);
                                                // set the PDO error mode to exception
                                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                $query = $conn->prepare('SELECT DISTINCT LOWER(work_location) AS loc FROM WorkPosts WHERE isvalidated = ? AND end_date >= NOW()');
                                                $query->execute(array(1));
                                                $data = $query -> fetchAll();
                                                foreach($data as $row){
                                                    echo '<option value="'.$row["loc"].'">'.$row["loc"].'</option>';
                                                }
                                            } catch(PDOException $e){
                                                echo "Connection failed: " . $e->getMessage();
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-sm-12">
                                    <span class="text-uppercase h6 sort-label"><?php echo $sort_workfield; ?></span>
                                    <select class="custom-select mr-sm-2" id="sort-wf">
                                        <option value="Määramata" selected><?php echo $wf_fields["Määramata"]; ?></option>
                                        <option value="Arvestusala"><?php echo $wf_fields["Arvestusala"]; ?></option>
                                        <option value="Ehitus"><?php echo $wf_fields["Ehitus"]; ?></option>
                                        <option value="Energeetika ja kaevandamine"><?php echo $wf_fields["Energeetika ja kaevandamine"]; ?></option>
                                        <option value="Haridus ja teadus"><?php echo $wf_fields["Haridus ja teadus"]; ?></option>
                                        <option value="Info- ja kommunikatsioonitehnoloogia"><?php echo $wf_fields["Info- ja kommunikatsioonitehnoloogia"]; ?></option>
                                        <option value="Kaubandus, rentimine ja parandus"><?php echo $wf_fields["Kaubandus, rentimine ja parandus"]; ?></option>
                                        <option value="Keemia-, kummi-, plasti- ja ehitusmaterjalitööstus"><?php echo $wf_fields["Keemia-, kummi-, plasti- ja ehitusmaterjalitööstus"]; ?></option>
                                        <option value="Kultuur ja loometegevus"><?php echo $wf_fields["Kultuur ja loometegevus"]; ?></option>
                                        <option value="Majutus, toitlustus ja turism"><?php echo $wf_fields["Majutus, toitlustus ja turism"]; ?></option>
                                        <option value="Metalli- ja masinatööstus"><?php echo $wf_fields["Metalli- ja masinatööstus"]; ?></option>
                                        <option value="Metsandus ja puidutööstus"><?php echo $wf_fields["Metsandus ja puidutööstus"]; ?></option>
                                        <option value="Õigus"><?php echo $wf_fields["Õigus"]; ?></option>
                                        <option value="Personali- ja administratiivtöö ning ärinõustamine"><?php echo $wf_fields["Personali- ja administratiivtöö ning ärinõustamine"]; ?></option>
                                        <option value="Põllumajandus ja toiduainetööstus"><?php echo $wf_fields["Põllumajandus ja toiduainetööstus"]; ?></option>
                                        <option value="Rõiva-, tekstiili- ja nahatööstus"><?php echo $wf_fields["Rõiva-, tekstiili- ja nahatööstus"]; ?></option>
                                        <option value="Sotsiaaltöö"><?php echo $wf_fields["Sotsiaaltöö"]; ?></option>
                                        <option value="Tervishoid"><?php echo $wf_fields["Tervishoid"]; ?></option>
                                        <option value="Transport, logistika ning mootorsõidukid"><?php echo $wf_fields["Transport, logistika ning mootorsõidukid"]; ?></option>
                                        <option value="Vee- ja jäätmemajandus ning keskkond"><?php echo $wf_fields["Vee- ja jäätmemajandus ning keskkond"]; ?></option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-sm-12">
                                    <span class="text-uppercase h6 sort-label"><?php echo $sort_language; ?></span>
                                    <select class="custom-select mr-sm-2" id="sort-lang">
                                        <option value="ee" selected><?php echo $lang_ee; ?></option>
                                        <option value="eng"><?php echo $lang_eng; ?></option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-sm-12" style="margin-top:20px">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn" id="sort-button"><?php echo $sort_text; ?></button>
                                    </div>
                                </div>
                            </div><!-- .row -->
                        </div><!-- .container -->
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
                        /*
                        *   Truncates $text to character count. Default amount of characters is 25.
                        */

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
                            if($query_string_sort == ""){
                                $query_string = 'SELECT * FROM WorkPosts WHERE isvalidated = ? AND end_date >= NOW() ORDER BY id DESC';
                                $query_arr = array(1);
                            }else{
                                $query_string = 'SELECT * FROM WorkPosts WHERE isvalidated = ? AND end_date >= NOW() '.$query_string_sort.' ORDER BY id DESC';
                                $query_arr = array(1);
                                if($sorting_wf){
                                    array_push($query_arr, $_GET["sort_wf"]);
                                }
                                if($sorting_loc){
                                    array_push($query_arr, $_GET["sort_loc"]);
                                }
                                if($sorting_lang){
                                    array_push($query_arr, $_GET["sort_lang"]);
                                }
                            }
                            $query = $conn->prepare($query_string);
                            $query->execute($query_arr);
                            $data = $query -> fetchAll();
                            
                            $j = 0;
                            $max_per_page = 5;
                            $pages = 1;
                            $queue = false;
                            foreach($data as $row){
                                
                                $heading = $row["heading"];
                                $description = $row["description"];
                                $workfield = $row["workfield"];
                                $tasks = $row["tasks"];
                                $skills = $row["experience"];
                                $work_name = $row["work_name"];
                                $location = $row["work_location"];
                                $other = $row["other"];
                                $website = $row["work_website"];
                                $email = $row["email"];
                                $name = $row["name"];
                                
                                $id = $row["id"];
                                $validationcode = $row["validationcode"];
                                $picurl = "../userdata/pictures/".$row["logopath"];
                                $pdfpath = $row["pdfpath"];
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
                                                          data-workfield="'.$wf_fields[$workfield].'"
                                                          data-tasks="'.$tasks.'"
                                                          data-skills="'.$skills.'"
                                                          data-work_name="'.$work_name.'"
                                                          data-location="'.$location.'"
                                                          data-other="'.$other.'"
                                                          data-website="'.$website.'"
                                                          data-email="'.$email.'"
                                                          data-name="'.$name.'"
                                                          data-pdf_path="'.$pdfpath.'"
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
                                                          data-workfield="'.$wf_fields[$workfield].'"
                                                          data-tasks="'.$tasks.'"
                                                          data-skills="'.$skills.'"
                                                          data-work_name="'.$work_name.'"
                                                          data-location="'.$location.'"
                                                          data-other="'.$other.'"
                                                          data-website="'.$website.'"
                                                          data-email="'.$email.'"
                                                          data-name="'.$name.'"
                                                          data-pdf_path="'.$pdfpath.'"
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
                                    <p class="alert alert-warning font-weight-normal"><?php echo $forms_consent; ?></p>
                                    <label for="name"><?php echo $form_heading; ?></label>
                                    <input required type="text" class="form-control" id="heading" name="heading">
                                    <div class='invalid-feedback'><?php echo $form_heading_warning; ?></div>
                                </div>
                                <div class="form-group my-1">
                                    <label class="mr-sm-2"><?php echo $form_workfield; ?></label>
                                    <select class="custom-select mr-sm-2" id="workfield" name="workfield">
                                        <option value="Määramata" selected><?php echo $wf_fields["Määramata"]; ?></option>
                                        <option value="Arvestusala"><?php echo $wf_fields["Arvestusala"]; ?></option>
                                        <option value="Ehitus"><?php echo $wf_fields["Ehitus"]; ?></option>
                                        <option value="Energeetika ja kaevandamine"><?php echo $wf_fields["Energeetika ja kaevandamine"]; ?></option>
                                        <option value="Haridus ja teadus"><?php echo $wf_fields["Haridus ja teadus"]; ?></option>
                                        <option value="Info- ja kommunikatsioonitehnoloogia"><?php echo $wf_fields["Info- ja kommunikatsioonitehnoloogia"]; ?></option>
                                        <option value="Kaubandus, rentimine ja parandus"><?php echo $wf_fields["Kaubandus, rentimine ja parandus"]; ?></option>
                                        <option value="Keemia-, kummi-, plasti- ja ehitusmaterjalitööstus"><?php echo $wf_fields["Keemia-, kummi-, plasti- ja ehitusmaterjalitööstus"]; ?></option>
                                        <option value="Kultuur ja loometegevus"><?php echo $wf_fields["Kultuur ja loometegevus"]; ?></option>
                                        <option value="Majutus, toitlustus ja turism"><?php echo $wf_fields["Majutus, toitlustus ja turism"]; ?></option>
                                        <option value="Metalli- ja masinatööstus"><?php echo $wf_fields["Metalli- ja masinatööstus"]; ?></option>
                                        <option value="Metsandus ja puidutööstus"><?php echo $wf_fields["Metsandus ja puidutööstus"]; ?></option>
                                        <option value="Õigus"><?php echo $wf_fields["Õigus"]; ?></option>
                                        <option value="Personali- ja administratiivtöö ning ärinõustamine"><?php echo $wf_fields["Personali- ja administratiivtöö ning ärinõustamine"]; ?></option>
                                        <option value="Põllumajandus ja toiduainetööstus"><?php echo $wf_fields["Põllumajandus ja toiduainetööstus"]; ?></option>
                                        <option value="Rõiva-, tekstiili- ja nahatööstus"><?php echo $wf_fields["Rõiva-, tekstiili- ja nahatööstus"]; ?></option>
                                        <option value="Sotsiaaltöö"><?php echo $wf_fields["Sotsiaaltöö"]; ?></option>
                                        <option value="Tervishoid"><?php echo $wf_fields["Tervishoid"]; ?></option>
                                        <option value="Transport, logistika ning mootorsõidukid"><?php echo $wf_fields["Transport, logistika ning mootorsõidukid"]; ?></option>
                                        <option value="Vee- ja jäätmemajandus ning keskkond"><?php echo $wf_fields["Vee- ja jäätmemajandus ning keskkond"]; ?></option>
                                    </select>
                                </div>
                                <div class="form-group my-1">
                                    <label class="mr-sm-2"><?php echo $form_lang; ?></label>
                                    <select class="custom-select mr-sm-2" id="lang" name="lang">
                                        <option value="none" selected>...</option>
                                        <option value="ee"><?php echo $lang_ee; ?></option>
                                        <option value="eng"><?php echo $lang_eng; ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="website"><?php echo $form_weblink; ?></label>
                                    <input type="text" class="form-control" id="website" name="website">
                                </div>
                                <div class="form-group text-center">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn"><?php echo $form_pdf_text; ?></button>
                                        <input type="file" name="post_pdf" id="post_pdf" onchange="showFileName(this.files)">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="pilt" class="">Logo</label>
                                    <div id="preview">
                                        <img id="profileImg" src="../userdata/logo_placeholder.png" height="200" alt="Image preview...">
                                    </div>
                                    <div class="upload-btn-wrapper">
                                        <button class="btn"><?php echo $form_org_logo_text; ?></button>
                                        <input required type="file" accept="image/*" class="form-control-file" id="pilt" name="pilt_full" onchange="previewFile()">
                                    </div>
                                    <div class='invalid-feedback'><?php echo $form_org_logo_text_warning; ?></div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description"><?php echo $form_intro_text; ?></label>
                                    <textarea required class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <div class="form-group pdf-hide">
                                    <label for="tasks"><?php echo $form_tasks_text; ?></label>
                                    <textarea class="form-control" id="tasks" name="tasks" rows="3"></textarea>
                                </div>
                                <div class="form-group pdf-hide">
                                    <label for="skills"><?php echo $form_skills_text; ?></label>
                                    <textarea class="form-control" id="skills" name="skills" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="work"><?php echo $form_date_text; ?></label>
                                    <input required type="text" class="form-control" id="datepicker" name="date">
                                </div>
                                <div class="form-group">
                                    <label for="organization"><?php echo $form_org_text; ?></label>
                                    <input required type="text" class="form-control" id="organization" name="organization">
                                </div>
                                <div class="form-group">
                                    <label for="work"><?php echo $form_name_text; ?></label>
                                    <input required type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="email"><?php echo $form_email_text; ?></label>
                                    <input required type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                                    <div class='invalid-feedback'><?php echo $form_email_text_warning; ?></div>
                                </div>
                                <div class="form-group">
                                    <label for="location"><?php echo $form_location_text; ?></label>
                                    <input required type="text" class="form-control" id="location" name="location">
                                </div>
                                <div class="form-group">
                                    <label for="other"><?php echo $form_reg_info_text; ?></label>
                                    <textarea class="form-control" id="other" name="other" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkpoint" name="checkpoint" required="required">
                                        <label class="custom-control-label text-left" for="checkpoint"><?php echo $consent_form_area; ?><a href="<?php echo $wwwroot;?>andmekaitsetingimused" target="_blank"><?php echo $consent_link_text; ?></a>.</label>
                                    </div>
                                </div>
                                <button id="submit-all" type="submit" class="mt-3 text-center text-uppercase btn btn-lg btn-primary font-weight-light js-ajax" onclick="gtag('event', 'Salvesta',{'event_category': 'Praktikapakkumised','event_label':'Lisa pakkumine'});"><?php echo $add_offer; ?></button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $close_text; ?></button>
                </div>
            </div>
        </div>
    </div>

    <!--viewing modal-->
    <div id="viewModal" class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-7 col-info">
                                <h2 class="post-heading"></h2>
                                <h6><span class="post-org-name"></span></h6>
                                <h6>Valdkond: <span class="post-workfield"></span></h6>
                                <h5>Praktika tutvustus</h5>
                                <div class="post-description"></div>
                                <h5 class="skills-hide">Ootused</h5>
                                <div class="post-skills skills-hide"></div>
                                <h5 class="tasks-hide">Ülesanded</h5>
                                <div class="post-tasks tasks-hide"></div>
                                <h5 class="hide-website">Pakkumise link</h5>
                                <div class="post-website hide-website" style="overflow:hidden;"></div>
                                <div class="pdf-container"></div>
                                <h5 class="hide-other">Info kandideerimiseks</h5>
                                <div class="post-other hide-other"></div>
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
                                </div>
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
            $('#sort-button').on('click', handleSort);

            //$('[data-toggle="tooltip"]').tooltip();
            $("#datepicker").datepicker({
                showWeek: true,
                dateFormat: 'dd-mm-yy'
            });
            <?php if($sorting_wf):?>
                $('#sort-wf').val("<?php echo $_GET["sort_wf"];?>");
            <?php endif;?>
            <?php if($sorting_loc):?>
                $('#sort-loc').val("<?php echo $_GET["sort_loc"];?>");
            <?php endif;?>
            <?php if($sorting_lang):?>
                $('#sort-lang').val("<?php echo $_GET["sort_lang"];?>");
            <?php endif;?>
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

        function handleSort(e){
            $sl = $('#sort-loc').val();
            $sw = $('#sort-wf').val();
            $slg = $('#sort-lang').val();
            var args = '?sort_loc='+$sl+'&sort_wf='+$sw+'&sort_lang='+$slg;
            var url = window.location.origin + window.location.pathname + args;
            window.location.href = url;
        }

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
            var workfield = target.data('workfield');
            var tasks = target.data('tasks');
            var skills = target.data('skills');
            var other = target.data('other');
            var work_name = target.data('work_name');
            var work_loc = target.data('location');
            var website = target.data('website');
            var name = target.data('name');
            var email = target.data('email');
            var deadline = target.data('reg_end');

            //pdf stuff
            console.log(target.data("pdf_path")+";");
            if(target.data("pdf_path") != ""){
                var pdf_path = "../js/pdf/web/viewer.html?file=<?php echo $wwwroot;?>userdata/work_pdfs/" + target.data("pdf_path");
                //attach pdf
                var pdf_embed = $('<iframe>').attr({
                    'src': pdf_path + '&embedded=true',
                    'type': 'application/pdf'
                }).css('width', '100%').css('min-height', '512px');
                modal.find('.pdf-container').html(pdf_embed);
                modal.find('.hide-pdf').hide();
                modal.find('.tasks-hide').hide();
                modal.find('.skills-hide').hide();
                modal.find('.pdf-container').show();
            }else if (tasks != "" || skills != ""){
                console.log("ran this with: "+(tasks != ""));
                modal.find('.tasks-hide').hide();
                modal.find('.skills-hide').hide();
                if(tasks != "")
                    modal.find('.tasks-hide').show();
                if(skills != "")
                    modal.find('.skills-hide').show();
                modal.find('.pdf-container').hide();
            }

            //website hide logic
            if(website != ""){
                $(".hide-website").show();
                $(".post-website").html("<a target='_blank' href='" + website + "'>" + website + "</a>");
            }else{
                $(".hide-website").hide();
            }

            //other hide logic
            if(other != ""){
                $(".post-other").html("<pre>" + other + "</pre>");
                $(".hide-other").show();
            }else{
                $(".hide-other").hide();
            }

            //attach values
            $(".post-heading").html(heading);
            $(".post-description").html("<pre>" + description + "</pre>");
            $(".post-workfield").html(workfield);
            $(".post-tasks").html("<pre>" + tasks + "</pre>");
            $(".post-skills").html("<pre>" + skills + "</pre>");
            $(".post-img-container").html("<img src='" + pic + "'>");
            $(".post-org-name").html(work_name);
            $(".post-org-loc").html(work_loc);
            $(".post-contact-name").html(name);
            $(".post-contact-email").html(email);
            $(".post-deadline").html(deadline);
            handleCookies(id);

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
            var files = document.querySelector('#pilt').files[0];

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
