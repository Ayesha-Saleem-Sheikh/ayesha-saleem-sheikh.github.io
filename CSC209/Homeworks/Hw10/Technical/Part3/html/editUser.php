<?php
session_start();


if (!isset($_SESSION['username']) || $_SESSION['position'] !== 'admin') {
  echo json_encode(array('success' => false, 'message' => 'Unauthorized'));
  exit;
}


if (!isset($_POST['oldUsername']) || !isset($_POST['newUsername']) || !isset($_POST['newPassword'])) {
  echo json_encode(array('success' => false, 'message' => 'Missing required fields'));
  exit;
}

$oldUsername = $_POST['oldUsername'];
$newUsername = $_POST['newUsername'];
$newPassword = $_POST['newPassword'];
$position = $_POST['position'];

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
$userIndex = -1;

for ($i = 0; $i < count($users); $i++) {
  if ($users[$i]['username'] == $oldUsername) {
    $userFound = true;
    $userIndex = $i;
    break;
  }
}

if (!$userFound) {
  echo json_encode(array('success' => false, 'message' => 'User not found'));
  exit;
}


if ($oldUsername != $newUsername) {
  for ($i = 0; $i < count($users); $i++) {
    if ($users[$i]['username'] == $newUsername) {
      echo json_encode(array('success' => false, 'message' => 'Username already exists'));
      exit;
    }
  }
}


$users[$userIndex]['username'] = $newUsername;
$users[$userIndex]['password'] = $newPassword;


$newJson = json_encode($users, JSON_PRETTY_PRINT);
if (file_put_contents($jsonPath, $newJson) === false) {
  echo json_encode(array('success' => false, 'message' => 'Error writing to users file'));
  exit;
}


$folderRenamed = true;
if ($oldUsername != $newUsername) {
  $oldFolder = __DIR__ . '/../Users/' . basename($oldUsername) . '/';
  $newFolder = __DIR__ . '/../Users/' . basename($newUsername) . '/';
  
  if (is_dir($oldFolder)) {
    if (rename($oldFolder, $newFolder)) {
      $folderRenamed = true;
    } else {
      $folderRenamed = false;
    }
  }
}

echo json_encode(array(
  'success' => true,
  'message' => 'User updated successfully',
  'users' => $users,
  'folderRenamed' => $folderRenamed
));
?>