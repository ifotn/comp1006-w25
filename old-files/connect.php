<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=comp1006', 'root', 'C@mp1006'); 
if (!$db)  {
               echo 'could not connect';
}
else {
    echo 'connected to the database';
}
$db = null;
?> 
</body>
</html>

