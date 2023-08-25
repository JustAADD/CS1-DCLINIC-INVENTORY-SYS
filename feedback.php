<?php
require 'connection/connection.php';
session_start();

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

if (isset($_POST['submit_feedback'])) {
  $feedback = $_POST['feedback'];
  $fullname = $_SESSION['fullname'];
  $current_date = date('d/m/Y l');

  $comment = analyzeFeedback($feedback);

  switch ($comment) {
    case 'positive':
      insertFeedback($feedback, 'positive_feedback', $fullname, $current_date);
      break;
    case 'negative':
      insertFeedback($feedback, 'negative_feedback', $fullname, $current_date);
      break;
    default:
      insertFeedback($feedback, 'neutral_feedback', $fullname, $current_date);
      break;
  }
}
function insertFeedback($feedback, $table, $fullname, $current_date)

{
  $mysqli = new mysqli('localhost', 'root', '', 'cs1-dclinic-sys');
  if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
  }

  $stmt = $mysqli->prepare("INSERT INTO $table (feedback, patient_name, date) VALUES (?,?,?)");
  $stmt->bind_param("sss", $feedback, $fullname, $current_date);

  if ($stmt->execute()) {
    // echo "Feedback inserted successfully!";
    $_SESSION['insert'] = "Thank you";
    $_SESSION['insert_code'] = "Thank you for sending us a feedback!";

    header ("location: home.php");
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  $mysqli->close();
}

