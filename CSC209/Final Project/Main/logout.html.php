<?php
session_start();

// remove session variables
session_unset();   

// destroy sesstion and redirect to Quiz homepage
session_destroy();
header("Location: ../Quizzes/Quiz.html.php");  
exit();
