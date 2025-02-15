<?php
require 'connection/connection.php';

session_start();
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
}

$mysqli = new mysqli('', 'u530383017_root', 'Ik@wl@ngb0w4', 'u530383017_localhost');
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

  $status = "pending";
  $patient_name = $_POST['patient_name'];
  $selectedProcedure = $_POST['procedures'];
  $currentDate = date('Y-m-d');
  $selectedTimeslot = $_POST['timeslot'];

  $date = $_POST['date'];

  $date_obj = DateTime::createFromFormat('Y-m-d', $date);
  $formatted_date = $date_obj->format('d/m/y l');

  $mysqli = new mysqli('localhost', 'root', '', 'cs1-dclinic-sys');

  // Check for connection errors
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
  }

  //auto generate appointment id
  function generateTR_NO()
  {
    // Generate a random 5-digit number
    $random_number = mt_rand(10000, 99999);

    $tr_no = 'TR-' . $random_number;
    return $tr_no;
  }

  $tr_no = generateTR_NO();

  $stmt = $mysqli->prepare("INSERT INTO appointment_booking (transac_no, status, name, patient_name, procedures,  session_time, session_date) VALUES (?,?,?,?,?,?,?)");

  if (!$stmt) {
    echo "Failed to prepare statement: " . $mysqli->error;
    exit();
  }

  $stmt->bind_param('sssssss', $tr_no, $status, $fullname, $patient_name, $selectedProcedure,  $selectedTimeslot, $formatted_date);
  if ($stmt->execute()) {

    $stmt->close();

    // UPDATE QUERY
    $updateStmt = $mysqli->prepare("UPDATE manage_schedule SET slots = slots - 1, status = CASE WHEN slots <= 1 THEN 'Fully Booked' ELSE status END WHERE date = ?");

    if (!$updateStmt) {
      echo "Error preparing update statement: " . $mysqli->error;
      exit();
    }

    // Bind parameters and execute the update statement
    $updateStmt->bind_param('s', $date);

    if (!$updateStmt->execute()) {
      echo "Error executing update statement: " . $updateStmt->error;
      exit();
    }

    $updateStmt->close();
    $mysqli->close();
    // $msg = "<div class='alert alert-success'>Booking Successful</div>";

    // $_SESSION['status'] = "Your Appointment Booking successfully";
    // $_SESSION['status_code'] = "success";
    header("refresh:0.1;url=gcash_payment.php");
    exit();
  } else {
    echo "Failed to execute statement: " . $stmt->error;

    $stmt->close();
    $mysqli->close();
    exit();
  }
}



// Assume that $userSelectedTimes is an array containing the times already chosen by the user
$userSelectedTimes = array("09:00", "11:00", "14:00"); // Replace this with the actual array

// Function to generate time slots
function generateTimeSlots($start, $end, $interval, $userSelectedTimes)
{
  $current = strtotime($start);
  $end = strtotime($end);

  $timeSlots = array();

  while ($current <= $end) {
    $currentTime = date("H:i", $current);

    // Check if the current time slot is selected by the user
    $isNotAvailable = in_array($currentTime, $userSelectedTimes);

    $timeSlots[] = array(
      'time' => $currentTime,
      'notAvailable' => $isNotAvailable,
    );

    $current = strtotime('+' . $interval . ' minutes', $current);
  }

  return $timeSlots;
}

// Example usage
$start = "09:00";
$end = "17:00";
$interval = 60; // minutes

$allTimeSlots = generateTimeSlots($start, $end, $interval, $userSelectedTimes);
?>

<!-- Display time slots -->
<div class="form-group">
  <div class="button-row">
    <?php foreach ($allTimeSlots as $counter => $timeSlot) : ?>
      <?php if ($counter % 3 === 0) : ?>
        <div class="row">
        <?php endif; ?>

        <div class="col-md-4">
          <input type="radio" class="btn-check" name="timeslot" value="<?php echo $timeSlot['time']; ?>" id="radio<?php echo $counter; ?>" autocomplete="off" <?php echo $timeSlot['notAvailable'] ? 'disabled' : ''; ?>>
          <label class="btn btn-radio-ts <?php echo $timeSlot['notAvailable'] ? 'disabled-label' : ''; ?>" for="radio<?php echo $counter; ?>"><?php echo $timeSlot['time']; ?></label>
        </div>

        <?php if ($counter % 3 === 2 || $counter === count($allTimeSlots) - 1) : ?>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>
