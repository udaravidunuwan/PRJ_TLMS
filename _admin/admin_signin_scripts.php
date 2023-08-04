<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js">
</script>

<script type="text/javascript">
    // admin signin 
    // $(document).ready(function(){
    //     $("#adminSigninBtn").on("click", function(event) {
    //         event.preventDefault(); // Prevent form submission for now
    //         adminSignin(); // Call your function
    //     });
    // });

    function adminSignin(){
        $(document).ready(function(){
            var data = {
                action: $('#action').val(),
                emailSignin: $('#adminEmail').val(),
                passwordSignin: $('#adminPassword').val(),
            };
            // alert(data);
            // alert(JSON.stringify(data));
            // alert(data);
            // alert(JSON.stringify(data));
            $.ajax({
                url: 'admin_signin_functions.php',
                type: 'POST',
                type: 'POST',
                data: data,
                success: function(response){
                    alert(response);
                    if(response == "Sign in Successful"){
                        window.location.reload();
                    } 
                    if(response == "Sign in Successful"){
                        window.location.reload();
                    } 
                }
            });

        });
    }

    
</script>