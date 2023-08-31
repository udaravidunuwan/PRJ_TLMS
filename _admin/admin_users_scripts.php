<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // ADD NEW USER modal
        // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        // Add an event listener to the "Add New User" button
        const addNewUserButton = document.getElementById("admin_users_addNewUsers");
        addNewUserButton.addEventListener("click", setTemporaryPassword);

        // admin admin_users_addNewUser_btn click listner
        $("#admin_users_addNewUser_btn").on("click", function(event) {
            event.preventDefault(); // Prevent form submission for now
            admin_users_addNewUser_btn(); // Call your function
        });

        // Check if the cookie is set with a toast message
        const cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)toastMessage\s*=\s*([^;]*).*$)|^.*$/, "$1");
        if (cookieValue) {
            displayToast(cookieValue);
        }


        // EDIT modal
        // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // Add a click event listener to all EDIT buttons
        $(".edit-user-button").on("click", function() {
            var userIdEdit = $(this).data("user-id"); // Get the user ID from the data attribute
            // $("#admin_users_editUser_btn").attr("data-user-id", userIdEdit); // Store the user ID in the modal's Save button
            // alert("Edit User with ID: " + userIdEdit);
            // Make an AJAX request to fetch user data
            $.ajax({
                url: 'admin_users_functions.php',
                type: 'POST',
                data: {
                    action: 'getUserData',
                    userId: userIdEdit
                },
                dataType: 'json', // Expect JSON data in response
                success: function(response) {
                    // Populate the modal input fields with user data
                    // alert(JSON.stringify(response));
                    $("#admin_users_editUser_firstName").val(response.tlms_system_users_first_name);
                    $("#admin_users_editUser_lastName").val(response.tlms_system_users_last_name);
                    $("#admin_users_editUser_userRole").val(response.tlms_system_users_user_role);
                    $("#admin_users_editUser_email").val(response.tlms_system_users_email);

                    // Store the user ID in the modal's Save button
                    $("#admin_users_editUser_btn").attr("data-user-id", userIdEdit);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching user data: " + error);
                }
            });
        });

        // admin_users_editUser_btn click listner
        $("#admin_users_editUser_btn").on("click", function(event) {
            var userIdEdit = $(this).data("user-id"); // Get the user ID from the data attribute
            // alert("Edit User with ID: " + userIdEdit);
            event.preventDefault(); // Prevent form submission for now
            admin_users_editUser_btn(); // Call your function
        });

        // Add a click event listener to the EDIT modal's No button
        $("#admin_users_editUser_btn-NO").on("click", function() {
            window.location.reload();
        });

        // DELETE modal
        // ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        // Add a click event listener to all delete buttons
        $(".delete-user-button").on("click", function() {
            var userId = $(this).data("user-id"); // Get the user ID from the data attribute
            $("#admin_users_deleteUser_btn").attr("data-user-id", userId); // Store the user ID in the modal's Yes button
        });

        // Add a click event listener to the modal's Yes button
        $("#admin_users_deleteUser_btn").on("click", function() {
            var userId = $(this).data("user-id"); // Get the user ID from the modal's Yes button
            // alert("Delete User with ID: " + userId);
            admin_users_deleteUser_btn(); //Call for function 
        });

        // Add a click event listener to the modal's No button
        $("#admin_users_deleteUser_btn-NO").on("click", function() {
            window.location.reload();
        });

        // DataTable Loader
        $('#admin_users_table').DataTable();
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
        // alert('Add New User');
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
            // alert(JSON.stringify(data));
            $.ajax({
                url: 'admin_users_functions.php',
                type: 'POST',
                data: data,
                success: function(response) {
                    // alert(response);
                    // Set a cookie to indicate that the toast should be displayed after the reload
                    document.cookie = `toastMessage=${response}; path=/`;

                    if (response == "User Created Successfully") {
                        window.location.reload();
                    } else {
                        displayToast(response);
                    }
                }
            });

        });
    }

    // Function to edit a user
    function admin_users_editUser_btn() {
        // alert('Edit User');
        // alert('Add New User');
        var userId = $("#admin_users_editUser_btn").data("user-id"); // Get the user ID from the modal's Yes button
        // alert("Edit User with ID: " + userId);
        // alert($('#admin_users_editUser_firstName').val());
        $(document).ready(function() {
            // Collect the data from the input fields
            var data = {
                action: 'actionEditUser', // The action for editing the user
                userId: userId, // The user ID to edit
                firstName: $('#admin_users_editUser_firstName').val(),
                lastName: $('#admin_users_editUser_lastName').val(),
                userRole: $('#admin_users_editUser_userRole').val(),
                email: $('#admin_users_editUser_email').val(),
            };
            // alert("Edit User with ID: " + userId);
            // alert(JSON.stringify(data));
            $.ajax({
                url: 'admin_users_functions.php',
                type: 'POST',
                data: data,
                success: function(response) {
                    // alert(response);
                    // Set a cookie to indicate that the toast should be displayed after the reload
                    document.cookie = `toastMessage=${response}; path=/`;

                    if (response == "User Updated Successfully") {
                        window.location.reload();
                    } else {
                        displayToast(response);
                    }
                }
            });

        });
    }

    // Function to delete a user
    function admin_users_deleteUser_btn() {
        // alert('Delete User');
        var userId = $("#admin_users_deleteUser_btn").data("user-id"); // Get the user ID from the modal's Yes button
        // alert("Delete User with ID: " + userId);

        $(document).ready(function() {
            var data = {
                action: "actionDeleteUser",
                userId: userId
            };
            // alert(data);
            // alert(JSON.stringify(data));
            $.ajax({
                url: 'admin_users_functions.php',
                type: 'POST',
                data: data,
                success: function(response) {
                    // alert(response);
                    // Set a cookie to indicate that the toast should be displayed after the reload
                    document.cookie = `toastMessage=${response}; path=/`;

                    if (response == "User Deleted successfully") {
                        window.location.reload();
                    } else {
                        displayToast(response);
                    }
                }
            });

        });
    }

    function displayToast(message) {
        // Display the session status in toast
        const toastBody = document.querySelector('#processToast .toast-body');
        const toastLive = document.getElementById('processToast');

        // Check if a toast message is stored in the cookie
        const cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)toastMessage\s*=\s*([^;]*).*$)|^.*$/, "$1");

        if (cookieValue) {
            toastBody.textContent = cookieValue; // Use the message from the cookie
            // Remove the cookie since the toast message has been displayed
            document.cookie = "toastMessage=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        } else {
            toastBody.textContent = message; // Use the message passed as a parameter
        }

        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLive);
        toastBootstrap.show(); // Show the toast

    }

    // Function to set the temporary password in the input field
    function setTemporaryPassword() {
        const tempPassword = generatePassword();
        const tempPasswordInput = document.getElementById("admin_users_addNewUser_temp_password_input");
        tempPasswordInput.value = tempPassword;
    }
</script>