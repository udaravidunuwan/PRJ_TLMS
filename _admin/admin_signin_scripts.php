<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js">
</script>

<script type="text/javascript">
    $(document).ready(function() {
        // admin signin event click listner
        $("#adminSigninBtn").on("click", function(event) {
            event.preventDefault(); // Prevent form submission for now
            adminSignin(); // Call your function
        });
        // end 


    });

    function adminSignin() {
        $(document).ready(function() {
            var data = {
                action: $('#action').val(),
                emailSignin: $('#adminEmail').val(),
                passwordSignin: $('#adminPassword').val(),
            };
            // alert(data);
            // alert(JSON.stringify(data));
            $.ajax({
                url: 'admin_signin_functions.php',
                type: 'POST',
                data: data,
                success: function(response) {
                    // alert(response);
                    if (response == "Sign in Successful") {
                        window.location.reload();
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
                        $('#adminEmail').val('');
                        $('#adminPassword').val('');

                    }
                }
            });

        });
    }

</script>