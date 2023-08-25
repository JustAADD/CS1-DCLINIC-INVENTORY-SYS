<?php
require '../../connection/connection.php';

// Initialize variables with default values
$transac_no = '';
$patient_name = '';
$procedures = '';
$session_time = '';
$session_date = '';

if (isset($_GET['receiptid'])) {
  $receipt_id = $_GET['receiptid'];

  $sql = "SELECT * FROM patient_transaction WHERE id = $receipt_id";
  $result = mysqli_query($con, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $status = $row['status'];
    $transac_no = $row['transac_no'];
    $patient_name = $row['patient_name'];
    $name = $row['name'];
    $procedures = $row['procedures'];
    $session_time = $row['session_time'];
    $session_date = $row['session_date'];
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


  <style>
    .receipt {
      margin: 0 auto;
      padding: 0;
      display: flex;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 5rem;
    }

    #card_receipt {
      box-shadow: 0 7px 4px rgba(126, 175, 249, 0.4);
      width: 60%;
      height: 100%;
      padding: 5%;
    }

    .header-title {
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 1rem;
      font-weight: bold;

    }

    .header-tite {
      margin-top: -7px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 1rem;
      font-weight: normal;
    }

    .logo img {

      height: 50px;
      background-color: #3785F9;
      border-radius: 50%;
    }
  </style>
</head>

<body>


  <div class="container">
    <div class="receipt">
      <div class="card" id="card_receipt">
        <div class="logo">
          <div class="row">
            <div class="col">
              <img src="../image/dalino_logo.png" alt="">
            </div>
            <div class="col-8">
              <p class="header-title">APPOINTMENT RECEIPT</p>
              <p class="header-tite">Dalino Dental Clinic</p>
            </div>
            <div class="col">
              <?php
              // Fetch the current date in the default format (Y-m-d)
              $today = date('Y-m-d');

              // You can also fetch the current date and time in a specific format
              $todayFormatted = date('F j, Y'); // Example: "July 24, 2023"

              ?>

              <p class=""> <?php echo "$today"; ?>
            </div>
          </div>

        </div>
        <div class="body mt-5">
          <div class="row">
            <div class="col" style="padding: 10%;">
              <p class="">Transaction No:</p>
              <p class="">Patient Name:</p>
              <p class="">Services:</p>
              <p class="">Time:</p>
              <p class="">Date of Appointment:</p>
            </div>
            <div class="col" style="padding: 10%;">
              <div class="col">
                <p class="" style="font-weight: bold;"><?php echo $transac_no; ?></p>
                <p class=""><?php echo $patient_name; ?></p>
                <p class=""><?php echo $procedures; ?></p>
                <p class=""><?php echo $session_time; ?></p>
                <p class=""><?php echo $session_date; ?></p>
              </div>
            </div>

          </div>
          <button onclick="window.print()" class="btn btn-outline-dark" name="update" style="width: 28%;">Print Receipt</button>
        </div>
      </div>
    </div>
  </div>




  <script>
    function printReceipt() {
      window.print();
    }
  </script>



  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>