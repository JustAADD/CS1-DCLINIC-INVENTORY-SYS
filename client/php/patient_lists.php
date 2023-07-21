<?php

session_start();
if (isset($_GET['logout'])) {

  // Unset all session variables
  session_unset();

  // Destroy the session
  session_destroy();
  header("Location:../../main.php");
  exit();
}


require '../../connection/connection.php';

// ADD QUERY DOCTORS
if (isset($_POST["add_patient"])) {
  $fullname = $_POST["fullname"];
  $email = $_POST["email"];
  $contact = $_POST["contact"];
  $date_of_birth = $_POST["date_of_birth"];

  function generatePatientID()
  {
    $prefix = 'PT-'; // Set the prefix for the product ID
    $unique_id = uniqid(); // Generate a unique ID based on the current time in microseconds
    $patient_id = $prefix . $unique_id; // Combine the prefix and unique ID to create the product ID
    return $patient_id; // Return the product ID
  }

  $patient_id = generatePatientID();

  $sql = "INSERT INTO patient_list (patient_id, patient_name, email, contact, date_of_birth)
  VALUES ('$patient_id','$fullname', '$email', '$contact', '$date_of_birth')";

  // Execute the query and check if it was successful
  if ($con->query($sql) === TRUE) {
    // echo "Event data saved successfully.";
    header("Location: ../php/patient_lists.php");
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }
  // Close the database connection
  $con->close();
}

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dalino Admin</title>

  <link rel="stylesheet" href="../css/style.css">

  <!-- Boxiocns CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
  <div class="sidebar close">
    <div class="logo-details">
      <!-- <i class='bx bxl-c-plus-plus'></i> -->
      <img class="admin_logo" src="../image/dalino_logo.png">
      <span class="logo_name">Dalino Dental Clinic</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="../php/dashboard.php">
          <i class='bx bx-grid-alt'></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../php/dashboard.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection'></i>
            <span class="link_name">Appointment Schedule</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="upcoming_appointment.php">Appointment Schedule</a></li>
          <li><a href="manage_schedule.php">Manage Schedule</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../php/dental_doctors.php">
            <i class='bx bx-plus-medical'></i>
            <span class="link_name">Dental Doctors</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="../php/dental_doctors.php">Dental Doctors</a></li>
          </ul>
        </div>
      </li>
      <li>
        <a href="../php/patient_lists.php">
          <i class='bx bx-list-check bx-sm'></i>
          <span class="link_name">Patient Lists</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../php/patient_lists.php">Patient Lists</a></li>
        </ul>
      </li>
      <li>
        <a href="../php/p_transaction.php">
          <i class='bx bx-credit-card-alt'></i>
          <span class="link_name">Patient Transaction</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../php/transactions.php">Patient Transaction</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../php/Inventory.php">
            <i class='bx bx-collection'></i>
            <span class="link_name">Inventory</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="../php/Inventory.php">Inventory</a></li>
          <li><a href="#">Upcoming Appointment</a></li>
          <li><a href="#">Session Appointment</a></li>
          <li><a href="#">Manage Date Slots</a></li>
          <li><a href="#">Manage Time Slots</a></li>
        </ul>
      </li>

      <li>
        <a href="../php/sa_feedback.php">
          <i class='bx bx-message-dots'></i>
          <span class="link_name">Feedback</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../php/sa_feedback.php">Feedback</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-cog'></i>
            <span class="link_name">Settings</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Settings</a></li>
          <li><a href="#">Page Settings</a></li>
          <li><a href="#">Admin Settings</a></li>
        </ul>
      </li>



      <!-- sidebar footer -->
      <li>
        <div class="profile-details">
          <div class="profile-content">
            <img src="image/profile.jpg" alt="profileImg">
          </div>
          <div class="name-job">
            <div class="profile_name">Mercedita</div>

          </div>
          <a href="?logout" name="logout" id="logout"><i class='bx bx-log-out'></i></a>
        </div>
      </li>
    </ul>
  </div>


  <section class="home-section">

    <!--  real time data -->
    <script type="text/javascript" src="../js/autoload.js"></script>

    <div class="home-content">
      <i class='bx bx-menu'></i>
    </div>

    <div class="container overflow-hidden mt-5">
      <div class="row">
        <div class="col">
          <div class="card" id="cerds">
            <div class="header-table" id="button_patient">Patient Lists
              <button type="btn" name="add_patient" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Add Patient</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="POST" action="">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Patient List</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Fullname</label>
                        <input class="form-control" name="fullname" type="text" placeholder="Your Fullname:" aria-label="default input example">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleFormControlInput2" placeholder="Your Email Address:">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Contact Number</label>
                        <input class="form-control" name="contact" type="text" placeholder="Your contact:" aria-label="default input example">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Date of birth</label>
                        <input class="form-control" name="date_of_birth" type="date" placeholder="YYYY-MM-DD" aria-label="date of birth">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="add_patient" class="btn btn-primary" style="background:#3785F9; border: none;">Add Patient</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="body-table">

              <table class="table table-hover">
                <div id="patients"></div>

              </table>
            </div>
          </div>
        </div>


      </div>
    </div>
  </section>


  <!-- javascript -->
  <script src="../js/script.js"></script>
  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>