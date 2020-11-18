<?php
//error_reporting(0);
session_start();
if((($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){
include'../connection/connection.php';

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
if($qpers['id']=="74"){
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


if($_SESSION['rumis_access']=="ready"){
		
$findurl="../rumis/index.php";

	echo"<font size=3px><b>Rumis Session</b></font><hr class=bar>";

echo"<div align=center>[ <a href='index.php?view=admin&task=leaverms'>Click here to disconnect RUMIS</a> ]</div>";
	echo"<iframe src='$findurl?lklsite=yes' width='765' height='700' scrolling='auto|yes|no' frameborder='0'></iframe>";


}
else{
echo"<font size=3px color=red>The connection for the RUMIS is established !</font><br><br>";
}












?>





<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>



<?php
