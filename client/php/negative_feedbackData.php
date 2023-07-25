<?php

require '../../connection/connection.php';


if (isset($_GET['deleteid'])) {
  $delete_id = $_GET['deleteid'];
  $delete_query = "DELETE FROM negative_feedback WHERE id = '$delete_id'";

  if ($con->query($delete_query) === TRUE) {

    header("Location: ../php/negative_feedback.php");
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
  <style>
    .centered-row {
      vertical-align: middle;
    }

    .name {
      width: 10rem;
    }

    .feedback {
      width: 47rem;
    }
  </style>
</head>

<body>

  <!-- appointment/session table -->
  <tbody>
    <!-- data -->
    <?php
    $selectquery = "SELECT * FROM negative_feedback ORDER BY ID DESC";
    $result = mysqli_query($con, $selectquery);

    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $patient_name = $row['patient_name'];
      $feedback = $row['feedback'];
      $date = $row['date'];


      echo '
              
                  <tr class="centered-row">
                    <th scope ="row">' . $id . '</td>
                    <td class = "name"> ' . $patient_name .  '</td>
                    <td class ="feedback"> ' . $feedback .  '</td>
                    <td> ' . $date . '</td>
                    <td class="status"> <a href="../php/negative_feedbackData.php? deleteid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-trash" style="color:red;"></i></button></a>
                   
                    </td>
                     
          ';
    }


    $con->close();
    ?>
  </tbody>
  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>