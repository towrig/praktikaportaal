<?php
  $stats = array();
  try {
    $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Could not UNION together DISTINCT as type mismatch - so a new query later
    $query = $conn->prepare('SELECT COUNT(*) AS stats FROM People WHERE isvalidated = 1 UNION SELECT COUNT(*) FROM ProjectPosts WHERE isactivated = 1 UNION SELECT COUNT(*) FROM WorkPosts WHERE isvalidated = 1');
    $query->execute();
    $data = $query -> fetchAll();

    foreach($data as $row){
        array_push($stats,$row["stats"]);
    }
    $query = $conn->prepare('SELECT COUNT(DISTINCT work_name) AS stats FROM WorkPosts WHERE isvalidated = 1');
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
<section id="stats" class="section main-row">
    <div class="section-container container text-center">
        <div class="row">
            <div class="column col-lg-12">
                <div class="column-wrapper">
                    <div id="divider" class="divider">
                        <div class="divider-content">
                              <h3 class="text-uppercase my-5">Meiega on liitunud</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column col-xs-12 col-sm-3">
                <div class="column-wrapper">
                    <div>
                        <i id="stat-praktikant"></i>
                        <h2 class=" my-4"><?php echo $stats[0]?></h2>
                    </div>
                    <div>
                      <h5 class="h6 text-uppercase mb-2">üliõpilast</h5>
                    </div>
                </div>
            </div>
            <div class="column col-xs-12 col-sm-3">
                <div class="column-wrapper">
                    <div>
                      <i id="stat-projekt"></i>
                        <h2 class=" my-4"><?php echo $stats[1]?></h2>
                    </div>
                    <div>
                      <h5 class="h6 text-uppercase mb-2">projekti</h5>
                  </div>
                </div>
            </div>
            <div class="column col-xs-12 col-sm-3">
                <div class="column-wrapper">
                    <div>
                      <i id="stat-praktikapakkumine"></i>
                        <h2 class=" my-4"><?php echo $stats[2]?></h2>
                    </div>
                    <div>
                      <h5 class="h6 text-uppercase mb-2">praktika<wbr>pakkumist</h5>
                    </div>
                </div>
            </div>
            <div class="column col-xs-12 col-sm-3">
                <div class="column-wrapper">
                    <div>
                      <i id="stat-organisatsioon"></i>
                        <h2 class="my-4"><?php echo $stats[3]?></h2>
                    </div>
                    <div>
                      <h5 class="h6 text-uppercase mb-2">organisatsiooni</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
