const drivers_available = []; drivers_current = [];
const vehicles_available = []; vehicles_current = [];
let selectedField; //selected <p> element, for assignDriver function
let selectedDay = "", selectedWeek = "";
let Edited = false; //If edit anything in the table it goes true
let driverEdited = false, vehicleEdited = false;
let driverID, driverName, driverLastName; //Used for deleteDriver()
let vehicleID, vehicleReg; //Used for deleteVehicle()


function collapseMenu() {
  $(document).ready(function() {
    if($("#left_menu").css("display") == "none") {
    $('#left_menu').slideDown('slow');
    } else {
    $('#left_menu').slideUp('slow');
    }
  });
}


function selectDriver(element){
  $(document).ready(function() {
  selectedField = element; //GLOBAL
  arrSelected = element.id.split("_");
  selectedDay = arrSelected[0];
  rect = element.getBoundingClientRect(); //position rectangle
  //Select array based on selected day
  drivers_current = [...drivers_available];

  //Create list of available drivers
  //Remove used ones
  for(i = 1; i <= 5; i++) { //for each relation 1 to 4
    for(x = 1; x <= 2; x++) { //for each driver 1 to 2
      selector = selectedDay + "_r" + i + "_d" + x;
      driver = $("#" + selector).text();
        for(j = 0; j < drivers_current.length; j++) { //for each driver value in array
          if(driver == drivers_current[j]) {
            drivers_current.splice(j, 1);
          }
        }
    }
  }

  //List available drivers
  drivers_num = drivers_current.length;

  if(drivers_num < 1) { // if no available drivers
    html_string = "<span style='color: #ff6666'>Nema raspoloživih vozača !</span>";
    $("#driver_select").html(html_string);

  } else { // if there are available drivers

  html_string = "<div class='list-group'>";
  for(i = 0; i < drivers_num; i++) {
    html_string += "<button class='list-group-item list-group-item-action list-group-item-primary' onclick='assignDriver(this)'>" +
      drivers_current[i] + "</button>";
  }
  html_string += "</div>";
  $("#driver_select").html(html_string);

  }//end else

  $("#driver_select").show()
  $("#unsign_menu").hide()
  $("#modal").show();
  $("#body1").css("overflow", "hidden");

  //Position the div
  $("#driver_select").css("top", rect.top + rect.height + "px");
  $("#driver_select").css("left", rect.left + "px");
  menu_rect = document.getElementById("driver_select").getBoundingClientRect();
  menu_bottom = menu_rect.bottom;
  menu_height = menu_rect.height;
  //If menu below visible area put it up
  if(menu_bottom > window.innerHeight) {
    $("#driver_select").css("top", (window.innerHeight - menu_height - 10) + "px");
  }
  $("#driver_select").scrollTop(0);
  });
}


function selectVehicle(element){
  $(document).ready(function() {
  selectedField = element; //GLOBAL
  arrSelected = element.id.split("_");
  selectedDay = arrSelected[0];
  rect = element.getBoundingClientRect(); //position rectangle
  //Select array based on selected day
  vehicles_current = [...vehicles_available];
  
  //Create list of available drivers
  //Remove used ones
  for(i = 1; i <= 5; i++) { //for each relation 1 to 4
      selector = selectedDay + "_r" + i + "_v";
      vehicle = $("#" + selector).text();
        for(j = 0; j < vehicles_current.length; j++) { //for each vehicle value in array
          if(vehicle == vehicles_current[j]) {
            vehicles_current.splice(j, 1);
          }
        }
  }

  //List available drivers
  vehicles_num = vehicles_current.length;

  if(vehicles_num < 1) { // if no available vehicles
    html_string = "<span style='color: #ff6666'>Nema raspoloživih vozila !</span>";
    $("#driver_select").html(html_string);

  } else { // if there are available vehicles

  html_string = "<div class='list-group'>";
  for(i = 0; i < vehicles_num; i++) {
    html_string += "<button class='list-group-item list-group-item-action list-group-item-primary' onclick='assignDriver(this)'>" +
      vehicles_current[i].trim() + "</button>";
  }
  html_string += "</div>";
  $("#driver_select").html(html_string);

  }//end else

  $("#driver_select").show()
  $("#unsign_menu").hide()
  $("#modal").show();
  $("#body1").css("overflow", "hidden");

  //Position the div
  $("#driver_select").css("top", rect.top + rect.height + "px");
  $("#driver_select").css("left", rect.left + "px");
  menu_rect = document.getElementById("driver_select").getBoundingClientRect();
  menu_bottom = menu_rect.bottom;
  menu_height = menu_rect.height;
  //If menu below visible area put it up
  if(menu_bottom > window.innerHeight) {
    $("#driver_select").css("top", (window.innerHeight - menu_height - 10) + "px");
  }
  $("#driver_select").scrollTop(0);
  });
}


function closeModal() {
  $(document).ready(function() {
  $("#modal").hide();
  $('#body1').css('overflow', 'scroll');
  //Reset context menu buttons to default
  $("#btn_deletedriver").hide();
  $("#btn_unsign").show();
  $("#btn_resetday").show();
  $("#btn_resettable").show();
  });
}


function assignDriver(driver) {
  //driver as button element
  $(document).ready(function() {
  $(selectedField).css("color", "darkblue");
  $(selectedField).css("background-color", "#cce6ff");
  $(selectedField).text($(driver).text());
  Edited = true; //GLOBAL
  });
}


function unsignDriver(driver) {
  $(document).ready(function() {
  //Reset field to caption with driver 1 or driver 2 or vehicle
  field_type = driver.id.split("_");

  $(driver).css("color", "#ff8080");
  $(driver).css("background-color", "#ffb3b3");

  switch(field_type[2]) {
  case "d1":
    $(driver).html("Vozač 1");
    break;
  case "d2":
    $(driver).text("Vozač 2");
    break;
  case "v":
    $(driver).text("Vozilo");
    break;
  }

  Edited = true; //GLOBAL
  });
}


