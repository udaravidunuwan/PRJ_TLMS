<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js">
</script>

<script type="text/javascript">
    // admin signin 
    $(document).ready(function(){
        $("#managerSigninBtn").on("click", function(event) {
            event.preventDefault(); // Prevent form submission for now
            managerSignin(); // Call your function
        });
        
    });

    function managerSignin(){
        $(document).ready(function(){
            // alert("check 1");
            var data = {
                action: $('#action').val(),
                emailSignin: $('#managerEmail').val(),
                passwordSignin: $('#managerPassword').val(),
            };
            // alert(data);
            // alert(JSON.stringify(data));
            $.ajax({
                url: 'manager_signin_functions.php',
                type: 'POST',
                data: data,
                success: function(response){
                    // alert(response);
                    if(response == "Sign in Successful"){
                        window.location.reload();
                    }  else {
                        // Display the session status in toast
                        const toastBody = document.querySelector('#liveToast .toast-body');
                        const toastLiveExample = document.getElementById('liveToast');
                        toastBody.textContent = response; // Update toast content
                        // alert(toastBody.textContent);
                        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
                        toastBootstrap.show(); // Show the toast
                        // $('#liveToast').toast('show');

                        // Clear the input fields
                        $('#managerEmail').val('');
                        $('#managerPassword').val('');

                    }
                }
            });

        });
    }

    
</script>