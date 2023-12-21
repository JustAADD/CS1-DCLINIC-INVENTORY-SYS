<?php
session_start();


if (isset($_SESSION['email'])) {
  // User is already signed in, continue with the rest of your home.php code
  $email = $_SESSION['email'];
} else {
  // User is not signed in, redirect to main.php
  header("Location: main.php");
  exit();
}

if (!isset($_SESSION['email'])) {
  header("Location: index.php");
  exit();
}

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

<?php
if (isset($_SESSION['back'])) {
  // Debugging: Check if $_SESSION['back'] is set correctly
  var_dump($_SESSION['back']);

  echo "<script>
          console.log('Script executed'); // Debugging: Check if script is executed
          Swal.fire({
            title: 'Logout?',
            text: 'Are you sure you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No, go back',
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'main.php';
            } else {
              // Handle cancellation if needed
            }
          });
        </script>";

  unset($_SESSION['back']);
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- ===== FIRST CONTENT ===== -->

<head>
  <meta charset="UTF-8">
  <link rel="shorcut icon" href="./assets/image/dalino_logo.png">
  <!-- ===== css ===== -->
  <link rel="stylesheet" href="./assets/css/content-style.css">
  <!-- OWL-Carousel-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Animation-->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- SweetAlert 2 library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./assets/js/sweetalert.min.js"></script>

  <!--loader-->
  <script src="./assets/js/loader.js"></script>
  <?php
  include 'header.php';

  ?>
  <style>
    div.scroll {
      width: 21.5rem;
      height: 3rem;
      overflow-x: hidden;
      overflow-y: auto;
      text-align: center;
      padding: 5px;
    }
  </style>

</head>

