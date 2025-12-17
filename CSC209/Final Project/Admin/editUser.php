<?php
session_start();

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
 
// check all required fields are provided
if (
    !isset($_POST['oldUsername']) ||
    !isset($_POST['newUsername']) ||
    !isset($_POST['newPassword'])
) {
    echo json_encode([
        'success' => false,
        'message' => 'Missing required fields'
    ]);
    exit;
}

// clean new data
$oldUsername = trim($_POST['oldUsername']);
$newUsername = trim($_POST['newUsername']);
$newPassword = trim($_POST['newPassword']);
$position    = $_POST['position'] ?? null;

$users_path = __DIR__ . '/../User/users.json';
$answers_path = __DIR__ . '/../Quizzes/json/answers.json';

// call edit user funtion on both users and answers file
$User = editUser($users_path, $oldUsername, $newUsername, $newPassword, $position);
$Ans  = editUser($answers_path, $oldUsername, $newUsername, $newPassword, $position);

if (!$User['success'] || !$Ans['success']) {
    echo json_encode([
        'success' => false,
        'message' => 'Error updating user in files'
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'User updated successfully',
    'users' => $User['users']
]);

exit;