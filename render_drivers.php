<div class="row">
	<div class="col-sm-2">
	<button id="btn_addriver" class="btn btn-success" onclick="editDriver(null, 'new')">+ Dodaj vozača</button>
	</div>
</div>
<p></p>

<?php
require_once "config.php";

$status = "";
$today = date_create(date("Y-m-d"));

//PRINT AVAILABLE DRIVERS
echo "<div class='row'>";
echo "<table class='tbl available'>\n";
echo "<tr><th colspan='9' style='font-size: 1.5rem;'>RASPOLOŽIVI VOZAČI</th></tr>\n";
echo "<tr><th>ID</th><th>Ime</th><th>Prezime</th><th>Status</th><th>Vozačka dozvola</th><th>CPC licenca</th><th>Taho kartica</th><th>Lekarsko</th><th>Sanitarni</th></tr>\n";

$sql = "SELECT * FROM drivers WHERE available = 1 ORDER BY id";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	echo "<tr ondblclick='editDriver(this)' oncontextmenu='showContextMenu(this, event, \"drivers\"); return false;'>\n";
	echo "<td class='td_id' width='5%'>" . $row["id"] . "</td>";
	echo "<td width='12%'>" . $row["name"] . "</td>";
	echo "<td width='15%'>" . $row["lastname"] . "</td>";
	echo "<td>Raspoloživ</td>";

	$date = $row["dl_date"];
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

	$date = $row["cpc_date"];
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

	$date = $row["tacho_date"];
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

	$date = $row["medical"];
	if($date == null || $date == "0000-00-00") {
		$date = "";
	} else {
		$date = date_format(date_create($date), "d.m.Y.");
	}
	$exp_date = date_add(date_create($date), date_interval_create_from_date_string("3 years"));
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

	$date = $row["sanit"];
	if($date == null || $date == "0000-00-00") {
		$date = "";
	} else {
		$date = date_format(date_create($date), "d.m.Y.");
	}
	$exp_date = date_add(date_create($date), date_interval_create_from_date_string("6 months"));
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

	//Invisible <td>s
	echo "<td style='display:none;'>" . $row["dlicense"] . "</td>";
	echo "<td style='display:none;'>" . $row["license"] . "</td>";
	echo "<td style='display:none;'>" . $row["tacho"] . "</td>";
	echo "</tr>\n";
}

echo "</table></div>\n";

//PRINT UNAVAILABLE DRIVERS
echo "<p></p><p></p>";
echo "<div class='row'>";
echo "<table class='tbl unavailable'>\n";
echo "<tr><th colspan='9' style='font-size: 1.5rem;'>NERASPOLOŽIVI VOZAČI</th></tr>\n";
echo "<tr><th>ID</th><th>Ime</th><th>Prezime</th><th>Status</th><th>Vozačka dozvola</th><th>CPC licenca</th><th>Taho kartica</th><th>Lekarsko</th><th>Sanitarni</th></tr>\n";

$sql = "SELECT * FROM drivers WHERE available = 0 ORDER BY id";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	echo "<tr ondblclick='editDriver(this)' oncontextmenu='showContextMenu(this, event, \"drivers\"); return false;'>\n";
	echo "<td class='td_id' width='5%'>" . $row["id"] . "</td>";
	echo "<td width='12%'>" . $row["name"] . "</td>";
	echo "<td width='15%'>" . $row["lastname"] . "</td>";
	$status = $row["status"];
	switch($status) {
		case "bo":
		$status = "Bolovanje";
		break;
		case "go":
		$status = "Godišnji odmor";
		break;
		case "sd":
		$status = "Slobodan dan";
		break;
	}
	echo "<td>" . $status . "</td>";

	$date = $row["dl_date"];
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

	$date = $row["cpc_date"];
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

	$date = $row["tacho_date"];
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

	$date = $row["medical"];
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

	$date = $row["sanit"];
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

	//Invisible <td>s
	echo "<td style='display:none;'>" . $row["dlicense"] . "</td>";
	echo "<td style='display:none;'>" . $row["license"] . "</td>";
	echo "<td style='display:none;'>" . $row["tacho"] . "</td>";
	echo "</tr>\n";
}

echo "</table></div>";

mysqli_close($conn);
?>