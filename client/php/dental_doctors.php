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

if (isset($_POST["submit_doctors"])) {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $specialties = $_POST['specialties'];

  function generateDoctorsID()
  {
    $prefix = 'DD-';
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Generate a random 5-character string
    $random_string = '';
    for ($i = 0; $i < 5; $i++) {
      $random_string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    $doctors_id = $prefix . $random_string;
    return $doctors_id;
  }

  $doctors_id = generateDoctorsID();

  // Initialize the statement outside the loop
  $stmt = $con->prepare("INSERT INTO dental_doctors (doctors_id,doctors_name, email, contact, specialties, imagedata) VALUES (?, ?, ?, ?, ?, ?)");
  if (!$stmt) {
    echo "Failed to prepare statement: " . $con->error;
    exit();
  }

  $fileNames = [];

  foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
    $target_dir = "../imagedata/";
    $target_file = $target_dir . uniqid() . '_' . basename($_FILES['image']['name'][$key]);

    if (move_uploaded_file($_FILES['image']['tmp_name'][$key], $target_file)) {

      $fileNames[] = $target_file;
    } else {
      echo "failed to move upload file";
    }
  }

  $imagedata = implode(',', $fileNames);

  $stmt->bind_param("ssssss", $doctors_id, $fullname, $email, $contact, $specialties, $imagedata);

  if (!$stmt->execute()) {
    echo "Failed to execute statement: " . $stmt->error;
    exit();
  }

  $stmt->close();
  $con->close();

  header("Location: ../php/dental_doctors.php");
}



// // ADD QUERY DOCTORS
// if (isset($_POST["submit_doctors"])) {
//   $fullname = $_POST["fullname"];
//   $email = $_POST["email"];
//   $contact = $_POST["contact"];
//   $specialties = $_POST["specialties"];

//   function generateDoctorsID()
//   {
//     $prefix = 'DD-';
//     $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

//     // Generate a random 5-character string
//     $random_string = '';
//     for ($i = 0; $i < 5; $i++) {
//       $random_string .= $characters[mt_rand(0, strlen($characters) - 1)];
//     }

//     $doctors_id = $prefix . $random_string;
//     return $doctors_id;
//   }

//   $doctors_id = generateDoctorsID();

//   $sql = "INSERT INTO dental_doctors (doctors_id, doctors_name, email, contact, specialties)
//   VALUES ('$doctors_id','$fullname', '$email', '$contact', '$specialties')";

//   // Execute the query and check if it was successful
//   if ($con->query($sql) === TRUE) {
//     // echo "Event data saved successfully.";
//     header("Location: ../php/dental_doctors.php");
//   } else {
//     echo "Error: " . $sql . "<br>" . $con->error;
//   }
//   // Close the database connection
//   $con->close();
// }

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/png" href="../image/dalino_logo.png">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dalino Admin</title>

  <link rel="stylesheet" href="../css/style.css">

  <!-- Boxiocns CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
      <span class="logo_name">
        <?php
        require '../../connection/connection.php';

        $sql = "SELECT dash_name FROM settings";

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $fullname = $row['dash_name'];
            echo $fullname;
          }
        } else {
          echo "No data found";
        }

        $con->close(); // Close the database connection
        ?></span>
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
          <!-- <li><a href="../php/completed_booking.php">Completed</a></li> -->
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
            <img src="
                      <?php
                      require '../../connection/connection.php';

                      $sql = "SELECT imagedata FROM settings"; // Assuming 'imagedata' is the column name

                      $result = $con->query($sql);

                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          $imagedata = $row['imagedata'];
                          echo $imagedata;
                        }
                      } else {
                        echo "No data found";
                      }

                      $con->close(); // Close the database connection
                      ?>" alt="profileImg">
          </div>
          <div class="name-job">
            <div class="profile_name"> <?php
                                        require '../../connection/connection.php';

                                        $sql = "SELECT name FROM settings";

                                        $result = $con->query($sql);

                                        if ($result->num_rows > 0) {
                                          while ($row = $result->fetch_assoc()) {
                                            $name = $row['name'];
                                            echo $name;
                                          }
                                        } else {
                                          echo "No data found";
                                        }

                                        $con->close(); // Close the database connection
                                        ?></div>

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

    <!-- appointment/session table -->

    <div class="container overflow-hidden mt-4">
      <div class="row">
        <div class="col">
          <div class="card mb-3" id="cerds">
            <div class="header-table" style="display: flex; justify-content: space-between; align-items:center;">All Dental Doctors in Clinic
              <button type="btn" name="add_doctors" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Add Doctors</button>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form method="POST" action="" enctype="multipart/form-data">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dental Doctors</h5>
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
                      <input class="form-control" name="contact" type="text" placeholder="Your Specialties:" aria-label="default input example">
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput3" class="form-label">Specialties</label>
                      <input class="form-control" name="specialties" type="text" placeholder="Your Specialties:" aria-label="default input example">
                    </div>
                    <p class="update_title mt-3">Doctor's documents</p>
                    <div class="input-group mb-3">
                      <input type="file" name="image[]" class="form-control" id="image" placeholder="Upload your photos" multiple>
                      <label class="input-group-text" for="formfile">Upload</label>
                    </div>
                    <p class="fw-light" style="color: #636363; font-size: 14px;">Upload Requirements: This is the soft copy of doctor's requirements for backup purposes.</p>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" value="Upload Image" name="submit_doctors" class="btn btn-primary" style="background:#3785F9; border: none;">Save</button>
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
                  <th scope="col">Doctors ID</th>
                  <th scope="col">Doctors Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Contact</th>
                  <th scope="col">Specialties</th>
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
          url: 'dental_doctors_scripts.php',
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            // Clear the existing data and add the new data
            table.clear();
            $.each(data, function(index, row) {
              var deleteButton = '<a href="../php/doctors_data.php?deleteid=' + row.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-trash"></i></button></a>&nbsp';
              var updateButton = '<a href="../php/doctors_update.php?updateid=' + row.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></button></a>&nbsp';
              var viewButton = '<a href="../php/doctors_viewing.php?viewid=' + row.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-file-import"></i></button></a>';

              table.row.add([
                row.id,
                row.doctors_id,
                row.doctors_name,
                row.email,
                row.contact,
                row.specialties,
                deleteButton + updateButton + viewButton
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