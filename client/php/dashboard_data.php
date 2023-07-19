<?php

require '../../connection/connection.php';
// $rows = mysqli_query($con, "SELECT * FROM user_registration");
?>

<head>

  <link rel="stylesheet" href="../css/style.css">

  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <!-- monitoring -->
  <div class="container" id="dashboard-container">
    <div class="cardBox"></div>
    <div class="row g-0 " id="cards">
      <div class="col g-2" id="col_cards">
        <div class="card" id="content-card" style=" width: 18rem; height: 15rem;"></div>
      </div>
      <div class="col g-2" id="col_cards">
        <div class="card" id="content-card" style=" width: 18rem; height: 15rem;"></div>
      </div>
      <div class="col g-2" id="col_cards">
        <div class="card" id="content-card" style=" width: 18rem; height: 15rem;"></div>
      </div>
      <div class="col g-2" id="col_cards">
        <div class="card" id="content-card" style=" width: 18rem; height: 15rem;"></div>
      </div>
    </div>
  </div>
  </div>

  <!-- appointment/session table -->
  <div class="container overflow-hidden mt-5">
    <div class="row gx-2">
      <div class="col">
        <div class="card" id="cerds">
          <div class="header-table">Upcoming Session</div>
          <div class="body-table">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Appointment ID</th>
                  <th scope="col">Patient Name</th>
                  <th scope="col">Services</th>
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
                $patient_id = $row['patient_id'];
                $name = $row['name'];
                $procedures = $row['procedures'];
                $email = $row['email'];
                $pnumber = $row['pnumber'];
                $message = $row['message'];
                $session_time = $row['session_time'];
                $session_date = $row['session_date'];

                echo '
                <tbody>
                  <tr class="centered-row">
                    <th scope ="row">' . $patient_id . '</td>
                    <td>' . $name .  '</td>
                    <td><button type="button" class="btn btn-primary" style="background-color:#31b522; width: 10rem; border: none;" >' . $procedures . '</button></td> 
                    <td> ' . $session_date . '</td>
                </tbody>
          ';
              }
              ?>
            </table>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card" id="cerds">
          <div class="header-table">Help Desk</div>
          <div class="body-table">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Appointment ID</th>
                  <th scope="col">Patient Name</th>
                  <th scope="col">Services</th>
                  <th scope="col">Appointment Date</th>
                </tr>
              </thead>
              <!-- data -->
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>