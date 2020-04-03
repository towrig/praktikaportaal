<!DOCTYPE html>
<?php
$t_pieces = t(array("fp-why_h1", "fp-why1", "fp-why_h2", "fp-why2", "fp-why_h3",
    "fp-why3", "fp-why_h4", "fp-why4"),$dbhost,$dbname,$dbuser,$dbpassword);
?>

<section id="why" class="d-flex flex-wrap align-content-center mb-5 pt-5">
  <div class="container">
      <h2 class="mt-5 pt-5 text-center" data-aos="fade-down"><?php echo $t_pieces["fp-why_h1"];?></h2>
      <small data-aos="fade-down"><?php echo $t_pieces["fp-why1"];?></small>
      <div class="row text-white mb-5">
      <div id="why-vorgustik" class="why-box col-md-4" data-aos="flip-down">
        <div class="col p-3">
            <h4><?php echo $t_pieces["fp-why_h2"];?></h4>
            <i id="why--vorgustik"></i>
            <span><?php echo $t_pieces["fp-why2"];?></span>
        </div>
      </div>
      <div id="why-konkurents" class="why-box col-md-4" data-aos="flip-down" data-aos-anchor-placement="bottom-bottom">
        <div class="col p-3 my-3 my-md-5">
            <h4><?php echo $t_pieces["fp-why_h3"];?></h4>
            <i id="why--konkurents"></i>
            <span><?php echo $t_pieces["fp-why3"];?></span>
        </div>
      </div>
      <div id="why-areng" class="why-box col-md-4" data-aos="flip-down">
        <div class="col p-3">
            <h4><?php echo $t_pieces["fp-why_h4"];?></h4>
            <i id="why--areng"></i>
            <span><?php echo $t_pieces["fp-why4"];?></span>
        </div>
      </div>
    </div>
  </div>
</section>