function unsignPrompt(reset_option) {
  //reset_option: "day" or "table"

  let selectedDay, day_str;
  selectedDay = selectedField.id.split("_");
  selectedDay = selectedDay[0];

  switch(selectedDay) {
  case "mo":
    day_str = "Ponedeljak";
    break;
  case "tu":
    day_str = "Utorak";
    break;
  case "we":
    day_str = "Sreda";
    break;
  case "th":
    day_str = "Četvrtak";
    break;
  case "fr":
    day_str = "Petak";
    break;
  case "sa":
    day_str = "Subota";
    break;
  }

  if(reset_option == "day") {
    msg = "Da li ste sigurni da želite da resetujete raspored za " + day_str + "?";
    customAlert(msg, "unsignDay();closeAlert();", "alert", "yesno");
  } else {
    msg = "Da li ste sigurni da želite da resetujete raspored za celu nedelju?";
    customAlert(msg, "unsignTable();closeAlert();", "alert", "yesno");
  }
}


function unsignDay() {
  let selectedDay, field_str, field_id = "";

  selectedDay = selectedField.id.split("_");
  selectedDay = selectedDay[0];
  field_str = selectedDay;

  if(field_str == "sa") {
      $("#" + field_str + "_r3_id").text("Naziv relacije");
    } else {
      $("#" + field_str + "_r5_id").text("Naziv relacije");
    }
  $("#" + selectedDay + "_r5_id").text("Naziv relacije");

  $("#note_" + field_str).text("NAPOMENA");
  $("#note_" + field_str).css("color", "#bfbfbf");
  $("#note_" + field_str).attr("onclick", "emptyNote(this)");

  for(i = 1; i <= 5; i++) { //for each route in selected day
    field_str += "_r" + i;

    for(x = 0; x < 3; x++) { //for each field in selected route
      switch(x) {
      case 0:
        field_id = "_d1";
        break;
      case 1:
        field_id = "_d2";
        break;
      case 2:
        field_id = "_v";
        break;
      } //end switch

      unsignDriver($("#" + field_str + field_id)[0]);
    } //end for

    field_str = selectedDay;

  } //end for
}


function unsignTable() {
  let day_str = "", field_str = "", field_id = "";

  for(d = 1; d <= 6; d++) { //for each day
    switch(d) {
    case 1:
      day_str = "mo";
      break;
    case 2:
      day_str = "tu";
      break;
    case 3:
      day_str = "we";
      break;
    case 4:
      day_str = "th";
      break;
    case 5:
      day_str = "fr";
      break;
    case 6:
      day_str = "sa";
      break;
    } //end switch

    if(day_str == "sa") {
      $("#" + day_str + "_r3_id").text("Naziv relacije");
    } else {
      $("#" + day_str + "_r5_id").text("Naziv relacije");
    }

  $("#note_" + day_str).text("NAPOMENA");
  $("#note_" + day_str).css("color", "#bfbfbf");
  $("#note_" + day_str).attr("onclick", "emptyNote(this)");


  for(i = 1; i <= 5; i++) { //for each route in selected day
    field_str = "_r" + i;

    for(x = 0; x < 3; x++) { //for each field in selected route
      switch(x) {
      case 0:
        field_id = "_d1";
        break;
      case 1:
        field_id = "_d2";
        break;
      case 2:
        field_id = "_v";
        break;
      } //end switch

      unsignDriver($("#" + day_str + field_str + field_id)[0]);
    } //end for field

    field_str = "";

  } //end for route

  day_str = "";
} //end for day
}


