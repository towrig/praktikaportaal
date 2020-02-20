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
    $participants = array();
	try {
		$conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8', $dbuser , $dbpassword);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare('SELECT * FROM ProjectPosts'); 
        $query->execute();
        $data = $query -> fetchAll();
        $i = 0;
	    foreach($data as $row){
	    	$entity = array();
	    	$entity["start_date"] = $row["start_date"];
	    	$entity["id"] = $row["id"];
	    	$entity["title"] = $row["title"];
            $entity["organisation"] = $row["organisation"];
            $entity["org_name"] = $row["org_email"];
            $entity["org_email"] = $row["org_email"];
            $entity["pdf_path"] = $row["pdf_path"];
	    	$entity["edit_key"] = $row["edit_key"];
            $entity["isactivated"] = $row["isactivated"];
            $entity["max_part"] = $row["max_part"]; 
	        $i+= 1;
            
            $query = $conn->prepare('SELECT * FROM ProjectParticipants WHERE project_id = ?');
            $query->execute(array($row["id"]));
            $data = $query -> fetchAll();
            $post_participants = array();
            $amount = 0;
            foreach($data as $row){
                $p = array($row["name"], $row["email"], $row["degree"], $row["skills"], $row["is_accepted"]);
                array_push($post_participants, $p);
                $amount++;
            }
            $entity["amount"] = $amount;
            
            $participants[$entity["id"]] = $post_participants;
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
    <link rel="stylesheet" href="../vendor/ui/jquery-ui.min.css">
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
                <h2>Üleslaetud projektid</h2>
                <div class="container px-0">
                    <div class="row">
                        <?php 
                            foreach ($projects as $p) {
                                $bigString = '<div class="col-md-12 mb-3">
                                    <div class="card">
                                        <div class="card-body text-left">
                                            <h6 class="card-title text-uppercase font-weight-bold mt-0">'.$p["title"].'</h6>
                                            <p class="card-text">Loodud: '.$p["start_date"].'</p>
                                            <hr class="solid">
                                            <div class="container">
                                            <div class="row">
                                            <form class="time-form">
                                                <div class="col-md-12">
                                                    <p>Registreerimise avamine:</p>
                                                </div>
                                                <div class="col-md-1 pr-0">
                                                    <label class="pt-1">Reg algus:</label><br>
                                                    <label class="pt-1">Reg lõpp:</label>
                                                </div>
                                                <div class="col-md-4 px-2">
                                                    <input required type="text" class="form-control datepicker mb-1" name="reg_start">
                                                    <input required type="text" class="form-control datepicker" name="reg_end">
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-sm btn-success">Uuenda registratsiooni</a>
                                                </div>
                                            </form>
                                            </div>
                                            </div>
                                            <hr class="solid">
                                            <div class="btn-group btn-group-md align-self-center" role="group" aria-label="Basic example">
                                                <a class="btn btn-sm btn-success proj-modal" data-id= "'.$p["id"].'" data-ekey="'.$p["edit_key"].'">Vaata osalejaid</a>
                                                '.(boolval($p["isactivated"])? '':'<a class="btn btn-sm btn-success activate-btn" data-email="'.$p["org_email"].'" data-title="'.$p["title"].'" data-editkey="'.$p["edit_key"].'">Aktiveeri!</a>').'
                                                <a class="btn btn-sm btn-warning" href="../userdata/projects/'.$p["pdf_path"].'" download>Laadi alla taotlus</a>
                                                <a class="btn btn-sm btn-danger archive-modal" data-id="'.$p["id"].'" data-title="'.$p["title"].'">Arhiveeri</a>
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
    
    <!-- participant modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="col-lg-12 participants-container">
                        <div class="container">
                            <div class="row"></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    <!-- archive modal -->
    <div class="modal fade arc-modal" id="viewModal" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="col-lg-12 px-0 mb-2">
                        <h1>Arhiveerimine</h1>
                    </div>
                    
                    <form method="POST" enctype="multipart/form-data" id="project_archiving">
                        
                        <div class="form-group mt-3">
                            <label>Projekti pealkiri:</label>
                            <h4 id="modal-project_name"></h4>
                        </div>
                        <div class="form-group">
                            <label>Eesmärk</label>
                            <textarea required class="form-control" id="project-goal" name="project-goal" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tegevused</label>
                            <textarea required class="form-control" id="project-actions" name="project-actions" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tulemused</label>
                            <textarea required class="form-control" id="project-results" name="project-results" rows="3"></textarea>
                        </div>
                        
                        <button id="archive-submit" type="submit" class="mt-3 text-center text-uppercase btn btn-lg btn-primary font-weight-light">Arhiveeri!</button>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/ui/jquery-ui.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template 
    <script src="../js/creative.min.js"></script>-->
    <script src="../js/trumbowyg/trumbowyg.min.js"></script>
    <script type="text/javascript">
        
        var participants = <?php echo json_encode($participants);?>;
        
        $(document).ready(function() {
            console.log(participants);
            $('.proj-modal').on('click', partModal);
            $('.archive-modal').on('click', archiveModal);
            $('#archive-submit').on('click', archivePost);
            $('.time-form').submit(updateReg);
            
            $(".datepicker").datepicker({
              showWeek: true,
              dateFormat: 'dd-mm-yy'
            });
        });
        
        function updateReg(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(e.currentTarget);
            var reg_start = target.find('input[name="reg_start"]');
            var reg_end = target.find('input[name="reg_end"]');
            console.log(reg_start);
            console.log(reg_end);
        }
        
        function archiveModal(e){
            var target = $(e.currentTarget);
            var modal = $(".arc-modal").first();
            var id = target.data("id");
            var title = target.data("title");
            
            $('#archive-submit').data("id",id);
            $('#modal-project_name').html(title);
            console.log("I ran on:");
            console.log(target);
            modal.modal("show");
        }
        
        function archivePost(e){
            var target = $(e.currentTarget);
            let formData = new FormData(document.getElementById('project_submission'));
            formData.append("project-name", $("#modal-project_name").html());
            formData.append("project-id", target.data("id"));
            formData.append("archiving", 1);
            
            $.ajax({
                type: 'POST',
                url: './admin_api.php',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(response) {
                console.log(response);
            }).fail(function(response) {
                console.log(response);
            });
        }
        
        function partModal(e){
            var target = $(e.currentTarget);
            var modal = $(".modal").first();
            var ekey = target.data("ekey");
            var post_part = participants[target.data("id")];
            var p_c = modal.find('.participants-container .container .row');
            p_c.empty();
            if (post_part.length != 0) {
                for (var i = 0; i < post_part.length; i++) {
                    p_c.append(createParticipant(post_part[i], ekey));
                }
            }
            $('.part-btn').on('click', handleParticipant);
            console.log("showing");
            modal.modal("show");
        }
        
        function handleParticipant(e){
            var target = $(e.currentTarget);
            var formData = new FormData();
            formData.append("email", target.data("email"));
            formData.append("edit_key", target.data("ekey"));
            formData.append("action", "approve");
            $.ajax({
                type: 'POST',
                url: '../projektipraktika/project_api.php',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(response) {
                target.remove();
                console.log(response);
            }).fail(function(response) {
                console.log(response);
            });
            
        }
        
        function createParticipant(arr, ekey) {
            var name = arr[0];
            var email = arr[1];
            var degree = arr[2];
            var skills = arr[3];
            var is_accepted = arr[4];
            console.log(is_accepted);
            var acceptButton = "";
            if (is_accepted == 0) acceptButton = '<a class="btn btn-sm btn-success part-btn" data-email="'+email+'" data-ekey="'+ekey+'">Kinnita</a>';
            //var refuseButton = '<a class="btn btn-sm btn-danger part-btn" data-id="'.id.'" data-action="refuse">Keeldu</a>';
            return $('<div>').addClass("col-lg-3 participant m-2").html("<h6>" + name + "</h6>" + "<p>" + email + "</p>" + "<p>" + degree + "</p>" + "<p>" + skills + "</p>"+acceptButton);
        }
        
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
            var title = $(e.currentTarget).data("title");
            var email = $(e.currentTarget).data("email");
            let formData = new FormData();
            formData.append("edit_key", key);
            formData.append("title", title);
            formData.append("email", email);
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
