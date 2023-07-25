// dashboard
function ddata() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("ddata").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/dashboard_data.php");
  xhttp.send();
}
ddata();

//for records 
function recapp() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("recapp").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/dashboard_data.php");
  xhttp.send();
}
recapp();


// doctors
function doctors() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("doctors").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/doctors_data.php");
  xhttp.send();
}

doctors();


// patient lists
function patients() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("patients").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/patient_data.php");
  xhttp.send();
}
patients();

// patient transaction
function transaction() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("transaction").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/p_transaction_data.php");
  xhttp.send();
}

transaction();


// Feedback w/ Sentiment Analysis
function feedback() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("feedback").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/sa_feedback_data.php");
  xhttp.send();
}


feedback();


// Inventory
function inventory() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("inventory").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/inventory_data.php");
  xhttp.send();
}

inventory();


//upcoming session
// Inventory
function upcoming_data() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("upcoming_data").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/upcoming_data.php");
  xhttp.send();
}

upcoming_data();


// Manage Schedule
function manageSchedule() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("manageSchedule").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/manage_schedule_data.php");
  xhttp.send();
}
manageSchedule();

// Completed booking
function completed() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("completed").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/completed_booking_data.php");
  xhttp.send();
}
completed();

// Rejected booking
function rejected() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("rejected").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/rejected_booking_data.php");
  xhttp.send();
}
rejected();

// Approved booking
function approved() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("approved").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/approved_booking_data.php");
  xhttp.send();
}
approved();


// Positive
function positive() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("positive").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/positive_feedbackData.php");
  xhttp.send();
}
positive();


// negative
function negative() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("negative").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/negative_feedbackData.php");
  xhttp.send();
}
negative();

// neutral
function neutral() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("neutral").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/neutral_feedbackData.php");
  xhttp.send();
}
neutral();

//feedback settings
function feedbackSettings() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("feedbackSettings").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/sa_feedback_data.php");
  xhttp.send();
}
feedbackSettings();

//settings
function settings() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("settings").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/settings_data.php");
  xhttp.send();
}
settings();

//admin settings
function Adminsettings() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("Adminsettings").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/admin_settingsData.php");
  xhttp.send();
}
Adminsettings();







