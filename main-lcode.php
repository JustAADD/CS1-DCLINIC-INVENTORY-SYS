<?php
session_start();

require 'connection/connection.php';

$mysqli = new mysqli('localhost', 'root', '', 'cs1-dclinic-sys');
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

$email = $_POST['email'];

$stmt = $mysqli->prepare("SELECT fullname FROM user_registration WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$stmt->bind_result($fullname);

if ($stmt->fetch()) {

  $_SESSION['fullname'] = $fullname;
}

$stmt->close();
$mysqli->close();


if (isset($_POST['submit'])) {
  $fullname = $_SESSION['fullname'];
  $status = "login";
  $date = date("Y-m-d");
  $time = date("H:i:s");
  $formattedTime = date("h:i a", strtotime($time));

  $sql = "INSERT INTO user_logs (name, status, time, date)
  VALUES ('$fullname','$status', '$formattedTime', '$date')";

  // Execute the query and check if it was successful
  if ($con->query($sql) === TRUE) {
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }


  if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM user_registration WHERE email='$email' AND password='$password' LIMIT 1";
    $login_query_run = mysqli_query($con, $login_query);

    if ($login_query_run) {
      if (mysqli_num_rows($login_query_run) > 0) {
        $row = mysqli_fetch_array($login_query_run);

        if ($row['verify_status'] == "1") {
          if ($row['role'] == "admin") {
            $_SESSION['isAdmin'] = true;

            header("Location: client/php/dashboard.php");
          } elseif ($row['role'] == "assistant doctor") {
            $_SESSION['isAssistantDoctor'] = true;
            header("Location: client/php/dashboard.php");
            
          } elseif ($row['role'] == "helpdesk") {
            $_SESSION['isHelpDesk'] = true;
            header("Location: client/php/dashboard.php");// Redirect for assistant doctor

          } else {
            $_SESSION['authenticated'] = true;
            $_SESSION['auth_user'] = [
              'fullname' => $row['fullname'],
              'email' => $row['email'],
              'password' => $row['password']
            ];
            $_SESSION['email'] = $email;
            header("Location: main.php");
          }
          exit();
        } else {
          $_SESSION['status'] = "Please verify your account!";
        }
      } else {
        $_SESSION['status'] = "Invalid Email or Password";
      }
    } else {
      $_SESSION['status'] = "Error in query execution";
    }

    header("Location: main.php");
    exit();
  } else {
    $_SESSION['status'] = "ALL FIELDS ARE MANDATORY";
    header("Location: main.php");
    exit();
  }
}
