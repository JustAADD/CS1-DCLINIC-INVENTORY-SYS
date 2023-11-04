<?php

session_start();

require 'connection/connection.php';

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
}

$mysqli = new mysqli('localhost', 'root', '', 'cs1-dclinic-sys');
$stmt = $mysqli->prepare("SELECT fullname FROM user_registration WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

// Bind the result to a variable
$stmt->bind_result($fullname);

// Fetch the result
if ($stmt->fetch()) {

  $_SESSION['fullname'] = $fullname;
}

$stmt->close();

if (isset($_SESSION['fullname'])) {
  $fullname = $_SESSION['fullname'];
}

$stmt = $mysqli->prepare("SELECT transac_no FROM appointment_booking WHERE name = ?");
if (!$stmt) {
  die("Error in preparing statement: " . $mysqli->error);
}

$stmt->bind_param("s", $fullname);
if (!$stmt->execute()) {
  die("Error executing the statement: " . $stmt->error);
}
$stmt->bind_result($transacNo);

if ($stmt->fetch()) {
  $_SESSION['transac_no'] = $transacNo;
}
$stmt->close();


if (isset($_POST['submit'])) {

  $currentDate = date('Y-m-d');
  // $target_dir = "imagedata/";
  $target_dir = "imagedata/";

  // specify the path to the image file
  $target_file = $target_dir . basename($_FILES["image"]["name"]);

  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    // display a success message if the file was uploaded successfully
    // echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
    if (isset($_SESSION['transac_no'])) {
      $transacNo = $_SESSION['transac_no'];

      $stmt = $con->prepare("INSERT INTO gcash_transac ( name, transac_no, imagedata, date) VALUES (?, ?, ?, ?)");
      if (!$stmt) {
        echo "Failed to prepare statement: " . $con->error;
        exit();
      }

      $stmt->bind_param("ssss", $fullname, $transacNo, $target_file, $currentDate);

      if (!$stmt->execute()) {
        echo "Failed to execute statement: " . $stmt->error;
        exit();
      } else {

        // $msg = "<div class='alert alert-success'>Booking Successful</div>";

        $_SESSION['status'] = "Your Appointment Booking successfully";
        $_SESSION['status_code'] = "success";
        header("refresh:0.1;url=appointment.php");
      }

      $stmt->close();
      $con->close();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gcash Payment</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Stylesheets css -->
  <link rel="stylesheet" href="assets\css\style.css">
  <!-- SweetAlert 2 library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./assets/js/sweetalert.min.js"></script>

</head>

<body>

  <section class="gcash">

    <?php
    if (isset($_SESSION['back'])) {

      // Display the SweetAlert confirmation pop-up
      echo "<script>
            Swal.fire({
              title: 'Cancel Appointment?',
              text: 'Are you sure you want to cancel your appointment?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, cancel it!',
              cancelButtonText: 'No, go back',
            }).then((result) => {
              if (result.isConfirmed) {
               
                window.location.href = 'appointment.php';
              }
            });
          </script>";

      unset($_SESSION['back']);
    }
    ?>


    <div class="card" id="gcash_card">
      <div class="container">
        <div class="row">

          <div class="col" style="margin-top: 4%;">

            <img src="./assets/image/photo_2023-07-27_11-14-09.jpg" class="img-fluid rounded-start me-5" width="600" alt="...">
          </div>

          <div class="col" style="padding-top: 1%; margin-top: 100px;">
            <form action="" method="POST" enctype="multipart/form-data">
              <p class="fee">Placement fee: 80php</p>
              <div class="fullname">

                <?php
                if (isset($_SESSION['fullname'])) {
                  echo "Patient Name: " . $_SESSION['fullname'];
                } else {
                  echo "User's Full Name";
                }
                ?>
              </div>
              <div class="transacNo">
                <?php
                require 'connection/connection.php';

                if (isset($_SESSION['transac_no'])) {
                  echo "Transaction Number: " . $_SESSION['transac_no'];
                } else {
                  echo "Transaction Number: N/A";
                }

                ?>
              </div>
              <div class="mb-3 mt-4">
                <label for="formfile" class="form-label">Upload SS Gcash Receipt of Gcash to verify</label>
                <input type="file" name="image" class="form-control" id="image" placeholder="Upload your photos">
              </div>
              <div class="Screenshot_payment mt-5"></div>
              <button type="submit" name="submit" value="Upload Image" class="btn btn-primary" style="width: 10rem; border-radius: 20px;">Pay now</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </section>



  <!-- sweet alert -->
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>