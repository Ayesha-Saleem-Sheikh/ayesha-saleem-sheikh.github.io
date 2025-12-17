<?php
session_start();
header('Content-Type: application/json; charset=UTF-8');

// load libraray
require __DIR__ . '/phpLibrary.php';

// admin authorization 
if (!isset($_SESSION['username']) || ($_SESSION['position'] ?? '') !== 'admin') {
    echo json_encode([
        'success' => false,
        'message' => 'Unauthorized'
    ]);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
    exit;
}

// ensures username to delete was provided
if (!isset($_POST['username']) || trim($_POST['username']) === '') {
    echo json_encode([
        'success' => false,
        'message' => 'Username not provided'
    ]);
    exit;
}

$usernameToDelete = trim($_POST['username']);

$users_path = __DIR__ . '/../User/users.json';
$answers_path = __DIR__ . '/../Quizzes/json/answers.json';

// call deleteUser funtion on both user and answer files
$User = deleteUser($users_path, $usernameToDelete);
$Ans  = deleteUser($answers_path, $usernameToDelete);


if (!$User['success'] || !$Ans['success']) {
    echo json_encode([
        'success' => false,
        'message' => 'Error deleting user from files'
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'User deleted successfully'
]);

exit;
