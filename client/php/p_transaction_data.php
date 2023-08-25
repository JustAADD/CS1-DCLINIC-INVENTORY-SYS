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

  <style>
    .centered-row {
      vertical-align: middle;
    }
  </style>
</head>

<body>
  <tbody>
    <?php

    require '../../connection/connection.php';

    $selectquery = "SELECT * FROM patient_transaction ORDER BY ID DESC";
    $result = mysqli_query($con, $selectquery);

    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $transac_no = $row['transac_no'];
      $status = $row['status'];
      $patient_name = $row['patient_name'];
      $procedures = $row['procedures'];

      $session_time = $row['session_time'];
      $dateTime = $row['session_date'];

     
      // Format the time in "10:23 AM/PM" format
    

      echo '
          <tbody>
            <tr class="centered-row">
              <th scope ="row">' . $id . '</td>
              <td> <a href="">' . $transac_no .  '</a><br>
              ' . $patient_name .  '</td>
              <td> ' . $status . '</td>
              <td> ' . $procedures . '</td>
              <td> ' . $dateTime . '</td>
             
          
              <td> <a href="../php/p_transaction_data.php? deleteid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-trash" style="color:red;"></i></button></a>
              <a href="../php/p_transaction_receipt.php? receiptid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-receipt"></i></button></a> 
              </td>
             
    ';
    }


    $con->close();
    ?>
  </tbody>


  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>