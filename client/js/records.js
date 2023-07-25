// dashboard

function updateData() {
  // Function to update the data for each section

  // Function to update the "Appointment" section
  function updateAppointment() {
    $.ajax({
      url: "../php/dash_get_data.php", // Replace with the PHP script to fetch the total from the database
      method: "GET",
      dataType: "json",
      success: function (data) {
        $("#appointments").text(data.total_rows);
      },
      error: function () {
        console.error("Failed to fetch data for Appointment.");
      },
    });
  }

  // Repeat the same for other sections (e.g., "Patient Records", "Supplies", etc.)

  // Call the functions to update each section
  updateAppointment();
  // Repeat the same for other sections (e.g., updatePatientRecords(), updateSupplies(), etc.)
}

// Call the updateData function when the document is ready
$(document).ready(function () {
  updateData();
  // Fetch data every 5 seconds (adjust the interval as needed)
  setInterval(updateData, 5000);
});

