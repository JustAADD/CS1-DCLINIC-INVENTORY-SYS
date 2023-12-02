<?php

session_start();


if (!isset($_SESSION['isAdmin'])) {

  header("location: ../../main.php");
}

if (isset($_GET['logout'])) {

  // Unset all session variables
  session_unset();

  // Destroy the session
  session_destroy();
  header("Location:../../main.php");
  exit();
}

require '../../connection/connection.php';

if (isset($_POST["gensettings"])) {

  $id = "1";
  $dashboard_name = $_POST["dash_name"];
  $name = $_POST["admin_name"];
  // $password = $_POST["password"];
  // $cpassword = $_POST["cpassword"];

  // if ($password !== $cpassword) {
  //   // echo "Password do not match.";

  //   // $msg = "<div class='alert alert-success'>Changes saved</div>";

  //   $_SESSION['password'] = "Password do not match";
  //   $_SESSION['status_password'] = "Please check carefully your inputted password";
  // }

  // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $stmtSettings = $con->prepare("UPDATE settings SET dash_name=?, name=?, imagedata=? WHERE id=?");

  if (!$stmtSettings) {
    echo "Failed to prepare statement: " . $con->error;
    exit();
  }


  // $target_dir = "imagedata/";
  $target_dir = "../imagedata/";

  // specify the path to the image file
  $target_file = $target_dir . basename($_FILES["image"]["name"]);

  // move the uploaded file to the target directory
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    // display a success message if the file was uploaded successfully
    // echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";

    $stmtSettings->bind_param("ssssss", $dashboard_name, $name, $target_file, $id);

    if (!$stmtSettings->execute()) {
      echo "Failed to execute statement: " . $stmtSettings->error;
      exit();
    }
    $stmtSettings->execute();
    $stmtSettings->close();

    $msg = "<div class='alert alert-success'>Changes saved</div>";

    $_SESSION['status'] = "Your settings succesfully changed";
    $_SESSION['status_code'] = "Saved";
  }
}

