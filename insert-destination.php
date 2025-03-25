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
    // original file name + extension
    //echo $_FILES['photo']['name'] . '<br />';

    // file size in bytes (1 kb = 1024 kb)
    //echo $_FILES['photo']['size'] . '<br />';

    // file type - only based on extension and is NOT accurate or safe
    //echo $_FILES['photo']['type'] . '<br />';

    // temp location of upload in server cache
    //echo $_FILES['photo']['tmp_name'] . '<br />';

    // use MIME type instead of type to check the ACTUAL file type, not just extension
    //echo mime_content_type($_FILES['photo']['tmp_name']) . '<br />';

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

// only save to db if we have no validation errors
if ($ok == true) {
    // connect
    include ('shared/db.php');

    // set up sql insert
    $sql = "INSERT INTO destinations (name, attractions, countryId, visited, photo) VALUES 
        (:name, :attractions, :countryId, :visited, :photo)";
    $cmd = $db->prepare($sql);

    // fill insert params for safety
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 50);
    $cmd->bindParam(':attractions', $attractions, PDO::PARAM_STR, 255);
    $cmd->bindParam(':countryId', $countryId, PDO::PARAM_INT);
    $cmd->bindParam(':visited', $visited, PDO::PARAM_BOOL);
    $cmd->bindParam(':photo', $photo, PDO::PARAM_STR, 100);

    // execute insert
    $cmd->execute();

    // disconnect
    $db = null;

    // confirmation
    echo 'Destination saved';
}
?>
</body>
</html>