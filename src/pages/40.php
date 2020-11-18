<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole);

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}

$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="40"){
$pem="TRUE";

}
}
}
else
{
echo "You Have Not Permission To Access This Area!";
}

if($pem=="TRUE")
{
?>





<?php

echo"Create Student Group Sessions<hr class=bar>";
//...........Edit by Iranga .............
//creating practical sessions and start practical registrations


echo "[ <a href='./forms/pract.php'>Click Here To Check Sessions Details</a> ]<br>";

////.....start practical registration to student...........

echo "<br><form method='POST' action='./index.php?view=admin&admin=40&task=enddate'>";
echo "Practical Rgistration Closing Date : ";
echo"<span id='date1'><input type='text' name='enddate' size='20'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Closing Date</font></span>";
echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";
echo"<select name='status'>";
echo"<option value='1'>Start</option>";
echo"<option value='0'>Stop</option>";
echo"</select>";
echo"<input type='submit' value='Submit'>";
echo "</form><br>";

if($task=="enddate"){

$enddate=$_POST['enddate'];
$status=$_POST['status'];

$queprac="select * from call_registration";
$quprac=mysql_query($queprac);
while($qup=mysql_fetch_array($quprac)){
$seme=$qup['semister'];
$acyart=$qup['acedemic_year'];
}

$quedel="delete from call_prac_registration";
mysql_query($quedel);

$que_ins_prac="insert into call_prac_registration(semester,accedamic_year,end_date,status) values($seme,'$acyart','$enddate',$status)";
mysql_query($que_ins_prac);
}

$quesel="select * from call_prac_registration";
$qusel=mysql_query($quesel);
while($qsel=mysql_fetch_array($qusel)){
$sem=$qsel['semester'];
$ye=$qsel['accedamic_year'];
$ed=$qsel['end_date'];
$st=$qsel['status'];
echo"<div align='center'><br>";

echo "<table border='0'>";
echo"<tr><th><font color='white'>Semester</th><th><font color='white'>Acedemic_Year</th><th><font color='white'>Closing Date</th><th><font color='white'>Status</font></th></tr>";

echo "<tr class=selectbg2><td>$sem</td>";
echo"<td>$ye</td>";
echo"<td>$ed</td>";

if($st=='1')
{echo"<td>Start</td>";}
if($st=='0')
{echo"<td>Stop</td>";}
if($st=='2')
{echo"<td>ND</td>";}
echo"</tr>";
}



echo"</table>";
//.........................................................
//select practical course unit.................
echo "<h3>Create Group Sessions</h3>";
$que40="select * from courseunit where semister=3 and availability=1 order by code";
$qu40=mysql_query($que40);
$sub=$q40['code'];
echo "Year end  Courses";
echo "<br><table border='0'><th>Course name<th>Course Unit";

while($q40=mysql_fetch_array($qu40)){
echo '<tr class=trbgc><td>&nbsp;&nbsp;'.$q40['name'].'</td><td align=center><a href="./forms/form_40_a.php?sub='.$q40['code'].'&task=create">'.strtoupper($q40['code']).'</td></tr> ';
}
echo "</table>";
//.................................................
//...enter other Practical Courses to database........
echo"<form method='POST'action='./forms/form_40_a.php?&task=send'>";
echo "Other Courses<br>";
echo"<table border='0' class=bgc>";
echo"<tr><td align='center'>";
	echo"<span id='code'>";
	echo"Enter the Subject Code: ";
	echo"<input type='text' name='pcode' id='pcode' size='10'>";

	echo"<span class='textfieldRequiredMsg'><font size='-1'> Please Enter Code </font></span>";
	echo"<span class='textfieldInvalidFormatMsg'><font size=-1>Invalid format</font></span>";
	echo"</span>";
	echo"<font color='#FF0000'>";
	echo"(";
	echo"<span style='font-size: 10pt'>";
	echo" 	Ex: MAT113b)";
	echo"</span></font>";
	//echo"<font color='#800000'></font>";
echo"</tr><tr><td align='center'><input type='submit' name='subsend' value='Submit' ></td></tr></table>";
echo"</form>";
//................................

?>	




<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>


	
