
<?php

	$lecture=$_GET['lecture1'];
	$student=$_GET['student1'];
	$status=$_GET['status1'];

include '../admin/config.php';
     
$con5_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
	
if($status==0){

$query2="insert into participation values('$student','$lecture',1)";
$prev=mysql_query($query2);

if($prev){
echo 1;
}
else{
echo 'Error';
}
}


elseif($status==1){

$query3="delete from participation where student='$student' and lect_id='$lecture'";
$prev3=mysql_query($query3);

if($prev3){
echo 0;
}
else{
echo 'Error';
}
}

//sleep(1);
?>