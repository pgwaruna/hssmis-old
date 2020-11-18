
<?php

	$role=$_GET['role'];
	$per=$_GET['per'];
	$status=$_GET['status'];
	$name=$_GET['name'];
	$group=$_GET['group'];

include '../admin/config.php';
     
$con5_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
	
if($status==0){

$query2="insert into permission values('$per','$role','$name','$group')";
$prev=mysql_query($query2);

if($prev){
echo "OK";
}
else{
echo 'Error';
}
}


elseif($status==1){

$query3="delete from permission where id='$per' and role_id='$role'";
$prev3=mysql_query($query3);

if($prev3){
echo "OK";
}
else{
echo 'Error';
}
}

//sleep(1);
?>