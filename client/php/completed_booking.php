<?php
require '../../connection/connection.php';


if (isset($_GET['deleteid'])) {

  $delete_id = $_GET['deleteid'];


  $select_query = "SELECT * FROM appointment_booking WHERE id = '$delete_id'";
  $result = mysqli_query($con, $select_query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);


    $transac_no = $row['transac_no'];
    $status = "Completed";
    $name = $row['name'];
    $patient_name = $row['patient_name'];
    $procedures = $row['procedures'];
    $session_time = $row['session_time'];
    $session_date = $row['session_date'];


    // Insert the data into the 'booking_completed' table
    $insert_query = "INSERT INTO booking_completed (id, transac_no, status, name, patient_name, procedures, session_time, session_date) VALUES 
    ('$id', '$transac_no', '$status', '$name', '$patient_name', '$procedures', '$session_time', '$session_date')";

    $insert_result = mysqli_query($con, $insert_query);

    if ($insert_result) {
      // Now, insert the same data into the 'patient_transaction' table
      $insert_sql = "INSERT INTO patient_transaction (id, transac_no, status, name, patient_name, procedures, session_time, session_date) VALUES 
      ('$id', '$transac_no', '$status', '$name', '$patient_name', '$procedures', '$session_time', '$session_date')";

      $sql_result = mysqli_query($con, $insert_sql);

      if ($sql_result) {

        // Now, delete the record from the 'appointment_booking' table
        $delete_query = "DELETE FROM appointment_booking WHERE id = '$delete_id'";
        $delete_result = mysqli_query($con, $delete_query);

        if ($delete_result) {
          // Record deleted successfully
          header("Location: ../php/upcoming_appointment.php");
          exit();
        } else {

          echo "Error deleting data: " . mysqli_error($con);
        }
      } else {

        echo "Error transferring data to patient_transaction: " . mysqli_error($con);
      }
    } else {

      echo "Error transferring data to booking_completed: " . mysqli_error($con);
    }
  } else {

    echo "Error fetching data from the database or no record found for the given ID.";
  }
}


$con->close();
?>



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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dalino Admin</title>

  <link rel="stylesheet" href="../css/style.css">

  <!-- Boxiocns CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
      <span class="logo_name">Dalino Dental Clinic</span>
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
          <li><a href="../php/completed_booking.php">Completed</a></li>
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
            <img src="../image/dp_admin.jpg" alt="profileImg">
          </div>
          <div class="name-job">
            <div class="profile_name">Mercedita</div>

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

    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card mt-5" id="cerds">
            <div class="header-table">Appointment Completed</div>
            <div class="body-table">
              <table id="data-table" class="display">
                <thead class="table-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Status</th>
                    <th scope="col">Transaction no</th>
                    <th scope="col">Service</th>
                    <th scope="col">Session Time</th>
                    <th scope="col">Session Date</th>
                    <th scope="col">Action</th>
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
          url: 'completedScript.php',
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            // Clear the existing data and add the new data
            table.clear();
            $.each(data, function(index, row) {
              var deleteButton = '<a href="../php/completed_booking_data.php? deleteid=' + row.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa-solid fa-trash"></i></button></a>&nbsp';
              var updateButton = '<a href="../php/booking_receipt.php? receiptid=' + row.id + '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></button></a>';
              var transacLink = '<a href="' + row.transac_no + '">' + row.transac_no + '</a>';
              var transacAndName = `
                   ${transacLink}
                    <br>
                  ${row.patient_name}
              `;

              var statusButton = '<button type="button" class="btn btn-primary" style="background-color:#31b522; width: 8rem; border: none;">' + row.status + '</button>';

              table.row.add([
                row.id,
                statusButton,
                transacAndName,
                row.procedures,
                row.session_time,
                row.session_date,
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


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </script>
</body>

</html>