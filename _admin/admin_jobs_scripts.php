<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // DataTable Loader
        $('#admin_jobs_table').DataTable();
        
        // Datepicker
        $("#tlms_jobs_created_date_modal_datepicker").datepicker();
        $("#tlms_jobs_recieved_date_modal_datepicker").datepicker();
        $("#tlms_jobs_started_date_modal_datepicker").datepicker();
        $("#tlms_jobs_completed_date_modal_datepicker").datepicker();
    });
</script>