<?php
session_start();
// session_unset();

// session_destroy();

// header("Location: main.php");
// exit();

if (isset($_SESSION['email'])){

  header ("Location: home.php");
  
}

include('db-connect/db-con.php');

if (isset($_POST['submit'])) {
  if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM user_registration WHERE email='$email' AND password='$password' LIMIT 1";
    $login_query_run = mysqli_query($con, $login_query);

    if (mysqli_num_rows($login_query_run) > 0) {
      $row = mysqli_fetch_array($login_query_run);
      if ($row['verify_status'] == "1") {
        $_SESSION['authenticated'] = TRUE;
        $_SESSION['auth_user'] = [
          'fullname' => $row['fullname'],
          'email' => $row['email'],
          'password' => $row['password']
        ];
        // $_SESSION['user'] = "You are Logged in Successfully";
        $_SESSION['email'] = $email;
        header("Location: home.php");

        exit(0);
      } else {
        $_SESSION['status'] = "Please verify your account!";
        header("Location: main.php");
        exit(0);
      }
    } else {
      $_SESSION['status'] = "Invalid Email or Password";
      header("Location: main.php");

      exit(0);
    }
  } else {
    $_SESSION['status'] = "ALL FIELDS ARE MANDATORY";
    header("Location: main.php");
    exit(0);
  }
}
