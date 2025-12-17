<?php
session_start();

// required login
if (!isset($_SESSION['username']) || $_SESSION['username'] === '') {
    header("Location: ../Main/login.html.php");
    exit();
}

// load current user
$current_username = $_SESSION['username'];

// load all quizzes
$quizzes_json = file_get_contents("json/quizzes.json");
$quizzes = json_decode($quizzes_json, true);

// taking in quiz index 
if (isset($_GET['quiz'])) { 
    $quiz_index = $_GET['quiz'];           
} elseif (isset($_POST['quiz_index'])) {
    $quiz_index = $_POST['quiz_index'];
} else {
    die("No quiz selected.");
}


$quiz = null;

// find quiz that has this quiz_index
foreach ($quizzes as $q) {
    if (isset($q['quiz_index']) && $q['quiz_index'] === $quiz_index) {
        $quiz = $q;
        break;
    }
}

//if selcted an inactive quiz show link back to main page
if ($quiz === null) {
    die("Invalid quiz selected. <a href='Quiz.html.php'>Go back to quizzes</a>");
}

$questions = $quiz['Questions'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // setting all count to zero
    $answers = [];
    $counts = [
        'a' => 0,
        'b' => 0,
        'c' => 0,
        'd' => 0
    ];

    // counting the answers 
    for ($i = 0; $i < count($questions); $i++) {
        $field_name = "q" . $i;
        if (!isset($_POST[$field_name])) {
            die("You did not answer question " . ($i + 1));
        }
        $answer = $_POST[$field_name];
        $answers[] = $answer;

        if (isset($counts[$answer])) {
            $counts[$answer] = $counts[$answer] + 1;
        }
    }

    // find highest count letter
    $max_count = max($counts);
    $top_letters = [];
    foreach ($counts as $letter => $count) {
        if ($count == $max_count) {
            $top_letters[] = $letter;
        }
    }

    // Break ties randomly
    $chosen_letter = $top_letters[array_rand($top_letters)];

    // Map letter to result string
    $result_map = $quiz['Result'];
    $result_string = $result_map[$chosen_letter]?? '' ;

    // Save to json/answers.json
    $answers_file = "json/answers.json";
    if (file_exists($answers_file)) {
        $answers_json = file_get_contents($answers_file);
        $all_answers = json_decode($answers_json, true);
        if (!is_array($all_answers)) {
            $all_answers = [];
        }
    } else {
        $all_answers = [];
    }

    $new_entry = [
        "username"   => $current_username,
        "quiz_index" => $quiz_index,
        "answers"    => $answers,
        "result"     => $result_string
    ];

    $all_answers[] = $new_entry;
    file_put_contents($answers_file, json_encode($all_answers, JSON_PRETTY_PRINT));


     // Save to json/user.json
    $users_path = "../User/users.json";

    if (file_exists($users_path)) {
        $users_json = file_get_contents($users_path);
        $users_data = json_decode($users_json, true);

        if (is_array($users_data)) {
            // field to store into user profile such as "house", "patronus"
            $field_name_user = isset($quiz['result_field']) ? $quiz['result_field'] : $quiz_index;

            foreach ($users_data as &$user) {
                if (isset($user['username']) && $user['username'] === $current_username) {
                    $user[$field_name_user] = $result_string;
                    break;
                }
            }
            unset($user);

            file_put_contents($users_path, json_encode($users_data, JSON_PRETTY_PRINT));
        }
    }

    //  REDIRECT RESULT PAGE
    header("Location: Result.html.php?quiz=" . urlencode($quiz_index));
    exit();
}
?>
<!-- From here we get to the actual Take Quiz HTML -->
<html>
<head>
    <title><?php echo htmlspecialchars($quiz['Title']); ?></title>
    <link rel="stylesheet" href="css/takequiz.css">
</head>
<body>

    <!-- Logged in header -->
    <div class="login-bar">
        <span>Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?> ✨</span>
        <a class="logout-link" href="../Main/logout.html.php"> Logout </a>
    </div>

    <header>
        <h1><?php echo htmlspecialchars($quiz['Title']); ?></h1>
        <p><?php echo htmlspecialchars($quiz['Prompt']); ?></p>
    </header>

    <div class="container">
        <!-- QUIZ FORM STARTS HERE -->
        <form method="POST" action="TakeQuiz.php">
            <!-- pass quiz_index  -->
            <input type="hidden" name="quiz_index" value="<?php echo htmlspecialchars($quiz_index); ?>"> 

            <?php for ($i = 0; $i < count($questions); $i++):
                $q = $questions[$i];
                $choices = $q['choices'];
            ?>
               <div class="question-box">
                    <p>Q<?php echo $i + 1; ?>. <?php echo htmlspecialchars($q['text']); ?>?</p>

                    <?php for ($j = 0; $j < count($choices); $j++):
                        $choice = $choices[$j];
                    ?>
                        <div class="option">
                            <label>
                                <input type="radio" name="q<?php echo $i; ?>" value="<?php echo $choice['result']; ?>" required>
                                <?php echo htmlspecialchars($choice['text']); ?>
                            </label>
                        </div>
                    <?php endfor; ?>
                </div>
            <?php endfor; ?>

            <button type="submit" class="quiz-button">Submit Quiz</button>
        </form>
    </div>
</body>
</html>