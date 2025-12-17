<html>
<title> level 2  
</title>

<body>

<?php
$image_array = glob("Images/*");
foreach ($image_array as $image){
     echo "<img src='$image' style='width:100%''>";
    }
?>


</body>
</html>
