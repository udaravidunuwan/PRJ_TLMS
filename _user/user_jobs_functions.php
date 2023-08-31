<?php
    // Include your database connection code if not included already
    require './connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $jobId = $_POST['jobId'];
      $newStatus = $_POST['newStatus'];
      
      // Fetch and display job data from the database
      $query = "SELECT * FROM tlms_job WHERE tlms_jobs_id = ?";
      $stmt = mysqli_prepare($connection, $query);
      mysqli_stmt_bind_param($stmt, "s", $jobId);
  
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $job = mysqli_fetch_assoc($result);
      mysqli_stmt_close($stmt);
    }
?>