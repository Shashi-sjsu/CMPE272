<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <main>
        <form action="authenticate.php" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <button type="submit">Login</button>
        </form>
        <?php
        // Display error message if authentication failed
        if (isset($_GET['error'])) {
            echo "<p class='error'>Invalid username or password. Please try again.</p>";
        }
        ?>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Cloud8Kit</p>
    </footer>
</body>
</html>


=======
<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "marketplace";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $hashed_password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            header("Location: index.php?page=home");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }

    $stmt->close();
    $conn->close();
}
?>
>>>>>>> master
