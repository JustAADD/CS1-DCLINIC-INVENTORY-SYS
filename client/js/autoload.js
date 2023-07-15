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

setInterval(function () {
  doctors();
}, 1);

// patient lists
function patients() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("patients").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/patient_data.php");
  xhttp.send();
}

setInterval(function () {
  patients();
}, 1);

// transactions
function transac() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("transac").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/transactions_data.php");
  xhttp.send();
}

setInterval(function () {
  transac();
}, 1);

// Patient History
function pHistory() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("pHistory").innerHTML = this.responseText;
  }
  xhttp.open("GET", "../php/pHistory_data.php");
  xhttp.send();
}

setInterval(function () {
  pHistory();
}, 1);

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






