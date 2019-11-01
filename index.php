<?php

    function loadHTML($filename){
        $target = fopen($filename, "r") or die("Failed to open file!");
        $html_to_return = fread($target, filesize($filename));
        fclose($target);
        return $html_to_return;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Praktikavahenduste keskkond</title>

    <!-- Font Awesome Icons -->
    <!--<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <!--<link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">-->

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../css/creative.min.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../css/custom.css?v=2" rel="stylesheet">

</head>

<body id="page-top" class="front">

    <?php echo loadHTML("frags/navbar.html"); ?>

    <!-- Masthead -->
    <header class="masthead" style="height: unset;">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-uppercase text-white font-weight-bold">DELTAKi praktikavahenduse keskkond</h1>
                    <hr class="divider my-4">
                </div>
                <div class="col-lg-10 align-self-baseline">
                    <p class="text-white-75 font-weight-light mb-5">sest kogemused viivad edasi<br>sest kogemused loevad</p>
                    <div class="row h-100 align-items-center justify-content-center text-center">
                <h2 class="text-uppercase text-white font-weight-bold">Olen</h2>
            </div>
            <!--<hr class="divider light">-->
                    <div class="row my-5 h-100 btn-main-container main-icons-container">

                        <div class="col-md-4" style="transform: translate(20%,20%);">
                            <img src="/img/nool.png" class="arrow left" style="width: 50%;transform: rotate(-30deg); position: absolute; right:0;">
                        </div>

                        <a class="col-md-4" href="/praktika" style="padding: 0 0 80px">
                            <div class="text-uppercase text-white font-weight-bold">
                                <i class="fas fa-user fa-4x"></i>
                                <p>Üliõpilased</p>
                            </div>
                        </a>

                        <div class="col-md-4" style="transform: translate(-20%,20%);">
                            <img src="/img/nool.png" class="arrow right" style="width: 50%;transform: rotate(45deg); position: absolute; left:0;">
                        </div>

                        <a class="col-md-4" href="/team" style="transform: translate(25%,0);">
                            <div class="text-uppercase text-white font-weight-bold"><i class="fas fa-users fa-4x"></i>
                                <p>projektid ja tiimid</p>
                            </div>
                        </a>

                        <div class="col-md-4" style="transform: translate(0, 15%);">
                            <img src="/img/nool.png" class="arrow bottom" style="width: 50%; transform: rotate(180deg);">
                        </div>

                        <a class="col-md-4" href="/tootaja" style="transform: translate(-25%,0);">
                            <div class="text-uppercase text-white font-weight-bold">
                                <i class="fas fa-city fa-4x"></i>
                                <p>Töö- ja praktikapakkumised</p>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="section-intro my-5">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12">
                    <h1 style="text-align: center;margin-bottom: 12px">Miks DELTAK?</h1>
                    <p>Ülikoolist kogemused, mis aitavad eriala teadmisi rakendada ning toetavad sinu arengut mitmekülgselt.</p>
                </div>

            </div>
            <div class="row">
                
                <div class="col-lg-3">
                    <div class="table-header">
                        IKOON
                    </div>
                    <div class="table-bottom">
                        <h5>KÄED KÜLGE ÕPPIMINE</h5>
                        <p>Edu muutmine tähendab arengut praktilise tegevuse kaudu.</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="table-header">
                        IKOON
                    </div>
                    <div class="table-bottom">
                        <h5>INTERDISTSIPLINAARSUS</h5>
                        <p>Tegutsed keskkonnas, kus kaasüliõpilased, probleemid ja väljakutsed ületavad eriala piire.</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="table-header">
                        IKOON
                    </div>
                    <div class="table-bottom">
                        <h5>TULEVIKUOSKUSED</h5>
                        <p>Oma edu muutmiseks analüüsid tulevikuoskuste rakendamist.</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="table-header">
                        IKOON
                    </div>
                    <div class="table-bottom">
                        <h5>PIIRIDETA</h5>
                        <p>DELTA maja pakub piirideta võimalusi…</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="section-work my-5">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <h1>DELTAk on Sinu edu hooandja!</h1>
                    <p>DELTAkis oleme keskendunud sellele, et avardada ja toetada Sinu tuleviku- ja karjääri väljavaateid ning kasvatada enesekindlust ja oskusi, liikumaks oma eesmärkide suunas, et:<br>
                    ✓ Olla tööturul hinnatud ja konkurentsivõimeline<br>
                    ✓ Keskenduda oma tugevuste parendamisele ja nõrkuste arendamisele<br>
                    ✓ Osaleda ja panustada inspireerivasse võrgustikku koos ägedate üliõpilaste, andekate juhendajate ja tipptööandjatega!
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="upper uneven">
                        PRAKTIKA
                    </div>
                    <div class="lower uneven">
                        Üliõpilase arengule suunatud erinevad praktikavõimalused.<br>
                        Tutvu ja kandideeri!
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="upper even">
                        Interdistsiplinaarsed projektid, et koos meeskonnaga lahendada olulisi probleeme ja leida loovaid lahendusi.<br>
                        Vaata siia!
                    </div>
                    <div class="lower even">
                        PROJEKTID
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="upper uneven">
                        LIIDRIPROGRAMM
                    </div>
                    <div class="lower uneven">
                        Tunnustame üliõpilase ülikooliväliseid tegevusi, mida saab jagada oma tööandjaga! 
                        Tule Liidriks!
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="upper even">
                        Ideede elluviimist ja probleemide lahendamist toetavad teemaseminarid. Vali huvipakkuv ja osale!
                    </div>
                    <div class="lower even">
                        SEMINARID
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Võta meiega ühendust!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
        <form action="/feedback.php" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">E-posti aadress</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="nimi@kirjaserver.ee">
                <small id="emailHelp" class="form-text text-muted">Me ei jaga teie e-posti aadressi teistega vaid kasutame seda vaid teiega ühenduse võtmiseks.</small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Ole hea ja täpsusta oma soov</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>Tööpakkumine</option>
                    <option>Praktika leidmine</option>
                    <option>Soovin pakkuda teenust</option>
                    <option>Soovin infot</option>
                    <option>Muu</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Sõnumi sisu</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <input type="submit" class="btn btn-xl btn-primary" style="width:100%;float:right;"formmethod="post" value="Saada" data-dismiss="modal">
        </form>
          
      </div>
    </div>
  </div>
</div>

    <!-- Footer -->
    <!--<footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">2019 - Tartu Ülikool majandusteaduskond</div>
        </div>
    </footer>-->

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <!--<script src="vendor/jquery-easing/jquery.easing.min.js"></script>-->
    <!--<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>-->

    <!-- Custom scripts for this template -->
    <!--<script src="js/creative.min.js"></script>-->
    <script>
        console.log(sessionStorage.getItem("editkey"));
    </script>

</body>

</html>