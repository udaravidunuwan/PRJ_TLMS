<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
        
        // admin signin event click listner
        $("#passwordReset").on("click", function(event) {
            event.preventDefault(); // Prevent form submission for now
            passwordReset(); // Call your function
        });
        // end 

    });

    function passwordReset(){
        $(document).ready(function() {
            var data = {
                action: $('#action').val(),
                adminPassword: $('#adminPasswordConfirm').val(),
                adminPasswordConfirm: $('#adminPasswordConfirm').val(),
            }

            $.ajax({
                url: 'admin_passwordReset_functions.php',
                type: 'POST',
                data: data,
                success: function(response) {
                    // alert(response);
                    if (response == "Password Reset Successful") {
                        window.location.href = 'admin_dashboard.php';
                    }
                }
            })
        })
    }

</script>