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
                <h6>Humanitaarteaduste ja<br>kunstide valdkond</h6>
                <ul>
                  <li>
                    <p><a target="_blank" href="https://www.flaj.ut.ee/et/oppimine/praktika-4">ajaloo ja arheoloogia instituut</a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.keel.ut.ee/et/oppimine/praktika-3">eesti ja üldkeeleteaduse instituut</a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.flfi.ut.ee/et/filosoofia-osakond/praktika">filosoofia ja semiootika instituut</a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.flku.ut.ee/et/praktika_yldine">kultuuriteaduste instituut</a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.maailmakeeled.ut.ee/et/praktikale">maailma keelte ja kultuuride kolledž</a></p>
                  </li>
                  <li>
                    <p>usuteaduskond</p>
                  </li>
                  <li>
                    <p>Viljandi kultuuriakadeemia</p>
                  </li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-3">
                <h6>Sotsiaalteaduste<br>valdkond</h6>
                <ul>
                  <li>
                    <p><a target="_blank" href="https://www.pedagogicum.ut.ee/et/opetajakoolitus/praktikad-opetajakoolituses">haridusteaduste instituut</a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://sisu.ut.ee/skyttepraktika">Johan Skytte poliitikauuringute instituut</a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="http://sisu.ut.ee/praktikamajanduses">majandusteaduskond</a></p>
                  </li>
                  <li>
                    <p>psühholoogia instituut</p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://oigus.ut.ee/et/praktika">õigusteaduskond</a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.yti.ut.ee/et/oppimine/praktikad">ühiskonnateaduste instituut</a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.narva.ut.ee/et/oppimine/pedagoogiline-praktika">Narva kolledž</a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.pc.ut.ee/et/oppimine/praktikad">Pärnu kolledž</a></p>
                  </li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-3">

                <h6>Meditsiiniteaduste<br>valdkond</h6>
                <ul>
                  <li>
                    <p>bio- ja siirdemeditsiini instituut</p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://www.farmaatsia.ut.ee/et/praktika">farmaatsia instituut</a></p>
                  </li>
                  <li>
                    <p><a target="_blank" href="https://hambaarstiteadus.ut.ee/et/pohiope/praktika-0">hambaarstiteaduse instituut</a></p>
                  </li>
                  <li>
                    <p>kliinilise meditsiini instituut</p>
                  </li>
                  <li>
                    <p>peremeditsiini ja rahvatervishoiu instituut</p>
                  </li>
                  <li>
                    <p>sporditeaduste ja ja füsioteraapia instituut</p>
                  </li>
                </ul>

              </div>
              <div class="col-md-6 col-lg-3">

                <h6>Loodus- ja täppisteaduste<br>valdkond</h6>
                <ul>
                  <li>
                    <p><a target="_blank" href="https://www.cs.ut.ee/et/praktika-3">arvutiteaduse instituut</a></p>
                  </li>
                  <li>
                    <p>Eesti mereinstituut</p>
                  </li>
                  <li>
                    <p>füüsika instituut</p>
                  </li>
                  <li>
                    <p>matemaatika ja statistika instituut</p>
                  </li>
                  <li>
                    <p>molekulaar- ja rakubioloogia instituut</p>
                  </li>
                  <li>
                    <p>Tartu observatoorium</p>
                  </li>
                  <li>
                    <p>tehnoloogiainstituut</p>
                  </li>
                  <li>
                    <p>ökoloogia ja maateaduste instituut</p>
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
