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

if (isset($_POST["add_inventory"])) {

  $name = $_POST["name"];
  $stocks = $_POST["stocks"];
  $class = $_POST["class"];

  $desired_date_time = '20/07/2023 10:23 AM';
  $date_time_obj = DateTime::createFromFormat('d/m/Y h:i A', $desired_date_time);

  $formatted_date_time = $date_time_obj->format('Y-m-d H:i:s');

  $formatted_time = $date_time_obj->format('h:i A');

  // $target_dir = "imagedata/";
  $target_dir = "../imagedata/";


  // specify the path to the image file
  $target_file = $target_dir . basename($_FILES["image"]["name"]);

  // move the uploaded file to the target directory
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    // display a success message if the file was uploaded successfully
    // echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
    function generateinvID()
    {
      $prefix = 'INV-'; // Set the prefix for the product ID
      $unique_id = uniqid(); // Generate a unique ID based on the current time in microseconds
      $inv_id = $prefix . $unique_id; // Combine the prefix and unique ID to create the product ID
      return $inv_id; // Return the product ID
    }

    $inv_id = generateinvID();

    $stmt = $con->prepare("INSERT INTO inventory (imagedata, name, stocks, class, date) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
      echo "Failed to prepare statement: " . $con->error;
      exit();
    }

    $stmt->bind_param("sssss", $target_file, $name, $stocks, $class, $formatted_time);

    if (!$stmt->execute()) {
      echo "Failed to execute statement: " . $stmt->error;
      exit();
    }
    
    $stmt->close();
    $con->close();

    // $stmt = $con->prepare("INSERT INTO inventory (inv_id,imagedata, name, stocks,class, date) VALUES (?, ?, ?, ?, ?) ");
    // $stmt->bind_param("sssss", $inv_id, $target_file, $name, $stocks, $class, $formatted_time);
    // $stmt->execute();
    // $con->close();
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
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
        </div>
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

    <!-- appointment/session table -->

    <div class="container overflow-hidden mt-5">
      <div class="row">
        <div class="col">
          <div class="card" id="cerds">
            <div class="header-table" id="button_inventory">Supplies & Equipment Inventory
              <button type="btn" name="add_inventory" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Add Inventory</button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="POST" action="" enctype="multipart/form-data">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Supplies & Equipment Inventory</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="formfile" class="form-label">Supplies/Equipments</label>
                        <input type="file" name="image" class="form-control" id="image" placeholder="Upload your photos">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Supplies/Equipment Name</label>
                        <input class="form-control" name="name" type="text" id="exampleFormControlInput1" placeholder="Name:" aria-label="default input example">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput2" class="form-label">Stocks</label>
                        <input class="form-control" name="stocks" type="text" id="exampleFormControlInput2" placeholder="Quantity:" aria-label="default input example">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput3" class="form-label">Class</label>
                        <input class="form-control" name="class" type="text" id="exampleFormControlInput3" placeholder="Class:" aria-label="default input example">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="add_inventory" value="Upload Image" class="btn btn-primary" style="background:#3785F9; border: none;">Add Inventory</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="body-table">

              <table class="table table-hover">
                <div id="inventory"></div>

              </table>
            </div>
          </div>
        </div>


      </div>
    </div>
  </section>


  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- javascript -->
  <script src="../js/script.js"></script>
</body>

</html>