<<<<<<< HEAD
<?php
session_start(); // Start the session

// Check if the user is authenticated
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    // User is not authenticated, redirect to the login page
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShashiTech</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>ShashiTECH</h1>
        <nav>
            <ul>
                <li><a href="?page=home">Home</a></li>
                <li><a href="?page=about">About</a></li>
                <li><a href="?page=products">Products/Services</a></li>
                <li><a href="?page=news">News</a></li>
                <li><a href="?page=contact">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
            $page = rtrim($page, '/');
            $page = filter_var($page, FILTER_SANITIZE_STRING);

            switch ($page) {
                case 'home':
                    echo '<section id="home"><h2>Welcome to ShashiTECH</h2><p>Discover the future of cloud-AI hosting and deployment with our cutting-edge software. Designed for seamless collaboration, integration, hosting, and deployment, our solutions streamline your workflow. Explore our product lineup and reach out for tailored business pricing details.


</p><p>Developed by Shashi Kumar Singarapu</p><p>Company Name : ShashiTECH</p></section>';
                    break;
                case 'about':
                    echo '<section id="about"><h2>About Us</h2><p>We are a Cloud and AI based solutions product that offer productive deployments and CI/CD integrations.</p></section>';
                    break;
                case 'products':
                    echo '<section id="products"><h2>Our Products/Services</h2><p>CASB, CI/CD</p></section>';
                    break;
                case 'news':
                    echo '<section id="news"><h2>Latest News</h2><p>Released 1.0 version for Open source contribution using Golang.</p></section>';
                    break;
                case 'contact':
                    echo '<section id="contact"><h2>Contact Us</h2>';
                    
                    // Read contacts from the text file
                    $contacts = file('contacts.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    echo "<ul>";
                    foreach ($contacts as $contact) {
                        // Split the contact data by comma
                        $contact_info = explode(',', $contact);
                        $name = isset($contact_info[0]) ? trim($contact_info[0]) : '';
                        $email = isset($contact_info[1]) ? trim($contact_info[1]) : '';
                        // Output the contact as list item
                        echo "<li>$name - $email</li>";
                    }
                    echo "</ul>";
                    
                    echo '</section>';
                    break;
                default:
                    include('home.php');
                    break;
            }
        ?>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> My PHP Website</p>
    </footer>
</body>
</html>
=======
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
>>>>>>> master
