<?php
//error_reporting(0);
session_start();
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
if($qpers['id']=="59"){
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
require_once('classes/globalClass.php');
$o59=new settings();

$crsem=$o59->getSemister();
$cracyea=$o59->getAcc();


$queexacyrnsem="select acc_year,semester from call_exam_registration";
$quexacyrnsem=mysql_query($queexacyrnsem);
while($qexacyrnsem=mysql_fetch_array($quexacyrnsem)){
	$pstexacyr=$qexacyrnsem['acc_year'];
	$pstexseme=$qexacyrnsem['semester'];
							}




echo"Medical Submission for Examinations";
echo"<hr class=bar>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// Add medical /////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

echo"<h3>*** Add Medical for one Student ***</h3>"; 
include'./forms/form_59.php';
if($task=="onest"){
if(isset($_POST['submit59'])){
	$_SESSION['stdno59']=$_POST['index59'];
	$_SESSION['stbtno59']=$_POST['year59'];
					}

$medstno=$_SESSION['stdno59'];
$medstbtno=$_SESSION['stbtno59'];


$bt59=$o59->getBatch($medstno);
$nm59=$o59->getName($medstno);
$level_st59=$o59->getLevel($medstno);



if($bt59!=$medstbtno){
echo"<br><font color='red'>Sorry ! SC/$medstbtno/$medstno is Invalid Student Number.</font><br>";
			}
else{
echo"<h3>Medical Submission for $nm59 ( SC/$medstbtno/$medstno ) </h3>";
////////////////////////////// due procedure////////////////////////////////////
$due=$_GET['due'];
$sdue=$_GET['sdue'];
///////////////////////// remove medi confermation//////////////////////////
if($due=="rmmed"){
//echo"remove";
$excoid=$_POST['medid'];

echo"<form method=POST action='./index.php?view=admin&admin=59&task=onest&due=confrmmed'>";
echo"<font color=red>Do you realy want to remove this medical ?</font><br>";
echo"<input type=submit name=cnfbtn value='Yes'><input type=submit name=cnfbtn value='No'><input type=hidden name=rmcnfexid value=$excoid></form>";
		}
///////////////////////// end remove medi confermation//////////////////////


///////////////////////// remove medi//////////////////////////
if($due=="confrmmed"){
$rmcnfexid=$_POST['rmcnfexid'];
$cnfbtn=$_POST['cnfbtn'];

if($cnfbtn=="Yes"){
//echo$rmcnfexid;
$quedelexmed="delete from exam_medical where med_id=$rmcnfexid";
mysql_query($quedelexmed);
echo"<font color=red>Medical Removed Successfully !</font><br><br>";

			}
}
///////////////////////// end remove medi /////////////////////



///////////////////////// add medi ////////////////////////////
if($due=="admed"){

$medcode=$_POST['medcode'];
$dismedcode=$_POST['dismedcode'];

$medacyear=$_POST['medacyear'];
$medsem=$_POST['medsem'];
$medconame=$_POST['medconame'];

if($sdue=="insmed"){
$dismedcode=$_POST['dismedcode'];
$disacyear=$_POST['disacyear'];
$dissemester=$_POST['dissemester'];
$disexmdate=$_POST['disexmdate'];
$disexmtime=$_POST['disexmtime'];
	$exdntm=$disexmdate."/".$disexmtime;

$dismedcetno=$_POST['dismedcetno'];
$discoverperdfrom=$_POST['discoverperdfrom'];
$discoverperdto=$_POST['discoverperdto'];
	$discoverperd="From ".$discoverperdfrom." To ".$discoverperdto;

$disissudate=$_POST['disissudate'];
$displace=$_POST['displace'];
$issudeby=$disissudate."/".$displace;

$dishndoverdate=$_POST['dishndoverdate'];
$discontact=$_POST['discontact'];

$crdat=date('Y-m-d');

$submdate=$dishndoverdate."/".$crdat;



$queinsexmed="insert into exam_medical(student,course,academic_year,semester,exam_date_time,med_certif_no,cover_period,issued_by,submit_date,contact_no,status) values ('$medstno','$dismedcode','$disacyear',$dissemester,'$exdntm','$dismedcetno','$discoverperd','$issudeby','$submdate','$discontact','In Progress')";
//echo$queinsexmed;
mysql_query($queinsexmed);
echo"<div align=right>[ <a href='./index.php?view=admin&admin=59&task=onest'>Back to Subject List</a> ]</div><br>";
echo"<font color=red>Medical Added Successfully !</font><br>";
$mdstnumber=$medstno;
include'./forms/form_59_v.php';

}






else{
echo"<div align=right>[ <a href='./index.php?view=admin&admin=59&task=onest'>Back to Subject List</a> ]</div><br>";

echo"<table border=1 cellspacing=0 width=100%><tr><td align='center'>";
echo"<font size=3px>Submission of Medical Certificates for Examinations</font>";
//echo$medcode.$medacyear.$medsem.$medconame;
echo"<form method=POST action='./index.php?view=admin&admin=59&task=onest&due=admed&sdue=insmed'>";
	echo"<table border=0 class=bgc>";
	echo"<tr><td align='left' width=30%>Name of the Subject <td align='left'>: $medconame ( $dismedcode )";
		echo"<input type=hidden name=dismedcode value=$medcode></tr>";

	echo"<tr><td align='left'>Acadamic Year<td align='left'>: $medacyear ";
		echo"<input type=hidden name=disacyear value=$medacyear></tr>";

	echo"<tr><td align='left'>Semester <td align='left'>: Semester  $medsem";
		echo"<input type=hidden name=dissemester value=$medsem>";

	echo"<tr><td align='left'>Date/Time of the Examination <td align='left'>: ";

		echo"<span id='date1'><input type='text' name='disexmdate' size='10'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Exam Date</font></span>";
		echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";


		echo" & Time is : ";
		echo"<span id='time1'><input type='text' name='disexmtime' size='6'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Exam Time</font></span>";
		echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";





	echo"<tr><td align='left'>Medical Certificate No <td align='left'>: ";
		echo"<span id='sprytextfield1'><input type='text' name='dismedcetno' size='20'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Medical Certificate No</font></span>";
		echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";



	echo"<tr><td align='left'>Period of Covered <td align='left'>: ";
		echo"From <span id='date4'><input type='text' name='discoverperdfrom' size='10'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Start Date</font></span>";
		echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";


		echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To <span id='date5'><input type='text' name='discoverperdto' size='10'><span class='textfieldRequiredMsg'><font size='-1'> Enter the End Date</font></span>";
		echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span></tr>";

	
	echo"<tr><td align='left'>Date and Place of the Medical Certificate Issued <td align='left'>: ";
		echo"<span id='date2'><input type='text' name='disissudate' size='10'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Issued Date</font></span>";
		echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";
		echo" & Place is : ";


		echo"<span id='sprytextfield2'><input type='text' name='displace' size='20'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Place of the Medical Certificate Issued</font></span>";
		echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";


	echo"<tr><td align='left'>Hand Over Date <td align='left'>: ";
		echo"<span id='date3'><input type='text' name='dishndoverdate' size='10'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Hand Over Date</font></span>";
		echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";

		echo" & Contact No : <input type=text name=discontact size=15>";

	echo"<tr><td align='center' colspan=2><input type=submit value='Submit'>";




	echo"$crdat</table><br>";

echo"</form>";

echo"</tr></table><br>";



}



		}
///////////////////////// end add medi ////////////////////////







////////////////////////////////////////////////////////////////////////////////

$quegtstexreg="select ex.id,ex.course,ex.degree,ex.confirm, c.name from exam_registration ex, courseunit c where ex.student='$medstno' and ex.acedemic_year='$pstexacyr' and ex.semester=$pstexseme and ex.course=c.code order by ex.course";
$qugtstexreg=mysql_query($quegtstexreg);
if(mysql_num_rows($qugtstexreg)==0){
echo"<font color='red'>Sorry ! Can not find Exam Registration Details of This Student .</font><br>";
					}
else{
echo"<table border=0><th>Course Unit<th>Name<th>Degree Status<th>Eligibility Status<th>Submit</th>";
while($qgtstexreg=mysql_fetch_array($qugtstexreg)){
		$exid=$qgtstexreg['id'];
		$excos=$qgtstexreg['course'];
	//////////////////////////////////////////////////////////////////////////////////////
		$course2=trim($excos);
				////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=$course2;
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

                                $temdiscos2=$ccdwoutcrd.$credit;
                            ////////////////////////////////////////////////////////////////////////////////////////
                                ////////////////////////////////////////////////////////
                                $getchar = preg_split('//', $temdiscos2, -1);

                                $midcredit=$getchar[5];
                                if($midcredit=="b"){
                                    $getlob=explode('b',$temdiscos2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode=strtoupper($fistprt)."b".$sectprt;
                                                        }

                                elseif($midcredit=="B"){
                                    $getlob=explode('B',$temdiscos2);
                                        $fistprt=$getlob[0];
                                        $sectprt=$getlob[1];
                                        $fulcode=strtoupper($fistprt)."b".$sectprt;
                                                        }
                                else{
                                $fulcode=strtoupper($temdiscos2);
                                }
                                ////////////////////////////////////////////////////
					$prtexcourse=$fulcode;
	//////////////////////////////////////////////////////////////////////////////////////

		$exdgst=$qgtstexreg['degree'];
		if($exdgst==1){
			$exdgst2="Degree";
				}
		else{
			$exdgst2="<font color=red>Non Degree</font>";
			}

		$excnfst=$qgtstexreg['confirm'];
		if($excnfst==1){
			$excnfst2="Eligible";		
				}
		elseif($excnfst==2){
			$excnfst2="<font color=red>Not Eligible</font>";	
					}
		else{
			$excnfst2="<font color=blue>Not Decide</font>";	
			}
	
		$excosnm=$qgtstexreg['name'];

		
	$quechkmed="select med_id from exam_medical where student='$medstno' and course='$course2' and academic_year='$pstexacyr' and semester=$pstexseme";
	//echo$quechkmed;
	$quchkmed=mysql_query($quechkmed);
	if(mysql_num_rows($quchkmed)==0){
		echo"<form method=POST action='./index.php?view=admin&admin=59&task=onest&due=admed'><tr class='trbgc'><td align='center'>$prtexcourse"; 

		echo"<input type=hidden name=medcode value=$course2>";
		echo"<input type=hidden name=dismedcode value=$prtexcourse>";
		echo"<input type=hidden name=medacyear value=$pstexacyr>";
		echo"<input type=hidden name=medsem value=$pstexseme>";

		echo"<td>".ucfirst($excosnm);
		echo"<input type=hidden name=medconame value='$excosnm'>";

		echo"<td align='center'>$exdgst2<td align='center'>$excnfst2<td align='center'><input type=submit value='Set Medical'></tr></form>";
					}
	else{
		$qchkmed=mysql_fetch_array($quchkmed);
			$chkmedid=$qchkmed['med_id'];
		echo"<form method=POST action='./index.php?view=admin&admin=59&task=onest&due=rmmed'><tr class='selectbg'><td align='center'>$prtexcourse<input type=hidden name=medid value=$chkmedid><td>".ucfirst($excosnm)."<td align='center'>$exdgst2<td align='center'>$excnfst2<td align='center'><input type=submit value='Remove Medical'></tr></form>";




		}






							}
echo"</table>";
	}



	}//bath match else closs




		}//task=onest if closs

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// enf Add medical /////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<hr class=bar>";






///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// view medical ////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<h3>*** View Examination Medical Certificates of one Student ***</h3>";

include'./forms/form_59_b.php';

if($task=="viewmed"){
$index59_view=$_POST['index59_view'];
$year59_view=$_POST['year59_view'];

$bt59_view=$o59->getBatch($index59_view);


if($year59_view!=$bt59_view){
	echo"<br><font color='red'>Sorry !,( SC/$year59_view/$index59_view ) is Invalid Student Number.</font><br>";

				}
else{
	
$mdstnumber=$index59_view;
include'./forms/form_59_v.php';



	}



			}//view med if close
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// end view medical ////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<hr class=bar>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////  view all medical ///////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"<h3>*** View All Examination Medical Certificates ***</h3>";
/////////////////////// view certificate///////////////////////////////////////////////
if($task=="viewallmed"){
	$gtalinonest=$_POST['chkalinonest'];
echo"<div align=right>[ <a href='./index.php?view=admin&admin=59'>Back to Student List</a> ]</div>";
	$mdstnumber=$gtalinonest;
	include'./forms/form_59_v.php';
			}
/////////////////////// view certificate///////////////////////////////////////////////









$quegtallmed="select distinct(student) from exam_medical order by student";
$qugtallmed=mysql_query($quegtallmed);
if(mysql_num_rows($qugtallmed)!=0){
$ai=1;
echo"<table border=0><th>No<th>Student No<th>Name with Initials<th>View</tr>";
	while($qgtallmed=mysql_fetch_array($qugtallmed)){
		$allmedst=$qgtallmed['student'];

			$allmedstbt=$o59->getBatch($allmedst);
			$allmednm=$o59->getName($allmedst);

			echo"<form method=POST action='./index.php?view=admin&admin=59&task=viewallmed'>";
			echo"<tr class=trbgc><td align=center>$ai<td align=center>SC/$allmedstbt/$allmedst<td>&nbsp;".strtoupper($allmednm)."<td align=center>";
				echo"<input type=hidden name=chkalinonest value='$allmedst'>";
				echo"<input type=submit value='Show Medical Certificates'>";
			echo"</tr></form>";

			$ai++;
								}
echo"</table>";
					}
else{

echo"<font color=red>Sorry! No Medical Certificates found in System</font>";
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////// end view all medical ////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>










<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>