function editTable() {
  let rel, day, field;
  let select_string = "", day_str = "", field_str = "";
  let i, th, date_arr, date = "", date_diff;

  th = $("th"); // array with <th> elements used for date

  //NOTES
  $("#tbl_note").css("border", "1px solid lightgrey");
  $("#tbl_note").find("td").css("border", "1px solid lightgrey");

  for(i = 0; i < 6; i++) { //for each day
    date_arr = $(th[i]).html().split("<br>");
    date_arr = date_arr[1].split(".");
    date = "20" + date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
    date_diff = dateDiff(date);

    switch(i) {
    case 0:
      day_str = "mo";
      break;
    case 1:
      day_str = "tu";
      break;
    case 2:
      day_str = "we";
      break;
    case 3:
      day_str = "th";
      break;
    case 4:
      day_str = "fr";
      break;
    case 5:
      day_str = "sa";
      break;
    }

    if(selectedWeek == "current" && date_diff < 0) {
        $("#note_" + day_str).attr("contenteditable", true);
        if($("#note_" + day_str).text() == "" || $("#note_" + day_str).text() == "NAPOMENA") {
          $("#note_" + day_str).css("color", "#bfbfbf");
          $("#note_" + day_str).attr("onclick", "emptyNote(this)");
          $("#note_" + day_str).text("NAPOMENA");
        } else {
          $("#note_" + day_str).css("color", "black");
          $("#note_" + day_str).attr("onclick", "");
        }

      } else if(selectedWeek == "next") {

        $("#note_" + day_str).attr("contenteditable", true);
        if($("#note_" + day_str).text() == ""  || $("#note_" + day_str).text() == "NAPOMENA") {
          $("#note_" + day_str).css("color", "#bfbfbf");
          $("#note_" + day_str).attr("onclick", "emptyNote(this)");
          $("#note_" + day_str).text("NAPOMENA");
        } else {
          $("#note_" + day_str).css("color", "black");
        }
      }
  }

  for(rel = 1; rel <= 5; rel++) {

    for(day = 0; day < 6; day++) {

      date_arr = $(th[day]).html().split("<br>");
      date_arr = date_arr[1].split(".");
      date = "20" + date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
      date_diff = dateDiff(date);

      switch(day) {
        case 0:
        day_str = "mo";
        break;
        case 1:
        day_str = "tu";
        break;
        case 2:
        day_str = "we";
        break;
        case 3:
        day_str = "th";
        break;
        case 4:
        day_str = "fr";
        break;
        case 5:
        day_str = "sa";
        break;
      }

      for(field = 1; field <= 4; field++) {

        switch(field) {
          case 1:
          field_str = "id";
          break;
          case 2:
          field_str = "d1";
          break;
          case 3:
          field_str = "d2";
          break;
          case 4:
          field_str = "v";
          break;
        }
        if(day_str == "sa" && rel > 3) {
        break;
        }

        select_string = day_str + "_" + "r" + rel + "_" + field_str;
        
          //DRIVERS
          if(field_str == "d1" || field_str == "d2") {
            $("#" + select_string).css("background-color", "#cce6ff");
            //disable edit for passed days (if date_diff < 0)
            if(date_diff < 0) {
              $("#" + select_string).attr("onclick", "selectDriver(this)");
            }
            //If not assigned create caption
            if($("#" + select_string).text().length < 2) {
              $("#" + select_string).css("color", "#ff8080");
              $("#" + select_string).css("background-color", "#ffb3b3");
              $("#" + select_string).text("Vozač " + field_str.substr(1,1));
            }
            $("#" + select_string).attr("oncontextmenu", "showContextMenu(this, event);return false");
          }

          //For the 5th row (relation captions)
          if(rel == 5 && field == 1 || day == 5 && rel == 3 && field == 1) {
            $("#" + select_string).css("color", "#ff8080");
            $("#" + select_string).css("border-width", "1px");
            $("#" + select_string).css("border-style", "solid");
            $("#" + select_string).css("border-color", "ff8080");
            $("#" + select_string).css("background-color", "#ffff66");
            if($("#" + select_string).text().length < 2) {
              $("#" + select_string).text("Naziv relacije");
            }
            if(date_diff < 0) {
              $("#" + select_string).attr("contenteditable", true);
              $("#" + select_string).attr("oncontextmenu", "showContextMenu(this, event);return false");
              if($("#" + select_string).text() == "Naziv relacije") {
                $("#" + select_string).attr("onclick", "$(this).text('');");
              }
            }
          }


          //VEHICLES
          if(field_str == "v") {
            $("#" + select_string).css("background-color", "#cce6ff");
            //disable edit for passed days (if date_diff < 0)
            if(date_diff < 0) {
              $("#" + select_string).attr("onclick", "selectVehicle(this)");
            }
            //If not assigned create caption
            if($("#" + select_string).text().length < 2) {
              $("#" + select_string).css("color", "#ff8080");
              $("#" + select_string).css("background-color", "#ffb3b3");
              $("#" + select_string).text("Vozilo");
            }
              $("#" + select_string).attr("oncontextmenu", "showContextMenu(this, event);return false");
          }

      }
    }
  }

  $("#toggle_prev").attr("disabled", true);
  $("#toggle_next").attr("disabled", true);
  $("#btn_edit").addClass("active");
  $("#btn_edit").text("Sačuvaj izmene");
  $("#btn_edit").attr("onclick", "updateSched('" + selectedWeek + "')");
  $("#btn_discard").attr("disabled", false);

  //Show pattern select
  if(selectedWeek == "next") {
    $("#pattern").show();
  }

  //Disable left menu
  $("#left_menu").find(".list-group-item").attr("disabled", true);

  //Alert before reload or close page
  $("body").attr("onbeforeunload", "return 1");
}


function editPattern() {
  let rel, day, field;
  let select_string = "", day_str = "", field_str = "";

  for(rel = 1; rel <= 5; rel++) {

    for(day = 0; day < 6; day++) {

      switch(day) {
        case 0:
        day_str = "mo";
        break;
        case 1:
        day_str = "tu";
        break;
        case 2:
        day_str = "we";
        break;
        case 3:
        day_str = "th";
        break;
        case 4:
        day_str = "fr";
        break;
        case 5:
        day_str = "sa";
        break;
      }

      for(field = 1; field <= 4; field++) {

        switch(field) {
          case 1:
          field_str = "id";
          break;
          case 2:
          field_str = "d1";
          break;
          case 3:
          field_str = "d2";
          break;
          case 4:
          field_str = "v";
          break;
        }
        if(day_str == "sa" && rel > 3) {
        break;
        }

        select_string = day_str + "_" + "r" + rel + "_" + field_str;
        
          //DRIVERS
          if(field_str == "d1" || field_str == "d2") {
            $("#" + select_string).css("background-color", "#cce6ff");
            $("#" + select_string).attr("onclick", "selectDriver(this)");

            //If not assigned create caption
            if($("#" + select_string).text().length < 2) {
              $("#" + select_string).css("color", "#ff8080");
              $("#" + select_string).css("background-color", "#ffb3b3");
              $("#" + select_string).text("Vozač " + field_str.substr(1,1));
            }
            $("#" + select_string).attr("oncontextmenu", "showContextMenu(this, event);return false");
          }

          //For the 5th row (relation captions)
          if(rel == 5 && field == 1 || day == 5 && rel == 3 && field == 1) {
            $("#" + select_string).css("color", "#ff8080");
            $("#" + select_string).css("border-width", "1px");
            $("#" + select_string).css("border-style", "solid");
            $("#" + select_string).css("border-color", "ff8080");
            $("#" + select_string).css("background-color", "#ffff66");
            if($("#" + select_string).text().length < 2) {
              $("#" + select_string).text("Naziv relacije");
            }
            $("#" + select_string).attr("contenteditable", true);
            if($("#" + select_string).text() == "Naziv relacije") {
              $("#" + select_string).attr("onclick", "$(this).text('');");
            }
          }

          //VEHICLES
          if(field_str == "v") {
            $("#" + select_string).css("background-color", "#cce6ff");
            $("#" + select_string).attr("onclick", "selectVehicle(this)");

            //If not assigned create caption
            if($("#" + select_string).text().length < 2) {
              $("#" + select_string).css("color", "#ff8080");
              $("#" + select_string).css("background-color", "#ffb3b3");
              $("#" + select_string).text("Vozilo");
            }
              $("#" + select_string).attr("oncontextmenu", "showContextMenu(this, event);return false");
          }

      }
    }
  }
  //Enable and disable buttons
  $("#btn_pat_save").attr("disabled", false);
  $("#btn_pat_discard").attr("disabled", false);
  $("#btn_pat_edit").attr("disabled", true);

  //Disable left menu
  $("#left_menu").find(".list-group-item").attr("disabled", true);

  //Alert before reload or close page
  $("body").attr("onbeforeunload", "return 1");
}


