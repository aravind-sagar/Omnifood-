<?php
session_start();

// Connect to the database
$db = new PDO("mysql:host=localhost;dbname=omnifood", "root", "");

// Get the username and password from the POST request
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the username already exists in the users table
$sql = 'SELECT * FROM users WHERE username = :username';
$stmt = $db->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // Account already exists
    echo '<script>alert("Account already exists!"); window.location.href = "./signup.html";</script>';
    exit();
}

// Create a new entry in the users table
$sql = 'INSERT INTO users (username, password) VALUES (:username, :password)';
$stmt = $db->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();

// Store the username in sessions
$_SESSION['username'] = $username;

// Redirect to subscription.php
header('Location: subscription.php');
exit();
?>
