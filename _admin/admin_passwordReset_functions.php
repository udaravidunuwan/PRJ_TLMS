<?php
session_start();
include("./connection.php");

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if (isset($_POST['action'])) {
    if ($_POST['action'] == "action") {
        passwordReset();
    }
}

function passwordReset(){
    global $connection;
    
}