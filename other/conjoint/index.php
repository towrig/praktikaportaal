<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css?v=11">
		<title>Test keskkond</title>
	</head>
	<body>
		<header class="navbar navbar-default">
			<div class="container-fluid">
				<h3>Tere tulemast TÜ Majandusteaduskonna testiprogrammi!</h1>
				<img class="rounded float-left" src="logo_mtk_et.png" alt="TU Maj. Logo">
			</div>
		</header>
		<main>
			<div class="container-fluid">
			
				<div class="row">
					
					<div class="container test-view">
						<div class="row">
						
							<div class="top-text">
								<?php

								$test_name = $_GET["t"];
								$intro_q = "";
								$intro_pic = "";
								$img_string = "";
								$questions = "";

								try{
									$conn = new PDO('mysql:host=localhost;dbname=conjoint', 'root', 'Kilud123');
									// set the PDO error mode to exception
									$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									//echo "Connected to PDO successfully"; 
									$query = $conn->prepare('SELECT * FROM tests WHERE name = ?');
									$query->execute(array($test_name));

									foreach($query as $row){
										$intro_q = $row["intro_q"];
										$intro_pic = $row["intro_pic"];
										$img_string = $row["img_string"];
										$questions = utf8_encode($row["questions"]);
										break;
									}

									$conn = null;
								} catch (Exception $e){
									echo "<br><br>Link on ebakorrektne!<br><br>";
								}
								
								//intro text
								echo str_replace("\n","</br>","<p>".$intro_pic."</p>");
								?>
								
								<p>Teie hetkene valikute järjekord:</p>
								<p id = "x">&nbsp</p>
							</div>
							
						</div>
					</div>
					
					<div class="container">
						<form method="post" action="save.php" id="data-form">
							<div class="form-view">
							<?php echo str_replace("\n","</br>","<p>".$intro_q."</p>"); ?>
							<input type="hidden" name="name" value="<?php echo $test_name ?>">
							<?php 
								$qs = explode(';', $questions);
								$x = 0;
								foreach ($qs as $q) {
									echo "<div class='question'>";
									$parts = explode('|', $q);
									echo "<span>Q".$x.": ".$parts[1]."</span><br>";
									if ($parts[0] == "radio"){
										for ($i=2; $i <	count($parts); $i++) { 
											echo "<input type='radio' name='a".$x."' value='".$parts[$i]."' ".($i == 2 ? "checked" : "").">".$parts[$i]."<br>";
										}
									}else if ($parts[0] == "text"){
										echo "<input type='text' name='a".$x."'>";
									}
									echo "</div>";
									$x++;
								}

							?>
							</div>
							<input class='btn btn-primary test-view float-right' type="submit" onclick="saveValue()" value="Saada">
							<input type="hidden" id="data" name="data">
							<input type="hidden" id="answers" name="answers">
						</form>
						<a class='btn btn-primary start form-view col-md-2'>Start test!</a>
					</div>
					
				</div>
				<div class="row">
					<div class="section-images col-md-12 col-xs-12 test-view">
					
					</div>-
				</div>
			
			</div>
		</main>
		
		<footer>
		</footer>

		<script src="js/jquery-3.3.1.min.js"></script>
		<script>
		var valikud = [];
		var srcPildid = [];
		var imgChosen = [];
		var img_string = "<?php echo $img_string ?>";
		var q_string = "<?php echo $questions ?>";
		var q_count = q_string.split(";").length;
		console.log("Test img_string: "+img_string);

		
		$(document).ready(function(){
			
			$('.start').click(function(){
				$('.form-view').css('display','none');
				$('.test-view').css('display','block');
				$('.section-images').css('display','flex');
				$('#answers').val(collectAnswers());
			});
			
			var images = img_string.split(",");
			for (i = 0 ; i < images.length; i++){
				srcPildid[i] = "./images/"+images[i];
				$('.section-images').append("<div class='image-container col-md-3 mb-4'><div></div></div>");
				$('.image-container:nth-child('+(i+1)+') div').css('background-image', 'url('+srcPildid[i].toString()+')');
				$('.image-container:nth-child('+(i+1)+')').click(changeImage(i));
			}
			
		});
		
		function collectAnswers(){
			var resultString = "";
			var questions = q_string.split(";");
			console.log(q_string.toString());
			for (var i = 0; i < q_count; i++) {
				console.log("Loop: "+questions[i].split("|")[0]);
				if(questions[i].split("|")[0] == "radio"){
					resultString+= $('input[name=a'+i+']:checked', '#data-form').val()+";";
				}else if (questions[i].split("|")[0] == "text") {
					resultString+= $('input[name=a'+i+']', '#data-form').val()+";";
				}
			}
			console.log("RS: "+resultString);
			return resultString;
		}

		function changeImage(a) {
			return function(){
				var x = document.getElementsByClassName('pildid');
				if(imgChosen[a]== true){
					imgChosen[a] = false;
					$('.image-container:nth-child('+(a+1)+') .overlay').remove();
					var b = valikud.indexOf(a+1);
					valikud.splice(b,1);
					document.getElementById('x').innerHTML = valikud.toString();
			
				}
				else{
					imgChosen[a] = true;
					$('.image-container:nth-child('+(a+1)+')').append('<div class="overlay"></div>');
					valikud.push(a+1);		
					document.getElementById('x').innerHTML = "&nbsp"+valikud.toString();
				}
			}
		}
		
		function saveValue(){
			var data = valikud.toString();
			var answers = collectAnswers();
			document.getElementById('data').setAttribute('value', data);
			document.getElementById('answers').setAttribute('value', answers);
		}
		</script>
	</body>
</html>