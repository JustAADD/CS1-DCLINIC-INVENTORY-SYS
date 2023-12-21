<?php

session_start();
if (isset($_GET['logout'])) {

  // Unset all session variables
  session_unset();

  // Destroy the session
  session_destroy();
  header("Location:../../main.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="image/png" href="../image/dalino_logo.png">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dalino Admin</title>

  <link rel="stylesheet" href="../css/style.css">

  <!-- Boxiocns CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!--Datatables-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body>
  <div class="sidebar close">
    <div class="logo-details">
      <!-- <i class='bx bxl-c-plus-plus'></i> -->
      <img class="admin_logo" src="../image/dalino_logo.png">
      <span class="logo_name">

        <?php
        require '../../connection/connection.php';

        $sql = "SELECT dash_name FROM settings";

        $result = $con->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $fullname = $row['dash_name'];
            echo $fullname;
          }
        } else {
          echo "No data found";
        }

        $con->close(); // Close the database connection
        ?>
      </span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="../php/dashboard.php">
          <i class='bx bx-grid-alt'></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../php/dashboard.php">Dashboard</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="upcoming_appointment.php">
            <i class='bx bx-collection'></i>
            <span class="link_name">Appointment Schedule</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a href="../php/approved_booking.php">Approved</a></li>
          <!-- <li><a href="../php/completed_booking.php">Completed</a></li> -->
          <li><a href="../php/rejected_booking.php">Rejected</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../php/manage_schedule.php">
            <i class='bx bx-calendar'></i>
            <span class="link_name">Manage Schedule</span>
          </a>
          <ul class="sub-menu blank">
            <li><a href="manage_schedule.php">Manage Schedule</a></li>
          </ul>
        </div>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../php/dental_doctors.php">
            <i class='bx bx-plus-medical'></i>
            <span class="link_name">Dental Doctors</span>
          </a>
          <ul class="sub-menu blank">
            <li><a class="link_name" href="../php/dental_doctors.php">Dental Doctors</a></li>
          </ul>
        </div>
      </li>
      <li>
        <a href="../php/patient_lists.php">
          <i class='bx bx-list-check bx-sm'></i>
          <span class="link_name">Patient History</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../php/patient_lists.php">Patient History</a></li>
        </ul>
      </li>
      <li>
        <a href="../php/p_transaction.php">
          <i class='bx bx-credit-card-alt'></i>
          <span class="link_name">Patient Transaction</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../php/transactions.php">Patient Transaction</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../php/Inventory.php">
            <i class='bx bx-collection'></i>
            <span class="link_name">Inventory</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="../php/Inventory.php">Inventory</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../php/sa_feedback.php">
            <i class='bx bx-message-dots'></i>
            <span class="link_name">Feedback</span>
          </a>
        </div>
      </li>
      <li>
        <div class="iocn-link">
          <a href="../php/settings.php">
            <i class='bx bx-cog'></i>
            <span class="link_name">Settings</span>
          </a>

        </div>
      </li>



      <!-- sidebar footer -->
      <li>
        <div class="profile-details">
          <div class="profile-content">
            <img src="
                      <?php
                      require '../../connection/connection.php';

                      $sql = "SELECT imagedata FROM settings"; // Assuming 'imagedata' is the column name

                      $result = $con->query($sql);

                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          $imagedata = $row['imagedata'];
                          echo $imagedata;
                        }
                      } else {
                        echo "No data found";
                      }

                      $con->close(); // Close the database connection
                      ?>" alt="profileImg">
          </div>
          <div class="name-job">
            <div class="profile_name"> <?php
                                        require '../../connection/connection.php';

                                        $sql = "SELECT name FROM settings";

                                        $result = $con->query($sql);

                                        if ($result->num_rows > 0) {
                                          while ($row = $result->fetch_assoc()) {
                                            $name = $row['name'];
                                            echo $name;
                                          }
                                        } else {
                                          echo "No data found";
                                        }

                                        $con->close(); // Close the database connection
                                        ?></div>

          </div>
          <a href="?logout" name="logout" id="logout"><i class='bx bx-log-out'></i></a>
        </div>
      </li>
    </ul>
  </div>


  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
    </div>


    <!--Feedback content-->
    <div class="card" id="feedback-content">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Positive feedback</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Negative feedback</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Neutral Feedback</button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

          <div class="container overflow-hidden">
            <div class="row">
              <div class="col">
                <div class="body-table">
                  <table id="data-table" class="display">
                    <thead class="table-light">
                      <tr>
                        <th scope="col">#</th>

                        <th scope="col">Patient Name</th>
                        <th scope="col">Feedback</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody id="data-table">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


          </div>


        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <div class="container overflow-hidden">
            <div class="row">
              <div class="col">
                <div class="body-table">
                  <table id="data-table2" class="display">
                    <thead class="table-light">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Feedback</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody id="data-table2">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
          <div class="container overflow-hidden">
            <div class="row">
              <div class="col">
                <div class="body-table">
                  <table id="data-table3" class="display">
                    <thead class="table-light">
                      <tr>
                        <th scope="col">#</th>

                        <th scope="col">Patient Name</th>
                        <th scope="col">Feedback</th>
                        <th scope="col">Date</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody id="data-table3">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- javascript -->
    <script src="../js/script.js"></script>

    <!--datatable-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
        var table = $('#data-table').DataTable({
          "columns": [
            null,
            null,
            null,
            null,
            null

          ],
          "columnDefs": [{
            "width": "50%",
            "targets": 2
          }]
        });

        // Function to fetch and update data
        function loadData() {
          $.ajax({
            url: 'sa_feedback_script.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              // Clear the existing data and add the new data
              var dataPositive = data.data;

              table.clear();
              $.each(dataPositive, function(index, row) {
                var deleteButton = '<a href="../php/patient_data.php? deleteid=' + row.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-trash"></i></button></a>&nbsp';

                table.row.add([
                  row.id,
                  row.patient_name,
                  row.comment,
                  row.date,
                  deleteButton
                  // Add more columns as needed
                ]);
              });

              // Draw the table to update the view with new data
              table.draw(false);
            },
            error: function() {
              console.error('Error loading data');
            }
          });
        }

        // Load data initially
        loadData();

        // Refresh data every X milliseconds (e.g., every 5 seconds)
        setInterval(loadData, 5000); // 5000 milliseconds = 5 seconds
      });


      /* second */

      $(document).ready(function() {
        var table = $('#data-table2').DataTable({
          "columns": [
            null,
            null,
            null,
            null,
            null
          ],
          "responsive": true,

        });

        // Function to fetch and update data
        function loadData() {
          $.ajax({
            url: 'sa_feedback_script.php',
            type: 'GET',
            dataType: 'json',
            success: function(data2) {

              var dataNegative = data2.data2;
              // Clear the existing data and add the new data
              table.clear();
              $.each(dataNegative, function(index, row2) {
                var deleteButton = '<a href="../php/patient_data.php?deleteid=' + row2.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-trash"></i></button></a>&nbsp';

                table.row.add([
                  row2.id,
                  row2.patient_name,
                  row2.comment,
                  row2.date,
                  deleteButton
                  // Add more columns as needed
                ]);
              });

              // Draw the table to update the view with new data
              table.draw(false);
            },
            error: function() {
              console.error('Error loading data');
            }
          });
        }

        // Load data initially
        loadData();

        // Refresh data every X milliseconds (e.g., every 5 seconds)
        setInterval(function() {
          loadData(table);
        }, 5000); // 5000 milliseconds = 5 seconds
      });

      /* third */

      $(document).ready(function() {
        var table = $('#data-table3').DataTable({
          "columns": [
            null,
            null,
            null,
            null,
            null
          ],
          "responsive": true,
        });

        // Function to fetch and update data
        function loadData() {
          $.ajax({
            url: 'sa_feedback_script.php',
            type: 'GET',
            dataType: 'json',
            success: function(data3) {

              var dataNeutral = data3.data3;
              // Clear the existing data and add the new data
              table.clear();
              $.each(dataNeutral, function(index, row3) {
                var deleteButton = '<a href="../php/patient_data.php?deleteid=' + row3.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-trash"></i></button></a>&nbsp';

                table.row.add([
                  row3.id,
                  row3.patient_name,
                  row3.comment,
                  row3.date,
                  deleteButton
                  // Add more columns as needed
                ]);
              });

              // Draw the table to update the view with new data
              table.draw(false);
            },
            error: function() {
              console.error('Error loading data');
            }
          });
        }

        // Load data initially
        loadData(table);

        // Refresh data every X milliseconds (e.g., every 5 seconds)
        setInterval(function() {
          loadData(table);
        }, 5000); // 5000 milliseconds = 5 seconds 
      });
    </script>


  </section>



  <!-- javascript -->
  <script src="../js/script.js"></script>
  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>