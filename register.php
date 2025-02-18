<?php 
    $title = 'Register';
    include('shared/header.php'); ?>
    <h1>Register</h1>
    <form method="post" action="insert-user.php">
        <fieldset>
            <label for="username">Email:</label>
            <input name="username" type="email" required id="username" maxlength="50" />
        </fieldset>
        <fieldset>
            <label for="password">Password:</label>
            <input name="password" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" id="password" maxlength="50" />
            <span id="pwMsg"></span>
        </fieldset>
        <fieldset>
            <label for="confirm">Confirm Password:</label>
            <input name="confirm" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" id="confirm" onkeyup="return comparePasswords();" maxlength="50" />
        </fieldset>
        <button onclick="return comparePasswords();">Register</button>
    </form>
</main>
</body>
</html>