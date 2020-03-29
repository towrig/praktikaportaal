<!DOCTYPE html>
<?php
$t_pieces = t(array("fp-act_title","fp-act_h1", "fp-act1", "fp-act_h2", "fp-act2","fp-act_h3",
    "fp-act3","fp-act_h4","fp-act4"),$dbhost,$dbname,$dbuser,$dbpassword);
?>

<section id="activities" class="d-flex flex-wrap align-content-center text-center mb-5">
    <div class="container mb-5">
        <h3 class="mt-0 text-uppercase" data-aos="fade-down"><?php echo $t_pieces["fp-act_title"];?></h3>
        <div class="row">
            <div class="col-lg-3 col-md-6" data-aos="flip-down" data-aos-duration="2000">
                <div class="mt-5">
                    <h5 class="h6 mb-2 text-uppercase"><a target="_blank" onclick="gtag('event', 'Osalemine',{'event_category': 'Avaleht','event_label':'Praktikad'});" href="./praktikapakkumised"><?php echo $t_pieces["fp-act_h1"];?></a></h5>
                    <p class="text-muted mb-0"><?php echo $t_pieces["fp-act1"];?></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 " data-aos="flip-down" data-aos-duration="1500">
                <div class="mt-5">
                    <h5 class="h6 mb-2 text-uppercase"><a target="_blank" onclick="gtag('event', 'Osalemine',{'event_category': 'Avaleht','event_label':'Projektid'});" href="./projektid"><?php echo $t_pieces["fp-act_h2"];?></a></h5>
                    <p class="text-muted mb-0"><?php echo $t_pieces["fp-act2"];?></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="flip-down" data-aos-duration="1000">
                <div class="mt-5">
                    <h5 class="h6 mb-2 text-uppercase"><a target="_blank" onclick="gtag('event', 'Osalemine',{'event_category': 'Avaleht','event_label':'Liidriprogramm'});" href="https://majandus.ut.ee/et/liider"><?php echo $t_pieces["fp-act_h3"];?></a></h5>
                    <p class="text-muted mb-0"><?php echo $t_pieces["fp-act3"];?></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="flip-down" data-aos-duration="500">
                <div class="mt-5">
                    <h5 class="h6 mb-2 text-uppercase"><a target="_blank" href="https://startuplab.ut.ee/kalender" onclick="gtag('event', 'Osalemine',{'event_category': 'Avaleht','event_label':'Seminarid'});"><?php echo $t_pieces["fp-act_h4"];?></a></h5>
                    <p class="text-muted mb-0"><?php echo $t_pieces["fp-act4"];?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<hr class="divider my-5">
<!--
<div class="modal" id="seminar-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Üritused ja seminarid</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center" id="loader">
          <div>Laeme üritusi ...</div>
          <div></div>
          <div class="spinner-grow text-primary" role="status">
            <span class="sr-only">Laeme üritusi ...</span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Sulge</button>
      </div>
    </div>
  </div>
</div>-->
<script>
//$('#seminars').modal();
/*setTimeout(function(){ 
  $('#seminars').on('click',function(){
    $(function() {
      $.ajax({
        type: "GET",
        url: "<?php echo $wwwroot; ?>templates/frontpage/pull_events_api.php",
        cache: true,
      }).done(function( html ) {
        $( "#seminar-modal .modal-body" ).hide();
        $( "#seminar-modal .modal-body" ).append( html );
        $( "#seminar-modal .modal-body #loader" ).remove();
        $( "#seminar-modal .modal-body" ).fadeIn();
      });
    });
  });
}, 100);*/
</script>
