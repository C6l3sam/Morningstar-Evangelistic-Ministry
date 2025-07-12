<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard | Morningstar</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #111;
      color: #fff;
      text-align: center;
      padding-top: 50px;
    }
    .card {
      background: #222;
      padding: 30px;
      border-radius: 10px;
      width: 400px;
      margin: auto;
    }
    a {
      color: #4CAF50;
      text-decoration: none;
      display: inline-block;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Your email is: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <a href="logout.php">Log out</a>
  </div>
</body>
</html>
