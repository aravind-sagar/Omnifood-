<!DOCTYPE html>
<html>
  <head>
    <title>Admin Page</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
      }

      .logo {
        position: absolute;
        top: 10px;
        right: 10px;
        max-width: 200px;
        height: auto;
      }

      .admin-message {
        text-align: center;
        margin-bottom: 20px;
      }

      .search-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
      }

      .search-bar {
        margin-right: 10px;
      }

      .search-button {
        margin-right: 10px;
      }

      .results-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      .results-table th,
      .results-table td {
        border: 1px solid #ccc;
        padding: 8px;
      }

      .results-table th {
        background-color: #e5822c;
        color: #000;
      }
    </style>
  </head>
  <body>
    <img src="logo.png" alt="Logo" class="logo" />
    <h1 class="admin-message">Hello Admin</h1>

    <div class="search-container">
      <input type="text" placeholder="Search" class="search-bar" />
      <button class="search-button">Search</button>
      <button class="search-all-button">Search All</button>
    </div>

    <table class="results-table">
      <thead>
        <tr>
          <th>Username</th>
          <th>Subscription</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <!-- PHP code to fetch and display data here -->
        <?php
          // Connect to the database
          $db = new PDO("mysql:host=localhost;dbname=omnifood", "root", "");

          // Search button handler
          if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            $sql = "SELECT * FROM subscription WHERE username = :username";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':username', $searchTerm);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
          }
          // Search All button handler
          else {
            $sql = "SELECT * FROM subscription";
            $stmt = $db->query($sql);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
          }

          foreach ($results as $row) {
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['subscription'] . "</td>";
            echo "<td>";
            echo "<a href=\"delete_subscription.php?username=" . $row['username'] . "\" onclick=\"return confirm('Are you sure you want to delete this entry?');\">Delete</a> ";
            echo "<a href=\"update_subscription.php?username=" . $row['username'] . "\">Update</a>";
            echo "</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>

    <script>
      document.querySelector(".search-button").addEventListener("click", function () {
        var searchTerm = document.querySelector(".search-bar").value;
        window.location.href = "?search=" + searchTerm;
      });

      document.querySelector(".search-all-button").addEventListener("click", function () {
        window.location.href = "?searchAll=true";
      });
    </script>
  </body>
</html>
