<?php
// Include your database connection code if not included already
require 'tlms_db'; // Replace with your actual connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobId = $_POST['jobId'];
    
    // Update the job status in the database
    $updateQuery = "UPDATE tlms_jobs SET tlms_jobs_status = 'Completed' WHERE tlms_jobs_id = ?";
    $stmt = mysqli_prepare($connection, $updateQuery);
    mysqli_stmt_bind_param($stmt, "s", $jobId);
    mysqli_stmt_execute($stmt);
    
    // Handle any other relevant actions, such as updating timestamps, etc.
    
    mysqli_stmt_close($stmt);
    
    // Return a response to indicate success or failure
    if ($stmt) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "message" => "Failed to update job status"));
    }
}
?>