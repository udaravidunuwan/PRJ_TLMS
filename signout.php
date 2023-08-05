<?php 
require './_admin/admin_signin_functions.php';
$_SESSION = [];
session_unset();
session_destroy();
header("Location: ./index.php");
?>