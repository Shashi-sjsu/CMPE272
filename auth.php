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

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        // Handle registration
        $name = $_POST["name"];
        $email = $_POST["email"];
        $hashed_password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            $success = "Registration successful!";
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['login'])) {
        // Handle login
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
                $error = "Invalid password.";
            }
        } else {
            $error = "No user found with this email.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1>Authentication</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php elseif (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <h2>Register</h2>
                <form action="index.php?page=auth" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Login</h2>
                <form action="index.php?page=auth" method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-secondary">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
