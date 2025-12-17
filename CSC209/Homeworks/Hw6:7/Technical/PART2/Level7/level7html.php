
<html>
<head>
<title>Level 7</title>
<link rel="stylesheet" href="css/stylesheet.css">
</head>

<body>
<div style="text-align:center; padding:10px;">
<label for="theme">Themes: </label>
<select id="theme"></select>
</div>

<div class="slideshow-container">
<div id="slides">

</div>

<div>
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>

<div id="dots" style="text-align:center; padding:10px;">




<?php

$themes = ['All'];
$slidesHtmlByTheme = [];
$dotsHtmlByTheme = [];
$themedir = glob("Images/*", GLOB_ONLYDIR);

$allSlide = '';
$allDots  = '';

foreach ($themedir as $dir) {
$theme = basename($dir); 
$themes[] = $theme;



$image_files = glob($dir . "/*");

$total = count($image_files);
$slidesHtml = '';
$dotsHtml   = '';

foreach ($image_files as $i => $img) {
$name = basename($img);
$pos = strpos($name, ".");
$caption = ($pos !== false) ? substr($name, 0, $pos) : $name;
$number = $i + 1;

$slidesHtml .= '
<div class="mySlides fade" ' . ($i === 0 ? 'style="display:block;"' : '') . '>
<div class="numbertext">'.$number.'</div>
<img src="'.$img.'" style="width:100%">
<div class="text">'.$caption.'</div>
</div>';

$dotsHtml .= '<span class="dot" onclick="currentSlide('.$number.')"></span>';
}

$slidesHtmlByTheme[$theme] = $slidesHtml;
$dotsHtmlByTheme[$theme]   = $dotsHtml;
$allSlides .= $slidesHtml;
$allDots   .= $dotsHtml;

}




$slidesHtmlByTheme['All'] = $allSlides;
$dotsHtmlByTheme['All']   = $allDots;


?>



</div>

</div>
<script>
var THEMES = <?php echo json_encode($themes); ?>;
var SLIDES_HTML = <?php echo json_encode($slidesHtmlByTheme); ?>;
var DOTS_HTML   = <?php echo json_encode($dotsHtmlByTheme); ?>;
</script>
<script src="js/script.js"></script>
</body>
</html>
