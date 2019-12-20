<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 navbar-scrolled" id="mainNav">
    <div class="container">
      <a href="<?php echo $wwwroot; ?>"><div id="ut-logo"></div></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0">
                <?php if ($_SERVER["PHP_SELF"] == '/praktika/index.php'): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Avaleht
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">               
                        <a class="dropdown-item  js-scroll-trigger" href="<?php echo $wwwroot ?>#page-top">Avaleht</a>
                        
                        <a class="dropdown-item  js-scroll-trigger" href="#why">Miks</a>
                        <a class="dropdown-item  js-scroll-trigger" href="#purpose">Eesmärk</a>
                        <a class="dropdown-item  js-scroll-trigger" href="#activities">Tegevused</a>
                        <a class="dropdown-item  js-scroll-trigger" href="#contact">Kontakt</a>
                        <a class="dropdown-item  js-scroll-trigger" href="#page-top">Tagasi üles</a>
                    </div>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="#">Üliõpilasele</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="#">Juhendajale</a>
                </li>
              <li class="nav-item">
                <a class="nav-link lang-switch" target="_blank" href="#">EST</a>
              </li>
                
                <!--<li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#services">Karjäärinõu</a>
                </li>-->
                <!--<li class="nav-item">
                    <a class="nav-link" href="https://sisu.ut.ee/praktikamajanduses">Lähen praktikale</a>
                </li>-->
            </ul>
        </div>
    </div>
</nav>
<!--
<div class="news-big-logo-container position-absolute ml-n10 mt-n10 pt-12 pl-12 pr-5 pb-6 col-6 col-sm-6 col-md-5 col-lg-4 col-xl-4 d-none d-md-block">
    <div class="news-big-logo w-100 pt-3 text-align-left">
        <a title="Avalehele" alt="Avalehele" href="<?php echo $wwwroot; ?>">
            <img src="<?php echo $wwwroot; ?>img/ut-logo-et-white.png" class="w-100 img-fluid">
        </a>
    </div>
</div>-->