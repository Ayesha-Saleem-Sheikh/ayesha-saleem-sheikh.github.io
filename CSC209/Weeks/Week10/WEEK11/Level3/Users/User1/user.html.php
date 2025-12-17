<html>
<head>
<?php

function extractFolderNumber() {
$path = realpath(__FILE__);   
$path = dirname($path);     
$path = basename($path);     
$labNrString = substr($path, -1);  
$labNr = (int)$labNrString;  
return $labNr;
}

$folderNum = extractFolderNumber();   
$folderName = "User" . $folderNum;   
$username = $_GET['username'];        
?>
</head>

<body>
<h2>Welcome, <?php echo $username; ?>!</h2>
<p>You are in folder: <?php echo $folderName; ?></p>

<form id="logoutForm" method="post" action="../../logout.html.php">
<input type="hidden" name="username" value="<?php echo $username; ?>">
<input type="hidden" name="folderName" value="<?php echo $folderName; ?>">
<input type="hidden" name="minutes" id="minutes" value="">
<button type="submit">Logout</button>
</form>

<script>
var start = Date.now();


document.getElementById("logoutForm").addEventListener("submit", function () {
var now = Date.now();
var ms = now - start;
var mins = Math.floor(ms / 60000); 
document.getElementById("minutes").value = mins;
});
</script>
</body>
</html>
