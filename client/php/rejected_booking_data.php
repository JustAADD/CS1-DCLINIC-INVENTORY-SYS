<?php
require '../../connection/connection.php';


if (isset($_GET['deleteid'])) {

  $delete_id = $_GET['deleteid'];
  $delete_query = "DELETE FROM booking_rejected WHERE id = '$delete_id'";

  if ($con->query($delete_query) === TRUE) {


    header("Location: ../php/rejected_booking.php");
  } else {
  }

  $con->close();
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


  <div class="body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Status</th>
          <th scope="col">Transaction no</th>
          <th scope="col">Services</th>
          <th scope="col">Session Time</th>
          <th scope="col">Session Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>

      <!-- data -->
      <?php
      $selectquery = "SELECT * FROM booking_rejected ORDER BY ID DESC";
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
          <tbody>
                  <tr class="centered-row">
                    <th scope ="row">' . $id . '</td>
                    <td style="width: 9rem;"><button type="button" class="btn btn-primary" style="background-color:#31b522; width: 8rem; border: none;" >' . $status . '</button></td>
                    <td><a href="../php/p_transaction.php">' . $transac_no .  '</a> <br>
                    ' . $name .  '</td>
                    <td> ' . $procedures . '</td>
                    <td> ' . $session_time . '</td>
                    <td> ' . $session_date . '</td>
                    <td><a href="../php/rejected_booking_data.php? deleteid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-trash"></i></button></a> 
                    </td>
                    </tbody>
               
          ';
      }

      $con->close();
      ?>

    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>