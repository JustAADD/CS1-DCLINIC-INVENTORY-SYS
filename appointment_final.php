<?php
session_start();
require 'connection/connection.php';

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
  // $_SESSION['back'] = "Are you sure you want to cancel your appointment?";
  // $_SESSION['back_code'] = "warning";
  header("Location: appointment_schedule.php");
}


if (!isset($_SESSION['email'])) {

  header("Location: main.php");
}

function createNextPayPaymentLink($amount, $redirect_url)
{
  $nonce = bin2hex(random_bytes(16));

  $req_body = [
    'title' => "Payment for the charged fee",
    'amount' => $amount,
    'currency' => "PHP",
    'description' => "Payment for the services charged fee",
    'private_notes' => "Make sure to wait after successful payment",
    'limit' => 0,
    'redirect_url' => $redirect_url,
    'nonce' => $nonce,
  ];

  $client_id = "ck_sandbox_vxkm6bii9xqvqz8wxsdwwcig";
  $client_secret = "qexjhp4if77zi6zaivh5e9m6";

  $url = 'https://api-sandbox.nextpay.world/v2/paymentlinks';

  $request_body_json = json_encode($req_body, JSON_UNESCAPED_SLASHES);
  $signature = hash_hmac('sha256', $request_body_json, $client_secret);

  $headers = [
    'Content-Type: application/json',
    'client-id: ' . $client_id,
    'signature: ' . $signature,
  ];

  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $request_body_json,
    CURLOPT_HTTPHEADER => $headers,
  ]);

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    return ["error" => "cURL Error: " . $err];
  } else {
    $data = json_decode($response, true);
    return $data;
  }
}
if (isset($_POST['proceed'])) {

  $fullname = $_SESSION['fullname'];

  $selectedPaymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : '';


  $selectQuery = "SELECT * FROM appointment_booking WHERE name = ?";
  $stmt = mysqli_prepare($con, $selectQuery);
  mysqli_stmt_bind_param($stmt, "s", $fullname);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($result) {
    // Fetch the first row since we only need one set of data
    $row = mysqli_fetch_assoc($result);
    $transac = $row['transac_no'];
    $status = $row['status'];
    $name = $row['name'];
    $patient_name = $row['patient_name'];
    $selectedProcedures = $row['selectedProcedures'];
    $session_time = $row['session_time'];
    $session_date = $row['date'];

    // Check the selected payment method and update $paymentStatus accordingly
    if ($selectedPaymentMethod === 'gcash-api') {
      $paymentStatus = 'paid';
      // Create payment link
      $amount = 50;
      $redirect_url = 'http://localhost/cs1-dclinic-inventory-sys/appointment.php';
      $paymentLinkData = createNextPayPaymentLink($amount, $redirect_url);

      if (isset($paymentLinkData['error'])) {
        echo "Error creating payment link: " . $paymentLinkData['error'];
      } else {
        // Successfully created payment link
        $url = $paymentLinkData['url'];
        // Redirect to the NextPay API URL
        header("Location: " . $url);
        // echo "Data transferred successfully!";
      }
    } elseif ($selectedPaymentMethod === 'counter') {
      $paymentStatus = 'not paid';
      $redirect_url = 'http://localhost/cs1-dclinic-inventory-sys/appointment.php';
      // Redirect to the specified URL
      header("Location: " . $redirect_url);
      // echo "Data transferred successfully!";
    } else {
      // Handle the case of an invalid payment method (if necessary)
      echo "Invalid payment method selected.";
    }

    // Insert data into app_final_process table
    $insertQuery = "INSERT INTO app_final_process (transac_no, status, name, patient_name, selectedProcedures, payment, session_time, date) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $insertStmt = mysqli_prepare($con, $insertQuery);
    mysqli_stmt_bind_param($insertStmt, "ssssssss", $transac, $status, $name, $patient_name, $selectedProcedures, $paymentStatus, $session_time, $session_date);

    // Execute the SQL query
    if (!mysqli_stmt_execute($insertStmt)) {
      echo "Error in query execution: " . mysqli_stmt_error($insertStmt);
    }

    mysqli_stmt_close($insertStmt);
    mysqli_close($con);
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
      <div class="card" id="finalform">

        <form method="POST" action="appointment_final.php">
          <table class="table">
            <thead table-light>
              <tr>
                <th colspan="col" class="payment-process">Payment Process</th>
              </tr>
              <tr>
                <th colspan="col" class="payment-process-description">Your Appointment Details</th>
              </tr>
              <tr>
                <th scope="col" class="payment-process-description">Patient name</th>
                <th scope="col" class="payment-process-description">Transaction no</th>
                <th scope="col" class="payment-process-description">Services</th>
                <th scope="col" class="payment-process-description">Time</th>
                <th scope="col" class="payment-process-description">Date</th>
              </tr>
            </thead>
            <tbody>


              <?php
              require 'connection/connection.php';

              $fullname = $_SESSION['fullname'];

              // Use placeholders to prevent SQL injection
              $selectQuery = "SELECT * FROM appointment_booking WHERE name = ?";
              $stmt = mysqli_prepare($con, $selectQuery);
              mysqli_stmt_bind_param($stmt, "s", $fullname);
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);

              if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $transac = $row['transac_no'];
                  $patient_name = $row['patient_name'];
                  $selectedProcedures = $row['selectedProcedures'];
                  $session_time = $row['session_time'];
                  $session_date = $row['date'];
                }
              } else {
                echo "Error in query: " . mysqli_error($con);
              }

              mysqli_close($con);
              ?>

              <td><?php echo $fullname; ?></td>


              <td><?php echo $transac; ?></td>


              <td><?php echo $selectedProcedures; ?></td>


              <td><?php echo $session_time ?></td>


              <td><?php echo $session_date ?></td>

            </tbody>
          </table>

          <p class="payment-process-description" style="margin-top: 5rem;"> we accept payment:</p>
          <p class="payment-process-description">The prices of services may vary depending on the patient's case and the
            required treatment; therefore, several services offer fixed prices.
            Booking an appointment includes a placement fee, which will enable the transaction to be processed smoothly
            and effectively.</p>

          <div class="btn-group" role="group" id="btn-payment-group">
            <input type="radio" id="gcash-api" name="paymentMethod" class="btn-check" value="gcash-api" autocomplete="off">
            <label class="btn btn-lg btn-primary me-2" for="gcash-api">
              <img src="./imagedata/gcash.png" alt="Gcash Logo" class="gcash-logo"> Gcash Payment
            </label>

            <input type="radio" id="counter" name="paymentMethod" class="btn-check" value="counter" autocomplete="off">
            <label class="btn btn-lg btn-primary" for="counter">Over the counter</label>
          </div>

          <div class="col text-end" style="margin-right:2rem; margin-top: 4rem;">
            <button type="submit" name="back" id="form-back" class="btn btn-primary">Back</button>
            <button type="submit" name="proceed" id="form-submit" class="btn btn-primary me-2">Set appointment</button>
          </div>
        </form>
      </div>
    </div>
  </section>


  <!-- sweet alert -->
  <script src="./assets/js/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
  </script>

</body>

</html>