<!DOCTYPE html>
<html>
<head>
	<title>Pltide üleslaadimine</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>


	<p>Üleslaadimise tulemused:</p>
	<p>
	<?php
	$total = count($_FILES['imgs']['name']);
	$parts = explode(";",$_POST["pic_helper"]);
	$table_name = $parts[0];
	$img_arr = explode(",", $parts[1]);
	$img_string = "";

	echo "Starting upload...<br> Picture count: ".$total."<br> Test name: ".$table_name."<br> Image array: ".$parts[1]."<br>";

	$j = 0;
	for( $i=0; $i < count($img_arr); $i++){

		if($img_arr[$i] == "changed"){

			$tmpFilePath = $_FILES['imgs']['tmp_name'][$j];
			if($tmpFilePath != ""){

				//unique hash function for img name
				$fileName = $_FILES['imgs']['name'][$j];
				$fileNameCmps = explode(".", $fileName);
				$fileExtension = strtolower(end($fileNameCmps));
				$newFileName = $table_name. '_' . $i . '.' . $fileExtension;

				$newFilePath = "./images/".$newFileName;

				$allowedfileExtensions = array('jpg', 'png');
				if (in_array($fileExtension, $allowedfileExtensions)){
					if(move_uploaded_file($tmpFilePath, $newFilePath)){
						$img_string .= $newFileName;
						echo "Successfully uploaded ".$fileName." to ".$newFilePath."<br>";
					}else{
						echo "Failed to upload ".$fileName."<br>";
					}
				}else{
					echo $fileName. " is not an image/unsupported format"."<br>";
				}

			}
			$j++;


		}else{ //hasn't changed
			$img_string .= $img_arr[$i];
		}

		if($i+1 < count($img_arr)) $img_string .= ',';

	}

	try {
		$conn = new PDO('mysql:host=localhost;dbname=conjoint', 'root', 'Kilud123');
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected to PDO successfully"; 
		$query = $conn->prepare('UPDATE tests SET img_string = ? WHERE name = ?;');
		$query->execute(array($img_string, $table_name));
		$conn = null;
		echo "Updated the database with successful new images.";
	} catch (Exception $e) {
		echo "Database upload failed. Reason: ".$e;
	}


	?>
	<br>
	<a href="http://praktika.ut.ee/other/conjoint/admin.php" class="btn btn-primary">Tagasi koju</a>

</body>
</html>