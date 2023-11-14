<div class="row">
	<div class="col-sm-2">
	<button id="btn_edit" class="btn btn-outline-success" onclick="editTable()">Izmeni raspored</button>
	</div>
	<div class="col-sm-2">
	<button id="btn_discard" class="btn btn-danger" onclick="discardChanges()" disabled>Odbaci izmene</button>
	</div>
	<div class="col-sm-4">
	<button id="toggle_prev" class="btn btn-info" onclick="loadSchedule('prev')"><< Prethodna nedelja</button>
	</div>
	<div class="col-sm-4">
	<button id="toggle_next" class="btn btn-info" onclick="loadSchedule('next')">Sledeća nedelja >></button>
	</div>
</div>
<p></p>
<div id="pattern" class="row" style="display: none;">
	<div class="col-sm-3">
	<select id="sel_pattern" class="form-select">
		<option value="0" selected>Izaberi šablon:</option>
		<option value="standard">Standardni raspored</option>
		<option value="copy">Kopiraj prethodnu nedelju</option>
	</select>
	</div>
	<div class="col-sm-4">
	<button id="btn_pat_ok" class="btn btn-outline-success" onclick="usePatternPrompt()">Primeni šablon</button>
	</div>
</div>
<p></p>

<?php
//error_reporting(0);
require_once "config.php";

$week = $_POST["week"];
$drivers_available = $_POST["drivers_available"];

$today = date("l");
$add_str = "";
switch($today) {
	case "Monday":
	$add_str = "0 days";
	break;
	case "Tuesday":
	$add_str = "-1 day";
	break;
	case "Wednesday":
	$add_str = "-2 days";
	break;
	case "Thursday":
	$add_str = "-3 days";
	break;
	case "Friday":
	$add_str = "-4 days";
	break;
	case "Saturday":
	$add_str = "-5 days";
	break;
	case "Sunday":
	$add_str = "-6 day";
	break;
}

//Check when to switch to next week
$sql = "SELECT mo_date FROM schedule WHERE id = 0;";
$result = mysqli_query($conn, $sql);
$result = mysqli_fetch_row($result);
$mo_date = $result[0];
$mo_temp = date_create($result[0]);;
$mo_new = date_add($mo_temp, date_interval_create_from_date_string("14 days"));
$mo_new = date_format($mo_new, "Y-m-d");

$sql = "SELECT DATEDIFF(CURRENT_DATE(), mo_date) FROM schedule WHERE id = 0;";
$result = mysqli_query($conn, $sql);
$result = mysqli_fetch_row($result);
$mon_diff = $result[0];

