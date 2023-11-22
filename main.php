<?php
session_start();
require 'connection/connection.php';


if (isset($_SESSION['email'])) {
  header("Location: home.php");
  exit();
} elseif (isset($_SESSION['isAdmin'])) {
  header("Location: client/php/dashboard.php");
  exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dalino Dental Clinic</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Stylesheets css -->
  <link rel="stylesheet" href="assets\css\style.css">

  <!-- OWL-Carousel-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body class="body-main">

  <div class="container-fluid" id="main">

    <div class="card" id="form-card">
      <div class="row g-0" id="form-row">
        <div class="col-md-6" id="form-col1">
          <div class="col1img">
            <img src="./assets/image/dalino_logo.png"><span class="dalino">&nbsp;Dalino Dental Clinic</span>
          </div>
          <p class="discover-power mt-4">Discover the power <br>
            of healthy,
            <br>beautiful smile with us!
          </p>

          <img src="./assets/image/dalino_logo.png">
        </div>
        <div class="col" id="form-col2">
          <form action="main-lcode.php" method="POST">
            <p class="form-business-name"><span>DALINO</span>&nbsp;DENTAL CLINIC</p>
            <p class="form-title">Login</p>
            <?php
            if (isset($_SESSION['status'])) {
            ?>
              <div class="alert alert-success" style="height: 2rem; padding: 5%; display: flex; align-items: center; justify-content:center;">
                <p class="verify" style="font-size:12px; margin: 0 auto; padding: 0;"><?= $_SESSION['status']; ?></p>
              </div>
            <?php
              unset($_SESSION['status']);
            }
            ?>
            <?php if (isset($_GET['error'])) { ?>
              <div class="alert alert-danger" style="margin: 0 auto; padding: 2%; display: flex; justify-content: center; align-items: center;" role="alert">
                <?= htmlspecialchars($_GET['error']) ?>
              </div>
            <?php } ?>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Your email address" aria-describedby="emailHelp" autocomplete="off">
            </div>
            <div class="mb-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" autocomplete="off">

            </div>
            <button type="submit" id="form-btn" name="submit" value="Login" class="btn btn-primary">Log in</button>

            <p class="dh-acc mt-4"> Don't have an account? <span class="dh-accs"><a href="main-regis.php">Sign Up.</a></span> </p>

          </form>
        </div>
      </div>

    </div>

    <svg id="background-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
      <path fill="#a5c0e8" fill-opacity="1" d="M0,96L48,133.3C96,171,192,245,288,256C384,267,480,213,576,192C672,171,768,181,864,186.7C960,192,1056,192,1152,170.7C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>

  </div>




  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


  <!--owl-carousel-->
  <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 0,
      nav: false,
      dots: false,
      autoplay: true,
      autoplayTimeout: 2000,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
    })
  </script>


</body>

</html>