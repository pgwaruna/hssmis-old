<?php

	$date=$_GET['date'];
	$lect=$_GET['lect'];
	$h=$_GET['h'];
	$t=$_GET['t'];
	$type=$_GET['type'];
	$mdpgp=$_GET['mpgp'];	
	$mexptno=$_GET['expn'];
     include '../admin/config.php';
     $con6_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);


if($mexptno!=""){	 
	 
	 
$mexptno2=str_replace (" ", "", $mexptno);
$mexptno3=strtoupper($mexptno2);
$pgnmexpn=$mexptno3."-".$mdpgp;

if($mdpgp=="nogrp"){
$pgnmexpn=$mdpgp;
}
	 


$query2="update lecture set date='$date', hours='$h', time='$t' , type='$type', att_group='$pgnmexpn' where lecture_id='$lect'";
$prev=mysql_query($query2);
if($prev){

echo "<hr color=#E1E1F4 width=95%>Modified Data <hr color=#E1E1F4 width=95%><br>";

echo 'Lecture ID &nbsp;'. $lect .' - &nbsp;Above Data Succesfully Modified info Follows<br />';
echo 'Modified Date : '.$date.'<br />';
echo 'Modified Hours : '.$h.'<br />';
echo 'Modified Start Time : '.$t.'<br />';
echo 'Modified Type : '.ucfirst($type).'<br />';	

if($mdpgp!="nogrp"){
echo"Modified Group : ".$pgnmexpn."<br>";
}




echo '<hr color=#E1E1F4 width=95%> <a href="index.php?view=admin&admin=30">Back To Modify Area </a><br>';
}
					}
					
else{
echo"<font color=red>Sorry! You Have not Enter Experiment Number Recreate Acadamic Session</fonr><br>";

echo"[ <a href=./index.php?view=admin&admin=30&modify_id=$lect>Re Create</a> ]";
		}
					
					
					
					
//sleep(1);
?>