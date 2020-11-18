<?php
//error_reporting(0);
session_start();
if((isset($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){

include'../connection/connection.php';

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

$quepers="SELECT id FROM permission WHERE role_id=$roleid";
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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
@media print {
input#btnPrint {
display: none;
}
}
</style>
<style type="text/css">
@import url('../css/blackfont.css');
</style>



<?php
echo"<div id='c'>";

echo"<table border='0' width='100%'><tr><td align='left' valign='top'>";
echo"<form method='POST' action='../index.php?view=admin&admin=58'>";
echo"<input type='submit' value='Back' id='btnPrint'>";
echo"</form>";
echo"</td><td align='right' valign='top'>";
echo "<input type='button' id='btnPrint' onclick='window.print();' value='Print Page' /></td></tr></table>";

include'../admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);





require_once('../classes/globalClass.php');
$vr58f=new settings();

$prtcode=$_POST['prtcode'];
//////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($prtcode);

                                $fulcode=strtoupper($coursegetchr);
                                
                                ////////////////////////////////////////////////////
$prtcode2=$fulcode;
$prtcodept=$_POST['prtcodept'];
$prtconame=$_POST['prtconame'];
$prtcolvl=$_POST['prtcolvl'];
$prtcosem=$_POST['prtcosem'];
$prtcomdm=$_POST['prtcomdm'];
$prtcrtacy=$_POST['prtcrtacy'];
$submitbtt=$_POST['subbutton'];

if($prtcomdm=="SI+EN"){
	$divsbbtnm=explode(" ",$submitbtt);
	$prtmdm=$divsbbtnm[3];
	if($prtmdm=="English"){
		$prtcomdm="EN";
	}
	else{
		$prtcomdm="SI";
	}
}
else{
	if($prtcomdm=="SI"){
		$prtmdm="Sinhala";
	}
	elseif($prtcomdm=="EN"){
		$prtmdm="English";
	}
	elseif($prtcomdm=="TA"){
		$prtmdm="Tamil";
	}
	else{
		$prtmdm=$prtcomdm;
	}
	
}


//echo$prtcode2.$prtconame.$prtcodept.$prtcolvl.$prtcosem.$prtcrtacy.$submitbtt;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////// student list ////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

echo"<div align=center><font size=3px><b>".strtoupper("Examination Registarions")."<br> $prtcode2 ($prtconame) in $prtmdm Medium at $prtcrtacy Academic year and semester $prtcosem </b></font></div><br><br>";




$quegtexreg="select e.std_id,e.course_type,e.status,s.l_name, s.initials,s.batch from exam_registration e, student s where e.std_id=s.id and e.course_code='$prtcode' and e.academic_year='$prtcrtacy' and e.semester=$prtcosem and s.medium='$prtcomdm' order by e.std_id ";
//echo$quegtexreg;
$qugtexreg=mysql_query($quegtexreg);

if(mysql_num_rows($qugtexreg)==0){
echo"<p align=center><font color=red size=3px>Sorry ! There are no registered student to this course unit for examination.</font></p><br>";

				}

else{
echo"<table border=0 align=center><tr height=30px class=selectbg><th>No<th>Student Number<th> Name with Initials<th>Degree Status<th>Eligible Status";
$i=1;

while($qgtexreg=mysql_fetch_array($qugtexreg)){
		$student=$qgtexreg['std_id'];
		$batch=$qgtexreg['batch'];
			$stprmtnum=$vr58f->getStudentNumber($student); 
			if($stprmtnum==null){
				$fulstno="HS/$batch/$student";
			}
			else{
				$fulstno=$stprmtnum;
			}		
		
		
		
		$degree=$qgtexreg['course_type'];

		$confirm=$qgtexreg['status'];
			if($confirm==1){
				$confirm2="Eligible";

					}
			elseif($confirm==2){
				$confirm2="Not Eligible";
				}
			else{
				$confirm2="Not Confirmed";	
				}
				
			$l_name=$qgtexreg['l_name'];
			$initials=$qgtexreg['initials'];
			
			$name=strtoupper($initials)." ".strtoupper($l_name);

echo"<tr class=trbgc height=20px><td align=center>$i<td align=center>$fulstno<td>$name<td align=center>$degree<td align=center>$confirm2</tr>";

$i++;

						}// student listmain while closs
echo"</table><br>";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////// end student list ////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<div>";
?>



<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>

