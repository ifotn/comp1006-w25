<?php
/* hidden page to check for a username session variable
we have to call session_start() before we can try reading a session var
if session var exists, user is authenticated w/active session => let them continue
if session var doesn't exist, user is not authenticated => redirect to login
*/

// ensure session_start only called once
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit(); // stop any other php code on the page
}
?>