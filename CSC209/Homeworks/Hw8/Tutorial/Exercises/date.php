<html>
<head>
<title> PHP Date </title>
</head>

<body>
<h2>Date</h2>
<?php
echo "Today is " . date("Y/m/d") . ", " . date("l") . ".<br>";
?>

<h2>Timezone</h2>
<?php
$timezone = date_default_timezone_get();
echo "The timezone is $timezone .<br>";
date_default_timezone_set("America/New_York");
echo "The timezone is " . date("h:i:sa") . ".<br>";
?>
</body>
</html>