<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>User Subscription Page</title>
    <link rel="stylesheet" href="style.css" />
    <script>
      // Check if a success message exists in the URL query parameters
      const urlParams = new URLSearchParams(window.location.search);
      const message = urlParams.get("message");

      // Display the success message in a pop-up if it exists
      if (message) {
        alert(message);
      }
    </script>
  </head>
  <body>
    <header class="header">
      <div class="header-content">
        <h2>
          Hello,
          <?php
          session_start();
          echo $_SESSION['username'];
          ?>
        </h2>
        <a href="index.html" class="logout-btn">Logout</a>
      </div>
    </header>

    <div class="container">
      <h1>Current Subscription</h1>
      <p>
        Your current subscription:
        <?php
        // Display the current subscription from the database
        $db = new PDO("mysql:host=localhost;dbname=omnifood", "root", "");
        $username = $_SESSION['username'];
        $sql = 'SELECT subscription FROM subscription WHERE username = :username';
        $stmt = $db->prepare($sql); $stmt->bindParam(':username', $username);
        $stmt->execute(); $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $currentSubscription = ($result && isset($result['subscription'])) ?
        $result['subscription'] : 'None'; echo $currentSubscription; ?>
      </p>

      <h1>Change Subscription</h1>
      <form action="update_subscription.php" method="post">
        <label for="newSubscription">Select a new subscription:</label>
        <select name="newSubscription" id="newSubscription">
          <option value="Basic">Basic</option>
          <option value="Standard">Standard</option>
          <option value="Premium">Premium</option>
        </select>
        <button type="submit">Change Subscription</button>
      </form>
    </div>
  </body>
</html>
