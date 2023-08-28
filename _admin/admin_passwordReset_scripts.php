<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        // admin signin event click listner
        $("#passwordReset").on("click", function(event) {
            event.preventDefault(); // Prevent form submission for now
            // alert("Password Reset");
            passwordReset(); // Call your function
        });
        // end 

    });

    function passwordReset() {
        $(document).ready(function() {
            var data = {
                action: $('#action').val(),
                adminPassword: $('#adminPassword').val(),
                adminPasswordConfirm: $('#adminPasswordConfirm').val(),
            }
            // alert(JSON.stringify(data));
            $.ajax({
                url: 'admin_passwordReset_functions.php',
                type: 'POST',
                data: data,
                success: function(response) {
                    // alert(response);
                    if (response == "Password Updated Successfully") {
                        window.location.href = 'admin_dashboard.php';
                    } else {
                        // Display the session status in toast
                        const toastBody = document.querySelector('#liveToast .toast-body');
                        const toastLiveExample = document.getElementById('liveToast');
                        toastBody.textContent = response; // Update toast content
                        // alert(toastBody.textContent);
                        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
                        toastBootstrap.show(); // Show the toast
                        // $('#liveToast').toast('show');

                        // Clear the input fields
                        $('#adminPassword').val('');
                        $('#adminPasswordConfirm').val('');

                    }
                }
            })
        })
    }
</script>