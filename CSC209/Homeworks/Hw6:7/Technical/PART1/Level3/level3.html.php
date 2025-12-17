<html>
<title> level 3  
</title>

<body>

<select id ="dropdown">
    <option value= "all"> Show all </option>
    <?php
    $image_array = glob("Images/*");
    foreach ($image_array as $index => $img) {
        $name = basename($img);
        echo "<option value='$index'>$name</option>";
    }
    ?>
</select>
<br>
</br>
<?php
foreach ($image_array as $index => $img){
echo "<img src='$img' data-id='$index' style='width:100%;margin:5px;'>";
}
?>

<script src="js/script.js"> </script>


</body>
</html>
