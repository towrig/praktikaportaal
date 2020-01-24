<?php
  $stats = array();
  try {
    $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Could not UNION together DISTINCT as type mismatch - so a new query later
    $query = $conn->prepare('SELECT COUNT(id) AS stats FROM People WHERE isvalidated = 1 UNION ALL SELECT COUNT(*) FROM ProjectPosts WHERE isactivated = 1 UNION ALL SELECT COUNT(*) FROM WorkPosts WHERE isvalidated = 1 UNION ALL SELECT COUNT(DISTINCT work_name) AS stats FROM WorkPosts WHERE isvalidated = 1');
    $query->execute();
    $data = $query -> fetchAll();

    foreach($data as $row){
        array_push($stats,$row["stats"]);
    }

    // Close PDO
    $query = null;
    $conn = null;

  } catch (PDOException $e){
    echo "Connection failed: " . $e->getMessage();
  }
?>
<header id="masthead" class="masthead d-flex flex-wrap align-content-center">
  <div class="bg-container">
    <div class="img-cont"></div>
  </div>
    <div id="main" class="container">
        <div class="row">
            
            <div class="col-lg-3 col-md-12">
                <h2 class="mb-5" data-aos="fade-right"><span>TULEVIK</span> ALGAB SINUST</h2>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="d-flex flex-lg-nowrap justify-content-center flex-wrap link-cards"  data-aos="fade-left">
                  <a class="card m-5 m-md-4 m-xl-5 first" href="./uliopilased" onclick="gtag('event', 'Lisa',{'event_category': 'Avaleht','event_label':'Üliopilased'});">
                    <div class="card-body">
                      <i id="masthead-yliopilane"></i>
                      <h5 class="card-title text-uppercase">Üliõpilased</h5>
                      <p class="card-text text-muted">
                        <span>Motiveeritud</span>
                        <span>üliõpilased</span>
                        <span>ja tulevased</span>
                        <span>praktikandid</span>
                        <span>&nbsp;</span>
                        <span>&nbsp;</span>
                        <span class="main-stats"><small><?php echo $stats[0]?></small> profiili</span>
                      </p>
                      
                    </div>
                    <div class="card-footer">
                      <button class="btn btn-sm btn-primary">VAATA</button>
                    </div>
                  </a>
                  <a class="card m-5 m-md-4 m-xl-5 second" href="./projektipraktika" onclick="gtag('event', 'Lisa',{'event_category': 'Avaleht','event_label':'Projektid'});">
                    <div class="card-body">
                      <i id="masthead-projekt"></i>
                      <h5 class="card-title text-uppercase">Projekti<wbr>praktika</h5>
                      <p class="card-text text-muted">
                        <span>Koostöös</span>
                        <span>sündinud</span>
                        <span>lahendused</span>
                        <span>projektiideele</span>
                        <span>&nbsp;</span>
                        <span class="main-stats"><small><?php echo $stats[1]?></small> projekti</span>
                      </p>
                      
                    </div>
                    <div class="card-footer">
                      <button class="btn btn-sm btn-primary">VAATA</button>
                    </div>
                  </a>
                  <a class="card m-5 m-md-4 m-xl-5 third" href="./praktikapakkumised" onclick="gtag('event', 'Lisa',{'event_category': 'Avaleht','event_label':'Praktikapakkumised'});">
                    <div class="card-body">
                      <i id="masthead-praktikapakkumine"></i>
                      <h5 class="card-title text-uppercase">Praktika<wbr>pakkumised</h5>
                      <p class="card-text text-muted">
                        <span>Uued</span>
                        <span>võimalused</span>
                        <span>ja huvitavad</span>
                        <span>praktikakohad</span>
                        <span>&nbsp;</span>
                        <span class="main-stats"><small><?php echo $stats[2]?></small> pakkumist</span>
                      </p>
                      
                    </div>
                    <div class="card-footer">
                      <button class="btn btn-sm btn-primary">VAATA</button>
                    </div>
                  </a>
                </div>
            </div>    
        </div>
    </div>
</header>
