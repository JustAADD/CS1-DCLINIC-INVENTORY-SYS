<?php
// Connect to the database (replace with your credentials)
//main connection file for both admin & front end
$hostname = ""; //server
$username = "u530383017_root"; //username
$password = "Ik@wl@ngb0w4"; //password
$dbname = "u530383017_localhost";  //databases  //databases

// Create connection
$con = mysqli_connect($hostname, $username, $password, $dbname); // connecting 
// Check connection

if (!$con) {

  die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the database
$result = $con->query("SELECT * FROM patient_list ORDER BY ID DESC");

$data = array();
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

echo json_encode($data);
$con->close();
