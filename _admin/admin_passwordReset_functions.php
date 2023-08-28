<?php
// session_start();
include("./connection.php");

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if (isset($_POST['action'])) {
    if ($_POST['action'] == "action") {
        passwordReset();
    }
}

function passwordReset()
{
    global $connection;

    $admin_password = $_POST['adminPassword'];
    $admin_password_confirm = $_POST['adminPasswordConfirm'];

    if (empty($admin_password) || empty($admin_password_confirm)) {
        echo "Both Password and Confirm Password are required!";
        exit;
    } else if ($admin_password !== $admin_password_confirm) {
        echo "Password and Confirm Password don't match!";
        exit;
    }

    // Check if the user is logged in, and if so, get their tlms_admin_id from the session
    session_start(); // Start the session if not already started
    if (!isset($_SESSION["session_id"])) {
        echo "User not logged in.";
        exit;
    }

    $admin_id = $_SESSION["session_id"];

    // Update the tlms_admin table for the user
    $updateQuery = "UPDATE tlms_admin SET tlms_admin_password = ?, tlms_admin_temp_pwd = NULL WHERE tlms_admin_id = ?";
    $stmt = mysqli_prepare($connection, $updateQuery);

    if (!$stmt) {
        die("Prepared statement creation failed: " . mysqli_error($connection));
    }

    // Assuming the password is stored as plain text in the database, you can update it directly.
    mysqli_stmt_bind_param($stmt, "si", $admin_password, $admin_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Password Updated Successfully";
    } else {
        echo "Error updating password: " . mysqli_error($connection);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}
