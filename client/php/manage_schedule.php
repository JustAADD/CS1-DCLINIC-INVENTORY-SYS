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

  $date_obj = DateTime::createFromFormat('Y-m-d', $date);
  $formatted_date = $date_obj->format('d/m/y l');

  $start_time = $_POST["start_time"];
  $end_time = $_POST["end_time"];
  $status = $_POST["status"];

  $check_query = "SELECT * FROM manage_schedule WHERE date = '$date'";
  $result = mysqli_query($con, $check_query);

  if (mysqli_num_rows($result) > 0) {

    $_SESSION['back'] = "Selected time slot already exists. Please choose a different time.";
    $_SESSION['back_code'] = "warning";

    // echo "Selected time slot already exists. Please choose a different time.";
  } else {

    $sql = "INSERT INTO manage_schedule (slots, date, session_date, start_time, end_time, status)
    VALUES ('$slots','$date', '$formatted_date', '$start_time', '$end_time', '$status')";

    if ($con->query($sql) === TRUE) {
      // echo "Event data saved successfully.";
      $_SESSION['insert'] = "Great!";
      $_SESSION['insert_code'] = "Your available date and slots already sets.";
      // header("Location: ../php/manage_schedule.php");
    } else {
      echo "Error: " . $sql . "<br>" . $con->error;
    }
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

  <!-- SweetAlert 2 library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./assets/js/sweetalert.min.js"></script>

  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!--Datatables-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>



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
          <li><a href="../php/approved_booking.php">Approved</a></li>
          <li><a href="../php/completed_booking.php">Completed</a></li>
          <li><a href="../php/rejected_booking.php">Rejected</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../php/dental_doctors.php">
            <i class='bx bx-calendar'></i>
            <span class="link_name">Manage Schedule</span>
          </a>
          <ul class="sub-menu blank">
            <li><a href="manage_schedule.php">Manage Schedule</a></li>
          </ul>
        </div>
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
          <span class="link_name">Patient History</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../php/patient_lists.php">Patient History</a></li>
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
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="../php/Inventory.php">Inventory</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../php/sa_feedback.php">
            <i class='bx bx-message-dots'></i>
            <span class="link_name">Feedback</span>
          </a>

        </div>

      </li>
      <li>
        <div class="iocn-link">
          <a href="../php/settings.php">
            <i class='bx bx-cog'></i>
            <span class="link_name">Settings</span>
          </a>

        </div>

      </li>



      <!-- sidebar footer -->
      <li>
        <div class="profile-details">
          <div class="profile-content">
            <img src="../image/dp_admin.jpg" alt="profileImg">
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
          <div class="card mb-3" id="cerds">
            <div class="header-table" style="display: flex; justify-content: space-between; align-items:center;">Manage Schedule
              <button type="btn" name="add_doctors" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Add Schedule</button>
            </div>
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
            <table id="data-table" class="display">
              <thead class="table-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Slots</th>
                  <th scope="col">Date</th>
                  <th scope="col">Opening Time</th>
                  <th scope="col">Closed Time</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="data-table">

              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>
    </div>
    <?php
    if (isset($_SESSION['insert'])) {
      // Display the SweetAlert confirmation pop-up
      echo "<script>
            Swal.fire({
              title: 'Great!',
              text: 'Your available date and slots already sets.',
              icon: 'success',
              confirmButtonText: 'Ok Proceed',
              customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                confirmButton: 'custom-swal-button',
              },
            });
          </script>";

      unset($_SESSION['insert']);
    }
    ?>
    <?php
    if (isset($_SESSION['back'])) {
      // Display the SweetAlert confirmation pop-up
      echo "<script>
            Swal.fire({
              title: 'Selected time slot already exists.',
              text: 'Please choose a different time.',
              icon: 'warning',
              confirmButtonText: 'Ok Proceed',
              customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                confirmButton: 'custom-swal-button',
              },
            });
          </script>";

      unset($_SESSION['back']);
    }
    ?>


    <!-- sweet alert -->
    <script src="./assets/js/sweetalert.min.js"></script>

    <!-- javascript -->
    <script src="../js/script.js"></script>

    <!--datatable-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
        var table = $('#data-table').DataTable({
          "columns": [
            null,
            null,
            null,
            null,
            null,
            null,
            null
          ]
        });

        // Function to fetch and update data
        function loadData() {
          $.ajax({
            url: 'manageScheduleScript.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              // Clear the existing data and add the new data
              table.clear();
              $.each(data, function(index, row) {
                var deleteButton = '<a href="../php/manage_schedule_data.php? deleteid=' + row.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-trash"></i></button></a>&nbsp';
                var updateButton = '<a href="../php/manage_schedule_update.php? updateid=' + row.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></button></a>';

                table.row.add([
                  row.id,
                  row.slots,
                  row.session_date,
                  row.start_time,
                  row.end_time,
                  row.status,
                  deleteButton + updateButton
                  // Add more columns as needed
                ]);
              });

              // Draw the table to update the view with new data
              table.draw(false);
            },
            error: function() {
              console.error('Error loading data');
            }
          });
        }

        // Load data initially
        loadData();

        // Refresh data every X milliseconds (e.g., every 5 seconds)
        setInterval(loadData, 5000); // 5000 milliseconds = 5 seconds
      });
    </script>


    <!--===== Bootstrap JS =====-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>