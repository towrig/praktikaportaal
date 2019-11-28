<header class="masthead d-flex flex-wrap align-content-center">
    <ul class="bg-rects">
        <?php for ($i = 0; $i < 10; $i++) {
            // Generate 10 LI-s for animation
            echo "<li></li>";
        }?>
    </ul>
    <div id="main" class="container-fluid m-5">
        <div class="row text-center">
            
            <div class="col-lg-6 col-md-12 align-self-center">
                <h1 class="text-white font-weight-bold">f<span>UT</span>ulab</h1>
                <h4 class="text-white-75 font-weight-light mb-5 text-right">" Tulevik algab sinust "</h4>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="d-flex flex-lg-nowrap flex-wrap">
                  <div class="card m-1">
                    <div class="card-body">
                      <i class="fas fa-user fa-4x mb-4"></i>
                      <h5 class="card-title text-uppercase">Üliõpilased</h5>
                      <p class="card-text text-muted">Tahad ennast nähtavaks teha? Siis tule ja lisa enda profiil ja astu esimene samm juba täna!</p>
                      <a class="" href="./praktika"><button class="btn btn-primary">Loe rohkem</button></a>
                    </div>
                    <div class="card-footer">
                      <small class="text-muted"><span>4</span> profiili</small>
                    </div>
                  </div>
                  <div class="card m-1">
                    <div class="card-body">
                      <i class="fas fa-users fa-4x mb-4"></i>
                      <h5 class="card-title text-uppercase">Projektid</h5>
                      <p class="card-text text-muted">Tahad leida huvitavat ettevõtmist ja võtta osa projektist? Või soovid esitada projekti ning leida abilisi?</p>
                      <a class="" href="./team"><button class="btn btn-primary">Loo rohkem</button></a>
                    </div>
                    <div class="card-footer">
                      <small class="text-muted"><span>2</span> projekti</small>
                    </div>
                  </div>
                  <div class="card m-1">
                    <div class="card-body">
                      <i class="fas fa-city fa-4x mb-4"></i>
                      <h5 class="card-title text-uppercase">Praktika-pakkumised</h5>
                      <p class="card-text text-muted">Tahad leida praktikante või pakkuda tööd? Lisa oma praktikapakkumine ning leia endale parim abiline</p>
                      <a class="" href="./tootaja"><button class="btn btn-primary">Loe rohkem</button></a>
                    </div>
                    <div class="card-footer">
                      <small class="text-muted"><span>7</span> pakkumist</small>
                    </div>
                  </div>
                </div>
            </div>    
            <!-- NEW WORKING -->
            <!--
            <div class="col-lg-12 align-self-end">
                <h1 class="text-white font-weight-bold">f<span>UT</span>ulab</h1>
            </div>
            <div class="col-lg-12 align-self-baseline">
                <h4 class="text-white-75 font-weight-light mb-5 text-right">" Tulevik algab sinust "</h4>
            -->
                <!-- SOME OLD CODE -->
                <!--<hr class="divider light">-->
                <!--
                <div class="row my-5 h-100 btn-main-container main-icons-container">
                    <div class="col-md-4" style="transform: translate(20%,20%);">
                        <img src="img/nool.png" class="arrow left" style="width: 50%;transform: rotate(-30deg); position: absolute; right:0;">
                    </div>
                    <a class="col-md-4" href="./praktika" style="padding: 0 0 80px">
                        <div class="text-uppercase text-white font-weight-bold">
                            <i class="fas fa-user fa-4x"></i>
                            <p>üliõpilane</p>
                        </div>
                    </a>
                    <div class="col-md-4" style="transform: translate(-20%,20%);">
                        <img src="img/nool.png" class="arrow right" style="width: 50%;transform: rotate(45deg); position: absolute; left:0;">
                    </div>
                    <a class="col-md-4" href="./team" style="transform: translate(25%,0);">
                        <div class="text-uppercase text-white font-weight-bold"><i class="fas fa-users fa-4x"></i>
                            <p>projektid ja tiimid</p>
                        </div>
                    </a>
                    <div class="col-md-4" style="transform: translate(0, 15%);">
                        <img src="img/nool.png" class="arrow bottom" style="width: 50%; transform: rotate(180deg);">
                    </div>
                    <a class="col-md-4" href="./tootaja" style="transform: translate(-25%,0);">
                        <div class="text-uppercase text-white font-weight-bold">
                            <i class="fas fa-city fa-4x"></i>
                            <p>organisatsioon</p>
                        </div>
                    </a>
                </div>
-->
               <!-- <div class="row my-5 h-100 intro-box mt-0">
                    <div class="col-md-4 p-5">
                        <a href="./praktika" >
                            <div>
                                <i class="fas fa-user fa-4x"></i>
                                <p class="text-uppercase font-weight-bold pt-3">Üliõpilased</p>
                               
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 p-5">
                        <a href="./team">
                            <div>
                                <i class="fas fa-users fa-4x"></i>
                                <p class="text-uppercase font-weight-bold pt-3">Projektid</p>
                               
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 p-5">
                        <a href="./tootaja">
                            <div>
                                <i class="fas fa-city fa-4x"></i>
                                <p class="text-uppercase font-weight-bold pt-3">Praktikapakkumised</p>
                               
                            </div>
                        </a>
                    </div>
                </div> -->

                <!-- !END SOME OLD CODE -->
                
               <!-- 
                <div class="card-deck">
                  <div class="card">
                    <div class="card-body">
                      <i class="fas fa-user fa-4x mb-4"></i>
                      <h5 class="card-title text-uppercase">Üliõpilased</h5>
                      <p class="card-text text-muted">Tahad ennast nähtavaks teha? Siis tule ja lisa enda profiil ja astu esimene samm juba täna!</p>
                      <a class="" href="./praktika"><button class="btn btn-primary">Loe rohkem</button></a>
                    </div>
                    <div class="card-footer">
                      <small class="text-muted"><span>4</span> profiili</small>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <i class="fas fa-users fa-4x mb-4"></i>
                      <h5 class="card-title text-uppercase">Projektid</h5>
                      <p class="card-text text-muted">Tahad leida huvitavat ettevõtmist ja võtta osa projektist? Või soovid esitada projekti ning leida abilisi?</p>
                      <a class="" href="./team"><button class="btn btn-primary">Loo rohkem</button></a>
                    </div>
                    <div class="card-footer">
                      <small class="text-muted"><span>2</span> projekti</small>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-body">
                      <i class="fas fa-city fa-4x mb-4"></i>
                      <h5 class="card-title text-uppercase">Praktikapakkumised</h5>
                      <p class="card-text text-muted">Tahad leida praktikante või pakkuda tööd? Lisa oma praktikapakkumine ning leia endale parim abiline</p>
                      <a class="" href="./tootaja"><button class="btn btn-primary">Loe rohkem</button></a>
                    </div>
                    <div class="card-footer">
                      <small class="text-muted"><span>7</span> pakkumist</small>
                    </div>
                  </div>
                </div>
            
            </div>-->
        </div>
    </div>
</header>
<!--<div class="container w-100" style="overflow:hidden;">
<div class="news-big-logo-container bottom-ut position-absolute ml-n10 mt-n10 pt-12 pl-12 pr-5 pb-6 col-6 col-sm-6 col-md-5 col-lg-4 col-xl-4 d-none d-md-block w-100">
</div>
</div>-->