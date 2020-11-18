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
if($qpers['id']=="55"){
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

echo"All Registration Details of Passout Student";
echo"<hr class=bar>";

$quegtpasoutlvl="select year from level where level=0 order by year DESC";
$qugtpasoutlvl=mysql_query($quegtpasoutlvl);
echo"<form method=POST action='index.php?view=admin&admin=55&task=pasreg'>Select year of passout student's <br><select name='passout'>";
while($qgtpasoutlvl=mysql_fetch_array($qugtpasoutlvl)){
		$gtpasoutlvl=$qgtpasoutlvl['year'];
			echo"<option value='$gtpasoutlvl'>Year, $gtpasoutlvl Batch</option>";

														}//get passout level while close
														
echo"</select>";
/*
echo"<select name=filter>";
	echo"<option value='All Registration Datails' selected>All Registration Datails</option>";
	echo"<option value='Registration Datails of Semester 1'>Registration Datails of Semester 1</option>";
	echo"<option value='Registration Datails of Semester 2'>Registration Datails of Semester 2</option>";
	echo"<option value='Registration Datails of Semester 3'>Registration Datails of Semester 3</option>";
	echo"<option value='Registration Datails of Semester 4'>Registration Datails of Semester 4</option>";
	echo"<option value='Registration Datails of Semester 5'>Registration Datails of Semester 5</option>";
	echo"<option value='Registration Datails of Semester 6'>Registration Datails of Semester 6</option>";
echo"</select>";
*/


echo"<input type=submit value='Submit'></form>";


if($task=="pasreg"){
	$pasregyer=$_POST['passout'];
	$pasregsem=$_POST['filter'];
	echo$pasregyer.$pasregsem;



					}//task=pasreg if close














?>




<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
