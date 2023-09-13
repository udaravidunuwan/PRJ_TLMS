<?php
session_start();
include("./connection.php");

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if(isset($_POST['action'])){
    if($_POST['action'] == "action"){
        signinManager();
    }
}

function signinManager(){
    global $connection;
    
    $manager_email = $_POST['emailSignin'];
    $manager_password = $_POST['passwordSignin'];

    if(empty($manager_email) || empty($manager_password)){
        echo "Manager Email and Password are required!";
        exit;
    }
    
    $query = "SELECT * FROM tlms_manager WHERE tlms_manager_email = ?";
    $checkStmt = $connection->prepare($query);
    if($checkStmt) {
        $checkStmt->bind_param("s", $manager_email);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        
        if($result->num_rows == 1) {
            $manager = $result->fetch_assoc();
            $stored_password = $manager['tlms_manager_password'];

            if($stored_password == $manager_password) {
                echo "Sign in Successful";
                $_SESSION["signin"] = true;
                $_SESSION["session_id"] = $manager['tlms_manager_id'];
                exit;
            } else {
                echo "Sign in Failed! Passsword does not exist";
                exit;
            }
        } else {
            echo "No users found with email " . $manager_email . " in the database";
            exit;
        }

    }
    echo "Error: " . $checkStmt->error;
}
