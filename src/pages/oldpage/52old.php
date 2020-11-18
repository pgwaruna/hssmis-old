<?php
//error_reporting(0);
session_start();
if((isset($_SESSION['login'])=="truefohssmis")){

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from rumisdb.role where role='$role'";
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
if($qpers['id']=="52"){
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
$role=$_SESSION['role'];


require_once('./classes/globalClass.php');
$n=new settings();


$acyart=$n->getAcc();
$crrseme=$n->getSemister();

echo" Print Attendance Sheets";
echo"<hr color='#ecc4f8'>";

echo"You have following subjects to Print Attendence Sheet<br>"; 




if(($role=="administrator")||($role=="topadmin")){
$queprtatt="select code, name, department, level from courseunit where (semister=$crrseme or semister=3) and availability=1 order by code,name";
}
else{
$dept=$_SESSION['section'];
$queprtatt="select code, name, department, level from courseunit where department='$dept' and (semister=$crrseme or semister=3) and availability=1 order by code,name";
}






//echo$queprtatt;
$quprtatt=mysql_query($queprtatt);
echo"<table border=0 width='100%'><tr>";
echo"<th>Course Unit<th>Course Unit Name<th>View</tr>";

while($qprtatt=mysql_fetch_array($quprtatt)){
	$code=$qprtatt['code'];
	$coname=$qprtatt['name'];
	$codept=$qprtatt['department'];
	$colvl=$qprtatt['level'];
		echo"<tr bgcolor='#edd4dc'><form method=POST action='./forms/form_52.php'><td align='center'>".strtoupper($code);
			echo"<input type='hidden' name='prtcode' value=$code ></td>";
			echo"<input type='hidden' name='prtcolvl' value=$colvl ></td>";
			echo"<input type='hidden' name='prtcosem' value=$crrseme ></td>";
			echo"<input type='hidden' name='prtcrtacy' value=$acyart ></td>";

		echo"<td>&nbsp;&nbsp; $coname<input type='hidden' name='prtconame' value='$coname'></td>";
		echo"<td align='center'><input type='hidden' name='prtcodept' value= $codept><input type=submit value='View Attendance Sheet'></td></tr></form>";


}

echo"</table>";

















?>







<?php
}
}	
else{

echo "You Have Not Permission To Access This Area!";}
?>




