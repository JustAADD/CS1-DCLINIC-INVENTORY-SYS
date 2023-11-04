<?php
require '../../connection/connection.php';

// Check if the "deleteid" parameter is present in the URL
if (isset($_GET['deleteid'])) {
  // Get the id to be deleted from the URL
  $delete_id = $_GET['deleteid'];

  // Create the DELETE query
  $delete_query = "DELETE FROM dental_doctors WHERE id = '$delete_id'";

  // Execute the query
  if ($con->query($delete_query) === TRUE) {


    header("Location: ../php/dental_doctors.php");
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
  </style>

</head>

<body>

  <!-- appointment/session table -->
  <tbody>
    <!-- data -->
    <?php
    $selectquery = "SELECT * FROM dental_doctors ORDER BY ID DESC";
    $result = mysqli_query($con, $selectquery);

    while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $doctors_id = $row['doctors_id'];
      $doctors_name = $row['doctors_name'];
      $email = $row['email'];
      $contact_number = $row['contact'];
      $specialties = $row['specialties'];
      echo '
              
                  <tr class="centered-row">
                    <th scope ="row">' . $id . '</td>
                    <td> ' . $doctors_id .  '</td>
                    <td> ' . $doctors_name .  '</td>
                    <td> ' . $email . '</td>
                    <td> ' . $contact_number . '</td>
                    <td> ' . $specialties . '</td>
                    
                   
                
                    <td> <a href="../php/doctors_data.php? deleteid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-trash" style="color:red;"></i></button></a>
                    <a href="../php/doctors_update.php? updateid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></button></a>
                    </td>
                     
          ';
    }


    $con->close();
    ?>
  </tbody>



  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>