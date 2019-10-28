<!DOCTYPE html>
<html>
<head>
	<title>Tulemused</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

	<div class="main py-5 table-responsive-sm">
		
		<table class="table table-sm table-striped table-hover">
			<thead>
				<tr>
			      <th scope="col">#</th>
			      <th scope="col">Q1.</th>
			      <th scope="col">Q2.</th>
			      <th scope="col">Q3.</th>
			      <th scope="col">Q4.</th>
			      <th scope="col">Q5.</th>
			      <th scope="col">Q6.</th>
			      <th scope="col">Q7.</th>
			      <th scope="col">Q8.</th>
			      <th scope="col">Q9.</th>
			      <th scope="col">Q10.</th>
			      <th scope="col">Q11.</th>
			      <th scope="col">Q12.</th>
			      <th scope="col">Pic 1.(multi)</th>
				  <th scope="col">Pic 1.(choice)</th>
				  <th scope="col">Pic 2.(multi)</th>
				  <th scope="col">Pic 2.(choice)</th>
				  <th scope="col">Pic 3.(multi)</th>
				  <th scope="col">Pic 3.(choice)</th>
				  <th scope="col">Pic 4.(multi)</th>
				  <th scope="col">Pic 4.(choice)</th>
			    </tr>
			</thead>
			<tbody>
				<?php

				try {
					$conn = new PDO('mysql:host=localhost;dbname=china_data', 'root', 'Kilud123');
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					//echo "Connected to PDO successfully"; 
					$query = $conn->prepare('SELECT * FROM Data');
					$query->execute();
					$data = $query -> fetchAll();
					$i = 1;
					foreach($data as $row){
						echo '<tr><th scope"row">'.$i.'</th><td>'.$row["q1"].'</td><td>'.$row["q2"].'</td><td>'.$row["q3"].'</td><td>'.$row["q4"].'</td><td>'.$row["q5"].'</td><td>'.$row["q6"].'</td><td>'.$row["q7"].'</td><td>'.$row["q8"].'</td><td>'.$row["q9"].'</td><td>'.$row["q10"].'</td><td>'.$row["q11"].'</td><td>'.$row["q12"].'</td><td>'.$row["p1_multiple"].'</td><td>'.$row["p1_choice"].'</td><td>'.$row["p2_multiple"].'</td><td>'.$row["p2_choice"].'</td><td>'.$row["p3_multiple"].'</td><td>'.$row["p3_choice"].'</td><td>'.$row["p4_multiple"].'</td><td>'.$row["p4_choice"].'</td></tr>';
						$i++;
					}
				}
				catch(PDOException $e){
					$error_code = $e->getCode();
					echo "Connection failed (code: $error_code): " . $e->getMessage();
				}

				?>
			</tbody>
		</table>

	</div>

	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
</body>
</html>