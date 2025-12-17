<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$jsonPath = __DIR__ . '/users.json';
$json = file_get_contents($jsonPath);
$users = json_decode($json, true);  
$match = -1;


for ($i = 0; $i < count($users); $i++) {
  if ($users[$i]['username'] == $username && $users[$i]['password'] == $password) {
    $match = $i;
    break;
  }
}

if ($match !== -1) {

  $users[$match]['loggedtimes'] = (int)$users[$match]['loggedtimes'] + 1;


  file_put_contents($jsonPath, json_encode($users, JSON_PRETTY_PRINT));


  $_SESSION['username'] = $username;
  $_SESSION['position'] = $users[$match]['position'];
  $_SESSION['start_time'] = time();
  $_SESSION['house']   = $users[$match]['house'];

  echo "<h2>Welcome, $username!</h2>";
  echo "<p>Times logged in: " . $users[$match]['loggedtimes'] . "</p>";

  if ($_SESSION['position'] == "admin") {
    echo '<form method="get" action="html/admin.html.php">
            <button type="submit">Continue to Admin</button>
          </form>';
  } else {
    echo '<form method="get" action="html/user.html.php">
            <button type="submit">Continue to Your Page</button>
          </form>';
  }
} else {
  echo "<h3 style='color:red;'>Login failed. Invalid username or password.</h3>";
  echo '<p><a href="html/login.html.php">Try again</a></p>';
}
?>
