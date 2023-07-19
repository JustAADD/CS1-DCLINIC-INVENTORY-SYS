<?php
require '../../connection/connection.php';

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
</head>

<body>

  <!-- appointment/session table -->


  <div class="body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Session ID</th>
          <th scope="col">Patient Name</th>
          <th scope="col">Procedures</th>
          <th scope="col">Session Time</th>
          <th scope="col">Session Date</th>
          <th scope="col">Contact Number</th>
          <th scope="col">Suggestions</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <!-- data -->
      <?php
      $selectquery = "SELECT * FROM appointment_booking ORDER BY ID DESC";
      $result = mysqli_query($con, $selectquery);

      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $patient_id = $row['patient_id'];
        $name = $row['name'];
        $procedures = $row['procedures'];
        $email = $row['email'];
        $pnumber = $row['pnumber'];
        $message = $row['message'];
        $session_time = $row['session_time'];
        $session_date = $row['session_date'];

        echo '
                <tbody>
                  <tr class="centered-row">
                    <th scope ="row">' . $patient_id . '</td>
                    <td> ' . $name .  '</td>
                    <td><button type="button" class="btn btn-primary" style="background-color:#3F85F9; width: 10rem; border: none;" >' . $procedures . '</button></td>
                    <td> ' . $session_time . '</td>
                    <td> ' . $session_date . '</td>
                    <td> ' . $pnumber . '</td>
                    <td> ' . $message . '</td>
                
                    <td> <a href="../admin/admin-orders.php? deleteid=' . $id . '"><i class="fa-solid fa-trash" style="color:red;"></i></a> &nbsp;
                    <a href="../admin/admin-view-orders.php? updateid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
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
  </script>

</body>

</html>