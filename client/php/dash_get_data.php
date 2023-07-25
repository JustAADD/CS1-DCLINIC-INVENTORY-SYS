<?php
require '../../connection/connection.php';

// Execute the query to get the total number of rows in the "appointment_booking" table
$selectQuery = "SELECT COUNT(*) AS total_rows FROM appointment_booking";
$result = $conn->query($selectQuery);

if ($result) {
  $row = $result->fetch_assoc();
  $totalRows = $row['total_rows'];

  // Create an array with the total
  $data = array('total_rows' => $totalRows);

  // Return the data as JSON
  header('Content-Type: application/json');
  echo json_encode($data);
} else {
  // Handle the error if the query fails
  echo json_encode(array('error' => 'Failed to fetch data.'));
}

// Close the database connection
$conn->close();
