<!DOCTYPE html>
<html lang="en">

<?php $title="Organisatsioonid"; include_once './../templates/header.php';?>

<body id="page-top">
    <?php include_once './../templates/top-navbar.php';?>
	
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

            </div> <!-- .row -->
        </div> <!-- .container -->
    </section>

	
	<section id="profiles">
		<div class="container">
			<div class="row">
                <div class="col-md-12 text-center">
                    <h2>Praktika- ja tööpakkumised</h2>
                </div>
                <?php

                try {
                    $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
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

                        $bigstring = '<div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body text-left">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <img src="'.$picurl.'" alt="Ettevõtte logo">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <a href="../tootaja/kuulutus?c='.$validationcode.'"><h6 class="card-title text-uppercase font-weight-bold mt-0">'.$heading.'</h6>
                                                                </a>
                                                                <p class="card-text">'.$description.'</p>
                                                                <hr>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="card-text"><i class="fa fa-suitcase"></i> RobotBot Inc</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="card-text"><i class="fa fa-calendar"></i> Lisatud 12 minutit tagasi</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                
                                                                <p class="card-text"><i class="fa fa-map-marker"></i> Asukoht</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="card-text"><i class="fa fa-calendar-times"></i> Lõpptähtaeg</p>
                                                            </div>
                                                       </div> 
                                                    </div>
                                                    <div class="col-md-2 text-center align-self-center">
                                                        <i class="fa fa-2x fa-heart "></i>
                                                        <p>Kandideeri <br> Like </p>
                                                    </div>
                                                </div>
                                            </div>
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