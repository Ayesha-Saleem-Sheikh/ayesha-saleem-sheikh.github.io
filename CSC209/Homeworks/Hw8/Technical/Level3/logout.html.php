<?php

$username   = $_POST['username'];
$folderName = $_POST['folderName'];
$minutes    = (int)$_POST['minutes'];
$jsonPath = __DIR__ . '/users.json';


$size = filesize($jsonPath);
$file = fopen($jsonPath, "r") or die("Unable to open file!");
$json = fread($file, $size);
fclose($file);

$users = json_decode($json, true);


for ($i = 0; $i < count($users); $i++) {
if ($users[$i]['username'] == $username && $users[$i]['position'] == $folderName) {


$users[$i]['minuteslogged'][] = $minutes;


$newJson = json_encode($users, JSON_PRETTY_PRINT);
$myfile = fopen($jsonPath, "w") or die("Unable to open file!");
fwrite($myfile, $newJson);
fclose($myfile);
break;
}
}
?>
<html>
<body>
<h2>Goodbye, <?php echo $username; ?>!</h2>
<p>You were logged in for <?php echo $minutes; ?> minute(s).</p>
<a href="login.html.php">Back to Login</a>
</body>
</html>
