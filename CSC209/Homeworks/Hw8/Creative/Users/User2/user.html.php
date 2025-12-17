<?php

function extractFolderNumber() {
$path = realpath(__FILE__);
$path = dirname($path);
$path = basename($path);         
$labNrString = substr($path, -1);
$labNr = (int)$labNrString;
return $labNr;
}

$folderNum  = extractFolderNumber();     
$folderName = "User" . $folderNum;       
$username   = $_GET['username'];         

$jsonPath = __DIR__ . '/../../users.json';
$size = filesize($jsonPath);
$rf = fopen($jsonPath, "r");
$json = fread($rf, $size);
fclose($rf);

$users = json_decode($json, true);
$house = "Gryffindor"; 
for ($i = 0; $i < count($users); $i++) {
if ($users[$i]['username'] == $username && $users[$i]['position'] == $folderName) {
$house = $users[$i]['house'];
break;
}
}

$bg = "#7F0909";   
$fg = "#FFD700";  
$banner = "Gryffindor";

if ($house == "Hufflepuff") {
$bg = "#FFDB00";   
$fg = "#1C1C1C";   
$banner = "Hufflepuff";
} else if ($house == "Ravenclaw") {
$bg = "#0E1A40";  
$fg = "#946B2D";   
$banner = "Ravenclaw";
} else if ($house == "Slytherin") {
$bg = "#1A472A";   
$fg = "#AAAAAA"; 
$banner = "Slytherin";
}
?>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $banner; ?> Common Room</title>
<style>
:root {
--bg: <?php echo $bg; ?>;
--fg: <?php echo $fg; ?>;
}
body {
margin: 0;
font-family: Arial, sans-serif;
background: var(--bg);
color: var(--fg);
min-height: 100vh;
padding: 24px;
}
.card {
background: rgba(255,255,255,0.08);
padding: 16px;
border: 1px solid rgba(255,255,255,0.2);
border-radius: 8px;
max-width: 560px;
}
button {
background: var(--fg);
color: var(--bg);
border: none;
padding: 10px 16px;
border-radius: 6px;
font-weight: bold;
}
button:hover { opacity: 10; }
</style>
</head>
<body>
<div class="card">
<h1><?php echo $banner; ?> Common Room</h1>
<h2>Welcome, <?php echo $username; ?>!</h2>
<p>You are in folder: <strong><?php echo $folderName; ?></strong></p>


<form id="logoutForm" method="post" action="../../logout.html.php">
<input type="hidden" name="username"   value="<?php echo $username; ?>">
<input type="hidden" name="folderName" value="<?php echo $folderName; ?>">
<input type="hidden" name="minutes"    id="minutes" value="">
<button type="submit">Logout</button>
</form>
</div>

<script>
var start = Date.now();
document.getElementById("logoutForm").addEventListener("submit", function () {
var mins = Math.floor((Date.now() - start) / 60000);
document.getElementById("minutes").value = mins;
});
</script>
</body>
</html>