function loadSchedule(week = "current") {
  $(document).ready(function() {

  selectedWeek = week; //GLOBAL

  $.post("render_table.php",
    { week, drivers_available },
    function(data,status){
      $("#content").html(data);

      //Set previous and next buttons
      switch(week) {
      case "current":
        $("#toggle_prev").attr("disabled", false);
        $("#toggle_prev").attr("onclick", "loadSchedule('prev');");
        $("#toggle_prev").html("<< Prethodna nedelja");
        $("#toggle_next").attr("disabled", false);
        $("#toggle_next").attr("onclick", "loadSchedule('next');");
        $("#toggle_next").html("Sledeća nedelja >>");
        $("#btn_edit").attr("disabled", false);
        break;
      case "next":
        $("#toggle_prev").attr("disabled", false);
        $("#toggle_prev").attr("onclick", "loadSchedule('current');");
        $("#toggle_prev").html("<< Trenutna nedelja");
        $("#toggle_next").attr("disabled", true);
        $("#btn_edit").attr("disabled", false);
        break;
      case "prev":
        $("#toggle_prev").attr("disabled", true);
        $("#toggle_next").attr("disabled", false);
        $("#toggle_next").attr("onclick", "loadSchedule('current');");
        $("#toggle_next").html("Trenutna nedelja >>");
        $("#btn_edit").attr("disabled", true);
        break;
      }

      //Hide pattern select
      $("#pattern").hide();

    });
  });
}


function loadPatterns() {
  $(document).ready(function() {
 test = "TEST";
  $.post("render_pattern.php",
    { },
    function(data,status){
      $("#content").html(data);
      $("#pattern").show();
    });
  });
}


function loadDrivers() {
  $(document).ready(function() {

  $.post("render_drivers.php",
    {},
    function(data,status){
      $("#content").html(data);
      //handle status error (not success)
    });

  });
}


function loadVehicles() {
  $(document).ready(function() {

  $.post("render_vehicles.php",
    {},
    function(data,status){
      $("#content").html(data);
      //handle status error (not success)
    });

  });
}


function showContextMenu(element, event, target = "schedule") {
  //target: schedule, drivers...
  //Default target is schedule table
  //event (oncontextmenu), used for positioning the menu
  $(document).ready(function() {
  rect = element.getBoundingClientRect();
  $("#unsign_menu").css("top", rect.top + rect.height + "px");
  $("#unsign_menu").css("left", event.clientX + "px");

  $('#unsign_menu').show();
  $('#driver_select').hide();
  $('#body1').css('overflow', 'hidden');
  $('#modal').show()

  //Position the menu
  menu_rect = document.getElementById("unsign_menu").getBoundingClientRect();
  menu_bottom = menu_rect.bottom;
  menu_height = menu_rect.height;
  //If menu below visible area put it up
  if(menu_bottom > window.innerHeight) {
    $("#unsign_menu").css("top", (window.innerHeight - menu_height - 10) + "px");
  }

  //Select target for menu
  if(target == "drivers") {
    //Set global variable driverID
    tds = $(element).find("td");
    driverID = $(tds[0]).html(); //GLOBAL
    driverName = $(tds[1]).html(); //GLOBAL
    driverLastName = $(tds[2]).html(); //GLOBAL
    //Set context menu buttons
    $("#btn_deletedriver").show();
    $("#btn_deletevhc").hide();
    $("#btn_unsign").hide();
    $("#btn_resetday").hide();
    $("#btn_resettable").hide();

  } else if(target == "vehicles") {
    //Set global variable vehicleID
    tds = $(element).find("td");
    vehicleID = $(tds[0]).html(); //GLOBAL
    vehicleReg = $(tds[1]).html(); //GLOBAL
    //Set context menu buttons
    $("#btn_deletevhc").show();
    $("#btn_deletedriver").hide();
    $("#btn_unsign").hide();
    $("#btn_resetday").hide();
    $("#btn_resettable").hide();
  }

  selectedField = element; //GLOBAL
  });
}


