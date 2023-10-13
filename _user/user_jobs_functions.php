<?php
require_once './connection.php';
function updateJobStatus($jobId, $newStatus) {
    global $connection;
    
    // Update the job status in the database
    $updateQuery = "UPDATE tlms_job SET tlms_jobs_status = ? WHERE tlms_jobs_id = ?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param("si", $newStatus, $jobId); // Assuming jobId is an integer
    $success = $stmt->execute();
    $stmt->close();

    return $success;
}
?>