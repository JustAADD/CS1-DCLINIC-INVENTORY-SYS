<?php
// Connect to the database (replace with your credentials)
//main connection file for both admin & front end
$hostname = "localhost"; //server
$username = "root"; //username
$password = ""; //password
$dbname = "cs1-dclinic-sys";  //databases

// Create connection
$con = mysqli_connect($hostname, $username, $password, $dbname); // connecting 
// Check connection

if (!$con) {

  die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the database
$result = $con->query("SELECT * FROM patient_transaction ORDER BY ID DESC");

$data = array();
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

echo json_encode($data);
$con->close();
