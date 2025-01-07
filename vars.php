<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables</title>
</head>
<body>
    <?php
    // try some numeric vars.  always start with $
    $x = 20;
    $y = 10;
    $z = $x + $y;
    echo $z . '<br />';

    // php is loosely-typed.  var types are implied but changeable
    $y = 'abc';
    //$z = $x + $y;
    //echo $z; commenting this so our page doesn't crash

    // try string vars using . for concatenation
    $first = 'Ralph';
    $last = "Fubar";
    echo $first . ' ' . $last;

    echo "<h1>$first</h1>";
    echo '<h1>$first</h1>';

    ?>
</body>
</html>