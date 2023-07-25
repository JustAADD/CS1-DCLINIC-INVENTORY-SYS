<?php

require '../../connection/connection.php';

// Check if the "deleteid" parameter is present in the URL
if (isset($_GET['deleteid'])) {
  // Get the id to be deleted from the URL
  $delete_id = $_GET['deleteid'];

  // Create the DELETE query
  $delete_query = "DELETE FROM inventory WHERE id = '$delete_id'";

  // Execute the query
  if ($con->query($delete_query) === TRUE) {


    header("Location: ../php/Inventory.php");
  } else {

    // echo "Error: " . $conn->error;
  }
  $con->close();
}

?>

<head>

  <link rel="stylesheet" href="../css/style.css">
  <!-- icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <style>
    .imagesrc img {
      width: 100px;
      height: 60px;
    }

    .row-red {
      background-color: #ffcccc;
      /* Or any other styling you want for rows with low stocks */
    }

    .row-class {
      vertical-align: center;
    }

    .centered-row {

      vertical-align: middle;
    }
  </style>
</head>

<body>

  
      </tbody>
      <?php
      $selectQuery = "SELECT * FROM inventory ORDER BY id DESC";
      $result = mysqli_query($con, $selectQuery);
      while ($row = mysqli_fetch_assoc($result)) {

        $id = $row['id'];
        $inv_id = $row['inv_id'];
        $imagedata = $row['imagedata'];
        $name = $row['name'];
        $stocks = $row['stocks'];
        $class = $row['class'];
        $date = $row['date'];

        // Check if stocks are less than 5
        $rowClass = ($stocks < 5) ? 'row-red' : '';

        echo '
            <tr class="centered-row ' . $rowClass . '">
              <th scope ="row">' . $id . '</td>
              <td> <div class="imagesrc">
                <img src="' . $row['imagedata'] . '"/>
                </div>
              </td>
              <td>' . $name . '</td>
              <td><button type="button" class="btn ' . ($stocks < 5 ? 'btn-outline-danger' : 'btn-outline-success') . '">' . $stocks . '</button></td>
              <td>' . $class . '</td>
              <td>' . $date . '</td>
              <td> 
              <a href="../php/Inventory_data.php? deleteid=' . $id . '"><i class="fa-solid fa-trash" style="color:red;"></i></a> &nbsp&nbsp
              <a href="../php/Inventory_update.php? updateid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
              </td>
            </tr>
          ';
      }
      ?>

      <!-- data -->
      </tbody>


  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>