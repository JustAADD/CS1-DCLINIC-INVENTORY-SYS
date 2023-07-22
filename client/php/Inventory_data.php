<?php

require '../../connection/connection.php';
// $rows = mysqli_query($con, "SELECT * FROM user_registration");
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
  </style>
</head>

<body>

  <!-- Inventory -->
  <div class="body-table">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"></th>
          <th scope="col">Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Class</th>
          <th scope="col">Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
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

        echo '
              <tbody>
                <tr class="centered-row">
                  <th scope ="row">' . $inv_id . '</td>
                  <td> <div class="imagesrc">
                    <img src="' . $row['imagedata'] . '"/>
                    </div>
                  </td>
                  <td>' . $name . '</td>
                  <td> <button type="" class="btn btn-outline-success">' . $stocks . '</button></td>
                  <td>' . $class . '</td>
                  <td>' . $date . '</td>
                  <td> 
                  <a href="../admin/stockdelete.php? deleteid=' . $id . '"><i class="fa-solid fa-trash" style="color:red;"></i></a> &nbsp&nbsp
                  <a href="../admin/admin-view-stocks.php? updateid=' . $id . '"><button class="btn btn-dark btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                  </td>
              </tbody>
        ';
      }
      ?>

      <!-- data -->
    </table>
  </div>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>