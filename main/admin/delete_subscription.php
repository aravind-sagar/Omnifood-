<?php
  // Connect to the database
  $db = new PDO("mysql:host=localhost;dbname=omnifood", "root", "");

  // Check if the username parameter is present
  if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $sql = "DELETE FROM subscription WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

    // Display a confirmation message
    echo "<script>alert('Entry Deleted!'); window.location.href = 'index.php';</script>";
    exit();
  } else {
    // Redirect back to the admin page if username is not provided
    header("Location: index.php");
    exit();
  }
?>
