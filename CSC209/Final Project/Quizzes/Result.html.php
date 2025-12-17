<?php
session_start();

//require login
if (!isset($_SESSION['username']) || $_SESSION['username'] === '') {
    header('Location: ../Main/login.html.php');
    exit;
}

// get current logged in username
$current_username = $_SESSION['username'];
$me = null;

$users_path = __DIR__ . '/../User/users.json';

if (file_exists($users_path)) {
    $users_json = file_get_contents($users_path);
    $users_data = json_decode($users_json, true);
    if (is_array($users_data)) {
        foreach ($users_data as $user) {
            if (isset($user['username']) && $user['username'] === $current_username) {
                $me = $user;
                break;
            }
        }
    }
}

// load quizzes
$quizzes = [];
$quizzes_path = __DIR__ . '/json/quizzes.json';

if (file_exists($quizzes_path)) {
    $qjson = file_get_contents($quizzes_path);
    $qdata = json_decode($qjson, true);
    if (is_array($qdata)) {
        $quizzes = $qdata;
    }
}

?>

<!-- HTML PART -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Your Quiz Results</title>
    <link rel="stylesheet" href="css/result.css">
</head>
<body>

<!-- display user name and show logout button! -->
<div class="top-bar">
  <span>Logged in as: <?php echo htmlspecialchars($current_username); ?> ✨</span>
  <a class="logout-link" href="../Main/logout.html.php">
    Logout
  </a>
</div>

<div class="container">
    <!-- Welcome Card -->
    <div class="card">
        <h1>Your Quiz Results</h1>
        <?php if ($me === null): ?>
            <p>Sorry couldn't Find you as a user. Try Logging in Again </p>
        <?php else: ?>
            <p>Welcome, <strong><?php echo htmlspecialchars($current_username); ?></strong>!<br>
               Here are your results from the different quizzes.</p>
        <?php endif; ?>
    </div> 
    <!-- Show Quiz Results for the user -->
    <?php if ($me !== null): ?>
        <?php foreach ($quizzes as $quiz): ?>
            <?php
            $quizKey = $quiz['quiz_index'] ?? '';
            $title   = $quiz['Title']  ?? 'Untitled Quiz';
            $field = $quiz['result_field'] ?? $quizKey;
            // added to check if user has a saved result
            $userResult = isset($me[$field]) && $me[$field] !== '';
            $userValue = $userResult ? $me[$field] : '';
        ?>
        <div class="card">
                <h2><?php echo htmlspecialchars($title); ?></h2>

                <?php if ($userResult): ?>
                    <!-- show result if user has taken this quiz -->
                    <p><strong>Your result:</strong> <?php echo htmlspecialchars($userValue); ?></p>
                    <p>Saved as <?php echo htmlspecialchars($field); ?> in your profile.</p>
                    <a class="btn" href="TakeQuiz.php?quiz=<?php echo htmlspecialchars($quizKey); ?>">
                        Retake this quiz
                    </a>
                <?php else: ?>
                    <!-- show if user hasn't taken this quiz -->
                    <p>You haven’t taken this quiz yet.</p>
                    <a class="btn" href="TakeQuiz.php?quiz=<?php echo htmlspecialchars($quizKey); ?>">
                        Take this quiz
                    </a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
<!-- Back to quizzes button -->
    <div class="card" style="text-align:center;">
        <a class="btn" href="Quiz.html.php">Back to all quizzes</a>
    </div>
</div>

</body>
</html>