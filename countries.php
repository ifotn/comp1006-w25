<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countries</title>
</head>
<body>
    <?php include('shared/header.php'); ?>
    <h1>Countries</h1>
    <?php
    // connect
    include('shared/db.php');
    
    // set up the query 
    $sql = "SELECT * FROM countries";

    // run query and store results
    $cmd = $db->prepare($sql);

    // loop through results and output each country
    $cmd->execute();
    $countries = $cmd->fetchAll();

    echo '<ul>';

    foreach ($countries as $country) {
        echo '<li>' . $country['name'] . '</li>';
    }

    echo '</ul>';

    // disconnect
    $db = null;
    ?>
</body>
</html>