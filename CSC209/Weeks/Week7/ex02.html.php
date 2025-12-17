<?php
$NRWEEKS=6;
$WEEK ="<h1>Week NRWEEK<h1>";
$LISTDATES= array("Sep 1-7","Sep 8-14","Sep 15-20","Sep 21-27","Oct 1-7","Oct 8-14","Oct 15-20","Oct 21-27","Nov 1-7","Nov 8-14","Nov 15-20","Nov 21-27","Dec 1-7");
$DATE ="<h2>DATE</h2>";
$LISTTOPICS=array("Installation","Html","Css","Javascript 1","","","","","","","","","");
$TOPIC ="<h3>TOPIC</h3";
$LISTDESCRIPTIONS= array("We install software","We make our first Html","We style pages with Css","Get started on Javascript ","","","","","","","","","");
$DESCRIPTION ="<p>DESCR</p>";
$LIST ="";
?>

<html>
<head>

</head>

<body>


<?php

for ($i=1; $i<= $NRWEEKS; $i++){

    echo "<h1>Week". $i ."<h1>";
    echo "<h2>". $LISTDATES[$i] ."</h2>";
    echo  "<h3>".$LISTTOPICS[$i]."</h3>";
    echo "<p>".$LISTDESCRIPTIONS[$i]."</p>";
}
		
?>
</body>

</html>