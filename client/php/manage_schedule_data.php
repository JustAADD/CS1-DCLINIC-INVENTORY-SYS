<?php
require '../../connection/connection.php';

// Check if the "deleteid" parameter is present in the URL
if (isset($_GET['deleteid'])) {
  // Get the id to be deleted from the URL
  $delete_id = $_GET['deleteid'];

  // Create the DELETE query
  $delete_query = "DELETE FROM manage_schedule WHERE id = '$delete_id'";

  // Execute the query
  if ($con->query($delete_query) === TRUE) {


    header("Location: ../php/manage_schedule.php");
  } else {

    // echo "Error: " . $conn->error;
  }

  $con->close();
}

?>


<head>

  <link rel="stylesheet" href="../css/style.css">

  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

  <!-- appointment/session table -->

  <div class="body-table">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Slots</th>
          <th scope="col">Date</th>
          <th scope="col">Start Time</th>
          <th scope="col">End Time</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>

        </tr>
      </thead>

      <!-- data -->
      <?php
      require '../../connection/connection.php';

      $selectquery = "SELECT * FROM manage_schedule ORDER BY ID DESC";
      $result = mysqli_query($con, $selectquery);

      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $slots = $row['slots'];
        $date = $row['date'];
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $status = $row['status'];
       


        echo '
                <tbody>
                  <tr class="centered-row">
                    <th scope ="row">' . $id . '</td>
                    <td> ' . $slots .  '</td>
                    <td> ' . $date . '</td>
                    <td> ' . $start_time . '</td>
                    <td> ' . $end_time . '</td>
                    <td> ' . $status . '</td>
                   
                   
                
                    <td> <a href="../php/manage_schedule_data.php? deleteid=' . $id . '"><i class="fa-solid fa-trash" style="color:red;"></i></a> &nbsp;
                    <a href="../php/manage_schedule_update.php? updateid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
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