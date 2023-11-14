<?php
require_once "config.php";

//Take over objects from post method
$row1 = $_POST["row1"];
$row2 = $_POST["row2"];
$row3 = $_POST["row3"];
$row4 = $_POST["row4"];
$row5 = $_POST["row5"];
$row6 = $_POST["row6"]; //notes
$week = $_POST["week"];
$mo_date = $_POST["mo_date"];

//Insert monday date into mo_date field
$sql1 = "UPDATE schedule SET mo_date = '$mo_date' ";

$sql = "UPDATE schedule SET ";
$sql_ext = "UPDATE schedule_ext SET ";
$sql_notes = "UPDATE notes SET ";

for($rel = 1; $rel <= 5; $rel++) {

	for($day = 0; $day < 6; $day++) {
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

			switch($rel) {
				case 1:
				$sql = $sql . $select_string . " = '" . $row1[$select_string] . "', ";
				break;
				case 2:
				$sql = $sql . $select_string . " = '" . $row2[$select_string] . "', ";
				break;
				case 3:
				if($day_str == "sa") {
					if($field_str == "id" && $row3[$select_string] != "&nbsp") {
						$sql_ext = $sql_ext . $select_string . " = '" . strtoupper($row3[$select_string]) . "', ";
					} else {
						$sql_ext = $sql_ext . $select_string . " = '" . $row3[$select_string] . "', ";
					}
				} else {
					$sql = $sql . $select_string . " = '" . $row3[$select_string] . "', ";
				}
				break;
				case 4:
				$sql = $sql . $select_string . " = '" . $row4[$select_string] . "', ";
				break;
				case 5:
				if($field_str == "id" && $row5[$select_string] != "&nbsp") {
					$sql_ext = $sql_ext . $select_string . " = '" . strtoupper($row5[$select_string]) . "', ";
				} else {
					$sql_ext = $sql_ext . $select_string . " = '" . $row5[$select_string] . "', ";
				}
				break;
			}

		}

	}

}

//NOTES
for($i = 0; $i < 6; $i++) { //for each day
	switch($i) {
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

    $sql_notes = $sql_notes . "note_$day_str = '" . $row6[$day_str] . "', ";
}

$sql = rtrim($sql, ", ");
$sql_ext = rtrim($sql_ext, ", ");
$sql_notes = rtrim($sql_notes, ", ");

if($week == "current") {
	$sql = $sql . " WHERE id = '0';";
	$sql1 = $sql1 . " WHERE id = '0';";
	$sql_ext = $sql_ext . " WHERE id = '0';";
	$sql_notes = $sql_notes . " WHERE id = '0';";
} elseif($week == "next") {
	$sql = $sql . " WHERE id = '1';";
	$sql1 = $sql1 . " WHERE id = '1';";
	$sql_ext = $sql_ext . " WHERE id = '1';";
	$sql_notes = $sql_notes . " WHERE id = '1';";
} else {
	$sql1 = $sql1 . " WHERE id = '3';";
	$sql = $sql . " WHERE id = '3';";
	$sql_ext = $sql_ext . " WHERE id = '3';";
}

mysqli_query($conn, $sql);
mysqli_query($conn, $sql1);
mysqli_query($conn, $sql_ext);
mysqli_query($conn, $sql_notes);

mysqli_close($conn);

?>