<!-- Include jQuery if not included already -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script type="text/javascript">
    // Ajax Fetch and display job data from the database
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "user_jobs_functions.php",
            dataType: "json",
            success: function(data) {
                // Check if data is available
                if (data.length > 0) {
                    // Clear existing table rows
                    $('#user_dashboard_table').empty();

                    // Loop through the data and add rows to the table
                    $.each(data, function(index, item) {
                        var newRow = '<tr>' +
                            '<td>' + item.tlms_jobs_id + '</td>' +
                            '<td>' + item.tlms_jobs_name + '</td>' +
                            '<td>' + item.tlms_jobs_customer + '</td>' +
                            '<td>' + item.tlms_jobs_assigned_date + '</td>' +
                            '<td>' + item.tlms_jobs_completed_date + '</td>' +
                            '<td>' + item.tlms_jobs_status + '</td>' +
                            '</tr>';
                        $('#user_dashboard_table').append(newRow);
                    });
                } else {
                    // Handle case where no data is available
                    $('#user_dashboard_table').html('<tr><td colspan="6">No data found</td></tr>');
                }
            },
            error: function(){
                alert('Something went wrong!');
            }
        });
    });
</script>