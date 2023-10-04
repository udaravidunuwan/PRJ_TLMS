<?php 
require './_admin/admin_signin_functions.php';

// Delete all existing cookies
$cookies = $_COOKIE;
foreach($cookies as $cookie_name => $cookie_value) {
    setcookie($cookie_name, '', time() - 3600, '/');
}

$_SESSION = [];
session_unset();
session_destroy();
header("Location: ./index.php");
?>