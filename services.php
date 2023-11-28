<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Document</title> -->
  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- ===== css ===== -->
  <link rel="stylesheet" href="assets/css/content-style.css">
  <!-- Animation-->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <script type="module" src="https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule="" src="https://unpkg.com/ionicons@5.1.2/dist/ionicons/ionicons.js"></script>

</head>

<body>

  <header>
    <?php
    include 'app-header.php';
    ?>
  </header>

  <div class=" margin" style="margin-top: 5rem;">
  </div>



  <section class="services">
    <?php
    require 'connection/connection.php';

    // Perform a query to fetch services from the media settings database
    $typeOfServices = "Dentures";


    $query = "SELECT * FROM media_settings WHERE type_of_services = ?"; // Replace 'your_table_name' with your actual table name
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, "s", $typeOfServices);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
      // Loop through the results and display each service
      while ($row = mysqli_fetch_assoc($result)) {

        $imagedata = $row['imagedata'];

    ?>
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style="background-color: transparent; padding: 50px;">
          <div class="row" id="denturesrow">
            <div class="card" id="dentures">
              <p class="title"><?php echo $row['dash_service']; ?></p>
              <p class="service_description"><?php echo $row['dash_text']; ?></p>
              <div class="imgsrc" alt="profileImg" style="width: 100px; height: 60px;">


                <?php
                $imagePath = "./../../imagedata/" . $row['imagedata'];
                echo '<img src="' . $imagePath . '" alt="Image">';

                echo '<p>Image Path: ' . $imagePath . '</p>';
                ?>
              </div>
            </div>
          </div>
        </div>
    <?php
      }

      // Free the result set
      mysqli_free_result($result);
    } else {
      // Handle the error if the query fails
      echo "Error: " . mysqli_error($con);
    }

    // Close the statement and the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    ?>

  </section>

  <!-- <div class="footer">

    <div class="owner">
      <p> ® Dalino Dental Clinic</p>
    </div>

  </div> -->

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- Animation-->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

</body>

</html>