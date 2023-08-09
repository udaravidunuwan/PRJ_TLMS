<?php
session_start();
include("./connection.php");

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if(isset($_POST['action'])){
    if($_POST['action'] == "action"){
        signinAdmin();
    }
}

function signinAdmin(){
    global $connection;
    
    $admin_email = $_POST['emailSignin'];
    $admin_password = $_POST['passwordSignin'];

    if(empty($admin_email) || empty($admin_password)){
        echo "Admin Email and Password are required!";
        // $_SESSION['status'] = "Admin Email and Password are required!";
        // echo $_SESSION['status'];
        exit;
    }
    
    $query = "SELECT * FROM tlms_admin WHERE tlms_admin_email = ?";
    $checkStmt = $connection->prepare($query);
    if($checkStmt) {
        $checkStmt->bind_param("s", $admin_email);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        
        if($result->num_rows == 1) {
            $admin = $result->fetch_assoc();
            $stored_password = $admin['tlms_admin_password'];
            // $admin_type = $admin['tlms_admin_type'];

            if($stored_password == $admin_password) {
                echo "Sign in Successful";
                $_SESSION["signin"] = true;
                $_SESSION["session_id"] = $admin['tlms_admin_id'];
                $_SESSION["admin_type"] = $admin['tlms_admin_type'];
                exit;
            } else {
                echo "Sign in Failed! Passsword does not exist";
                // $_SESSION['status'] = "Sign in Failed! Please try again";
                exit;
            }
        } else {
            echo "No users found with email " . $admin_email . " in the database";
            // $_SESSION['status'] = "No users found with email " . $admin_password . " in the database";
            exit;
        }

    }
    echo "Error: " . $checkStmt->error;
    // $_SESSION['status'] = "Error: " . $checkStmt->error;
}