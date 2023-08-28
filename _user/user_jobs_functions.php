<?php
    // Include your database connection code if not included already
    require './connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $jobId = $_POST['jobId'];
        $newStatus = $_POST['newStatus'];
        
      // Fetch and display job data from the database
      $selectQuery = "SELECT * FROM tlms_job";
      $result = mysqli_query($connection, $selectQuery);
      while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr data-job-id="' . htmlspecialchars($row['tlms_jobs_id']) . '">
                  <td>' . htmlspecialchars($row['tlms_jobs_id']) . '</td>
                  <td>' . htmlspecialchars($row['tlms_jobs_name']) . '</td>
                  <td>' . htmlspecialchars($row['tlms_jobs_customer']) . '</td>
                  <td>' . htmlspecialchars($row['tlms_jobs_start_date']) . '</td>
                  <td>' . htmlspecialchars($row['tlms_jobs_completed_date']) . '</td>
                  <td>' . htmlspecialchars($row['tlms_jobs_status']) . '</td>
                  <td>' . htmlspecialchars($row['tlms_jobs_assign_to']) . '</td>
              </tr>';
      }
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