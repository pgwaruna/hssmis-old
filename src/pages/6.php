<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){


$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole) or die(mysql_error());

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}
//echo$qpers['id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="6"){
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

echo "Manage New Students<hr class=bar>";

/////////////////////////////////////////////////////////////////////
//student's combination confirmation and call combination prosse/////
/////////////////////////////////////////////////////////////////////

///....call combinations variables...................
$nxacyaer=$_POST['cscmb'];
$cmbeddt=$_POST['enddate'];
$cmbstat=$_POST['status'];
//..................................................
//..........combination confirmations variables..........
$cfmstud=$_POST['disstud'];
$cfmcmb=$_POST['ccmb'];
$cfstat=$_POST['sbcmb'];
$gbtyear=$_POST['btyear'];

//.......................


$quebtyear="select * from acc_year where current='1'";
$qubtyear=mysql_query($quebtyear);
while($qbtyear=mysql_fetch_array($qubtyear)){
$btyear=$qbtyear['acedemic_year'];
$btyr=explode("_",$btyear);
$cbtyr=$btyr[0];
$nxbtyr=$btyr[1];
$olbtyr=$cbtyr-1;
}

if($task=="cmbend"){
//........start ot stop call combinations...................
$quecmbifdel="delete from call_combination";
mysql_query($quecmbifdel);

$quecmbins="insert into call_combination(acc_year, closing_date, status) values('$nxacyaer','$cmbeddt','$cmbstat')";
mysql_query($quecmbins);
}



echo"<u>Call Subject Combination for New Student</u><br><br>";

//....display call combination status........................
echo "<form id='form1' method='POST' action='./index.php?view=admin&admin=6&task=cmbend'>";
echo"Next Academic Year : <select name='cscmb'>";
    
         $query5_a="select acedemic_year from acc_year where current=1 or current=2";
         $five_a=mysql_query($query5_a);
     while($data5=mysql_fetch_array($five_a)){
     echo "<option value=".$data5['acedemic_year']." selected>";
     $acc_parts=explode("_",$data5['acedemic_year']);
     echo $acc_parts[0]."_".$acc_parts[1];
     echo "</option>";
     }
echo"</select>";
echo "<br>Combination Rgistration Closing Date : ";
echo"<span id='date1'><input type='text' name='enddate' size='20'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Closing Date</font></span>";
echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";
echo"<select name='status'>";
echo"<option value='1'>Start</option>";
echo"<option value='0'>Stop</option>";
echo"</select>";
echo"<input type='submit' value='Submit'>";
echo "</form><br>";


$quecmbinf="select * from call_combination";
$qucmbinf=mysql_query($quecmbinf);
while($qcmbinf=mysql_fetch_array($qucmbinf)){
$gtay=$qcmbinf['acc_year'];
$gtdt=$qcmbinf['closing_date'];
$gtst=$qcmbinf['status'];
}

echo"<table border='0'><tr>";
echo"<th>Accdemic Year</th><th>Closing Date</th><th>Status</th></tr>";
echo"<tr class=selectbg2><td align='center'>$gtay</td><td align='center'>$gtdt</td><td align='center'>";
if($gtst=='1'){
echo"Start</td>";
}
else{
echo"Stop</td></tr>";
}
echo"</table><br>";

echo"<hr class=bar>";






echo"<br><u>Get New Student for Faculty</u><br>";

echo '<br>[ <a href="./forms/cmbcnf.php">Click here to Insert new student to the faculty</a> ]<br><br>';
echo "<hr class=bar>";
						

?>







<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
