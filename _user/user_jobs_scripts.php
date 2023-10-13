<!-- Include jQuery if not included already -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script type="text/javascript">
    
    $(document).ready(function(){

    });

    // ----------------------------------------------------------------Function to select the status
//     function updateJobStatus(jobId, newStatus) {
//     $.ajax({
//         type: "POST",
//         url: "user_jobs.php", // URL to your PHP file handling the status update
//         data: {
//             jobId: jobId,
//             newStatus: newStatus
//         },
//         dataType: "json",
//         success: function(response) {
//             if (response.success) {
//                 // Job status updated successfully
//                 console.log("Status updated successfully!");
//                 // Perform any additional actions here, such as updating the UI
//             } else {
//                 // Failed to update job status
//                 console.error("Failed to update job status:", response.message);
//                 // Handle error, show error message, etc.
//             }
//         },
//         error: function(xhr, status, error) {
//             // Handle AJAX error
//             console.error("AJAX request failed:", error);
//             // Handle error, show error message, etc.
//         }
//     });
// }
$(document).ready(function(){
    // Function to handle form submission and update job status
    function submitStatusForm() {
        // Get jobId and selectedStatus from your form or modal inputs
        var jobId = "Mk001"; // Example jobId, replace it with your actual jobId logic
        var selectedStatus = $('#selectedStatus').val();

        // Log the values to ensure they are correct
        console.log("Job ID:", jobId);
        console.log("Selected Status:", selectedStatus);

        // Perform AJAX request to update job status in the database
        $.ajax({
            type: "POST",
            url: "./user_jobs_functions.php", // Correct path to your PHP file
            data: {
                jobId: jobId,
                newStatus: selectedStatus
            },
            dataType: "json",
            success: function(response) {
                console.log("Response from server:", response);
                if (response.success) {
                    // Job status updated successfully
                    console.log("Status updated successfully!");
                    // You can update the UI or perform other actions here
                } else {
                    // Failed to update job status
                    console.error("Failed to update job status:", response.message);
                    // Handle error, show error message, etc.
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                console.error("AJAX request failed:", error);
                // Handle error, show error message, etc.
            }
        });
    }

    // Bind the submitStatusForm() function to the "Save changes" button click event
    $('#saveChangesButton').click(function() {
        // Call the submitStatusForm() function when the button is clicked
        submitStatusForm();
    });
});

</script>