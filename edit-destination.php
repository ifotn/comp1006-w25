<?php
// auth check: only let authenticated users access this page
include('shared/auth-check.php');

    $title = 'Destination Details';
    include('shared/header.php'); 
    
    // fetch selected destination from db to populate form
    // get id from url
    $destinationId = $_GET['destinationId'];

    // set up query
    include('shared/db.php');
    $sql = "SELECT * FROM destinations WHERE destinationId = :destinationId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':destinationId', $destinationId, PDO::PARAM_INT);

    // run query & store result.  use fetch not fetchAll when selecting only 1 record
    $cmd->execute();
    $destination = $cmd->fetch();
    ?>
    <h1>Destination Details</h1>
    <form method="post" action="update-destination.php">
    <fieldset>
        <label for="name">Name:</label>
        <input name="name" required maxlength="50" value="<?php echo $destination['name']; ?>" />
    </fieldset>
    <fieldset>
        <label for="attractions">Attractions:</label>
        <textarea name="attractions" maxlength="255"><?php echo $destination['attractions']; ?></textarea>
    </fieldset>
    <fieldset>
        <label for="countryId">Country:</label>
        <select name="countryId" required>
            <?php
            // connect - commented as we now connect above first
            //include ('shared/db.php');

            // fetch & store country list from db
            $sql = "SELECT * FROM countries ORDER BY name ASC";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $countries = $cmd->fetchAll();

            // add each country to dropdown
            foreach ($countries as $country) {
                if ($country['countryId'] === $destination['countryId']) {
                    echo '<option selected value="' . $country['countryId'] . '">' . $country['name'] . '</option>';
                }
                else {
                    echo '<option value="' . $country['countryId'] . '">' . $country['name'] . '</option>';
                }               
            }

            // disconnect
            $db = null;
            ?>
        </select>
    </fieldset>
    <fieldset>
        <label for="visited">Visited:</label>
        <input type="checkbox" name="visited" 
            <?php //check box if destination has been visisted
            if ($destination['visited'] == 1) {
                echo "checked";
            } 
            ?> />
    </fieldset>
    <button>Save</button>
    <input type="hidden" name="destinationId" value="<?php echo $destinationId; ?>" />
    </form>
        </main>
</body>
</html>