function analyzeFeedback($Feedback)
{
  $FeedbackData = [
    "POSITIVEWORDS" => [
      "good", "great", "excellent", "positive", "wonderful", "happy", "outstanding",
      "exceptional", "Terrific", "amazing", "superb", "fantastic", "impressive",
      "marvelous", "awesome", "remarkable", "phenomenal", "splendid", "fabulous",
      "spectacular", "brilliant", "extraordinary", "admirable", "commendable", "praiseworthy",
      "perfect", "flawless", "top-notch", "a+", "stellar", "tremenduos", "like", "clean",
      "thank", "thanks", "professional", "respectful", "motivated", "engaged", "responsible",
      "majestic", "caring", "attentive", "efficient", "Empathetic", "helpful", "courteous", "compassionate",
      "polite", "supportive", "prompt", "accommodating", "understanding", "knowledgeable", "respectful", "satisfied",
      "grateful", "impressed", "welcoming"
    ],
    "NEGATIVEWORDS" => [
      "bad", "terrible", "negative", "poor", "awful", "sad", "inconsistent", "unreliable",
      "careless", "disorganized", "inefficient", "uncooperative", "inattentive", "neglectful",
      "indifferent", "dismissive", "insensitive", "argumentative", "defensive",
      "unresponsive", "inflexible", "impatient", "overbeating", "unprofessional",
      "disrespectful", "pessimistic", "unmotivated", "disengaged", "indecisive",
      "forgetful", "stubborn", "inadequate", "irresponsible", "unprepared", "disorganized",
      "wasted", "disinterested", "dissapointed", "frustrated", "unpleasant", "uncomfortable",
      "negligent", "uncaring", "unsympathetic", "inconsiderate", "incompetent", "rude", "indifferent", "impersonal",
      "unorganized", "unresponsive", "inattentive", "careless", "unclear", "inaffective"
    ],
    "POSITIVEPHRASES" => [
      "feeling great", "very positive", "extremely good", "wonderful day", "exceptionally well", "pleasant experience",
      "highly satisfied", "incredibly helpful", "extremely satisfied", "top-notch service", "remarkable care", "execptional treatment",
      "delightful visit", "highly recommended", "impeccable service", "extremely caring", "truly professional", "beyond expectation",
      "outstanding care", "truly exceptional", "excellent care", "fantastic service", "highly attentive"
    ],
    "NEGATIVEPHRASES" => [
      "feeling bad", "terrible experience", "not good", "awful day", "Overly critical", "do not", "Extremely dissatisfied",
      "Very disappointing", "Highly unprofessional", "Truly terrible", "Beyond frustrating", "Completely unsatisfactory",
      "Exceptionally rude", "Unbelievably poor", "Incredibly unhelpful", "Absolutely awful", "Highly negligent", "Extremely disorganized",
      "Totally unresponsive", "Highly inconsiderate", "Totally unacceptable", "Beyond regrettable", "Incredibly disappointing", "Extremely unsatisfied",
      "Truly dissatisfying", "Highly frustrating"
    ],
    "NEGATIONWORDS" => [
      "not", "never", "no", "n't", "dont", "don't", "lack", "cannot", "can't", "no way", "nope", "no chance", "no option", "without",
      "devoid", "lacking", "fail", "failed", "failing", "failure", "unable", "unable to", "incapable", "lacking", "insufficient", "insufficiently",
      "less", "less than", "fell short", "fell behind", "didn't"
    ]
  ];


  $inputTextLower = strtolower($Feedback);
  $inputWords = preg_split('/\s+/', $inputTextLower);

  $FeedbackScore = 0;

  for ($i = 0; $i < count($inputWords); $i++) {
    $word = $inputWords[$i];

    if (in_array($word, $FeedbackData["NEGATIONWORDS"])) {
      $j = $i + 1;
      while ($j < count($inputWords) && !in_array($inputWords[$j], $FeedbackData["NEGATIONWORDS"])) {
        if (in_array($inputWords[$j], $FeedbackData["POSITIVEWORDS"]) || in_array(implode(" ", array_slice($inputWords, $i, $j - $i + 1)), $FeedbackData["POSITIVEPHRASES"])) {
          $FeedbackScore--;
        } elseif (in_array($inputWords[$j], $FeedbackData["NEGATIVEWORDS"]) || in_array(implode(" ", array_slice($inputWords, $i, $j - $i + 1)), $FeedbackData["NEGATIVEPHRASES"])) {
          $FeedbackScore++;
        }
        $j++;
      }
      $i = $j - 1;
    } else {
      if (in_array($word, $FeedbackData["POSITIVEWORDS"]) || in_array($word, $FeedbackData["POSITIVEPHRASES"])) {
        $FeedbackScore++;
      } elseif (in_array($word, $FeedbackData["NEGATIVEWORDS"]) || in_array($word, $FeedbackData["NEGATIVEPHRASES"])) {
        $FeedbackScore--;
      }
    }
  }

  if ($FeedbackScore > 0) {
    return 'positive';
  } elseif ($FeedbackScore < 0) {
    return 'negative';
  } else {
    return 'neutral';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- ===== Bootstrap CSS ===== -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- SweetAlert 2 library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./assets/js/sweetalert.min.js"></script>

  <title>Document</title>

  <style>
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card {
      padding: 6%;
      display: flex;
      width: 50rem;
      height: 30rem;
      box-shadow: 0 7px 4px rgba(126, 175, 249, 0.4);
    }

    .title {

      font-weight: bold;
      color: #3785F9;
    }

    .card textarea {
      width: 40rem;

    }

    .card button {
      width: 10rem;
      font-size: small;
      border-radius: 20px;
    }
  </style>
</head>

<body>
  <div class="header">
     <?php 
        include 'app-header.php';
     ?>
  </div>

  <div class="container mt-4">
    <?php
    if (isset($_SESSION['insert'])) {
      // Display the SweetAlert confirmation pop-up
      echo "<script>
            Swal.fire({
              title: 'Thank you!',
              text: 'Thank you for sending us a feedback!',
              icon: 'success',
              confirmButtonText: 'Done',
              customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                confirmButton: 'custom-swal-button',
              },
            });
          </script>";

      unset($_SESSION['insert']);
    }
    ?>
    <div class="card" style="margin-top: 10%;">
      <p class="title">We would love to hear your feedback for us!</p>
      <form method="POST" action="">
        <div class="form-floating">
          <textarea class="form-control" name="feedback" placeholder="Send a Feedback here" id="feedback" style="height: 200px"></textarea>
          <label for="feedback">Send a Feedback</label>
        </div>
        <div class="buton">
          <button type="submit" name="submit_feedback" class="btn btn-primary mt-4">Send Feedback</button>
        </div>
      </form>
    </div>

  </div>
  <!-- sweet alert -->
  <script src="./assets/js/sweetalert.min.js"></script>

  <!--===== Bootstrap JS =====-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>