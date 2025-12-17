<?php
if (isset($_GET['ajax'])) {
  $path = __DIR__ . '/../users.json';   
  if (file_exists($path)) {
    echo file_get_contents($path);      
  }; 
  exit;
}
?>
<html>
  <body>
    <h1>Welcome Admin! (Level 3)</h1>
    <a href="../login.html.php">Back to Login</a>

    <div>
      <button onclick="sortbyUsers()">Sort by Username</button>
      <button onclick="sortbyPassword()">Sort by Password</button>
      <button onclick="sortbyLoggedtimes()">Sort by Logged Times</button>
      <button id="refreshBtn">Refresh</button>
    </div>

    <div id="table"></div>

    <script src="../../Level1/js/script.js"></script>

    <script>
    var users = [];

    function refresh() {
      console.log();

      const xhr = new XMLHttpRequest();
      xhr.open("GET", "admin.html.php?ajax=1");
      xhr.onload = function () {
        console.log();
        const data = JSON.parse(xhr.responseText); 
        users = data;
        console.log(users);
        makeTable(users);
  };

  xhr.send();

      }
      document.getElementById("refreshBtn").addEventListener("click", refresh);
      refresh();
    </script>
  </body>
</html>
