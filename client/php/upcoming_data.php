<?php
require '../../connection/connection.php';

// Check if the "deleteid" parameter is present in the URL
if (isset($_GET['deleteid'])) {
  // Get the id to be deleted from the URL
  $delete_id = $_GET['deleteid'];

  // Fetch the data to be deleted from the 'manage_schedule' table for the given ID
  $select_query = "SELECT * FROM appointment_booking WHERE id = '$delete_id'";
  $result = mysqli_query($con, $select_query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);

    // Extract the data from the original table row
    $id = $row['id'];
    $transac_no = $row['transac_no'];
    $status = "Approved";
    $name = $row['name'];
    $patient_name = $row['patient_name'];
    $procedures = $row['procedures'];
    $session_time = $row['session_time'];
    $session_date = $row['session_date'];
    // ... (Add other columns as needed)

    // Insert the data into the 'deleted_schedule' table
    $insert_query = "INSERT INTO booking_approved (id, transac_no, status, name, patient_name, procedures, session_time, session_date) VALUES 
    ('$id', '$transac_no', '$status', '$name', '$patient_name', '$procedures', '$session_time', '$session_date')";
    // ... (Add other columns as needed)

    $insert_result = mysqli_query($con, $insert_query);

    if ($insert_result) {
      // Data transfer to 'deleted_schedule' successful

      // Now, delete the record from the 'manage_schedule' table
      $delete_query = "DELETE FROM appointment_booking WHERE id = '$delete_id'";
      $delete_result = mysqli_query($con, $delete_query);

      if ($delete_result) {
        // Record deleted successfully
        header("Location: ../php/upcoming_appointment.php");
      } else {
        // Handle the case where deletion fails
        echo "Error deleting data: " . mysqli_error($con);
      }
    } else {
      // Handle the case where data transfer to 'deleted_schedule' fails
      echo "Error transferring data: " . mysqli_error($con);
    }
  } else {
    // Handle the case where the data retrieval fails
    echo "Error fetching data from the database: " . mysqli_error($con);
  }

  // $con->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="../css/style.css">
  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .centered-row {
      vertical-align: middle;
    }
  </style>
</head>

<body>


  <!-- appointment/session table -->

      <tbody>
        <!-- data -->
        <?php
        $selectquery = "SELECT * FROM appointment_booking ORDER BY ID DESC";
        $result = mysqli_query($con, $selectquery);

        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['id'];
          $status = $row['status'];
          $transac_no = $row['transac_no'];
          $name = $row['name'];
          $procedures = $row['procedures'];
          $session_time = $row['session_time'];
          $session_date = $row['session_date'];

          echo '
         
                  <tr class="centered-row">
                    <th scope ="row">' . $id . '</td>
                    <td style="width: 9rem;"><button type="button" class="btn btn-primary" style="background-color:#31b522; width: 8rem; border: none;" ><i class="fa-solid fa-gear fa-spin"></i> &nbsp' . $status . '</button></td>
                    <td><a href="../php/p_transaction.php">' . $transac_no .  '</a> <br>
                    ' . $name .  '</td>
                    <td> ' . $procedures . '</td>
                    <td> ' . $session_time . '</td>
                    <td> ' . $session_date . '</td>
                  
                    <td><a href="../php/upcoming_data.php? deleteid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-thumbs-up"></i></button></a> 
                    <a href="../php/completed_booking.php? deleteid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-square-check"></i></i></button></a>
                    <a href="../php/rejected_booking.php? deleteid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-thumbs-down"></i></i></button></a>  
                    </td>
                   
               
          ';
        }

        $con->close();
        ?>
      </tbody>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>