function updateSched(week = "current") {
  let row1 = {}, row2 = {}, row3 = {}, row4 = {}, row5 = {}, row6 = {};
  let select_string = "", input_note = "";
  let th, date_arr, mo_date;

  //Get monday date from <th> table element
  try {
    th = $("th:first").html();
    date_arr = th.split("<br>");
    date_arr = date_arr[1].split(".");
    mo_date = "20" + date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
  }
  catch { //If used for saving pattern
    mo_date = "0000-00-00";
  }

  for(rel = 1; rel <= 5; rel++) {

    for(day = 0; day < 6; day++) {
      switch(day) {
      case 0:
      day_str = "mo";
      break;
      case 1:
      day_str = "tu";
      break;
      case 2:
      day_str = "we";
      break;
      case 3:
      day_str = "th";
      break;
      case 4:
      day_str = "fr";
      break;
      case 5:
      day_str = "sa";
      break;
      }

      for(field = 1; field <= 4; field++) {
        switch(field) {
        case 1:
        field_str = "id";
        break;
        case 2:
        field_str = "d1";
        break;
        case 3:
        field_str = "d2";
        break;
        case 4:
        field_str = "v";
        break;
        }

        if(day_str == "sa" && rel > 3) {
        break;
        }

        select_string = day_str + "_" + "r" + rel + "_" + field_str;
        field_text = $("#" + select_string).text();

        //If empty field remove caption from .text()
        if(field_text == "Vozač 1" || field_text == "Vozač 2" || field_text == "Vozilo" || field_text == "Naziv relacije" ) {
          field_text = "&nbsp";
        }

        switch(rel) {
          case 1:
          row1[select_string] = field_text;
          case 2:
          row2[select_string] = field_text;
          case 3:
          row3[select_string] = field_text;
          case 4:
          row4[select_string] = field_text;
        case 5:
          row5[select_string] = field_text;
        }

      }
    }
  }

  //NOTES
  //if(week == "current" || week == "next") { //not for updating pattern

  for(i = 0; i < 6; i++) { //for each day
    switch(i) {
    case 0:
      day_str = "mo";
      break;
    case 1:
      day_str = "tu";
      break;
    case 2:
      day_str = "we";
      break;
    case 3:
      day_str = "th";
      break;
    case 4:
      day_str = "fr";
      break;
    case 5:
      day_str = "sa";
      break;
    }

    try {
      input_note = $("#note_" + day_str).html();
      if(input_note == "NAPOMENA") {
        input_note = "";
      } else {
        input_note = input_note.substr(0, 499);
      }
    }
    catch {
      input_note = "";
    }

    row6[day_str] = input_note;
  }//end for
  //}//end if week
  
  $.post("update_sched.php",
    {
      row1, row2, row3, row4, row5, row6, week, mo_date
    },
    function(data,status) {
      if(week == "standard") { //If used for saving pattern
        $("#menu_pattern").click();
      } else {
      loadSchedule(selectedWeek);
      $("body").attr("onbeforeunload", "");
      //handle status error (not success)
      }
    });

  //Enable left menu
  $("#left_menu").find(".list-group-item").attr("disabled", false);

  Edited = false; //GLOBAL

}


function markMenu(menu) {
  $(document).ready(function() {
  $(".list-group-item").removeClass("active");
  $(menu).addClass("active");
  });
}


function customAlert(message, functions, type = "normal", buttons = "all", title = "Vindija") {
  //type: alert, normal
  //buttons: all, ok, yesno

  $(document).ready(function() {
  //Position the elements
  wHeight = window.innerHeight;
  wWidth = window.innerWidth;
  $("#alert_content").css("top", ((wHeight / 2) - (wHeight * 0.3)) + "px");
  $("#alert_content").css("left", ((wWidth / 2) - (wWidth * 0.2)) + "px");

  //Select the type of alert
  switch(type) {
  case "alert":
    $("#alert_content").css("border-color", "rgb(255, 0, 0)");
    $("#alert_content").css("box-shadow", "0 0 5px 5px rgba(255, 0, 0, 0.3)");
    break;
  case "normal":
    $("#alert_content").css("border-color", "rgb(0, 102, 255)");
    $("#alert_content").css("box-shadow", "0 0 5px 5px rgba(0, 102, 255, 0.3)");
    break;
  }

  //Select the type of buttons
  switch(buttons) {
  case "ok":
    $("#btn_ok").show();
    $("#btn_yes").hide();
    $("#btn_no").hide();
    break;
  case "yesno":
    $("#btn_yes").show();
    $("#btn_no").show();
    $("#btn_ok").hide();
    break;
  default:
    $("#btn_ok").show();
    $("#btn_yes").show();
    $("#btn_no").show();
  }

  //Set functions for YES and OK buttons
  $("#btn_yes").attr("onclick", functions);
  $("#btn_ok").attr("onclick", functions);

  //Set alert message and title
  $("#alert_caption").html(title);
  $("#alert_msg").html(message);

  $("#body1").css("overflow", "hidden");
  $("#custom_alert").show();
  $("#alert_content").show();

  });
}


function closeAlert() {
  $(document).ready(function() {
  $("#custom_alert").hide();
  $("#body1").css("overflow", "scroll");
  });
}


function closeDialog(option) {
  //option: driver or vehicle
  switch(option) {

  case "driver":
  if(driverEdited == false) {
    closeDriver();
    return;
  }
  msg = "Da li ste sigurni da želite da zatvorite unos?<br>";
  msg += "Izmene neće biti sačuvane!";
  customAlert(msg, "closeDriver(); closeAlert();", "alert", "yesno");
  break;

  case "vehicle":
  if(vehicleEdited == false) {
    closeVehicle();
    return;
  }
  msg = "Da li ste sigurni da želite da zatvorite unos?<br>";
  msg += "Izmene neće biti sačuvane!";
  customAlert(msg, "closeVehicle(); closeAlert();", "alert", "yesno");
  break;
  }
}


function closeDriver() {
  $(document).ready(function() {
    $("#driver_edit").hide();
    $("body").css("overflow", "visible");
  });
}


function closeVehicle() {
  $(document).ready(function() {
    $("#vhc_edit").hide();
    $("body").css("overflow", "visible");
  });
}


function resetDriver() {
  $("#inp_id").attr("disabled", false);
  $("#inp_name").attr("disabled", false);
  $("#inp_lastname").attr("disabled", false);
  $("#driver_caption").html("Novi vozač");
  $("#inp_status").val("ra");

  $("#driver_edit_content").find("input").val("");
  $("#driver_edit_content").find("input").removeClass("is-invalid");
}


function resetVehicle() {
  $("#inp_vid").attr("disabled", false);
  $("#inp_plates").attr("disabled", false);
  $("#inp_other").attr("disabled", true);
  $("#vhc_caption").html("Novo vozilo");
  $("#inp_vstatus").val("ra");
  $("#inp_other").val("");

  $("#vhc_edit_content").find("input").val("");
  $("#vhc_edit_content").find("input").removeClass("is-invalid");
}


