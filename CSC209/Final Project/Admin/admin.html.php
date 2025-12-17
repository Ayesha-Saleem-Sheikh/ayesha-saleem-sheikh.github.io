<?php
session_start();

// Only allow admins
if (!isset($_SESSION['username']) || ($_SESSION['position'] ?? '') !== 'admin') {
    header('Location: ../Main/login.html.php');
    exit;
}

// AJAX endpoint return list of users
if (isset($_GET['ajax'])) {

    $users_path = __DIR__ . '/../User/users.json';

    if (file_exists($users_path)) {
        $json = file_get_contents($users_path);
        $data = json_decode($json, true);
        if (!is_array($data)) {
            $data = [];
        }
    } else {
        $data = [];
    }

    echo json_encode($data);
    exit;
}
?>

<!-- Admin Dashboard -->
<html>
<body>
<h1>Admin</h1>
<button id="refreshBtn">Refresh</button>
<a href="makeaquiz.html.php">
    <button type="button">Make a Quiz</button>
  </a>

<div id="table"></div>

<script src = "js/admin.js"> </script>
</body>
</html>