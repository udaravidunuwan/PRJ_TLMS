<?php
  // Include your database connection code if not included already
  include './connection.php';

// Fetch data from the database table
$query = "SELECT * FROM tlms_job";
$result = mysqli_query($connection, $query);

// Check if there is any data
if (mysqli_num_rows($result) > 0) {
    $data = array();
    
    // Fetch rows and store them in an array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Return the data as JSON
    // header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo 'No data found';
}
?>