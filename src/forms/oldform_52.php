<?php
session_start();
if(isset($_SESSION['login'])=="truefohssmis"){
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
@import url('../style/default.css');
</style>


<?php
echo"<div id='c'>";

echo"<table border='0' width='100%'><tr><td align='left' valign='top'>";
echo"<form method='POST' action='../index.php?view=admin&admin=52'>";
echo"<input type='submit' value='Back' id='btnPrint'>";
echo"</form>";
echo"</td><td align='right' valign='top'>";
echo "<input type='button' id='btnPrint' onclick='window.print();' value='Print Page' /></td></tr></table>";

include'../admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);


$prtcode=$_POST['prtcode'];
//////////////////////////////////////////////////
$ccdwoutcrd=substr("$prtcode", 0, -1);

$getchar = preg_split('//', $prtcode, -1);

$credit=$getchar[7];
if($credit=="a"){
	$credit="&#945;";
		}
elseif($credit=="b"){
	$credit="&#946;";
			}
elseif($credit=="d"){
	$credit="&#948;";
			}
else{
	$credit=$credit;
	}

$prtcode2=$ccdwoutcrd.$credit;




$thurty=array(60,128,196,264,372);
$thurty2=array(94,162,228,296,364);




//////////////////////////////////////////////////
$prtcodept=$_POST['prtcodept'];
$prtconame=$_POST['prtconame'];
$prtcolvl=$_POST['prtcolvl'];
$prtcosem=$_POST['prtcosem'];
$prtcrtacy=$_POST['prtcrtacy'];


//echo"<table border='0' align='center' width='850px' cellspacing='0' cellpadding='0' bordercolor=#030000'><tr><td>";


/////////////////////...............................................////////////////////////////////////////////
	echo"<table border=0 align='center' width=80%><tr><td align='center' colspan=2><font size='3px'><b>Attendance Register - Level $prtcolvl and Semester $prtcosem of $prtcrtacy Academic Year</b></font></td></tr>";
	echo"<tr><td align='center' colspan=2><font size='3px'><b>Department of ".ucfirst($prtcodept)."</b></font></td></tr>";
	echo"<tr><td align='center' width=50% colspan=2><font size='3px'><b>Course Unit </font></b><font size='3px'><b>- ".strtoupper($prtcode2)."</b> ( $prtconame )</font></td></tr>";
	echo"<tr><td><font size='3px'><b>Name of Lecturer : </b> ........................................... </td><td align='right'><b>Type : </b>........................</font></td></tr>";
	echo"<tr><td><font size='3px'><b>Date : </b> .................... </td><td align='right'><b>Time : </b>........................</font></td></tr>";

	echo"</table>";
/////////////////////...............................................////////////////////////////////////////////




	    echo"<table border=0 align='center' width=95% ><tr><td align='left' valign='top'>";////////////two td tbl




		echo"<table border=1 cellspacing='0' cellpadding='0' ><tr height=22px><td width=5% align='center'>NO<td width=30%   align='center'>NAME <br>WITH INITIALS<td width=17% align='center'>STUDENT NUMBER<td width=30% align='center'>SIGNATURE</tr>";

///////////////////////////check reg on/off/////////////////////////////////			
$queregst="select register from call_registration";
$quregst=mysql_query($queregst);
$qregst=mysql_fetch_array($quregst);
$regst=$qregst['register'];
//////////////////////////////////////////////////////////////////////////
		if(($prtcolvl==1)&&($prtcosem==1)){
        ///////////////////////////check reg on/off/////////////////////////////////            
        $quecmbregst="select status from call_combination";
        $qucmbregst=mysql_query($quecmbregst);
        $qcmbregst=mysql_fetch_array($qucmbregst);
        $cmbregst=$qcmbregst['status'];
        //////////////////////////////////////////////////////////////////////////

            if($cmbregst==1){
            $queprtatn="select distinct r.student, u.l_name, u.initials from registration r, rumisdb.fohssmis u where u.user=r.student and r.course = '$prtcode' and r.acedemic_year='$prtcrtacy' order by u.user";
                $newst="yes";
              
                }
            else{
            $queprtatn="select distinct r.student, s.l_name, s.initials, s.batch from registration r, student s where s.id=r.student and r.course = '$prtcode' and r.acedemic_year='$prtcrtacy' and r.confirm=1 order by r.student";
            }
                }
        else{
		if($regst==1){
		$queprtatn="select distinct r.student, s.l_name, s.initials, s.batch from registration r, student s where s.id=r.student and r.course = '$prtcode' and r.acedemic_year='$prtcrtacy' order by r.student";
				}
		else{
		$queprtatn="select distinct r.student, s.l_name, s.initials, s.batch from registration r, student s where s.id=r.student and r.course = '$prtcode' and r.acedemic_year='$prtcrtacy' and r.confirm=1 order by r.student";
			}
        }
		//echo$queprtatn;
		$quprtatn=mysql_query($queprtatn);
		$i=1;
		while($qprtatn=mysql_fetch_array($quprtatn)){
			$student=$qprtatn['student'];
			$batch=$qprtatn['batch'];
			$l_name=$qprtatn['l_name'];
			$initials=$qprtatn['initials'];

				echo"<tr height=28px><td align='center'>$i<td>&nbsp;&nbsp;$l_name<br>&nbsp;$initials<td align='center'>&nbsp;SC/$batch/$student<td>&nbsp;</tr>";
								
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////				
		if($i==30){
		
			echo"</table></td><td>&nbsp;&nbsp;&nbsp;</td><td align='right' valign='top'>";

		echo"<table border=1 cellspacing='0' cellpadding='0' ><tr height=22px><td width=5% align='center'>NO<td width=30% align='center'>NAME<br> WITH INITIALS<td width=17% align='center'>STUDENT NUMBER<td width=30% align='center'>SIGNATURE</tr>";
				


				}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		if(in_array($i, $thurty)){

echo"</table></td></tr></table>";
echo'<p style="page-break-after: always">';
 echo"<table border=0 align='center' width=95% ><tr><td align='left' valign='top'>";////////////two td tbl
echo"<tr><td align='left' valign='top'>";

echo"<table border=1 cellspacing='0' cellpadding='0' ><tr height=22px><td width=5% align='center'>NO<td width=30% align='center'>NAME<br> WITH INITIALS<td width=17% align='center'>STUDENT NUMBER<td width=30% align='center'>SIGNATURE</tr>";
				}		
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

		if(in_array($i, $thurty2)){

echo"</table></td><td>&nbsp;&nbsp;&nbsp;</td><td align='right' valign='top'>";

echo"<table border=1 cellspacing='0' cellpadding='0' ><tr height=22px><td width=5% align='center'>NO<td width=30% align='center'>NAME<br> WITH INITIALS<td width=17% align='center'>STUDENT NUMBER<td width=30% align='center'>SIGNATURE</tr>";

				}

///////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

$i=$i+1;
echo"</p>";			
	}//main while

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$k=$i+5;
			for($j=$i;$j<$k;$j++){
				echo"<tr height=28px><td align='center'>$j<td>&nbsp;&nbsp;<td align='center'>&nbsp;<td>&nbsp;</tr>";
						}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		echo"</table>";
echo"</td></tr></table>";
		
//echo"</td></tr></table>";
echo"</div>";
?>



<?php

}	
else{

echo "You Have Not Permission To Access This Area!";}

?>

