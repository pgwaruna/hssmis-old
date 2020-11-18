
<?php

$lecture=$_GET['lect'];

include '../admin/config.php';
     
$con5_a=mysql_connect($host,$user,$pass);
mysql_select_db($db);
	
$query2="delete from lecture where lecture_id='$lecture'";
$prev1=mysql_query($query2);

$query3="delete from participation where lect_id='$lecture'";
$prev2=mysql_query($query3);

if($prev1)
echo '<br /><font color="red"><br />Lecture '.$lecture.'Was succesfully removed<br />';

if($prev2)
echo 'Lecture partcipations were succesfully removed</font><br /><br />';

//sleep(1);
?>
