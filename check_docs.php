<?php
require_once "config.php";

$today = date_create(date("Y-m-d"));

//Get date last checked docs from db
$sql = "SELECT last_docs_check FROM settings;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
echo $row[0] . "\n";

//Check drivers docs
$sql = "SELECT * FROM drivers";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
	//Drivers license
	$exp = date_create($row["dl_date"]);
	$diff = date_diff($today, $exp);
	$diff = $diff->format("%r%a");
	if($diff > -365 && $diff <= 30) {
		echo "dl;" . $row["name"] . ";" . $row["lastname"] . ";" . $diff . "\n";
	}
	//CPC license
	$exp = date_create($row["cpc_date"]);
	$diff = date_diff($today, $exp);
	$diff = $diff->format("%r%a");
	if($diff > -365 && $diff <= 30) {
		echo "cpc;" . $row["name"] . ";" . $row["lastname"] . ";" . $diff . "\n";
	}
	//Tacho card
	$exp = date_create($row["tacho_date"]);
	$diff = date_diff($today, $exp);
	$diff = $diff->format("%r%a");
	if($diff > -365 && $diff <= 30) {
		echo "tacho;" . $row["name"] . ";" . $row["lastname"] . ";" . $diff . "\n";
	}
	//Medical
	$date = date_create($row["medical"]);
	$exp = date_add($date, date_interval_create_from_date_string("3 years"));
	$diff = date_diff($today, $exp);
	$diff = $diff->format("%r%a");
	if($diff > -365 && $diff <= 30) {
		echo "medical;" . $row["name"] . ";" . $row["lastname"] . ";" . $diff . "\n";
	}
	//Sanit
	$date = date_create($row["sanit"]);
	$exp = date_add($date, date_interval_create_from_date_string("6 months"));
	$diff = date_diff($today, $exp);
	$diff = $diff->format("%r%a");
	if($diff > -365 && $diff <= 30) {
		echo "sanit;" . $row["name"] . ";" . $row["lastname"] . ";" . $diff . "\n";
	}
}

//Check vehicles docs
$sql = "SELECT * FROM vehicles";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
	//Registration
	$exp = date_create($row["reg_exp"]);
	$diff = date_diff($today, $exp);
	$diff = $diff->format("%r%a");
	if($diff > -365 && $diff <= 30) {
		echo "v_reg;" . $row["registration"] . ";" . $row["name"] . ";" . $diff . "\n";
	}
	//Tachograph
	$exp = date_create($row["tacho_exp"]);
	$diff = date_diff($today, $exp);
	$diff = $diff->format("%r%a");
	if($diff > -365 && $diff <= 30) {
		echo "v_tacho;" . $row["registration"] . ";" . $row["name"] . ";" . $diff . "\n";
	}
	//PP aparat
	$exp = date_create($row["pp_exp"]);
	$diff = date_diff($today, $exp);
	$diff = $diff->format("%r%a");
	if($diff > -365 && $diff <= 30) {
		echo "v_pp;" . $row["registration"] . ";" . $row["name"] . ";" . $diff . "\n";
	}
	//First aid kit
	$exp = date_create($row["faid_exp"]);
	$diff = date_diff($today, $exp);
	$diff = $diff->format("%r%a");
	if($diff > -365 && $diff <= 30) {
		echo "v_faid;" . $row["registration"] . ";" . $row["name"] . ";" . $diff . "\n";
	}
	//6 month check
	$exp = date_create($row["6m"]);
	$diff = date_diff($today, $exp);
	$diff = $diff->format("%r%a");
	if($diff > 0 && $diff <= 30) {
		echo "v_6m;" . $row["registration"] . ";" . $row["name"] . ";" . $diff . "\n";
	}
}

mysqli_close($conn);
?>