<?php
error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){

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

if($qpers['id']=="95"){
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
$prntday=date("d");
$prntdasup=date("S");
$prntmntnyr=date("M Y");

require_once('../classes/globalClass.php');
$vr52f=new settings();

echo"<div id='c'>";

echo"<table border='0' width='100%'><tr><td align='left' valign='top'>";
echo"<form method='POST' action='../index.php?view=admin&admin=95'>";
echo"<input type='submit' value='Back' id='btnPrint'>";
echo"</form>";
echo"</td><td align='right' valign='top'>";
echo"Printed Date : ".$prntday."<sup>".$prntdasup."</sup> ".$prntmntnyr;
echo "<input type='button' id='btnPrint' onclick='window.print();' value='Print Page' /></td></tr></table>";

include'../admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);


$prtcode=$_POST['prtcode'];
//////////////////////////////////////////////////
$prtcode2=trim($prtcode);
$prtcode3=strtoupper($prtcode2);
////////////////////////////////////////////////////

if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)
   $bwsr='Internet explorer';
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false)
    $bwsr='Internet explorer';
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== false)
   $bwsr='Mozilla Firefox';
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)
   $bwsr='Google Chrome';
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false)
   $bwsr="Opera Mini";
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== false)
   $bwsr="Opera";
 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false)
   $bwsr="Safari";
 else
   $bwsr='Other';



//$thurty=array(84,128,172,216,260,304,347,392,440,490,540,585,630,675,720,765,810,855);
if($bwsr=="Google Chrome"){
	$fstpg=40;
	$thurty=array(84,128,172,216,260,304,347,390,433,476,519,562,605,648,691,734,777,820,863,903,947,991);
}
elseif($bwsr=="Mozilla Firefox"){
	$fstpg=36;
	$thurty=array(77,121,166,211,254,298,345,388,431,474,515,560,600,645,688,730,775,818,860,900,945,998);
}
else{
	$fstpg=35;
	$thurty=array(84,128,172,216,260,304,347,390,433,476,519,562,605,648,691,734,777,820,863,903,947,991);
}


//////////////////////////////////////////////////
$prtcodept2=$_POST['prtcodept'];

	$prtcodept=$vr52f-> getdeptname($prtcodept2);

$prtconame=$_POST['prtconame'];
$prtcolvl=$_POST['prtcolvl'];
$prtcosem=$_POST['prtcosem'];
$getprtcomdm=$_POST['prtcomdm'];
if($getprtcomdm=="SI"){
	$getcsmdmshw="Sinhala";
}
elseif($getprtcomdm=="EN"){
		$getcsmdmshw="English";
}
elseif($getprtcomdm=="TA"){
		$getcsmdmshw="Tamil";
}
elseif($getprtcomdm=="SI+EN"){
		$getassubbtn=$_POST['assubbtn'];

		if($getassubbtn=="Assignment Marks Sheet - Sinhala"){
			$getcsmdmshw="Sinhala";
			$getprtcomdm="SI";
		}
		elseif($getassubbtn=="Assignment Marks Sheet - English"){
			$getcsmdmshw="English";
			$getprtcomdm="EN";
		}	
		else{
			$getcsmdmshw="SI+EN";
			$getprtcomdm="SI+EN";
		}
		
}
else{
		$getcsmdmshw=$getprtcomdm;
}
//////////////////////////////////////////////////////////////////////////////
/////////////////////////////rm nx sem ///////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
/*if($prtcolvl!=1){
$prtcosem=2;
		}
else{
$prtcosem=1;
}*/
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
$prtcrtacy=$_POST['prtcrtacy'];


//echo"<table border='0' align='center' width='850px' cellspacing='0' cellpadding='0' bordercolor=#030000'><tr><td>";


/////////////////////...............................................////////////////////////////////////////////
	echo"<table border=0 align='center' width=95%><tr><td align='center' colspan=2><font size='3px'><b>Faculty of Humanities and Social Sciences</b></font></td></tr>";
	echo"<tr><td align='center' colspan=2><font size='3px'><b>Academic Year $prtcrtacy , Semester $prtcosem - Assignment Marks</b></font></td></tr>";
	echo"<tr><td align='center' colspan=2><font size='3px'><b>".ucfirst($prtcodept)."</b></font></td></tr>";
	echo"<tr><td align='left' width=70%><font size='3px'><b>Course Unit :</font></b><font size='3px'><b> ".$prtcode3."</b> ( $prtconame )</font></td><td align='center'>Medium : $getcsmdmshw</tr>";
	//echo"<tr><td><font size='3px'><b>Name of the lecturer : </b> ........................................... </td><td align='right'><b>Type : </b>........................</font></td></tr>";
	//echo"<tr><td><font size='3px'><b>Date : </b> .................... </td><td align='right'><b>Time : </b>........................</font></td></tr>";
	echo"<tr><td align='center' colspan=2>&nbsp;";
	echo"</table>";
/////////////////////...............................................////////////////////////////////////////////




	  //  echo"<table border=1 align='center' width=95% ><tr><td align='left' valign='top'>";////////////two td tbl




		echo"<table border=1 cellspacing='0' cellpadding='0' ><tr height=25px><td width=4% align='center'>NO<td width=16% align='center'>STUDENT NUMBER<td width=20% align='center'>NAME <br>WITH INITIALS";
		echo"<td width=12% align='center'>Marks for Assessment 1";
		echo"<td width=12% align='center'>Marks for Assessment 2";
		echo"<td width=12% align='center'>Marks for Assessment 3";
		echo"<td width=12% align='center'>Marks for Assessment 4";		
		echo"<td width=12% align='center'>Total Marks";		
		
		
