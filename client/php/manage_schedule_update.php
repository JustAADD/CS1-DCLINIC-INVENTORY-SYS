<?php

require '../../connection/connection.php';

$id = $_GET['updateid'];
// Fetch the doctor's data
$sql = "SELECT * FROM manage_schedule WHERE id =$id";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$slots = $row['slots'];
$date = $row['date'];
$start_time = $row['start_time'];
$end_time = $row['end_time'];
$status = $row['status'];
$duration = $row['duration'];


if (isset($_POST['update'])) {

  $id = $_POST['id'];
  $slots = $_POST['slots'];
  $date = $_POST['date'];
  $start_time = $_POST['start_time'];
  $end_time = $_POST['end_time'];
  $status = $_POST['status'];
  $duration = $_POST['duration'];

  //the query
  $updateQuery = "UPDATE manage_schedule SET id='$id', slots='$slots', date='$date', start_time='$start_time', end_time='$end_time', status='$status', duration='$duration'
  WHERE id = '$id'";
  $result = mysqli_query($con, $updateQuery);

  if ($result) {
    // Update successful
    //  echo "Doctor information updated successfully.";
    header("Location: ../php/manage_schedule.php");
  } else {
    // Update failed
    echo "Error updating schedule: " . $con->error;
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
            <a href="home.php" class="nav__name">Dalino Dental Clinic</a>
          </div>
        </div>

        <div class="nav__menu">
          <ul class="nav__list">
            <li class="nav__item"><a href="#" class="nav__link"></a></li>
            <li class="nav__item"><a href="#services" class="nav__link"></a></li>
            <li class="nav__item"><a href="appointment.php" class="nav__link"></a></li>
            <li class="nav__item"><a href="#about-us" class="nav__link"></a></li>

          </ul>
        </div>

        <div class="nav__social">
          <a href="#" class="nav__social-icon"><ion-icon name="mail-outline"></ion-icon></a>
          <a href="#" class="nav__social-icon"><ion-icon name="logo-facebook"></ion-icon></a>
          <a href="?logout" name="logout" id="logout" class="nav__social-icon"> <ion-icon name="log-out-outline"></ion-icon></a>
        </div>
      </div>

    </nav>

  </header>



  <div class="container mt-5" id="update_container">
    <div class="card" id="update_card">
      <form method="POST" action="">
        <p class="update_title">Update Your Schedule</p>
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Slots</label>
              <input class="form-control" name="slots" type="text" value="<?php echo $slots; ?>" aria-label="default input example">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput2" class="form-label">Date</label>
              <input type="date" name="date" class="form-control" value="<?php echo $date; ?>" id="exampleFormControlInput2">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput3" class="form-label">Start_time</label>
              <input class="form-control" name="start_time" type="time" value="<?php echo $start_time; ?>" aria-label="default input example">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label for="exampleFormControlInput3" class="form-label">End_time</label>
              <input class="form-control" name="end_time" type="time" value="<?php echo $end_time; ?>" aria-label="default input example">
            </div>
            <div class="mb-3">
              <label for="inputGroupSelect01" class="form-label">Select Status</label>
              <select class="form-select" name="status" id="inputGroupSelect01">
                <option value="Open" <?php if ($status === 'Open') echo ' selected'; ?>>Open</option>
                <option value="Closed" <?php if ($status === 'Closed') echo ' selected'; ?>>Closed</option>
                <option value="No Slots" <?php if ($status === 'No Slots') echo ' selected'; ?>>No Slots</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleFormControlInput3" class="form-label">Duration in minutes</label>
              <input class="form-control" name="duration" type="text" value="<?php echo $duration; ?>"" aria-label=" default input example">
            </div>
          </div>
        </div>
        <button type="submit" name="update" id="update" value="update" class="btn btn-primary mt-3">Update Schedule</button>
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