?>


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
        <p>Choose Dental Services</p>
        <form action="app-set-sched.php" method="POST">

          <input type="hidden" name="date" value="<?php echo $date; ?>">

          <div class="d-flex services-btn mb-4" style="justify-content: center; align-items: center;">
            <input type="radio" class="btn-check" name="procedures" value="Dental Checkups" id="option1" autocomplete="off">
            <label class="btn btn-radio me-3" style=" justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Dental Checkups" for="option1">Dental Checkups</label>

            <input type="radio" class="btn-check" name="procedures" value="Oral Prophylaxis" id="option2" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Oral Prophylaxis" for="option2">Oral Prophylaxis</label>

            <input type="radio" class="btn-check" name="procedures" value="Dental Fillings" id="option3" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Dental Fillings" for="option3">Dental Fillings</label>

            <input type="radio" class="btn-check" name="procedures" value="Teeth Cleaning" id="option4" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Teeth Cleaning" for="option4">Teeth Cleaning</label>

            <input type="radio" class="btn-check" name="procedures" value="Tooth Extraction" id="option5" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Tooth Extraction" for="option5">Tooth Extraction</label>
          </div>

          <div class="d-flex services-btn mb-4" style="justify-content: center; align-items: center;">
            <input type="radio" class="btn-check" name="procedures" value="Tooth Restoration" id="option6" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Tooth Restoration" for="option6">Tooth Restoration</label>

            <input type="radio" class="btn-check" name="procedures" value="Orthodontics" id="option7" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Orthodontics" for="option7">Orthodontics</label>

            <input type="radio" class="btn-check" name="procedures" value="Dental X-rays" id="option8" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Dental X-rays" for="option8">Dental X-rays</label>

            <input type="radio" class="btn-check" name="procedures" value="Teeth Whitening" id="option9" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Teeth Whitening" for="option9">Teeth Whitening</label>

            <input type="radio" class="btn-check" name="procedures" value="Root Canal Treatment" id="option10" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Root Canal Treatment" for="option10">Root Canal Treatment</label>
          </div>

          <p>Choose Dental Prosthesis</p>
          <div class="d-flex services-btn mb-4" style="justify-content: center; align-items: center;">
            <input type="radio" class="btn-check" name="procedures" value="Removable Partial Dentures" id="option11" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Removable Partial Dentures" for="option11">Removable Partial Dentures</label>

            <input type="radio" class="btn-check" name="procedures" value="Complete Partial Dentures" id="option12" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Complete Partial Dentures" for="option12">Complete Partial Dentures</label>

            <input type="radio" class="btn-check" name="procedures" value="Flexible Partial Dentures" id="option13" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Flexible Partial Dentures" for="option13">Flexible Partial Dentures</label>

            <input type="radio" class="btn-check" name="procedures" value="Acrylic Partial Dentures" id="option14" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Acrylic Partial Dentures" for="option14">Acrylic Partial Dentures</label>
          </div>

          <p>Choose Dentures</p>
          <div class="d-flex services-btn mb-4" style="justify-content: center; align-items: center;">
            <input type="radio" class="btn-check" name="procedures" value="Dental Crowns" id="option15" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Dental Crowns" for="option15">Dental Crowns</label>

            <input type="radio" class="btn-check" name="procedures" value="Dental Implants" id="option16" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Dental Implants" for="option16">Dental Implants</label>

            <input type="radio" class="btn-check" name="procedures" value="Dental Bridges" id="option17" autocomplete="off">
            <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Dental Bridges" for="option17">Dental Bridges</label>
          </div>





          <div class="row">
            <div class="col" id="ts1">
              <p class="timeslots">Fill up for our info</p>
              <div class="mb-4 mt-3">
                <label for="exampleInputEmail1" class="form-label m">Fullname</label>
                <input type="text" class="form-control" name="patient_name" id="exampleInputEmail1" placeholder="Your Fullname" aria-describedby="default input example">
              </div>
              <p class="" style="font-size:smaller;">Dalino Dental Clinic kindly informs you that there is a <br> Placement fee: 80php
                for the appointment reservations.</p>
            </div>


            <div class="col" id="ts2">
              <p class="timeslots">Timeslots</p>
              <p>Choose Convenient Time</p>
              <?php


              require 'connection\connection.php';

              if (isset($_GET['date'])) {
                $date = $_GET['date'];

                $sql = "SELECT start_time, end_time FROM manage_schedule WHERE date = '$date';";
                $result = $con->query($sql);

                // Check if the query was successful and fetch the values
                if ($result && $result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $start = $row['start_time'];
                  $end = $row['end_time'];
                } else {
                  // Handle the case where no data is found in the database or any other error
                  echo "Error fetching data from the database: " . $con->error;
                }

                $duration = 60;
                $cleanup = 0;
                // $start = "09:00";
                // $end = "17:00";

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

                  while ($start < $end) {

                    $slots[] = convertTo12HourFormat($start->format("H:i"));
                    $start->add($interval)->add($cleanupInterval);
                  }

                  // for ($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)) {
                  //   $sendPeriod = clone $intStart;
                  //   $sendPeriod->add($interval);
                  //   if ($sendPeriod > $end) {
                  //     break;
                  //   }
                  //   $slots[] = convertTo12HourFormat($intStart->format("H:i")) . "-" . convertTo12HourFormat($sendPeriod->format("H:i"));
                  //   // $slots[] = $intStart->format("H:iA") . "-" . $sendPeriod->format("H:iA");
                  // }

                  return $slots;
                }

                $timeslots = timeslots($duration, $cleanup, $start, $end);
              }
              ?>

              <?php

              // foreach ($timeslots as $ts) {
              // 
              ?>


              <?php  ?>

              <?php if (!empty($timeslots)) : ?>
                <div class="form-group">
                  <div class="button-row">
                    <?php foreach ($timeslots as $counter => $ts) : ?>
                      <?php if ($counter % 3 === 0) : ?>
                        <div class="row">
                        <?php endif; ?>
                        <div class="col-md-4">
                          <input type="radio" class="btn-check" name="timeslot" value="<?php echo $ts; ?>" id="radio<?php echo $counter; ?>" autocomplete="off">
                          <label class="btn btn-radio-ts" for="radio<?php echo $counter; ?>"><?php echo $ts; ?></label>
                        </div>
                        <?php if ($counter % 3 === 2 || $counter === count($timeslots) - 1) : ?>
                        </div>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php else : ?>
                <p>No time slots available for the selected date.</p>
              <?php endif; ?>

              <!-- <div class="form-group">
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
              </div> -->


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