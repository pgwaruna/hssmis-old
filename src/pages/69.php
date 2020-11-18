<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){
include'../connection/connection.php';

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole) ;

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
if($qpers['id']=="69"){
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
$a=new settings();

$stcuracyear=$a->getAcc();
$uname=$_SESSION['user_id'];

echo"UCTIT & UTEL Registrations Status";
echo"<hr class=bar>";
///////////////////////////////////////////////////
//////////reg situation////////////////////////////
///////////////////////////////////////////////////
$basicregstatus="basic1";
///////////////////////////////////////////////////
//////////reg situation////////////////////////////
///////////////////////////////////////////////////

$eliuser=array("aruna","kanthi");

if(($role!="lecturer")||(in_array($uname,$eliuser))){



echo"<font size=3px>*** All Details of Registrations ***</font><br>";


$quegetfultbl="select * from uctit_utel_reg_status where academic_year='$stcuracyear' and status='$basicregstatus' order by stno";
$qugetfultbl=mysql_query($quegetfultbl);
if(mysql_num_rows($qugetfultbl)==0){
	echo"<br><font color=red>Sorry! No data found for $stcuracyear academic year.</font>";
}
else{
$rownm=1;
echo"<div id=m>";
echo"<table>";
echo"<th>#</th>";
for($f=0;$f < mysql_num_fields($qugetfultbl);$f++){
			$field=mysql_field_name($qugetfultbl,$f);
					if($field=="stno"){
						echo "<th> STUDENT_NO</th>";
									}
					else{
						if(($field!="academic_year")&&($field!="status")){
							echo "<th> ".strtoupper($field)."</th>";
										}
						}
									}

while($qgetfultbl=mysql_fetch_array($qugetfultbl,MYSQL_ASSOC)){
	echo "<tr  class=trbgc>";
		$stno=$qgetfultbl['stno'];
		$stbtch=$a->getBatch($stno);
		echo"<td align=center valign=top>$rownm";
		$fe=0;
		foreach($qgetfultbl as $tdinf ){
						
			if($fe==0){
				echo "<td valign=top align=center>SC/$stbtch/$tdinf</td>";
					}
			else{
				if(($fe!=1)&&($fe!=18)){
				echo "<td valign=top>&nbsp;".$tdinf."</td>";
					   }
				}
			$fe++;
										
						}
	echo "</tr>";

$rownm++;
}





echo"</table></div>";
}

}/////////////////////////////////role and user eli. if close brc/////////////////////////// 
else{
	echo"<br>Sorry!,This option not available for you.<br>";
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