if($mon_diff >= 7) {
	$sql = "DELETE FROM schedule WHERE id = 2";
	$sql_ext = "DELETE FROM schedule_ext WHERE id = 2";
	mysqli_query($conn, $sql);
	mysqli_query($conn, $sql_ext);
	$sql = "UPDATE schedule SET id = 2 WHERE mo_date = '$mo_date'";
	$sql_ext = 	"UPDATE schedule_ext SET id = 2 WHERE id = 0";
	mysqli_query($conn, $sql);
	mysqli_query($conn, $sql_ext);
	$sql = "UPDATE schedule SET id = 0 WHERE id = 1";
	$sql_ext = "UPDATE schedule_ext SET id = 0 WHERE id = 1";
	mysqli_query($conn, $sql);
	mysqli_query($conn, $sql_ext);
	$sql = "INSERT INTO `schedule` (`id`, `mo_date`, `mo_r1_id`, `mo_r1_d1`, `mo_r1_d2`, `mo_r1_v`, `mo_r2_id`, `mo_r2_d1`, `mo_r2_d2`, `mo_r2_v`, `mo_r3_id`, `mo_r3_d1`, `mo_r3_d2`, `mo_r3_v`, `mo_r4_id`, `mo_r4_d1`, `mo_r4_d2`, `mo_r4_v`, `tu_r1_id`, `tu_r1_d1`, `tu_r1_d2`, `tu_r1_v`, `tu_r2_id`, `tu_r2_d1`, `tu_r2_d2`, `tu_r2_v`, `tu_r3_id`, `tu_r3_d1`, `tu_r3_d2`, `tu_r3_v`, `tu_r4_id`, `tu_r4_d1`, `tu_r4_d2`, `tu_r4_v`, `we_r1_id`, `we_r1_d1`, `we_r1_d2`, `we_r1_v`, `we_r2_id`, `we_r2_d1`, `we_r2_d2`, `we_r2_v`, `we_r3_id`, `we_r3_d1`, `we_r3_d2`, `we_r3_v`, `we_r4_id`, `we_r4_d1`, `we_r4_d2`, `we_r4_v`, `th_r1_id`, `th_r1_d1`, `th_r1_d2`, `th_r1_v`, `th_r2_id`, `th_r2_d1`, `th_r2_d2`, `th_r2_v`, `th_r3_id`, `th_r3_d1`, `th_r3_d2`, `th_r3_v`, `th_r4_id`, `th_r4_d1`, `th_r4_d2`, `th_r4_v`, `fr_r1_id`, `fr_r1_d1`, `fr_r1_d2`, `fr_r1_v`, `fr_r2_id`, `fr_r2_d1`, `fr_r2_d2`, `fr_r2_v`, `fr_r3_id`, `fr_r3_d1`, `fr_r3_d2`, `fr_r3_v`, `fr_r4_id`, `fr_r4_d1`, `fr_r4_d2`, `fr_r4_v`, `sa_r1_id`, `sa_r1_d1`, `sa_r1_d2`, `sa_r1_v`, `sa_r2_id`, `sa_r2_d1`, `sa_r2_d2`, `sa_r2_v`) VALUES
	(1, '$mo_new', 'NIŠ', '&nbsp', '&nbsp', '&nbsp', 'MEROŠINA', '&nbsp', '&nbsp', '&nbsp', 'KRUŠEVAC', '&nbsp', '&nbsp', '&nbsp', 'NOVI PAZAR', '&nbsp', '&nbsp', '&nbsp', 'LESKOVAC', '&nbsp', '&nbsp', '&nbsp', 'JAGODINA', '&nbsp', '&nbsp', '&nbsp', 'KLADOVO', '&nbsp', '&nbsp', '&nbsp', 'ZAJEČAR', '&nbsp', '&nbsp', '&nbsp', 'NIŠ', '&nbsp', '&nbsp', '&nbsp', 'NOVI PAZAR', '&nbsp', '&nbsp', '&nbsp', 'KRUŠEVAC', '&nbsp', '&nbsp', '&nbsp', 'KURŠUMLIJA', '&nbsp', '&nbsp', '&nbsp', 'LESKOVAC', '&nbsp', '&nbsp', '&nbsp', 'JAGODINA', '&nbsp', '&nbsp', '&nbsp', 'PIROT', '&nbsp', '&nbsp', '&nbsp', 'PROKUPLJE', '&nbsp', '&nbsp', '&nbsp', 'NIŠ', '&nbsp', '&nbsp', '&nbsp', 'NOVI PAZAR', '&nbsp', '&nbsp', '&nbsp', 'KRUŠEVAC', '&nbsp', '&nbsp', '&nbsp', 'KLADOVO', '&nbsp', '&nbsp', '&nbsp', 'LESKOVAC', '&nbsp', '&nbsp', '&nbsp', 'ZAJEČAR', '&nbsp', '&nbsp', '&nbsp')";
	mysqli_query($conn, $sql);

	$sql_ext = "INSERT INTO `schedule_ext` VALUES (1, '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp', '&nbsp')";
	mysqli_query($conn, $sql_ext);

	//TEST THE WEEK CHANGE PROCESS. PAY ATTENTION TO LINE 94, IT DOESN'T CREATE id 1 ROW

	$sql_notes = "DELETE FROM `notes` WHERE `id` = 2";
	mysqli_query($conn, $sql_notes);
				$sql_notes = "INSERT INTO `notes` SELECT 2, `note_mo`, `note_tu`, `note_we`, `note_th`, `note_fr`, `note_sa` FROM `notes` WHERE `id` = 0";
				mysqli_query($conn, $sql_notes);
				$sql_notes = "DELETE FROM `notes` WHERE `id` = 0";
				mysqli_query($conn, $sql_notes);
				$sql_notes = "UPDATE `notes` SET `id` = 0 WHERE `id` = 1";
				mysqli_query($conn, $sql_notes);
				$sql_notes = "DELETE FROM `notes` WHERE `id` = 1";
				mysqli_query($conn, $sql_notes);
				$sql_notes = "INSERT INTO `notes` VALUES (1, '', '', '', '', '', '');";
	mysqli_query($conn, $sql_notes);
}

//Load from database
switch ($week) {
	case "current":
		$id = 0;
		break;
	case "next":
		$id = 1;
		break;
	case "prev":
		$id = 2;
		break;
	default:
		$id = 3;
}

$sql = "SELECT * FROM schedule WHERE id = $id;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$monday = $row["mo_date"];
$sql_ext = "SELECT * FROM schedule_ext WHERE id = $id;";
$result_ext = mysqli_query($conn, $sql_ext);
$row_ext = mysqli_fetch_assoc($result_ext);

