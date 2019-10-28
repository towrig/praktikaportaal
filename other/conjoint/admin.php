<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/admin.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<title>Conjoint - Admin</title>
	</head>
	<body>
		<header class="topBar">
			<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			  <div class="collapse navbar-collapse">

			    <ul class="navbar-nav mr-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="#">Admin<span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="tulemused.php">Tulemused</a>
			      </li>
			    </ul>

			  </div>
			</nav>
		</header>
		<div class="content container mt-4">
			<div class="row justify-content-center">
				
				<div class="name-area form-inline col-md-12 justify-content-center">
					<div class="form-group mb-2">
						<input type="text" readonly class="form-control-plaintext" id="form-name" value="Testi nimi:">
					</div>
					<div class="form-group mb-2">
						<input type="text" class="form-control" id="test_name" name="test-name" placeholder="Sisesta nimi...">
						<div class="valid-feedback">
					    	Nimi sobib!
					    </div>
					    <div class="invalid-feedback">
					    	Nimi ei sobi!
					    </div>
					</div>
					<div class="form-group mb-2">
						<input type="text" readonly class="form-control-plaintext mx-3" value="Hetkel nimi:">
					</div>
					<div class="form-group mb-2">
						<input type="text" readonly class="form-control-plaintext mx-3" id="current-form-name">
					</div>
				</div>

				<div class="col-md-12 text-center section-heading my-3">
					<h3>Sissejuhatav tekst enne küsimusi</h3>
				</div>

				<div class="text-area col-md-12 form justify-content-center">
					<div class="form-group mb-2">
						<textarea class="form-control" name="intro-text" id="intro-text-q" placeholder="Tekst siia..."></textarea>
					</div>
				</div>

				<div class="col-md-12 text-center section-heading my-3">
					<h3>Sissejuhatav tekst enne pilte</h3>
				</div>

				<div class="text-area col-md-12 form justify-content-center">
					<div class="form-group mb-2">
						<textarea class="form-control" name="intro-text" id="intro-text-pic" placeholder="Tekst siia..."></textarea>
					</div>
				</div>
				
				<div class="col-md-12 text-center section-heading my-3 d-none">
					<h3>Küsimused</h3>
				</div>

				<div class="col-md-12 justify-content-center d-none">
					<div class="col-md-12 form-inline mb-3 q1">
						<div class="form-group mr-2">
							<input type="text" class="form-control question" placeholder="Küsimus..?">
						</div>
						<div class="form-group">
							<input type="text" class="form-control answer">
						</div>
					</div>
					<div class="col-md-12 form-inline mb-3 q2">
						<div class="form-group mr-2">
							<input type="text" class="form-control question" placeholder="Küsimus..?">
						</div>
						<div class="form-group">
							<input type="radio" class="form-control option"><a class="btn btn-outline-danger delete-btn">X</a>
						</div>
						<a class="btn btn-outline-primary mb-2">Lisa valik</a>
					</div>
					<div class="col-md-12">
						<a class="btn btn-outline-primary mb-2" id="q_radio">Lisa valiku küsimus</a>
						<a class="btn btn-outline-primary mb-2" id="q_text">Lisa tekstialaga küsimus</a>
					</div>
					
				</div>
				
				<div class="col-md-12 my-2">
					<a class="btn btn-success" href="" target="blank_" rel="noopener noreferrer" id="test_link">Testi link</a><br>
					<a class="btn btn-warning" href="" target="blank_" rel="noopener noreferrer" id="results_link">Tulemuste link</a>
				</div>

				<button class="btn btn-primary mb-4 save">Salvesta</button>
 
				<div class="pic_upl col-md-12 mt-3 disabled">
					<p class="my-2">Piltide muutmine ja sisestamine (soovitatav suurus 512x512px);<br><span style="color: red; font-size: 12px;"> Ülemine "Salvesta" nupp EI salvesta pilte!</span></p>
					<form method="POST" action="savepic.php" enctype="multipart/form-data" id="picture_area" class="mx-1 my-3">
						<div class="container">
							<div class="row">

								<div class="col-md-4 img-container" id="adder">
									<button class="btn btn-outline-primary my-5 mx-5 add" type="button">Lisa</button>
								</div>

							</div>
						</div>
						<input type="hidden" name="pic_helper" id="pic_helper" value="def">
						<input class="btn btn-outline-primary my-2" type="button" id="update_pics" value="Uuenda pildid">
					</form>
				</div>

			</div>
		</div>

		<div class="modal fade popup" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle">Conjoint testi valimine</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
			  <div class="modal-body">
			    <div class="container-fluid">

			      <div class="row">
			        <div class="col-md-12 text-align-center">
			        	<p>Vali olemasolev test muutmiseks</p>
			        	<div class="dropdown">
						  <button class="btn btn-secondary dropdown-toggle test_dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    Vali...
						  </button>
						  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						    
						  </div>
						</div>
						<p>või</p>
						<button type="button" class="btn btn-outline-primary new-test">Loo uus</button>
			        </div>
			      </div>

			    </div>
			  </div>
			  <div class="modal-footer">
		      </div>
		    </div>
		  </div>
		</div>

		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.bundle.min.js"></script>
		<script type="text/javascript">

			var new_test = false;
			var name = "";
			var intro_text_q = "";
			var intro_text_pic = "";
			var img_string = "";
			var images = [];
			var questions = "";

			var test_link_base = "http://praktika.ut.ee/other/conjoint?t=";
			var results_link_base = "http://praktika.ut.ee/other/conjoint/tulemused.php?t=";

			var tests = [];
			<?php

	        	try{
					$conn = new PDO('mysql:host=localhost;dbname=conjoint', 'root', 'Kilud123');
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//echo "Connected to PDO successfully"; 
					$query = $conn->prepare('SELECT * FROM tests');
					$query->execute(array());
					$i = 0;
					foreach($query as $row){
						$entry = "tests[".$i."] = ['".$row["name"]."', '".$row["img_string"]."', '".htmlspecialchars($row["intro_q"], ENT_QUOTES, 'utf-8')."', '".$row["intro_pic"]."'];\n";
						echo htmlspecialchars($entry);
						$i += 1;
					}
					$conn = null;
				} catch (Exception $e){
					echo 'Caught exception: ', $e->getMessage(), "\n";
				}

        	?>

        	function readURL(input){
        		if(input.files && input.files[0]){
        			var reader = new FileReader();
        			reader.onload = function(e){
        				$(input.parentNode).find('img').attr('src', e.target.result);
        			}
        			reader.readAsDataURL(input.files[0]);

        			var loc = $('.file').index(input); //which pic was changed.
        			images[loc] = "changed";
        			console.log("img arr: "+images.toString());
        		}
        	}

        	function removeParent(e){
        		images.splice($('.file').index(e),1);
				$(e.parentNode).remove();
				console.log(images.toString());
        	}

        	function updateLinks(){
        		$('#results_link').attr("href", results_link_base+name);
        		$('#test_link').attr("href", test_link_base+name);
        	}

        	function initEnv(){
        		$('#current-form-name').val(name); //test name
        		$('#test_name').val(name);
        		$('#intro-text-q').val(intro_text_q); //intro text
        		$('#intro-text-pic').val(intro_text_pic);
        		
        		if(!new_test){
        			//images
        			$('.pic_upl').removeClass('disabled');
	        		var img_arr = (img_string != "") ? img_string.split(',') : [];
	        		images = img_arr;
	        		for (var i = 0; i < img_arr.length; i++) {
	        			var elem = "<div class='col-md-4 img-container'><img src='images/"+ img_arr[i] +
	        			"' class='img'><input class='file' type='file' name='imgs[]'><button class='btn btn-outline-danger my-2 remove' type='button' onclick='removeParent(this)'>Kustuta</button></div>";
						$(elem).insertBefore("#adder");
						$('#adder').prev().find('.file').change(function(){
							readURL(this);
						});
						console.log("added img: "+$('#adder').prev());
	        		}
        		}
        		
				$('.popup').modal('hide');
        	}

			$(document).ready(function(){

				$('#q_radio').click(function(){

				});

				$('#q_text').click(function(){

				});

				for (var i = 0; i < tests.length; i++) {
					parts = tests[i];
					$('.dropdown .dropdown-menu').append("<a class='dropdown-item' href='#' data-name='"+parts[0]+"' data-intro_q='"+parts[2]+"' data-intro_pic='"+parts[3]+"' data-imgs='"+parts[1]+"'>"+parts[0]+"</a>");
				}

				$('.popup').modal('show');

				$('.new-test').click(function(){
					name = "";
					img_string = "";
					intro_text_q = "";
					intro_text_pic = "";
					new_test = true;
					initEnv();
				});
				$('.dropdown-menu .dropdown-item').click(function(){
					console.log(this);
					name = $(this).data("name");
					img_string = $(this).data("imgs");
					intro_text_q = $(this).data("intro_q").replace("</br>","\n");
					intro_text_pic = $(this).data("intro_pic").replace("</br>","\n");
					new_test = false;
					initEnv();
					updateLinks();
				});

				//pictures
				$('.file').change(function(){
					readURL(this);
				});
				$('.add').click(function(){
					var elem = "<div class='col-md-4 img-container'"+
					"><img src='' class='img'><input class='file' type='file' name='imgs[]'"+
					"><button class='btn btn-outline-danger my-2 remove' type='button' onclick='removeParent(this)'>Kustuta</button></div>";
					$(elem).insertBefore("#adder");
					$('#adder').prev().find('.file').change(function(){
						readURL(this);
					});
					images.push('+');
					console.log("added img: "+images.toString());
				});
				$('#update_pics').click(function(){
					$('#pic_helper').val(name+';'+images.toString());
					$('#picture_area').submit();
				});

				//sql + ajax
				$('.save').click(function(){
					var x = "";
					if(new_test == true){
						x+= "new=1&"
					}else{
						x+= "old="+name+"&";
					}
					x+= "name="+$('#test_name').val(); 
					x+= "&intro_q="+$('#intro-text-q').val().replace("\n","%3C%2Fbr%3E");
					x+= "&intro_pic="+$('#intro-text-pic').val().replace("\n","%3C%2Fbr%3E");
					console.log("AJAX: "+x);
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function(){
						if(this.readyState == 4 && this.status == 200){
							var response = this.responseText;
							if(response == "Success"){
								$('#test_name').addClass("is-valid");
								$('#test_name').removeClass("is-invalid");
								$('#intro-text-q').addClass("is-valid");
								$('#intro-text-q').removeClass("is-invalid");
								$('#intro-text-pic').addClass("is-valid");
								$('#intro-text-pic').removeClass("is-invalid");
								//update fields
								name = $('#test_name').val();
								intro_text_q = $('#intro-text-q').val();
								intro_text_pic = $('#intro-text-pic').val();
								$('#current-form-name').val(name);
								updateLinks();
							}else{
								$('#test_name').removeClass("is-valid");
								$('#test_name').addClass("is-invalid");
								$('#intro-text-q').removeClass("is-valid");
								$('#intro-text-q').addClass("is-invalid");
								$('#intro-text-pic').removeClass("is-valid");
								$('#intro-text-pic').addClass("is-invalid");
								console.log(response);
							}
							if(name != ""){
								$('.pic_upl').removeClass('disabled');
							}
						}
					}
					xmlhttp.open("GET", "api.php?"+x, true);
					xmlhttp.send();
				});
			});
		</script>
	</body>
</html>