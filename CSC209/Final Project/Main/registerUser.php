<?php

// get and clean user input
$username = trim($_POST['regUsername'] ?? '');
$password = trim($_POST['regPassword'] ?? '');

//  checking if fileds are filled 
if ($username === '' || $password === '') {
    echo json_encode([
        'success' => false,
        'message' => 'Username and password are required.'
    ]);
    exit();
}

$users_path = __DIR__ . '/../User/users.json';

// intialize users array 
$users = [];

if (file_exists($users_path)) {
    $users_json = file_get_contents($users_path);
    $decoded = json_decode($users_json, true);
    if (is_array($decoded)) {
        $users = $decoded;
    }
}

// create new user
$new_user = [
    'username' => $username,
    'password' => $password,
    'position' => 'user'
];

// add new user to users array
$users[] = $new_user;

// Save back to users.json
if (file_put_contents($users_path, json_encode($users, JSON_PRETTY_PRINT)) === false) {
    echo json_encode([
        'success' => false,
        'message' => 'Could not save user. Please try again.'
    ]);
    exit();
}

// output success message
echo json_encode([
    'success' => true,
    'message' => 'User registered successfully! You can now log in.'
]);
exit();
