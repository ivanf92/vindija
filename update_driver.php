<?php
require_once "config.php";

//POST DATA
$driver = $_POST["driver"];

if($driver["mode"] == "new") {
	$sql = "INSERT INTO drivers VALUES ('" . $driver["id"] . "', '" . $driver["name"] . "', '" . $driver["lastname"] . "', '" . $driver["available"] . "', '" . $driver["status"] . "', '" . $driver["dlnumber"] . "', '" . $driver["dlicense"] . "', '" . $driver["cpcnumber"] . "', '" . $driver["cpc"] . "', '" . $driver["tachonumber"] . "', '" . $driver["tacho"] . "', '" . $driver["medical"]  . "', '" . $driver["sanit"] . "');";

} else {

	$sql = "UPDATE drivers SET available = '" . $driver['available'] . "', status = '" . $driver['status'] . "', dlicense = '" . $driver['dlnumber'] . "', dl_date = '" . $driver['dlicense'] . "', license = '" . $driver['cpcnumber'] . "', cpc_date = '" . $driver['cpc'] . "', tacho = '" . $driver['tachonumber'] . "', tacho_date = '" . $driver['tacho'] . "', medical = '" . $driver['medical'] . "', sanit = '" . $driver['sanit'];
	$sql = $sql . "' WHERE id = " . $driver['id'];;
}	

mysqli_query($conn, $sql);

mysqli_close($conn);

?>