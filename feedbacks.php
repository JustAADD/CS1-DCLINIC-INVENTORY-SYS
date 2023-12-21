<?php
require 'connection/connection.php';
session_start();

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
} elseif (isset($_SESSION['email'])) {

  header("Location: home.php");
  exit();
}

if (!isset($_SESSION['email'])) {

  header("Location: main.php");
}

include('vendor/autoload.php');
require_once './src/Analyzer.php';
require_once './src/Procedures/SentiText.php';
require_once './src/Config/Config.php';

use Sentiment\Analyzer;


$mysqli = new mysqli('', 'u530383017_root', 'Ik@wl@ngb0w4', 'u530383017_localhost');
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

if (isset($_POST['submit'])) {
  $_SESSION['insert'] = "Thank you!";
  $_SESSION['insert_code'] = "Thank you for sending us a feedback!";
}

//Feedbackinclude('vendor/autoload.php');

// Function to store the comment in the database
function storeComment($comment, $sentiment)
{

  session_start();

  // Get the patient name from the session variable
  $patientName = $_SESSION['fullname'];

  // Get the current date
  $currentDate = date('Y-m-d');

  $server = "";
  $username = "u530383017_root";
  $password = "Ik@wl@ngb0w4";
  $databasename = "u530383017_localhost";
  // Adjust the database connection details

  $mydb = mysqli_connect("$server", "$username", $password, $databasename);

  // Use prepared statements to prevent SQL injection
  $stmt = $mydb->prepare("INSERT INTO feedback_table (patient_name, comment, sentiment, date) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $patientName, $comment, $sentiment, $currentDate);

  if ($stmt->execute()) {
    $_SESSION['insert'] = "Thank you!";
    $_SESSION['insert_code'] = "Thank you for sending us feedback!";
  } else {
    echo "Error: " . $stmt->error;
  }

  // Close the database connection
  $stmt->close();
  $mydb->close();
}

$obj = new Analyzer();

$result = '';

if (isset($_POST['submit'])) {
  $text = $_POST['text'];
  $currentDate = date('Y-m-d');
  $result = $obj->getSentiment($text);

  // Check sentiment and store in the database
  if ($result['compound'] <= -0.05) {
    storeComment($text, 'negative');
  } elseif ($result['compound'] >= 0.05) {
    storeComment($text, 'positive');
  } else {
    storeComment($text, 'neutral');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="shorcut icon" href="./assets/image/dalino_logo.png">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- SweetAlert 2 library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./assets/js/sweetalert.min.js"></script>

  <title>Document</title>

  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card {
      padding: 6%;
      display: flex;
      width: 50rem;
      height: 30rem;
      box-shadow: 0 7px 4px rgba(126, 175, 249, 0.4);
    }

    .title {

      font-weight: bold;
      color: #3785F9;
    }

    .card textarea {
      width: 40rem;

    }

    .card button {
      width: 10rem;
      font-size: small;
      border-radius: 10px;
    }

    .buton a {
      width: 10rem;
      font-size: small;
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <div class="header">
    <?php
    // include 'app-header.php';
    ?>
  </div>

  <div class="container mt-4">
    <?php
    if (isset($_SESSION['insert'])) {
      // Display the SweetAlert confirmation pop-up
      echo "<script>
        Swal.fire({
            title: 'Thank you!',
            text: 'Thank you for sending us a feedback!',
            icon: 'success',
            confirmButtonText: 'Done',
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                confirmButton: 'custom-swal-button',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'home.php';
            } else {
                // Handle cancelation if needed
            }
        });
    </script>";

      unset($_SESSION['insert']);
    }
    ?>
    <div class="card" style="margin-top: 10%;">
      <p class="title">We would love to hear your feedback for us!</p>
      <form method="POST" action="">
        <div class="form-floating">
          <textarea class="form-control" name="text" placeholder="Send a Feedback here" autoComplete="off" id="feedback" style="height: 200px"></textarea>
          <label for="feedback">Send a Feedback</label>
        </div>
        <div class="buton">
          <a href="home.php" class="btn btn-primary mt-4">Back</a>
          <button type="submit" name="submit" value="submit" class="btn btn-primary mt-4">Send Feedback</button>
        </div>
      </form>
    </div>

  </div>
  <!-- sweet alert -->
  <script src="./assets/js/sweetalert.min.js"></script>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>