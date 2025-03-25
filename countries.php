<?php 
    $title = 'Countries';
    include('shared/header.php'); ?>
    <h1>Countries</h1>
    <?php
    try {
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
    }
    catch (Exception $err) {
        // show generic error page, not the error description
        header('location:error.php');
    }
    ?>
    </main>
</body>
</html>