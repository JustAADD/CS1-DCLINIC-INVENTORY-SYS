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

  $status = "pending";
  $patient_name = $_POST['patient_name'];
  // $selectedProcedure = $_POST['procedures'];
  $currentDate = date('Y-m-d');
  $selectedTimeslot = $_POST['timeslot'];

  $date = $_POST['date'];

  // $date_obj = DateTime::createFromFormat('Y-m-d', $date);
  // $formatted_date = $date_obj->format('d/m/y l');

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

  $stmt = $mysqli->prepare("INSERT INTO appointment_booking (transac_no, status, name, patient_name, selectedProcedures, session_time, date) VALUES (?,?,?,?,?,?,?)");

  if (!$stmt) {
    echo "Failed to prepare statement: " . $mysqli->error;
    exit();
  }

  $selectedProcedures = implode(',', $_POST['selectedProcedures']);

  $stmt->bind_param('sssssss', $tr_no, $status, $fullname, $patient_name, $selectedProcedures,  $selectedTimeslot, $date);
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
    $msg = "<div class='alert alert-success'>Booking Successful</div>";

    $_SESSION['status'] = "Your Appointment Booking successfully";
    $_SESSION['status_code'] = "success";
    // header("refresh:0.1;url=gcash_payment.php");
    header("refresh:0.1;url=appointment.php");
    exit();
  } else {
    echo "Failed to execute statement: " . $stmt->error;

    $stmt->close();
    $mysqli->close();
    exit();
  }
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

  <?php include 'app-header.php'; ?>

</head>

