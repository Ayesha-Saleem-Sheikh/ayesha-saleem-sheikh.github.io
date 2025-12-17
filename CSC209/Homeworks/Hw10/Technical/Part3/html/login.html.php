<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
  padding-top: 60px;
}

.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto;
  border: 1px solid #888;
  width: 80%;
}

.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<h2>Login</h2>

<form action="../welcome.php" method="post">
  Username: <input type="text" name="username"><br><br>
  Password: <input type="password" name="password"><br><br>
  <input type="submit" value="Login">
</form>

<br>
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Register</button>

<div id="id01" class="modal">
  <form class="modal-content animate" action="registerUser.php" method="post" onsubmit="return handleRegister(event)">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>

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

<script>
var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

function handleRegister(event) {
  event.preventDefault();
  
  var username = document.getElementById('regUsername').value;
  var password = document.getElementById('regPassword').value;
  
  var formData = new FormData();
  formData.append('regUsername', username);
  formData.append('regPassword', password);
  
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'registerUser.php');
  xhr.onload = function() {
    var response = JSON.parse(xhr.responseText);
    var messageDiv = document.getElementById('registerMessage');
    
    if (response.success) {
      messageDiv.style.color = 'green';
      messageDiv.innerHTML = response.message;
      
      document.getElementById('regUsername').value = '';
      document.getElementById('regPassword').value = '';
    } else {
      messageDiv.style.color = 'red';
      messageDiv.innerHTML = response.message;
    }
  };
  xhr.send(formData);
  
  return false;
}
</script>

</body>
</html>