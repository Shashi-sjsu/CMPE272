<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=auth");
    exit();
}

$user_id = $_SESSION['user_id'];
$company_id = isset($_GET['company_id']) ? $_GET['company_id'] : null;

if (!$company_id) {
    echo "Company ID is required.";
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marketplace";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Log user visit
$stmt = $conn->prepare("INSERT INTO user_visits (user_id, company_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $company_id);
$stmt->execute();
$stmt->close();

$conn->close();

header("Location: index.php?page=company&id=$company_id");
exit();
?>
