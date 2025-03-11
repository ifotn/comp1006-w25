<?php
// store username & password vals from login form
$username = $_POST['username'];
$password = $_POST['password'];

// connect
include('shared/db.php');

// set up query to first check for username (plain text)
$sql = "SELECT * FROM users WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$user = $cmd->fetch();

// if username exists, now hash password entered and compare to password in db (hashed)
if ($user) {
    // if hashed passwords match, connect to current session & store username in session var, then redirect

}
else {
    // if username or password don't match anything in db, redirect to login with err message
    $db = null;
    header('location:login.php?invalid=true');
}
?>