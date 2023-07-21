<?php
require 'connection/connection.php';

session_start();
if (isset($_SESSION['email'])) {
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
}

$stmt->close();
$mysqli->close();

if (isset($_GET['date'])) {
  $date = $_GET['date'];
}


if (isset($_POST['back'])) {
  $_SESSION['back'] = "Are you sure you want to cancel your appointment?";
  $_SESSION['back_code'] = "warning";
}




if (isset($_POST['submit'])) {

  $email = $_POST['email'];
  $selectedProcedure = $_POST['procedures'];
  $pnumber = $_POST['phone_number'];
  // $name = "essy";
  $currentDate = date('Y-m-d');
  $messages = $_POST['messages'];
  $selectedTimeslot = $_POST['timeslot'];

  $date = $_POST['date'];

  $mysqli = new mysqli('localhost', 'root', '', 'cs1-dclinic-sys');

  // Check for connection errors
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    // Handle the error appropriately (e.g., show an error message)
    exit();
  }


  $stmt = $mysqli->prepare("INSERT INTO appointment_booking (patient_id, name, procedures, email, pnumber, message,  session_time, session_date) VALUES (?,?,?,?,?,?,?,?)");

  // Check if the statement preparation was successful
  if (!$stmt) {
    echo "Failed to prepare statement: " . $mysqli->error;
    // Handle the error appropriately (e.g., show an error message)
    exit();
  }

  // Generate the patient ID
  function generatePatientID()
  {
    $prefix = 'PT-ID';
    $unique_id = uniqid();
    $patient_id = $prefix . $unique_id;
    return $patient_id;
  }

  $patient_id = generatePatientID();

  // Bind the parameters and execute the statement
  $stmt->bind_param('ssssssss', $patient_id,  $fullname, $selectedProcedure, $email, $pnumber, $messages,  $selectedTimeslot, $date);
  if ($stmt->execute()) {

    // $msg = "<div class='alert alert-success'>Booking Successful</div>";

    $_SESSION['status'] = "Your Appointment Booking successfully";
    $_SESSION['status_code'] = "success";
    header("refresh:0.1;url=appointment.php");
  } else {
    echo "Failed to execute statement: " . $stmt->error;
    // Handle the error appropriately (e.g., show an error message)
  }

  // Close the statement and the database connection
  $stmt->close();
  $mysqli->close();
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title></title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="assets/css//style.css">
  <!-- SweetAlert 2 library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./assets/js/sweetalert.min.js"></script>

</head>

