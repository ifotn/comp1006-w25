<?php
$title = 'Saving Registration...';
include('shared/header.php');

// 1 - capture form inputs using $_POST array
$username = $_POST['username'];
$password = $_POST['password'];
$ok = true;

// validate
if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    echo 'Username must be a properly-formatted email';
    $ok = false;
}

if (!preg_match('@[A-Z]@', $password)) {
    echo 'Invalid password format';
    $ok = false;
}

if (!preg_match('@[a-z]@', $password)) {
    echo 'Invalid password format';
    $ok = false;
}

if (!preg_match('@[0-9]@', $password)) {
    echo 'Invalid password format';
    $ok = false;
}

if (!preg_match('@[^\W]@', $password)) {
    echo 'Invalid password format';
    $ok = false;
}

if (strlen(trim($password)) < 8) {
    echo 'Invalid password format';
    $ok = false;
}

if ($ok) {
    // live aws db
    try {
        include('shared/db.php');

        // check if username already exists
        $sql = "SELECT * FROM users WHERE username = :username";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR);
        $cmd->execute();
        $user = $cmd->fetch();
        
        if ($user) {
            echo 'User already exists';
            $db = null;
            exit();  // don't process any more php code
        }

        // 3 - set up SQL INSERT to add new record to db
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

        // here is the unsafe version!!  I will deduct marks for this
        //$sql = "INSERT INTO users (username, password) VALUES ($username, $password)";

        // 4 - pass each form value as a parameter to the insert for safety
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        // old code - no hasing => UNSAFE!!
        //$cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
        // new code - hashing => SAFETY
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $cmd->bindParam(':password', $hashedPassword, PDO::PARAM_STR, 128);

        // 5 - execute the save
        $cmd->execute();

        // 6 - disconnect
        $db = null;

        // 7 - show confirmation message
        echo 'Your Registration was Saved. Use the Login link above to sign in.';

        // 8 - optional redirect
        //header('location:login.php');
    }
    catch (Exception $err) {
        // show generic error page, not the error description
        header('location:error.php');
    }
}
?>
</body>
</html>