// Media query settings
if (isset($_POST["savesettings"])) {

  $dash_service = $_POST["dash_service"];
  $dash_text = $_POST["dash_text"];
  $type = $_POST["type_services"];

  // Check if an image file is selected
  if (isset($_FILES["image"])) {

    $target_dir = "./../../imagedata/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

      // Prepare the SQL statement
      $stmtMedia = $con->prepare("INSERT INTO media_settings (dash_service, dash_text, type_of_services, imagedata) VALUES (?, ?, ?, ?)");

      if (!$stmtMedia) {
        echo "Failed to prepare statement: " . $con->error;
        exit();
      }

      // Execute the SQL statement
      $stmtMedia->bind_param("ssss", $dash_service, $dash_text, $type, $target_file);
      $values = [$target_file];
      $stmtMedia->execute();
      $stmtMedia->close();

      // Close the database connection
      $con->close();

      // Display a success message
      $msg = "<div class='alert alert-success'>Changes saved</div>";

      $_SESSION['status'] = "Your settings successfully changed";
      $_SESSION['status_code'] = "Saved";
    } else {
      // Display an error message if the file upload fails
      echo "Error uploading the file.";
    }
  } else {
    // Handle the case where no image file is selected
    echo "No image file selected.";
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
  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- SweetAlert 2 library -->

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">

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
        ?>
      </span>
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

        </div>

      </li>
      <li>
        <div class="iocn-link">
          <a href="settings.php">
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
            <div class="profile_name">
              <?php
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
              ?>

            </div>
          </div>
          <a href="?logout" name="logout" id="logout"><i class='bx bx-log-out'></i></a>
        </div>
      </li>
    </ul>
  </div>


  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
    </div>

    <?php

    if (isset($_SESSION['status']) && isset($_SESSION['status_code'])) {
      $status = $_SESSION['status'];
      $status_code = $_SESSION['status_code'];
    ?>

      <script>
        // swal.fire({
        //   title: "<?php echo $status; ?>",
        //   text: "",
        //   icon: "<?php echo $status_code; ?>",
        //   button: "Done!",
        //   customClass: {
        //     popup: "custom-swal-popup",
        //     title: "custom-swal-title",
        //     confirmButton: "custom-swal-button",
        //   },
        // });

        Swal.fire({
          title: "<?php echo $status; ?>",
          text: "<?php echo $status_code ?>",
          icon: "success"
        });
      </script>
    <?php
      unset($_SESSION['status']);
      unset($_SESSION['status_code']);
    }
    ?>

    <?php

    if (isset($_SESSION['password']) && isset($_SESSION['status_password'])) {
      $password = $_SESSION['password'];
      $status_password = $_SESSION['status_password'];
    ?>

      <script>
        // swal.fire({
        //   title: "<?php echo $status; ?>",
        //   text: "",
        //   icon: "<?php echo $status_code; ?>",
        //   button: "Done!",
        //   customClass: {
        //     popup: "custom-swal-popup",
        //     title: "custom-swal-title",
        //     confirmButton: "custom-swal-button",
        //   },

        // });

        Swal.fire({
          title: "<?php echo $password; ?>",
          text: "<?php echo $status_password ?>",
          icon: "warning"
        });
      </script>
    <?php
      unset($_SESSION['password']);
      unset($_SESSION['status_password']);
    }
    ?>

    <div class="settings-content">

      <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">General Settings</button>
          <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Media Settings</button>
          <button class="nav-link" id="v-pills-reports-tab" data-bs-toggle="pill" data-bs-target="#v-pills-reports" type="button" role="tab" aria-controls="v-pills-reports" aria-selected="false">Overall Reports</button>
        </div>
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <div class="card" id="gen1">
              <form method="POST" action="" enctype="multipart/form-data">
                <div class="row">
                  <div class="col">
                    <p class="" style="font-size:smaller;"><span></span> This settings update admin dashboard name header.</p>
                    <div class="mb-4 mt-2">
                      <label for="exampleInputEmail1" class="form-label m">Dashboard name</label>
                      <input type="text" class="form-control" name="dash_name" id="exampleInputEmail1" placeholder=".." aria-describedby="default input example">
                    </div>
                    <p class="" style="font-size:smaller;"><span></span> This settings update's admin account.</p>
                    <div class="mb-2 mt-2">
                      <label for="exampleInputEmail1" class="form-label m">Name <span style="font-size: 13px;"> (must be fullname) </span></label>
                      <input type="text" class="form-control" name="admin_name" id="exampleInputEmail1" placeholder=".." aria-describedby="default input example">
                    </div>
                    <div class="mb-2">
                      <label for="formfile" style="font-size:smaller;" class="form-label mt-3">Admin Profile</label>
                      <input type="file" name="image" class="form-control" id="image" placeholder="Upload your photos">
                    </div>
                  </div>

                  <!-- <div class="col">

                    <label for="inputPassword5" class="form-label">Password</label>
                    <input type="password" name="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">

                    <label for="inputPassword5" class="form-label mt-3">Confirm Password</label>
                    <input type="password" name="cpassword" id="inputPassword5" class="form-control mb-3" aria-describedby="passwordHelpBlock">
                    <div id="passwordHelpBlock" class="form-text mb-3">
                      Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                    </div>
                  </div> -->

                </div>
                <div class="d-flex justify-content-end">
                  <button type="submit" value="Upload Image" id="savesettings" name="gensettings" class="btn btn-primary mt-4">save settings</button>
                </div>
              </form>
            </div>
          </div>


          <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
            <div class="card" id="gen" style="width: 55rem;">
              <div class="mb-2">
                <form method="POST" action="" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col">
                      <p class="" style="font-size:smaller;"><span></span> This settings update your dental services</p>
                      <div class="mb-4 mt-2">
                        <label for="exampleInputEmail1" class="form-label m">Dental Service</label>
                        <input type="text" class="form-control" name="dash_service" id="exampleInputEmail1" placeholder=".." aria-describedby="default input example">
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlTextarea1" style="font-size:smaller;" class="form-label"> add info about your services</label>
                        <textarea class="form-control" name="dash_text" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                    </div>

                    <div class="col">
                      <p class="" style="font-size:smaller;"><span></span></p>
                      <select class="form-select" name="type_services" aria-label="Default select example" style="margin-top: 68px;">
                        <option selected>Choose type of services</option>
                        <option value="Dental Services">Dental Services</option>
                        <option value="Dental Prosthesis">Dental Prosthesis</option>
                        <option value="Dentures">Dentures</option>
                      </select>
                      <label for="formfile" class="form-label mt-4">Upload Picture<span style="font-size: 13px;">&nbsp;(Provide sample photo of dental service)</span></label>
                      <input type="file" name="image" class="form-control" id="image" placeholder="Upload your photos">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="submit" value="Upload Image" id="savesettings" name="savesettings" class="btn btn-primary mt-5">add services</button>
                    </div>
                  </div>
              </div>
              </form>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-reports" role="tabpanel" aria-labelledby="v-pills-reports-tab">
            <div class="card" id="gen" style="width: 55rem;">
              <p class="">Information above are the overall records in every month.
                click here to print reports and save as a soft copy.</p>

                


            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  <!-- sweet alert -->
  <!-- <script src="./assets/js/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.min.js"></script>


  <!-- javascript -->
  <script src="../js/script.js"></script>
  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>