<?php
session_start();
error_reporting(0);
//include '../connection/connection.php';






$piusername=$stnum;
$_SESSION['stpicnm']=$stnum;

//////////////////////////get all details from fofmstmisstudent view//////////////////////////////////////

$quepersonal="SELECT * FROM $rmsdb.fohssmisStudents WHERE user_name='$piusername'";
//echo$quepersonal;
$qupersonal=mysql_query($quepersonal);

if(mysql_num_rows($qupersonal)==0){
	echo"<br><div align=center><font color=red> Sorry! cannot find student full information</font></div><br>";
									}
									
else{
while($qpersonal=mysql_fetch_array($qupersonal)){
	$fname=$qpersonal['Initials'];/////
	$lname=$qpersonal['LastName'];//////
	$nic=$qpersonal['NIC'];///////////
	$alindex=$qpersonal['ALIndexNo'];//////////////////////
	$fullname=$qpersonal['NameinFull'];	/////////////////////
	$title=$qpersonal['Title'];
	$add1=$qpersonal['Address1'];///////////////////
	$add2=$qpersonal['Address2'];///////////////////////////////
	$add3=$qpersonal['Address3'];//////////////////////////////////
	$add4=$qpersonal['Address4'];/////////////////////////////
	$dob=$qpersonal['DOB'];///////////////
	$gender=$qpersonal['Gender'];//////////////
	$religion=$qpersonal['Religion'];///////////////
	$race=$qpersonal['Race'];//////////////
	$zscore=$qpersonal['ZScore'];///////////////////
	$medium=$qpersonal['Medium'];///////////////////////
	$cno=$qpersonal['ContactNo'];/////////////////
	$email=$qpersonal['Email'];//////////////////
	$province=$qpersonal['Province'];/////////////////
	$district=$qpersonal['District'];//////////////////////
	$citizenShip=$qpersonal['CitizenShip'];//////////////////////
	$iname=$qpersonal['EmergancyCaseInformaerName'];///////////////
	$iaddress=$qpersonal['InformaerAddress'];///////////////////
	$icontactNo=$qpersonal['InformaerContactNo'];///////////////////
	$mothername=$qpersonal['NameOfMother'];///////////////
	$moccupation=$qpersonal['MotherOccupation'];///////////////////
	$fathername=$qpersonal['NameofFather'];/////
	$foccupation=$qpersonal['FatherOccupation'];/////////////
	$bgroup=$qpersonal['BloodGroup'];/////////////
	$albatch=$qpersonal['ALBatch'];//////////
	$pnohome=$qpersonal['TelephomeNumberHome'];////////////////////
	$School=$qpersonal['School'];////////////////
	$registerBatch=$qpersonal['RegisterBatch'];
	$event=$qpersonal['Event'];///////////
	$pstdno=$qpersonal['PermanentNumber'];/////////
	$batch=$qpersonal['Batch'];/////
	
	
$oripicname="../../rumis/picture/user_pictures/student_std_pics/fohssmis_pic/".$_SESSION['stpicnm'].".jpg";

    
       if(file_exists($oripicname)){
            $picname=$oripicname;
                                }
        else{
         $picname="../images/std_pics/SCI_Fac_no_picture.png";
                                }

		}
}
////////////////////////////////////////////////end get all details from fofmstmisstudent/////////////////////////////////////////////////////

///////////////////get level from level table/////////////////////////////////////////////////////////////////////////////////////////////////

$quelevel="SELECT l.level,s.stream FROM level l,student s WHERE s.id='$piusername' and s.year=l.year";
$qulevel=mysql_query($quelevel);

if(mysql_num_rows($qulevel)==0){
	echo"<font color=red> Sorry! cannot find student level</font>";
									}
									