<body>

  <div class="loader-wrapper">
    <div class="loader"></div>
  </div>

  <!-- second column and row -->

  <section class="cons" id=cons">
    <div class="row m-0">
      <div class="col-sm-6" id="columnOne" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">
        <h2>We Care About <br> Your <span>Smile</span></h2>
        <p>We will take care of your dental health. <br>
          Choose your desired time below and <br>
          we'll help out. <br>
        </p>
        <div class="d-flex justify-content-center justify-content-lg-start mt-4" id="boton">
          <a href="#feedback" class="btn-get-started me-3">Patient Feedback</a>
          <a href="appointment.php" class="btn-get-appointment">Make an Appointment</a>
        </div>

        <!-- Your Appointment Schedule -->
        <!-- <h4> Welcome, <?php echo $fullname ?></h4> -->
        <div class="App-sched mt-5">
          <div class="card" id="card-one">
            <div class="card-body" id="card-one-body">
              <h5>Your Appointment Schedule:</h5>
              <div class="scroll" id="scroll">
                <?php
                require 'connection/connection.php';

                $fullname = $_SESSION['fullname'];

                $selectQuery = "SELECT session_time, date, status FROM booking_approved WHERE name = '$fullname'";
                $result = mysqli_query($con, $selectQuery);


                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $session_time = $row['session_time'];
                    $session_date = $row['date'];
                    $approval_status = $row['status'];

                    echo "<div class='show' style='text-align:center; margin-top: 20px;'>";

                    if ($approval_status == 'Approved') {
                      echo "Approved: $session_time - $session_date";
                    } else {
                      echo "Please wait for the approval";
                    }

                    echo "</div>";
                  }
                } else {
                  echo "<div class='show' style='text-align:center; margin-top: 20px;'>
                    Please wait for the approval
                  </div>";
                }

                mysqli_close($con);
                ?>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="col-sm-6 p-0">
        <div class="rectangle" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">
          <div class="columntwo">
            <p> Our dental health services prioritize your oral well-being.
              Trust your oral well-being. Trust our Experienced services to
              Guide you on your journey to optimal dental health.
            </p>

            <div class="model">
              <img src="assets/image/model1.png" alt="img" role="img">
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
    <p class="services-title" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">OUR SERVICES</p>
    <div class="row g-0">
      <div class="col-sm-6 col-md-8" id="specialize">
        <h3 class="services-description" data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine">We specialize in you,<br>
          Whatever your specialty</h3>
      </div>
      <div class="col-6 col-md-4" id="more-about" style="display: flex; justify-content: center; align-items: center;">
        <a href="more-about.php" class="btn-get-started me-3" id="more-about" data-aos="fade-left" data-aos-offset="300" data-aos-easing="ease-in-sine">MORE ABOUT</a>
      </div>
    </div>

    <!-- ===== CAROUSEL ===== -->
    <div data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine">
      <div class="container-fluid mb-5 mt-4" id="slider">
        <div class="owl-carousel owl-theme">
          <div class="item" id="item-one">
            <div class="card" id="owl-card">
              <p>
                Consultation

              <h5>At our dental clinic, we pride ourselves on providing
                exceptional dental consultation services to all our patients.
                Our dedicated team of experienced dentists is committed to offering
                personalized care.</h5>
              </p>

              <div class="card" id="owl-card-body">
                <img src="assets/image/wokrplace1.jpg" alt="">
                <!-- php img -->
              </div>
            </div>
          </div>

          <div class="item" id="item-one">
            <div class="card" id="owl-card-two">
              <p>
                Teeth Cleaning

              <h5>Our teeth cleaning service is designed to give you
                a bright and healthy smile that you can be proud of.
                We understand the importance of maintaining excellent
                oral hygiene.</h5>
              </p>

              <div class="card" id="owl-card-body">
                <img src="assets/image/whitening and cleaning.jpg" alt="">
                <!-- php img -->
              </div>
            </div>
          </div>

          <div class="item" id="item-one">
            <div class="card" id="owl-card">
              <p>
                Oral Prophylaxis

              <h5>At our dental clinic, we provide professional oral Prophylaxis
                serviecs to help you maintain a healthy and radiant smile,
                During your oral prophylaxis appointment, our skilled hygienists will
                carefully examine your teeth and gums to assess their overall health.
              </h5>
              </p>

              <div class="card" id="owl-card-body">
                <img src="assets/image/oral prophylaxis.jpg" alt="">
                <!-- php img -->
              </div>
            </div>
          </div>
          <div class="item" id="item-one">
            <div class="card" id="owl-card-two">
              <p>
                Braces

              <h5>At our dental clinic, we offer comprehensive braces services
                to help you achieve a straighter and more aligned smile.
              </h5>
              </p>

              <div class="card" id="owl-card-body">
                <img src="assets/image/braces.jpg" alt="">
                <!-- php img -->
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>

  <!-- ===== THIRD CONTENT ===== -->
  <div id="feedback"></div>
  <section class="feedback mt-5" data-aos="fade-down" data-aos-offset="300" data-aos-easing="ease-in-sine">
    <div class="container-fluid">
      <div class="row g-0 mb-4">
        <div class="col-md-8" style="padding-top: 0.5rem">
          <h3 class="feedback-title"> Let's see our patients Feedback! </h3>
        </div>
        <div class="col-6 col-md-4" id="get">
          <a href="feedbacks.php" class="btn-get-feedback me-3" id="get-feed">Send Feedback!</a>
        </div>
      </div>
      <div class="card-container" id="feedback-card">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner" id="inner" style="background-color: transparent;">
            <?php
            // Display feedback in carousel items
            $servername = "localhost";
            $username = "u530383017_root";
            $password = "Ik@wl@ngb0w4";
            $dbname = "u530383017_localhost";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            // Fetch feedback from the database
            $sql = "SELECT patient_name, comment FROM feedback_table WHERE sentiment = 'positive'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              $active = true;
              while ($row = $result->fetch_assoc()) {
                echo '<div class="carousel-item' . ($active ? ' active' : '') . '" id="feedback_table" style="margin-top: -3rem;" data-bs-interval="10000">';
                echo '<p><strong>' . $row['patient_name'] . ':</strong> ' . $row['comment'] . '</p>';
                echo '</div>';
                $active = false;
              }
            } else {
              echo '<div class="carousel-item active" data-bs-interval="10000">';
              echo '<p>No positive feedback available.</p>';
              echo '</div>';
            }

            // Close database connection
            $conn->close();


            ?>

            <!-- <div class="carousel-item" data-bs-interval="10000">

            </div>
            <div class="carousel-item " data-bs-interval="20000">

            </div> -->
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

      </div>
    </div>

  </section>

  <!-- ===== ABOUT US ===== -->
  <div data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine">
    <section class="about-us" id="about-us">
      <div class="row" id="about-row">
        <div class="col me-5" id="col-about">
          <p class="about">ABOUT US</p>
          <div class="about-dalino">
            <p class="about-dalino">Mercedita Batoc-Dalino Dental Clinic was established in the year 2006,
              it was first located at P. Burgos Street San Jose Pasig City and later on
              moved to Malinao Pasig in front of Ado’s Panciteria in the year 2019.
              For the past years it was serving the people quality dental services
              worthy of its cost.
              <br>
              <br>
              The clinic is owned by Dr. Mercedita Batoc-Dalino, who graduated
              Doctor of Dental Medicine in Centro Escolar University-Manila.
            </p>
            <div class="about-dalino">


              <div class="icon-about">
                <div class="row gy-4">
                  <div class="social-links d-flex mt-4">
                    <a href="mailto:dra.menchie@yahoo.com" class="nav__social-icon" title="Contact Dr. Menchie">
                      <ion-icon name="mail-outline" role="img" class="md hydrated"></ion-icon></a>
                    <a href="https://www.facebook.com/menchie.dalino" class="nav__social-icon" title="Contact Dr. Menchie"><ion-icon name="logo-facebook" role="img" class="md hydrated"></ion-icon></a>
                    <a href="mailto:dra.menchie@yahoo.com" class="nav__social-icon" title="Contact Dr. Menchie">
                      <ion-icon name="mail-outline" role="img" class="md hydrated"></ion-icon></a>
                  </div>
                </div>
              </div>


            </div>

            <!-- <div class="col" style="margin-left: 150px;"> -->

            <p class="contact-info mt-5">
              CONTACT US
            </p>
            <div class="container-column">
              <div class="column-small small">
                <ul class="social-link">
                  <li>
                    <a href="mailto:dra.menchie@yahoo.com" class="nav__social-icon" title="Contact Dr. Menchie">
                      <ion-icon name="mail-outline" role="img" class="md hydrated"></ion-icon></a>
                  </li>
                  <li>
                    <a href="https://www.facebook.com/menchie.dalino" class="nav__social-icon" title="Contact Dr. Menchie"><ion-icon name="logo-facebook" role="img" class="md hydrated"></ion-icon></a>
                  </li>
                  <li>
                    <a href="mailto:dra.menchie@yahoo.com" class="nav__social-icon" title="Contact Dr. Menchie">
                      <ion-icon name="mail-outline" role="img" class="md hydrated"></ion-icon></a>
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
        <div class="col" id="mapa">
          <h5 class="mb-2" id="mapa">Location Map</h5>

          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30892.319871854666!2d121.03025168562912!3d14.56827894849337!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c983ae9bab9b%3A0xbb06d55d519d0b63!2sDr%20Menchie%20Dalino%20Dental%20Clinic!5e0!3m2!1sen!2sph!4v1701836307486!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="end-footer" style="padding-top: 6rem; margin-bottom: -4rem;">
          <p class="mid-owner">© Copyright Dalino Dental Clinic. All Rights Reserved</p>
        </div>
    </section>
  </div>

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



  <!-- sweet alert -->
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Animation-->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
</body>

</html>