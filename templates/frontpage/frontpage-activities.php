<section id="activities" class="d-flex flex-wrap align-content-center text-center mb-5">
    <div class="container mb-5">
        <h3 class="mt-0 text-uppercase">Üliõpilasel on võimalus osaleda</h3>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="mt-5">
                    <h5 class="h6 mb-2 text-uppercase"><a target="_blank" onclick="gtag('event', 'Osalemine',{'event_category': 'Avaleht','event_label':'Praktikad'});" href="./praktikapakkumised">Praktikad</a></h5>
                    <p class="text-muted mb-0">Üliõpilase arengule suunatud erinevad praktikavõimalused.<br>
                        Tutvu ja kandideeri!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 ">
                <div class="mt-5">
                    <h5 class="h6 mb-2 text-uppercase"><a target="_blank" onclick="gtag('event', 'Osalemine',{'event_category': 'Avaleht','event_label':'Projektid'});" href="./projektid">Projektid</a></h5>
                    <p class="text-muted mb-0">Interdistsiplinaarsed projektid, et koos meeskonnaga lahendada olulisi probleeme ja leida loovaid lahendusi.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="mt-5">
                    <h5 class="h6 mb-2 text-uppercase"><a target="_blank" onclick="gtag('event', 'Osalemine',{'event_category': 'Avaleht','event_label':'Liidriprogramm'});" href="https://majandus.ut.ee/et/liider">Liidriprogramm</a></h5>
                    <p class="text-muted mb-0">Tunnustame üliõpilase ülikooliväliseid tegevusi, mida saab jagada oma tööandjaga!
                        Tule Liidriks!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="mt-5">
                    <h5 class="h6 mb-2 text-uppercase"><a href="#" onclick="gtag('event', 'Osalemine',{'event_category': 'Avaleht','event_label':'Seminarid'});" id="seminars" data-toggle="modal" data-target="#seminar-modal">Seminarid</a></h5>
                    <p class="text-muted mb-0">Ideede elluviimist ja probleemide lahendamist toetavad teemaseminarid. Vali huvipakkuv ja osale!</p>
                </div>
            </div>
        </div>
    </div>
</section>
<hr class="divider my-5">
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
        <button type="button" class="btn btn-primary" data-dismiss="modal">Sule</button>
      </div>
    </div>
  </div>
</div>
<script>
//$('#seminars').modal();
setTimeout(function(){ 
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
}, 100);
</script>
