<!DOCTYPE html>
<html lang='sr-RS'>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta content="author" title="Ivan Filipović">
<title>Vindija</title>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>
<script src='main.js'></script>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet'>
<link href="main.css" rel="stylesheet">
</head>

<?php

require_once "config.php";

//SET GLOBAL ARRAY DRIVERS
$sql = "SELECT name, lastname FROM drivers WHERE available = '1' ORDER BY id";
$result = mysqli_query($conn, $sql);
echo "<script>";
while($row = mysqli_fetch_assoc($result)) {
	echo "drivers_available.push('". $row["name"] . " " . $row["lastname"] . "');";
}
echo "</script>\n";
//SET GLOBAL ARRAY VEHICLES
$sql = "SELECT registration, name FROM vehicles WHERE available = '1'";
$result = mysqli_query($conn, $sql);
$vhc_string_separator = "";
echo "<script>";
if(empty($row["name"])) {
	$vhc_string_separator = "";
} else {
	$vhc_string_separator = " ";
}
while($row = mysqli_fetch_assoc($result)) {
	echo "vehicles_available.push('". $row["registration"] . $vhc_string_separator . $row["name"] . "');";
}
echo "</script>";
mysqli_close($conn);
?>

<body id="body1">
	
<div class="container-fluid">
<div id="logo" class="row p-3">
	<div class="col-sm-12">
		<div id="logo_container">
		<img id="img_logo" src="logo.png" width="461px" height="81px" />
		</div>
	</div>
</div>

<!-- CREATE TABS FOR THE LIST BELOW -->
<div class="row p-3">
	<div class="col-sm-2"> <!-- Start left menu -->
		<div class="col">
		<div id="small_dev_menu" class="list-group">
		<button type="button" class="list-group-item list-group-item-action list-group-item-success" onclick="collapseMenu();"><i class='fas fa-bars'></i>
		Meni...</button>
		</div>
		</div>

		<div id="left_menu" class="list-group bg-dark text-info">
		<button id="menu_sched" type="button" class="list-group-item list-group-item-action list-group-item-success" onclick="loadSchedule();markMenu(this)">Raspored<span style="float: right;">></span></button>
		<button id="menu_drivers" type="button" class="list-group-item list-group-item-action list-group-item-success" onclick="loadDrivers();markMenu(this)">Vozači<span style="float: right;">></span></button>
		<button id="menu_vehicles" type="button" class="list-group-item list-group-item-action list-group-item-success" onclick="loadVehicles();markMenu(this)">Vozila<span style="float: right;">></span></button>
		<button id="menu_pattern" type="button" class="list-group-item list-group-item-action list-group-item-success" onclick="loadPatterns(); markMenu(this);">Šabloni<span style="float: right;">></span></button>
		</div>
	</div> <!-- End left menu -->

	<div class="col-sm-10"> <!-- Start content -->

	<div id="content" class="row gx-1"> <!-- Start row -->

	<!-- Container for AJAX return -->

	</div> <!-- End row -->

	</div> <!--End content -->
