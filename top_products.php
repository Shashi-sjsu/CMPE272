<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marketplace";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get top products/services
$sql = "SELECT name, visits, AVG(reviews.rating) as avg_rating, image 
        FROM products 
        LEFT JOIN reviews ON products.id = reviews.product_id 
        GROUP BY products.id 
        ORDER BY avg_rating DESC, visits DESC 
        LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<ul class="list-group">';
    while ($row = $result->fetch_assoc()) {
        echo '<li class="list-group-item">';
        if ($row['image']) {
            echo "<img src=\"{$row['image']}\" class=\"img-thumbnail\" alt=\"{$row['name']}\">";
        }
        echo "<h5>{$row['name']}</h5>";
        echo "<p>Visits: {$row['visits']}</p>";
        echo "<p>Avg Rating: {$row['avg_rating']}</p>";
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo "No top products/services found";
}

$conn->close();
?>
