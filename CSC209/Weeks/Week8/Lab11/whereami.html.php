<html>
<head>
    <?php 
 $path = realpath("whereami.html.php");
 $path = dirname($path);
 $path= basename($path);
 $labNrString = substr($path,-2);
//  echo var_dump(is_int($labNrString));
 $labNr= (int) $labNrString;
//  echo var_dump(is_int($labNr));

?>
</head>

<body>
<p>This page figures out its whereabouts</p>
<?php 
echo "My lab number is". $labNr;	
?>
</body>
</body>

</html>