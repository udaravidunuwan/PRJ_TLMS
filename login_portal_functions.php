<?php
session_start();
include("./connection.php");

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if (isset($_POST['action'])) {
    if ($_POST['action'] == "action") {
        login();
    }
}

function login()
{
    global $connection;

    $email = $_POST['emailSignin'];
    $password = $_POST['passwordSignin'];

    if (empty($email) || empty($password)) {
        echo "Email and Password are required!";
        // $_SESSION['status'] = "Admin Email and Password are required!";
        // echo $_SESSION['status'];
        exit;
    }

    $query = "SELECT * FROM tlms_system_users WHERE tlms_system_users_email = ?";
    $checkStmt = $connection->prepare($query);
    if ($checkStmt) {
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows == 1) {
            $admin = $result->fetch_assoc();
            $stored_password = $admin['tlms_system_users_password'];
            $stored_password_temp = $admin['tlms_system_users_temp_password'];
            // $admin_type = $admin['tlms_admin_type'];

            if ($stored_password == $password) {
                echo "Sign in Successful";
                $_SESSION["signin"] = true;
                $_SESSION["session_id"] = $admin['tlms_system_users_id'];
                $_SESSION["user_role"] = $admin['tlms_system_users_user_role'];
                // $_SESSION["admin_type"] = $admin['tlms_system_users_user_type'];
                exit;
            } else if ($stored_password_temp == $password) {
                echo "Welcome New User";
                $_SESSION["signin"] = true;
                $_SESSION["session_id"] = $admin['tlms_system_users_id'];
                $_SESSION["user_role"] = $admin['tlms_system_users_user_role'];
                // $_SESSION["admin_type"] = $admin['tlms_system_users_user_type'];
                exit;
            } else {
                echo "Sign in Failed! Incorrect Passsword";
                // $_SESSION['status'] = "Sign in Failed! Please try again";
                exit;
            }
        } else {
            echo "No users found with email " . $email . " in the database";
            // $_SESSION['status'] = "No users found with email " . $admin_password . " in the database";
            exit;
        }
    }
    echo "Error: " . $checkStmt->error;
    // $_SESSION['status'] = "Error: " . $checkStmt->error;
}
