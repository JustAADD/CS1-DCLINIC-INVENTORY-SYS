<?php
session_start();

require_once 'app-header.php';


include 'app-data.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointment Schedule</title>

  <!-- OWL-Carousel-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="assets/css/content-style.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Stylesheets css -->
  <link rel="stylesheet" href="assets\css\style.css">

  <script src="./assets/js/sweetalert.min.js"></script>
  <style>
    @media only screen and (max-width: 760px),
    (min-device-width: 802px) and (max-device-width: 1020px) {

      /* Force table to not be like tables anymore */
      table,
      thead,
      tbody,
      th,
      td,
      tr {
        display: block;

      }

      .headered {
        font-size: small;
      }


      .empty {
        display: none;
      }

      /* Hide table headers (but not display: none;, for accessibility) */
      th {
        position: absolute;
        top: -9999px;
        left: -9999px;
      }

      tr {
        border: 1px solid #ccc;
      }

      td {
        /* Behave  like a "row" */
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
        padding-left: 50%;
      }



      /*
		Label the data
		*/
      td:nth-of-type(1):before {
        content: "Sunday";
      }

      td:nth-of-type(2):before {
        content: "Monday";
      }

      td:nth-of-type(3):before {
        content: "Tuesday";
      }

      td:nth-of-type(4):before {
        content: "Wednesday";
      }

      td:nth-of-type(5):before {
        content: "Thursday";
      }

      td:nth-of-type(6):before {
        content: "Friday";
      }

      td:nth-of-type(7):before {
        content: "Saturday";
      }


    }

    /* Smartphones (portrait and landscape) ----------- */

    @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
      body {
        padding: 0;
        margin: 0;
      }
    }

    /* iPads (portrait and landscape) ----------- */

    @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
      body {
        width: 495px;
      }
    }

    @media (min-width:641px) {
      table {
        table-layout: fixed;
      }

      td {
        width: 33%;
      }
    }

    .row {
      margin-top: 20px;
    }

    .today {
      background: yellow;
    }

    .custom-swal {
      background-color: #f3f3f3;
      color: #333;
      border-radius: 8px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      font-family: 'Arial', sans-serif;
    }

  </style>

</head>

<body>

  <div class="spacing" style="padding-top: 7%;"></div>

  <!-- appointment -->
  <div class="container-fluid">
    <section class="app">
      <div class="row g-0">
        <div class="col">
          <p>Set an appointment by using this calendar: </p>
        </div>
        <?php
        if (isset($_SESSION['status'])) {
        ?>
          <script>
            swal({
              title: "<?php echo $_SESSION['status']; ?>",
              text: "",
              icon: "<?php echo $_SESSION['status_code'] ?>",
              button: "Done!",
              customClass:{
                popup: "custom-swal-popup",
                title: "custom-swal-title",
                confirmButton: "custom-swal-button",
              },
            });
          </script>
        <?php
          unset($_SESSION['status']);
        }
        ?>

        <div class="apps" id="apps" style="margin: 0 auto; display:flex; justify-content:center; align-items:center;">
          <div class="card" id="cardcalendar" style="width: 60rem; height: 40rem;  padding: 2%; border-radius: 50px; border-color:#D2E3FC; box-shadow: 0 8px 8px rgba(100, 150, 200, 0.3);">

            <!-- calendar -->
            <?php
            $dateComponents = getdate();
            if (isset($_GET['month']) && isset($_GET['year'])) {
              $month = $_GET['month'];
              $year = $_GET['year'];
            } else {
              $month = $dateComponents['mon'];
              $year = $dateComponents['year'];
            }
            echo build_calendar($month, $year);
            ?>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="spacing" style="padding-top: 10%;"></div>

  <section>
    <div class="container" id="banner-services">
      <div class="banner-services">
        <h3>Our Services & Treatments</h3>
        <h4>We would like to present our services that we offer:</h4>

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



      </div>
    </div>
  </section>

  <div class="footer">

    <div class="owner">
      <p> ® Dalino Dental Clinic</p>
    </div>

  </div>

  <!-- sweet alert -->
  <script src="./assets/js/sweetalert.min.js"></script>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
      autoplayTimeout: 4000,
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