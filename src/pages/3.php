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
echo$qpers['role_id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="3"){
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
include'./admin/config.php';

echo "Confirm Course Registration of Students <hr class=bar><br>";
						
echo 'PRINTABLE VERSION OF COURSE REGISTRATION<br><br>';
include 'forms/form_3_2a.php';			

echo '<hr class="bar">';
			
						
									
echo "<br>Manage Course  Registration of Single Student<br><br>";
include 'forms/form_3.php';

//////////////edit by iranga ////////////////////////////////////////////////////
require_once('./classes/globalClass.php');
$vr3=new settings();
/////////////////////////////////////////////////////////////////////////////////	
						
// Remove Registration
						
if($task=='confirm'){ 
$id=$_GET['id'];

$student_3_2=$_SESSION['std_3'];
$query_3_4="update registration set confirm=1 where id='$id' and student='$student_3_2'";
$confirm_3=mysql_query($query_3_4);
//unset($_SESSION['std_3']);

}
						
						
// Display Registration
						
if(($task=='confirm')&&(isset($_POST['submit']))){
$student_3="hs".$_POST['student_3'];
$_SESSION['std_3']=$student_3;
}


$student_3_3=$_SESSION['std_3'];
////////////////////////////get ac year//////////////////////////
$queacyear="select acedemic_year from acc_year where current=1";
$quacyear=mysql_query($queacyear);
$qacyear=mysql_fetch_array($quacyear);
$acyear=$qacyear['acedemic_year'];
/////////////////////////////////////////////////////////////////

///////////////get semester//////////////////////////////////////
$queseme="select DISTINCT semister from level";
$quseme=mysql_query($queseme);
$qseme=mysql_fetch_array($quseme);
$seme=$qseme['semister'];
//////////////////////////////////////////////////////////////////

if($task=="confirm"){
$query3_2="select r.id, r.course, r.confirm, r.degree, c.name from registration r, courseunit c where r.acedemic_year='$acyear' and (r.semister=$seme or r.semister=3) and r.course=c.code and r.student='$student_3_3'";

//echo$query3_2;
$reg_once=mysql_query($query3_2);
if(mysql_num_rows($reg_once)!=0){
echo "<br>Course Units Registration for ".$acyear." Acedemic year and semester $seme <br><br>";
echo '<table border="0" ><tr><th>Courses Code<th>Courses Name<th>Degree Status<th>Confirmation<th>Submit</tr>';
while($data=mysql_fetch_array($reg_once)){
echo "<tr class=trbgc><td align=center>".strtoupper($data['course'])."<td>".$data['name'];
echo"<td>";
$cnfdgstt4solo=$data['degree'];
if($cnfdgstt4solo=="Non Degree"){
	echo"None Degree Course-(6)";
}
else{
	$course_select4solo=$data['course'];
		$alldgst4cnf4solo=$vr3->getcostype($course_select4solo,$student_3_3);	
		echo$alldgst4cnf4solo;
}



if($data['confirm']==1){
      echo"<td align=center colspan=2>";
        echo"Confirmed";
}
else{
    echo"<td align=center>";
    echo"Not Confirmed";
    echo"<td align=center>";
    echo "<a href=?view=admin&admin=3&task=confirm&id=".$data['id'].">Confirm</a></tr>";
}




}
echo "</table>";
}

								}

echo '<hr class="bar">';
?>





<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>

