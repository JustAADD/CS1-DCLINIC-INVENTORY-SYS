<?php
require '../../connection/connection.php';

// DELETE QUERY OF PATIENT LIST
if (isset($_GET['deleteid'])) {

  $delete_id = $_GET['deleteid'];
  $delete_query = "DELETE FROM patient_transaction WHERE id = '$delete_id'";

  if ($con->query($delete_query) === TRUE) {


    header("Location: ../php/p_transaction.php");
  } else {

    // echo "Error: " . $conn->error;
  }

  $con->close();
}

?>

<head>

  <link rel="stylesheet" href="../css/style.css">

  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>

  <!-- appointment/session table -->

  <div class="body-table">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Patient ID</th>
          <th scope="col">Patient Name</th>
          <th scope="col">Session</th>
          <th scope="col">Dental Doctor</th>
          <th scope="col">Date & Time</th>
          <th scope="col">Status</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <!-- data -->
      <!-- FETCHING DATA FROM DATABASE -->
      <?php

      require '../../connection/connection.php';

      $selectquery = "SELECT * FROM patient_transaction ORDER BY ID DESC";
      $result = mysqli_query($con, $selectquery);

      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $patient_id = $row['patient_id'];
        $patient_name = $row['patient_name'];
        $session = $row['session'];
        $dentist = $row['dentist'];
        $dateTime = $row['datetime'];
        $status = $row['status'];
        
        $date_time_obj = new DateTime($dateTime);
        // Format the time in "10:23 AM/PM" format
        $formatted_time = $date_time_obj->format('h:i A');

        echo '
          <tbody>
            <tr class="centered-row">
              <th scope ="row">' . $patient_id . '</td>
              <td> ' . $patient_name .  '</td>
              <td> ' . $session . '</td>
              <td> ' . $dentist . '</td>
              <td> ' . $formatted_time . '</td>
              <td><button type="button" class="btn btn-primary" style="background-color:#31b522; width: 10rem; border: none;" >' . $status . '</button></td>
          
              <td> <a href="../php/p_transaction_data.php? deleteid=' . $id . '"><i class="fa-solid fa-trash" style="color:red;"></i></a> &nbsp;
              <a href="../php/patient_update.php? updateid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
              </td>
          </tbody>       
    ';
      }


      $con->close();
      ?>
    </table>
  </div>


  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>