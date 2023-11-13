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
$result = $con->query("SELECT * FROM positive_feedback ORDER BY ID DESC");
$data = array();
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

$query2 = "SELECT * FROM negative_feedback ORDER BY ID DESC";
$result2 = $con->query($query2);
$data2 = array();
while ($row = $result2->fetch_assoc()) {
  $data2[] = $row;
}

$query3 = "SELECT * FROM neutral_feedback ORDER BY ID DESC";
$result3 = $con->query($query3);
$data3 = array();
while ($row = $result3->fetch_assoc()) {
  $data3[] = $row;
}

echo json_encode(array(
  'data' => $data,
  'data2' => $data2,
  'data3' => $data3
));
$con->close();
