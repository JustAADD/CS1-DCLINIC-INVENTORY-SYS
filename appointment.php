<?php
require_once 'app-header.php';


include 'app-data.php';
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointment Schedule</title>


  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Stylesheets css -->
  <link rel="stylesheet" href="assets\css\style.css">

  <style>
    @media only screen and (max-width: 760px),
    (min-device-width: 802px) and (max-device-width: 1020px) {

      /* Force table to not be like tables anymore */
      table,
      thead,
      tbody,
      th,
      td,
      tr {
        display: block;

      }

      .headered {
        font-size: small;
      }


      .empty {
        display: none;
      }

      /* Hide table headers (but not display: none;, for accessibility) */
      th {
        position: absolute;
        top: -9999px;
        left: -9999px;
      }

      tr {
        border: 1px solid #ccc;
      }

      td {
        /* Behave  like a "row" */
        border: none;
        border-bottom: 1px solid #eee;
        position: relative;
        padding-left: 50%;
      }



      /*
		Label the data
		*/
      td:nth-of-type(1):before {
        content: "Sunday";
      }

      td:nth-of-type(2):before {
        content: "Monday";
      }

      td:nth-of-type(3):before {
        content: "Tuesday";
      }

      td:nth-of-type(4):before {
        content: "Wednesday";
      }

      td:nth-of-type(5):before {
        content: "Thursday";
      }

      td:nth-of-type(6):before {
        content: "Friday";
      }

      td:nth-of-type(7):before {
        content: "Saturday";
      }


    }

    /* Smartphones (portrait and landscape) ----------- */

    @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
      body {
        padding: 0;
        margin: 0;
      }
    }

    /* iPads (portrait and landscape) ----------- */

    @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
      body {
        width: 495px;
      }
    }

    @media (min-width:641px) {
      table {
        table-layout: fixed;
      }

      td {
        width: 33%;
      }
    }

    .row {
      margin-top: 20px;
    }

    .today {
      background: yellow;
    }
  </style>

</head>

<body>

  <section>
    <div class="banner">

    </div>
  </section>

  <!-- appointment -->
  <div class="container-fluid">
    <section class="app">
      <div class="row g-3">
        <div class="col" id="apps" style="margin: 0 auto; display:flex; justify-content:center; align-items:center;">
          <div class="card" id="cardcalendar" style="width: 70rem; padding: 2%; border-radius: 50px; border-color:#D2E3FC; box-shadow: 0 8px 8px rgba(100, 150, 200, 0.3);">
            <!-- calendar -->
            <?php
            $dateComponents = getdate();
            if (isset($_GET['month']) && isset($_GET['year'])) {
              $month = $_GET['month'];
              $year = $_GET['year'];
            } else {
              $month = $dateComponents['mon'];
              $year = $dateComponents['year'];
            }
            echo build_calendar($month, $year);
            ?>
          </div>
        </div>
      </div>
    </section>
  </div>





  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>