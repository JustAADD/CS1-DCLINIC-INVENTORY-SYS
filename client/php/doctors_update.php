<?php

require '../../connection/connection.php';

$id = $_GET['updateid'];
// Fetch the doctor's data
$sql = "SELECT * FROM dental_doctors WHERE id =$id";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$doctors_id = $row['doctors_id'];
$fullname = $row['doctors_name'];
$email = $row['email'];
$contact = $row['contact'];
$specialties = $row['specialties'];

if (isset($_POST['update'])) {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $specialties = $_POST['specialties'];

  // Initialize the statement outside the loop
  $stmt = $con->prepare("SELECT imagedata FROM dental_doctors WHERE id = ?");
  if (!$stmt) {
    echo "Failed to prepare statement: " . $con->error;
    exit();
  }

  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->bind_result($existingImagedata);
  $stmt->fetch();
  $stmt->close();

  $newImagedata = $existingImagedata; // Initialize with existing data
  foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
    $target_dir = "../imagedata/";
    $target_file = $target_dir . uniqid() . '_' . basename($_FILES['image']['name'][$key]);

    if (move_uploaded_file($_FILES['image']['tmp_name'][$key], $target_file)) {
      // Append the new file name to the existing imagedata
      $newImagedata .= ',' . $target_file;
    } else {
      echo "Failed to move uploaded file.";
    }
  }

  // Update the database with the new imagedata
  $stmt = $con->prepare("UPDATE dental_doctors SET doctors_name = ?, email = ?, contact = ?, specialties = ?, imagedata = ? WHERE id = ?");
  if (!$stmt) {
    echo "Failed to prepare statement: " . $con->error;
    exit();
  }

  $stmt->bind_param("sssssi", $fullname, $email, $contact, $specialties, $newImagedata, $id);

  if (!$stmt->execute()) {
    echo "Failed to execute statement: " . $stmt->error;
    exit();
  }

  $stmt->close();
  $con->close();

  header("Location: ../php/dental_doctors.php");
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
    <a href="../php/dental_doctors.php" class="header__logo">Dalino Dental Clinic</a>

    <ion-icon name="menu-outline" class="header__toggle" id="nav-toggle"></ion-icon>

    <nav class="nav" id="nav-menu">
      <div class="bd-grid" id="nav__content">
        <ion-icon name="close-outline" class="nav__close" id="nav-close"></ion-icon>

        <div class="nav__perfil">
          <div class="nav__img">
            <img src="../../assets/image/dalino_logo.png" alt="">
          </div>

          <div>
            <a href="../php/dental_doctors.php" class="nav__name">Dalino Dental Clinic</a>
          </div>
        </div>

        <!-- <div class="nav__menu">
          <ul class="nav__list">
            <li class="nav__item"><a href="#" class="nav__link"></a></li>
            <li class="nav__item"><a href="#services" class="nav__link"></a></li>
            <li class="nav__item"><a href="appointment.php" class="nav__link"></a></li>
            <li class="nav__item"><a href="#about-us" class="nav__link"></a></li>

          </ul>
        </div> -->


        <!-- <div class="nav__social">
          <a href="#" class="nav__social-icon"><ion-icon name="mail-outline"></ion-icon></a>
          <a href="#" class="nav__social-icon"><ion-icon name="logo-facebook"></ion-icon></a>
          <a href="?logout" name="logout" id="logout" class="nav__social-icon"> <ion-icon name="log-out-outline"></ion-icon></a>
        </div> -->
      </div>

    </nav>

  </header>



  <div class="container mt-5" id="update_container">
    <div class="card" id="update_card" style="height: 50%;">
      <form method="POST" action="" enctype="multipart/form-data">
        <p class="update_title mt-2">Update Dental Doctors Information</p>
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <label for="fullname" class="form-label">Fullname</label>
              <input class="form-control" name="fullname" type="text" value="<?php echo $fullname; ?>" aria-label="default input example">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="contact" class="form-label">Contact Number</label>
              <input class="form-control" name="contact" type="text" value="<?php echo $contact; ?>" aria-label="default input example">
            </div>
            <div class="mb-3">
              <label for="specialties" class="form-label">Specialties</label>
              <input class="form-control" name="specialties" type="text" value="<?php echo $specialties; ?>" aria-label="default input example">
            </div>
          </div>
          <p class="update_title mt-3">Doctor's documents</p>
          <div class="input-group mb-3">
            <input type="file" name="image[]" class="form-control" id="image" placeholder="Upload your photos" multiple>
            <label class="input-group-text" for="formfile">Upload</label>
          </div>
          <p class="fw-light" style="font-size: small;">Note: Adding Document: This is the soft copy of doctor's requirements for backup purposes.</p>
        </div>

        <button type="submit" name="update" id="update" value="Upload Image" class="btn btn-primary mt-3">Update</button>
      </form>
    </div>
  </div>



  <!-- ===== IONICONS ===== -->
  <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>

  <!--===== MAIN JS =====-->
  <script src="../../assets/js/main.js"></script>
</body>

</html>