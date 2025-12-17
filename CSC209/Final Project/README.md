## CSC 209 Final Project

This project is a **Harry Potter–themed quiz website** where users can take personality-style quizzes and view their results.

---

## How to Use the Website

### Starting the Project

Open `Quizzes/Quiz.html.php`, which serves as the main quiz page.

### From the User Side

A user can register a new account from the login page. After logging in, the user can take any available quiz, view their quiz result on their results page, and retake a quiz to update their result. Quiz results are saved, so users can always see their latest outcome.

### From the Admin Side
Admin log in:
    username: admin
    password: 123
    
An admin logs in using an admin account. From the admin dashboard, an admin can view all registered users, see users’ quiz answers as they take quizzes, edit a user’s username, password, or role, delete a user (which removes their data from both `users.json` and `answers.json`), and create new quizzes that are automatically added to the quiz grid.

---

## Project Overview

This project uses all the parts we have studied so far and integrates **HTML, CSS, JavaScript, and PHP**, while using **only JSON files** (no database). The website is **dynamic and interactive**, with content changing based on user actions and server-side updates.

---

## Changes Added After the Last Presentation

After the last presentation, I added `circles.js` to fulfill the JavaScript animation requirement. I also moved the **delete user** and **edit user** logic into a PHP library to better organize the code and fulfill the PHP library requirement.

---

## New Techniques Learned and Applied

While I did not add an entire new W3Schools section, I learned and implemented several smaller techniques throughout the project.

### PHP

I used `urlencode()` in links to safely pass quiz parameters through URLs. I added `header('Content-Type: application/json')` in PHP files that return JSON to ensure proper AJAX handling and prevent errors. I consistently used `exit()` after redirects, applied `trim()` to user input to prevent spacing issues, and used `htmlspecialchars()` to safely display user-generated content and prevent errors.

### CSS

I implemented a responsive grid layout using `repeat(auto-fill, minmax())` so the quiz grid adapts to any number of quizzes without hardcoded columns. I used CSS transformations for hover effects and animations on buttons and cards, and created animated modal windows using CSS transitions and animations.


