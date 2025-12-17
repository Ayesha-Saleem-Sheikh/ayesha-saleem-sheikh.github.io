<?php

$username = $_POST['username'] ?? '' ;
$password = $_POST['password'] ?? '';

$jsonPath = __DIR__ . '/users.json';
$json = file_get_contents($jsonPath);
$users = json_decode($json, true) ;

$match = null;
foreach ($users as $x) {
  if (($x['username'] ) === $username && ($x['password'] ) === $password) {
    $match = $x;
    break;
  }
}

if ($match) {
  $logged = (int)($match['loggedtimes'] );
  echo '<h2>Welcome, ' . htmlspecialchars($username) . '!</h2>';
  echo '<p>Times logged in: ' . $logged . '</p>';
  echo '<p><a href="login.html.php"">Log out</a></p>';
} else {
  echo "<h3 style='color:red;'>Login failed. Invalid username or password.</h3>";
  echo '<p><a href="login.html.php">Try again</a></p>';
}
