<?php
session_start();
require 'connection/connection.php';

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

  if (empty($_POST['selectedProcedures']) || empty($_POST['timeslot']) || empty($_POST['patient_name'])) {
    $_SESSION['status'] = "Please complete your appointment form!";
    header("Location: main.php");
    exit();
  }

  $status = "pending";
  $patient_name = $_POST['patient_name'];
  // $selectedProcedure = $_POST['procedures'];
  $currentDate = date('Y-m-d');
  $selectedTimeslot = $_POST['timeslot'];

  $date = $_POST['date'];

  // $date_obj = DateTime::createFromFormat('Y-m-d', $date);
  // $formatted_date = $date_obj->format('d/m/y l');

  $mysqli = new mysqli('', 'u530383017_root', 'Ik@wl@ngb0w4', 'u530383017_localhost');

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
    // $msg = "<div class='alert alert-success'>Booking Successful</div>";

    // $_SESSION['status'] = "Your Appointment Booking successfully";
    // $_SESSION['status_code'] = "success";
    // header("refresh:0.1;url=gcash_payment.php");
    header("refresh:0.1;url=appointment_final.php");
    exit();
  } else {
    echo "Failed to execute statement: " . $stmt->error;

    $stmt->close();
    $mysqli->close();
    exit();
  }
}

