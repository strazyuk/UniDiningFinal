<?php
// Include the database connection file
require_once('DBconnect.php');

// Check if the search form is submitted
if(isset($_POST['search'])) {

    // Perform the search query
    $query = "SELECT * FROM curMenu WHERE name LIKE '%$search%' and status ='published'";
    $result = mysqli_query($conn, $query);

    // Display search results
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            // Display each matching food item
            echo "<div>";
            echo "<h2>" . $row['name'] . "</h2>";
            echo "<p>" . $row['type'] . "</p>";
            echo "<p>Price: $" . $row['token'] . "</p>";
            echo "<img src='" . $row['img'] . "' alt='" . $row['name'] . "' width='100'>";
            echo "</div>";
        }
    } else {
        echo "No results found.";
    }
}
?>