//Get monday's and today's date
$date_today = date_create(date("d.m.y"));
$date_monday = date_add($date_today, date_interval_create_from_date_string($add_str));
if($week == "next") {
	$date_monday = date_add($date_monday, date_interval_create_from_date_string("7 days"));
} elseif($week == "prev") {
	$date_monday = date_add($date_monday, date_interval_create_from_date_string("-7 days"));
}
$todays_date = date_create(date("d.m.y")); //for marking todays date in schedule

echo "<table class='sched'>";
echo "<tr>";
//Print table header
for($i = 0; $i < 6; $i++) {
	switch($i) {
		case 0:
		$day = "PON";
		break;
		case 1:
		$day = "UTO";
		break;
		case 2:
		$day = "SRE";
		break;
		case 3:
		$day = "ČET";
		break;
		case 4:
		$day = "PET";
		break;
		case 5:
		$day = "SUB";
		break;
	}
	$printing_date = date_format(date_add($date_monday, date_interval_create_from_date_string($i . " days")), "d.m.y");
	//mark todays date in schedule
	if($printing_date == date_format($todays_date, "d.m.y")) {
		echo "<th style='color:blue;background-color:#669999'>". $day . "<br>" . $printing_date . "</th>";
	} else {
		echo "<th>". $day . "<br>" . $printing_date . "</th>";
	}
	$date_today = date_create(date("d.m.y"));
	if($week == "next") {
		$date_today = date_add($date_today, date_interval_create_from_date_string("7 days"));
	} elseif($week == "prev") {
		$date_today = date_add($date_today, date_interval_create_from_date_string("-7 days"));
	}
	$date_monday = date_add($date_today, date_interval_create_from_date_string($add_str));
}// end for (67)
	echo "</tr>\n";

//Print table
for($rel = 1; $rel <= 5; $rel++) {
	echo "<tr>\n";

	for($day = 0; $day < 6; $day++) {
		echo "<td>\n";
		switch($day) {
			case 0:
			$day_str = "mo";
			break;
			case 1:
			$day_str = "tu";
			break;
			case 2:
			$day_str = "we";
			break;
			case 3:
			$day_str = "th";
			break;
			case 4:
			$day_str = "fr";
			break;
			case 5:
			$day_str = "sa";
			break;
		}

		for($field = 1; $field <= 4; $field++) {
			switch($field) {
				case 1:
				$field_str = "id";
				break;
				case 2:
				$field_str = "d1";
				break;
				case 3:
				$field_str = "d2";
				break;
				case 4:
				$field_str = "v";
				break;
			}
			if($day_str == "sa" && $rel > 3) {
				break;
			}
			
			$select_string = $day_str . "_" . "r" . $rel . "_" . $field_str;

			//If row is empty input blank space
			if($rel <= 4 && $day < 5 || $day == 5 && $rel < 3){

			if($row == null) {
				$field_value = "&nbsp";
			} else {
				$field_value = $row[$select_string];
			}

			} else {

			if($row_ext != null && $rel == 5 || $row_ext != null && $day == 5 && $rel == 3) {
				$field_value = $row_ext[$select_string];
			} else {
				break;
			}

			}

			//Select between fields
			switch($field) {
				case 1:
				echo "<p id='" . $select_string . "'><b>" . $field_value . "</b></p>";
				break;
				default:
				//CHECK IF DRIVER IS AVAILABLE (global drivers_available)
				//IF NOT PRINT BLANK SPACE
				if($week == "next" && $field_str != "v") {
					if(in_array($field_value, $drivers_available)) {
						echo "<p id='" . $select_string . "'>" . $field_value . "</p>";
					} else {
						echo "<p id='" . $select_string . "'>" . "&nbsp" . "</p>";
					}
				} else {
					echo "<p id='" . $select_string . "'>" . $field_value . "</p>";
				}
			} //end switch

		}
		echo "</td>";
	}
	echo "</tr>\n";
}
echo "</table>";

//NOTES
$sql = "SELECT * FROM notes WHERE id = $id;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo "<table id='tbl_note' class='note'><tr>";
echo "<td id='note_mo'>" . nl2br($row["note_mo"]) . "</td>";
echo "<td id='note_tu'>" . nl2br($row["note_tu"]) . "</td>";
echo "<td id='note_we'>" . nl2br($row["note_we"]) . "</td>";
echo "<td id='note_th'>" . nl2br($row["note_th"]) . "</td>";
echo "<td id='note_fr'>" . nl2br($row["note_fr"]) . "</td>";
echo "<td id='note_sa'>" . nl2br($row["note_sa"]) . "</td>";
echo "</tr></table>";

mysqli_close($conn);
?>