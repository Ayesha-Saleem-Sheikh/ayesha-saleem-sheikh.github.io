<html>
<head>
<?php
session_start();
?>
</head>
<body>
<h2>Login</h2>

<form action="../welcome.php" method="post">
  Username: <input type="text" name="username"><br><br>
  Password: <input type="password" name="password"><br><br>
  <input type="submit" value="Login">
</form>

</body>
</html>
