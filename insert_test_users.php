<?php
require 'config.php';

$username = "testuser";
$email = "test@example.com";
$phone = "0712345678";
$password = password_hash("123456", PASSWORD_DEFAULT); // Hashes the password properly

$stmt = $conn->prepare("INSERT INTO users (username, email, phone, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $email, $phone, $password);

if ($stmt->execute()) {
    echo "✅ Test user inserted successfully.";
} else {
    echo "❌ Error inserting test user: " . $stmt->error;
}
?>
