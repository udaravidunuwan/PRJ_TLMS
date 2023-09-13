<?php
session_start();
include("./connection.php");

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if(isset($_POST['action'])){
    if($_POST['action'] == "action"){
        signinUser();
    }
}

function signinUser(){
    global $connection;
    
    $user_email = $_POST['emailSignin'];
    $user_password = $_POST['passwordSignin'];

    if(empty($user_email) || empty($user_password)){
        echo "User Email and Password are required!";
        exit;
    }
    
    $query = "SELECT * FROM tlms_user WHERE tlms_user_email = ?";
    $checkStmt = $connection->prepare($query);
    if($checkStmt) {
        $checkStmt->bind_param("s", $user_email);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        
        if($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $stored_password = $user['tlms_user_password'];
            // $admin_type = $admin['tlms_admin_type'];

            if($stored_password == $user_password) {
                echo "Sign in Successful";
                $_SESSION["signin"] = true;
                $_SESSION["session_id"] = $user['tlms_user_id'];
                $_SESSION["user_type"] = $user['tlms_user_type'];
                exit;
            } else {
                echo "Sign in Failed! Passsword does not exist";
                exit;
            }
        } else {
            echo "No users found with email " . $user_email . " in the database";
            exit;
        }

    }
    echo "Error: " . $checkStmt->error;
}