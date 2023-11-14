<?php
require_once "config.php";

$command = $_POST['command'];
$inputs = $_POST['inputs'];

switch($command) {
	case "set-last-docs-check":
		setLastDocsCheck();
	break;
}

function setLastDocsCheck() {
	global $inputs, $conn;

	$sql = "UPDATE settings SET last_docs_check = '$inputs[0]';";
	mysqli_query($conn, $sql);
	mysqli_close($conn);
}
?>