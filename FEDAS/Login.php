<?php
session_start();

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
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashed_pass);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        if (password_verify($pass, $hashed_pass)) {
            // Login successful
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: Home.php"); // Redirect to the dashboard or home page
            exit();
        } else {
            echo "Invalid username or password!";
        }
    } else {
        echo "Invalid username or password!";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Farming Services</title>
    <link rel="stylesheet" href="./css/Login.css">
</head>
<body>
    <header>
    </header>
    <section class="hero">
        <div class="login-form-container">
            <img src="Images//Green_and_White_Circle_Icon_Organic_Food_Logo-removebg-preview 1.png" alt="Fedas Logo" class="form-logo">
            <h1 style="color:black;">LOGIN</h1>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            <p>Don't you have an account ? <a href="Signup.php"><u>Sign Up</u></p>
            </form>
        </div>
    </section>
</body>
</html>