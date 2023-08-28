

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script>


// Update job status
function updateJobStatus(jobId) {
  $.ajax({
      url: 'user_jobs.php',
      type: 'POST',
      data: { jobId: jobId },
      dataType: 'json',
      success: function(response) {
          if (response.success) {
              // Handle success, maybe show a notification to the user
              console.log('Job status updated successfully');
          } else {
              // Handle failure, show an error message
              console.error('Failed to update job status');
          }
      },
      error: function() {
          console.error('An error occurred during the AJAX request');
      }
  });
}

// Add an event listener to the dropdown
$('#dropdownButton-users .dropdown-item').click(function() {
  const newStatus = $(this).text();
  if (newStatus === 'Completed') {
      // const jobId = /* Get the jobId of the current row */;
      updateJobStatus(jobId);
  }
});

</script>