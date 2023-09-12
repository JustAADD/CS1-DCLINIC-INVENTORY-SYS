<?php

session_start();

require 'connection/connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor\autoload.php';


function sendemail_verify($fullname, $email, $verify_token)
{
  $mail = new PHPMailer(true);
  //$mail->SMTPDebug = SMTP::DEBUG_SERVER;  

  // $mail->SMTPDebug = 2;
  //Enable verbose debug output
  $mail->isSMTP();                                            //Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = 'dalinomercedita@gmail.com';                     //SMTP username
  $mail->Password   = 'mpjemerynfldunrr';                             //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
  $mail->Port       = 465;

  $mail->setFrom('dalinomercedita@gmail.com', $fullname);
  $mail->addAddress($email);

  $mail->isHTML(true);                                  //Set email format to HTML
  $mail->Subject = 'Email verification from Dalino Dental Clinic';


  // $email_template = file_get_contents('email_template.php');

  $email_template = "
  <h3>You have registered with Dalino Dental Clinic as a user</h3>
  <h5>Verify your email address to login with thhe below given link</h5>
  <br/><br/>
  <a href='http://localhost/cs1-dclinic-inventory-sys/main-everification.php?token=$verify_token'> Click me </a>
  ";

  $mail->Body = $email_template;
  $mail->send();
  // echo 'Message has been sent';
}

if (isset($_POST['submit'])) {

  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $verify_token = md5(rand());


  $check_query = mysqli_query($con, "SELECT * FROM user_registration WHERE email = '$email'");

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($fullname) || empty($email) || empty($password)) {
      $error = "All fields are required";
      $password_day = "Please enter password";
      $fullname_day = "Please enter fullname";
      $email_day = "Please enter email";
    } elseif (strlen($_POST['password']) < 6) {
      $password_day = "Password must be greater than 6";
    } elseif (mysqli_num_rows($check_query) > 0) {
      $email_day = "Email already exists";
    } elseif (strpos($email, '.com') === false) {
      $email_day = "Please enter a valid email address";
    } else {

      $sql = "INSERT INTO user_registration (fullname,email,password,verify_token) VALUES ('$fullname', '$email', '$password','$verify_token')";
      $query_run = mysqli_query($con, $sql);

      if ($query_run) {

        sendemail_verify($fullname, $email, $verify_token);

        $_SESSION['insert'] = "Verify Your Account";
        $_SESSION['insert_code'] = "We already sent your Verification";

        // header("refresh:0.1;url=main.php");
        // echo "Sign up Successfully";
      } else {

        // header("refresh:0.1;url=main.php");
        echo "There was a problem";
      }

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
  <title>Dalino Dental Clinic</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Stylesheets css -->
  <link rel="stylesheet" href="assets\css\style.css">
  <!-- SweetAlert 2 library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./assets/js/sweetalert.min.js"></script>


  <!-- OWL-Carousel-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="body-main">

  <div class="container-fluid" id="main">

    <?php
    if (isset($_SESSION['insert'])) {
      // Display the SweetAlert confirmation pop-up
      echo "<script>
            Swal.fire({
              title: 'Verify Your Account',
              text: 'We already sent your Verification',
              icon: 'success',
              confirmButtonText: 'Done',
              customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                confirmButton: 'custom-swal-button',
              },
            }).then((result) => {
              if (result.isConfirmed) {
                  
                  window.location.href = 'main.php';
              }
            });
          </script>
          
          
          ";

      unset($_SESSION['insert']);
    }
    ?>
    <div class="card" id="form-card">
      <div class="row g-0" id="form-row">
        <div class="col" id="form-col1">
          <form action="main-regis.php" method="POST">
            <p class="form-business-name"><span>DALINO</span>&nbsp;DENTAL CLINIC</p>
            <p class="form-title">Sign up</p>
            <div class="mb-3">

              <label for="fullname" class="form-label">Fullname</label>
              <input class="form-control" type="text" name="fullname" autocomplete="off" placeholder=" <?php if (isset($fullname_day)) echo $fullname_day; ?>" aria-label="default input example">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email_one" class="form-control" name="email" autocomplete="off" placeholder="<?php if (isset($email_day)) echo $email_day; ?>">
            </div>
            <div class="mb-4">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" autocomplete="off" placeholder="<?php if (isset($password_day)) echo $password_day; ?>" id="exampleInputPassword1">

            </div>
            <button type="submit" id="form-btn" name="submit" class="btn btn-primary">Sign up</button>

            <p class="dh-acc mt-4"> Already have an account? <span class="dh-accs"><a href="main.php">Sign in.</a></span> </p>

          </form>
        </div>
        <div class="col" id="form-col2">
          <div class="card" id="form-inner-card">
            <!-- owl carousel -->
            <div class="owl-carousel owl-theme" id="form-carousel">

              <div class="card" id="form-item1">
                <img src="assets\image\sample1.jpg" alt="">
                <!-- php img -->
              </div>
              <div class="card" id="form-item1">
                <div class="image-form">
                  <img src="assets\image\sample1.jpg" alt="">
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>

    </div>
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

  <!-- sweet alert -->
  <script src="./assets/js/sweetalert.min.js"></script>

</body>

</html>
