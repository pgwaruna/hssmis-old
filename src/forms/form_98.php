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
    
if($qpers['id']=="98"){
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


<style type="text/css">
.upwit{
writing-mode: vertical-lr;
text-orientation: mixed;
transform: rotate(180deg);

}
</style>


<?php
echo"<div id='c'>";

echo"<table border='0' width='100%'><tr><td align='left' valign='top'>";
echo"<form method='POST' action='../index.php?view=admin&admin=98'>";
echo"<input type='submit' value='Back' id='btnPrint'>";
echo"</form>";
echo"</td><td align='right' valign='top'>";
echo "<input type='button' id='btnPrint' onclick='window.print();' value='Print Page' /></td></tr></table>";

include'../admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);





require_once('../classes/globalClass.php');
$vr98f=new settings();

$prtcode=$_POST['prtcode'];
/////////////////////////////////////////////////////
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


/*
$getshtdate=$_POST['shtdate'];
$getshttme=$_POST['shttme'];
$getshtcntr=$_POST['shtcntr'];
$getshtfstno=$_POST['shtfstno'];
$getshtlstno=$_POST['shtlstno'];
*/


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

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////// design start mrk sht////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//echo"<div align=center><font size=3px><b>".strtoupper("Examination Registarions")."<br> $prtcode2 ($prtconame) in $prtmdm Medium at $prtcrtacy Academic year and semester $prtcosem </b></font></div><br><br>";

$exmnm4mrksht="BA (General/Special ) degree $prtcolvl"."000 level semester $prtcosem examination $prtcrtacy academic year";

echo"<table border=0 width=98%  align=center>";
echo"<tr height=30px><td width=80% ><font size=4px><b>Marks Return Sheet : </B><td align=right><font size=3px><b>CONFIDENTIAL</b>";
echo"<tr height=30px><td><font size=3px><b>Marks and Grades obtained by the Candidates </b><td align=right>&nbsp;";

echo"</table>";



echo"<table border=0 width=98%  align=center>";
echo"<tr height=30px><td><font size=3px>$exmnm4mrksht";
echo"<tr height=30px><td><font size=3px>Course Code and Title : $prtcode2  -  $prtconame ( in $prtmdm Medium )";
echo"<tr height=30px><td align=justify>Absentees for Semester End Exam. marked as AB.";
echo"</table><br>";



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////// student list ////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*if(($getshtfstno==null)||($getshtlstno==null)){
$quegtexreg="select e.std_id,e.course_type,e.status,s.l_name, s.initials,s.batch from exam_registration e, student s where e.std_id=s.id and e.course_code='$prtcode' and e.academic_year='$prtcrtacy' and e.semester=$prtcosem and s.medium='$prtcomdm' order by e.std_id ";
}
else{
$getdvfstnum=explode("/",$getshtfstno);
	$dvfstnum="hs".$getdvfstnum[2];
	
$getdvlstnum=explode("/",$getshtlstno);
	$dvlstnum="hs".$getdvlstnum[2];	
	
$quegtexreg="select e.std_id,e.course_type,e.status,s.l_name, s.initials,s.batch from exam_registration e, student s where e.std_id BETWEEN '$dvfstnum' AND '$dvlstnum' and e.std_id=s.id and e.course_code='$prtcode' and e.academic_year='$prtcrtacy' and e.semester=$prtcosem and s.medium='$prtcomdm' order by e.std_id ";
	
}*/

$quegtexreg="select e.std_id,e.course_type,e.status,s.l_name, s.initials,s.batch from exam_registration e, student s where e.std_id=s.id and e.course_code='$prtcode' and e.academic_year='$prtcrtacy' and e.semester=$prtcosem and s.medium='$prtcomdm' order by e.std_id ";

//echo$quegtexreg;
$qugtexreg=mysql_query($quegtexreg);

if(mysql_num_rows($qugtexreg)==0){
echo"<p align=center><font color=red size=3px>Sorry ! There are no registered student to this course unit for examination.</font></p><br>";

				}