</div> <!-- End container-fluid -->
	
	<div id="modal" onclick="closeModal()" oncontextmenu="closeModal();return false">

	<div id="driver_select">
	</div>

	<div id="unsign_menu">
	<div class="list-group">
	<button id="btn_unsign" class="list-group-item list-group-item-action list-group-item-danger" style="padding: 1px 10px;" onclick="unsignDriver(selectedField)">Ukloni</button>
	<button id="btn_resetday" class="list-group-item list-group-item-action list-group-item-danger" style="padding: 1px 10px;" onclick="unsignPrompt('day')">Resetuj dan</button>
	<button id="btn_resettable" class="list-group-item list-group-item-action list-group-item-danger" style="padding: 1px 10px;" onclick="unsignPrompt('table')">Resetuj tabelu</button>
	<button id="btn_deletedriver" class="list-group-item list-group-item-action list-group-item-danger" style="display: none; padding: 1px 10px;" onclick="deleteDriverPrompt()">Obriši vozača</button>
	<button id="btn_deletevhc" class="list-group-item list-group-item-action list-group-item-danger" style="display: none; padding: 1px 10px;" onclick="deleteVehiclePrompt()">Obriši vozilo</button>
	</div>
	</div>

	</div>

	<div id="custom_alert">
	<div id="alert_content">
		<div id="alert_header">
			<span id="alert_caption"></span>
			<span id="alert_close">
				<button type="button" class="btn-close bg-danger" onclick="closeAlert()"></button>
			</span>
		</div>
		<div id="alert_body">
			<p id="alert_msg"></p>
		</div>
		<div id="alert_footer">
			<p id="alert_buttons">
				<button id="btn_yes" type="button" class="btn btn-outline-success" style="--bs-btn-padding-x: 30px;">Da</button>
				<button id="btn_ok" type="button" class="btn btn-primary" style="--bs-btn-padding-x: 40px;">OK</button>
				<button id="btn_no" type="button" class="btn btn-outline-danger" style="--bs-btn-padding-x: 30px;" onclick="closeAlert()">Ne</button>
			</p>
		</div>
	</div>
	</div>

	<!-- DRIVER EDIT -->
	<div id="driver_edit">
		<div id="driver_edit_content">

		<div class="row mb-3">
		<div class="col">
			<h3 id="driver_caption" style="color:darkblue; float: left;">Novi vozač</h3>
			<span style="float:right;">
			<button type="button" class="btn-close bg-danger" onclick="closeDialog('driver')"></button>
			</span>
		</div>
		</div>

		<label id="lbl_mode" style="display: none;"></label>

		<div class="row mb-3">
			<div class="col-sm-1 text-right">
			<label for="inp_id" class="col-form-label">ID:</label>
			</div>
			<div class="col-sm-1">
			<input id="inp_id" type="text" class="form-control" onkeydown="driverEdited = true; unredInput(this);" maxlength="3">
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-2 text-right">
			<label for="inp_dlicense" class="col-form-label">Vozačka dozvola:</label>
			</div>
			<div class="col-sm-2">
			<input id="inp_dlnumber" type="text" class="form-control" onkeydown="driverEdited = true;" maxlength="15" placeholder="Broj...">
			</div>
			<div class="col-sm-3" style="width: 25%;">
			<input id="inp_dlicense" type="date" class="form-control" onchange="driverEdited = true;">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-sm-1 text-right">
			<label for="inp_name" class="col-form-label">Ime:</label>
			</div>
			<div class="col-sm-4">
			<input id="inp_name" type="text" class="form-control" onkeydown="driverEdited = true; unredInput(this)" size="20" maxlength="20">
			</div>
			<div class="col-sm-2 text-right">
			<label for="inp_cpc" class="col-form-label">CPC licenca:</label>
			</div>
			<div class="col-sm-2">
			<input id="inp_cpcnumber" type="text" class="form-control" onkeydown="driverEdited = true;" maxlength="15" placeholder="Broj...">
			</div>
			<div class="col-sm-3" style="width: 25%;">
			<input id="inp_cpc" type="date" class="form-control" onchange="driverEdited = true;">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-sm-1 text-right">
			<label for="inp_lastname" class="col-form-label">Prezime:</label>
			</div>
			<div class="col-sm-4">
			<input id="inp_lastname" type="text" class="form-control" onkeydown="driverEdited = true; unredInput(this)" size="20" maxlength="20">
			</div>
			<div class="col-sm-2 text-right">
			<label for="inp_tacho" class="col-form-label">Taho kartica:</label>
			</div>
			<div class="col-sm-2">
			<input id="inp_tachonumber" type="text" class="form-control" onkeydown="driverEdited = true;" maxlength="15" placeholder="Broj...">
			</div>
			<div class="col-sm-3" style="width: 25%;">
			<input id="inp_tacho" type="date" class="form-control" onchange="driverEdited = true;">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-sm-1 text-right">
			<label for="inp_status" class="col-form-label">Status:</label>
			</div>
			<div class="col-sm-4">
			<select id="inp_status" class="form-control" onchange="driverEdited = true;">
				<option value="ra">Raspoloživ</option>
				<option value="sd">Slobodan dan</option>
				<option value="go">Godišnji odmor</option>
				<option value="bo">Bolovanje</option>
			</select>
			</div>
			<div class="col-sm-2 text-right">
			<label for="inp_medical" class="col-form-label">Lekarsko uverenje:</label>
			</div>
			<div class="col-sm-4" style="width: 20%;">
			<input id="inp_medical" type="date" class="form-control" onchange="driverEdited = true;">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-sm-5">
			
			</div>
			<div class="col-sm-2 text-right">
			<label for="inp_sanit" class="col-form-label">Sanitarni pregled:</label>
			</div>
			<div class="col-sm-4" style="width: 20%;">
			<input id="inp_sanit" type="date" class="form-control" onchange="driverEdited = true;">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-12" style="display: flex; justify-content: center; padding-top: 30px;">
			<button id="btn_save" type="button" class="btn btn-success" onclick="updateDriver();" style="width: 25%;">Sačuvaj</button>
			</div>
		</div>

	</div>
	</div>

	<!-- VEHICLE EDIT -->
	<div id="vhc_edit">
		<div id="vhc_edit_content">

		<div class="row mb-3">
		<div class="col">
			<h3 id="vhc_caption" style="color:darkblue; float: left;">Novo vozilo</h3>
			<span style="float:right;">
			<button type="button" class="btn-close bg-danger" onclick="closeDialog('vehicle')"></button>
			</span>
		</div>
		</div>

		<label id="lbl_vmode" style="display: none;"></label>

		<div class="row mb-3">
			<div class="col-sm-1 text-right">
			<label for="inp_vid" class="col-form-label">ID:</label>
			</div>
			<div class="col-sm-1">
			<input id="inp_vid" type="text" class="form-control" onkeydown="vehicleEdited = true; unredInput(this);" maxlength="3">
			</div>
			<div class="col-sm-3"></div>
			<div class="col-sm-2 text-right">
			<label for="inp_registration" class="col-form-label">Registracija:</label>
			</div>
			<div class="col-sm-3" style="width: 25%;">
			<input id="inp_registration" type="date" class="form-control" onchange="vehicleEdited = true; input6m()">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-sm-1 text-right">
			<label for="inp_plates" class="col-form-label">Tablice:</label>
			</div>
			<div class="col-sm-4">
			<input id="inp_plates" type="text" class="form-control" onkeydown="vehicleEdited = true; unredInput(this)" size="20" maxlength="20">
			</div>

			<div class="col-sm-2 text-right">
			<label for="inp_6m" class="col-form-label">Šestomesečni:</label>
			</div>
			<div class="col-sm-3">
			<input id="inp_6m" type="date" class="form-control" onchange="vehicleEdited = true; unredInput(this);">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-sm-1 text-right">
			<label for="inp_vname" class="col-form-label">Naziv:</label>
			</div>
			<div class="col-sm-4">
			<input id="inp_vname" type="text" class="form-control" onkeydown="vehicleEdited = true; unredInput(this)" size="20" maxlength="20">
			</div>
			<div class="col-sm-2 text-right">
			<label for="inp_vtacho" class="col-form-label">Tahograf:</label>
			</div>
			<div class="col-sm-3" style="width: 25%;">
			<input id="inp_vtacho" type="date" class="form-control" onchange="vehicleEdited = true;">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-sm-1 text-right">
			<label for="inp_vstatus" class="col-form-label">Status:</label>
			</div>
			<div class="col-sm-4">
			<select id="inp_vstatus" class="form-control" onchange="vehicleEdited = true; selectVStatus();">
				<option value="ra">Raspoloživo</option>
				<option value="sv">Servis</option>
				<option value="nr">Neregistrovan</option>
				<option value="dr">Drugo</option>
			</select>
			</div>
			<div class="col-sm-2 text-right">
			<label for="inp_pp" class="col-form-label">PP aparat:</label>
			</div>
			<div class="col-sm-3" style="width: 25%;">
			<input id="inp_pp" type="date" class="form-control" onchange="vehicleEdited = true;">
			</div>
		</div>

		<div class="row mb-3">
			<div class="col-sm-1 text-right">
			<label for="inp_other" class="col-form-label"></label>
			</div>
			<div class="col-sm-4">
			<input id="inp_other" type="text" class="form-control" onkeydown="vehicleEdited = true;" maxlength="20" placeholder="Status..." disabled>
			</div>
			<div class="col-sm-2 text-right">
			<label for="inp_faid" class="col-form-label">Prva pomoć:</label>
			</div>
			<div class="col-sm-3" style="width: 25%;">
			<input id="inp_faid" type="date" class="form-control" onchange="vehicleEdited = true;">
			</div>
		</div>

		<div class="row">
			<div class="col-12" style="display: flex; justify-content: center; padding-top: 30px;">
			<button id="btn_vsave" type="button" class="btn btn-success" onclick="updateVehicle();" style="width: 25%;">Sačuvaj</button>
			</div>
		</div>

		</div>
		</div>

	<div id="warning_modal">
		<div id="warning_container" class="alert alert-warning alert-dismissible fade show" role="alert">
  		<h4 class="alert-heading pb-3">UPOZORENJE!</h4>
  		<div id="warning_content"></div>
  		<button type="button" class="btn-close" onclick="$('#warning_modal').hide()" aria-label="Zatvori"></button>
		</div>
	</div>

<script>
$(document).ready(function() {
	//Check GET parameters in URL
	let href = location.href;
	let url = new URL(href);
	let rld = url.searchParams.get("rld");

	//Check for driver and vehicle docs expiration and show alert if needed
	if(rld == null) {
		checkDocs();
	}

	switch(rld) {
	case "drivers":
		$("#menu_drivers").click();
		break;
	case "vehicles":
		$("#menu_vehicles").click();
		break;
	default:
		$("#menu_sched").click();
	}
});
</script>
</body>
</html>