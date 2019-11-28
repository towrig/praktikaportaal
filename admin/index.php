<?php 
    // Load config.php
    $CFG = new stdClass();
    $CFG->docroot = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
    if (!is_readable($CFG->docroot . 'config.php')) {
        // If it is not readable then exit.
        exit;
    }
    require($CFG->docroot . 'config.php');
    $CFG = (object)array_merge((array)$cfg, (array)$CFG);
    $wwwroot = $CFG->wwwroot;

    $dbhost = $CFG->dbhost;
    $dbname = $CFG->dbname;
    $dbuser = $CFG->dbuser;
    $dbpassword = $CFG->dbpasswd;

	$projects = array();

	try {
		$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare('SELECT * FROM ProjectPosts'); 
        $query->execute();
        $data = $query -> fetchAll();
        $i = 0;
	    foreach($data as $row){
	    	$entity = array();
	    	$entity["start_date"] = $row["start_date"];
	    	$entity["end_date"] = $row["end_date"];
	    	$entity["id"] = $row["id"];
	    	$entity["title"] = $row["title"];
	    	$entity["edit_key"] = $row["edit_key"];
            $entity["isactivated"] = $row["isactivated"];
	        $projects[$i] = $entity;
	        $entity = null; 
	        $i+= 1;
	    }
	    $conn = null;
	}catch (PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}

?>
<html>

<head>
    <title>praktika.ut.ee - Administrator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../css/creative.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../js/trumbowyg/ui/trumbowyg.min.css">
    <style>
        .trumbowyg-editor,
        .trumbowyg-box {
            min-height: 100px !important;
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="row">

            <div class="col-md-12 my-5">
                <h3>Sisesta võti ja vajuta nuppu muutmisreziimi aktiveerimiseks</h3>
                <input type="text" name="key" class="admin-key-input">
                <div class="btn-group btn-group-md align-self-center" id="editmodeActivator">
                    <span class="btn btn-sm btn-success" onclick="activateEditmode()">Aktiveeri muutimisreziim</span>
                </div>
            </div>
            <div class="col-md-12 my-5">
                <h2>Üleslaetud projektid koos nende muutmiseks vajalike linkidega</h2>
                <div class="container">
                    <div class="row">
                        <?php 
                            foreach ($projects as $p) {
                                $bigString = '<div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body text-left">
                                            <h6 class="card-title text-uppercase font-weight-bold mt-0">'.$p["title"].'</h6>
                                            <p class="card-text">Loodud: '.$p["start_date"].'<br> Reg. lõpp: '.$p["end_date"].'<br></p>
                                            <div class="btn-group btn-group-md align-self-center" role="group" aria-label="Basic example">
                                                <a class="btn btn-sm btn-success" href="../team/viewproject?c='.$p["id"].'&e='.$p["edit_key"].'">Mine muutma</a>
                                                '.(boolval($p["isactivated"])? '':'<a class="btn btn-sm btn-success activate-btn" data-editkey='.$p["edit_key"].'>Aktiveeri!</a>').'
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                echo $bigString;
                            }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template 
    <script src="../js/creative.min.js"></script>-->
    <script src="../js/trumbowyg/trumbowyg.min.js"></script>
    <script type="text/javascript">

        function activateEditmode() {
            let formData = new FormData();
            formData.append("edit_key", $('.admin-key-input').val());
            $.ajax({
                type: 'POST',
                url: 'admin_api.php',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(response) {
                console.log(response);
                sessionStorage.setItem("editkey",response);
                $('#editmodeActivator').after("<div class='alert alert-success'>Muutmine aktiveeritud. Lülitub välja brauseri sulgemisel.</div>");
            }).fail(function(response) {
                console.log(response);
                $('#editmodeActivator').after("<div class='alert alert-danger'>Muutmise aktiveeritmine ebaõnnestus!</div>");
            });
        }
        
        function activateProject(e) {
            var key = $(e.currentTarget).data("editkey");
            let formData = new FormData();
            formData.append("edit_key", key);
            formData.append("activateProject", 1);
            $.ajax({
                type: 'POST',
                url: 'admin_api.php',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(response) {
                $(e.currentTarget).remove();
                console.log(response);
            }).fail(function(response) {
                console.log(response);
            });
        }
        $('.activate-btn').on('click', activateProject);

    </script>
</body>

</html>
