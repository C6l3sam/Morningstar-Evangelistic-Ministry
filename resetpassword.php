<?php
require 'config.php';

if (!isset($_GET["email"])) {
    echo "Invalid access.";
    exit;
}

$email = $_GET["email"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $new_password, $email);

    if ($stmt->execute()) {
        echo "<script>alert('Password reset successful!'); window.location='login.php';</script>";
    } else {
        echo "Something went wrong.";
    }
}
?>

<!-- Reset Password Form -->
<!DOCTYPE html>
<html>
<head><title>Reset Password</title></head>
<body>
  <h2>Reset Your Password</h2>
  <form method="post">
    <input type="password" name="password" placeholder="New Password" required><br><br>
    <input type="submit" value="Reset Password">
  </form>
</body>
</html>