else{
$i=1;
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<table border=1 align=center cellspacing=0 cellspadding=0 width=98%><tr height=30px align=center>";
echo"<td rowspan=2 width=3%>S.NO<br>(1)";
echo"<td rowspan=2 width=12%>INDEX NO<br>(2)";
echo"<td rowspan=2 width=5% ><div class=upwit>(3)<br>ATTENDANCE</div>";
echo"<td colspan=3>Semester End";

echo"<td rowspan=2 width=5% ><div  class=upwit> (7)<br>Continous Assignment 1</div>";
echo"<td rowspan=2 width=5%> <div class=upwit > (8)<br>Continous Assignment 2</div> ";
echo"<td rowspan=2 width=5%> <div class=upwit > (9)<br>Continous Assignment 3</div> ";
echo"<td rowspan=2 width=5%> <div class=upwit > (10)<br>Continous Assignment 4</div> ";
echo"<td rowspan=2 width=8%>Total<br>(11)<br>{(6)+(7)+(8)+(9)+(10)}";
echo"<td rowspan=2 width=8%>Result / Grade (12)";
echo"<td rowspan=2 width=8%>G.P.V<br>(13)";
echo"<td rowspan=2 width=8%>Remarks<br>(14)";

echo"<tr align=center><td width=5%><div class=upwit> (4)<br>1<sup>st</sup> Marking</div>";
echo"<td width=5%><div class=upwit > (5)<br>2<sup>nd</sup> Marking</div>";
echo"<td width=5%><div class=upwit > (6)<br>Average Marks</div>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////









while($qgtexreg=mysql_fetch_array($qugtexreg)){
		$student=$qgtexreg['std_id'];
		$batch=$qgtexreg['batch'];
			$stprmtnum=$vr98f->getStudentNumber($student); 
			if($stprmtnum==null){
				$fulstno="HS/$batch/$student";
			}
			else{
				$fulstno=$stprmtnum;
			}


    $confirm=$qgtexreg['status'];

    if($confirm==2){
        $confirm2="NE";
    }
    else{
        $confirm2=null;
    }
	/*	
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
	*/
echo"<tr height=25px><td align=center>$i<td align=center>$fulstno";
echo"<td>&nbsp;&nbsp;$confirm2";
echo"<td>&nbsp;";
echo"<td>&nbsp;";
echo"<td>&nbsp;";
echo"<td>&nbsp;";
echo"<td>&nbsp;";
echo"<td>&nbsp;";
echo"<td>&nbsp;";
echo"<td>&nbsp;";
echo"<td>&nbsp;";
echo"<td>&nbsp;";
echo"<td>&nbsp;";
$i++;

if($i==31){
$j=1;	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"</table><br><br><table border=0 width=98%  align=center>";
echo"<tr height=30px>";
echo"<td width=25%><font size=3px>Coordinator/First Examiner <td width=35%>Name:................................................
<td width=25%>Sign:................................................<td width=15%>Date:...................";

echo"<tr height=30px>";
echo"<td width=25%><font size=3px>Second Examiner <td width=35%>Name:................................................
<td width=25%>Sign:................................................<td width=15%>Date:...................";


echo"<tr height=30px>";
echo"<td width=25%><font size=3px>Head of the Department <td width=35%>Name:................................................
<td width=25%>Sign:................................................<td width=15%>Date:...................";
echo"</table>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



echo'<p style="page-break-before: always">';


/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<br><table border=1 align=center cellspacing=0 cellspadding=0 width=98%><tr height=30px align=center>";
echo"<td rowspan=2 width=3%>S.NO<br>(1)";
echo"<td rowspan=2 width=12%>INDEX NO<br>(2)";

echo"<td colspan=3>Semester End";

echo"<td rowspan=2 width=5% ><div  class=upwit> (6)<br>Continous Assignment 1</div>";
echo"<td rowspan=2 width=5%> <div class=upwit > (7)<br>Continous Assignment 2</div> ";
echo"<td rowspan=2 width=5%> <div class=upwit > (8)<br>Continous Assignment 3</div> ";
echo"<td rowspan=2 width=5%> <div class=upwit > (9)<br>Continous Assignment 4</div> ";
echo"<td rowspan=2 width=8%>Total<br>(10)<br>{(5)+(6)+(7)+(8)+(9)}";
echo"<td rowspan=2 width=8%>Result / Grade (11)";
echo"<td rowspan=2 width=8%>G.P.V<br>(12)";
echo"<td rowspan=2 width=8%>Remarks<br>(13)";

echo"<tr align=center><td width=5%><div class=upwit> (3)<br>1<sup>st</sup> Marking</div>";
echo"<td width=5%><div class=upwit > (4)<br>2<sup>nd</sup> Marking</div>";
echo"<td width=5%><div class=upwit > (5)<br>Average Marks</div>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

}
$trty5md=$j%40;
if(($trty5md==0)&&($i>41)){
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"</table><br><br><table border=0 width=98%  align=center>";
echo"<tr height=30px>";
echo"<td width=25%><font size=3px>Coordinator/First Examiner <td width=35%>Name:................................................
<td width=25%>Sign:................................................<td width=15%>Date:...................";

echo"<tr height=30px>";
echo"<td width=25%><font size=3px>Second Examiner <td width=35%>Name:................................................
<td width=25%>Sign:................................................<td width=15%>Date:...................";


echo"<tr height=30px>";
echo"<td width=25%><font size=3px>Head of the Department <td width=35%>Name:................................................
<td width=25%>Sign:................................................<td width=15%>Date:...................";
echo"</table>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo'<p style="page-break-before: always">';
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<br><table border=1 align=center cellspacing=0 cellspadding=0 width=98%><tr height=30px align=center>";
echo"<td rowspan=2 width=3%>S.NO<br>(1)";
echo"<td rowspan=2 width=12%>INDEX NO<br>(2)";

echo"<td colspan=3>Semester End";

echo"<td rowspan=2 width=5% ><div  class=upwit> (6)<br>Continous Assignment 1</div>";
echo"<td rowspan=2 width=5%> <div class=upwit > (7)<br>Continous Assignment 2</div> ";
echo"<td rowspan=2 width=5%> <div class=upwit > (8)<br>Continous Assignment 3</div> ";
echo"<td rowspan=2 width=5%> <div class=upwit > (9)<br>Continous Assignment 4</div> ";
echo"<td rowspan=2 width=8%>Total<br>(10)<br>{(5)+(6)+(7)+(8)+(9)}";
echo"<td rowspan=2 width=8%>Result / Grade (11)";
echo"<td rowspan=2 width=8%>G.P.V<br>(12)";
echo"<td rowspan=2 width=8%>Remarks<br>(13)";

echo"<tr align=center><td width=5%><div class=upwit> (3)<br>1<sup>st</sup> Marking</div>";
echo"<td width=5%><div class=upwit > (4)<br>2<sup>nd</sup> Marking</div>";
echo"<td width=5%><div class=upwit > (5)<br>Average Marks</div>";
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
}


$j++;

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

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<br><br><table border=0 width=98%  align=center>";
echo"<tr height=30px>";
echo"<td width=25%><font size=3px>Coordinator/First Examiner <td width=35%>Name:................................................
<td width=25%>Sign:................................................<td width=15%>Date:...................";

echo"<tr height=30px>";
echo"<td width=25%><font size=3px>Second Examiner <td width=35%>Name:................................................
<td width=25%>Sign:................................................<td width=15%>Date:...................";


echo"<tr height=30px>";
echo"<td width=25%><font size=3px>Head of the Department <td width=35%>Name:................................................
<td width=25%>Sign:................................................<td width=15%>Date:...................";
echo"</table>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
























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

