<?php

require '../../connection/connection.php';

$id = $_GET['updateid'];
// Fetch the doctor's data
$sql = "SELECT * FROM patient_list WHERE id =$id";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$patient_id = $row['patient_id'];
$patient_name = $row['patient_name'];
$email = $row['email'];
$contact = $row['contact'];
$gender = $row['gender'];
$dentalservices = $row["dental_services"];
$date = $row["date"];
$nextappointment = $row["next_appointment"];
$statusappointment = $row["stats_appointment"];


if (isset($_POST['update'])) {

  $patient_name = $_POST['patient_name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $gender = $_POST["gender"];
  $dentalservices = $_POST["dental-services"];
  $date = $_POST["date"];
  $nextappointment = $_POST["next-appointment"];

  // Prepare and execute the update query
  $updateQuery = "UPDATE patient_list SET id='$id', patient_name='$patient_name', email='$email', contact='$contact', gender='$gender' ,
  dental_services = '$dentalservices',  date = '$date', next_appointment = '$nextappointment', imagedata = '$target_file' WHERE id = '$id'";
  $result = mysqli_query($con, $updateQuery);

  if ($result) {
    // Update successful
    //  echo "Doctor information updated successfully.";
    header("Location: ../php/patient_lists.php");
  } else {
    // Update failed
    echo "Error updating patient information: " . $con->error;
  }
  //close the database 
  $con->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- ===== CSS ===== -->
  <link rel="stylesheet" href="../../assets/css/style.css">

  <title>Dalino Dental Clinic</title>

</head>

<body>
  <header class="header">
    <a href="#" class="header__logo">Dalino Dental Clinic</a>

    <ion-icon name="menu-outline" class="header__toggle" id="nav-toggle"></ion-icon>

    <nav class="nav" id="nav-menu">
      <div class="bd-grid" id="nav__content">
        <ion-icon name="close-outline" class="nav__close" id="nav-close"></ion-icon>

        <div class="nav__perfil">
          <div class="nav__img">
            <img src="../../assets/image/dalino_logo.png" alt="">
          </div>
          <div>
            <a href="../php/patient_lists.php" class="nav__name">Dalino Dental Clinic</a>
          </div>
        </div>
      </div>

    </nav>

  </header>


  <div class="container" id="update_container">
    <div class="card" id="update_card" style="margin-top: 5%;">
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="row ">
          <p class="update_title mt-4">Dental Information of Patient</p>
          <div class="col">
            <div class="mb-3">
              <label for="fullname" class="form-label">Fullname</label>
              <input class="form-control" name="patient_name" type="text" value="<?php echo $patient_name; ?>" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="form-control" name="email" class="form-control" value="<?php echo $email; ?>" autocomplete="off">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="email" class="form-label">Contact</label>
              <input type="form-control" name="contact" class="form-control" value="<?php echo $contact; ?>" autocomplete="off">
            </div>
            <div class="mb-1">
              <label for="email" class="form-label">Gender</label>
              <input type="form-control" name="gender" class="form-control" value="<?php echo $gender; ?>" autocomplete="off">
            </div>
          </div>
        </div>
        <p class="update_title mt-4">Dental Information of Patient</p>
        <div class="row ">
          <div class="col">
            <div class="mb-3">
              <label for="fullname" class="form-label">Dental Services</label>
              <input class="form-control" name="dental-services" type="text" value="<?php echo $dentalservices; ?>" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="date" class="form-label">Date of Appointment</label>
              <input type="date" name="date" class="form-control" value="<?php echo $date; ?>" autocomplete="off">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="email" class="form-label">Next Appointment</label>
              <input type="form-control" name="next-appointment" class="form-control" value="<?php echo $nextappointment; ?>" autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="formfile" class="form-label">Teeth status</label>
              <input type="file" name="image" class="form-control" id="image" placeholder="Upload your photos">
            </div>
          </div>
        </div>


        <button type="submit" name="update" value="Upload Image" id="update" value="update" class="btn btn-primary mt-4 me-4 float-end">Update</button>
        <a href="../php/patient_lists.php"><button type="submit" name="update" id="update" value="update" class="btn btn-primary mt-4 me-3 float-end">Back</button></a>
      </form>
    </div>
  </div>



  <!-- ===== IONICONS ===== -->
  <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!--===== MAIN JS =====-->
  <script src="../../assets/js/main.js"></script>
</body>

</html>