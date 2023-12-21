<?php
// Connect to the database (replace with your credentials)
//main connection file for both admin & front end
$hostname = ""; //server
$username = "u530383017_root"; //username
$password = "Ik@wl@ngb0w4"; //password
$dbname = "u530383017_localhost";  //databases //databases

// Create connection
$con = mysqli_connect($hostname, $username, $password, $dbname); // connecting 
// Check connection

if (!$con) {

  die("Connection failed: " . mysqli_connect_error());
}

// Fetch positive feedback
$queryPositive = "SELECT * FROM feedback_table WHERE sentiment = 'positive' ORDER BY ID DESC";
$resultPositive = $con->query($queryPositive);
$dataPositive = array();
while ($row = $resultPositive->fetch_assoc()) {
  $dataPositive[] = $row;
}

// Fetch negative feedback
$queryNegative = "SELECT * FROM feedback_table WHERE sentiment = 'negative' ORDER BY ID DESC";
$resultNegative = $con->query($queryNegative);
$dataNegative = array();
while ($row = $resultNegative->fetch_assoc()) {
  $dataNegative[] = $row;
}

// Fetch neutral feedback
$queryNeutral = "SELECT * FROM feedback_table WHERE sentiment = 'neutral' ORDER BY ID DESC";
$resultNeutral = $con->query($queryNeutral);
$dataNeutral = array();
while ($row = $resultNeutral->fetch_assoc()) {
  $dataNeutral[] = $row;
}
echo json_encode(array(
  'data' => $dataPositive,
  'data2' => $dataNegative,
  'data3' => $dataNeutral
));
$con->close();
