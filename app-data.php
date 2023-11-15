<?php
function build_calendar($month, $year)
{

  $mysqli = new mysqli('localhost', 'root', '', 'cs1-dclinic-sys');
  // $stmt = $mysqli->prepare("select * from appointment_booking where MONTH(session_date) = ? AND YEAR(session_date) = ?");
  //$stmt = $mysqli->prepare("SELECT session_date, status FROM appointment_booking WHERE MONTH(session_date) = ? AND YEAR(session_date) = ?");
  $stmt = $mysqli->prepare("SELECT date, status, slots FROM manage_schedule WHERE MONTH(date) = ? AND YEAR(date) = ?");
  $stmt->bind_param('ss', $month, $year);
  $bookings = array();
  $statuses = array();
  $slotses = array();
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $bookings[] = $row['date'];
        $statuses[] = $row['status'];
        // $slots[] = $row['slots'];
        $slots[] = isset($row['slots']) ? $row['slots'] : 0;
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

    // if ($date < date('Y-m-d')) {
    //   $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' style='font-size: 8px;'>N/A</button>";
    // }elseif (in_array(date('Y-m-d', strtotime($date)), $bookings)) {
    //   $calendar .= "<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' style='font-size: 8px; background-color: #3785F9; border: none;'>Already Booked</button>";

    // } else {
    //   $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='app-set-sched.php?date=" . $date . "' class='btn btn-success btn-xs' style='font-size: 8px; background-color: #3785F9; border: none;'>Book</a>";
    // }

    if (in_array(date('Y-m-d', strtotime($date)), $bookings)) {
      // Find the index of the date in the bookings array
      $bookingIndex = array_search(date('Y-m-d', strtotime($date)), $bookings);
      // Get the status for the corresponding date
      $status = $statuses[$bookingIndex];
      $slotses = $slots[$bookingIndex];

      if ($status === "Open") {
        if ($slotses > 0) {
          $calendar .= "<td class='booked $today' style ='background-color:#32CD32;' ><h4>$currentDay</h4> 
                <a href='appointment_schedule.php?date=" . $date . "' class='btn btn-success btn-xs' style='font-size: 10px; background-color: #3785F9; border: none;'>Book</a>
                <button class='btn btn-danger btn-xs' style='font-size: 10px; background-color: #3785F9; border: none;'>$slotses slots</button>
              </td>";
        } elseif ($slotses == 0) {
          $calendar .= "<td class='booked $today' style ='background-color:#32CD32;' ><h4>$currentDay</h4> 
                <button class='btn btn-danger btn-xs' style='font-size: 10px; background-color: #3785F9; border: none;'>No slots available</button>
              </td>";
        }
      } elseif ($status === "Closed") {
        $calendar .= "<td class='na $today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' style='font-size: 8px;'>Closed</button>";
      } else {
        $calendar .= "<td class='booked $today' style ='background-color:#32CD32;' ><h4>$currentDay</h4> 
                <button class='btn btn-danger btn-xs' style='font-size: 9px; background-color: #3785F9; border: none;'>No slots available</button>
              </td>";
      }
    } else {
      $calendar .= "<td class='na $today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' style='font-size: 8px;'>Closed</button>";
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
