<?php 
// auth check: only let authenticated users access this page
include('shared/auth-check.php');

    $title = 'Destination Details';
    include('shared/header.php'); ?>
    <h1>Destination Details</h1>
    <form method="post" action="insert-destination.php" enctype="multipart/form-data">
    <fieldset>
        <label for="name">Name:</label>
        <input name="name" required maxlength="50" />
    </fieldset>
    <fieldset>
        <label for="attractions">Attractions:</label>
        <textarea name="attractions" maxlength="255"></textarea>
    </fieldset>
    <fieldset>
        <label for="countryId">Country:</label>
        <select name="countryId" required>
            <?php
            try {
                // connect
                include ('shared/db.php');

                // fetch & store country list from db
                $sql = "SELECT * FROM countries ORDER BY name ASC";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $countries = $cmd->fetchAll();

                // add each country to dropdown
                foreach ($countries as $country) {
                    echo '<option value="' . $country['countryId'] . '">' . $country['name'] . '</option>';
                }

                // disconnect
                $db = null;
            }
            catch (Exception $err) {
                // show generic error page, not the error description
                header('location:error.php');
            }
            ?>
        </select>
    </fieldset>
    <fieldset>
        <label for="visited">Visited:</label>
        <input type="checkbox" name="visited" />
    </fieldset>
    <fieldset>
        <label for="photo">Photo:</label>
        <input type="file" name="photo" accept=".jpg,.png" />
    </fieldset>
    <button>Save</button>
    </form>
        </main>
</body>
</html>