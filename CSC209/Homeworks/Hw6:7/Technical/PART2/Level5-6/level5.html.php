
<html>
    <head>
        <title>Level 4</title>
        <link rel="stylesheet" href="css/stylesheet.css">
    </head>

    <body>
        <div class="slideshow-container">
            <div id="slides">
            

        <?php
        $image_files = glob("images/*");
        $total = count($image_files);
        $slides= [];

        foreach ($image_files as $i => $img) {
            $name = basename($img);
            $caption = substr($name, 0, strpos($name, "."));
            $number = ($i + 1);
             echo '
            <div class="mySlides fade">
            <div class="numbertext">'.$number.'</div>
            <img src="'.$img.'" style="width:200%">
            <div class="text">'.$caption.'</div>
            </div>';
        }
        ?>
        </div>

    <div>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <div id="dots" style="text-align:center; padding:10px;">
    
    <?php
    for ($i = 1; $i <= $total; $i++) {
        echo '<span class="dot" onclick="currentSlide('.$i.')"></span>';
    }
    ?>
    </div>

 <script src="js/script.js"></script>
</body>
</html>
