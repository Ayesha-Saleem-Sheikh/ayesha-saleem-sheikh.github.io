<?php
$filename = __DIR__ . "/newfile.txt"; 
echo "Writing to: $filename<br>";
$myfile = fopen($filename, "a") or die("Unable to open file!");
$txt = "Donald Duck\n";
fwrite($myfile, $txt);
$txt = "Goofy Goof\n";
fwrite($myfile, $txt);
fclose($myfile);

echo "Done.";
?>