else{
	while($qlevel=mysql_fetch_array($qulevel)){
	$slevel=$qlevel['level'];
	$sstream=$qlevel['stream'];
												}
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//echo"<h3 align='center'>Student's Information</h3>";
echo"<table border='1' align='center' cellspacing='0' height=650px>";
//echo"<image src='$picname' class='stretch' alt='' width=100px height=110px>";
echo"<tr class=trbgc><td rowspan='5' align=center class=select><image src='$picname' alt='' width=100px ></td><td colspan='3' align='center' class=select>".strtoupper($fname)."&nbsp;".strtoupper($lname)."</td></tr>";
echo"<tr class=trbgc><td class=select>Level</td><td colspan='2'> $slevel"."000</td></tr>";
echo"<tr class=trbgc><td class=select>Student Number</td><td colspan='2'>$pstdno</td></tr>";
echo"<tr class=trbgc><td class=select>Batch</td><td colspan='2'>$batch</td></tr>";
echo"<tr class=trbgc><td class=select>Event</td><td colspan='2'>$event</td></tr>";
echo"<tr class=trbgc><td class=select>Name in Full</td><td colspan='3'>$fullname</td></tr>";
//echo"<tr class=trbgc><td class=select>Course</td><td colspan='3'>";

echo"</td></tr>";
echo"<tr class=trbgc><td class=select>NIC Number</td><td colspan='3'>$nic</td></tr>";
echo"<tr class=trbgc><td class=select>Date of Birth</td><td colspan='3'>$dob</td></tr>";
echo"<tr class=trbgc><td class=select>Gender</td><td colspan='3'>$gender</td></tr>";	
echo"<tr class=trbgc><td class=select>Contact Number</td><td colspan='3'>$cno</td></tr>";
echo"<tr class=trbgc><td class=select>Email</td><td colspan='3'>$email</td></tr>";
echo"<tr class=trbgc><td class=select>Address</td><td colspan='3'>$add1,&nbsp;$add2,&nbsp;$add3,&nbsp;$add4</td></tr>";
echo"<tr class=trbgc><td class=select>Province</td><td>$province</td><td class=select>District</td><td>$district</td</tr>";	
//echo"<tr class=trbgc><td>District</td><td colspan='2'>$district</td></tr>";	
echo"<tr class=trbgc><td class=select>Race</td><td>$race</td><td class=select>Religion</td><td>$religion</td></tr>";	
//echo"<tr class=trbgc><td>Religion</td><td colspan='2'>$religion</td></tr>";
echo"<tr class=trbgc><td class=select>CitizenShip</td><td>$citizenShip</td><td class=select>Blood Group</td><td>$bgroup</td></tr>";
//echo"<tr class=trbgc><td>Blood Group</td><td colspan='2'>$bgroup</td></tr>";
echo"<tr class=trbgc><td class=select>A/L Index No</td><td>$alindex</td><td class=select>ZScore</td><td>$zscore</td></tr>";
//echo"<tr class=trbgc><td>ZScore</td><td colspan='2'>$zscore</td></tr>";
echo"<tr class=trbgc><td class=select>Medium</td><td>$medium</td><td class=select>A/L Batch</td><td>$albatch</td></tr>";
//echo"<tr class=trbgc><td>A/L Batch</td><td colspan='2'>$albatch</td></tr>";
echo"<tr class=trbgc><td class=select>School</td><td colspan='3'>$School</td></tr>";
echo"<tr class=trbgc><td class=select>Emergency Case Informer Name</td><td>$iname</td><td class=select>Emergency Case Informer Address</td><td>$iaddress</td></tr>";
//echo"<tr class=trbgc><td>Emergency Case Informer Address</td><td colspan='2'>$iaddress</td></tr>";
echo"<tr class=trbgc><td class=select>Emergency Case Informer Contact No</td><td>$icontactNo</td><td class=select>Telephone Number Home</td><td>$pnohome</td></tr>";
echo"<tr class=trbgc><td class=select>Name of Father</td><td>$fathername</td><td class=select>Occupation of Father</td><td>$foccupation</td></tr>";
//echo"<tr class=trbgc><td>Occupation of Father</td><td colspan='2'>$foccupation</td></tr>";
echo"<tr class=trbgc><td class=select>Name of Mother</td><td>$mothername</td><td class=select>Occupation of Mother</td><td>$moccupation</td></tr>";
//echo"<tr class=trbgc><td>Occupation of Mother</td><td colspan='2'>$moccupation</td></tr>";
//echo"<tr class=trbgc><td>Telephone Number Home</td><td colspan='2'>$pnohome</td></tr>";
		

echo"</table>";
?>