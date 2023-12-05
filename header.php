<?php

require 'connection/connection.php';

$mysqli = new mysqli('localhost', 'root', '', 'cs1-dclinic-sys');
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}
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

if (isset($_GET['logout'])) {

  $fullname = $_SESSION['fullname'];
  $status = "logout";
  $date = date("Y-m-d");
  $time = date("H:i:s");

  $sql = "INSERT INTO user_logs (name, status, time, date)
  VALUES ('$fullname','$status', '$time', '$date')";

  if ($con->query($sql) === TRUE) {

    // Set session variables for a confirmation message
    $_SESSION['back'] = "Are you sure you want to logout?";

    // Redirect to 'main.php'
    header("Location: main.php");
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }

  session_unset();

  session_destroy();
  // header("Location: main.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- ===== CSS ===== -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- SweetAlert 2 library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./assets/js/sweetalert.min.js"></script>

  <title>Dalino Dental Clinic</title>
</head>

<body>
  <header class="header">
    <a href="#" class="header__logo">Dalino Dental Clinic</a>

    <ion-icon name="menu-outline" class="header__toggle md hydrated" id="nav-toggle" role="img"></ion-icon>

    <nav class="nav" id="nav-menu">
      <div class="bd-grid" id="nav__content">
        <ion-icon name="close-outline" class="nav__close md hydrated" id="nav-close" role="img"></ion-icon>

        <div class="nav__perfil">
          <div class="nav__img">
            <img src="assets/image/dalino_logo.png" alt="">
          </div>

          <div>
            <a href="home.php" class="nav__name">Dalino Dental Clinic</a>
          </div>
        </div>

        <div class="nav__menu">
          <ul class="nav__list">
            <li class="nav__item"><a href="home.php" class="nav__link">Home</a></li>
            <li class="nav__item"><a href="#services" class="nav__link">Services</a></li>
            <li class="nav__item"><a href="appointment.php" class="nav__link">Appointment</a></li>
            <li class="nav__item"><a href="#about-us" class="nav__link">About us</a></li>
          </ul>
        </div>

        <div class="nav__social">
          <a href="mailto:dra.menchie@yahoo.com" class="nav__social-icon" title="Contact Dr. Menchie">
            <ion-icon name="mail-outline" role="img" class="md hydrated"></ion-icon></a>
          <a href="https://www.facebook.com/menchie.dalino" class="nav__social-icon" title="Contact Dr. Menchie"><ion-icon name="logo-facebook" role="img" class="md hydrated"></ion-icon></a>
          <a href="?logout" name="logout" id="logout" title="logout" class="nav__social-icon">
            <ion-icon name="log-out-outline" role="img" class="md hydrated"></ion-icon>
          </a>
        </div>
      </div>

    </nav>

  </header>

  <!-- sweet alert -->
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- ===== IONICONS ===== -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <!--===== MAIN JS =====-->
  <script src="assets/js/main.js"></script>
</body>

</html>