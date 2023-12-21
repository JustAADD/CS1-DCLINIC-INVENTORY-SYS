<?php
session_start();
require '../../connection/connection.php';



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
  // echo "Error fetching fullname: " . $stmt->error;
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
    body {
      overflow: hidden;
      margin: 0 auto;
      padding: 0;
    }

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
          <p class="fw-bolder">Overall Records</p>

          <div class="body">

            <p class="fw-bolder">The Appointment records</p>
            <table class="table table-hover">
              <thead>
                <tr>

                  <th scope="col">Patient name</th>

                  <th scope="col">Services</th>
                  <th scope="col">Payment</th>
                  <th scope="col">Session Time</th>
                  <th scope="col">Session Date</th>

                </tr>
              </thead>
              <tbody>
                <!-- data -->
                <?php
                $fullname = $_SESSION['fullname'];

                $selectQuery = "SELECT * FROM app_final_process ORDER BY ID DESC";

                $result = mysqli_query($con, $selectQuery);

                while ($row = mysqli_fetch_assoc($result)) {
                  $transac = $row['transac_no'];
                  $patient_name = $row['patient_name'];
                  $selectedProcedures = $row['selectedProcedures'];
                  $payment = $row['payment'];
                  $session_time = $row['session_time'];
                  $session_date = $row['date'];

                  echo '
          <tbody>
                  <tr class="centered-row">

                   <td><a href="../php/p_transaction.php">' . $transac .  '</a> <br>
                    ' . $patient_name .  '</td>
                    <td> ' . $selectedProcedures . '</td>
                    <td> ' . $payment . '</td>
                    <td> ' . $session_time . '</td>
                    <td> ' . $session_date . '</td>
                  
                    </tbody>
               
          ';
                }


                ?>

              </tbody>


            </table>

            <!-- The patient records -->

            <p class="fw-bolder mt-">The Patient records</p>
            <table class="table table-hover">
              <thead>
                <tr>

                  <th scope="col">#</th>

                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Contact</th>
                  <th scope="col">Gender</th>

                </tr>
              </thead>
              <tbody>
                <!-- data -->
                <?php
                $fullname = $_SESSION['fullname'];

                $selectQuery1 = "SELECT * FROM patient_list ORDER BY ID DESC";

                $result = mysqli_query($con, $selectQuery1);

                while ($row = mysqli_fetch_assoc($result)) {
                  $patient_id = $row['patient_id'];
                  $patient_name = $row['patient_name'];
                  $email = $row['email'];
                  $contact = $row['contact'];
                  $gender = $row['gender'];
                  $services = $row['dental_services'];
                  $session_date = $row['date'];

                  echo '
          <tbody>
                  <tr class="centered-row">

                    <td> ' . $patient_id . '</td>
                    <td> ' . $patient_name . '</td>
                    <td> ' . $email . '</td>
                    <td> ' . $contact . '</td>
                    <td> ' . $gender . '</td>
                  
                    </tbody>
               
          ';
                }


                ?>

              </tbody>


            </table>


            <!-- The inventory records -->

            <p class="fw-bolder mt-">The inventory records</p>
            <table class="table table-hover">
              <thead>
                <tr>

                  <th scope="col">#</th>

                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Contact</th>
                  <th scope="col">Gender</th>

                </tr>
              </thead>
              <tbody>
                <!-- data -->
                <?php
                $fullname = $_SESSION['fullname'];

                $selectQuery1 = "SELECT * FROM patient_list ORDER BY ID DESC";

                $result = mysqli_query($con, $selectQuery1);

                while ($row = mysqli_fetch_assoc($result)) {
                  $patient_id = $row['patient_id'];
                  $patient_name = $row['patient_name'];
                  $email = $row['email'];
                  $contact = $row['contact'];
                  $gender = $row['gender'];
                  $services = $row['dental_services'];
                  $session_date = $row['date'];

                  echo '
          <tbody>
                  <tr class="centered-row">

                    <td> ' . $patient_id . '</td>
                    <td> ' . $patient_name . '</td>
                    <td> ' . $email . '</td>
                    <td> ' . $contact . '</td>
                    <td> ' . $gender . '</td>
                  
                    </tbody>
               
          ';
                }


                ?>

              </tbody>
            </table>

            <!-- The transaction -->

            <p class="fw-bolder mt-">The inventory records</p>
            <table class="table table-hover">
              <thead>
                <tr>

                  <th scope="col">#</th>

                  <th scope="col">Name</th>
                  <th scope="col">Services</th>
                  <th scope="col">Payment</th>
                  <th scope="col">Date</th>

                </tr>
              </thead>
              <tbody>
                <!-- data -->
                <?php
                $fullname = $_SESSION['fullname'];

                $selectQuery1 = "SELECT * FROM patient_transaction ORDER BY ID DESC";

                $result = mysqli_query($con, $selectQuery1);

                while ($row = mysqli_fetch_assoc($result)) {
                  $transac = $row['transac_no'];
                  $name = $row['patient_name'];
                  $procedures = $row['selectedProcedures'];
                  $payment = $row['payment'];
                  $session_date = $row['date'];

                  echo '
          <tbody>
                  <tr class="centered-row">

                    <td> ' . $transac . '</td>
                    <td> ' . $name . '</td>
                    <td> ' . $procedures . '</td>
                    <td> ' . $payment . '</td>
                    <td> ' . $session_date . '</td>
                  
                    </tbody>
               
          ';
                }

                $con->close();
                ?>

              </tbody>


            </table>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <a href="../php/settings.php"><button class="btn btn-primary me-md-2" type="button">Back</button></a>
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