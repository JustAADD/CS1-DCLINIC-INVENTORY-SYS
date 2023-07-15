<?php

include('../../db-connect/db-con.php');
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
    <div class="row gx-5">
      <div class="col">
        <div class="card" id="cerds">
          <div class="header-table">Upcoming Appointment</div>
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
            </table>
          </div>
        </div>
      </div>
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