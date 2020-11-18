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
if($qpers['id']=="73"){
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


require_once('./classes/globalClass.php');
$vgps=new settings();

$acc_ye=$vgps->getAcc();
$seme=$vgps->getSemister();

echo"View Student's Group Sessions<hr class=bar>";

//.........get subject................

if($role=="administrator"||$role=="topadmin"||$role=="sar"){
$dissub="select distinct(ps.subject), c.name from practical_session ps, courseunit c where ps.acc_year='$acc_ye' and ps.subject=c.code order by c.department,c.code";
}
else{
$usrdept=$_SESSION['section'];
$dissub="select distinct(ps.subject), c.name from practical_session ps, courseunit c where ps.acc_year='$acc_ye' and ps.subject=c.code and c.	department='$usrdept' order by c.department,c.code";
}

//echo$dissub;
$disub=mysql_query($dissub);
if(mysql_num_rows($disub)==0){
echo"<font color=red size=3px>Sorry! There are no created group sessions.<br><br></font>";

				}
else{
echo"<table border='0'>";
$wgs73=1;
echo"<tr align=center><th>#<th>Course Name<th>View Group</tr>";
while($dsub=mysql_fetch_array($disub)){
$dsu=$dsub['subject'];
$dsunm=$dsub['name'];
echo"<tr class=trbgc><form method=post action='./forms/pract.php?task=check&frm=73'>";
echo"<td align=center>$wgs73<td>$dsunm<td align=center><input type=submit name=codenm value='$dsu'></td> ";
echo"</tr></form>";
$wgs73++;
}
echo"</table>";
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


