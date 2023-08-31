// Check if $email is present in tlms_admin table
// $checkAdminQuery = "SELECT * FROM tlms_admin WHERE tlms_admin_email=?";
// $stmt = mysqli_prepare($connection, $checkAdminQuery);
// mysqli_stmt_bind_param($stmt, "s", $email);
// mysqli_stmt_execute($stmt);
// $result = mysqli_stmt_get_result($stmt);

// if (mysqli_num_rows($result) > 0) {
// // $email is present in tlms_admin table, continue with data update
// // Update the user's information in the tlms_system_users table
// $updateQuery = "UPDATE tlms_system_users SET tlms_system_users_first_name=?, tlms_system_users_last_name=?, tlms_system_users_user_role=? WHERE tlms_system_users_id=?";
// $stmt = mysqli_prepare($connection, $updateQuery);
// mysqli_stmt_bind_param($stmt, "sssi", $firstName, $lastName, $userRole, $userId);

// if (mysqli_stmt_execute($stmt)) {
// echo "User Updated Successfully";
// } else {
// echo "Error updating user: " . mysqli_error($connection);
// }

// mysqli_stmt_close($stmt);
// } else {
// // $email is not in tlms_admin table, check tlms_manager and tlms_user

// // Check if $email is present in tlms_manager table
// $checkManagerQuery = "SELECT * FROM tlms_manager WHERE tlms_manager_email=?";
// $stmt = mysqli_prepare($connection, $checkManagerQuery);
// mysqli_stmt_bind_param($stmt, "s", $email);
// mysqli_stmt_execute($stmt);
// $result = mysqli_stmt_get_result($stmt);

// if (mysqli_num_rows($result) > 0) {
// // $email is present in tlms_manager table
// $managerRow = mysqli_fetch_assoc($result);

// // Insert the data into tlms_admin table
// $insertAdminQuery = "INSERT INTO tlms_admin (tlms_admin_email, tlms_admin_password, tlms_admin_temp_pwd, tlms_admin_system_users_id) VALUES (?, ?, ?, ?)";
// $stmt = mysqli_prepare($connection, $insertAdminQuery);
// mysqli_stmt_bind_param($stmt, "sssi", $managerRow['tlms_manager_email'], $managerRow['tlms_manager_password'], $managerRow['tlms_manager_temp_pwd'], $managerRow['tlms_manager_system_users_id']);

// if (mysqli_stmt_execute($stmt)) {
// // Delete the row from tlms_manager table
// $deleteManagerQuery = "DELETE FROM tlms_manager WHERE tlms_manager_email=?";
// $stmtDelete = mysqli_prepare($connection, $deleteManagerQuery);
// mysqli_stmt_bind_param($stmtDelete, "s", $email);

// if (mysqli_stmt_execute($stmtDelete)) {
// // Manager row deleted successfully
// echo "User Updated Successfully"; // You may want to change this message
// } else {
// echo "Error deleting manager row: " . mysqli_error($connection);
// }
// mysqli_stmt_close($stmtDelete);
// } else {
// echo "Error updating user: " . mysqli_error($connection);
// }




// mysqli_stmt_close($stmt);
// } else {
// // $email is not in tlms_admin table, check tlms_user

// // Check if $email is present in tlms_user table
// $checkUserQuery = "SELECT * FROM tlms_user WHERE tlms_user_email=?";
// $stmt = mysqli_prepare($connection, $checkUserQuery);
// mysqli_stmt_bind_param($stmt, "s", $email);
// mysqli_stmt_execute($stmt);
// $result = mysqli_stmt_get_result($stmt);

// if (mysqli_num_rows($result) > 0) {
// // $email is present in tlms_user table
// $userRow = mysqli_fetch_assoc($result);

// // Insert the data into tlms_admin table
// $insertAdminQuery = "INSERT INTO tlms_admin (tlms_admin_email, tlms_admin_password, tlms_admin_temp_pwd, tlms_admin_system_users_id) VALUES (?, ?, ?, ?)";
// $stmt = mysqli_prepare($connection, $insertAdminQuery);
// mysqli_stmt_bind_param($stmt, "sssi", $userRow['tlms_user_email'], $userRow['tlms_user_password'], $userRow['tlms_user_temp_pwd'], $userRow['tlms_user_system_users_id']);

// if (mysqli_stmt_execute($stmt)) {
// // Delete the row from tlms_user table
// $deleteUserQuery = "DELETE FROM tlms_user WHERE tlms_user_email=?";
// $stmtDelete = mysqli_prepare($connection, $deleteUserQuery);
// mysqli_stmt_bind_param($stmtDelete, "s", $email);

// if (mysqli_stmt_execute($stmtDelete)) {
// // User row deleted successfully
// } else {
// echo "Error deleting user row: " . mysqli_error($connection);
// }

// mysqli_stmt_close($stmtDelete);
// echo "User Updated Successfully"; // You may want to change this message
// } else {
// echo "Error updating user: " . mysqli_error($connection);
// }

// mysqli_stmt_close($stmt);
// } else {
// // Handle the case where $email is not found in tlms_user table
// echo "Email not found in tlms_user.";
// }
// }
// }