<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destination</title>
</head>
<body>
    <?php include ('shared/header.php'); ?>
    <h1>Destination Details</h1>
    <form method="post" action="save-destination.php">
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
            ?>
        </select>
    </fieldset>
    <fieldset>
        <label for="visited">Visited:</label>
        <input type="checkbox" name="visited" />
    </fieldset>
    <button>Save</button>
    </form>
</body>
</html>