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

//echo "$username - $password";

// 2 - connect to db
// local db
//$db = new PDO('mysql:host=127.0.0.1;dbname=comp1006', 'root', 'C@mp1006'); 

// live aws db
include('shared/db.php');

// 3 - set up SQL INSERT to add new record to db
$sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

// here is the unsafe version!!  I will deduct marks for this
//$sql = "INSERT INTO users (username, password) VALUES ($username, $password)";

// 4 - pass each form value as a parameter to the insert for safety
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);

// 5 - execute the save
$cmd->execute();

// 6 - disconnect
$db = null;

// 7 - show confirmation message
echo 'Your Registration was Saved';

// 8 - optional redirect
//header('location:login.php');
?>
</body>
</html>