<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css?v=7">
		<title>Saatmine...</title>
	</head>
	<body>

		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center my-5">
					<?php
					//error_reporting(E_ALL);
					//ini_set('display_errors', 'On');

					$conn = new PDO('mysql:host=localhost;dbname=conjoint', 'root', 'Kilud123');
					if(! $conn ){
						die(print_r(error_get_last()));
					}
					//form data
					$test_name = $_POST["name"];
					$answers = $_POST["answers"];
					$result_string = $_POST["data"];
					if($test_name == null) die("<h3>No test name!</h3>");
					//if($answers == null) die("<h3>No answers!</h3>");
					if($result_string == null) die("<h3>No result string!</h3>");

					//submit data
					$sql = $conn->prepare('INSERT INTO results(test, answers, choice_string) VALUES(?,?,?)');
					$sql->execute(array($test_name,$answers,$result_string));

					if($sql){
						echo "<h3>Järjekord edukalt salvestatud!</br>Täname vastamise eest!</h3>";
					}else{
						echo "<h3>Järjekorda EI salvestatud!</br> Põhjus: ".print_r(error_get_last())."</h3>";
					}

					$conn = null;
					?>
				</div>
			</div>
		</div>

	</body>
</html>