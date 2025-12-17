<?php
session_start();

//  variable that stores in error messages
$error = '';

// get username and passwrod from input form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    // load user data from user.json 
    $users_json = file_get_contents('../User/users.json');
    $users = json_decode($users_json, true);

    // variable that stores in matched user
    $userfound = null;
    
    // loop through users to find matching credentials
    foreach ($users as $user) {
        if ($user['username'] === $username &&
            $user['password'] === $password) {
            $userfound = $user;
            break;
        }
    }

    // successful login
    if ($userfound !== null) {

        $_SESSION['username'] = $userfound['username'];
        $_SESSION['position'] = $userfound['position'] ?? 'user';

        // added for admin login
        if ($_SESSION['position'] === 'admin') {
            header('Location: ../Admin/admin.html.php');
        } else {
            header('Location: ../Quizzes/Quiz.html.php');
        }
        exit();
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!-- HTML PART -->
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/login.css">
</head>

<body>

<div class="login-box">
  
<h2>Login</h2>

<!-- handles error -->
<?php if (!empty($error)): ?>
  <p style="color:red;">
    <?php echo htmlspecialchars($error); ?>
  </p>
<?php endif; ?>

<!-- login box -->
<form action="login.html.php" method="post">
   <label>Username</label>
    <input type="text" name="username"><br><br>
   <label>Password</label> 
   <input type="password" name="password"><br><br>
  <input type="submit" value="Login" class="login-btn">
</form>

</div>



<br>
<!-- Register User Part -->
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Register</button>

<!-- Registration Modal -->
<div id="id01" class="modal">
  <form class="modal-content animate" action="registerUser.php" method="post" onsubmit="return handleRegister(event)">
   <!-- close button -->
  <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

    <!-- Registration Inputs -->
    <div class="container">
      <h2>Register New User</h2>
      <label for="regUsername"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="regUsername" id="regUsername" required>

      <label for="regPassword"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="regPassword" id="regPassword" required>
        
      <button type="submit">Register</button>
      
      <div id="registerMessage" style="margin-top: 10px; padding: 10px;"></div>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>


<script src ="js/login.js"> </script>
</body>
</html>