<?php

session_start();
require_once 'header.php';

if (!isset($_SESSION['email'])){

  header ("Location: main.php");
  
}

?>

<!DOCTYPE html>
<html lang="en">

<!-- ===== FIRST CONTENT ===== -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ===== css ===== -->
  <link rel="stylesheet" href="assets/css/content-style.css">

  <!-- OWL-Carousel-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

  <!-- first column and row -->

  <!-- <section id="hero" class="hero">
    <div class="container-fluid position-relative">
      <div class="row gy-5">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2>We Care About <br> Your <span>Smile</span></h2>
          <p>We will take care of your dental health. <br>
            Choose your desired time below and <br>
            we'll help out. <br>
          </p>
          <div class="d-flex justify-content-center justify-content-lg-start mt-4">
            <a href="#about" class="btn-get-started me-3">Get in Touch</a>
            <a href="#about" class="btn-get-appointment">Make an Appointment</a>
          </div>
        </div>  -->

  <!-- ===== second col ===== -->
  <!-- <div class="col-lg-6 order-1 order-lg-1" id="coltwo">
          <img src="">
        </div>
      </div>
  </section>  -->


  <!-- second column and row -->

  <section class="cons" id="cons">
    <div class="row m-0">
      <div class="col-sm-6" id="columnOne">
        <h2>We Care About <br> Your <span>Smile</span></h2>
        <p>We will take care of your dental health. <br>
          Choose your desired time below and <br>
          we'll help out. <br>
        </p>
        <div class="d-flex justify-content-center justify-content-lg-start mt-4" id="boton">
          <a href="#about" class="btn-get-started me-3">Get in Touch</a>
          <a href="#about" class="btn-get-appointment">Make an Appointment</a>
        </div>

        <!-- <?php
        if (isset($_SESSION['user'])) {
        ?>
          <div class="alert alert-success" style="height: 2rem; padding: 5%; display: flex; align-items: center; justify-content:center;">
            <p class="verify" style="font-size:12px; margin: 0 auto; padding: 0;"><?= $_SESSION['user']; ?></p>
          </div>
        <?php
          unset($_SESSION['user']);
        }

        ?> -->

        <!-- Your Appointment Schedule -->

        <div class="App-sched mt-5">
          <div class="card" id="card-one" style="width: 25rem;">
            <div class="card-body" id="card-one-body">
              <h5>Your Appointment Schedule:</h5>
            </div>
          </div>

        </div>
      </div>
      <div class="col-sm-6 p-0">
        <div class="rectangle">
          <div class="columntwo">
            <p> Our dental health services prioritize your oral well-being. <br>
              Trust your oral well-being. Trust our Experienced services to <br>
              Guide you on your journey to optimal dental health.
            </p>

            <div class="model">
              <img src="assets/image/model.svg" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  <!-- ===== SECOND CONTENT ===== -->

  <div id="services"></div>
  <br>
  <br>
  <br>
  <section class="content-two mt-5">
    <p class="services-title">OUR SERVICES</p>
    <div class="row g-0">
      <div class="col-sm-6 col-md-8">
        <h2 class="services-title">We specialize in you,<br>
          Whatever your specialty</h2>
      </div>
      <div class="col-6 col-md-4" style="display: flex; justify-content: center; align-items: center;">
        <a href="#about" class="btn-get-started me-3">MORE ABOUT</a>
      </div>
    </div>

    <!-- ===== CAROUSEL ===== -->
    <div class="container-fluid mb-5 mt-4" id="slider">
      <div class="owl-carousel owl-theme">
        <div class="item" id="item-one">
          <div class="card" id="owl-card">
            <p>
              Dental Examine

            <h5>Routine dental exam are essential to maintain good oral <br>
              health. They include a thorough examination of the teeth, <br>
              gums, and mount to check for any signs of tooth decay, <br>
              gum disease, or other oral health problems.</h5>
            </p>

            <div class="card" id="owl-card-body">
              <img src="assets\image\sample1.jpg" alt="">
              <!-- php img -->
            </div>
          </div>
        </div>

        <div class="item" id="item-one">
          <div class="card" id="owl-card-two">
            <p>
              Teeth Cleaning

            <h5>Teeth cleaning is a preventative dental treatment that <br>
              removes plaque and tartar from the teeth and gum line. <br>
              Regular teeth cleaning can help prevent cavities, gum <br>
              disease, and other dental problems.</h5>
            </p>

            <div class="card" id="owl-card-body">
              <img src="assets\image\sample2.jpg" alt="">
              <!-- php img -->
            </div>
          </div>
        </div>

      </div>
    </div>


  </section>

  <!-- ===== THIRD CONTENT ===== -->

  <section class="feedback">
    <div class="container-fluid">
      <div class="row g-0 mb-4">
        <div class="col-md-8" style="padding-top: 0.5rem">
          <h3 class="feedback-title"> Let's see our patients Feedback! </h3>
        </div>
        <div class="col-6 col-md-4">
          <a href="#feedback" class="btn-get-feedback me-3">Send Feedback!</a>
        </div>
      </div>
      <div class="card-container" id="feedback-card">
        <!-- carousel -->

      </div>
    </div>
  </section>

  <!-- ===== ABOUT US ===== -->

  <section class="about-us" id="about-us">
    <div class="row" id="about-row">
      <div class="col">
        <p class="about">ABOUT US</p>
        <p class="about-dalino">Mercedita Batoc-Dalino Dental Clinic was established in the year 2006, <br>
          it was first located at P. Burgos Street San Jose Pasig City and later on <br>
          moved to Malinao Pasig in front of Ado’s Panciteria in the year 2019. <br>
          For the past years it was serving the people quality dental services <br>
          worthy of its cost. <br>
          <br>
          The clinic is owned by Dr. Mercedita Batoc-Dalino, who graduated<br>
          Doctor of Dental Medicine in Centro Escolar University-Manila.
        </p>


        <div class="icon-about">
          <div class="row gy-4">
            <div class="social-links d-flex mt-4">
              <a href=""><ion-icon name="call-outline"></ion-icon></a>
              <a href=""><ion-icon name="logo-facebook"></ion-icon></a>
              <a href=""><ion-icon name="mail-outline"></ion-icon></a>
            </div>
          </div>
        </div>


      </div>
      <div class="col">

        <p class="contact-info">
          CONTACT US
        </p>
        <div class="container-column">
          <div class="column-small small">
            <ul class="social-link">
              <li>
                <a href=""><ion-icon name="call-outline"></ion-icon></a>
              </li>
              <li>
                <a href=""><ion-icon name="logo-facebook"></ion-icon></a>
              </li>
              <li>
                <a href=""><ion-icon name="mail-outline"></ion-icon></a>
              </li>
            </ul>

          </div>
          <div class="column-mid">
            <p class="mid-number">+63 956 073 4201</p>

            <p class="mid-fb">Menchi Batoc-Dalino</p>

            <p class="mid-gmail">dra.menchie@yahoo.com</p>
          </div>


        </div>

      </div>

    </div>
    <div class="end-footer">
      <p class="mid-owner">© Copyright Dalino Dental Clinic. All Rights Reserved</p>
    </div>
    </div>

  </section>







  <!--owl-carousel-->
  <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: false,
      dots: true,
      autoplay: true,
      autoplayTimeout: 2000,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 2
        },
        1000: {
          items: 2
        }
      }
    })
  </script>


</body>

</html>