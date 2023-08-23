<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js">
</script>

<script type="text/javascript">
    // Theme Selector
    (() => {
        'use strict'

        const getStoredTheme = () => localStorage.getItem('theme')
        const setStoredTheme = theme => localStorage.setItem('theme', theme)

        const getPreferredTheme = () => {
            const storedTheme = getStoredTheme()
            if (storedTheme) {
                return storedTheme
            }

            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        }

        const setTheme = theme => {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }

        setTheme(getPreferredTheme())

        const showActiveTheme = (theme, focus = false) => {
            const themeSwitcher = document.querySelector('#bd-theme')

            if (!themeSwitcher) {
                return
            }

            const themeSwitcherText = document.querySelector('#bd-theme-text')
            const activeThemeIcon = document.querySelector('.theme-icon-active use')
            const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
            const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')

            document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                element.classList.remove('active')
                element.setAttribute('aria-pressed', 'false')
            })

            btnToActive.classList.add('active')
            btnToActive.setAttribute('aria-pressed', 'true')
            activeThemeIcon.setAttribute('href', svgOfActiveBtn)
            const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
            themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

            if (focus) {
                themeSwitcher.focus()
            }
        }

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            const storedTheme = getStoredTheme()
            if (storedTheme !== 'light' && storedTheme !== 'dark') {
                setTheme(getPreferredTheme())
            }
        })

        window.addEventListener('DOMContentLoaded', () => {
            showActiveTheme(getPreferredTheme())

            document.querySelectorAll('[data-bs-theme-value]')
                .forEach(toggle => {
                    toggle.addEventListener('click', () => {
                        const theme = toggle.getAttribute('data-bs-theme-value')
                        setStoredTheme(theme)
                        setTheme(theme)
                        showActiveTheme(theme, true)
                    })
                })
        })
    })()
    // End of theme selector


    $(document).ready(function() {

        // DataTable Loader
        $('#admin_users_table').DataTable();


        // admin signin event click listner
        $("#adminSigninBtn").on("click", function(event) {
            event.preventDefault(); // Prevent form submission for now
            adminSignin(); // Call your function
        });
        // end 

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

    function adminSignin() {
        $(document).ready(function() {
            var data = {
                action: $('#action').val(),
                emailSignin: $('#adminEmail').val(),
                passwordSignin: $('#adminPassword').val(),
            };
            // alert('check');
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

    function admin_users_addNewUser_btn() {
        alert('Add New User');
        $(document).ready(function() {
            var data = {
                firstName: $('#admin_users_addNewUser_firstName').val(),
                lastName: $('#admin_users_addNewUser_lastName').val(),
                userRole: $('#admin_users_addNewUser_userRole').val(),
                email: $('#admin_users_addNewUser_email').val(),
                tempPassword: $('#admin_users_addNewUser_temp_password_input').val(),
            };
            // alert(data);
            alert(JSON.stringify(data));
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

    // Function to set the temporary password in the input field
    function setTemporaryPassword() {
        const tempPassword = generatePassword();
        const tempPasswordInput = document.getElementById("admin_users_addNewUser_temp_password_input");
        tempPasswordInput.value = tempPassword;
    }

    function admin_users_editUser_btn() {
        alert('Edit User');
    }

    function admin_users_deleteUser_btn() {
        alert('Delete User');
    }
</script>