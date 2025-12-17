<?php
session_start();

if (!isset($_POST['regUsername']) || !isset($_POST['regPassword'])) {
  echo json_encode(array('success' => false, 'message' => 'Missing required fields'));
  exit;
}

$newUsername = trim($_POST['regUsername']);
$newPassword = trim($_POST['regPassword']);

if (empty($newUsername) || empty($newPassword)) {
  echo json_encode(array('success' => false, 'message' => 'Username and password cannot be empty'));
  exit;
}

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

for ($i = 0; $i < count($users); $i++) {
  if ($users[$i]['username'] == $newUsername) {
    echo json_encode(array('success' => false, 'message' => 'Username already exists'));
    exit;
  }
}

$houses = array('Gryffindor', 'Hufflepuff', 'Ravenclaw', 'Slytherin');
$randomHouse = $houses[rand(0, 3)];

$newUser = array(
  'username' => $newUsername,
  'password' => $newPassword,
  'loggedtimes' => 0,
  'minuteslogged' => array(),
  'position' => $newUsername,
  'house' => $randomHouse
);

$users[] = $newUser;

$newJson = json_encode($users, JSON_PRETTY_PRINT);
if (file_put_contents($jsonPath, $newJson) === false) {
  echo json_encode(array('success' => false, 'message' => 'Error writing to users file'));
  exit;
}

$userFolder = __DIR__ . '/../Users/' . basename($newUsername) . '/';


echo json_encode(array(
  'success' => true,
  'message' => 'User created successfully! You have been sorted into ' . $randomHouse . '! You can now log in.'
));
?><?php
session_start();


if (!isset($_POST['regUsername']) || !isset($_POST['regPassword'])) {
  echo json_encode(array('success' => false, 'message' => 'Missing required fields'));
  exit;
}

$newUsername = trim($_POST['regUsername']);
$newPassword = trim($_POST['regPassword']);


if (empty($newUsername) || empty($newPassword)) {
  echo json_encode(array('success' => false, 'message' => 'Username and password cannot be empty'));
  exit;
}

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

for ($i = 0; $i < count($users); $i++) {
  if ($users[$i]['username'] == $newUsername) {
    echo json_encode(array('success' => false, 'message' => 'Username already exists'));
    exit;
  }
}


$newUser = array(
  'username' => $newUsername,
  'password' => $newPassword,
  'loggedtimes' => 0,
  'minuteslogged' => array(),
  'position' => $newUsername 
);


$users[] = $newUser;


$newJson = json_encode($users, JSON_PRETTY_PRINT);
if (file_put_contents($jsonPath, $newJson) === false) {
  echo json_encode(array('success' => false, 'message' => 'Error writing to users file'));
  exit;
}


$userFolder = __DIR__ . '/../Users/' . basename($newUsername) . '/';

echo json_encode(array(
  'success' => true,
  'message' => 'User created successfully! You can now log in.'
));
?>