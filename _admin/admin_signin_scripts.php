<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js">
</script>

<script type="text/javascript">
    // admin signin 
    function adminSignin(){
        alert("check signin");
    }

    function test() {
        // alert("test 1");
        $(document).ready(function(){
            // alert("test 2");

            var data = {
                action: "action1",
                emailSignin: "admin@mail.com",
                passwordSignin: "admin",
            };
            // alert("test 3")
            // alert(data.action)
            // alert(data.emailSignin)
            // alert(data.passwordSignin)
            // alert("test 4")
            $.ajax({
                url: 'admin_signin_functions.php',
                type: 'post',
                data: data,
                success: function(response){
                    alert(response);
                    // if(response == "Login successful"){
                    //     window.location.reload();
                    // } 
                }
            });
        });
    }
    
</script>