<?php

//Removes a user from given JSON file based on username.

function deleteUser(string $users_path, string $usernameToDelete): array {
    if (!file_exists($users_path)) {
        return [
        'success' => false,
        'message' => 'Users file not found', 
        'users' => []];
    }
    $json = file_get_contents($users_path);
    $users = json_decode($json, true);
    if (!is_array($users)) {
        return [
        'success' => false, 
        'message' => 'Error reading users file', 
        'users' => []];
    }
    $userFound = false;
    $newUsers = [];

    // loop through users and remove matching username
    foreach ($users as $u) {
        if (isset($u['username']) && $u['username'] === $usernameToDelete) {
            $userFound = true;
            continue;
        }
        $newUsers[] = $u;
    }

    if (!$userFound) {
        return ['success' => false, 
        'message' => 'User not found', 
        'users' => $users];
    }

    $newJson = json_encode($newUsers, JSON_PRETTY_PRINT);
    if (file_put_contents($users_path, $newJson) === false) {
        return ['success' => false, 
        'message' => 'Error writing to users file', 
        'users' => $users];
    }

    return ['success' => true, 
    'message' => 'User deleted successfully',
    'users' => $newUsers];
}

// Updates a username and password 
function editUser(string $users_path, string $oldUsername, string $newUsername, string $newPassword, ?string $position): array {
    if (!file_exists($users_path)) {
        return [
            'success' => false,
            'message' => 'Users file not found'
        ];
    }
    
    $json = file_get_contents($users_path);
    $users = json_decode($json, true);
    
    if (!is_array($users)) {
        return [
            'success' => false,
            'message' => 'Error reading users file'
        ];
    }
    
    // Check if this is answers.json (has quiz_index) or users.json (has position)
    $isAnswersFile = false;
    if (count($users) > 0 && isset($users[0]['quiz_index'])) {
        $isAnswersFile = true;
    }
    
    if ($isAnswersFile) {
        // updates answers.json for ALL occurrences of the username
        $userFound = false;
        foreach ($users as &$entry) {
            if (isset($entry['username']) && $entry['username'] === $oldUsername) {
                $userFound = true;
                if ($newUsername !== '') {
                    $entry['username'] = $newUsername;
                }
            }
        }
        unset($entry); 
        
        if (!$userFound) {
            return [
                'success' => false,
                'message' => 'User not found'
            ];
        }
    } else {
        // updates user.json
        $userFound = false;
        $userIndex = -1;
        
        for ($i = 0; $i < count($users); $i++) {
            if (isset($users[$i]['username']) && $users[$i]['username'] === $oldUsername) {
                $userFound = true;
                $userIndex = $i;
                break;
            }
        }
        
        if (!$userFound) {
            return [
                'success' => false,
                'message' => 'User not found'
            ];
        }
        
        // ensure new username is unique
        if ($oldUsername !== $newUsername && $newUsername !== '') {
            for ($i = 0; $i < count($users); $i++) {
                if ($i === $userIndex) continue;
                if (isset($users[$i]['username']) && $users[$i]['username'] === $newUsername) {
                    return [
                        'success' => false,
                        'message' => 'Username already exists'
                    ];
                }
            }
        }
        
        // apply updates
        if ($newUsername !== '') {
            $users[$userIndex]['username'] = $newUsername;
        }
        if ($newPassword !== '') {
            $users[$userIndex]['password'] = $newPassword;
        }
        if ($position !== null && $position !== '') {
            $users[$userIndex]['position'] = $position;
        }
    }
    
    // save updates
    $newJson = json_encode($users, JSON_PRETTY_PRINT);
    if (file_put_contents($users_path, $newJson) === false) {
        return [
            'success' => false,
            'message' => 'Error writing to users file'
        ];
    }
    
    return [
        'success' => true,
        'message' => 'User updated successfully',
        'users' => $users
    ];
}