function editDriver(driver = null, mode = "edit") {
  //mode: new or edit
  let date, date_arr, date_iso, table_status;

  resetDriver();

  driverEdited = false; //GLOBAL
  $("#lbl_mode").html(mode);

  if(mode == "edit") {
    $("#driver_caption").html("Izmeni vozača");
    $("#inp_id").attr("disabled", true);
    $("#inp_name").attr("disabled", true);
    $("#inp_lastname").attr("disabled", true);

    tds = $(driver).find("td");
    $("#inp_id").val($(tds[0]).html());
    $("#inp_name").val($(tds[1]).html());
    $("#inp_lastname").val($(tds[2]).html());

    //Status
    table_status = $(tds[3]).html();
    switch(table_status) {
    case "Raspoloživ":
      $("#inp_status").val("ra");
      break;
    case "Slobodan dan":
      $("#inp_status").val("sd");
      break;
    case "Godišnji odmor":
      $("#inp_status").val("go");
      break;
    case "Bolovanje":
      $("#inp_status").val("bo");
      break;
    }

    //Dates
    date = $(tds[4]).html();
    date_arr = date.split(".");
    date_iso = date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
    $("#inp_dlicense").val(date_iso);
    date = $(tds[5]).html();
    date_arr = date.split(".");
    date_iso = date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
    $("#inp_cpc").val(date_iso);
    date = $(tds[6]).html();
    date_arr = date.split(".");
    date_iso = date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
    $("#inp_tacho").val(date_iso);
    date = $(tds[7]).html();
    date_arr = date.split(".");
    date_iso = date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
    $("#inp_medical").val(date_iso);
    date = $(tds[8]).html();
    date_arr = date.split(".");
    date_iso = date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
    $("#inp_sanit").val(date_iso);

    //Numbers
    $("#inp_dlnumber").val($(tds[9]).html());
    $("#inp_cpcnumber").val($(tds[10]).html());
    $("#inp_tachonumber").val($(tds[11]).html());
  } // end else

  $("body").css("overflow", "hidden");
  $("#driver_edit").css("display", "flex");
  document.getElementById("inp_id").focus();
}


function editVehicle(vehicle = null, mode = "edit") {
  //mode: new or edit
  let date, date_arr, date_iso, table_status;

  resetVehicle();

  vehicleEdited = false; //GLOBAL
  $("#lbl_vmode").html(mode);

  if(mode == "edit") {
    $("#vhc_caption").html("Izmeni vozilo");
    $("#inp_vid").attr("disabled", true);
    $("#inp_plates").attr("disabled", true);

    tds = $(vehicle).find("td");
    $("#inp_vid").val($(tds[0]).html());
    $("#inp_plates").val($(tds[1]).html());
    $("#inp_vname").val($(tds[2]).html());

    //Status
    table_status = $(tds[3]).html();
    switch(table_status) {
    case "Raspoloživo":
      $("#inp_vstatus").val("ra");
      $("#inp_other").val("");
      $("#inp_other").attr("disabled", true);
      break;
    case "Servis":
      $("#inp_vstatus").val("sv");
      $("#inp_other").val("");
      $("#inp_other").attr("disabled", true);
      break;
    case "Neregistrovan":
      $("#inp_vstatus").val("nr");
      $("#inp_other").val("");
      $("#inp_other").attr("disabled", true);
      break;
    default:
      $("#inp_vstatus").val("dr");
      $("#inp_other").val(table_status);
      selectVStatus();
      break;
    }
    $("#inp_capacity").val($(tds[4]).html());

    //Dates
    date = $(tds[4]).html();
    date_arr = date.split(".");
    date_iso = date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
    $("#inp_registration").val(date_iso);
    date = $(tds[5]).html();
    date_arr = date.split(".");
    date_iso = date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
    $("#inp_6m").val(date_iso);
    date = $(tds[6]).html();
    date_arr = date.split(".");
    date_iso = date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
    $("#inp_vtacho").val(date_iso);
    date = $(tds[7]).html();
    date_arr = date.split(".");
    date_iso = date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
    $("#inp_pp").val(date_iso);
    date = $(tds[8]).html();
    date_arr = date.split(".");
    date_iso = date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
    $("#inp_faid").val(date_iso);
  } //end else

  $("body").css("overflow", "hidden");
  $("#vhc_edit").css("display", "flex");
  document.getElementById("inp_vid").focus();
}


function discardChanges() {
  msg_str = "Da li ste sigurni da želite da odbacite izmene?";
  functions_str = "loadSchedule(selectedWeek); closeAlert(); $('.list-group-item').attr('disabled', false); $('#pattern').hide()";
  customAlert(msg_str, functions_str, "alert", "yesno");

  $("body").attr("onbeforeunload", "");
  Edited = false //GLOBAL
}


function discardPattern() {
  msg_str = "Da li ste sigurni da želite da odbacite izmene?";
  functions_str = "loadPatterns(); closeAlert(); $('.list-group-item').attr('disabled', false);";
  customAlert(msg_str, functions_str, "alert", "yesno");

  $("body").attr("onbeforeunload", "");
  Edited = false //GLOBAL
}


function input6m() {
  let input_date = $("#inp_registration").val();
  let date_str, day, month, year;

  const date = new Date(input_date);
  date.setMonth(date.getMonth() - 6);

  day = date.getDate();
  month = date.getMonth() + 1;
  year = date.getFullYear();

  if(!isNaN(date.getMonth())) {
    if(month < 10) {
      month = "0" + month;
    }
    if(day < 10) {
      day = "0" + day;
    }
  }

  date_str = year + "-" + month + "-" + day;
  $("#inp_6m").val(date_str);
}


