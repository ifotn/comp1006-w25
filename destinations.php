<?php 
    $title = 'Destinations';
    include('shared/header.php'); ?>
    <h1>Destinations</h1>
    <a href="destination.php">Add a New Destination</a>
    <?php
    include ('shared/db.php');

    $sql = "SELECT * FROM destinations";
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $destinations = $cmd->fetchAll();

    echo '<table><thead><th>Name</th><th>Attractions</th><th>Country</th><th>Visited</th></thead>';
        foreach ($destinations as $destination) {
            echo "<tr>
                <td>{$destination['name']}</td>
                <td>{$destination['attractions']}</td>
                <td>{$destination['countryId']}</td>
                <td>{$destination['visited']}</td>
                </tr>";
        }
    echo '</table>';

    $db = null;
    ?>
    </main>
</body>
</html>