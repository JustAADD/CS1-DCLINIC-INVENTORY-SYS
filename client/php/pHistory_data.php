<?php

include('/xampp/htdocs/cs1-dclinic-inventory-sys/db-connect/db-con.php');
// $rows = mysqli_query($con, "SELECT * FROM user_registration");
?>

<head>

  <link rel="stylesheet" href="../css/style.css">

  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

  <!-- appointment/session table -->
  <div class="container overflow-hidden mt-5">
    <div class="row">
      <div class="col">
        <div class="card" id="cerds">
          <div class="header-table">Patient History</div>
          <div class="body-table">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Patient ID</th>
                  <th scope="col">Patient Name</th>
                  <th scope="col">Session</th>
                  <th scope="col">Dental Doctor</th>
                  <th scope="col">Prescription</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
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