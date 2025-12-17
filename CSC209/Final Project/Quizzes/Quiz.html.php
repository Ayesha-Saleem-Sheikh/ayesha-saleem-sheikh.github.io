<!-- Quiz page! -->
<?php
session_start();

// Load quizzes from json/quizzes.json
$quizzes = [];
$quizzes_path = __DIR__ . '/json/quizzes.json';

if (file_exists($quizzes_path)) {
    $qjson = file_get_contents($quizzes_path);
    $qdata = json_decode($qjson, true);
    $quizzes = $qdata;
    
}

// hard coded quiz keys that already have cards otherwise ones i have added were being repeated 
$known_keys = ['house', 'patronus', 'character', 'wizard', 'owls', 'marauder'];
?>

<!-- HTML PART -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magical Harry Potter Quizzes</title>
    <link rel="stylesheet" href="css/quiz.css">
</head>
<body>

<!-- Check if user logged in and if yes then display user name and show logout button! -->
<?php if (isset($_SESSION['username']) && $_SESSION['username'] !== ''): ?>
    <div class="login-bar">
  <span>Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?> ✨</span>
  <a href="Result.html.php">
    <button class="quiz-button" style="margin: 0 10px;">My Results</button>
  </a>
  <a class="logout-link" href="../Main/logout.html.php">
    Logout
  </a>
</div>
<?php endif; ?>
<header>
    <h1>⚡ Magical Harry Potter Quizzes ⚡</h1>
    <p>Discover your wizarding world destiny!</p>
</header>
	
<div class="container">
    <div style="text-align:right; margin-bottom:20px;">
        <?php if (!isset($_SESSION['username']) || $_SESSION['username'] === ''): ?>
            <!-- show login if NOT logged in -->
            <a href="../Main/login.html.php">
               <button class="quiz-button">Log In</button>
            </a>
        <?php endif; ?>
    </div>

    <!-- QUIZ GRID STARTED -->
     
    <div class="quiz-grid">
        <div class="quiz-card">
            <div class="quiz-image">🦁</div>
            <div class="quiz-content">
                <h2>Which Hogwarts House Do You Belong In?</h2>
                <p>Are you brave like a Gryffindor, cunning like a Slytherin, wise like a Ravenclaw, or loyal like a Hufflepuff?</p>
                <a href="TakeQuiz.php?quiz=house">
                  <button class="quiz-button">Take Quiz</button>
                </a>
        </div>
        </div>

            <div class="quiz-card">
                <div class="quiz-image">🪄</div>
                <div class="quiz-content">
                    <h2>What's Your Patronus?</h2>
                    <p>Discover the animal guardian that represents your innermost spirit and protects you from darkness.</p>
                    <a href="TakeQuiz.php?quiz=patronus">
                    <button class="quiz-button">Take Quiz</button>
                    </a>
                </div>
            </div>

            <div class="quiz-card">
                <div class="quiz-image">✨</div>
                <div class="quiz-content">
                    <h2>Which Harry Potter Character Are You?</h2>
                    <p>Find out if you're more like Harry, Hermione, Ron, or one of the many other beloved characters!</p>
                    <a href="TakeQuiz.php?quiz=character">
                    <button class="quiz-button">Take Quiz</button>
                    </a>
                </div>
            </div>

            <div class="quiz-card">
                <div class="quiz-image">🧙</div>
                <div class="quiz-content">
                    <h2>What Type of Wizard Are You?</h2>
                    <p>Are you a powerful duelist, a potion master, a charms expert, or something entirely different?</p>
                    <a href="TakeQuiz.php?quiz=wizard">
                    <button class="quiz-button">Take Quiz</button>
                    </a>
                </div>
            </div>

            <div class="quiz-card">
                <div class="quiz-image">📚</div>
                <div class="quiz-content">
                    <h2>Can You Pass Your Hogwarts O.W.L.s?</h2>
                    <p>Test your knowledge of the wizarding world with this challenging exam. Only true fans will pass!</p>
                    <a href="TakeQuiz.php?quiz=owls">
                    <button class="quiz-button">Take Quiz</button>
                    </a>
                </div>
            </div>

            <div class="quiz-card">
                <div class="quiz-image">🌟</div>
                <div class="quiz-content">
                    <h2>Which Marauder Are You?</h2>
                    <p>Discover if you're mischievous like James, loyal like Remus, fun-loving like Sirius, or clever like Peter.</p>
                    <a href="TakeQuiz.php?quiz=marauder">
                    <button class="quiz-button">Take Quiz</button>
                    </a>
                </div>
            </div>

            <!-- added quizzes by admin get added down here -->

            <?php foreach ($quizzes as $q): ?>
                <?php
                    $key    = $q['quiz_index'] ?? '';
                    $title  = $q['Title']      ?? '';
                    $prompt = $q['Prompt']     ?? '';

                    // skip ones I already have hard coded above
                    if ($key === '' || in_array($key, $known_keys)) {
                        continue;
                    }
                ?>
                <div class="quiz-card">
                    <div class="quiz-image">🔮</div> 
                    <div class="quiz-content">
                        <h2><?php echo htmlspecialchars($title); ?></h2>
                        <p><?php echo htmlspecialchars($prompt); ?></p>
                        <a href="TakeQuiz.php?quiz=<?php echo htmlspecialchars($key); ?>">
                            <button class="quiz-button">Take Quiz</button>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<!-- add javacript animation  -->
<script src="js/circle.js"></script>

</body>
</html>