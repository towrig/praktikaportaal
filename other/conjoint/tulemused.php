<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/admin.css">
		<link rel="stylesheet" href="css/table.css?v=2">
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<header class="topBar">
			<nav>
				<a href="Muutmiseks.html" class="admin">Admin</a>
				<a href="tulemused.asp" class="tulemused">Tulemused</a>
			</nav>
		</header>
		<main>
			<h1 style="text-align: center;">Tulemused:</h1>
			<?php
				//error_reporting(E_ALL);
				//ini_set('display_errors', 'On');
				$test_name = $_GET["t"];
				$questions = "";
				try{
					$conn = new PDO('mysql:host=localhost;dbname=conjoint', 'root', 'Kilud123');
					
					$query = $conn->prepare("SELECT * FROM tests WHERE name = ?");
					$query->execute(array($test_name));
					foreach($query as $row){
						$questions = utf8_encode($row["questions"]);
						break;
					}
					$conn = null;
				}catch (Exception $e){
					echo 'Caught exception: ', $e->getMessage(), "\n";
				}
				echo "<a href='export.php?t=".$test_name."' class='btn btn-primary'>Download as CSV</a>";
				echo "<table>";
				echo "<tr><th>Id</th>";
				foreach (explode(";",$questions) as $q) {
					$n = explode("|", $q)[1];
					echo "<th>".$n."</th>";
				}
				echo "<th colspan='5'>Järjekord</th></tr>";

				try{

					$conn = new PDO('mysql:host=localhost;dbname=conjoint', 'root', 'Kilud123');
					
					$query = $conn->prepare("SELECT * FROM results WHERE test = ?");
					$query->execute(array($test_name));

					
					foreach($query as $row){
						$answers = explode(";",$row["answers"]);
						$numbers = explode(",", $row["choice_string"]);
						echo "<tr>";
						echo "<td>".$row["id"]."</td>";
						foreach ($answers as $a) {
							echo "<td>".$a."</td>";
						}
						for($i = 0; $i < count($numbers); $i++){
							echo "<td>".$numbers[$i]."</td>";
						}
						echo "</tr>";
					}
					
					$conn = null;
					echo "</table><br>";
				} catch (Exception $e){
					echo 'Caught exception: ', $e->getMessage(), "\n";
				}
			?>
		</main>
	</body>	
</html>