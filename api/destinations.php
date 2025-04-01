<?php
// connect
include('../shared/db.php');

// optional name filter eg. /api/destinations.php?name=Paris
$name = null;

// fetch destinations from db
$sql = "SELECT * FROM destinations";

// add where clause filter if url has a name parameter
if (!empty($_GET['name'])) {
    $name = $_GET['name'];
    $sql .= " WHERE name = :name";
}

$cmd = $db->prepare($sql);

// fill name param if we have one
if (!empty($_GET['name'])) {
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 50);
}

$cmd->execute();
// structure results in array format so we can then convert to json
$destinations = $cmd->fetchAll(PDO::FETCH_ASSOC);

// convert dataset to json & send response (we don't care about the UI)
echo json_encode($destinations);

// disconnect
$db = null;
?>