<?php
//error_reporting(0);
session_start();
if((isset($_SESSION['login'])=="truefohssmis")){
include'../connection/connection.php';

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from rumisdb.role where role='$role'";
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
if($qpers['id']=="48"){
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
<!--////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////-->
<?php



//////////////////remove this comment to procied exam registration prosses///////////////////////



$stno=$_SESSION['user_id'];
require_once('./classes/globalClass.php');
$n=new settings();

//...............get acc_year....................
$acyart=$n->getAcc();
//.................................................			

//...........get semester..........
$seme=$n->getSemister();
//.................................................	

//............get st level...........................
$stlvl=$n->getLevel($stno);
//..................................................

$task=$_GET['task'];
$exccode=$_POST['coscode'];
$exdgrest=$_POST['dgrest'];
$exrgid=$_POST['exregid'];

include './admin/config.php';
$con40=mysql_connect($host,$user,$pass) or die("Unable to connect Database");
mysql_select_db($db);

$stno=$_SESSION['user_id'];
$rept="nil";

$queeddt="select closing_date, status,semester,acc_year from call_exam_registration";
$queddt=mysql_query($queeddt);
while($qeddt=mysql_fetch_array($queddt)){
$clsdt=$qeddt['closing_date'];
$stat=$qeddt['status'];
$exac_year=$qeddt['acc_year'];
$exac_seme=$qeddt['semester'];

}


echo"Exam Registration Unit";
echo"<hr color='#ecc4f8'>";



////////////////////exam registration prosses////////////////////////
if($task=="exregis"){
error_reporting(0);
//echo$exccode.$exdgrest."<br>";
$ye=date('Y');
$queinsexreg="insert into exam_registration(student,course,acedemic_year,semester,degree,confirm,year) values('$stno','$exccode','$acyart',$seme,'$exdgrest',0,'$ye')";
//echo$queinsexreg;
mysql_query($queinsexreg);


}
////////////////////////////////////////////////////////////////////


/////////////////////exam subject registration calcel//////////////////////// 
if($task=="exregicancel"){
//echo$exrgid;
$quedelexreg="delete from exam_registration where id=$exrgid";
mysql_query($quedelexreg);
			}
////////////////////////////////////////////////////////////////////////////



echo"<br>Examination Registration for $exac_year Academic year and Semester $exac_seme<br>";

if($stat=="1"){

echo"Do Modification before :<font color='red'> $clsdt</font><br><br>	";





$querqexco="select r.course, r.degree, r.confirm, c.name from registration r, courseunit c where r.student='$stno' and r.acedemic_year='$acyart' and (r.semister=$seme or r.semister=3) and r.course=c.code and r.confirm=1";
$qurqexco=mysql_query($querqexco);

if(mysql_num_rows($qurqexco)!=0){
echo"<table border='0' ><tr>";
echo"<th>Courses Code</th><th>Courses Name</th><th>Degree Status</th><th>Current Status</th><th>Submit as</th></tr>";
while($qrqexco=mysql_fetch_array($qurqexco)){
$ccode2=$qrqexco['course'];

////////////////////////////////////////////////////////////////////////////////////////
			$coursegetchr=trim($ccode2);
			$ccdwoutcrd=substr("$coursegetchr", 0, -1);
			$getchar = preg_split('//', $coursegetchr, -1);

					$credit=$getchar[7];
					if(($credit=="a")||($credit=="A")){
						$credit="&#945;";
							}
					elseif(($credit=="b")||($credit=="B")){
						$credit="&#946;";
								}
					elseif(($credit=="d")||($credit=="D")){
						$credit="&#948;";
								}
					else{
						$credit=$credit;
						}

			$ccode3=strtoupper($ccdwoutcrd.$credit);
////////////////////////////////////////////////////////////////////////////////////////

$ccode=strtoupper($ccode2);
$cname=$qrqexco['name'];
$degre=$qrqexco['degree'];
if($degre==1){
$degre1="Degree";
}
else{
$degre1="Non Degree";
}
//$cnfm=$qrqexco['confirm'];

	$quechkexregi="select * from exam_registration where student='$stno' and course='$ccode'and acedemic_year='$acyart' and semester=$seme";
	$quchkexregi=mysql_query($quechkexregi);
	if(mysql_num_rows($quchkexregi)!=0){
		while($qchkexregi=mysql_fetch_array($quchkexregi)){
			$id=$qchkexregi['id'];
									}

	echo"<form method=POST action='./index.php?view=admin&admin=48&task=exregicancel'>";
	echo"<tr class=selectbg><td align='center'>$ccode3</td><td>".ucfirst($cname)."</td><td align='center'>$degre1</td>";
	echo"<td align='center'><font color=blue>Registered !</font></td>";
	echo"<td align='center'><input type=hidden name=exregid value=$id><input type=submit name=exregidel value=Cancel></td></tr>";
	echo"</form>";



						}
	else{
	echo"<form method=POST action='./index.php?view=admin&admin=48&task=exregis'>";
	echo"<tr class=trbgc><td align='center'>$ccode3<input type=hidden name=coscode value=$ccode></td><td>".ucfirst($cname)."</td><td align='center'>$degre1<input type=hidden name=dgrest value=$degre></td></td>";
	echo"<td align='center'><font color=red>Not Registered !</font></td>";
	echo"<td align='center'><input type=submit name=exregister value=Register></td></tr>";
	echo"</form>";
		}


}



echo"</table>";
	}//num of rows not zero
///////////////////////////////////////////////////////////////////////////
///////////for passout student/////////////////////////////////////////////
	else{

	//echo"You are passout Student!";
	

		}
//////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////


/////////////////////////repeate exam registration////////////////////////////////////

if($stlvl!=1){
echo"<hr color='#ecc4f8'>";
echo"Repeate Exam Registration Unit";
echo"<hr color='#ecc4f8'>";


if($stlvl!=0){

if($seme==1){
$quecoreg="select r.course, r.degree, c.name from registration r,courseunit c where r.student='$stno' and r.semister=1 and r.confirm=1 and r.acedemic_year<>'$acyart' and r.course=c.code order by r.acedemic_year,r.semister,r.course";
}
else{
$quecoreg="select r.course,r.degree,c.name from registration r,courseunit c where r.student='$stno' and (r.semister=2 or r.semister=3) and r.confirm=1 and r.acedemic_year<>'$acyart' and r.course=c.code order by r.acedemic_year,r.semister,r.course";
}
		}
else{
if($seme==1){
$quecoreg="select r.course, r.degree, c.name from registration r,courseunit c where r.student='$stno' and r.semister=1 and r.confirm=1 and r.course=c.code order by r.acedemic_year,r.semister,r.course";
}
else{
$quecoreg="select r.course,r.degree,c.name from registration r,courseunit c where r.student='$stno' and (r.semister=2 or r.semister=3) and r.confirm=1 and  r.course=c.code order by r.acedemic_year,r.semister,r.course";
}

}


//echo$quecoreg;



$qucoreg=mysql_query($quecoreg);
if(mysql_num_rows($qucoreg)!=0){

echo"<table border='0' ><tr>";
echo"<th>Courses Code</th><th>Courses Name</th><th>Degree Status</th><th>Current Status</th><th>Submit as</th></tr>";
$colum=0;
while($qcoreg=mysql_fetch_array($qucoreg)){
	$coreg2=$qcoreg['course'];
////////////////////////////////////////////////////////////////////////////////////////
			$coursegetchr=trim($coreg2);
			$ccdwoutcrd=substr("$coursegetchr", 0, -1);
			$getchar = preg_split('//', $coursegetchr, -1);

					$credit=$getchar[7];
					if(($credit=="a")||($credit=="A")){
						$credit="&#945;";
							}
					elseif(($credit=="b")||($credit=="B")){
						$credit="&#946;";
								}
					elseif(($credit=="d")||($credit=="D")){
						$credit="&#948;";
								}
					else{
						$credit=$credit;
						}

			$coreg3=strtoupper($ccdwoutcrd.$credit);
////////////////////////////////////////////////////////////////////////////////////////




	$coreg=strtoupper($coreg2);
	$cname=$qcoreg['name'];
	$status=$qcoreg['degree'];
	if($status==1){
		$dgstas="Degree";
			}
	else{
		$dgstas=" Non Degree";
		}

	//echo$coreg."--".$dgstas."===";
	
	$quegtreslt="select grade from results where index_number='$stno' and subject='$coreg'  order by id";
	$qugtreslt=mysql_query($quegtreslt);
	if(mysql_num_rows($qugtreslt)!=0){
	while($qgtreslt=mysql_fetch_array($qugtreslt)){
		$gtreslt=$qgtreslt['grade'];
							}
						}
	else{
		$gtreslt="ND";
		}

		//echo$gtreslt.".....";
			switch ($gtreslt){
				case "A+":
					//echo "4";
					$gpavl="4";
					break;
				case "A":
					//echo "4";
					$gpavl="4";
					break;
				case "A-":
					//echo "3.7";
					$gpavl="3.7";
					break;
				case "B+":
					//echo "3.3";
					$gpavl="3.3";
					break;
				case "B":
					//echo "3";
					$gpavl= "3";
					break;
				case "B-":
					//echo "2.7";
					$gpavl= "2.7";
					break;
				case "C+":
					//echo "2.3";
					$gpavl= "2.3";
					break;
				case "C":
					//echo "2";
					$gpavl= "2";
					break;
				case "C-":
					//echo "1.7";
					$gpavl= "1.7";
					break;
				case "D+":
					//echo "1.3";
					$gpavl= "1.3";
					break;
				case "D":
					//echo "1";
					$gpavl= "1";
					break;
				case "E":
					//echo "0";
					$gpavl="0";
					break;
				case "E*":
					//echo "0";
					$gpavl="0";
					break;
				case "Pass":
					//echo "2";
					$gpavl="2";
					break;
				    
				default:
					//echo "0";
					$gpavl= "0";
				}	//endswitch;
		//echo"$gpavl<br>";

					if($gpavl<2){
					
					$rept="yes";
					$colum=$colum+1;
					//echo$coreg."---".$dgstas."...".$gtreslt."==".$gpavl."<br>";
						$quechkexregi="select * from exam_registration where student='$stno' and course='$coreg'and acedemic_year='$acyart' and semester=$seme";
						$quchkexregi=mysql_query($quechkexregi);
						if(mysql_num_rows($quchkexregi)!=0){
							while($qchkexregi=mysql_fetch_array($quchkexregi)){
								$id=$qchkexregi['id'];
														}

						echo"<form method=POST action='./index.php?view=admin&admin=48&task=exregicancel'>";
						echo"<tr class=selectbg><td align='center'>$coreg3</td><td>".ucfirst($cname)."</td><td align='center'>$dgstas</td>";
						echo"<td align='center'><font color=blue>Registered !</font></td>";
						echo"<td align='center'><input type=hidden name=exregid value=$id><input type=submit name=exregidel value=Cancel></td></tr>";
						echo"</form>";



											}
						else{
						echo"<form method=POST action='./index.php?view=admin&admin=48&task=exregis'>";
						echo"<tr bgcolor='#e3cbb6'><td align='center'>$coreg3<input type=hidden name=coscode value=$coreg></td><td>".ucfirst($cname)."</td><td align='center'>$dgstas<input type=hidden name=dgrest value=$status></td></td>";
						echo"<td align='center'><font color=red>Not Registered !</font></td>";
						echo"<td align='center'><input type=submit name=exregister value=Register></td></tr>";
						echo"</form>";
							}


							}
					
				
						}//while
			if($colum==0){
			echo"<tr bgcolor='#e3cbb6'><td align='center' colspan=5>You have no repeate subject !</td></td>";
					}


echo"</table>";
					

	}//query if
else{
echo"<font color='red'>Sorry ! Can not find subject registration details.</font><br>";
	}





}

















//////////////////////////////////////////////////////////////////////////////////////

}//main if
else{

//echo"end closing date";

$quegtexreg="select er.course,er.degree,er.confirm,c.name from exam_registration er,courseunit c where er.student='$stno' and er.acedemic_year='$exac_year' and er.semester=$exac_seme and er.course=c.code";
$qugtexreg=mysql_query($quegtexreg);
if(mysql_num_rows($qugtexreg)!=0){
echo"<br><table border='0' ><tr>";
echo"<th>Courses Code</th><th>Courses Name</th><th>Degree Status</th><th>Confirmation</th></tr>";
	while($qgtexreg=mysql_fetch_array($qugtexreg)){
		$courseaf=$qgtexreg['course'];
////////////////////////////////////////////////////////////////////////////////////////
			$coursegetchr=trim($courseaf);
			$ccdwoutcrd=substr("$coursegetchr", 0, -1);
			$getchar = preg_split('//', $coursegetchr, -1);

					$credit=$getchar[7];
					if(($credit=="a")||($credit=="A")){
						$credit="&#945;";
							}
					elseif(($credit=="b")||($credit=="B")){
						$credit="&#946;";
								}
					elseif(($credit=="d")||($credit=="D")){
						$credit="&#948;";
								}
					else{
						$credit=$credit;
						}

			$afexregcourse=strtoupper($ccdwoutcrd.$credit);
////////////////////////////////////////////////////////////////////////////////////////

		$degree=$qgtexreg['degree'];
		if($degree==1){
			$degree1="Degree";
			}
			else{
			$degree1="<font color='red'>Non Degree</font>";
			}


		$confirm=$qgtexreg['confirm'];
		if($confirm==0){
			$confirm1="Not Decide";
				}
		elseif($confirm==2){
			$confirm1="<font color='red'>No Eligibility</font>";
			}
		else{
			$confirm1="<font color='Blue'>Confirmed</font>";

			}

		$excosname=$qgtexreg['name'];
		
echo"<tr class=trbgc><td align='center'>$afexregcourse</td><td>".ucfirst($excosname)."</td><td align='center'>$degree1</td><td align='center'>$confirm1</td></tr>";
							}
echo"</table>";

				}
else{

//if($rept=="yes"){
//echo"<br><font color='red'>You are not registered to repeat subject ! Contact Dean's Office immediately </font><br><br>";
//}
//else{
echo"<br><font color='red'>Sorry! You have not registered to the Examination.</font><br><br>";
//	}


}




}


?>










<?php
}
}	
else{

echo "You Have Not Permission To Access This Area!";}
?>

