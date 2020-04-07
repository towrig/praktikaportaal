<!DOCTYPE html>
<html lang="en">
<?php
include_once './../templates/header.php';
$t_pieces = t(array("intro_title","intro_main","intro_heading1","intro_student1","intro_student2", "intro_heading2", "intro_projectinterns1", "intro_projectinterns2",
    "intro_projectinterns3", "intro_projectinterns4", "intro_heading3", "intro_submitproposal1", "intro_submitproposal2", "intro_submitproposal3",
    "intro_heading4", "intro_participation1", "intro_participation2","intro_participation3","intro_participation4", "intro_heading5", "intro_offers1", "intro_offers2",
    "intro_offers3", "intro_heading6", "intro_system"),$dbhost,$dbname,$dbuser,$dbpassword);
?>

<section id="privicy" class="page-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
          <h1 class="text-uppercase font-weight-bold mb-3 mt-5 mb-3" data-aos="fade-right"><?php echo $t_pieces["intro_title"];?></h1>
      </div>
      <div class="col-lg-12" data-aos="fade-right">
        <div data-aos="fade-down">
          <p><?php echo $t_pieces["intro_main"];?></p>
        </div>
        <div data-aos="fade-down">
            <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["intro_heading1"];?></h5>
          <ul>
              <li><?php echo $t_pieces["intro_student1"];?></li>
              <li><?php echo $t_pieces["intro_student2"];?></li>
          </ul>
        </div>

        <div data-aos="fade-down">
            <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["intro_heading2"];?></h5>
            <ul>
                <li><?php echo $t_pieces["intro_projectinterns1"];?></li>
                <li><?php echo $t_pieces["intro_projectinterns2"];?></li>
                <li><?php echo $t_pieces["intro_projectinterns3"];?></li>
                <li><?php echo $t_pieces["intro_projectinterns4"];?></li>
            </ul>
        </div>

        <div data-aos="fade-down">
            <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["intro_heading3"];?></h5>
            <ul>
                <li><?php echo $t_pieces["intro_submitproposal1"];?></li>
                <li><?php echo $t_pieces["intro_submitproposal2"];?></li>
                <li><?php echo $t_pieces["intro_submitproposal3"];?></li>
            </ul>
        </div>

        <div data-aos="fade-down">
            <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["intro_heading4"];?></h5>
            <ul>
                <li><?php echo $t_pieces["intro_participation1"];?></li>
                <li><?php echo $t_pieces["intro_participation2"];?></li>
                <li><?php echo $t_pieces["intro_participation3"];?></li>
                <li><?php echo $t_pieces["intro_participation4"];?></li>
            </ul>
        </div>

        <div data-aos="fade-down">
            <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["intro_heading5"];?></h5>
            <ul>
                <li><?php echo $t_pieces["intro_offers1"];?></li>
                <li><?php echo $t_pieces["intro_offers2"];?></li>
                <li><?php echo $t_pieces["intro_offers3"];?></li>
            </ul>

          <div data-aos="fade-down">
              <h5 class="text-uppercase font-weight-bold mb-3 mt-5" id="praktikakorraldus"><?php echo $t_pieces["intro_heading6"];?></h5>
              <p><?php echo $t_pieces["intro_system"];?></p><div class="row">
              <div class="col-md-6 col-lg-3">
                <?php

                  //fields
            $wf_fields = array();
            if($_SESSION["lang"] == "ee"){
                $wf_fields["aa1"] = "Humanitaarteaduste ja<br>kunstide valdkond";
                $wf_fields["aa2"] = "Sotsiaalteaduste<br>valdkond";
                $wf_fields["aa3"] = "Meditsiiniteaduste<br>valdkond";
                $wf_fields["aa4"] = "Loodus- ja täppisteaduste<br>valdkond";
                $wf_fields["ajaloo ja arheoloogia instituut"] = "ajaloo ja arheoloogia instituut";
                $wf_fields["arvutiteaduse instituut"] = "arvutiteaduse instituut";
                $wf_fields["bio- ja siirdemeditsiini instituut"] = "bio- ja siirdemeditsiini instituut";
                $wf_fields["eesti ja üldkeeleteaduse instituut"] = "eesti ja üldkeeleteaduse instituut";
                $wf_fields["Eesti mereinstituut"] = "Eesti mereinstituut";
                $wf_fields["farmaatsia instituut"] = "farmaatsia instituut";
                $wf_fields["filosoofia ja semiootika instituut"] = "filosoofia ja semiootika instituut";
                $wf_fields["füüsika instituut"] = "füüsika instituut";
                $wf_fields["hambaarstiteaduse instituut"] = "hambaarstiteaduse instituut";
                $wf_fields["haridusteaduste instituut"] = "haridusteaduste instituut";
                $wf_fields["Johan Skytte poliitikauuringute instituut"] = "Johan Skytte poliitikauuringute instituut";
                $wf_fields["keemia instituut"] = "keemia instituut";
                $wf_fields["kliinilise meditsiini instituut"] = "kliinilise meditsiini instituut";
                $wf_fields["kultuuriteaduste instituut"] = "kultuuriteaduste instituut";
                $wf_fields["maailma keelte ja kultuuride kolledž"] = "maailma keelte ja kultuuride kolledž";
                $wf_fields["majandusteaduskond"] = "majandusteaduskond";
                $wf_fields["matemaatika ja statistika instituut"] = "matemaatika ja statistika instituut";
                $wf_fields["molekulaar- ja rakubioloogia instituut"] = "molekulaar- ja rakubioloogia instituut";
                $wf_fields["Narva kolledž"] = "Narva kolledž";
                $wf_fields["õigusteaduskond"] = "õigusteaduskond";
                $wf_fields["ökoloogia ja maateaduste instituut"] = "ökoloogia ja maateaduste instituut";
                $wf_fields["Pärnu kolledž"] = "Pärnu kolledž";
                $wf_fields["peremeditsiini ja rahvatervishoiu instituut"] = "peremeditsiini ja rahvatervishoiu instituut";
                $wf_fields["psühholoogia instituut"] = "psühholoogia instituut";
                $wf_fields["sporditeaduste ja füsioteraapia instituut"] = "sporditeaduste ja füsioteraapia instituut";
                $wf_fields["Tartu observatoorium"] = "Tartu observatoorium";
                $wf_fields["tehnoloogiainstituut"] = "tehnoloogiainstituut";
                $wf_fields["ühiskonnateaduste instituut"] = "ühiskonnateaduste instituut";
                $wf_fields["usuteaduskond"] = "usuteaduskond";
                $wf_fields["Viljandi kultuuriakadeemia"] = "Viljandi kultuuriakadeemia";
            }
            else{
                $wf_fields["aa1"] = "Faculty of Arts<br>and Humanities";
                $wf_fields["aa2"] = "Faculty of Social<br>Sciences";
                $wf_fields["aa3"] = "Faculty of<br>Medicine";
                $wf_fields["aa4"] = "Faculty of Science<br>and Technology";
                $wf_fields["ajaloo ja arheoloogia instituut"] = "Institute of History and Archaeology";
                $wf_fields["arvutiteaduse instituut"] = "Institute of Computer Science";
                $wf_fields["bio- ja siirdemeditsiini instituut"] = "Institute of Biomedicine and Translational Medicine";
                $wf_fields["eesti ja üldkeeleteaduse instituut"] = "Institute of Estonian and General Linguistics";
                $wf_fields["Eesti mereinstituut"] = "Estonian Marine Institute";
                $wf_fields["farmaatsia instituut"] = "Institute of Pharmacy";
                $wf_fields["filosoofia ja semiootika instituut"] = "Institute of Philosophy and Semiotics";
                $wf_fields["füüsika instituut"] = "Institute of Physics";
                $wf_fields["hambaarstiteaduse instituut"] = "Institute of Dentistry";
                $wf_fields["haridusteaduste instituut"] = "Institute of Education";
                $wf_fields["Johan Skytte poliitikauuringute instituut"] = "Johan Skytte Institute of Political Studies";
                $wf_fields["keemia instituut"] = "Institute of Chemistry";
                $wf_fields["kliinilise meditsiini instituut"] = "Institute of Clinical Medicine";
                $wf_fields["kultuuriteaduste instituut"] = "Institute of Cultural Research";
                $wf_fields["maailma keelte ja kultuuride kolledž"] = "College of Foreign Languages and Cultures";
                $wf_fields["majandusteaduskond"] = "School of Economics and Business Administration";
                $wf_fields["matemaatika ja statistika instituut"] = "Institute of Mathematics and Statistics";
                $wf_fields["molekulaar- ja rakubioloogia instituut"] = "Institute of Molecular and Cell Biology";
                $wf_fields["Narva kolledž"] = "Narva College";
                $wf_fields["õigusteaduskond"] = "School of Law";
                $wf_fields["ökoloogia ja maateaduste instituut"] = "Institute of Ecology and Earth Sciences";
                $wf_fields["Pärnu kolledž"] = "Pärnu College";
                $wf_fields["peremeditsiini ja rahvatervishoiu instituut"] = "Institute of Family Medicine and Public Health";
                $wf_fields["psühholoogia instituut"] = "Institute of Psychology";
                $wf_fields["sporditeaduste ja füsioteraapia instituut"] = "Institute of Sport Sciences and Physiotherapy";
                $wf_fields["Tartu observatoorium"] = "Tartu Observatory";
                $wf_fields["tehnoloogiainstituut"] = "Institute of Technology";
                $wf_fields["ühiskonnateaduste instituut"] = "Institute of Social Studies";
                $wf_fields["usuteaduskond"] = "School of Theology and Religious Studies";
                $wf_fields["Viljandi kultuuriakadeemia"] = "Viljandi Culture Academy";
            }

                ?>
                <h6><?php echo $wf_fields["aa1"]; ?></h6>
                <ul>
                  <li>
                    <p><a target="_blank" href="https://www.flaj.ut.ee/et/oppimine/praktika-4"><?php echo $wf_fields["ajaloo ja arheoloogia instituut"]; ?></a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.keel.ut.ee/et/oppimine/praktika-3"><?php echo $wf_fields["eesti ja üldkeeleteaduse instituut"]; ?></a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.flfi.ut.ee/et/filosoofia-osakond/praktika"><?php echo $wf_fields["filosoofia ja semiootika instituut"]; ?></a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.flku.ut.ee/et/praktika_yldine"><?php echo $wf_fields["kultuuriteaduste instituut"]; ?></a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.maailmakeeled.ut.ee/et/praktikale"><?php echo $wf_fields["maailma keelte ja kultuuride kolledž"]; ?></a></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["usuteaduskond"]; ?></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["Viljandi kultuuriakadeemia"]; ?></p>
                  </li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-3">
                <h6><?php echo $wf_fields["aa2"]; ?></h6>
                <ul>
                  <li>
                    <p><a target="_blank" href="https://www.pedagogicum.ut.ee/et/opetajakoolitus/praktikad-opetajakoolituses"><?php echo $wf_fields["haridusteaduste instituut"]; ?></a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://sisu.ut.ee/skyttepraktika"><?php echo $wf_fields["Johan Skytte poliitikauuringute instituut"]; ?></a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="http://sisu.ut.ee/praktikamajanduses"><?php echo $wf_fields["majandusteaduskond"]; ?></a></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["psühholoogia instituut"]; ?></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://oigus.ut.ee/et/praktika"><?php echo $wf_fields["õigusteaduskond"]; ?></a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.yti.ut.ee/et/oppimine/praktikad"><?php echo $wf_fields["ühiskonnateaduste instituut"]; ?></a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.narva.ut.ee/et/oppimine/pedagoogiline-praktika"><?php echo $wf_fields["Narva kolledž"]; ?></a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.pc.ut.ee/et/oppimine/praktikad"><?php echo $wf_fields["Pärnu kolledž"]; ?></a></p>
                  </li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-3">
                <h6><?php echo $wf_fields["aa3"]; ?></h6>
                <ul>
                  <li>
                    <p><?php echo $wf_fields["bio- ja siirdemeditsiini instituut"]; ?></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.farmaatsia.ut.ee/et/praktika"><?php echo $wf_fields["farmaatsia instituut"]; ?></a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://hambaarstiteadus.ut.ee/et/pohiope/praktika-0"><?php echo $wf_fields["hambaarstiteaduse instituut"]; ?></a></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["kliinilise meditsiini instituut"]; ?></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["peremeditsiini ja rahvatervishoiu instituut"]; ?></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["sporditeaduste ja füsioteraapia instituut"]; ?></p>
                  </li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-3">
                <h6><?php echo $wf_fields["aa4"]; ?></h6>
                <ul>
                  <li>
                    <p><a target="_blank" href="https://www.cs.ut.ee/et/praktika-3"><?php echo $wf_fields["arvutiteaduse instituut"]; ?></a></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["Eesti mereinstituut"]; ?></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["füüsika instituut"]; ?></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["keemia instituut"]; ?></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["matemaatika ja statistika instituut"]; ?></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["molekulaar- ja rakubioloogia instituut"]; ?></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["Tartu observatoorium"]; ?></p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["tehnoloogiainstituut"]; ?>tehnoloogiainstituut</p>
                  </li>
                  <li>
                    <p><?php echo $wf_fields["ökoloogia ja maateaduste instituut"]; ?></p>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
