<?php
// auth check: only let authenticated users access this page
include('shared/auth-check.php');

// get destinationId from URL parameter using GET
$destinationId = $_GET['destinationId'];

try {
    // connect & set up SQL command
    include ('shared/db.php');
    $sql = "DELETE FROM destinations WHERE destinationId = :destinationId";
    $cmd = $db->prepare($sql);

    // pass in id parameter
    $cmd->bindParam(':destinationId', $destinationId, PDO::PARAM_INT);

    // execute delete
    $cmd->execute();

    // disconnect
    $db = null;

    // redirect to updated destination list
    header('location:destinations.php');
}
catch (Exception $err) {
    // show generic error page, not the error description
    header('location:error.php');
}
?>