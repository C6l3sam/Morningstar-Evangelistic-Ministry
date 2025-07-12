<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);

    // Check if email exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Redirect to reset form with email in URL
        header("Location: reset_password.php?email=" . urlencode($email));
        exit;
    } else {
        echo "<script>alert('Email not found');</script>";
    }
}
?>

<!-- Forgot Password Form -->
<!DOCTYPE html>
<html>
<head><title>Forgot Password</title></head>
<body>
  <h2>Forgot Password</h2>
  <form method="post">
    <input type="email" name="email" placeholder="Enter your registered email" required><br><br>
    <input type="submit" value="Proceed to Reset">
  </form>
  <a href="login.php">Back to Login</a>
</body>
</html>
