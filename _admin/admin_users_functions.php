<?php
// session_start();
include("./connection.php");

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if (isset($_POST['action'])) {
    if ($_POST['action'] == "actionAddNewUser") {
        actionAddNewUser();
        // echo "Add New User";
    } elseif ($_POST['action'] == "actionDeleteUser") {
        actionDeleteUser();
    }
}

function actionAddNewUser()
{
    global $connection;

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userRole = $_POST['userRole'];
    $email = $_POST['email'];
    $tempPassword = $_POST['tempPassword'];

    if (empty($firstName) || empty($lastName) || empty($userRole) || empty($email) || empty($tempPassword)) {
        echo "All fields are required!";
        exit;
    }

    // Check if the email already exists in the database
    $checkQuery = "SELECT COUNT(*) FROM tlms_system_users WHERE tlms_system_users_email = ?";
    $checkStmt = mysqli_prepare($connection, $checkQuery);

    if (!$checkStmt) {
        die("Prepared statement creation failed: " . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($checkStmt, "s", $email);    // Bind the email parameter to the prepared statement
    mysqli_stmt_execute($checkStmt);    // Execute the prepared statement
    mysqli_stmt_bind_result($checkStmt, $count);    // Bind the result to a variable
    mysqli_stmt_fetch($checkStmt);    // Fetch the result
    mysqli_stmt_close($checkStmt);    // Close the statement

    // If the email already exists, notify the user and exit
    if ($count > 0) {
        echo "Email already exists in the database!";
        exit;
    }

    // If the email doesn't exist, proceed with user insertion
    // Prepare the SQL statement with placeholders
    $insertQuery = "INSERT INTO tlms_system_users (tlms_system_users_first_name, tlms_system_users_last_name, tlms_system_users_user_role, tlms_system_users_email) VALUES (?,?,?,?)";

    $stmt = mysqli_prepare($connection, $insertQuery);    // Create a prepared statement

    if (!$stmt) {
        die("Prepared statement creation failed: " . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $userRole, $email);    // Bind parameters to the prepared statement
    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        $systemUserId = mysqli_insert_id($connection); // Get the ID of the inserted user
        mysqli_stmt_close($stmt);

        // Check if the userRole is "Admin"
        if ($userRole === "Admin") {

            // Insert data into tlms_admin table
            $insertAdminQuery = "INSERT INTO tlms_admin (tlms_admin_type, tlms_admin_email, tlms_admin_password, tlms_admin_temp_pwd, tlms_admin_system_users_id) VALUES (1, ?, NULL, ?, ?)";
            $stmtAdmin = mysqli_prepare($connection, $insertAdminQuery);

            if (!$stmtAdmin) {
                die("Prepared statement creation for admin failed: " . mysqli_error($connection));
            }

            mysqli_stmt_bind_param($stmtAdmin, "ssi", $email, $tempPassword, $systemUserId);

            if (mysqli_stmt_execute($stmtAdmin)) {
                echo "User Created Successfully";
            } else {
                echo "Error inserting admin data: " . mysqli_error($connection);
            }

            mysqli_stmt_close($stmtAdmin);

        } else if ($userRole === "Manager") {

            // Insert data into tlms_manager table
            $insertManagerQuery = "INSERT INTO tlms_manager (tlms_manager_email, tlms_manager_password, tlms_manager_temp_pwd, tlms_manager_system_users_id) VALUES (?, NULL, ?, ?)";
            $stmtManager = mysqli_prepare($connection, $insertManagerQuery);

            if (!$stmtManager) {
                die("Prepared statement creation for manager failed: " . mysqli_error($connection));
            }

            mysqli_stmt_bind_param($stmtManager, "ssi", $email, $tempPassword, $systemUserId);

            if (mysqli_stmt_execute($stmtManager)) {
                echo "User Created Successfully";
            } else {
                echo "Error inserting manager data: " . mysqli_error($connection);
            }

            mysqli_stmt_close($stmtManager);
        } else if($userRole === "User"){

            // Insert data into tlms_user table
            $insertUserQuery = "INSERT INTO tlms_user (tlms_user_type, tlms_user_email, tlms_user_password, tlms_user_temp_pwd, tlms_user_system_users_id) VALUES (1, ?, NULL, ?, ?)";
            $stmtUser = mysqli_prepare($connection, $insertUserQuery);

            if (!$stmtUser) {
                die("Prepared statement creation for user failed: " . mysqli_error($connection));
            }

            mysqli_stmt_bind_param($stmtUser, "ssi", $email, $tempPassword, $systemUserId);

            if (mysqli_stmt_execute($stmtUser)) {
                echo "User Created Successfully";
            } else {
                echo "Error inserting user data: " . mysqli_error($connection);
            }

            mysqli_stmt_close($stmtUser);

        }
    } else {
        echo "Error inserting user data: " . mysqli_error($connection);
    }

    mysqli_close($connection);
}

function actionDeleteUser()
{
    global $connection;
    // Check if the userId is set in the POST data
    if (isset($_POST['userId'])) {
        $userId = $_POST['userId'];

        // Prepare the SQL statement to delete the user
        $query = "DELETE FROM tlms_system_users WHERE tlms_system_users_id = ?";
        $stmt = mysqli_prepare($connection, $query);

        if (!$stmt) {
            echo "Error: " . mysqli_error($connection);
            exit;
        }

        // Bind the user ID parameter to the prepared statement
        mysqli_stmt_bind_param($stmt, "i", $userId);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "User Deleted successfully";
        } else {
            echo "Error: " . mysqli_error($connection);
        }

        // Close the statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($connection); 
    }
}
