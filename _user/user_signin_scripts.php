<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js">
</script>

<script type="text/javascript">
    // admin signin 
    $(document).ready(function(){
        // $("#userSigninBtn").on("click", function(event) {
        //     event.preventDefault(); // Prevent form submission for now
        //     userSignin(); // Call your function
        // });
        
    });

    function userSignin(){
        $(document).ready(function(){
            var data = {
                action: $('#action').val(),
                emailSignin: $('#userEmail').val(),
                passwordSignin: $('#userPassword').val(),
            };
            // alert(data);
            // alert(JSON.stringify(data));
            $.ajax({
                url: 'user_signin_functions.php',
                type: 'POST',
                data: data,
                success: function(response){
                    alert(response);
                    if(response == "Sign in Successful"){
                        window.location.reload();
                    } 
                }
            });

        });
    }

    
</script>