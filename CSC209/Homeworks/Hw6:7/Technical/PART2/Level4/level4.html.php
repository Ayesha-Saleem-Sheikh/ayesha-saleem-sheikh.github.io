
<html>
    <head>
        <title>Level 4</title>
        <link rel="stylesheet" href="css/stylesheet.css">
        
    </head>

    <body>
        <div class="slideshow-container">
            <div id="slides"></div>
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>

        <div style="text-align:center; padding:10px" id="dots"></div>

        <?php
        $image_files = glob("images/*");
        $slides= [];

        foreach ($image_files as $img) {
            $name = basename($img);
            $caption = substr($name, 0, strpos($name, "."));
            $slides[] = [
                "src" => $img,
                "caption" => $caption
            ];
        }
        ?>

        <script>var slidesData = JSON.parse('<?= json_encode($slides); ?>');</script>
        <script src="js/script.js"></script>
    </body>
</html>
