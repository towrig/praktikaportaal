<?php 

	$projects = array();

	try {
		$conn = new PDO('mysql:host=localhost;dbname=userdata', 'root', 'Kilud123');
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
			.trumbowyg-box{ 
				min-height: 100px !important;
			}
		</style>
	</head>
	<body>
		
		<div class="container">
			<div class="row">
				
				<div class="col-md-12 my-5">
					<h1>Tekstide muutmiseks sisestage alla lahtrisse salavõti.</p>
					<input type="text" name="key" class="admin-key-input">
				</div>

				<div class="col-md-12 my-5">
					<h2>Üliõpilase vaate tekstid</h2>
					<form class="container work" target="_self" method="post" enctype="multipart/form-data">
						<div class="row">
							<p>
								<textarea class="form-control" id="area"></textarea>
							</p>
						</div>
					</form>
				</div>



				<div class="col-md-12 my-5">
					<h2>Organisatsiooni vaate tekstid</h2>
				</div>


				<div class="col-md-12 my-5">
					<h2>Projektide vaate tekstid</h2>
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

	    <!-- Custom scripts for this template -->
	    <script src="../js/creative.min.js"></script>
		<script src="../js/trumbowyg/trumbowyg.min.js"></script>
		<script type="text/javascript">
			$('#area').trumbowyg({
				autogrow: true
			});

			('.trumbowyg-button-pane').css('display','none');
			$('.trumbowyg-box').focusout(function(event){
				$(this).find('.trumbowyg-button-pane').fadeOut(200);
			});
			$('.trumbowyg-box').focusin(function(event){
				$(this).find('.trumbowyg-button-pane').fadeIn(200);
			});

		</script>
	</body>
</html>