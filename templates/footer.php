    <footer>
      <div class="container mb-5">
        <div class="row">
          <div class="col-md-12 col-lg-8">
            <div class="row">
              <div class="col-md-4">
                <h3 class="contact-us" data-aos="fade-right">VÕTA<br>MEIEGA<br>ÜHENDUST!</h3>
              </div>
              <div class="col-md-4">
                <div class="row">
                  <div class="col-md-12 contact-us-info" data-aos="fade-right">
                    <p>Kui Sul on küsimusi või mõni teema pakub huvi, siis võta meiega ühendust aadressil</p>
                  </div>
                  <div class="col-md-12" data-aos="fade-right"><a href="mailto:praktika@ut.ee"  onclick="gtag('event', 'Võta ühendust',{'event_category': 'Jalus','event_label':'Võta ühendust!'});">praktika@ut.ee</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 footer-bottom mt-5">
            <div class="row">
              <div class="copyright col-md-9">
                &copy; 2019 - Tartu Ülikool majandusteaduskond<span class="text-muted font-weight-light">  </span><a href="<?php echo $wwwroot; ?>andmekaitsetingimused/" class="font-weight-light text-muted">Andmekaitsetingimused</a>
                <span class="text-muted font-weight-light"> | </span><a href="<?php echo $wwwroot; ?>kasutusjuhend/" class="font-weight-light text-muted">Kasutusjuhend</a>
              </div>
              <div class="socialmedia col-md-3 text-right" >
                <a href="https://twitter.com/unitartu" target="_blank"  onclick="gtag('event', 'Sotsiaalmeedia',{'event_category': 'Jalus','event_label':'Twitter'});"><i class="fab fa-2x fa-twitter"></i></a>
                <a href="https://www.facebook.com/tartuylikool" target="_blank"  onclick="gtag('event', 'Sotsiaalmeedia',{'event_category': 'Jalus','event_label':'Facebook'});"><i class="fab fa-2x fa-facebook"></i></a>
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

    <!-- Custom scripts for this template -->
    <script src="<?php echo $wwwroot; ?>js/creative.min.js"></script>

    <!-- Cookie consent -->
    <script src="<?php echo $wwwroot; ?>js/jquery.ihavecookies.min.js"></script>
    <!-- PDF viewer -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>-->
    <script>
      $(function(){
        $('body').ihavecookies({
          title: "Küpsised ja privaatsuspoliitika",
          message: "Kasutame oma veebilehel küpsiseid ning Google Analyticsi teenust veebilehe külastatavuse statistika analüüsiks.",
          link: "<?php echo $wwwroot; ?>andmekaitsetingimused/",
          advancedBtnLabel: "Vali küpsised",
          acceptBtnLabel: "Luba küpsised",
          moreInfoLabel: "Andmekaitsetingimused",
          uncheckBoxes: false,
          fixedCookieTypeLabel: 'Kohustuslikud',
          fixedCookieTypeDesc: 'Need küpsised on vajalikud, et tagada võrgulehe toimimine.',
          delay: 10,

          cookieTypes: [
            {
              type: 'Analüütika',
              value: 'analytics',
              description: 'Kasutame Google Analytics teenust, et teostada analüütikat veebilehe külastatavuse analüüsiks.'
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
      <a href="#why" class="scrollDown text-uppercase" onclick="gtag('event', 'Kerimine',{'event_category': 'Jalus','event_label':'Alla'});">Loe edasi</a>
      <a href="#" class="scrollBack text-uppercase" onclick="document.documentElement.scrollTop = 0; document.body.scrollTop = 0; gtag('event', 'Kerimine',{'event_category': 'Jalus','event_label':'Üles'});" >Tagasi üles</a>
    </div>

