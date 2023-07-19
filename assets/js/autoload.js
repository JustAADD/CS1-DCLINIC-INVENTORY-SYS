// appointment schedule
function appointment() {
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    document.getElementById("appointment").innerHTML = this.responseText;
  }
  xhttp.open("GET", "app-data.php");
  xhttp.send();
}

setInterval(function () {
  appointment();
}, 1);


// $(document).ready(function() {
//   // Handle form submission
//   $('#cardcalendar').on('submit', function(e) {
//     e.preventDefault(); // Prevent the default form submission

//     // Serialize the form data
//     var formData = $(this).serialize();

//     // Send an AJAX request to the server
//     $.ajax({
//       url: $(this).attr('appointment.php'), // Form action URL
//       type: $(this).attr('POST'), // Form method (POST in this case)
//       data: formData, // Serialized form data
//       success: function(response) {
//         // Handle the success response (data updated)
//         // Update the necessary elements or show a success message
//         alert('Data updated successfully!');
//       },
//       error: function(xhr, status, error) {
//         // Handle the error response
//         // Show an error message or perform appropriate actions
//         alert('An error occurred while updating data: ' + error);
//       }
//     });
//   });
// });

