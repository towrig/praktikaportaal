<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
      <a href="<?php echo $wwwroot; ?>" onclick="gtag('event', 'Tagasi avalehele',{'event_category': 'Pealdis','event_label':'Tagasi avalehele'});"><div id="ut-logo"></div></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $wwwroot; ?>tutvustus" onclick="gtag('event', 'Sisu@UT',{'event_category': 'Pealdis','event_label':'Tutvustus'});">Tutvustus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $wwwroot; ?>tutvustus#praktikakorraldus" onclick="gtag('event', 'Sisu@UT',{'event_category': 'Pealdis','event_label':'Praktikakorraldus'});">Praktikakorraldus</a>
                </li>
              <li class="nav-item">
                    <a class="nav-link" href="<?php echo $wwwroot; ?>juhendajale" onclick="gtag('event', 'Sisu@UT',{'event_category': 'Pealdis','event_label':'Juhendajale'});">Juhendajale</a>
                </li>
              <li class="nav-item">
                <a class="nav-link lang-switch" target="_blank" href="#">EST</a>
              </li>
            </ul>
        </div>
    </div>
</nav>