function updateDriver() {
  const driver = new Object();
  let msg = ""; //customAlert() message
  let valid = true;

  //Check for ID validity
  id = $("#inp_id").val();

  if(id.length < 1 || isNaN(id)) {
    msg = "ID vozača mora biti broj između 0 i 999.";
    $("#inp_id").addClass("is-invalid");
    customAlert(msg, "closeAlert();", "alert", "ok");
    return;
  }
  //Check for name and lastname validity
  msg = "Morate da unesete sledeće podatke:<br>";
  if($("#inp_name").val() == "") {
    msg += "<br>- Ime vozača";
    $("#inp_name").addClass("is-invalid");
    valid = false;
  }
  if($("#inp_lastname").val() == "") {
    msg += "<br>- Prezime vozača";
    $("#inp_lastname").addClass("is-invalid");
    valid = false;
  }

  if(valid == false) {
    customAlert(msg, "closeAlert();", "alert", "ok");
    return;

  }

  //If nothing changed exit function
  if(driverEdited == false) {
    return;
  }

  //CHECK IF ID ALREADY EXIST IN DATABASE (check from table <td>)
  if($("#lbl_mode").html() == "new") {
  ids = $(".td_id");
  for(i = 0; i < ids.length; i++) {
    if($(ids[i]).html() == $("#inp_id").val()) {
      msg = "Vozač sa ID brojem " + $("#inp_id").val() + " već postoji!<br>Molim odaberite drugi ID broj.";
      $("#inp_id").addClass("is-invalid");
      customAlert(msg, "closeAlert();$('#inp_id').focus();$('#inp_id').select();", "alert", "ok");
      return;
    }
  }
  }

  //Create driver object and send by post method
  driver.mode = $("#lbl_mode").html();
  driver.id = onlyAN($("#inp_id").val());
  driver.name = onlyAN($("#inp_name").val());
  driver.lastname = onlyAN($("#inp_lastname").val());
  if($("#inp_status").val() == "ra") {
    driver.available = 1;
  } else {
    driver.available = 0;
  }
  driver.status = $("#inp_status").val();
  driver.dlnumber = onlyAN($("#inp_dlnumber").val());
  driver.dlicense = $("#inp_dlicense").val();
  driver.cpcnumber = onlyAN($("#inp_cpcnumber").val());
  driver.cpc = $("#inp_cpc").val();
  driver.tachonumber = onlyAN($("#inp_tachonumber").val());
  driver.tacho = onlyAN($("#inp_tacho").val());
  driver.medical = $("#inp_medical").val();
  driver.sanit = $("#inp_sanit").val();

  //If dates are unset set them to 0000-00-00 because of the mysql date format
  if(driver.dlicense == "") {
    driver.dlicense = "0000-00-00";
  }
  if(driver.cpc == "") {
    driver.cpc = "0000-00-00";
  }
  if(driver.tacho == "") {
    driver.tacho = "0000-00-00";
  }
  if(driver.medical == "") {
    driver.medical = "0000-00-00";
  }
  if(driver.sanit == "") {
    driver.sanit = "0000-00-00";
  }

  $.post("update_driver.php",
    { driver },
    function(data,status){
      location.replace(location.pathname + "?rld=drivers");
    });
}


function updateVehicle() {
  const vehicle = new Object();
  let msg = ""; //customAlert() message
  let valid = true;

  //Check for ID validity
  id = $("#inp_vid").val();

  if(id.length < 1 || isNaN(id)) {
    msg = "ID vozila mora biti broj između 0 i 999.";
    $("#inp_vid").addClass("is-invalid");
    customAlert(msg, "closeAlert();", "alert", "ok");
    return;
  }
  //Check for name and lastname validity
  msg = "Morate da unesete tablice vozila.";
  if($("#inp_plates").val() == "") {
    $("#inp_name").addClass("is-invalid");
    valid = false;
  }

  if(valid == false) {
    customAlert(msg, "closeAlert();", "alert", "ok");
    return;
  }

  //If nothing changed exit function
  if(vehicleEdited == false) {
    return;
  }

  //CHECK IF ID ALREADY EXIST IN DATABASE (check from table <td>)
  if($("#lbl_vmode").html() == "new") {
  ids = $(".td_vid");
  for(i = 0; i < ids.length; i++) {
    if($(ids[i]).html() == $("#inp_vid").val()) {
      msg = "Vozilo sa ID brojem " + $("#inp_vid").val() + " već postoji!<br>Molim odaberite drugi ID broj.";
      $("#inp_vid").addClass("is-invalid");
      customAlert(msg, "closeAlert();$('#inp_id').focus();$('#inp_id').select();", "alert", "ok");
      return;
    }
  }
  }

  //Create vehicle object and send by post method
  vehicle.mode = $("#lbl_vmode").html();
  vehicle.id = onlyAN($("#inp_vid").val());
  vehicle.plates = onlyAN($("#inp_plates").val());
  vehicle.name = onlyAN($("#inp_vname").val());
  if($("#inp_vstatus").val() == "ra") {
    vehicle.available = 1;
  } else {
    vehicle.available = 0;
  }
  if($("#inp_vstatus").val() == "dr") {
    vehicle.status = $("#inp_other").val();
  } else {
    vehicle.status = $("#inp_vstatus").val();
  }
  vehicle.registration = $("#inp_registration").val();
  vehicle.sixm = $("#inp_6m").val();
  vehicle.tacho = $("#inp_vtacho").val();
  vehicle.pp = $("#inp_pp").val();
  vehicle.faid = $("#inp_faid").val();

  //If dates are unset set them to 0000-00-00 because of the mysql date format
  if(vehicle.registration == "") {
    vehicle.registration = "0000-00-00";
  }
  if(vehicle.tacho == "") {
    vehicle.tacho = "0000-00-00";
  }
  if(vehicle.pp == "") {
    vehicle.pp = "0000-00-00";
  }
  if(vehicle.faid == "") {
    vehicle.faid = "0000-00-00";
  }

  $.post("update_vehicle.php",
    { vehicle },
    function(data,status){
      location.replace(location.pathname + "?rld=vehicles");
    });
}


function deleteDriverPrompt() {
  msg = "Da li ste sigurni da želite da obrišete vozača " + driverName +
  " " + driverLastName + "?<br>Biće trajno obrisani svi podaci!";
  customAlert(msg, "deleteDriver();closeAlert();", "alert", "yesno");
}


