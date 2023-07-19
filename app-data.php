<?php
function build_calendar($month, $year)
{

  $mysqli = new mysqli('localhost', 'root', '', 'cs1-dclinic-sys');
  $stmt = $mysqli->prepare("select * from appointment_booking where MONTH(session_date) = ? AND YEAR(session_date) = ?");
  $stmt->bind_param('ss', $month, $year);
  $bookings = array();
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $bookings[] = $row['session_date'];
      }
      $stmt->close();
    }
  }


  // Create array containing abbreviations of days of week.
  $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

  // What is the first day of the month in question?
  $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

  // How many days does this month contain?
  $numberDays = date('t', $firstDayOfMonth);

  // Retrieve some information about the first day of the
  // month in question.
  $dateComponents = getdate($firstDayOfMonth);

  // What is the name of the month in question?
  $monthName = $dateComponents['month'];

  // What is the index value (0-6) of the first day of the
  // month in question.
  $dayOfWeek = $dateComponents['wday'];

  // Create the table tag opener and day headers

  $datetoday = date('Y-m-d');


  $calendar = "<table class='table table-bordered' id='appointment' style='width: 100%; height: 50%;'>";
  $calendar .= "<div class='row' style='margin-top: 1px;'>";
  $calendar .= "<div class='col-8 text-start'><h3>$monthName $year</h3></div>";
  $calendar .= "<div class='col-4'>";
  $calendar .= "<a class='btn btn-xs btn-primary' style='font-size: 12px; background-color: #3785F9; margin-left: 90px'; href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "'><</a> ";
  $calendar .= "<a class='btn btn-xs btn-primary' style='font-size: 12px'; background-color: #3785F9; href='?month=" . date('m') . "&year=" . date('Y') . "'>Current Month</a> ";
  $calendar .= "<a class='btn btn-xs btn-primary' style='font-size: 12px'; background-color: #3785F9; href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "'>></a></div>";
  $calendar .= "</div>";
  $calendar .= "<tr>";


  // $calendar = "<table class='table table-bordered'>";
  // $calendar .= "<center><h2>$monthName $year</h2>";
  // $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "'>Previous Month</a> ";
  // $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m') . "&year=" . date('Y') . "'>Current Month</a> ";
  // $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "'>Next Month</a></center><br>";
  // $calendar .= "<tr>";

  // Create the calendar headers

  foreach ($daysOfWeek as $day) {
    $calendar .= "<th class='headered' style='font-size: 13px;'>$day</th>";
  }

  // Create the rest of the calendar

  // Initiate the day counter, starting with the 1st.

  $currentDay = 1;

  $calendar .= "</tr><tr>";

  // The variable $dayOfWeek is used to
  // ensure that the calendar
  // display consists of exactly 7 columns.

  if ($dayOfWeek > 0) {
    for ($k = 0; $k < $dayOfWeek; $k++) {
      $calendar .= "<td class='empty'></td>";
    }
  }



  $month = str_pad($month, 2, "0", STR_PAD_LEFT);

  // include "db-connect/db-con.php";
  // $sql ="SELECT date, status FROM availability";
  // $result = $con-> query($sql);

  // $availabilityStatus = array();

  // if ($result->num_rows > 0){
  //   while($row = $result->fetch_assoc()){
  //     $availabilityStatus[$row['date']] = $row ['status'];
  //   }
  // }

  // $con->close();


  while ($currentDay <= $numberDays) {

    // Seventh column (Saturday) reached. Start a new row.

    if ($dayOfWeek == 7) {

      $dayOfWeek = 0;
      $calendar .= "</tr><tr>";
    }

    $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
    $date = "$year-$month-$currentDayRel";



    $dayname = strtolower(date('l', strtotime($date)));
    $eventNum = 0;
    $today = $date == date('Y-m-d') ? "today" : "";
    if ($date < date('Y-m-d')) {
      $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' style='font-size: 8px;'>N/A</button>";
    }elseif (in_array(date('Y-m-d', strtotime($date)), $bookings)) {
      $calendar .= "<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' style='font-size: 8px; background-color: #3785F9; border: none;'>Already Booked</button>";
    
    } else {
      $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='app-set-sched.php?date=" . $date . "' class='btn btn-success btn-xs' style='font-size: 8px; background-color: #3785F9; border: none;'>Book</a>";
    }


    $calendar .= "</td>";
    // Increment counters

    $currentDay++;
    $dayOfWeek++;
  }



  // Complete the row of the last week in month, if necessary

  if ($dayOfWeek != 7) {

    $remainingDays = 7 - $dayOfWeek;
    for ($l = 0; $l < $remainingDays; $l++) {
      $calendar .= "<td class='empty'></td>";
    }
  }

  $calendar .= "</tr>";

  $calendar .= "</table>";

  echo $calendar;
}
