// dashboard
function ddata() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("ddata").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/dashboard_data.php");
  xhttp.send();
}

setInterval(function () {
  ddata();
}, 1);

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

setInterval(function () {
  feedback();
}, 1);

// Inventory
function inventory() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("inventory").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/inventory_data.php");
  xhttp.send();
}

setInterval(function () {
  inventory();
}, 1);

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

setInterval(function () {
  upcoming_data();
}, 1);

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








