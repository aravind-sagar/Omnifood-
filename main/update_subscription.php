<?php
session_start();

// Connect to the database
$db = new PDO("mysql:host=localhost;dbname=omnifood", "root", "");

// Get the username and new subscription from the POST request
$username = $_SESSION['username'];
$newSubscription = $_POST['newSubscription'];

// Check if the username exists in the subscription table
$sql = 'SELECT * FROM subscription WHERE username = :username';
$stmt = $db->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    // Update the existing subscription
    $sql = 'UPDATE subscription SET subscription = :subscription WHERE username = :username';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':subscription', $newSubscription);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $message = 'Subscription updated successfully!';
} else {
    // Insert a new subscription entry
    $sql = 'INSERT INTO subscription (username, subscription) VALUES (:username, :subscription)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':subscription', $newSubscription);
    $stmt->execute();
    $message = 'Subscription created successfully!';
}

// Redirect back to the subscription.html page with the message as a query parameter
header('Location: subscription.php?message=' . urlencode($message));
exit(); // Terminate the current script
?>
