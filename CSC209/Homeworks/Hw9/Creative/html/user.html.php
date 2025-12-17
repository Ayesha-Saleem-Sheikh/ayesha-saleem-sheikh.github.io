<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.html.php');
  exit;
}


$house  = $_SESSION['house'] ?? 'Gryffindor';
$bg = '#7F0909';   
$fg = '#FFD700';
$banner = 'Gryffindor';

if ($house === 'Hufflepuff') {
  $bg = '#FFDB00';
  $fg = '#1C1C1C';
  $banner = 'Hufflepuff';
} elseif ($house === 'Ravenclaw') {
  $bg = '#0E1A40';
  $fg = '#946B2D';
  $banner = 'Ravenclaw';
} elseif ($house === 'Slytherin') {
  $bg = '#1A472A';
  $fg = '#AAAAAA';
  $banner = 'Slytherin';
}


$userFolder = basename($_SESSION['username']);       
$userDir    = __DIR__ . '/../Users/' . $userFolder . '/';


$uploadMessage = '';
if (isset($_POST['submit']) && isset($_FILES['fileToUpload'])) {

  if (!is_dir($userDir)) { @mkdir($userDir, 0777, true); }

  $target_dir  = $userDir;
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


  $check = @getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check === false) { $uploadMessage .= "File is not an image.<br>"; $uploadOk = 0; }

 
  if (file_exists($target_file)) { $uploadMessage .= "Sorry, file already exists.<br>"; $uploadOk = 0; }


  if ($_FILES["fileToUpload"]["size"] > 500000) { $uploadMessage .= "Sorry, your file is too large (max 500 KB).<br>"; $uploadOk = 0; }


  if (!in_array($imageFileType, ['jpg','jpeg','png','gif'])) {
    $uploadMessage .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
    $uploadOk = 0;
  }


  if ($uploadOk == 0) {
    $uploadMessage .= "Sorry, your file was not uploaded.";
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $uploadMessage .= "The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
  
    } else {
      $uploadMessage .= "Sorry, there was an error uploading your file.";
    }
  }
}


$images = [];
if (is_dir($userDir)) {
  foreach (['*.jpg','*.jpeg','*.png','*.gif','*.webp'] as $pat) {
    foreach (glob($userDir . $pat) as $abs) {
      $images[] = '../Users/' . $userFolder . '/' . basename($abs); 
    }
  }
}
$total = count($images);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title><?php echo htmlspecialchars($banner); ?> Common Room</title>

  <style>
    :root { --bg: <?php echo $bg; ?>; --fg: <?php echo $fg; ?>; }
    body {
      margin: 0; font-family: Arial, sans-serif;
      background: var(--bg); color: var(--fg);
      min-height: 100vh; padding: 24px;
    }
    .card {
      background: rgba(255,255,255,0.08);
      padding: 16px; border: 1px solid rgba(255,255,255,0.2);
      border-radius: 8px; max-width: 720px; margin: 0 auto 16px;
    }
    button {
      background: var(--fg); color: var(--bg);
      border: none; padding: 10px 16px; border-radius: 6px;
      font-weight: bold; cursor: pointer;
    }
    button:hover { opacity: 0.9; }
    .mySlides:first-of-type { display:block; }
    .slideshow-container { border: 1px solid rgba(255,255,255,0.2); border-radius: 10px; }
    .prev, .next { color: var(--fg); }
    .dot.active, .dot:hover { background-color: var(--fg); }
  </style>


  <link rel="stylesheet" href="../slideshow/css/stylesheet.css">
</head>
<body>
  <div class="card">
    <h1><?php echo htmlspecialchars($banner); ?> Common Room</h1>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>House: <strong><?php echo htmlspecialchars($house); ?></strong></p>
  </div>

  <div class="card" style="text-align:center;">
    <?php if ($uploadMessage !== ''): ?>
      <div style="margin-bottom:10px;color:#fff;"><?php echo $uploadMessage; ?></div>
    <?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
      <input type="file" name="fileToUpload" accept=".jpg,.jpeg,.png,.gif" required>
      <button type="submit" name="submit">Upload</button>
    </form>
  </div>

  <?php if ($total === 0): ?>
    <div class="card" style="text-align:center;">
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

  <div class="card" style="text-align:center;">
    <a href="logout.html.php"><button>Logout</button></a>
  </div>

  <script src="../slideshow/js/script.js"></script>
  <script>
    if (typeof showSlides === "function") {
      window.slideIndex = 1;
      showSlides(1);
    } else {
      console.warn("showSlides() not found. Check ../slideshow/js/script.js path.");
    }
  </script>
</body>
</html>