///////////////////////////check reg on/off/////////////////////////////////
$queregst="select register from call_registration where level=$prtcolvl";
$quregst=mysql_query($queregst);
$qregst=mysql_fetch_array($quregst);
$regst=$qregst['register'];
//////////////////////////////////////////////////////////////////////////
  $fmviweque="$rmsdb.fohssmisStudents fs";
		if(($prtcolvl==1)&&($prtcosem==1)){
		///////////////////////////check reg on/off/////////////////////////////////
		$quecmbregst="select status from call_combination";
		$qucmbregst=mysql_query($quecmbregst);
		$qcmbregst=mysql_fetch_array($qucmbregst);
		$cmbregst=$qcmbregst['status'];
		//////////////////////////////////////////////////////////////////////////


			if($cmbregst==1){
                 $jonque="$rmsdb.fohssmis u";
                $queprtatn="select distinct r.student, u.l_name, u.initials from registration r, $jonque, $fmviweque where u.user=r.student and r.course ='$prtcode' and r.acedemic_year='$prtcrtacy' and r.student=fs.user_name order by u.user";
                
				$newst="yes";
				}
			else{
			$queprtatn="select distinct r.student, s.l_name, s.initials, s.batch from registration r, student s, $fmviweque  where s.id=r.student and r.course = '$prtcode' and r.acedemic_year='$prtcrtacy' and r.student=fs.user_name and r.confirm=1 order by r.student";
			       }
				}
		else{
			if($regst==1){
			$queprtatn="select distinct r.student, s.l_name, s.initials, s.batch from registration r, student s, $fmviweque where s.id=r.student and r.course = '$prtcode' and r.acedemic_year='$prtcrtacy' and r.student=fs.user_name and s.medium='$getprtcomdm' order by r.student";
				}
			else{
			$queprtatn="select distinct r.student, s.l_name, s.initials, s.batch from registration r, student s, $fmviweque where s.id=r.student and r.course = '$prtcode' and r.acedemic_year='$prtcrtacy' and r.student=fs.user_name and r.confirm=1 and s.medium='$getprtcomdm'  order by r.student";
			}

			}



		//echo$queprtatn;
		$quprtatn=mysql_query($queprtatn);
		$i=1;
		while($qprtatn=mysql_fetch_array($quprtatn)){
			$student=$qprtatn['student'];
			
			$stprmtnum=$vr52f->getStudentNumber($student); 
			if($stprmtnum==null){
				$fulstno="HS/$batch/$student";
			}
			else{
				$fulstno=$stprmtnum;
			}
			
			$batch=$qprtatn['batch'];
			$l_name=$qprtatn['l_name'];
			$initials=$qprtatn['initials'];


				echo"<tr height=30px><td align='center'>$i<td align='center'>$fulstno<td><font size=1px>&nbsp;&nbsp;$l_name<br>&nbsp;$initials</font>";
				echo"<td>&nbsp;";
				echo"<td>&nbsp;";				
				echo"<td>&nbsp;";				
				echo"<td>&nbsp;";				
				echo"<td>&nbsp;";				
				
				
				
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		if($i==$fstpg){
		echo"</table><br>";
		echo'<p style="page-break-before: always">';
		echo"<table border=1 cellspacing='0' cellpadding='0' ><tr height=25px><td width=4% align='center'>NO<td width=16% align='center'>STUDENT NUMBER<td width=20% align='center'>NAME <br>WITH INITIALS";
		echo"<td width=12% align='center'>Marks for Assessment 1";
		echo"<td width=12% align='center'>Marks for Assessment 2";
		echo"<td width=12% align='center'>Marks for Assessment 3";
		echo"<td width=12% align='center'>Marks for Assessment 4";		
		echo"<td width=12% align='center'>Total Marks";	


				}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		if(in_array($i, $thurty)){
		echo"</table><br>";

		echo'<p style="page-break-before: always">';

		echo"<table border=1 cellspacing='0' cellpadding='0' ><tr height=25px><td width=4% align='center'>NO<td width=16% align='center'>STUDENT NUMBER<td width=20% align='center'>NAME <br>WITH INITIALS";
		echo"<td width=12% align='center'>Marks for Assessment 1";
		echo"<td width=12% align='center'>Marks for Assessment 2";
		echo"<td width=12% align='center'>Marks for Assessment 3";
		echo"<td width=12% align='center'>Marks for Assessment 4";		
		echo"<td width=12% align='center'>Total Marks";	

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////

$i=$i+1;
echo"</p>";
	}//main while

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			/*$k=$i+5;
			for($j=$i;$j<$k;$j++){
				echo"<tr height=28px><td align='center'>$j<td>&nbsp;&nbsp;<td align='center'>&nbsp;<td>&nbsp;</tr>";
						}*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		echo"</table>";
//echo"</td></tr></table>";//////////2clm tbl

//echo"</td></tr></table>";
echo"</div>";
?>



<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}
else{

echo "You Have Not Permission To Access This Area!";}

?>

