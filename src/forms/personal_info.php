<?php
session_start();
if(isset($_SESSION['login'])=="truefohssmis"){
?>


<style type="text/css">
@import url('../style/default.css');
</style>

<?php


$student=$_POST['student'];
$task=$_POST['task'];
//$view=$_GET['view'];
include '../admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

//...............get acc_year....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
$acyer=explode("_",$acy);
$acycur=$acyer[0];
$acynx=$acyer[1];

//.................................................	





//.............get student id and name from student table.....

$quepers="select * from student where id='$student'";
$qupers=mysql_query($quepers);
if(mysql_num_rows($qupers)!='0'){
while($qpers=mysql_fetch_array($qupers)){
$idn=$qpers['id'];
$lnm=$qpers['l_name'];
$inin=$qpers['initials'];
$bch=$qpers['batch'];
}
$fst="SC/".$bch."/".$idn;
$fnm=$lnm." ".$inin;
}
else{
$quepers2="select * from rumisdb.fohssmis where user='sc$student'";
//echo$quepers2;
$qupers2=mysql_query($quepers2);
while($qpers2=mysql_fetch_array($qupers2)){
$idn=$qpers2['user'];
$lnm=$qpers2['l_name'];
$inin=$qpers2['initials'];
$fst="SC/".$acycur."/".$student;
$fnm=$lnm." ".$inin;
}
}
/////////////////////////////////////////////////////////////
//..........get student details from student_personal_details..
$quepdata="select * from student_personal_detais where stno='$fst'";
$qupdata=mysql_query($quepdata);
if(mysql_num_rows($qupdata)=="0"){
$queinsdt="insert into student_personal_detais(stno,lname,initials) values('$fst','$lnm','$inin')";
$quinsdt=mysql_query($queinsdt);
}
else{
while($qpdata=mysql_fetch_array($qupdata)){
$nic=$qpdata['nic'];
$dob=$qpdata['dob'];
$gen=$qpdata['gender'];
$padd1=$qpdata['padd1'];
$padd2=$qpdata['padd2'];
$padd3=$qpdata['padd3'];
$padd4=$qpdata['padd4'];
$tadd1=$qpdata['tadd1'];
$tadd2=$qpdata['tadd2'];
$tadd3=$qpdata['tadd3'];
$tadd4=$qpdata['tadd4'];
$telih=$qpdata['tel_home'];
$telim=$qpdata['tel_mobile'];
$email=$qpdata['email'];
$cstat=$qpdata['cstatus'];
$weight=$qpdata['weight'];
$nation=$qpdata['nationality'];
$height=$qpdata['height'];
$distr=$qpdata['district'];
$relg=$qpdata['religion'];
$blgp=$qpdata['bloodgp'];
$scream=$qpdata['combinations'];
$gr_name=$qpdata['gr_name'];
					}
    }
$stu_dob = explode("-", $dob);
$styear=$stu_dob[0];
$stmon=$stu_dob[1];
$stdate=$stu_dob[2];


/////////////////////////////////////////////////////////////
echo"<div id='a'>";
if($task=="fill"){
echo"<table border='0' width='100%'><tr><td align='center' width='40px'>";
echo"<a href='../index.php?view=admin'><img border='0' src='../images/small/back.png' align='right'><br>Go Back</a></td>";
echo"<td align='center'><h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Personal Information</h2></td>"; 

echo"<td width='130px' align='center'><img border='0' src='../images/downps.png'><br>Download Survey Form</td></tr>";
echo"<tr><td colspan='2'>&nbsp;</td>";
echo"<td align='center'><a href='../downloads/Freshers-statistics-Science-2011Nov-english.pdf'>(English)</a>&nbsp;&nbsp;&nbsp;<a href='../downloads/Freshers-statistics-science-2011Nov-sinhala.pdf'>(Sinhala)</a>";
echo"</td></tr></table>";
echo"<table border='0' with='100%' align='center'>";
echo"<tr><td>Student No </td><td>: ";
echo$fst;
echo"</td></tr><tr><td>Name With Initials <td>";
echo": ".$fnm;
echo"</td></tr>";
echo"</table>";
echo"<div align='center'>(If your name appear wrong, please contact Dean's Office immediately.)</div>";


if($distr==""){
include'personal.php';
}
else{
	if($gr_name==""){
	echo"<font color='red' size='3px'><div align='center'>Your Personal Informations Are Incomplete! Please Complete Immediately. </div></font>";
	include'personalB.php';
			}
	else{
	echo"<font size='2px'><div align='center'>If you want to update your personal informations please proceed this page.</div></font>";
	include'personal.php';
	    }

}
}

echo"</div>";


?>






<?php
}
else{
echo "You Have Not Permission To Access This Area!";}
?>

