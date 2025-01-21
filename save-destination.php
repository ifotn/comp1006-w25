<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saving Destination...</title>
</head>
<body>
<?php
// capture form inputs into vars
$name = $_POST['name'];
$attractions = $_POST['attractions'];
$countryId = $_POST['countryId'];

// checkbox returns on / off => must convert to true / false
if ($_POST['visited'] == 'on') {
    $visited = true;
}
else {
    $visited = false;
};

// connect
include ('shared/db.php');

// set up sql insert
$sql = "INSERT INTO destinations (name, attractions, countryId, visited) VALUES 
    (:name, :attractions, :countryId, :visited)";
$cmd = $db->prepare($sql);

// fill insert params for safety
$cmd->bindParam(':name', $name, PDO::PARAM_STR, 50);
$cmd->bindParam(':attractions', $attractions, PDO::PARAM_STR, 255);
$cmd->bindParam(':countryId', $countryId, PDO::PARAM_INT);
$cmd->bindParam(':visited', $visited, PDO::PARAM_BOOL);

// execute insert
$cmd->execute();

// disconnect
$db = null;

// confirmation
echo 'Destination saved';
?>
</body>
</html>