
<html>
<body>
  <h1>Welcome Admin!</h1>
  <p>This is the admin page.</p>
  <a href="../login.html.php">Back to Login</a>
  
<div id="ajax">
  <button type ="button" onclick = "refresh()">  Refresh </button>

</div>

<script>
const xhttp = new XMLHttpRequest();
 xhttp.onload = function() {
    document.getElementById("ajax").innerHTML =
    this.responseText
  }
  xhttp.open("GET", "../../Level1/admin.html.php");
  xhttp.send();

</script>


</body>
</html>
