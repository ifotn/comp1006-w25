<?php
/* hidden page: no HTML markup as this page ONLY redirects elsewhere (no content of its own)
Scenario 1: invalid username => redirect to login w/err msg
Scenario 2: valid username, invalid password => redirect to login w/err msg
Scenario 3: valid username + password => store user in session var, redirect to destinations
*/

// store username & password vals from login form
$username = $_POST['username'];
$password = $_POST['password'];

try {
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
        if (password_verify($password, $user['password'])) {
            // access current user's session (PHP makes us do this manually for some bizarre reason)
            // must call session_start BEFORE we can read or write session vars
            session_start();

            // store username in session var so it persists as user loads new pages
            $_SESSION['username'] = $username;

            // disconnect & redirect to destinations page
            $db = null;
            header('location:destinations.php');
        }
        else {
            // wrong password; hashes don't match
            $db = null;
            header('location:login.php?invalid=true');
        }
    }
    else {
        // if username or password don't match anything in db, redirect to login with err message
        $db = null;
        header('location:login.php?invalid=true');
    }
}
catch (Exception $err) {
    // show generic error page, not the error description
    header('location:error.php');
}
?>