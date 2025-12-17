<?php
session_start();

$username   = $_POST['username']   ?? ($_SESSION['username'] ?? '');
$folderName = $_POST['folderName'] ?? ($_SESSION['position'] ?? '');
if (isset($_POST['minutes'])) {
  $minutes = (int)$_POST['minutes'];
} else {
  $minutes = isset($_SESSION['start_time']) ? max(0, (int)round((time() - (int)$_SESSION['start_time'])/60)) : 0;
}

$jsonPath = __DIR__ . '/../users.json'; 

$size = filesize($jsonPath);
$file = fopen($jsonPath, "r") or die("Unable to open file!");
$json = fread($file, $size);
fclose($file);

$users = json_decode($json, true);

for ($i = 0; $i < count($users); $i++) {
  if ($users[$i]['username'] == $username && $users[$i]['position'] == $folderName) {
    if (!isset($users[$i]['minuteslogged']) || !is_array($users[$i]['minuteslogged'])) {
      $users[$i]['minuteslogged'] = [];
    }
    $users[$i]['minuteslogged'][] = $minutes;

    $newJson = json_encode($users, JSON_PRETTY_PRINT);
    $myfile = fopen($jsonPath, "w") or die("Unable to open file!");
    fwrite($myfile, $newJson);
    fclose($myfile);
    break;
  }
}

session_unset();
session_destroy();
?>
<html>
  <body>
    <h2>Goodbye, <?php echo htmlspecialchars($username); ?>!</h2>
    <p>You were logged in for <?php echo (int)$minutes; ?> minute(s).</p>
    <a href="login.html.php">Back to Login</a>
  </body>
</html>