<body>

  <section>
    <div class="container-fluid">
      <!-- header -->
      <?php include 'app-header.php'; ?>

      <div class="spacing" style="padding-top: 9%;"></div>
      <!-- form card -->
      <div class="card" id="card-form">

        <?php
        if (isset($_SESSION['back'])) {

          // Display the SweetAlert confirmation pop-up
          echo "<script>
            Swal.fire({
              title: 'Cancel Appointment?',
              text: 'Are you sure you want to cancel your appointment?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes, cancel it!',
              cancelButtonText: 'No, go back',
            }).then((result) => {
              if (result.isConfirmed) {
               
                window.location.href = 'appointment.php';
              }
            });
          </script>";

          unset($_SESSION['back']);
        }
        ?>

        <!-- hello user -->
        <p class="card-form-text">Dental Appointment</p>
        <!-- Choose procedures -->
        <p>Choose Services</p>
        <form action="app-set-sched.php" method="POST">

          <input type="hidden" name="date" value="<?php echo $date; ?>">

          <div class="services-btn mb-4">
            <input type="radio" class="btn-check" name="procedures" value="Teeth Control" id="option1" autocomplete="off">
            <label class="btn btn-radio me-3" style="height: 5rem; padding: 1.7rem;" value="Consultation" for="option1">Consultation</label>

            <input type="radio" class="btn-check" name="procedures" value="Intervation" id="option2" autocomplete="off">
            <label class="btn btn-radio me-3" style="height: 5rem; padding: 1.7rem;" value="Cleaning" for="option2">Cleaning</label>

            <input type="radio" class="btn-check" name="procedures" value="dressing" id="option3" autocomplete="off">
            <label class="btn btn-radio me-3" style="height: 5rem; padding-top: 1.7rem;" value="Oral Prophylaxis" for="option3">Oral Prophylaxis</label>

            <input type="radio" class="btn-check" name="procedures" value="consultation" id="option4" autocomplete="off">
            <label class="btn btn-radio me-3" style="height: 5rem; padding-top: 1.7rem;" value="Teeth Whitening" for="option4">Teeth Whitening</label>

            <input type="radio" class="btn-check" name="procedures" value="consultation" id="option5" autocomplete="off">
            <label class="btn btn-radio me-3" style="height: 5rem; padding-top: 1.2rem;" value="Tooth Restoration" for="option5">Tooth Restoration</label>
            <br>
            <input type="radio" class="btn-check" name="procedures" value="consultation" id="option6" autocomplete="off">
            <label class="btn btn-radio me-3 mt-3" style="height: 5rem; padding-top: 1.7rem;" value="Tooth Extraction<" for="option6">Tooth Extraction</label>

            <input type="radio" class="btn-check" name="procedures" value="consultation" id="option7" autocomplete="off">
            <label class="btn btn-radio me-3 mt-3" style="height: 5rem; padding: 1.7rem;" value="Braces" for="option7">Braces</label>

            <input type="radio" class="btn-check" name="procedures" value="consultation" id="option8" autocomplete="off">
            <label class="btn btn-radio me-3 mt-3" style="height: 5rem; padding-top: 1.7rem;" value="Dental Prothesis" for="option8">Dental Prothesis</label>

            <input type="radio" class="btn-check" name="procedures" value="consultation" id="option9" autocomplete="off">
            <label class="btn btn-radio me-3 mt-3" style="height: 5rem; padding-top: 1.2rem;" value="Crowns & Bridges" for="option9">Crowns & Bridges</label>

            <input type="radio" class="btn-check" name="procedures" value="consultation" id="option10" autocomplete="off">
            <label class="btn btn-radio me-3 mt-3" style="height: 5rem; padding-top: 1.2rem;" value="Crowns & Bridges" for="option10">Crowns & Bridges</label>
          </div>

          <div class="row">
            <div class="col" id="ts1">
              <p class="timeslots">Fill up for our info</p>
              <div class="mb-3 mt-3">
                <label for="exampleInputEmail1" class="form-label m">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Your Email Address" aria-describedby="emailHelp">
              </div>
              <div class="mb-3 mt-3">
                <label for="text" class="form-label m">Phone number</label>
                <input type="text" class="form-control" name="phone_number" id="text" placeholder="Your Phone Number" aria-label="default input example">
              </div>
              <div class="mb-3 mt-3">
                <label for="text" class="form-label m">Get in touch</label>
                <input type="text" class="form-control" name="messages" id="text" placeholder="Leave a message" aria-label="default input example">
              </div>
            </div>


            <div class="col" id="ts2">
              <p class="timeslots">Timeslots</p>
              <p>Choose Convenient Time</p>
              <?php


              require 'connection\connection.php';

              $sql = "SELECT manage_start_time, manage_end_time FROM manage_date_time";
              $result = $con->query($sql);

              // Check if the query was successful and fetch the values
              if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $start = $row['manage_start_time'];
                $end = $row['manage_end_time'];
              } else {
                // Handle the case where no data is found in the database or any other error
                echo "Error fetching data from the database: " . $con->error;
              }

              $duration = 60;
              $cleanup = 0;
              $start = "09:00";
              $end = "17:00";

              function convertTo12HourFormat($time)
              {
                return date("g:iA", strtotime($time));
              }

              function timeslots($duration, $cleanup, $start, $end)
              {
                $start = new DateTime($start);
                $end = new DateTime($end);
                $interval = new DateInterval("PT" . $duration . "M");
                $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
                $slots = array();

                for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
                  $sendPeriod = clone $intStart;
                  $sendPeriod->add($interval);
                  if ($sendPeriod > $end) {
                    break;
                  }
                  $slots[] = convertTo12HourFormat($intStart->format("H:i")) . "-" . convertTo12HourFormat($sendPeriod->format("H:i"));
                  // $slots[] = $intStart->format("H:iA") . "-" . $sendPeriod->format("H:iA");
                }

                return $slots;
              }
              ?>

              <?php $timeslots = timeslots($duration, $cleanup, $start, $end);
              foreach ($timeslots as $ts) {
              ?>


              <?php } ?>

              <div class="form-group">
                <div class="button-row">
                  <?php
                  $counter = 0; // Counter to keep track of the number of buttons
                  foreach ($timeslots as $ts) {
                    // Open a new row every third button
                    if ($counter % 3 === 0) {
                      echo '<div class="row">';
                    }
                    echo '<div class="col-md-4">';
                    // echo '<button class="btn btn-success">' . $ts . '</button>';
                    echo '<input type="radio" class="btn-check" name="timeslot" value="' . $ts . '" id="radio' . $counter . '" autocomplete="off">';
                    echo '<label class="btn btn-radio-ts" for="radio' . $counter . '">' . $ts . '</label>';
                    echo '</div>';
                    // Close the row every third button
                    if ($counter % 3 === 2) {
                      echo '</div>';
                    }
                    $counter++;
                  }
                  // Close the row if the number of buttons is not a multiple of three
                  if ($counter % 3 !== 0) {
                    echo '</div>';
                  }
                  ?>
                </div>
              </div>


            </div>
            <div class="appointment-submit">
              <button type="submit" name="submit" id="app-submit" class="btn btn-primary mt-5">Set Appointment</button>
              <button type="submit" name="back" id="app-back" class="btn btn-primary mt-5 ms-2">back</button></a>
            </div>

        </form>

      </div>
    </div>
    </div>
  </section>
  <div class="spacing" style="padding-top: 9%;"></div>

  <!-- sweet alert -->
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>