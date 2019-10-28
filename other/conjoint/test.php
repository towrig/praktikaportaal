<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	$path = 'data/test.txt';
	if(chmod('data/', 0777)){
		echo "modded!";
	}else{
		echo "mod failed!";
	}
	$test = fopen($path,'wb') or die("Unable to write into file, ".print_r(error_get_last()));
	fwrite($test, "I fucking did it!");
	fclose($test);
?>