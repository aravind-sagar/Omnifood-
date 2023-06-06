<?php
  // Connect to the database
  $db = new PDO("mysql:host=localhost;dbname=omnifood", "root", "");

  if (isset($_GET['username'])) {
    $username = $_GET['username'];
    if (isset($_POST['subscription'])) {
      $subscription = $_POST['subscription'];

      $sql = "UPDATE subscription SET subscription = :subscription WHERE username = :username";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':subscription', $subscription);
      $stmt->bindValue(':username', $username);
      $stmt->execute();
      header("Location: index.php");
      exit();
    } else {
      // Retrieve the current subscription
      $sql = "SELECT subscription FROM subscription WHERE username = :username";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':username', $username);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $currentSubscription = $result['subscription'];
    }
  } else {
    header("Location: index.php");
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Update Subscription</title>
  </head>
  <body>
    <h2>Update Subscription</h2>
    <form action="" method="post">
      <label for="subscription">Subscription:</label>
      <select name="subscription" id="subscription">
        <option value="Basic" <?php if ($currentSubscription === 'Basic') echo 'selected'; ?>>Basic</option>
        <option value="Standard" <?php if ($currentSubscription === 'Standard') echo 'selected'; ?>>Standard</option>
        <option value="Premium" <?php if ($currentSubscription === 'Premium') echo 'selected'; ?>>Premium</option>
      </select>
      <br><br>
      <input type="submit" value="Update">
    </form>
  </body>
</html>
