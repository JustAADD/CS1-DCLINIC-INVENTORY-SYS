//appointment schedule
function appointment() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("appointment").innerHTML = this.responseText;
  }
  xhttp.open("GET", "appointment.php");
  xhttp.send();
}

setInterval(function () {
  appointment();
}, 1);