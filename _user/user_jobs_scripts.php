<!-- Include jQuery if not included already -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script type="text/javascript">
    
    $(document).ready(function(){

    });

    // ----------------------------------------------------------------Function to select the status
    function selectStatus(status) {
        document.getElementById('selectedStatus').value = status;
    }

    function submitStatusForm() {
        var selectedStatus = document.getElementById('selectedStatus').value;

        // Send the selected status to the server using AJAX
        $.ajax({
            type: "POST",
            url: "user_jobs_functions.php", 
            data: { selectedStatus: selectedStatus },
            success: function(response) {
                // Handle the server response if needed
                console.log(response);
            }
        });

        // Close the modal
        $('#exampleModal').modal('hide');
    }
</script>