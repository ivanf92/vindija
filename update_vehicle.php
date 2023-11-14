<?php
require_once "config.php";

//POST DATA
$vehicle = $_POST["vehicle"];

if($vehicle["mode"] == "new") {
	$sql = "INSERT INTO vehicles VALUES ('" . $vehicle["id"] . "', '" . $vehicle["plates"] . "', '" . $vehicle["name"] . "', '" . $vehicle["sixm"] . "', '" . $vehicle["available"] . "', '" . $vehicle["status"] . "', '" . $vehicle["registration"] . "', '" . $vehicle["tacho"] . "', '" . $vehicle["pp"] . "', '" . $vehicle["faid"] . "');";

} else {

	$sql = "UPDATE vehicles SET available = '" . $vehicle['available'] . "', status = '" . $vehicle['status'] . "', name = '" . $vehicle['name'] . "', 6m = '" . $vehicle['sixm'] . "', reg_exp = '" . $vehicle['registration'] . "', tacho_exp = '" . $vehicle['tacho'] . "', pp_exp = '" . $vehicle['pp'] . "', faid_exp = '" . $vehicle['faid'];
	$sql = $sql . "' WHERE id = " . $vehicle['id'];;
}	

mysqli_query($conn, $sql);

mysqli_close($conn);

?>