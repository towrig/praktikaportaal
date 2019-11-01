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
    <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../css/creative.min.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../css/custom.css?v=2" rel="stylesheet">

</head>

<body id="page-top">

    <?php echo loadHTML("../frags/navbar.html"); ?>
	
	<div id="page-content">
	
    <section class="page-section bg-primary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <hr class="divider light my-4">
                    <h2 class="text-white text-uppercase font-weight-bold mt-0">Organisatsioon</h2>
                    <p class="text-white-75 font-weight-light mb-5">Otsid praktikanti, töötajat või meeskonda? Lisa oma pakkumine või projektiidee juba täna!</p>
                    <hr class="divider light my-4">

                </div> <!-- .col-->
				<div class="col-lg-3">
					<a href="../editor" id="formToggler" class="toggleMenu btn-lg">LISA PAKKUMINE<span class="tooltip_mark" data-toggle="tooltip" data-placement="right" title="Esitatud pakkumised aeguvad lõpptähtaja möödumisel">?</span></a>
				</div>
				<div class="col-lg-3">
					<a href="../team" id="formToggler" class="toggleMenu btn-lg">ESITA PROJEKT<span class="tooltip_mark" data-toggle="tooltip" data-placement="right" title="Esitatud pakkumised aeguvad lõpptähtaja möödumisel">?</span></a>
				</div>
				<div class="col-lg-3">
					<a href="../praktika" target="_blank" rel="noopener noreferrer">
						<span class="toggleMenu btn-lg" style="padding: 16px;">VAATA PAKKUMISI<span class="tooltip_mark" data-toggle="tooltip" data-placement="right" title="Teiste poolt lisatud praktika- ja tööpakkumised ning projektid">?</span></span>
					</a>
				</div>
				<div class="col-lg-12">Sinu tulevased praktikandid/töötajad!</div>

            </div> <!-- .row -->
        </div> <!-- .container -->
    </section>

	
	<section id="profiles">
		<div class="container">
			<div class="row">
                <div class="col-md-12 text-center">
                    <p>Praktika- ja tööpakkumised</p>
                </div>
                <?php

                try {
                    $conn = new PDO('mysql:host=localhost;dbname=userdata', 'root', 'Kilud123');
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = $conn->prepare('SELECT heading,description,validationcode,picturepath FROM WorkPosts WHERE isvalidated = ?'); 
                    $query->execute(array(1));
                    $data = $query -> fetchAll();
                    foreach($data as $row){
                        //currently unused cols: name,email,phone,tasks,experience,work_location,work_type,other,logopath
                        $heading = $row["heading"];
                        $description = $row["description"];
                        $validationcode = $row["validationcode"];
                        $picurl = "../userdata/pictures/".$row["picturepath"];

                        $bigstring = '<div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="card" style="background: linear-gradient(to top, #faa41a 40%, rgba(255,255,255,.6)), url('.$picurl.');">
                                            <a href="../tootaja/kuulutus?c='.$validationcode.'">
                                            <div class="card-body text-left">
                                                <h6 class="card-title text-uppercase font-weight-bold mt-0">'.$heading.'</h6>
                                                <p class="card-text">'.$description.'</p>
                                            </div>
                                            </a>
                                        </div>
                                    </div>';

                        echo $bigstring;
                    }

                } catch(PDOException $e){
                    echo "Connection failed: " . $e->getMessage();
                }
            ?>

            </div>
		</div>
	</section>
	
	</div>

    <div id="main">
    </div>

    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    	<div class="modal-dialog" role="document">
	    	<div class="modal-content">

	    		<div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Tudengi info</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
		      	</div>
			    <div class="modal-body">
			    	<div class="row">

			    		<div class="col-md-4">
			    			<div class="modal-image-container">
			    				<div class="modal-image"></div>
			    			</div>
			    		</div>
			    		<div class="col-md-8">
			    			<div class="modal-student-info">
			    				
			    			</div>
			    		</div>

			    		<div class="col-md-12 modal-student-description">
			    			<p>Soovitud praktika/töö valdkond:</p>
			    			<p class="modal-work diff-text"></p>
			    			<p>Tugevused/oskused:</p>
			    			<p class="modal-skills diff-text"></p>
			    			<p>Kogemused:</p>
			    			<p class="modal-experience diff-text"></p>
			    			<p>Soovitud asukoht:</p>
			    			<p class="modal-location diff-text"></p>
			    			<p>*Sotsmeedia link*</p>
			    		</div>
			    	</div>
			    </div>

	    	</div>
	    </div>
	</div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template
    <script src="../js/creative.min.js"></script> -->

    <script type="text/javascript">
    	$(document).ready(function(){

    		$('.js-modal').on('click', openModal);

    		$("#category").change(function(){

    			if($("#category").val() == "date"){
    				$("#date_order").show();
    				$("#locations").hide();
    			}else{
    				$("#date_order").hide();
    				$("#locations").show();
    			}
    		});

    	});

    	function openModal(e){
    		var target = $(e.currentTarget);
    		var modal = $('.modal').first();

    		var name = target.data('name');
    		var pic = target.data('pic');
    		var degree = target.data('degree');
    		var skills = target.data('skills');
    		var exp = target.data('experience');
    		var work = target.data('work');
    		var loc = target.data('loc');
    		var email = target.data('email');

    		$('.modal-image').css('background-image', 'url('+pic+')');
    		$('.modal-student-info').empty();
    		$('.modal-student-info').append("<p>"+name+"</p><p>"+degree+"</p><a href=mailto:"+email+">"+email+"</a>");
    		$('.modal-work').text(work);
    		$('.modal-skills').text(skills);
    		$('.modal-experience').text(exp);
    		$('.modal-location').text(loc);

    		modal.modal('show');
    		
    	}
    </script>

</body>

</html>