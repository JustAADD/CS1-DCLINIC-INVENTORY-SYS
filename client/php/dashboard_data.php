<?php

require '../../connection/connection.php';
// $rows = mysqli_query($con, "SELECT * FROM user_registration");
?>

<head>
  <link rel="stylesheet" href="../css/style.css">

  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .total-rows {
      font-weight: bold;
      color: #ffff;
      font-size: 5.5rem;
      margin-top: -20px;
      margin-left: 1rem;
    }

    .title {
      color: #ffff;
      font-size: 1rem;
      margin-top: -30px;
    }

    .centered-row {
      vertical-align: middle;
    }
  </style>


</head>

<body>
  <!-- monitoring -->
  <div class="container" id="dashboard-container">
    <div class="cardBox"></div>
    <div class="row g-0 " id="cards">
      <div class="col g-2" id="col_cards">
        <a href="../php/upcoming_appointment.php" style="text-decoration: none;">
          <div class="card" id="content-card" style=" width: 18rem; height: 11rem; padding: 10%;">
            <div class="row">
              <div class="col" id="column">
                <i class="fa-regular fa-calendar-check fa-5x" style="color: #ffff;"></i>
              </div>
              <div class="col">
                <?php
                $selectQuery = "SELECT COUNT(*) AS total_rows FROM appointment_booking";
                $result = mysqli_query($con, $selectQuery);

                if ($result) {
                  $row = mysqli_fetch_assoc($result);
                  $totalRows = $row['total_rows'];

                  echo '<p class="total-rows"> ' . $totalRows . '</p>';
                } else {
                  echo "ERROR" . mysqli_error($con);
                }

                ?>
              </div>
              <p class="title">Appointment:</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col g-2" id="col_cards">
        <a href="../php/patient_lists.php" style="text-decoration: none;">
          <div class="card" id="content-card" style=" width: 18rem; height: 11rem; padding: 10%;">
            <div class="row">
              <div class="col" id="column">
                <i class="fa-regular fa-address-book fa-5x" style="color: #ffff;"></i>
              </div>
              <div class="col">
                <?php
                $selectQuery = "SELECT COUNT(*) AS total_rows FROM patient_list";
                $result = mysqli_query($con, $selectQuery);

                if ($result) {
                  $row = mysqli_fetch_assoc($result);
                  $totalRows = $row['total_rows'];

                  echo '<p class="total-rows"> ' . $totalRows . '</p>';
                } else {
                  echo "ERROR" . mysqli_error($con);
                }

                ?>
              </div>
              <p class="title">Patient Records:</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col g-2" id="col_cards">
        <a href="../php/Inventory.php" style="text-decoration: none;">
          <div class="card" id="content-card" style=" width: 18rem; height: 11rem; padding: 10%;">
            <div class="row">
              <div class="col" id="column">
                <i class="fa-solid fa-suitcase-medical fa-5x" style="color: #ffff;"></i>
              </div>
              <div class="col">
                <?php
                $selectQuery = "SELECT COUNT(*) AS total_rows FROM inventory";
                $result = mysqli_query($con, $selectQuery);

                if ($result) {
                  $row = mysqli_fetch_assoc($result);
                  $totalRows = $row['total_rows'];

                  echo '<p class="total-rows"> ' . $totalRows . '</p>';
                } else {
                  echo "ERROR" . mysqli_error($con);
                }

                ?>
              </div>
              <p class="title">Supplies:</p>
            </div>
          </div>
        </a>
      </div>
      <div class="col g-2" id="col_cards">
        <a href="../php/p_transaction.php" style="text-decoration: none;">
          <div class="card" id="content-card" style=" width: 18rem; height: 11rem; padding: 10%;">
            <div class="row">
              <div class="col" id="column">
                <i class="fa-solid fa-receipt fa-5x" style="color: #ffff;"></i>
              </div>
              <div class="col">
                <?php
                $selectQuery = "SELECT COUNT(*) AS total_rows FROM patient_transaction";
                $result = mysqli_query($con, $selectQuery);

                if ($result) {
                  $row = mysqli_fetch_assoc($result);
                  $totalRows = $row['total_rows'];

                  echo '<p class="total-rows"> ' . $totalRows . '</p>';
                } else {
                  echo "ERROR" . mysqli_error($con);
                }

                ?>
              </div>
              <p class="title">Transaction Report:</p>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>



  <!-- appointment/session table -->
  <div class=" container overflow-hidden mt-5">
    <div class="row gx-2">
      <div class="col">
        <div class="card" style="height: 70%; border-radius: 20px;">
          <div class="header-table" id="dash_upcoming_app" style="border-top-left-radius: 20px; border-top-right-radius: 20px; ">Upcoming Session
            <a href="../php/upcoming_appointment.php"><button type="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Manage Upcoming Session</button></a>
          </div>
          <div class="body-table">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Status</th>
                  <th scope="col">Transaction no</th>

                  <th scope="col">Services</th>
                  <th scope="col">Session Time</th>
                  <th scope="col">Session Date</th>
                </tr>
              </thead>
              <!-- data -->
              <!-- data -->
              <?php
              $selectquery = "SELECT * FROM appointment_booking ORDER BY ID DESC";
              $result = mysqli_query($con, $selectquery);

              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $status = $row['status'];
                $tr_no = $row['transac_no'];
                $name = $row['name'];
                $patient_name = $row['patient_name'];
                $procedures = $row['procedures'];
                $session_time = $row['session_time'];
                $session_date = $row['session_date'];

                echo '
                <tbody>
                  <tr class="centered-row">
                    <th scope ="row">' . $id . '</td>
                    <td style="width: 5rem;"><button type="button" class="btn btn-primary" style="background-color:#31b522; width: 8rem; border: none;" ><i class="fa-solid fa-gear fa-spin"></i> &nbsp' . $status . '</button></td> 
                    <td><a href="../php/p_transaction.php">' . $tr_no .  '</a> <br>
                     ' . $patient_name . '</td>
                     <td> ' . $procedures . '</td>
                    <td> ' . $session_time . '</td>
                    <td> ' . $session_date . '</td>
                </tbody>
          ';
              }
              ?>
            </table>


          </div>
        </div>
      </div>
      <!-- logs -->
      <div class="col">
        <div class="card" style="height: 70%; border-radius: 20px;">
          <div class="header-table" id="dash_upcoming_app" style="border-top-left-radius: 20px; border-top-right-radius: 20px; padding: 1.7rem;">Logs
          </div>
          <div class="body-table">
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Status</th>
                  <th scope="col">Time Logs</th>
                  <th scope="col">Date Logs</th>
                </tr>
              </thead>
              <!-- data -->
              <!-- data -->
              <?php
              $selectquery = "SELECT * FROM user_logs ORDER BY ID DESC";
              $result = mysqli_query($con, $selectquery);

              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $status = $row['status'];
                $time = $row['time'];
                $date = $row['date'];


                echo '
                <tbody>
                  <tr class="centered-row">
                    <th scope ="row">' . $id . '</td>
                    <td> ' . $name . '</td>
                    <td> ' . $status . '</td>
                    <td> ' . $time . '</td>
                    <td> ' . $date . '</td>
                </tbody>
          ';
              }
              ?>
            </table>


          </div>
        </div>
      </div>



    </div>
  </div>



  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>