if (!isset($_SESSION['email'])) {

  header("Location: main.php");
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
      <div class="card" id="cardform" style="margin-top: 7rem; margin-bottom: 4rem;">

        <?php
        if (isset($_SESSION['back'])) {

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
              } else {
                
              }
            });
          </script>";

          unset($_SESSION['back']);
        }
        ?>

        <p class="card-form-text-title" style="margin-left: 2.2rem;">Dental Services <span style="font-size: 13px; color:#808080;">(This is our available services)</span></p>
        <form action="appointment_schedule.php" method="POST">
          <input type="hidden" name="date" value="<?php echo $date; ?>">

          <div class="row gx-5" id="rows" style="margin-left: 12px;">
            <div class="col-md-4 mb-3">
              <p class="service-title">Retainer</p>
              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Invisible/clear" id="option1" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3 " style="height: 4.5rem;" value="Invisible/clear" for="option1">Invisible/clear</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Hawley" id="option2" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3 " style="justify-content: center; align-items: center; height: 4.5rem; text-align: center;" value="Hawley" for="option2">Hawley</label>

              <p class="service-title">Orthodontic Treatment</p>
              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Conventional" id="option3" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3  " style="height: 4.5rem;" value="Conventional" for="option3">Conventional</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Ceramic" id="option4" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3  " style="justify-content: center; align-items: center; height: 4.5rem; text-align: center;" value="Ceramic" for="option4">Ceramic</label>

              <p class="service-title">Restorative Services | Tooth Extraction</p>
              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Composite Restoration per Surface" id="option10" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center;  height: 4.5rem; text-align: center;" value="Composite Restoration per Surface" for="option10">Composite Restoration </label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Tooth Extraction" id="option11" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center;  height: 4.5rem; text-align: center;" value="Tooth Extraction" for="option11">Tooth Extraction</label>

              <p class="service-title">Veneers</p>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Direct Composite" id="option15" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3 " style="height: 4.5rem; " value="Direct Composite" for="option15">Direct Composite </label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Emax" id="option16" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3 " style=" height: 4.5rem;" value="Emax" for="option16">Emax</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Zirconia" id="option17" autocomplete="off">
              <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 4.5rem; text-align: center;" value="Zirconia" for="option17">Zirconia</label>

            </div>
            <div class="col-md-4 mb-3">
              <p class="service-title">Teeth Whitening / Consultation</p>
              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="In-Office" id="option5" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 4.5rem; text-align: center;" value="In-Office" for="option5">In-Office</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Consultation" id="option6" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 4.5rem; text-align: center;" value="Consultation" for="option6">Consultation</label>

              <p class="service-title">Periodontal Treatment | Odontotomy</p>
              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Periodontal Treatment Per Quadrant" id="option12" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center;  height: 4.5rem; text-align: center;" value="Periodontal Treatment Per Quadrant" for="option12">Periodontal Treatment </label>
              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Odontotomy" id="option13" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center;  height: 4.5rem; text-align: center;" value="Odontotomy" for="option13">Odontotomy</label>

              <p class="service-title">Preventive Services</p>
              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Oral Prophylaxis Cleaning" id="option7" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 4.5rem; text-align: center;" value="Oral Prophylaxis Cleaning" for="option7">Oral Prophylaxis Cleaning</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Fluoride Treatment" id="option8" autocomplete="off">
              <label class="btn btn-radio me-3 mb-3" style="justify-content: center; align-items: center; height: 4.5rem; text-align: center;" value="Fluoride Treatment" for="option8">Fluoride Treatment</label>

              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Pit and Fissure Sealant" id="option9" autocomplete="off">
              <label class="btn btn-radio me-3" style="justify-content: center; align-items: center; height: 4.5rem; text-align: center;" value="Pit and Fissure Sealant" for="option9">Pit and Fissure Sealant</label>
            </div>

            <div class="col-md-4" id="ts2">
              <p class="service-title">Any Surgery with Bone Reduction</p>
              <input type="checkbox" class="btn-check" name="selectedProcedures[]" value="Surgery with bone reduction" id="option14" autocomplete="off">
              <label class="btn btn-radio me-3" style="justify-content: center; align-items: center;  height: 4.5rem; text-align: center;" value="Surgery with bone reduction" for="option14">Fee 10,000 – 15,000</label>

              <!--Choose Timee-->

              <p class="timeslots mt-4">Timeslots</p>

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
                    // $currentTime = date("H:i:s", $current);
                    $currentTime = date("g:i A", $current);

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
                  <label for="timeslot">Select a timeslot:</label>
                  <select class="form-select mt-3" id="timeslot" name="timeslot">
                    <?php foreach ($allTimeSlots as $counter => $timeSlot) : ?>
                      <?php
                      $isNotAvailable = $timeSlot['notAvailable'];
                      $disabledAttribute = $isNotAvailable ? 'disabled' : '';
                      $disabledClass = $isNotAvailable ? 'disabled-label' : '';
                      ?>
                      <!-- Debugging: Output the content of $timeSlot -->
                      <!-- <?php var_dump($timeSlot); ?> -->

                      <option value="<?php echo $timeSlot['time']; ?>" <?php echo $disabledAttribute; ?>><?php echo $timeSlot['time']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>



              <?php else : ?>
                <p>No time slots available for the selected date.</p>
              <?php endif; ?>


              <p class="timeslots mt-3">Fill up for our info</p>


              <p class="text" style="font-size:smaller;"><span>Option:</span>&nbsp Please confirm whether you intend to use the name above; if not, kindly provide an alternative name.</p>
              <div class="mb-4 mt-3">
                <!-- <label for="exampleInputEmail1" class="form-label m">Patient name: </label> -->
                <input type="text" class="form-control" name="patient_name" id="exampleInputEmail1" placeholder="Patient name" aria-describedby="default input example">
              </div>
              <p class="" style="font-size:smaller;">The prices of services may vary depending on the patient's case and the required treatment; therefore, several services offer fixed prices.
              </p>

              <div class="row">
                <div class="col text-end mt-5">
                  <button type="submit" name="back" id="app-back" class="btn btn-primary">Back</button>
                  <button type="submit" name="submit" id="app-submit" class="btn btn-primary me-2">Proceed</button>
                </div>
              </div>

            </div>
        </form>
      </div>
    </div>
  </section>

  <div class="footer">

    <div class="owner">
      <p> ® Dalino Dental Clinic</p>
    </div>

  </div>


  <!-- sweet alert -->
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>

</html>