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

            if($stored_password == $admin_password) {
                echo "Sign in Successful";
                $_SESSION["signin"] = true;
                $_SESSION["session_id"] = $admin['tlms_admin_id'];
                exit;
            } else {
                echo "Sign in Failed! Please try again";
                exit;
            }
        } else {
            echo "No users found with email " . $admin_password . " in the database";
            exit;
        }

    }
    echo "Error: " . $checkStmt->error;
} 
