<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the form data
  $event_name = $_POST["manage_name"];
  $event_start_time = $_POST["manage_start_time"];
  $event_end_time = $_POST["manage_end_time"];

  // Validate and sanitize the input data (you can add more validation as per your requirements)
  $event_name = trim($event_name);
  $event_start_time = trim($event_start_time);
  $event_end_time = trim($event_end_time);

  // Perform additional validation if needed
  // ...

  // Connect to the database (replace these with your actual database credentials)
  require '../../connection/connection.php';
  // Prepare the SQL query to insert data into the database
  $sql = "INSERT INTO manage_date_time (manage_status, manage_start_time, manage_end_time)
            VALUES ('$event_name', '$event_start_time', '$event_end_time')";

  // Execute the query and check if it was successful
  if ($con->query($sql) === TRUE) {
    echo "Event data saved successfully.";
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }

  // Close the database connection
  $con->close();
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=s, initial-scale=1.0">
  <title>Document</title>

  <!-- CSS for full calender -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
  <!-- JS for jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- JS for full calender -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
  <!-- bootstrap css and js -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <style>
    #calendar {
      padding: 12%;
      margin-top: -120px;


    }
  </style>

  <script>
    $(document).ready(function() {
      var calendar = $('#calendar').fullCalendar({



        // Day click callback
        dayClick: function(date, jsEvent, view) {
          // Open the modal and set the selected date
          $('#selectedDate').text("Selected Date: " + date.format("YYYY-MM-DD"));
          $('#dateModal').modal('show');
        }

      });
    });
  </script>

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">

        <div id="calendar"></div>
      </div>
    </div>
  </div>

  <!-- Add this modal HTML inside the <body> tag -->
  <div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Add New Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="img-container">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="event_name">Date Status</label>
                    <input type="text" name="manage_name" id="manage_name" class="form-control" placeholder="Date Status">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="event_start_date">Manage Start Time</label>
                    <input type="text" name="manage_start_time" id="manage_start_time" class="form-control" placeholder="Manage Start Time">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="event_end_date">Manage End Time</label>
                    <input type="text" name="manage_end_time" id="manage_end_time" class="form-control" placeholder="Manage End Time">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Event</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>