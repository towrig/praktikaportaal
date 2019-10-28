<?php

	$isnew = $_GET["new"];
	$name = $_GET["name"];
	$old_name = $_GET["old"];
	$intro_q = $_GET["intro_q"];
	$intro_pic = $_GET["intro_pic"];

	$querystring = "";
	
	if(isset($isnew) && $isnew == 1){
		$querystring .= "INSERT INTO tests(name,intro_q,intro_pic,img_string) VALUES(?,?,?,?);";
		$vars[0] = $name;
		$vars[1] = $intro_q;
		$vars[2] = $intro_pic;
		$vars[3] = "";
	}else{
		$querystring .= "UPDATE tests SET name = ?, intro_q = ?, intro_pic = ? WHERE name = ?;";
		$vars[0] = $name;
		$vars[1] = $intro_q;
		$vars[2] = $intro_pic;
		$vars[3] = $old_name;
	}

	try{
		$conn = new PDO('mysql:host=localhost;dbname=conjoint', 'root', 'Kilud123');
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected to PDO successfully"; 
		$query = $conn->prepare($querystring);
		$query->execute($vars);
		$conn = null;
		echo 'Success';
	} catch (Exception $e){
		echo 'Caught exception: ', $e->getMessage(), "\n";
	}


?>