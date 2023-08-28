
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script type="text/javascript">

    $('#dropdownButton-users .dropdown-item').click(function() {
        const newStatus = $(this).text();
        const jobId = $(this).closest('tr').data('job-id');
        
        // Send an AJAX request to update the job status
        $.ajax({
            url: 'user_jobs_function.php', 
            method: 'POST',
            data: { jobId: jobId, newStatus: newStatus },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Show success notification
                    $(".notification").addClass("alert-success").text("Job status updated successfully").fadeIn().delay(2000).fadeOut();
                    console.log('Job status updated successfully');
                } else {
                    // Show error notification
                    $(".notification").addClass("alert-danger").text("Failed to update job status").fadeIn().delay(2000).fadeOut();
                    console.error('Failed to update job status');
                }
            },
            error: function() {
                // Show error notification
                $(".notification").addClass("alert-danger").text("Error occurred while updating job status").fadeIn().delay(2000).fadeOut();
                console.error('Error occurred while updating job status');
            }
        });
    });

</script>