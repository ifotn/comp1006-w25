<?php
// hidden page to remove a user's session, sign them out, and redirect
// access current session
session_start();

// destroy current session + any session vars
session_unset();
session_destroy();

// redirect to login
header('location:login.php');
?>