<?php

session_start();
if (isset($_GET['logout'])) {

  session_unset();

  session_destroy();
  header("Location:../../main.php");
  exit();
}


require '../../connection/connection.php';



// ADD QUERY DOCTORS
if (isset($_POST["add_transaction"])) {
  $transactionNo = $_POST["transactionNo"];
  $patient_name = $_POST["patient_name"];
  $status = $_POST["status"];
  $procedures = $_POST["selectedProcedures"];
  $name = "admin";
  $desired_date_time = '20/07/2023 10:23 AM';
  $date_time_obj = DateTime::createFromFormat('d/m/Y h:i A', $desired_date_time);

  //auto generate transaction number
  function generateTR_NO()
  {

    $random_number = mt_rand(10000, 99999);

    $tr_no = 'TR-' . $random_number;
    return $tr_no;
  }

  $tr_no = generateTR_NO();

  $formatted_date_time = $date_time_obj->format('Y-m-d H:i:s');

  $formatted_date = $date_time_obj->format('Y-m-d');

  $formatted_time = $date_time_obj->format('h:i A');

  $sql = "INSERT INTO patient_transaction (transac_no, status, name, patient_name, selectedProcedures, session_time, session_date)
  VALUES ('$transactionNo', '$status','$name', '$patient_name', '$procedures', '$formatted_time', '$formatted_date')";


  if ($con->query($sql) === TRUE) {
    header("Location: ../php/p_transaction.php");
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }

  $con->close();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dalino Admin</title>

  <link rel="stylesheet" href="../css/style.css">
  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!--Datatables-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <!-- Boxiocns CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="sidebar close">
    <div class="logo-details">
      <!-- <i class='bx bxl-c-plus-plus'></i> -->
      <img class="admin_logo" src="../image/dalino_logo.png">
      <span class="logo_name"> <?php
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
                                ?></span>
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

    <!--  real time data -->
    <script type="text/javascript" src="../js/autoload.js"></script>

    <div class="home-content">
      <i class='bx bx-menu'></i>
    </div>

    <div class="container overflow-hidden mt-5">
      <div class="row">
        <div class="col">
          <div class="card" id="cerds">
            <div class="header-table" id="button_patient_transaction">Patient Transaction
              <button type="btn" name="add_patient" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Add Patient Transaction</button>
            </div>
          </div>


          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form method="POST" action="">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Patient Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Transaction no</label>
                      <input class="form-control" name="transactionNo" type="text" placeholder="Transaction no:" aria-label="default input example">
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Patient name</label>
                      <input class="form-control" name="patient_name" type="text" placeholder="Patient name:" aria-label="default input example">
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Procedures</label>
                      <input class="form-control" name="procedures" type="text" placeholder="Status:" aria-label="default input example">
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Payment</label>
                      <input class="form-control" name="status" type="text" placeholder="Status:" aria-label="default input example">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="add_transaction" class="btn btn-primary" style="background:#3785F9; border: none;">Add Patient Transaction</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="body-table">
            <table id="data-table" class="display">
              <thead class="table-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Transaction no</th>
                  <th scope="col">Services</th>
                  <th scope="col">Payment</th>
                  <th scope="col">Time</th>
                  <th scope="col">Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="data-table"></tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </section>

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
          null,
          null,
          null

        ]
      });

      // Function to fetch and update data
      function loadData() {
        $.ajax({
          url: 'p_transactionScript.php',
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            // Clear the existing data and add the new data
            table.clear();
            $.each(data, function(index, row) {
              var deleteButton = '<a href="../php/p_transaction_data.php? deleteid=' + row.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-trash"></i></button></a>&nbsp';
              var updateButton = '<a href="../php/p_transaction_receipt.php? receiptid=' + row.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></button></a>';
              var timeDate = row.session_time + ' - ' + row.date;
              var transacLink = '<a href="p_transaction_receipt.php' + row.transac_no + '">' + row.transac_no + '</a>';

              var transacAndName = `
                   ${transacLink}
                    <br>
                  ${row.patient_name}
              `;
              var paymentButton = '<button type="button" class="btn btn-primary" style="background-color:#31b522; width: 8rem; border: none;">' + row.payment + '</button>';



              table.row.add([
                row.id,
                transacAndName,
                row.selectedProcedures,
                paymentButton,
                row.session_time,
                row.date,
                deleteButton + updateButton
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
  </script>
  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>