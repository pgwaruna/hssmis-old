<?php

	$code=$_GET['code'];
	$lect=$_GET['lect'];

     include '../admin/config.php';
     $con5_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);
	
	$query7_a="select acedemic_year from acc_year where current=1";
    
	$seven_a=mysql_query($query7_a);
	while($data5=mysql_fetch_array($seven_a)){
	$acc_year=$data5['acedemic_year'];
	 }
	 
	 $query7_b=mysql_query("update courseunit set lecture='$lect' where code='$code'");
	
	 $query7_c=mysql_query("insert into sub_assign values('$code','$lect','$acc_year','Not Assigned')");
	 
	 if(!($query7_c)){
	 $query7_d=mysql_query("update sub_assign set lect_id='$lect' where subject='$code' and acc_year='$acc_year'");
	 }	
	 
	if($query7_b && $query7_c)
	echo "<img src='images/c.jpg'>";
    
	if($query7_b && $query7_d)
	echo "<img src='images/c.jpg'>";
	//sleep(2);
?>
