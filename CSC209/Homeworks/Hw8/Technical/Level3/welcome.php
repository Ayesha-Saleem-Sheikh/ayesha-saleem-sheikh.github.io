<?php
$username = $_POST['username'];
$password = $_POST['password'];

$jsonPath = __DIR__ . '/users.json';
$json = file_get_contents($jsonPath);
$users = json_decode($json, true);
$match = null;

for ($i = 0; $i < count($users); $i++) {
if ($users[$i]['username'] == $username && $users[$i]['password'] == $password) {
$match = $users[$i];
$users[$i]['loggedtimes'] = (int)$users[$i]['loggedtimes'] + 1;

$newJson = json_encode($users, JSON_PRETTY_PRINT);
$myfile = fopen($jsonPath, "w") or die("Unable to open file!");
fwrite($myfile, $newJson);
fclose($myfile);
break;
}
}

if ($match) {
$pos = $match['position'];
echo "<h2>Welcome, $username!</h2>";
echo "<p>Times logged in: " . $users[$i]['loggedtimes'] . "</p>";

if ($pos == "admin") {
echo '<form method="get" action="Admin/admin.html.php">
<button type="submit">Continue to Admin</button>
</form>';
} else {
echo '<form method="get" action="Users/' . $pos . '/user.html.php">
<input type="hidden" name="username" value="' . $username . '">
<button type="submit">Continue to Your Page</button>
</form>';
}
} else {
echo "<h3 style='color:red;'>Login failed. Invalid username or password.</h3>";
echo '<p><a href="login.html.php">Try again</a></p>';
}
?>
