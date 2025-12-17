<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['position'] !== 'admin') {
  echo json_encode(array('success' => false, 'message' => 'Unauthorized'));
  exit;
}
if (!isset($_POST['username']) || empty($_POST['username'])) {
  echo json_encode(array('success' => false, 'message' => 'Username not provided'));
  exit;
}
$usernameToDelete = $_POST['username'];
$jsonPath = __DIR__ . '/../users.json';
if (!file_exists($jsonPath)) {
  echo json_encode(array('success' => false, 'message' => 'Users file not found'));
  exit;
}
$json = file_get_contents($jsonPath);
$users = json_decode($json, true);
if ($users === null) {
  echo json_encode(array('success' => false, 'message' => 'Error reading users file'));
  exit;
}

$userFound = false;
$userPosition = '';
$newUsers = array();
for ($i = 0; $i < count($users); $i++) {
  if ($users[$i]['username'] == $usernameToDelete) {
    $userFound = true;
    $userPosition = $users[$i]['position'];
  } else {
    $newUsers[] = $users[$i];
  }
}
if (!$userFound) {
  echo json_encode(array('success' => false, 'message' => 'User not found'));
  exit;
}
$newJson = json_encode($newUsers, JSON_PRETTY_PRINT);
if (file_put_contents($jsonPath, $newJson) === false) {
  echo json_encode(array('success' => false, 'message' => 'Error writing to users file'));
  exit;
}
$userFolder = __DIR__ . '/../Users/' . basename($usernameToDelete) . '/';
if (is_dir($userFolder)) {
  $files = glob($userFolder . '*'); 
  foreach ($files as $file) {
    if (is_file($file)) {
      unlink($file); 
    }
  }
  if (rmdir($userFolder)) {
    $folderDeleted = true;
  } else {
    $folderDeleted = false;
  }
} else {
  $folderDeleted = true;
}
echo json_encode(array('success' => true, 'message' => 'User deleted successfully', 'users' => $newUsers, 'folderDeleted' => $folderDeleted));
?>