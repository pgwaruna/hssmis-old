<?php
include 'admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

$part="select * from participation where student='ps368'";
$pa=mysql_query($part);
while($p=mysql_fetch_array($pa)){
$l=$p['lect_id'];


echo " ".$p['student']." |".$l." |".$p['status']."****"; 

$part2="Select * from participation where lect_id='$l' and student='7689'";
$pa2=mysql_query($part2);
while($p=mysql_fetch_array($pa2)){
$del="delete from participation where student='ps434' and lect_id='$l'";
mysql_query($del);
echo "....... ".$p['student']." |".$p['lect_id']." |".$p['status']."<br>"; 
}

$up="update participation set student='7691' where student='ps434'";
mysql_query($up);
}

?>