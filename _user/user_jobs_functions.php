<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedStatus = $_POST['selectedStatus'];
    
    // Process the selected status as needed, such as storing it in a database or performing actions.

    // Send a response back to the client (if needed)
    echo "Status selected: " . $selectedStatus;
}
?>