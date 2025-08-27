<?php
// Show errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'config.php'; // This must correctly connect to your database

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Email is already registered!";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullname, $email, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: program.html");
            exit();
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url("wallpaper2you_411788.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
    .header-container {
      display: flex;
      align-items: center;
      padding: 20px;
    }

    .header-container img {
      width: 80px;
      height: auto;
      border-radius: 50%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
      opacity: 0.95;
      margin-right: 15px;
    }

        .container {
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            margin: 80px auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            text-align: center;
        }

        .container img.logo {
            max-width: 120px;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            border-radius: 5px;
        }

        .error {
            color: red;
            margin: 10px 0;
        }

        .login-link {
            margin-top: 15px;
            display: block;
            color: #333;
            font-size: 14px;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <img src="IMG-20240327-WA0011.jpg" alt="Logo" class="logo">
    <h2>Register</h2>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="programs.html">
        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>

    <a class="login-link" href="login.php">Already have an account? Login here</a>
</div>
</body>
</html>
