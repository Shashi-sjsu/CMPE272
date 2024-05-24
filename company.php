<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login_form.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$company_id = isset($_GET['id']) ? $_GET['id'] : null;

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marketplace";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Track visit
$track_visit_stmt = $conn->prepare("INSERT INTO user_visits (user_id, company_id) VALUES (?, ?)");
$track_visit_stmt->bind_param("ii", $user_id, $company_id);
$track_visit_stmt->execute();
$track_visit_stmt->close();

// Fetch company details
$company_stmt = $conn->prepare("SELECT name, description FROM companies WHERE id = ?");
$company_stmt->bind_param("i", $company_id);
$company_stmt->execute();
$company_stmt->bind_result($company_name, $company_description);
$company_stmt->fetch();
$company_stmt->close();

$conn->close();

if (!$company_name) {
    echo "Company not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($company_name); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1><?php echo htmlspecialchars($company_name); ?></h1>
        <p><?php echo htmlspecialchars($company_description); ?></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
