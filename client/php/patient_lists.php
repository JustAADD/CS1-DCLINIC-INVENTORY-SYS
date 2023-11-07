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
    $prefix = 'PT-';
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Generate a random 5-character string
    $random_string = '';
    for ($i = 0; $i < 5; $i++) {
      $random_string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    $patient_id = $prefix . $random_string;
    return $patient_id;
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
          <a href="../php/manage_schedule.php">
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
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Feedback</a></li>
          <li><a href="../php/positive_feedback.php">Positive Feedback</a></li>
          <li><a href="../php/negative_feedback.php">Negative Feedback</a></li>
          <li><a href="../php/neutral_feedback.php">Neutral Feedback</a></li>
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

    <div class="container overflow-hidden mt-5">
      <div class="row">
        <div class="col">
          <div class="card mb-3" id="cerds">
            <div class="header-table" style="display: flex; justify-content: space-between; align-items:center;">Patient Lists
              <button type="btn" name="add_doctors" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Add Patients</button>
            </div>
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
            <table id="data-table" class="display">
              <thead class="table-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">ID</th>
                  <th scope="col">Patient Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone Number</th>
                  <th scope="col">Date of birth</th>
                  <th scope="col">Actions</th>
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
  </section>


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
          url: 'patient_scripts.php',
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            // Clear the existing data and add the new data
            table.clear();
            $.each(data, function(index, row) {
              var deleteButton = '<a href="../php/patient_data.php? deleteid=' + row.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-trash"></i></button></a>&nbsp';
              var updateButton = '<a href="../php/patient_update.php? updateid=' + row.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></button></a>';

              table.row.add([
                row.id,
                row.patient_id,
                row.patient_name,
                row.email,
                row.contact,
                row.date_of_birth,
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