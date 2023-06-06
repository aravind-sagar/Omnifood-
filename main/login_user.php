<?php
session_start();
$db = new PDO("mysql:host=localhost;dbname=omnifood", "root", '');

if (isset($_SESSION['username'])) {
  header('Location: subscription.php');
} else {
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = 'SELECT * FROM users WHERE username = :username AND password = :password';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $user = $stmt->fetch();
    if ($user) {
      $_SESSION['username'] = $username;
      header('Location: subscription.html');
      exit();
    } else {
      echo 'Invalid username or password';
    }
  } else {
    // include 'login.html';
  }
}
?>
