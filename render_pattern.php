<div id="pattern" class="row" style="display: none;">
	<div class="col-sm-3">
	<select id="sel_pattern" class="form-select">
		<option value="0" disabled>Izaberi šablon:</option>
		<option value="standard" selected>Standardni raspored</option>
	</select>
	</div>
	<div class="col-sm-6">
	<button id="btn_pat_edit" class="btn btn-outline-success" onclick="if($('#sel_pattern').val() != 0) {editPattern();}">Izmeni šablon</button>
	<button id="btn_pat_save" class="btn btn-success" onclick="if(Edited==true){updateSched('standard');}" disabled>Sačuvaj šablon</button>
	<button id="btn_pat_discard" class="btn btn-danger" onclick="discardPattern()" disabled>Odbaci izmene</button>
	</div>
</div>
<p></p>

<?php
//error_reporting(0);
require_once "config.php";

$sql = "SELECT * FROM schedule WHERE id = 3;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$sql_ext = "SELECT * FROM schedule_ext WHERE id = 3;";
$result_ext = mysqli_query($conn, $sql_ext);
$row_ext = mysqli_fetch_assoc($result_ext);

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
	echo "<th>". $day . "</th>";

	}// end for (42)

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
				echo "<p id='" . $select_string . "'>" . $field_value . "</p>";
				}

		}
		echo "</td>";
	}
	echo "</tr>\n";
}
echo "</table>";

mysqli_close($conn);
?>