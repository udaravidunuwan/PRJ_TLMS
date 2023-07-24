<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js">
</script>

<script type="text/javascript">
    // admin signin 
    function adminSignin(){
        $(document).ready(function(){
            var data = {
                action: '',
                emailSignin: $('#adminEmail').val(),
                passwordSignin: $('#adminPassword').val(),
            };

            alert(data);
            // if ($('#register-submit').is(':focus')) {
            //     data.action = $('#actionReg').val();
            // } else if ($('#login-submit').is(':focus')) {
            //     data.action = $('#actionLog').val();
            // }

            // $.ajax({
            //     url: 'function.php',
            //     type: 'post',
            //     data: data,
            //     success: function(response){
            //         alert(response);
            //         if(response == "Login successful"){
            //             window.location.reload();
            //         } 
            //     }
            // });
        });
    }
    

    


</script>