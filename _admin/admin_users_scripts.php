<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // const toastTrigger = document.getElementById('liveToastBtn')
        // const toastLiveExample = document.getElementById('processToast')

        // if (toastTrigger) {
        //     const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        //     toastTrigger.addEventListener('click', () => {
        //         toastBootstrap.show()
        //     })
        // }

        // DataTable Loader
        $('#admin_users_table').DataTable();

        // Add an event listener to the "Add New User" button
        const addNewUserButton = document.getElementById("admin_users_addNewUsers");
        addNewUserButton.addEventListener("click", setTemporaryPassword);
        // end

        // admin admin_users_addNewUser_btn click listner
        $("#admin_users_addNewUser_btn").on("click", function(event) {
            event.preventDefault(); // Prevent form submission for now
            admin_users_addNewUser_btn(); // Call your function
        });
        // end 

        // admin admin_users_editUser_btn click listner
        $("#admin_users_editUser_btn").on("click", function(event) {
            event.preventDefault(); // Prevent form submission for now
            admin_users_editUser_btn(); // Call your function
        });
        // end 

        // admin admin_users_deleteUser_btn click listner
        $("#admin_users_deleteUser_btn").on("click", function(event) {
            event.preventDefault(); // Prevent form submission for now
            admin_users_deleteUser_btn(); // Call your function
        });
        // end 
    });


    // Temp Password Generator
    function generatePassword() {
        const length = 20; // The desired password length 
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*_-";
        let password = "";

        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            password += charset[randomIndex];
        }

        return password;
    }

    // Function to add a new user
    function admin_users_addNewUser_btn() {
        alert('Add New User');
        $(document).ready(function() {
            var data = {
                action: $('#actionAddNewUser').val(),
                firstName: $('#admin_users_addNewUser_firstName').val(),
                lastName: $('#admin_users_addNewUser_lastName').val(),
                userRole: $('#admin_users_addNewUser_userRole').val(),
                email: $('#admin_users_addNewUser_email').val(),
                tempPassword: $('#admin_users_addNewUser_temp_password_input').val(),
            };
            // alert(data);
            alert(JSON.stringify(data));
            $.ajax({
                url: 'admin_users_functions.php',
                type: 'POST',
                data: data,
                success: function(response) {
                    // alert(response);
                    if (response == "Sign in Successful") {
                        window.location.reload();
                    } else {
                        // Display the session status in toast
                        const toastBody = document.querySelector('#processToast .toast-body');
                        const toastLive = document.getElementById('processToast');
                        toastBody.textContent = response; // Update toast content
                        // alert(toastBody.textContent);
                        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive);
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

    // Function to set the temporary password in the input field
    function setTemporaryPassword() {
        const tempPassword = generatePassword();
        const tempPasswordInput = document.getElementById("admin_users_addNewUser_temp_password_input");
        tempPasswordInput.value = tempPassword;
    }

    // Function to edit a user
    function admin_users_editUser_btn() {
        alert('Edit User');
    }

    // Function to delete a user
    function admin_users_deleteUser_btn() {
        alert('Delete User');
    }
</script>