<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=auth");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$rating = $_POST['rating'];
$review = $_POST['review'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marketplace";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verify that the product ID exists
$stmt = $conn->prepare("SELECT id FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo "Invalid product ID.";
    $stmt->close();
    $conn->close();
    exit();
}

$stmt->close();

// Add review
$stmt = $conn->prepare("INSERT INTO reviews (user_id, product_id, rating, review) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiis", $user_id, $product_id, $rating, $review);

if ($stmt->execute()) {
    echo "Review added successfully!";
    header("Location: index.php?page=product&id=$product_id");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
