<?php
session_start();
require 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "❌ Incorrect password.";
        }
    } else {
        $error = "❌ No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login | Morningstar Evangelistic Ministry</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-image: url("wallpaper2you_411788.jpg");
      background-size: cover;
      background-position: center;
      color: white;
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
      background: rgba(0, 0, 0, 0.8);
      width: 400px;
      padding: 30px;
      margin: 50px auto;
      border-radius: 10px;
    }

    .container img {
      display: block;
      margin: 0 auto 20px;
      max-width: 80px;
    }

    h2 {
      text-align: center;
    }

    label {
      display: block;
      margin-top: 15px;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 4px;
      border: none;
    }

    button {
      width: 100%;
      margin-top: 20px;
      padding: 10px;
      background: #007bff;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
    }

    .message {
      text-align: center;
      margin-top: 10px;
      color: red;
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="IMG-20240327-WA0011.jpg" alt="Logo">
    <h2>Login</h2>

    <?php if ($error): ?>
      <div class="message"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="programs.html">
      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
