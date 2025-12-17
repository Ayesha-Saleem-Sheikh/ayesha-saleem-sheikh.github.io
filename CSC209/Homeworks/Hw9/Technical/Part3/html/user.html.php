<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.html.php');
  exit;
}
$userFolder = basename($_SESSION['username']);  
$baseDir = __DIR__ . '/../Users/' . $userFolder;
$images = [];
if (is_dir($baseDir)) {
  foreach (['*.jpg','*.jpeg','*.png','*.gif','*.webp'] as $pat) {
    foreach (glob($baseDir . '/' . $pat) as $abs) {
      $images[] = '../Users/' . $userFolder . '/' . basename($abs);
    }
  }
}
$total = count($images);
?>
<!DOCTYPE html>
<html>
<head>
  <title>User Page</title>
  <link rel="stylesheet" href="../slideshow/css/stylesheet.css">
</head>
<body>
  <h2 style="text-align:center">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
  <p style="text-align:center">Showing images for: <code><?php echo htmlspecialchars($userFolder); ?></code></p>

  <?php if ($total === 0): ?>
    <div class="slideshow-container" style="padding:24px;text-align:center;">
      No images found. Looked in <code><?php echo '../Users/' . htmlspecialchars($userFolder) . '/'; ?></code>
    </div>
  <?php else: ?>
    <div class="slideshow-container">
      <?php foreach ($images as $i => $src): ?>
        <div class="mySlides fade">
          <div class="numbertext"><?php echo ($i+1) . ' / ' . $total; ?></div>
          <img src="<?php echo $src; ?>" alt="slide <?php echo $i+1; ?>">
          <div class="text"><?php echo htmlspecialchars($_SESSION['username']); ?>’s photo <?php echo $i+1; ?></div>
        </div>
      <?php endforeach; ?>
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <br>
    <div style="text-align:center">
      <?php for ($i = 1; $i <= $total; $i++): ?>
        <span class="dot" onclick="currentSlide(<?php echo $i; ?>)"></span>
      <?php endfor; ?>
    </div>
  <?php endif; ?>

  <script src="../slideshow/js/script.js"></script>
  <script>
    
    if (typeof showSlides === "function") {
      window.slideIndex = 1;
      showSlides(1);
    }
  </script>
</body>
</html>
