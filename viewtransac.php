<?php
session_start();
include './connection/connection.php';



if (isset($_SESSION['email'])) {
  // User is already signed in, continue with the rest of your home.php code
  $email = $_SESSION['email'];
}

$mysqli = new mysqli('localhost', 'root', '', 'cs1-dclinic-sys');
$stmt = $mysqli->prepare("SELECT fullname FROM user_registration WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

// Bind the result to a variable
$stmt->bind_result($fullname);

// Fetch the result
if ($stmt->fetch()) {
  // Fullname is retrieved from the database
  // Store it in the session variable
  $_SESSION['fullname'] = $fullname;
} else {
  echo "Error fetching fullname: " . $stmt->error;
}


$stmt->close();
$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shorcut icon" href="./assets/image/dalino_logo.png">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Your Transactions</title>

  <style>
    .section {
      margin: 0 auto;
      padding: 5rem;
      width: auto;

    }

    .body {
      overflow-y: auto;
      max-height: 70vh;
    }

    .card {

      box-sizing: border-box;
      margin: 0 auto;

      box-shadow: 0 0 15px rgba(0, 0, 0, 0.08);
      border: 10px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      width: 90%;
      height: auto;
      box-sizing: border-box;
    }

    .btn {
      width: 8rem;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="section">
      <div class="card">
        <div class="card-body">
          <p class="fw-bolder">Your Transactions</p>

          <div class="body">
            <table class="table table-hover">
              <thead>
                <tr>

                  <th scope="col">Status</th>
                  <th scope="col">Transaction no</th>
                  <th scope="col">Services</th>
                  <th scope="col">Session Time</th>
                  <th scope="col">Session Date</th>

                </tr>
              </thead>

              <!-- data -->
              <?php
              $fullname = $_SESSION['fullname'];

              $selectquery = "SELECT * FROM booking_approved WHERE name = '$fullname' ORDER BY ID DESC";

              $result = mysqli_query($con, $selectquery);

              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $status = $row['status'];
                $transac_no = $row['transac_no'];
                $name = $row['name'];
                $procedures = $row['selectedProcedures'];
                $session_time = $row['session_time'];
                $session_date = $row['date'];

                echo '
          <tbody>
                  <tr class="centered-row">
                    
                    <td style="width: 9rem;"><button type="button" class="btn btn-primary" style="background-color:#31b522; width: 8rem; border: none;" >' . $status . '</button></td>
                    <td><a href="../php/p_transaction.php">' . $transac_no .  '</a> <br>
                    ' . $name .  '</td>
                    <td> ' . $procedures . '</td>
                    <td> ' . $session_time . '</td>
                    <td> ' . $session_date . '</td>
                  
                    </tbody>
               
          ';
              }

              $con->close();
              ?>

            </table>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="./home.php"><button class="btn btn-primary me-md-2" type="button">Back</button></a>
            </div>
          </div>


          <!--  -->

          <p class="fw-bolder">Your Transactions</p>

          <div class="body">
            <table class="table table-hover">
              <thead>
                <tr>

                  <th scope="col">Status</th>
                  <th scope="col">Transaction no</th>
                  <th scope="col">Services</th>
                  <th scope="col">Session Time</th>
                  <th scope="col">Session Date</th>

                </tr>
              </thead>

              <!-- data -->
              <?php
              $fullname = $_SESSION['fullname'];

              $selectquery = "SELECT * FROM booking_approved WHERE name = '$fullname' ORDER BY ID DESC";

              $result = mysqli_query($con, $selectquery);

              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $status = $row['status'];
                $transac_no = $row['transac_no'];
                $name = $row['name'];
                $procedures = $row['selectedProcedures'];
                $session_time = $row['session_time'];
                $session_date = $row['date'];

                echo '
          <tbody>
                  <tr class="centered-row">
                    
                    <td style="width: 9rem;"><button type="button" class="btn btn-primary" style="background-color:#31b522; width: 8rem; border: none;" >' . $status . '</button></td>
                    <td><a href="../php/p_transaction.php">' . $transac_no .  '</a> <br>
                    ' . $name .  '</td>
                    <td> ' . $procedures . '</td>
                    <td> ' . $session_time . '</td>
                    <td> ' . $session_date . '</td>
                  
                    </tbody>
               
          ';
              }

              $con->close();
              ?>

            </table>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <a href="./home.php"><button class="btn btn-primary me-md-2" type="button">Back</button></a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
  </script>

</body>

</html>