function deleteVehiclePrompt() {
  msg = "Da li ste sigurni da želite da obrišete vozilo " + vehicleReg + 
  "?<br>Biće trajno obrisani svi podaci!";
  customAlert(msg, "deleteVehicle();closeAlert();", "alert", "yesno");
}


function deleteDriver() {
  $.post("delete_driver.php",
    { driverID },
    function(data,status){
      location.replace(location.pathname + "?rld=drivers");
    });
}


function deleteVehicle() {
  $.post("delete_vehicle.php",
    { vehicleID },
    function(data,status){
      location.replace(location.pathname + "?rld=vehicles");
    });
}


function selectVStatus() {
  if($("#inp_vstatus").val() == "dr") {
  $("#inp_other").attr("disabled", false);
  document.getElementById("inp_other").focus();
  } else {
  $("#inp_other").attr("disabled", true);
  }
}


//Only alphanumeric unicode, no other characters
function onlyAN(input) {
  let result = "";

  if (input == "") {
    return result;
  }

  try {
    result = input.match(/[\p{L}\p{N}\s \.\-]/gu).join("");
    return result;
  }
  catch {
    return "";
  }

}


function dateDiff(input) {
  //input: date formated as "YYYY-MM-DD"
  //returns result of current date - input date

const day = 1000 * 60 * 60 *24;
let inputDate, dateDiff;

inputDate = new Date(input).getTime();
dateDiff = Date.now() - inputDate;

return Math.floor(dateDiff / day);
}


function parseInput(input) {
  input.split(";");
}


function checkDocs() {
$(document).ready(function() {
  let data_row, data_value, length, i, document_str, expired_str = "";
  let html = "";
  let command, inputs = [], date_str, last_docs_check, month, day;
  const date = new Date();

  //Set todays date in date_str as "YYYY-MM-DD"
  month = date.getMonth() + 1;
  day = date.getDate();
  if(month < 10) {
    month = "0" + month;
  }
  if(day < 10) {
    day = "0" + day;
  }
  date_str = date.getFullYear() + "-" + month + "-" + day;

  $.post("check_docs.php",
    {},
    function(data,status){
      //Parse data
      data_row = data.split("\n");
      //Check last docs checked date
      //Show alert only once a day
      last_docs_check = data_row[0];
      if(last_docs_check == date_str) {
        return;
      }

      length = data_row.length;
      for(i = 1; i < length; i++) {
        if(data_row[i] == "") {
          break;
        }

        data_value = data_row[i].split(";");
        if(data_value[3] == "") { //If more than 30 days left
          alert(data_value[3]);
          break;
        }

        switch (data_value[0]) {
        case "dl":
          document_str = "Vozačka dozvola vozača ";
          expired_str = " je istekla."
          break;
        case "cpc":
          document_str = "CPC licenca vozača ";
          expired_str = " je istekla."
          break;
        case "tacho":
          document_str = "Taho kartica vozača ";
          expired_str = " je istekla."
          break;
        case "medical":
          document_str = "Lekarsko uverenje vozača ";
          expired_str = " je isteklo."
          break;
        case "sanit":
          document_str = "Sanitarni pregled vozača ";
          expired_str = " je istekao."
          break;
        case "v_reg":
          document_str = "Registracija vozila ";
          expired_str = " je istekla."
          break;
        case "v_tacho":
          document_str = "Kalibracija tahografa vozila ";
          expired_str = " je istekla."
          break;
        case "v_6m":
          document_str = "Šestomesečni tehnički pregled za ";
          //expired_str = " je istekla."
          break;
        }

        if(data_value[3] >= 1) {
          html += "<p>" + document_str + data_value[1] + " " + data_value[2] + " ističe za " + data_value[3] + " dana.</p>";
        } else {
          html += "<p>" + document_str + data_value[1] + " " + data_value[2] + expired_str + "</p>";

        }

      } //end for

      if(html == "") { //If no warnings don't show modal
        return;
      }

      //Set current date as last checked docs alert date
      command = "set-last-docs-check";
      inputs.push(date_str);

      $.post("settings.php",
      { command, inputs },
      function(data,status){

      });

      $("#warning_content").html(html);
      $("#warning_modal").show();
    });

});
}


function usePattern(pattern) {
  let th, date_arr, mo_date;

  //Get monday date from <th> table element
  try {
    th = $("th:first").html();
    date_arr = th.split("<br>");
    date_arr = date_arr[1].split(".");
    mo_date = "20" + date_arr[2] + "-" + date_arr[1] + "-" + date_arr[0];
  }
  catch { //If used for saving pattern
    mo_date = "0000-00-00";
  }

    $.post("use_pattern.php",
      { pattern, mo_date },
      function(data,status){
      loadSchedule("next");
    });

  //Enable left menu
  $("#left_menu").find(".list-group-item").attr("disabled", false);

  Edited = false; //GLOBAL
}

function usePatternPrompt() {
  let msg = "Da li ste sigurni da želite da primenite šablon?<br>Sve što ste prethodno sačuvali u rasporedu za sledeću nedelju biće obrisano!";
  
  if($("#sel_pattern").val() == 0) {
    customAlert("Molim izaberite šablon.", "closeAlert()", "normal", "ok");
    return;
  }

  customAlert("Molim izaberite šablon.", "closeAlert()", "normal", "ok");
  if($("#sel_pattern").val() == "standard") {
    customAlert(msg, "usePattern('standard');closeAlert();", "normal", "yesno");
  } else {
    customAlert(msg, "usePattern('copy');closeAlert();", "normal", "yesno");
  }
}


function emptyNote(element) {

  if($(element).text() == "" || $(element).text() == "NAPOMENA") {
    $(element).text("");
    $(element).css("color", "black");
  }

}


function fTest() {
  alert(Edited);
}

/* *** NOTES ***
- Show pattern only for editing next week
 */