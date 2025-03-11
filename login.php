<?php 
$title = 'Login';
include('shared/header.php'); ?>
<h1>Login</h1>
<?php
if (isset($_GET['invalid'])) {
    echo '<h5 class="err">Invalid Login</h5>';
}
?>
<form method="post" action="check-login.php">
    <fieldset>
        <label for="username">Email:</label>
        <input name="username" required type="email" maxlength="50" />
    </fieldset>
    <fieldset>
        <label for="password">Password:</label>
        <input name="password" required type="password" maxlength="50" />
    </fieldset>
    <button>Login</button>
</form>
</main>
</body>
</html>