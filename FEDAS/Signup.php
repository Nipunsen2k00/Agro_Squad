<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farming_services";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    if ($pass === $confirm_pass) {
        // Hash the password
        $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);

        // Using prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $user, $hashed_pass);

        if ($stmt->execute()) {
            echo "Signup successful!";
            // Redirect to login page
            header("Location: login.html");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Passwords do not match!";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Farming Services</title>
    <link rel="stylesheet" href="./css/Signup.css">
</head>
<body>
    <header>
    </header>
    <section class="hero">
        <div class="signup-form-container">
            <img src="Images\\Green_and_White_Circle_Icon_Organic_Food_Logo-removebg-preview 1.png" alt="Fedas Logo" class="form-logo">
            <h2>Sign Up</h2>
            <form action="signup.php" method="post">
                <div class="form-group">
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm_password" required>
                </div>
                <button type="submit">Sign Up</button>
                <p>OR</p>
                <p>Already you have an account. <a href="Login.php"><u>Login</u></p>
            </form>
        </div>
    </section>
</body>
</html>