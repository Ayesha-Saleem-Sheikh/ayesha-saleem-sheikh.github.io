<html>
<head>
</head>

<body>
<h1> Lab 13 </h1>
<button onclick="sortbyUsers()">Sort by Username</button>
<button onclick="sortbyPassword()">Sort by Password</button>
<button onclick = "sortbyLoggedtimes()"> Sort by Logged Times </button>
<div id="table"></div>

<?php

function read(){
$myJson = file_get_contents("users.json");
$obj = json_decode($myJson,true);
return
}

$obj = read();
?>
<script>
const users = <?php echo json_encode($obj) ?>;
</script>
<script src="js/script.js"></script>


</body>

</html>
