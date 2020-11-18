<?php

	$dept_course=$_GET['course'];
	$date=$_GET['date'];

     include '../admin/config.php';
     $con2_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);



//require_once('../classes/globalClass.php');	
//$k=new settings();
//$semi=$k->getSemister();

$query1="SELECT lecture_id,hours, time, type,att_group FROM lecture WHERE course = '$dept_course' and date = '$date'";
$prev1=mysql_query($query1);
	

echo '<select size="4" name="lecture_id" id="lecture_id" onchange="displaystd()">';

while($iddata2=mysql_fetch_array($prev1)){

$atgrp=$iddata2['att_group'];
if($atgrp=="nogrp"){
		$atgrp2=".";		
					}
else{
		$atgrp2=", Group is : $atgrp";
		}

echo '<option value="'.$iddata2['lecture_id'].'">Start @ '.$iddata2['time'].','.$iddata2['hours'].'Hs and '.$iddata2['type'].' Type '.$atgrp2.'</option>';
					
}
echo '</select>';



//sleep(1);
?>
