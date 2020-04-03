<?php
$t_pieces = t(array("fp-unique_title", "fp-unique1", "fp-unique_h1", "fp-unique2", "fp-unique_h2",
    "fp-unique3", "fp-unique_h3", "fp-unique4", "fp-unique_h4", "fp-unique5"),$dbhost,$dbname,$dbuser,$dbpassword);
?>
<section id="unique" class="my-5 page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 data-aos="fade-down"><?php echo $t_pieces["fp-unique_title"];?></h2>
                <small data-aos="fade-down"><?php echo $t_pieces["fp-unique1"];?></small>
            </div>
        </div>
    </div>
  <div class="container">
    <div class="row text-white mb-5">
      <div id="unique-kaedkulge" class="unique-box col-lg-3 col-md-6"  data-aos="flip-down" data-aos-anchor-placement="bottom-bottom">
        <div class="col p-3">
            <h3><?php echo $t_pieces["fp-unique_h1"];?></h3>
            <i class="unique-arrow"></i>
            <span><?php echo $t_pieces["fp-unique2"];?></span>
        </div>
      </div>
      <div id="unique-interditsiplinaarne" class="unique-box col-lg-3 col-md-6"  data-aos="flip-down" data-aos-anchor-placement="bottom-bottom">
        <div class="col p-3">
            <h3><?php echo $t_pieces["fp-unique_h2"];?></h3>
            <i class="unique-arrow"></i>
            <span><?php echo $t_pieces["fp-unique3"];?></span>
        </div>
      </div>
      <div id="unique-tulevikuoskused" class="unique-box col-lg-3 col-md-6"  data-aos="flip-down" data-aos-anchor-placement="bottom-bottom">
        <div class="col p-3">
            <h3><?php echo $t_pieces["fp-unique_h3"];?></h3>
            <i class="unique-arrow"></i>
            <span><?php echo $t_pieces["fp-unique4"];?></span>
        </div>
      </div>
        <div id="unique-paindlik" class="unique-box col-lg-3 col-md-6"  data-aos="flip-down" data-aos-anchor-placement="bottom-bottom">
        <div class="col p-3">
            <h3><?php echo $t_pieces["fp-unique_h4"];?></h3>
            <i class="unique-arrow"></i>
            <span><?php echo $t_pieces["fp-unique5"];?></span>
        </div>
      </div>
    </div>
</div>
</section>
