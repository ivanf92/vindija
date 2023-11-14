<?php
require_once "config.php";

//POST DATA
$driver_id = $_POST["driverID"];

$sql = "DELETE FROM drivers WHERE id = '" . $driver_id . "';";

mysqli_query($conn, $sql);

mysqli_close($conn);

?>