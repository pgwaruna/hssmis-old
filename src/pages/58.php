<?php
//error_reporting(0);
session_start();
$curriculum = intval($_SESSION['curriculum']);
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
if($qpers['id']=="58"){
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
echo" Printable Version of Examination Registration";
echo"<hr class=bar>";




$role=$_SESSION['role'];
$dept_id=$_SESSION['section'];
$rltduser=$_SESSION['user_id'];

require_once('./classes/globalClass.php');
$n=new settings();


$acyart=$n->getAcc();
$crrseme=$n->getSemister();

///////////////////////////////////////////////////////All Student Exam Registration Detals////////////////////////////////////////////////
echo"<h3>*** Student's Examination Registration Detals ***</h3>";
echo"<form method=POST action='./imp_exp/Exam_reg_view.php'>";
echo"<table border=0 ><tr class=selectbg height=35px align=center><td>";

echo"Select Student's Level to View Examination Registrations";

echo"<td><select name=stlvl>";
	echo"<option value='1'>Currently Level 1000 Student</option>";
	echo"<option value='2'>Currently Level 2000 Student</option>";
	echo"<option value='3'>Currently Level 3000 Student</option>";
	echo"<option value='4'>Currently Level 4000 Student</option>";
	echo"<option value='0'>Recently Pass Out Student</option>";
	//echo"<option value='all'>All Repeate Student</option>";
echo"</select>";
echo"<td><input type=hidden name=crsem value=$crrseme> <input type=hidden name=cracy value=$acyart><input type=submit value='View Registrations'>";
 
echo"</tr></table></form><br>";




/////////////////////////////////////////////////////end  Student Exam Registration Detals////////////////////////////////////////////////





//////////////////////////////print exam attendent sheet/////////////////////////////////////////////////////////////////////////////////
echo"<h3>*** You have following subjects to check Examination Registrations ***</h3>"; 




	
if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
$queprtatt="select code, name,stream,medium from courseunit where availability=1 and (semister=$crrseme or semister=3) and by_low_version=$curriculum order by code,name";
                                                                    }
elseif(($role=="general")||($role=="office")){
$queprtatt="select code, name,stream,medium from courseunit where department='$dept_id'  and availability=1 and (semister=$crrseme or semister=3) and by_low_version=$curriculum order by code,name";
}
else{
$queprtatt="select code, name,stream,medium from courseunit where (coordinator='$rltduser' or lecturers LIKE '%[$rltduser]%') and availability=1 and (semister=$find_L or semister=3) and by_low_version=$curriculum order by code,name";
}






	
/*	
$queprtatt="select code, name, department, level from courseunit where (semister=$crrseme or semister=3) and availability=1 order by department,code,name";
}
else{
$dept=$_SESSION['section'];
$queprtatt="select code, name, department, level from courseunit where department='$dept' and (semister=$crrseme or semister=3) and availability=1 order by code,name";
}
*/
//echo$queprtatt;
$quprtatt=mysql_query($queprtatt);
echo"<table border=0><tr>";
echo"<th>#<th>Course Unit<th>Course Unit Name<th>Stream<th>Medium<th>View</tr>";
$eamrethb=1;
while($qprtatt=mysql_fetch_array($quprtatt)){
	$code=$qprtatt['code'];
   ////////////////////////////////////////////////////////////
                                $coursegetchr=trim($code);

                                $fulcode=strtoupper($coursegetchr);
                               
   ////////////////////////////////////////////////////////////////
    
    
    
	$coname=$qprtatt['name'];
	$codept=$qprtatt['department'];
	$colvl=$qprtatt['level'];
	
$stream=$qprtatt['stream'];
$medium=$qprtatt['medium'];  
	
if($medium!="SI+EN"){
		echo"<tr class=trbgc><form method=POST action='./forms/form_58.php'><td  align='center'>$eamrethb<td align='center'>".$fulcode;
			echo"<input type='hidden' name='prtcode' value=$code >";
			echo"<input type='hidden' name='prtcolvl' value=$colvl >";
			echo"<input type='hidden' name='prtcosem' value=$crrseme >";
			echo"<input type='hidden' name='prtcrtacy' value=$acyart ></td>";

		echo"<td>&nbsp;&nbsp; $coname<input type='hidden' name='prtconame' value='$coname'></td>";
		
		echo"<td align='center'>$stream<td align='center'>$medium";
		echo"<input type='hidden' name='prtcomdm' value='$medium'>";
		echo"<input type='hidden' name='prtcodept' value= $codept>";
		echo"<td align='center'><input type=submit name='subbutton' value='Student List'>";
		//echo"<input type=submit name='subbutton' value='Exam Attendance Sheet'>";
		

		echo"</tr></form>";	
}
else{
		echo"<tr class=trbgc><form method=POST action='./forms/form_58.php'><td  align='center'>$eamrethb<td align='center'>".$fulcode;
			echo"<input type='hidden' name='prtcode' value=$code >";
			echo"<input type='hidden' name='prtcolvl' value=$colvl >";
			echo"<input type='hidden' name='prtcosem' value=$crrseme >";
			echo"<input type='hidden' name='prtcrtacy' value=$acyart ></td>";

		echo"<td>&nbsp;&nbsp; $coname<input type='hidden' name='prtconame' value='$coname'></td>";
		
		echo"<td align='center'>$stream<td align='center'>$medium";
		echo"<input type='hidden' name='prtcomdm' value='$medium'>";
		echo"<input type='hidden' name='prtcodept' value= $codept>";
		
		
		
		echo"<td align='center'>";
		//echo"<input type=submit name='subbutton' value='Exam Attendance Sheet'>";
		echo"<table border=0>";
		echo"<tr class=selectbg height=25px><td><input type=submit name='subbutton' value='Student List for Sinhala'>";
		echo"<tr class=selectbg height=25px><td><input type=submit name='subbutton' value='Student List for English'>";
		echo"</table>";		

		echo"</tr></form>";	








	
}


$eamrethb++;
}

echo"</table>";

?>
















<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>
