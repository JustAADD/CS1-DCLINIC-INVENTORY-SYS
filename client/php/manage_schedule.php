<?php
session_start();

require '../../connection/connection.php';

if (isset($_GET['logout'])) {

  // Unset all session variables
  session_unset();

  // Destroy the session
  session_destroy();
  header("Location:../../main.php");

  exit();
}

// ADD QUERY DOCTORS
if (isset($_POST["submit_schedule"])) {
  $slots = $_POST["slots"];
  $date = $_POST["date"];
  $start_time = $_POST["start_time"];
  $end_time = $_POST["end_time"];
  $status = $_POST["status"];
  $duration = $_POST["duration"];

  $sql = "INSERT INTO manage_schedule (slots, date, start_time, end_time, status, duration)
  VALUES ('$slots','$date', '$start_time', '$end_time', '$status', '$duration')";

  // Execute the query and check if it was successful
  if ($con->query($sql) === TRUE) {
    // echo "Event data saved successfully.";
    header("Location: ../php/manage_schedule.php");
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
          <a href="upcoming_appointment.php">
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

    <!-- manage appointment -->

    <div class="container overflow-hidden mt-5">
      <div class="row">
        <div class="col">
          <div class="card" id="cerds">
            <div class="header-table">Manage Schedule Records
              <button type="button" name="add_doctors" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Add Schedule</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="POST" action="">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Manage Schedule</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Slots</label>
                        <input class="form-control" name="slots" type="text" placeholder="Your available slots:" aria-label="default input example">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" id="exampleFormControlInput2" placeholder="Set date:">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Start_time</label>
                        <input class="form-control" name="start_time" type="time" placeholder="Set your Opening Time:" aria-label="default input example">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">End_time</label>
                        <input class="form-control" name="end_time" type="time" placeholder="Set your Closing Time:" aria-label="default input example">
                      </div>
                      <div class="mb-3">
                        <label for="inputGroupSelect01" class="form-label">Select Status</label>
                        <select class="form-select" name="status" id="inputGroupSelect01">
                          <option selected>Select Status</option>
                          <option value="Open">Open</option>
                          <option value="Closed">Closed</option>
                          <option value="No Slots">No Slots</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Duration in minutes</label>
                        <input class="form-control" name="duration" type="text" placeholder="Your duration in minutes:" aria-label="default input example">
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="submit_schedule" class="btn btn-primary" style="background:#3785F9; border: none;">Add Schedule</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>


            <div class="body-table">

              <table class="table table-hover">
                <div id="manageSchedule"></div>

              </table>
            </div>
          </div>
        </div>


      </div>
    </div>
    <!-- javascript -->
    <script src="../js/script.js"></script>
    <!--===== Bootstrap JS =====-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>