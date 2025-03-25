<?php 
    $title = 'Destinations';
    include('shared/header.php'); ?>
    <h1>Destinations</h1>
    <?php
    // only call session_start ONCE per page
    //session_start(); - commented here as session_start already called in header above
    if (isset($_SESSION['username'])) {
        echo '<a href="add-destination.php">Add a New Destination</a>';
    }

    include ('shared/db.php');

    $sql = "SELECT destinationId, destinations.name, attractions, photo, visited, countries.name AS country FROM destinations INNER JOIN countries ON destinations.countryId = countries.countryId";
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $destinations = $cmd->fetchAll();

    echo '<table><thead><th>Name</th><th>Photo</th><th>Attractions</th><th>Country</th><th>Visited</th>';
    // only show Actions heading to authenticated users
    if (isset($_SESSION['username'])) {
        echo '<th>Actions</th>';
    }
        
    echo '</thead>';
        foreach ($destinations as $destination) {
            echo "<tr>
                <td>{$destination['name']}</td>
                <td>";
                if ($destination['photo'] != null) {
                    echo '<img src="img/' . $destination['photo'] . '" alt="Destination Photo" class="thumbnail" />';
                }
                echo "</td>
                <td>{$destination['attractions']}</td>
                <td>{$destination['country']}</td>
                <td>{$destination['visited']}</td>"; 
            // only show Edit / Delete buttons to authenticated users         
            if (isset($_SESSION['username'])) {
                echo "<td>
                    <a href=\"edit-destination.php?destinationId={$destination['destinationId']}\"><input type=\"button\" value=\"Edit\" class=\"btn\" /></a>
                    <a href=\"delete-destination.php?destinationId={$destination['destinationId']}\" onclick=\"return confirmDelete()\"><input type=\"button\" value=\"Delete\" class=\"btn\" /></a>
                </td>";
            }
            echo "</tr>";
        }
    echo '</table>';

    $db = null;
    ?>
    </main>
</body>
</html>