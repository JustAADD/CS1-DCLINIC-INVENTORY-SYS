<?php

require '../../connection/connection.php';

$id = $_GET['updateid'];
// Fetch the doctor's data
$sql = "SELECT * FROM inventory WHERE id =$id";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$inv_id = $row['inv_id'];
$imagedata = $row['imagedata'];
$name = $row['name'];
$stocks = $row['stocks'];
$class = $row['class'];
$date = $row['date'];

if (isset($_POST['update'])) {

  $name = $_POST['name'];
  $stocks = $_POST['stocks'];
  $class = $_POST['class'];

  // Prepare and execute the update query
  $updateQuery = "UPDATE inventory SET id='$id', imagedata='$imagedata', name='$name', stocks='$stocks', class='$class'
  WHERE id = '$id'";
  $result = mysqli_query($con, $updateQuery);

  if ($result) {
    // Update successful
    //  echo "Doctor information updated successfully.";
    header("Location: ../php/Inventory.php");
  } else {
    // Update failed
    echo "Error updating Inventory information: " . $con->error;
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
  <link rel="stylesheet" href="../css/style.css">
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
    <div class="card" id="inventory_update_card">
      <form method="POST" action="">
        <p class="update_title mt-5">Update Supplies & Equipment Inventory</p>
        <table class="table">
          <tr>
            <th scope="col">#</th>
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Stocks</th>
            <th scope="col">Class</th>
          </tr>
          <tr class="centered-row">
            <th scope="row"><?php echo $inv_id; ?></th>
            <td>
              <div class="imagesrc" name="imagedata" style="height:100px; width:100px;">
                <?php echo '  <img src="' . $row['imagedata']  . '"/>'; ?>
              </div>
            </td>
            <td>
              <div class="name">
                <input type="text" name="name" class="form-control" value=" <?php echo $name; ?>">
              </div>
            </td>
            <td>
              <div class="name">
                <input type="text" name="stocks" class="form-control" value=" <?php echo $stocks; ?>">
              </div>
            </td>
            <td>
              <div class="name">
                <input type="text" name="class" class="form-control" value=" <?php echo $class; ?>">
              </div>
            </td>
          </tr>
        </table>
        <button type="submit" name="update" id="inv_button_update" value="update" class="btn btn-primary mt-3">Update</button>
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