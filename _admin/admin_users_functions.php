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
    } elseif ($_POST['action'] == "actionEditUser") {
        actionEditUser();
    } elseif ($_POST['action'] == "actionDeleteUser") {
        actionDeleteUser();
    } elseif ($_POST['action'] == "getUserData") {
        getUserData();
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
    $insertQuery = "INSERT INTO tlms_system_users (tlms_system_users_first_name, tlms_system_users_last_name, tlms_system_users_user_role, tlms_system_users_email, tlms_system_users_temp_password) VALUES (?,?,?,?,?)";

    $stmt = mysqli_prepare($connection, $insertQuery);    // Create a prepared statement

    if (!$stmt) {
        die("Prepared statement creation failed: " . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $userRole, $email, $tempPassword);    // Bind parameters to the prepared statement
    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "User Created Successfully";
    } else {
        echo "Error inserting user data: " . mysqli_error($connection);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}

function getUserData()
{
    global $connection;
    if (isset($_POST['userId'])) {
        $userId = $_POST['userId'];

        // Prepare a query to fetch user data
        $query = "SELECT tlms_system_users_first_name, tlms_system_users_last_name, tlms_system_users_user_role, tlms_system_users_email FROM tlms_system_users WHERE tlms_system_users_id = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "i", $userId);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            $userData = mysqli_fetch_assoc($result);

            // Return user data as JSON
            header('Content-Type: application/json'); // Set the response content type to JSON
            echo json_encode($userData);
        } else {
            echo json_encode(array("error" => "Error fetching user data"));
        }

        mysqli_stmt_close($stmt);
    }
}

// Edit User i completely Changed Remake it-----------------------------------------------------------------------------IMPORTANT---------------------------------------------------
function actionEditUser()
{
    global $connection;

    // Check if the required data is set in the POST request
    if (isset($_POST['userId'], $_POST['firstName'], $_POST['lastName'], $_POST['userRole'], $_POST['email'])) {
        $userId = $_POST['userId'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $userRole = $_POST['userRole'];
        $email = $_POST['email'];
        // Check user role and call the appropriate function
        if ($userRole === 'Admin') {
            actionEditUserAdmin();
        } elseif ($userRole === 'Manager') {
            actionEditUserManager();
        } elseif ($userRole === 'User') {
            actionEditUserUser();
        }
        echo "User Updated Successfully";
    } else {
        echo "Missing required data.";
    }
}

function actionEditUserAdmin()
{
    global $connection;

    // Check if $email is present in tlms_admin table
    $checkAdminQuery = "SELECT * FROM tlms_admin WHERE tlms_admin_email=?";
    $stmt = mysqli_prepare($connection, $checkAdminQuery);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        return "User Updated Successfully";
    }
}
function actionEditUserManager()
{
}
function actionEditUserUser()
{
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
