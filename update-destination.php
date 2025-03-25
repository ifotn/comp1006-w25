<?php
// auth check: only let authenticated users access this page
include('shared/auth-check.php');
?>
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
$destinationId = $_POST['destinationId'];
$name = $_POST['name'];
$attractions = $_POST['attractions'];
$countryId = $_POST['countryId'];

// checkbox returns on / off => must convert to true / false
if (!empty($_POST['visited'])) {
    if ($_POST['visited'] == 'on') {
        $visited = true;
    }
    else {
        $visited = false;
    };
}
else {
    $visited = false;
}

// validation
$ok = true;

if (empty($destinationId)) {
    echo '<h4>Invalid Destination</h4>';
    $ok = false;
}

if (empty($name)) {
    echo '<h4>Name is required</h4>';
    $ok = false;
}
else if (strlen($name) > 50) {
    echo '<h4>Name cannot exceed 50 characters</h4>';
    $ok = false;
}

if (strlen($attractions) > 255) {
    echo '<h4>Attractions cannot exceed 255 characters</h4>';
    $ok = false;
}

if (empty($countryId)) {
    echo '<h4>Country is required</h4>';
    $ok = false;
}
else if (!is_numeric($countryId)) {
    echo '<h4>Country is invalid</h4>';
    $ok = false;
}

// photo check & validation
if ($_FILES['photo']['size'] > 0) {
    $type = mime_content_type($_FILES['photo']['tmp_name']);
    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Please upload a valid image file';
        $ok = false;
    }
    else {
        // create unique name to prevent file overwriting. e.g. logo.png => sd98r32wrli-logo.png
        $photo = uniqid() . '-' . $_FILES['photo']['name'];

        // copy upload to img directory
        move_uploaded_file($_FILES['photo']['tmp_name'], 'img/' . $photo);
    }    
}
else {
    // no new photo uploaded, keep existing photo name from hidden form input
    $photo = $_POST['currentPhoto'];
}

// only save to db if we have no validation errors
if ($ok == true) {
    try {
        // connect
        include ('shared/db.php');

        // set up sql update
        $sql = "UPDATE destinations SET name = :name, attractions = :attractions, countryId = :countryId, visited = :visited, photo = :photo WHERE destinationId = :destinationId";
        $cmd = $db->prepare($sql);

        // fill insert params for safety
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 50);
        $cmd->bindParam(':attractions', $attractions, PDO::PARAM_STR, 255);
        $cmd->bindParam(':countryId', $countryId, PDO::PARAM_INT);
        $cmd->bindParam(':visited', $visited, PDO::PARAM_BOOL);
        $cmd->bindParam(':destinationId', $destinationId, PDO::PARAM_INT);
        $cmd->bindParam(':photo', $photo, PDO::PARAM_STR, 100);

        // execute insert
        $cmd->execute();

        // disconnect
        $db = null;

        // confirmation
        //echo 'Destination saved';
        header('location:destinations.php');
    }
    catch (Exception $err) {
        // show generic error page, not the error description
        header('location:error.php');
    }
}
?>
</body>
</html>