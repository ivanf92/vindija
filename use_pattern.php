<?php
require_once "config.php";

$pattern = $_POST["pattern"];
$mo_date = $_POST["mo_date"];

if($pattern == "copy") {
$sql = "DELETE FROM schedule WHERE id = 1;";
$sql_ext = "DELETE FROM schedule_ext WHERE id = 1;";
mysqli_query($conn, $sql);
mysqli_query($conn, $sql_ext);

$sql = "INSERT INTO `schedule` (`id`, `mo_date`, `mo_r1_id`, `mo_r1_d1`, `mo_r1_d2`, `mo_r1_v`, `mo_r2_id`, `mo_r2_d1`, `mo_r2_d2`, `mo_r2_v`, `mo_r3_id`, `mo_r3_d1`, `mo_r3_d2`, `mo_r3_v`, `mo_r4_id`, `mo_r4_d1`, `mo_r4_d2`, `mo_r4_v`, `tu_r1_id`, `tu_r1_d1`, `tu_r1_d2`, `tu_r1_v`, `tu_r2_id`, `tu_r2_d1`, `tu_r2_d2`, `tu_r2_v`, `tu_r3_id`, `tu_r3_d1`, `tu_r3_d2`, `tu_r3_v`, `tu_r4_id`, `tu_r4_d1`, `tu_r4_d2`, `tu_r4_v`, `we_r1_id`, `we_r1_d1`, `we_r1_d2`, `we_r1_v`, `we_r2_id`, `we_r2_d1`, `we_r2_d2`, `we_r2_v`, `we_r3_id`, `we_r3_d1`, `we_r3_d2`, `we_r3_v`, `we_r4_id`, `we_r4_d1`, `we_r4_d2`, `we_r4_v`, `th_r1_id`, `th_r1_d1`, `th_r1_d2`, `th_r1_v`, `th_r2_id`, `th_r2_d1`, `th_r2_d2`, `th_r2_v`, `th_r3_id`, `th_r3_d1`, `th_r3_d2`, `th_r3_v`, `th_r4_id`, `th_r4_d1`, `th_r4_d2`, `th_r4_v`, `fr_r1_id`, `fr_r1_d1`, `fr_r1_d2`, `fr_r1_v`, `fr_r2_id`, `fr_r2_d1`, `fr_r2_d2`, `fr_r2_v`, `fr_r3_id`, `fr_r3_d1`, `fr_r3_d2`, `fr_r3_v`, `fr_r4_id`, `fr_r4_d1`, `fr_r4_d2`, `fr_r4_v`, `sa_r1_id`, `sa_r1_d1`, `sa_r1_d2`, `sa_r1_v`, `sa_r2_id`, `sa_r2_d1`, `sa_r2_d2`, `sa_r2_v`) SELECT 1, '" . $mo_date . "', `mo_r1_id`, `mo_r1_d1`, `mo_r1_d2`, `mo_r1_v`, `mo_r2_id`, `mo_r2_d1`, `mo_r2_d2`, `mo_r2_v`, `mo_r3_id`, `mo_r3_d1`, `mo_r3_d2`, `mo_r3_v`, `mo_r4_id`, `mo_r4_d1`, `mo_r4_d2`, `mo_r4_v`, `tu_r1_id`, `tu_r1_d1`, `tu_r1_d2`, `tu_r1_v`, `tu_r2_id`, `tu_r2_d1`, `tu_r2_d2`, `tu_r2_v`, `tu_r3_id`, `tu_r3_d1`, `tu_r3_d2`, `tu_r3_v`, `tu_r4_id`, `tu_r4_d1`, `tu_r4_d2`, `tu_r4_v`, `we_r1_id`, `we_r1_d1`, `we_r1_d2`, `we_r1_v`, `we_r2_id`, `we_r2_d1`, `we_r2_d2`, `we_r2_v`, `we_r3_id`, `we_r3_d1`, `we_r3_d2`, `we_r3_v`, `we_r4_id`, `we_r4_d1`, `we_r4_d2`, `we_r4_v`, `th_r1_id`, `th_r1_d1`, `th_r1_d2`, `th_r1_v`, `th_r2_id`, `th_r2_d1`, `th_r2_d2`, `th_r2_v`, `th_r3_id`, `th_r3_d1`, `th_r3_d2`, `th_r3_v`, `th_r4_id`, `th_r4_d1`, `th_r4_d2`, `th_r4_v`, `fr_r1_id`, `fr_r1_d1`, `fr_r1_d2`, `fr_r1_v`, `fr_r2_id`, `fr_r2_d1`, `fr_r2_d2`, `fr_r2_v`, `fr_r3_id`, `fr_r3_d1`, `fr_r3_d2`, `fr_r3_v`, `fr_r4_id`, `fr_r4_d1`, `fr_r4_d2`, `fr_r4_v`, `sa_r1_id`, `sa_r1_d1`, `sa_r1_d2`, `sa_r1_v`, `sa_r2_id`, `sa_r2_d1`, `sa_r2_d2`, `sa_r2_v` FROM `schedule` WHERE id = 0;";

$sql_ext = "INSERT INTO `schedule_ext` (`id`, `mo_r5_id`, `mo_r5_d1`, `mo_r5_d2`, `mo_r5_v`, `tu_r5_id`, `tu_r5_d1`, `tu_r5_d2`, `tu_r5_v`, `we_r5_id`, `we_r5_d1`, `we_r5_d2`, `we_r5_v`, `th_r5_id`, `th_r5_d1`, `th_r5_d2`, `th_r5_v`, `fr_r5_id`, `fr_r5_d1`, `fr_r5_d2`, `fr_r5_v`, `sa_r3_id`, `sa_r3_d1`, `sa_r3_d2`, `sa_r3_v`) SELECT '1', `mo_r5_id`, `mo_r5_d1`, `mo_r5_d2`, `mo_r5_v`, `tu_r5_id`, `tu_r5_d1`, `tu_r5_d2`, `tu_r5_v`, `we_r5_id`, `we_r5_d1`, `we_r5_d2`, `we_r5_v`, `th_r5_id`, `th_r5_d1`, `th_r5_d2`, `th_r5_v`, `fr_r5_id`, `fr_r5_d1`, `fr_r5_d2`, `fr_r5_v`, `sa_r3_id`, `sa_r3_d1`, `sa_r3_d2`, `sa_r3_v` FROM `schedule_ext` WHERE id = 0;";

mysqli_query($conn, $sql);
mysqli_query($conn, $sql_ext);

} else { //If pattern = "standard"
	$sql = "DELETE FROM schedule WHERE id = 1;";
	$sql_ext = "DELETE FROM schedule_ext WHERE id = 1;";
	mysqli_query($conn, $sql);
	mysqli_query($conn, $sql_ext);

	$sql = "INSERT INTO `schedule` (`id`, `mo_date`, `mo_r1_id`, `mo_r1_d1`, `mo_r1_d2`, `mo_r1_v`, `mo_r2_id`, `mo_r2_d1`, `mo_r2_d2`, `mo_r2_v`, `mo_r3_id`, `mo_r3_d1`, `mo_r3_d2`, `mo_r3_v`, `mo_r4_id`, `mo_r4_d1`, `mo_r4_d2`, `mo_r4_v`, `tu_r1_id`, `tu_r1_d1`, `tu_r1_d2`, `tu_r1_v`, `tu_r2_id`, `tu_r2_d1`, `tu_r2_d2`, `tu_r2_v`, `tu_r3_id`, `tu_r3_d1`, `tu_r3_d2`, `tu_r3_v`, `tu_r4_id`, `tu_r4_d1`, `tu_r4_d2`, `tu_r4_v`, `we_r1_id`, `we_r1_d1`, `we_r1_d2`, `we_r1_v`, `we_r2_id`, `we_r2_d1`, `we_r2_d2`, `we_r2_v`, `we_r3_id`, `we_r3_d1`, `we_r3_d2`, `we_r3_v`, `we_r4_id`, `we_r4_d1`, `we_r4_d2`, `we_r4_v`, `th_r1_id`, `th_r1_d1`, `th_r1_d2`, `th_r1_v`, `th_r2_id`, `th_r2_d1`, `th_r2_d2`, `th_r2_v`, `th_r3_id`, `th_r3_d1`, `th_r3_d2`, `th_r3_v`, `th_r4_id`, `th_r4_d1`, `th_r4_d2`, `th_r4_v`, `fr_r1_id`, `fr_r1_d1`, `fr_r1_d2`, `fr_r1_v`, `fr_r2_id`, `fr_r2_d1`, `fr_r2_d2`, `fr_r2_v`, `fr_r3_id`, `fr_r3_d1`, `fr_r3_d2`, `fr_r3_v`, `fr_r4_id`, `fr_r4_d1`, `fr_r4_d2`, `fr_r4_v`, `sa_r1_id`, `sa_r1_d1`, `sa_r1_d2`, `sa_r1_v`, `sa_r2_id`, `sa_r2_d1`, `sa_r2_d2`, `sa_r2_v`) SELECT 1, '" . $mo_date . "', `mo_r1_id`, `mo_r1_d1`, `mo_r1_d2`, `mo_r1_v`, `mo_r2_id`, `mo_r2_d1`, `mo_r2_d2`, `mo_r2_v`, `mo_r3_id`, `mo_r3_d1`, `mo_r3_d2`, `mo_r3_v`, `mo_r4_id`, `mo_r4_d1`, `mo_r4_d2`, `mo_r4_v`, `tu_r1_id`, `tu_r1_d1`, `tu_r1_d2`, `tu_r1_v`, `tu_r2_id`, `tu_r2_d1`, `tu_r2_d2`, `tu_r2_v`, `tu_r3_id`, `tu_r3_d1`, `tu_r3_d2`, `tu_r3_v`, `tu_r4_id`, `tu_r4_d1`, `tu_r4_d2`, `tu_r4_v`, `we_r1_id`, `we_r1_d1`, `we_r1_d2`, `we_r1_v`, `we_r2_id`, `we_r2_d1`, `we_r2_d2`, `we_r2_v`, `we_r3_id`, `we_r3_d1`, `we_r3_d2`, `we_r3_v`, `we_r4_id`, `we_r4_d1`, `we_r4_d2`, `we_r4_v`, `th_r1_id`, `th_r1_d1`, `th_r1_d2`, `th_r1_v`, `th_r2_id`, `th_r2_d1`, `th_r2_d2`, `th_r2_v`, `th_r3_id`, `th_r3_d1`, `th_r3_d2`, `th_r3_v`, `th_r4_id`, `th_r4_d1`, `th_r4_d2`, `th_r4_v`, `fr_r1_id`, `fr_r1_d1`, `fr_r1_d2`, `fr_r1_v`, `fr_r2_id`, `fr_r2_d1`, `fr_r2_d2`, `fr_r2_v`, `fr_r3_id`, `fr_r3_d1`, `fr_r3_d2`, `fr_r3_v`, `fr_r4_id`, `fr_r4_d1`, `fr_r4_d2`, `fr_r4_v`, `sa_r1_id`, `sa_r1_d1`, `sa_r1_d2`, `sa_r1_v`, `sa_r2_id`, `sa_r2_d1`, `sa_r2_d2`, `sa_r2_v` FROM `schedule` WHERE id = 3;";

	$sql_ext = "INSERT INTO `schedule_ext` (`id`, `mo_r5_id`, `mo_r5_d1`, `mo_r5_d2`, `mo_r5_v`, `tu_r5_id`, `tu_r5_d1`, `tu_r5_d2`, `tu_r5_v`, `we_r5_id`, `we_r5_d1`, `we_r5_d2`, `we_r5_v`, `th_r5_id`, `th_r5_d1`, `th_r5_d2`, `th_r5_v`, `fr_r5_id`, `fr_r5_d1`, `fr_r5_d2`, `fr_r5_v`, `sa_r3_id`, `sa_r3_d1`, `sa_r3_d2`, `sa_r3_v`) SELECT '1', `mo_r5_id`, `mo_r5_d1`, `mo_r5_d2`, `mo_r5_v`, `tu_r5_id`, `tu_r5_d1`, `tu_r5_d2`, `tu_r5_v`, `we_r5_id`, `we_r5_d1`, `we_r5_d2`, `we_r5_v`, `th_r5_id`, `th_r5_d1`, `th_r5_d2`, `th_r5_v`, `fr_r5_id`, `fr_r5_d1`, `fr_r5_d2`, `fr_r5_v`, `sa_r3_id`, `sa_r3_d1`, `sa_r3_d2`, `sa_r3_v` FROM `schedule_ext` WHERE id = 3;";

mysqli_query($conn, $sql);
mysqli_query($conn, $sql_ext);

}

mysqli_close($conn);
?>