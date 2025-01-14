<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php include('shared/header.php'); ?>
    <h1>Register</h1>
    <form method="post" action="insert-user.php">
        <fieldset>
            <label for="username">Username:</label>
            <input name="username" />
        </fieldset>
        <fieldset>
            <label for="password">Password:</label>
            <input name="password" type="password" />
        </fieldset>
        <button>Register</button>
    </form>
</body>
</html>