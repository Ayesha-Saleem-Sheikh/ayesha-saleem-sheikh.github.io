<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.html.php');
  exit;
}
?>
<html>
  <body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>Role: <?php echo htmlspecialchars($_SESSION['position']); ?></p>
    <p>Logged in at: <?php echo date('h:i:s A', $_SESSION['start_time']); ?></p>

    <a href="logout.html.php">Logout</a>
  </body>
</html>
