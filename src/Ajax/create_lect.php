<?php

	$date=$_GET['date1'];
	$h=$_GET['h1'];
	$t=$_GET['t1'];
	$type=$_GET['type1'];
	$subject=$_GET['subject'];
	$pg=$_GET['pgp1'];
	$exptno=$_GET['expn1'];
		
     include '../admin/config.php';
     $con7_a=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
     mysql_select_db($db);
//...............edit by iranga....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
//.................................................	
		

$query3="select max(lecture_id) as maxxa from lecture";
$prev2=mysql_query($query3);

while($iddata=mysql_fetch_array($prev2)){
$max=$iddata['maxxa'];						
}

$lid=$max+1;

if($exptno!=""){


$exptno2=str_replace (" ", "", $exptno);
$exptno3=strtoupper($exptno2);
$pgnexn=$exptno3."-".$pg;
/////////////////////////////////////////////////////////




if($pg=="nogrp"){
$pgnexn=$pg;
}
$query2="insert into lecture(lecture_id,course,date,hours,time,type,att_group,acc_year ) values('$lid','$subject','$date','$h','$t','$type','$pgnexn','$acy')";
$prev=mysql_query($query2);

if($prev){
echo '<font size="3">Your Lecture ID= '.$lid.'</font><br /><br />';



echo '<table border="0" width="50%" align="center"><tr><td>';
echo '<img border="0" src="images/small/revert.png"></td><td><img border="0" src="images/small/add.png"></td></tr><tr>';
echo '<td><font size="2"><a href="./index.php?view=admin&admin=28&attdisp=displayatt&task2=Removethis&id='.$lid.'"> Remove This ID </a></font></td><td><font size="2">';
echo '<a href="./index.php?view=admin&admin=28&attdisp=displayatt&task2=dailyAtt&id='.$lid.'"> ADD DATA to This ID </a></font></td></tr></table>';

echo "<hr class=bar>Lecture ID Data <hr class=bar><br>";


echo 'Lecture ID Created Succesfully <br />';

echo 'Lecture Date : '.$date.'<br />';
echo 'Lecture Hours : '.$h.'<br />';
if($pg!="nogrp"){
echo"Group is: ".$pgnexn."<br>";
}
echo 'Lecture Start Time : '.$t.'<br />';
	
echo '<br><br><p><font color="red"> Note : Please indicate this Lecture ID in your Attendence Sheet for future corrections and modifications</font></p>';

}

else {


echo '<font color="red">Lecture ID Does Not Created </font><br /><br /> Two Lectures in Same Time with same subject is Not Alowed. <br />';
echo 'Remove Unnessasary Lecture ID with following time slot and re try. <br /><br /><br />';
echo 'Lecture Date : '.$date.'<br />';
echo 'Lecture Hours : '.$h.'<br />';
if($pg!="nogrp"){
echo"Group is: ".$pgnexn."<br>";
}
echo 'Lecture Start Time : '.$t.'<br /><hr class=bar><br>';

echo '<p>Close This Window <a href="javascript:window.close()"><img border="0" src="images/small/emblem-nowrite.png"></a></p>';

}
				}
else{
echo"<font color=red>Sorry! You Have not Enter Experiment Number Recreate Acadamic Session</fonr><br>";

echo"[ <a href=index.php?view=admin&admin=28&attdisp=displayatt&sub=$subject&task0=attendence>Re Create</a> ]";
		}
				
				
				
//sleep(1);
?>
