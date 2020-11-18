
<?php

$lecture=$_GET['lecture'];

include '../admin/config.php';
     
$con6_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
	

$fmviweque="rumisdb.fohssmisStudents fs";
//$query2322="select count(status) as count from participation where lect_id = '$lecture'";
$query2322="select count(p.status) as count from participation p, $fmviweque where p.lect_id = '$lecture' and p.student=fs.user_name";
$data22322=mysql_query($query2322);
while($predata=mysql_fetch_array($data22322)){
echo '|| '.$predata['count'].' ||';
}



sleep(1);
?>
