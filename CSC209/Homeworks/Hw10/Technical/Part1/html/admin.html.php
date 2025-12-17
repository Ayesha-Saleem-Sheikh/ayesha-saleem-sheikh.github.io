<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['position'] !== 'admin') {
  header('Location: login.html.php');
  exit;
}
if (isset($_GET['ajax'])) {
  header('Content-Type: application/json; charset=UTF-8');
  echo file_get_contents(__DIR__ . '/../users.json'); 
  exit;
}
?>
<html>
<body>
<h1>Admin</h1>
<button id="refreshBtn">Refresh</button>
<div id="table"></div>
<script>
var users = [];
function makeTable(data){
  let html = '<table border="1" style="border-collapse:collapse;width:100%">';
  html += '<tr><th>Username</th><th>Password</th><th>Logged Times</th><th>Action</th></tr>';
  for (let i=0;i<data.length;i++){
    html += `<tr>
              <td>${data[i].username}</td>
              <td>${data[i].password}</td>
              <td>${data[i].loggedtimes||0}</td>
              <td><button class="deleteBtn" username="${data[i].username}">Delete</button></td>
            </tr>`;
  }
  html += '</table>';
  document.getElementById('table').innerHTML = html;
  const deleteBtns = document.querySelectorAll('.deleteBtn');
  deleteBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const username = this.getAttribute('username');
      deleteUser(username);
    });
  });
}
function refresh(){
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'admin.html.php?ajax=1');
  xhr.onload = function(){
    const data = JSON.parse(xhr.responseText);
    users = data;
    makeTable(users);
  };
  xhr.send();
}
function deleteUser(username){
  if (!confirm('Are you sure you want to delete user "' + username + '"?')) {
    return;
  }
  const formData = new FormData();
  formData.append('username', username);
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'deleteUser.php');
  xhr.onload = function(){
    const response = JSON.parse(xhr.responseText);
    if (response.success) {
      alert('User deleted successfully!');
      refresh(); 
    } else {
      alert('Error: ' + (response.message || 'Failed to delete user'));
    }
  };
  xhr.send(formData);
}
document.getElementById('refreshBtn').addEventListener('click', refresh);
refresh();
</script>
</body>
</html>