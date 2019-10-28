<?php 

$test_name = $_GET['t'];
$csv_filename = 'results_'.$test_name.'_'.date('Y-m-d').'.csv';

$conn = new PDO('mysql:host=localhost;dbname=conjoint', 'root', 'Kilud123');
if(!$conn ){
	die(print_r(error_get_last()));
}
$query = $conn->prepare("SELECT * FROM results WHERE test = ?");
$query->execute(array($test_name));

$csv_export = "Id,Vastused,Valikud";
$csv_export.= "\n";
foreach($query as $row){
	$csv_export.= $row["id"].',';
	$answers = explode(";", $row["answers"]);
	$numbers = explode(",", $row["choice_string"]);
	for($i = 0; $i < count($answers); $i++){
		$csv_export.= $answers[$i].',';
	}
	for($i = 0; $i < count($numbers); $i++){
		$csv_export.= $numbers[$i].',';
	}
	$csv_export.= "\n";
}

$conn = null;

header("Content-type: text/x-csv; charset=utf-8");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);

?>