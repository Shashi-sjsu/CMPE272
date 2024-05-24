<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
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

// Function to include the appropriate page
function route($path) {
    switch ($path) {
        case '':
        case 'home':
            include 'home.php';
            break;
        case 'auth':
            include 'auth.php';
            break;
        case 'add_review':
            include 'add_review.php';
            break;
        case 'add_review_form':
            include 'add_review_form.php';
            break;
        case 'top_products':
            include 'top_products.php';
            break;
        case 'track_visit':
            include 'track_visit.php';
            break;
        case 'logout':
            include 'logout.php';
            break;
        default:
            include '404.php'; // Custom 404 page
            break;
    }
}

// Get the path from the URL
$path = isset($_GET['page']) ? $_GET['page'] : 'home';

// Route to the appropriate page
ob_start();
route($path);
$page_content = ob_get_clean();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shashi Commerce Marketplace</title> <!-- Change this line to modify the title -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <?php echo $page_content; ?>
    </div>
    <footer class="footer">
        <div class="container">
            <span>© 2024 Shashi Commerce Marketplace</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
