<?php
session_start();
include 'connection/connection.php';


$mysqli = new mysqli('localhost', 'root', '', 'cs1-dclinic-sys');
$stmt = $mysqli->prepare("SELECT fullname FROM user_registration WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

// Bind the result to a variable
$stmt->bind_result($fullname);

// Fetch the result
if ($stmt->fetch()) {
  // Fullname is retrieved from the database
  // Store it in the session variable
  $_SESSION['fullname'] = $fullname;
}

$stmt->close();
$mysqli->close();



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

</head>

<body>
  <section class="gcash">
    <div class="card" id="gcash_card">
      <div class="container">
        <div class="row">
          <div class="col" style="padding: 5%;">
            <p class="">Scan the Qr code</p>
            <img src="./assets/image/photo_2023-07-27_11-14-09.jpg" class="img-fluid rounded-start me-5" width="600" alt="...">
          </div>
          <div class="col" style="padding: 5%;">
            <form action="" method="">
              <div class="fullname">
                <?php 
                 require 'connection/connection.php';

                     $fullname = $_SESSION['fullname'];
              
                    echo "$fullname";
              
              ?>
              </div>
              <div class="TransacNo"></div>
              <div class="Screenshot_payment"></div>
              <button type="submit" class="btn btn-primary">Pay now</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </section>




  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>