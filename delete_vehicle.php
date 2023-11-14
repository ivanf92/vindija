<?php
require_once "config.php";

//POST DATA
$vehicle_id = $_POST["vehicleID"];

$sql = "DELETE FROM vehicles WHERE id = '" . $vehicle_id . "';";

mysqli_query($conn, $sql);

mysqli_close($conn);

?>