<body>
  <section>
    <div class="container-fluid d-flex justify-content-center align-items-center">



      <div class="card" id="cardform" style="margin-top: 6rem;">

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

        <p class="card-form-text" style="margin-left: 2.2rem;">Dental Services <span style="font-size: 13px; color:#808080;">(This is our available services)</span></p>
        <form action="appointment_schedule.php" method="POST">
          <input type="hidden" name="date" value="<?php echo $date; ?>">
          <div class="row gx-5" style="margin-left: 12px;">
            <div class="col-md-4 mb-3">
              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Dental Checkups" id="option1" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style=" justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Dental Checkups" for="option1">Dental Checkups</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Oral Prophylaxis" id="option2" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Oral Prophylaxis" for="option2">Oral Prophylaxis</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Dental Fillings" id="option3" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Dental Fillings" for="option3">Dental Fillings</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Teeth Cleaning" id="option4" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Teeth Cleaning" for="option4">Teeth Cleaning</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Tooth Extraction" id="option5" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Tooth Extraction" for="option5">Tooth Extraction</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Tooth Restoration" id="option6" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Tooth Restoration" for="option6">Tooth Restoration</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Orthodontics" id="option7" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Orthodontics" for="option7">Orthodontics</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Dental X-rays" id="option8" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Dental X-rays" for="option8">Dental X-rays</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Teeth Whitening" id="option9" autocomplete="off">
              <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Teeth Whitening" for="option9">Teeth Whitening</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Root Canal Treatment" id="option10" autocomplete="off">
              <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Root Canal Treatment" for="option10">Root Canal Treatment</label>

            </div>


            <div class="col-md-4 mb-3">

              <p class="card-form-text">Dental Prosthesis</p>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Removable Partial Dentures" id="option11" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Removable Partial Dentures" for="option11">Removable Partial Dentures</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Complete Partial Dentures" id="option12" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Complete Partial Dentures" for="option12">Complete Partial Dentures</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Flexible Partial Dentures" id="option13" autocomplete="off">
              <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Flexible Partial Dentures" for="option13">Flexible Partial Dentures</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Acrylic Partial Dentures" id="option14" autocomplete="off">
              <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Acrylic Partial Dentures" for="option14">Acrylic Partial Dentures</label>

              <p class="card-form-text mt-3">Dentures</p>


              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Dental Crowns" id="option15" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Dental Crowns" for="option15">Dental Crowns</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Dental Implants" id="option16" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Dental Implants" for="option16">Dental Implants</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Dental Bridges" id="option17" autocomplete="off">
              <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 5rem; text-align: center;" value="Dental Bridges" for="option17">Dental Bridges</label>

            </div>

            <!--Choose Timee-->
            <div class="col-md-3 mb-3" id="ts2">
              <p class="timeslots">Timeslots</p>
              <p>Choose Convenient Time</p>

              <?php

              require 'connection\connection.php';

              if (isset($_GET['date'])) {
                $date = $_GET['date'];

                // echo "Input Date: $date<br>";

                $sql = "SELECT session_time FROM appointment_booking WHERE date = ?;";
                $stmt = $con->prepare($sql);

                $stmt->bind_param("s", $date);
                $stmt->execute();
                $result = $stmt->get_result();

                $selectedTimeSlots = [];

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $selectedTimeSlots[] = $row['session_time'];
                  }
                }
                // // Debugging statement
                // echo "Selected Time Slots from Database: " . implode(', ', $selectedTimeSlots) . "<br>";
                // var_dump($selectedTimeSlots);


                $sql = "SELECT start_time, end_time FROM manage_schedule WHERE date = ?;";
                $stmt = $con->prepare($sql);

                $stmt->bind_param("s", $date);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result && $result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $start = $row['start_time'];
                  $end = $row['end_time'];
                } else if ($stmt->error) {
                  echo "Error: " . $stmt->error;
                }

                function generateTimeSlots($start, $end, $interval, $selectedTimeSlots)
                {
                  $current = strtotime($start);
                  $end = strtotime($end);

                  $timeSlots = array();

                  while ($current <= $end) {
                    $currentTime = date("H:i:s", $current);

                    // Check if the current time slot is selected by the user
                    $isNotAvailable = in_array($currentTime, $selectedTimeSlots);

                    $timeSlots[] = array(
                      'time' => $currentTime,
                      'notAvailable' => $isNotAvailable,
                    );

                    $current = strtotime('+' . $interval . ' minutes', $current);
                  }

                  return $timeSlots;
                }

                // Example usage
                $interval = 60; // minutes
                $allTimeSlots = generateTimeSlots($start, $end, $interval, $selectedTimeSlots);
              }
              ?>

              <?php
              $selectedTimeSlots = isset($selectedTimeSlots) ? $selectedTimeSlots : [];

              if (!empty($allTimeSlots)) :
              ?>

                <div class="form-group">
                  <div class="button-row">
                    <?php foreach ($allTimeSlots as $counter => $timeSlot) : ?>
                      <?php if ($counter % 3 === 0) : ?>
                        <div class="row">
                        <?php endif; ?>

                        <div class="col-md-4">
                          <?php
                          $isNotAvailable = $timeSlot['notAvailable'];
                          $disabledAttribute = $isNotAvailable ? 'disabled' : '';
                          $disabledClass = $isNotAvailable ? 'disabled-label' : '';
                          ?>
                          <input type="radio" class="btn-check" name="timeslot" value="<?php echo $timeSlot['time']; ?>" id="radio<?php echo $counter; ?>" autocomplete="off" <?php echo $disabledAttribute; ?>>
                          <label class="btn btn-radio-ts <?php echo $disabledClass; ?>" for="radio<?php echo $counter; ?>"><?php echo $timeSlot['time']; ?></label>
                        </div>

                        <?php if ($counter % 3 === 2 || $counter === count($allTimeSlots) - 1) : ?>
                        </div>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </div>
                </div>

              <?php else : ?>
                <p>No time slots available for the selected date.</p>
              <?php endif; ?>


              <p class="timeslots mt-3">Fill up for our info</p>


              <div class=" mt-3 mb-3"><span>Name:</span> 000
              </div>
              <p class="" style="font-size:smaller;"><span>Option:</span>&nbsp Please confirm whether you intend to use the name above; if not, kindly provide an alternative name.</p>
              <div class="mb-4 mt-3">
                <!-- <label for="exampleInputEmail1" class="form-label m">Patient name:  </label> -->
                <input type="text" class="form-control" name="patient_name" id="exampleInputEmail1" placeholder="Patient name" aria-describedby="default input example">
              </div>
              <!-- <p class="" style="font-size:smaller;">Dalino Dental Clinic kindly informs you that there is a <br> Placement fee: 80php
              for the appointment reservations.</p> -->
              <div class="row">
                <div class="col-md-6">
                  <button type="submit" name="submit" id="app-submit" class="btn btn-primary mt-5 me-5">Set Appointment</button>
                </div>
                <div class="col-md-6">
                  <button type="submit" name="back" id="app-back" class="btn btn-primary mt-5">Back</button>
                </div>
              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- sweet alert -->
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>

</html>