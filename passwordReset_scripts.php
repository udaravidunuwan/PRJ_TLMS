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
                // userRole: $('#userRole').val(),
                Password: $('#Password').val(),
                PasswordConfirm: $('#PasswordConfirm').val(),
            }
            // alert(JSON.stringify(data));
            $.ajax({
                url: 'passwordReset_functions.php',
                type: 'POST',
                data: data,
                success: function(response) {
                    // alert(response);
                    if (response == "Password Updated Successfully") {
                        // Check the userRole and redirect accordingly
                        var userRole = $('#userRole').val();
                        if (userRole == "Admin") {
                            window.location.href = './_admin/admin_dashboard.php';
                        } else if (userRole == "Manager") {
                            window.location.href = './_manager/manager_dashboard.php';
                        } else if (userRole == "User") {
                            window.location.href = './_user/user_dashboard.php';
                        } 
                        // else {
                        //     // Handle other roles or errors as needed
                        // }
                    } else {
                        // Display the session status in toast
                        const toastBody = document.querySelector('#liveToast .toast-body');
                        const toastLive = document.getElementById('liveToast');
                        toastBody.textContent = response; // Update toast content
                        // alert(toastBody.textContent);
                        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive);
                        toastBootstrap.show(); // Show the toast
                        // $('#liveToast').toast('show');

                        // Clear the input fields
                        $('#Password').val('');
                        $('#PasswordConfirm').val('');

                    }
                }
            })
        })
    }
</script>