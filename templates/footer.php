<!DOCTYPE html>
<?php
//c_title, c_message, c_accept, c_more, c_fixed_1, c_fixed_2
$t_pieces = t(array("footer_h1","footer1","footer2","footer3","footer4","footer5", "cookie_title", "cookie_message", "cookie_advanced", "cookie_accept", "cookie_more", "cookie_fixed_1", "cookie_fixed_2", "cookie_fixed_3", "cookie_fixed_4"),$dbhost,$dbname,$dbuser,$dbpassword);
?>

    <footer>
      <div class="container mb-5">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="row">
              <div class="col-md-4">
                <h3 class="contact-us" data-aos="fade-right"><?php echo $t_pieces["footer_h1"];?></h3>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-md-12 contact-us-info" data-aos="fade-right">
                    <p><?php echo $t_pieces["footer1"];?></p>
                  </div>
                  <div class="col-md-12" data-aos="fade-right"><a href="mailto:praktika@ut.ee"  onclick="gtag('event', 'Võta ühendust',{'event_category': 'Jalus','event_label':'Võta ühendust!'});">praktika@ut.ee</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 footer-bottom mt-5">
            <div class="row">
              <div class="copyright col-md-9">
                &copy; 2019 - Tartu Ülikool majandusteaduskond<span class="text-muted font-weight-light">  </span><a href="<?php echo $wwwroot; ?>andmekaitsetingimused/" class="font-weight-light text-muted"><?php echo $t_pieces["footer2"];?></a>
                <span class="text-muted font-weight-light"> | </span><a href="<?php echo $wwwroot; ?>kasutusjuhend/" class="font-weight-light text-muted"><?php echo $t_pieces["footer3"];?></a>
              </div>
              <div class="socialmedia col-md-3 text-right" >
                <a href="https://twitter.com/unitartu" target="_blank"  onclick="gtag('event', 'Sotsiaalmeedia',{'event_category': 'Jalus','event_label':'Twitter'});"><i class="fab fa-2x fa-twitter"></i></a>
                <a href="https://www.facebook.com/UTfutulab/" target="_blank"  onclick="gtag('event', 'Sotsiaalmeedia',{'event_category': 'Jalus','event_label':'Facebook'});"><i class="fab fa-2x fa-facebook"></i></a>
                <a href="https://www.instagram.com/unitartu" target="_blank"  onclick="gtag('event', 'Sotsiaalmeedia',{'event_category': 'Jalus','event_label':'Instagram'});"><i class="fab fa-2x fa-instagram"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo $wwwroot; ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo $wwwroot; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <!--<script src="<?php echo $wwwroot; ?>vendor/jquery-easing/jquery.easing.min.js"></script>-->
    <!--<script src="<?php echo $wwwroot; ?>vendor/magnific-popup/jquery.magnific-popup.min.js"></script>-->
    <script src="<?php echo $wwwroot; ?>vendor/ui/jquery-ui.min.js"></script>
    <script src="<?php echo $wwwroot; ?>js/trumbowyg/trumbowyg.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo $wwwroot; ?>js/creative.min.js"></script>

    <!-- Cookie consent -->
    <script src="<?php echo $wwwroot; ?>js/jquery.ihavecookies.min.js"></script>
    <!-- PDF viewer -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>-->
    <?php if($_SESSION["admin"]):?>
    <!-- ADMIN SCRIPTS -->
    <script>
        $(function(){
            $('.admin-change-content').on('click', create_editable_block);
            $('a').on('click', function(e){
                if($(e.currentTarget).find('.admin-info-change').length){
                    e.preventDefault();
                }
            });
            $('.admin-info-change textarea').focus(function(e){
                $('.admin-change-content').hide();
                $(e.currentTarget).parent().find('.admin-change-content').show();
            });
        });
        function create_editable_block(e){
            var target = $(e.currentTarget);
            var key = target.data("key");
            var content = $("#content-"+key).val();
            var formData = new FormData();
            formData.append("changing-content", 1);
            formData.append("key", key);
            formData.append("content", content);

            $.ajax({
                type: 'POST',
                url: '<?php echo $wwwroot; ?>admin/admin_api.php',
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(function(response) {
                console.log(response);
            }).fail(function(response) {
                console.log(response);
            });
        }
    </script>
    <?php endif;?>

    <script>
      $(function(){
        $('.lang-switch').on('click', function(e){
            var formData = new FormData();
            formData.append("lang", "<?php echo $_SESSION["lang"]; ?>");
            $.ajax({
                type: 'POST',
                url: '<?php echo $wwwroot; ?>lang.php',
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            }).done(function(response) {
                location.reload();
            }).fail(function(response) {
                console.log("Failed: "+response.reponseText)
            });
        });
        $('.sem-link').on('click',function(e){
            var modal = $(".sem-modal").first();
            modal.modal("show");
        });
        $('body').ihavecookies({
          title: "<?php echo $t_pieces["cookie_title"]; ?>",
          message: "<?php echo $t_pieces["cookie_message"]; ?>",
          link: "<?php echo $wwwroot; ?>andmekaitsetingimused/",
          advancedBtnLabel: "<?php echo $t_pieces["cookie_advanced"]; ?>",
          acceptBtnLabel: "<?php echo $t_pieces["cookie_accept"]; ?>",
          moreInfoLabel: "<?php echo $t_pieces["cookie_more"]; ?>",
          uncheckBoxes: false,
          fixedCookieTypeLabel: '<?php echo $t_pieces["cookie_fixed_1"]; ?>',
          fixedCookieTypeDesc: '<?php echo $t_pieces["cookie_fixed_2"]; ?>',
          delay: 10,

          cookieTypes: [
            {
              type: '<?php echo $t_pieces["cookie_fixed_3"];?>',
              value: 'analytics',
              description: '<?php echo $t_pieces["cookie_fixed_4"];?>'
            }
          ]
        });
      });
    </script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

    <div id="scrollTop">
      <a href="#why" class="scrollDown text-uppercase" onclick="gtag('event', 'Kerimine',{'event_category': 'Jalus','event_label':'Alla'});"><?php echo $t_pieces["footer4"];?></a>
      <a href="#" class="scrollBack text-uppercase" onclick="document.documentElement.scrollTop = 0; document.body.scrollTop = 0; gtag('event', 'Kerimine',{'event_category': 'Jalus','event_label':'Üles'});" ><?php echo $t_pieces["footer5"];?></a>
    </div>

