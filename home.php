<div class="jumbotron">
    <h1 class="display-4">WELCOME TO SHASHI COMMERCE </h1>
    <p class="lead">Explore products, add reviews, and manage your profile.</p>
    <hr class="my-4">
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>You are logged in. Enjoy exploring the marketplace!</p>
        <a class="btn btn-primary btn-lg" href="index.php?page=top_products" role="button">View Top Products</a>
        <a class="btn btn-secondary btn-lg" href="index.php?page=add_review_form" role="button">Add Review</a>
    <?php else: ?>
        <p>Join our community and discover the best products and services offered by our member companies.</p>
        <a class="btn btn-primary btn-lg" href="index.php?page=auth" role="button">Register/Login</a>
    <?php endif; ?>
</div>

<h2>Top Products</h2>
<div class="row">
    <?php
    $conn = new mysqli("localhost", "root", "", "marketplace");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT id, name, description, image FROM products ORDER BY visits DESC, id DESC LIMIT 6";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-4">';
            echo '<div class="card mb-4">';
            echo '<img src="' . $row["image"] . '" class="card-img-top" alt="' . $row["name"] . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row["name"] . '</h5>';
            echo '<p class="card-text">' . $row["description"] . '</p>';
            echo '<a href="index.php?page=product&id=' . $row["id"] . '" class="btn btn-primary">View Product</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>No products found.</p>";
    }

    $conn->close();
    ?>
</div>
