<?php
if (isset($_GET['logout'])) {

  // Unset all session variables
  session_unset();

  // Destroy the session
  session_destroy();
  header("Location: main.php");
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

  <title>Dalino Dental Clinic</title>
</head>

<body>
  <header class="header">
    <a href="#" class="header__logo">Dalino Dental Clinic</a>

    <ion-icon name="menu-outline" class="header__toggle" id="nav-toggle"></ion-icon>

    <nav class="nav" id="nav-menu">
      <div class="bd-grid" id="nav__content">
        <ion-icon name="close-outline" class="nav__close" id="nav-close"></ion-icon>

        <div class="nav__perfil">
          <div class="nav__img">
            <img src="assets/image/dalino_logo.png" alt="">
          </div>

          <div>
            <a href="#" class="nav__name">Dalino Dental Clinic</a>
          </div>
        </div>

        <div class="nav__menu">
          <ul class="nav__list">
            <li class="nav__item"><a href="#" class="nav__link">Home</a></li>
            <li class="nav__item"><a href="#services" class="nav__link">Services</a></li>
            <li class="nav__item"><a href="appointment.php" class="nav__link">Appointment</a></li>
            <li class="nav__item"><a href="#about-us" class="nav__link">About us</a></li>

          </ul>
        </div>

        <div class="nav__social">
          <a href="#" class="nav__social-icon"><ion-icon name="mail-outline"></ion-icon></a>
          <a href="#" class="nav__social-icon"><ion-icon name="logo-facebook"></ion-icon></a>
          <a href="?logout" name="logout" id="logout" class="nav__social-icon"> <ion-icon name="log-out-outline"></ion-icon></a>
        </div>
      </div>

    </nav>

  </header>



  <!-- ===== IONICONS ===== -->
  <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!--===== MAIN JS =====-->
  <script src="assets/js/main.js"></script>
</body>

</html>