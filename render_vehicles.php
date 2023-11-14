<div class="row">
	<div class="col-sm-2">
	<button id="btn_addvhc" class="btn btn-success" onclick="editVehicle(null, 'new')">+ Dodaj vozilo</button>
	</div>
</div>
<p></p>

<?php
require_once "config.php";

$status = "";
$today = date_create(date("Y-m-d"));

//PRINT AVAILABLE VEHICLES
echo "<div class='row'>";
echo "<table class='tbl available'>\n";
echo "<tr><th colspan='9' style='font-size: 1.5rem;'>RASPOLOŽIVA VOZILA</th></tr>\n";
echo "<tr><th>ID</th><th>Tablice</th><th>Naziv</th><th>Status</th><th>Registracija</th><th>Šestomesečni</th><th>Tahograf</th><th>PP aparat</th><th>Prva pomoć</th></tr>\n";

$sql = "SELECT * FROM vehicles WHERE available = 1 ORDER BY id";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	echo "<tr ondblclick='editVehicle(this)' oncontextmenu='showContextMenu(this, event, \"vehicles\"); return false;'>\n";
	echo "<td class='td_vid' width='4%'>" . $row["id"] . "</td>";
	echo "<td width='12%'>" . $row["registration"] . "</td>";
	echo "<td width='12%'>" . $row["name"] . "</td>";
	echo "<td width='13%'>Raspoloživo</td>";

	$date = $row["reg_exp"];
	if($date == null || $date == "0000-00-00") {
		$date = "";
	} else {
		$date = date_format(date_create($date), "d.m.Y.");
	}
	$exp_date = date_create($date);
	$diff = date_diff($today, $exp_date);
	$diff = $diff->format("%r%a");
	if($date == "") { //if
	echo "<td>" . $date . "</td>";
	} else {
	if($diff > 30) {
		echo "<td>" . $date . "</td>";
	} elseif($diff <= 30 && $diff > 0) {
		echo "<td style='background-color:#ffe680; color:#e67300'>" . $date . "</td>";
	} else {
		echo "<td style='background-color:#ff8080; color:#990000'>" . $date . "</td>";
	}
	} //end if

	$date = $row["6m"];
	if($date == null || $date == "0000-00-00") {
		$date = "";
	} else {
		$date = date_format(date_create($date), "d.m.Y.");
	}
	$exp_date = date_create($date);
	$diff = date_diff($today, $exp_date);
	$diff = $diff->format("%r%a");
	if($date == "") { //if
		echo "<td>" . $date . "</td>";
	} else {
	if($diff > 0 && $diff <= 30) {
		echo "<td style='background-color:#ffe680; color:#e67300'>" . $date . "</td>";
	} else {
		echo "<td>" . $date . "</td>";
	}
	} //end if
	
	$date = $row["tacho_exp"];
	if($date == null || $date == "0000-00-00") {
		$date = "";
	} else {
		$date = date_format(date_create($date), "d.m.Y.");
	}
	$exp_date = date_create($date);
	$diff = date_diff($today, $exp_date);
	$diff = $diff->format("%r%a");
	if($date == "") { //if
		echo "<td>" . $date . "</td>";
	} else {
	if($diff > 30) {
		echo "<td>" . $date . "</td>";
	} elseif($diff <= 30 && $diff > 0) {
		echo "<td style='background-color:#ffe680; color:#e67300'>" . $date . "</td>";
	} else {
		echo "<td style='background-color:#ff8080; color:#990000'>" . $date . "</td>";
	}
	} //end if

	$date = $row["pp_exp"];
	if($date == null || $date == "0000-00-00") {
		$date = "";
	} else {
		$date = date_format(date_create($date), "d.m.Y.");
	}
	$exp_date = date_create($date);
	$diff = date_diff($today, $exp_date);
	$diff = $diff->format("%r%a");
	if($date == "") { //if
		echo "<td>" . $date . "</td>";
	} else {
	if($diff > 30) {
		echo "<td>" . $date . "</td>";
	} elseif($diff <= 30 && $diff > 0) {
		echo "<td style='background-color:#ffe680; color:#e67300'>" . $date . "</td>";
	} else {
		echo "<td style='background-color:#ff8080; color:#990000'>" . $date . "</td>";
	}
	} //end if

	$date = $row["faid_exp"];
	if($date == null || $date == "0000-00-00") {
		$date = "";
	} else {
		$date = date_format(date_create($date), "d.m.Y.");
	}
	$exp_date = date_create($date);
	$diff = date_diff($today, $exp_date);
	$diff = $diff->format("%r%a");
	if($date == "") { //if
		echo "<td>" . $date . "</td>";
	} else {
	if($diff > 30) {
		echo "<td>" . $date . "</td>";
	} elseif($diff <= 30 && $diff > 0) {
		echo "<td style='background-color:#ffe680; color:#e67300'>" . $date . "</td>";
	} else {
		echo "<td style='background-color:#ff8080; color:#990000'>" . $date . "</td>";
	}
	} //end if

	echo "</tr>\n";
}

echo "</table></div>\n";

//PRINT UNAVAILABLE VEHICLES
echo "<p></p><p></p>";
echo "<div class='row'>";
echo "<table class='tbl unavailable'>\n";
echo "<tr><th colspan='9' style='font-size: 1.5rem;'>NERASPOLOŽIVA VOZILA</th></tr>\n";
echo "<tr><th>ID</th><th>Tablice</th><th>Naziv</th><th>Status</th><th>Registracija</th><th>Šestomesečni</th><th>Tahograf</th><th>PP aparat</th><th>Prva pomoć</th></tr>\n";

$sql = "SELECT * FROM vehicles WHERE available = 0 ORDER BY id";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	echo "<tr ondblclick='editVehicle(this)' oncontextmenu='showContextMenu(this, event, \"vehicles\"); return false;'>\n";
	echo "<td class='td_vid' width='4%'>" . $row["id"] . "</td>";
	echo "<td width='12%'>" . $row["registration"] . "</td>";
	echo "<td width='12%'>" . $row["name"] . "</td>";
	$status = $row["status"];
	switch($status) {
		case "sv":
		$status = "Servis";
		break;
		case "nr":
		$status = "Neregistrovan";
		break;
	}
	echo "<td width='13%'>" . $status . "</td>";
	$date = $row["reg_exp"];
	if($date == null || $date == "0000-00-00") {
		$date = "";
	} else {
		$date = date_format(date_create($date), "d.m.Y.");
	}
	echo "<td>" . $date . "</td>";
	$date = $row["6m"];
	if($date == null || $date == "0000-00-00") {
		$date = "";
	} else {
		$date = date_format(date_create($date), "d.m.Y.");
	}
	echo "<td>" . $date . "</td>";
	$date = $row["tacho_exp"];
	if($date == null || $date == "0000-00-00") {
		$date = "";
	} else {
		$date = date_format(date_create($date), "d.m.Y.");
	}
	echo "<td>" . $date . "</td>";
	$date = $row["pp_exp"];
	if($date == null || $date == "0000-00-00") {
		$date = "";
	} else {
		$date = date_format(date_create($date), "d.m.Y.");
	}
	echo "<td>" . $date . "</td>";
	$date = $row["faid_exp"];
	if($date == null || $date == "0000-00-00") {
		$date = "";
	} else {
		$date = date_format(date_create($date), "d.m.Y.");
	}
	echo "<td>" . $date . "</td>";
	echo "</tr>\n";
}

echo "</table></div>";

mysqli_close($conn);
?>