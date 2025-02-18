<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saving your Registration...</title>
</head>
<body>
<?php
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

if ($ok) {
    
    // live aws db
    include('shared/db.php');

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
    $cmd->bindParam(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR, 128);

    // 5 - execute the save
    $cmd->execute();

    // 6 - disconnect
    $db = null;

    // 7 - show confirmation message
    echo 'Your Registration was Saved';

    // 8 - optional redirect
    //header('location:login.php');
}
?>
</body>
</html>