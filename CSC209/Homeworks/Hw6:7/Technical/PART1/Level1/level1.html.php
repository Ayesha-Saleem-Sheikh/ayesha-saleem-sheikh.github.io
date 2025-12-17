<html>
<title> level 1   
</title>

<body>

<?php
$image_array = glob("Images/*");
?>

<div id="images"></div>

<script>var images = JSON.parse('<?= json_encode($image_array); ?>');</script>
        
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>
