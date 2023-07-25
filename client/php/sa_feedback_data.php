<?php

require '../../connection/connection.php';

// $rows = mysqli_query($con, "SELECT * FROM user_registration");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- ===== css ===== -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
  <section class="feedback mt-5" data-aos="fade-down" data-aos-offset="300" data-aos-easing="ease-in-sine">
    <div class="container-fluid">
      <div class="row g-0 mb-4">
        <div class="col-md-8" style="padding-top: 0.5rem">
          <h3 class="feedback-title"> Let's see our patients Feedback! </h3>
        </div>
        <div class="col-6 col-md-4">
          <a href="feedback.php" class="btn-get-feedback me-3">Send Feedback!</a>
        </div>
      </div>
      <div class="card-container" id="feedback-card">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner" id="inner" style="background-color: transparent;">
            <div class="carousel-item active" data-bs-interval="10000">
              <p><?php
                  require '../../connection/connection.php';

                  $selectQuery = "SELECT feedback, patient_name FROM positive_feedback WHERE id = '5'";
                  $result = mysqli_query($con, $selectQuery);

                  while ($row = mysqli_fetch_assoc($result)) {
                    $feedback = $row['feedback'];
                    $patient_name = $row['patient_name'];


                    echo "$feedback <br><br>
                    - $patient_name";
                  }
                  mysqli_close($con);
                  ?>
              </p>
            </div>
            <div class="carousel-item" data-bs-interval="10000">
              <p><?php
                  require '../../connection/connection.php';

                  $selectQuery = "SELECT feedback, patient_name FROM positive_feedback  WHERE id = '6'";
                  $result = mysqli_query($con, $selectQuery);

                  while ($row = mysqli_fetch_assoc($result)) {
                    $feedback = $row['feedback'];
                    $patient_name = $row['patient_name'];

                    echo "$feedback <br><br>
                    - $patient_name";
                  }
                  mysqli_close($con);
                  ?>
              </p>
            </div>
            <div class="carousel-item " data-bs-interval="20000">
              <p><?php
                  require '../../connection/connection.php';

                  $selectQuery = "SELECT feedback, patient_name FROM positive_feedback WHERE id = '7'";
                  $result = mysqli_query($con, $selectQuery);

                  while ($row = mysqli_fetch_assoc($result)) {
                    $feedback = $row['feedback'];
                    $patient_name = $row['patient_name'];

                    echo "$feedback <br> <br>
                     - $patient_name";
                  }
                  mysqli_close($con);
                  ?>
              </p>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

      </div>
    </div>

  </section>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>