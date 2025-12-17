<?php
session_start();

// Only admins can access this page
if (!isset($_SESSION['username']) || ($_SESSION['position'] ?? '') !== 'admin') {
    header('Location: ../Main/login.html.php');
    exit;
}

// variables to store error message and success message
$success = '';
$error   = '';

// created form data aray as fields were clearning when there was an error.
$form_data = [
    'quiz_index' => '',
    'title' => '',
    'prompt' => '',
    'result_a' => '',
    'result_b' => '',
    'result_c' => '',
    'result_d' => ''
];

// initialize question data
for ($i = 1; $i <= 3; $i++) {
    $form_data["q{$i}_text"] = '';
    $form_data["q{$i}_a"] = '';
    $form_data["q{$i}_b"] = '';
    $form_data["q{$i}_c"] = '';
    $form_data["q{$i}_d"] = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Quiz basic info
    $quiz_index = trim($_POST['quiz_index'] ?? '');
    $title      = trim($_POST['title'] ?? '');
    $prompt     = trim($_POST['prompt'] ?? '');

    // Store in form_data
    $form_data['quiz_index'] = $quiz_index;
    $form_data['title'] = $title;
    $form_data['prompt'] = $prompt;


    // Collect questions
    $questions_input = [];

    // loop through 3 questions
    for ($i = 1; $i <= 3; $i++) {

        $q_text = trim($_POST["q{$i}_text"] ?? '');
        $optA   = trim($_POST["q{$i}_a"] ?? '');
        $optB   = trim($_POST["q{$i}_b"] ?? '');
        $optC   = trim($_POST["q{$i}_c"] ?? '');
        $optD   = trim($_POST["q{$i}_d"] ?? '');
        
        //add to form data
        $form_data["q{$i}_text"] = $q_text;
        $form_data["q{$i}_a"] = $optA;
        $form_data["q{$i}_b"] = $optB;
        $form_data["q{$i}_c"] = $optC;
        $form_data["q{$i}_d"] = $optD;

        if ($q_text === '' || $optA === '' || $optB === '' || $optC === '' || $optD === '') {
            $error = "Please fill all fields for Question $i.";
            break;
        }

        // store question in json format
        $questions_input[] = [
            "text"    => $q_text,
            "choices" => [
                ["text" => $optA, "result" => "a"],
                ["text" => $optB, "result" => "b"],
                ["text" => $optC, "result" => "c"],
                ["text" => $optD, "result" => "d"]
            ]
        ];
    }

    // Result strings
    $result_a = trim($_POST['result_a'] ?? '');
    $result_b = trim($_POST['result_b'] ?? '');
    $result_c = trim($_POST['result_c'] ?? '');
    $result_d = trim($_POST['result_d'] ?? '');

    // Store in form_data
    $form_data['result_a'] = $result_a;
    $form_data['result_b'] = $result_b;
    $form_data['result_c'] = $result_c;
    $form_data['result_d'] = $result_d;

    
    if ($error === '') {

        
        $quizzes_path = __DIR__ . '/../Quizzes/json/quizzes.json';

        $quizzes = [];

        // load existing quizzes 
        if (file_exists($quizzes_path)) {
            $existing = file_get_contents($quizzes_path);
            $decoded  = json_decode($existing, true);
            if (is_array($decoded)) {
                $quizzes = $decoded;
            }
        }

        // Make sure quiz_index is unique
        foreach ($quizzes as $q) {
            if ($q["quiz_index"] === $quiz_index) {
                $error = "A quiz with this quiz key already exists.";
                break;
            }
        }
    }

    if ($error === '') {

        // Build new quiz 
        $new_quiz = [
            "quiz_index" => $quiz_index,
            "Title"      => $title,
            "Prompt"     => $prompt,
            "Questions"  => $questions_input,
            "Result"     => [
                "a" => $result_a,
                "b" => $result_b,
                "c" => $result_c,
                "d" => $result_d
            ]
        ];

        // add new quiz to existing list 
        $quizzes[] = $new_quiz;

        $save = file_put_contents($quizzes_path, json_encode($quizzes, JSON_PRETTY_PRINT));

        if ($save === false) {
            $error = "Error saving quiz!";
        } else {
            $success = "Quiz created successfully!";
            $form_data = array_fill_keys(array_keys($form_data), '');
        }
    }
}
?>
<html>
<head>
    <title>Create Quiz</title>
</head>
<body>
    <h1>Create a New Quiz</h1>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
        <a href="../Quizzes/Quiz.html.php">Back to Quizzes</a>
        <br><br>
    <?php endif; ?>

    <!-- Quiz creation form -->
    <form method="POST">
        <h3>Quiz Info</h3>

        <label>Quiz Key (example: house, patronus)<br>
            <input type="text" name="quiz_index" value="<?php echo htmlspecialchars($form_data['quiz_index']); ?>" required>
        </label><br><br>

        <label>Quiz Title<br>
            <input type="text" name="title" value="<?php echo htmlspecialchars($form_data['title']); ?>" style="width:300px;" required>
        </label><br><br>

        <label>Prompt / Description<br>
            <textarea name="prompt" rows="3" cols="50" required><?php echo htmlspecialchars($form_data['prompt']); ?></textarea>
        </label><br><br>

        <h3>Questions</h3>

        <?php for ($i = 1; $i <= 3; $i++): ?>
            <fieldset>
                <legend>Question <?php echo $i; ?></legend>

                <label>Text:<br>
                    <input type="text" name="q<?php echo $i; ?>_text" value="<?php echo htmlspecialchars($form_data["q{$i}_text"]); ?>" style="width:400px;">
                </label><br><br>

                <label>Option A:<br>
                    <input type="text" name="q<?php echo $i; ?>_a" value="<?php echo htmlspecialchars($form_data["q{$i}_a"]); ?>" style="width:300px;">
                </label><br><br>

                <label>Option B:<br>
                    <input type="text" name="q<?php echo $i; ?>_b"value="<?php echo htmlspecialchars($form_data["q{$i}_b"]); ?>" style="width:300px;">
                </label><br><br>

                <label>Option C:<br>
                    <input type="text" name="q<?php echo $i; ?>_c"value="<?php echo htmlspecialchars($form_data["q{$i}_c"]); ?>" style="width:300px;">
                </label><br><br>

                <label>Option D:<br>
                    <input type="text" name="q<?php echo $i; ?>_d" value="<?php echo htmlspecialchars($form_data["q{$i}_d"]); ?>" style="width:300px;">
                </label>

            </fieldset>
            <br>
        <?php endfor; ?>

        <h3>Result Mapping</h3>

        <label>A result:<br>
            <input type="text" name="result_a" value="<?php echo htmlspecialchars($form_data['result_a']); ?>" required>
        </label><br><br>

        <label>B result:<br>
            <input type="text" name="result_b" value="<?php echo htmlspecialchars($form_data['result_b']); ?>"required>
        </label><br><br>

        <label>C result:<br>
            <input type="text" name="result_c" value="<?php echo htmlspecialchars($form_data['result_c']); ?>" required>
        </label><br><br>

        <label>D result:<br>
            <input type="text" name="result_d"  value="<?php echo htmlspecialchars($form_data['result_d']); ?>" required>
        </label><br><br>

        <button type="submit">Save Quiz</button>
        <a href="admin.html.php">Cancel</a>
    </form>
</body>
</html>