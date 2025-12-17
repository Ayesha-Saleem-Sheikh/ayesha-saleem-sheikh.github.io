<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: login.html.php');
  exit;
}


$userFolder = basename($_SESSION['username']); 
$userDir    = __DIR__ . '/../Users/' . $userFolder . '/';


$uploadMessage = '';
if (isset($_POST['submit']) && isset($_FILES['fileToUpload'])) {
  
  $target_dir  = $userDir; 
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

 
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadMessage .= "File is not an image.<br>";
    $uploadOk = 0;
  }

  
  if (file_exists($target_file)) {
    $uploadMessage .= "Sorry, file already exists.<br>";
    $uploadOk = 0;
  }

 
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    $uploadMessage .= "Sorry, your file is too large (max 500 KB).<br>";
    $uploadOk = 0;
  }

  
  if ($imageFileType != "jpg" && $imageFileType != "jpeg"
      && $imageFileType != "png" && $imageFileType != "gif") {
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
  <title>User Page</title>
  <link rel="stylesheet" href="../slideshow/css/stylesheet.css">
  <style>.mySlides:first-of-type{display:block}</style>
</head>
<body>
  <h2 style="text-align:center">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
  <p style="text-align:center">Showing images in: <code><?php echo htmlspecialchars($userFolder); ?></code></p>

  <div style="max-width:720px;margin:16px auto;text-align:center;">
    <?php if ($uploadMessage !== ''): ?>
      <div style="margin-bottom:10px;color:#444;"><?php echo $uploadMessage; ?></div>
    <?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
      <input type="file" name="fileToUpload" accept=".jpg,.jpeg,.png,.gif" required>
      <button type="submit" name="submit">Upload</button>
    </form>
  </div>

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

  <div style="text-align:center;margin-top:16px;">
    <a href="logout.html.php">Logout</a>
  </div>

  <script src="../slideshow/js/script.js"></script>
  <script>
    if (typeof showSlides === "function") {
      window.slideIndex = 1;
      showSlides(1);
    }
  </script>
</body>
</html>
