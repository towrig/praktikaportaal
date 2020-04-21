<?php
    $t_pieces = t(array("fp-mh_text","fp-mh_title","fp-mh_h1","fp-mh_h2","fp-mh_h3","fp-mh1.0","fp-mh1.1","fp-mh1.2","fp-mh2","fp-mh3","fp-mh4","fp-mh5",
        "fp-mh2.0","fp-mh2.1","fp-mh2.2","fp-mh3.0","fp-mh3.1","fp-mh3.2"),$dbhost,$dbname,$dbuser,$dbpassword);
    $stats = array();
    try {
        $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Could not UNION together DISTINCT as type mismatch - so a new query later
        $query = $conn->prepare('SELECT COUNT(id) AS stats FROM People WHERE isvalidated = 1
                                UNION ALL SELECT COUNT(*) FROM ProjectPosts WHERE isactivated = 1
                                UNION ALL SELECT COUNT(*) FROM WorkPosts WHERE isvalidated = 1 AND end_date >= NOW()
                                UNION ALL SELECT COUNT(DISTINCT work_name) AS stats FROM WorkPosts WHERE isvalidated = 1
                                UNION ALL SELECT COUNT(*) FROM WorkPosts WHERE isvalidated = 1');
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
                <h3 class="mb-5" data-aos="fade-right"><?php echo $t_pieces["fp-mh_text"];?></h3>
                <h2 class="mb-5" data-aos="fade-right"><?php echo $t_pieces["fp-mh_title"];?></h2>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="d-flex flex-lg-nowrap justify-content-center flex-wrap link-cards"  data-aos="fade-left">
                  <a class="card m-5 m-md-4 m-xl-5 first" href="./uliopilased" onclick="gtag('event', 'Lisa',{'event_category': 'Avaleht','event_label':'Üliopilased'});">
                    <div class="card-body">
                      <i id="masthead-yliopilane"></i>
                        <h5 class="card-title text-uppercase"><?php echo $t_pieces["fp-mh_h1"];?></h5>
                        <p class="card-text text-muted">
                            <span><?php echo $t_pieces["fp-mh1.0"];?></span>
                            <span><?php echo $t_pieces["fp-mh1.1"];?></span>
                            <span><?php echo $t_pieces["fp-mh1.2"];?></span>
                            <span>&nbsp;</span>
                            <span>&nbsp;</span>
                            <span class="main-stats"><small><?php echo $stats[0]?></small><?php echo $t_pieces["fp-mh2"];?></span>
                        </p>
                      
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary"><?php echo $t_pieces["fp-mh3"];?></button>
                    </div>
                  </a>
                  <a class="card m-5 m-md-4 m-xl-5 second" href="./projektipraktika" onclick="gtag('event', 'Lisa',{'event_category': 'Avaleht','event_label':'Projektid'});">
                    <div class="card-body">
                      <i id="masthead-projekt"></i>
                        <h5 class="card-title text-uppercase"><?php echo $t_pieces["fp-mh_h2"];?></h5>
                        <p class="card-text text-muted">
                            <span><?php echo $t_pieces["fp-mh2.0"];?></span>
                            <span><?php echo $t_pieces["fp-mh2.1"];?></span>
                            <span><?php echo $t_pieces["fp-mh2.2"];?></span>
                            <span>&nbsp;</span>
                            <span class="main-stats"><small><?php echo $stats[1]?></small> <?php echo $t_pieces["fp-mh4"];?></span>
                        </p>
                      
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary"><?php echo $t_pieces["fp-mh3"];?></button>
                    </div>
                  </a>
                  <a class="card m-5 m-md-4 m-xl-5 third" href="./praktikapakkumised" onclick="gtag('event', 'Lisa',{'event_category': 'Avaleht','event_label':'Praktikapakkumised'});">
                    <div class="card-body">
                      <i id="masthead-praktikapakkumine"></i>
                        <h5 class="card-title text-uppercase"><?php echo $t_pieces["fp-mh_h3"];?></h5>
                        <p class="card-text text-muted">
                            <span><?php echo $t_pieces["fp-mh3.0"];?></span>
                            <span><?php echo $t_pieces["fp-mh3.1"];?></span>
                            <span><?php echo $t_pieces["fp-mh3.2"];?></span>
                            <span>&nbsp;</span>
                            <span class="main-stats"><small><?php echo $stats[2]?></small> <?php echo $t_pieces["fp-mh5"];?></span>
                        </p>
                      
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary"><?php echo $t_pieces["fp-mh3"];?></button>
                    </div>
                  </a>
                </div>
            </div>    
        </div>
    </div>
</header>
