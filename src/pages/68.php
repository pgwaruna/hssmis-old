<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){
include'../connection/connection.php';

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole) ;

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
if($qpers['id']=="68"){
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

<script type="text/javascript">
function chknuval(utlrgfm){
	 if (utlrgfm.district.value=="nooptn"){
		alert("Please Select Residential District");
		utlrgfm.district.focus();
		return false;
		}

	if (utlrgfm.school.value=="nooptn"){
			alert("Please Select Type of School Attended");
			utlrgfm.school.focus();
			return false;
			}

	if (utlrgfm.itexp.value==""){
				alert("Please Enter Value for 'How Many Years Have You Used a Computer?'");
				utlrgfm.itexp.focus();
				return false;
				}

	if (utlrgfm.drgrprog.value==""){
				alert("Please Enter Your Degree Programme of Study");
				utlrgfm.drgrprog.focus();
				return false;
				}

	
				}
</script>

<?php
////////////////////////////////////////////////////////////////////////////////
/////////////////////// set status for registration/////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$basicregstatus="basic1";
$today=date("Y-m-d");
$reg_closing_date="2014-07-11";
$clspregst=strtotime($today) - strtotime($reg_closing_date);
if($clspregst>0){
$reg_status="off";
}
else{
$reg_status="on"; //////////use "on" or "off" as reg status//////////
}
////////////////////////////////////////////////////////////////////////////////
/////////////////////// set status for registration end/////////////////////////
////////////////////////////////////////////////////////////////////////////////





echo"UCTIT & UTEL Registrations";
echo"<hr class=bar>";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////// registration on //////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($reg_status=="on"){


require_once('./classes/globalClass.php');
$u=new settings();

$stno=$_SESSION['user_id'];
$stfac=$_SESSION['faculty'];

$stbtch=$u->getBatch($stno);
$stnamewtini=$u->getName($stno);
$stcrlvl=$u->getLevel($stno);
$stcuracyear=$u->getAcc();

$regstatus="no";
$quetyp="nil";


$district= array("Ampara", "Anuradhapura", "Badulla", "Batticaloa", "Colombo", "Galle", "Gampaha", "Hambantota", "Jaffna", "Kalutara", "Kandy", "Kegalle", "Kilinochchi", "Kurunegala", "Mannar", "Matale", "Matara", "Moneragala", "Mullaitivu", "Nuwara Eliya", "Polonnaruwa", "Puttalam", "Ratnapura", "Trincomalee", "Vavuniya");

///////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// changing variables for other faculty///////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
$stdy_degree_type=array("Bachelor of Science", "Bachelor of Computer Science");
$stfacalty="SCIENCE";
///////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// changing variables for other faculty end///////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

echo"<font size=3px>*** STUDENT REGISTRATION FORM ***</font><br>";

echo"<font color=red>Registration Closing Date : $reg_closing_date</font></br>";
////////////////////////////////////////////////////////////////////////////////
//////////////////////////ins que///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
if($task=="adfm"){
$stname=$_POST['stname'];
$stcrtfname=$_POST['stcrtfname'];
$gtnic=$_POST['nic'];
$getdistrict=$_POST['district'];
$school=$_POST['school'];
$b4it=$_POST['b4it'];
$b4eng=$_POST['b4eng'];
$itexp=$_POST['itexp'];
$sex=$_POST['sex'];
$email=$_POST['email'];
$cotno=$_POST['cotno'];
$drgrprog=$_POST['drgrprog'];
$crlvl=$_POST['crlvl'];
$UCTIT=$_POST['UCTIT'];
$UTEL=$_POST['UTEL'];
$quetyp=$_POST['quetyp'];


//echo$stname.$stcrtfname.$nic.$district.$school.$b4it.$b4eng.$itexp.$sex.$email.$cotno.$drgrprog.$crlvl.$UCTIT.$UTEL;
if($quetyp=="no"){
$queinsdata="insert into uctit_utel_reg_status(stno, academic_year, full_name, certficate_name, nic, residential_district, type_of_school_attended, before_it_exp, before_eng_exp, computer_usege, gender, email, contact_no, faculty, degree_programme, level, registering_UCTIT, registering_UTEL, status) values('$stno','$stcuracyear','$stname','$stcrtfname','$gtnic','$getdistrict','$school','$b4it','$b4eng','$itexp','$sex','$email','$cotno','$stfacalty','$drgrprog','$crlvl','$UCTIT','$UTEL','$basicregstatus')";
$quinsdata=mysql_query($queinsdata);
if($quinsdata){
	echo"<font color=blue size=3px>Successfully Inserted !<br>";
	echo"(The form will fill with your informations.)</font><br>";
		}
else{
	$quegetduplct="select stno from uctit_utel_reg_status where stno='$stno' and academic_year='$stcuracyear'";
	$qugetduplct=mysql_query($quegetduplct);
		if(mysql_num_rows($qugetduplct)==0){
			echo"<font color=red size=3px>Sorry! There is a problem with inserting please try again.</font><br>";
							}
		else{
			echo"<font color=red size=3px>Sorry! You have already registered for this academic year. There for you can not register.</font><br>";
			}
	}
}
else{

$queupdtdt="update uctit_utel_reg_status set full_name='$stname', certficate_name='$stcrtfname', nic='$gtnic', residential_district='$getdistrict', type_of_school_attended='$school', before_it_exp='$b4it', before_eng_exp='$b4eng', computer_usege='$itexp', gender='$sex', email='$email', contact_no='$cotno', degree_programme='$drgrprog', level='$crlvl', registering_UCTIT='$UCTIT', registering_UTEL='$UTEL' where stno='$stno' and academic_year='$stcuracyear'";

$quupdtdt=mysql_query($queupdtdt);

if($quupdtdt){
	echo"<font color=blue size=3px>Successfully Updated !<br>";
	echo"(The form will fill with your informations.)</font><br>";
	}
else{
	echo"<font color=red>Sorry! There is a problem with updating please try again.</font><br>";
	}







}

}
////////////////////////////////////////////////////////////////////////////////
//////////////////////////ins que///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////






////////////////////////////////////////////////////////////////////////////////
////////////////////////////chkreg tbl//////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$quegetcurregdt="select * from uctit_utel_reg_status where stno='$stno' and academic_year='$stcuracyear' and status='$basicregstatus'";
$qugetcurregdt=mysql_query($quegetcurregdt);
if(mysql_num_rows($qugetcurregdt)==0){
	$regstatus="no";
}
else{
	while($qgetcurregdt=mysql_fetch_array($qugetcurregdt)){
			$full_name=$qgetcurregdt['full_name'];
			$certficate_name=$qgetcurregdt['certficate_name'];
			$nic=$qgetcurregdt['nic'];
			$residential_district=$qgetcurregdt['residential_district'];
			$type_of_school_attended=$qgetcurregdt['type_of_school_attended'];
			$before_it_exp=$qgetcurregdt['before_it_exp'];
			$before_eng_exp=$qgetcurregdt['before_eng_exp'];
			$computer_usege=$qgetcurregdt['computer_usege'];
			$gender=$qgetcurregdt['gender'];
			$stemail=$qgetcurregdt['email'];
			$contact_no=$qgetcurregdt['contact_no'];
			$degree_programme=$qgetcurregdt['degree_programme'];
			$level=$qgetcurregdt['level'];
			$registering_UCTIT=$qgetcurregdt['registering_UCTIT'];
			$registering_UTEL=$qgetcurregdt['registering_UTEL'];
			//$=$qgetcurregdt[''];

		$regstatus="yes";


								}

}





////////////////////////////////////////////////////////////////////////////////
/////////////////////////// chkreg tbl end /////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////












if(($regstatus=="yes")&&($quetyp=="nil")){
echo"<font color=red size=3px>Already you have registered, if you want you can update your information here!</font>";
			}



echo"<table border=0 ><tr class=selectbg><td>&nbsp;";
echo"<form method=post action='./index.php?view=admin&admin=68&task=adfm' id=utlrgfm>";
	echo"<table border=0 >";

	echo"<tr class=trbgc height=25px><td colspan=2 align=center><b>FACULTY OF $stfacalty</b>";
	echo"<tr class=trbgc height=25px><td width=30%>&nbsp;Student Number<td width=60%>&nbsp; <b>SC/$stbtch/$stno</b>";
	echo"<tr class=trbgc height=25px><td>&nbsp;Name with Initials<td>&nbsp; <b>$stnamewtini</b>";


	echo"<tr class=trbgc><td>&nbsp;Full Name<td>&nbsp; <span id='sprytextfield1'><input type=text name=stname size=30 value='$full_name'>";
			echo'<span class="textfieldRequiredMsg"><font size="-1"> Please Enter Full Name&nbsp;</font></span>';
			echo"</span>";


	echo"<tr class=trbgc><td>&nbsp;Preferred Name to Appear in the Certificate<td>&nbsp; <span id='sprytextfield2'><input type=text name=stcrtfname size=30 value='$certficate_name'> ";
			echo'<span class="textfieldRequiredMsg"><font size="-1"> Please Enter Preferred Name&nbsp;</font></span>';
			echo"</span>";


	echo"<tr class=trbgc><td>&nbsp;NIC Number<td>&nbsp; <span id='sprytextfield3'><input type=text name=nic value='$nic'>  ";
			echo'<span class="textfieldRequiredMsg"><font size="-1"> Please Enter National Identity Card No&nbsp;</font></span>';
			echo"</span>";


	echo"<tr class=trbgc><td>&nbsp;Residential District<td>&nbsp; <select name=district>";
			echo"<option value='nooptn'>--- Select One ---</option>";
				for($ds=0;$ds<count($district);$ds++){

					if($district[$ds]==$residential_district){
					echo"<option value='$district[$ds]' selected>$district[$ds]</option>";
											}
					else{
					echo"<option value='$district[$ds]'>$district[$ds]</option>";
						}
							}
							echo"</select>";



	echo"<tr class=trbgc><td>&nbsp;Type of School Attended<td>&nbsp; <select name=school> ";
			echo"<option value='nooptn'>--- Select One ---</option>";
			
			if($type_of_school_attended=='National'){ echo"<option value='National' selected>National</option>";	}
			else{echo"<option value='National'>National</option>";	}

			if($type_of_school_attended=='Provincial'){echo"<option value='Provincial' selected>Provincial</option>";}
			else{echo"<option value='Provincial'>Provincial</option>";}

			if($type_of_school_attended=='Private'){echo"<option value='Private' selected>Private</option>";}
			else{echo"<option value='Private'>Private</option>";}

			if($type_of_school_attended=='Semi-Government'){echo"<option value='Semi-Government' selected>Semi-Government</option>";}
			else{echo"<option value='Semi-Government'>Semi-Government</option>";}

			if($type_of_school_attended=='Pirivena'){echo"<option value='Pirivena' selected>Pirivena</option>";}
			else{echo"<option value='Pirivena'>Pirivena</option>";}

								echo"</select>";


	echo"<tr class=trbgc><td>&nbsp;Have you followed an IT Course Before?<td>&nbsp; <select name=b4it> ";
			if($before_it_exp=="No"){echo"<option value='No' selected>No</option>";}
			else{echo"<option value='No'>No</option>";}

			if($before_it_exp=="Withing the University"){echo"<option value='Withing the University' selected>Withing the University</option>";}
			else{echo"<option value='Withing the University'>Withing the University</option>";}

			if($before_it_exp=="Outside of the University"){echo"<option value='Outside of the University' selected>Outside of the University</option>";}
else{echo"<option value='Outside of the University'>Outside of the University</option>";}

			if($before_it_exp=="Both"){echo"<option value='Both' selected>Both</option>";}	
			else{echo"<option value='Both'>Both</option>";}					

echo"</select>";


	echo"<tr class=trbgc><td>&nbsp;Have you followed an English Course Before?<td>&nbsp; <select name=b4eng>  ";
			if($before_eng_exp=="No"){echo"<option value='No' selected>No</option>";}
			else{echo"<option value='No'>No</option>";}

			if($before_eng_exp=="Withing the University"){echo"<option value='Withing the University' selected>Withing the University</option>";}
			else{echo"<option value='Withing the University'>Withing the University</option>";}

			if($before_eng_exp=="Outside of the University"){echo"<option value='Outside of the University' selected>Outside of the University</option>";}
else{echo"<option value='Outside of the University'>Outside of the University</option>";}

			if($before_eng_exp=="Both"){echo"<option value='Both' selected>Both</option>";}	
			else{echo"<option value='Both'>Both</option>";}	

	
								echo"</select>";


	echo"<tr class=trbgc><td>&nbsp;For How Many Years Have You Used a Computer?<td>&nbsp;  <input type=text name=itexp value='$computer_usege'>  ";



	echo"<tr class=trbgc><td>&nbsp;Gender<td>&nbsp;  <select name=sex>";
			if($gender=="Male"){echo"<option value='Male' selected>Male</option>";}
			else{echo"<option value='Male'>Male</option>";}
			if($gender=="Female"){echo"<option value='Female' selected>Female</option>";}
			else{echo"<option value='Female'>Female</option>";}
						echo"</select>";



	echo"<tr class=trbgc><td>&nbsp;E-mail Address<td>&nbsp; <input type=text name=email value='$stemail'>   ";
			

	echo"<tr class=trbgc><td>&nbsp;Contact No.<td>&nbsp; <span id='sprytextfield4'><input type=text name=cotno value='$contact_no'>";
			echo'<span class="textfieldRequiredMsg"><font size="-1"> Please Enter Contact Number&nbsp;</font></span>';
			echo"</span>";


	echo"<tr class=trbgc><td>&nbsp;Degree Programme of Study <td>&nbsp;   <select name=drgrprog>";

			for($dgst=0;$dgst<count($stdy_degree_type);$dgst++){
				
				if($stdy_degree_type[$dgst]==$degree_programme){
					echo"<option value='$stdy_degree_type[$dgst]' selected> $stdy_degree_type[$dgst]</option>";
										}
				else{
					echo"<option value='$stdy_degree_type[$dgst]'>$stdy_degree_type[$dgst]</option>";
					}
										
										}
			




					echo"</select>";

	echo"<tr class=trbgc><td>&nbsp;Current Level of Study<td>&nbsp; <select name=crlvl>";
			if($stcrlvl==1){
				echo"<option value='Level 1' selected>Level 1</option>";
					}
			
			elseif($stcrlvl==2){
				echo"<option value='Level 2' selected>Level 2</option>";
					}
			
			elseif($stcrlvl==3){
				echo"<option value='Level 3' selected>Level 3</option>";
					}
			
			elseif($stcrlvl==4){
				echo"<option value='Level 4' selected>Level 4</option>";
					}
			
			elseif($stcrlvl==5){
				echo"<option value='Level 5' selected>Level 5</option>";
					}
			else{
				echo"<option value='nooptn' selected >--- Select One ---</option>";
				echo"<option value='Level 1'>Level 1</option>";
				echo"<option value='Level 2'>Level 2</option>";
				echo"<option value='Level 3'>Level 3</option>";
				echo"<option value='Level 4'>Level 4</option>";
				echo"<option value='Level 5'>Level 5</option>";

					}

				echo"</select>";


	echo"<tr class=trbgc><td>&nbsp;Registering for UCTIT<td>&nbsp;  <select name=UCTIT> ";
			if($registering_UCTIT=="Yes"){echo"<option value='Yes' selected>Yes</option>";}
			else{echo"<option value='Yes'>Yes</option>";}

			if($registering_UCTIT=="No"){echo"<option value='No' selected>No</option>";}
			else{echo"<option value='No'>No</option>";}
						echo"</select>";

	echo"<tr class=trbgc><td>&nbsp;Registering for UTEL<td>&nbsp;  <select name=UTEL> ";
			if($registering_UTEL=="Yes"){echo"<option value='Yes' selected>Yes</option>";}
			else{echo"<option value='Yes'>Yes</option>";}

			if($registering_UTEL=="No"){echo"<option value='No' selected>No</option>";}
			else{echo"<option value='No'>No</option>";}

						echo"</select>";
	
	echo"<tr class=trbgc><td colspan=2 align=center>";
		if($regstatus=="yes"){
			echo"<input type=hidden name=quetyp value='yes'><input type=submit value='Update the Form'  onclick='return chknuval(utlrgfm)'> ";
					}
		else{
			echo"<input type=hidden name=quetyp value='no'><input type=submit value='Submit the Form'  onclick='return chknuval(utlrgfm)'> ";
			}
	echo"</table>";
echo"</form>";
echo"</table>";


	}/////////////////////////////////////////////// registration on if close///////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

else{
echo"<font color=red>Sorry! UCTIT & UTEL Registrations is closed.</font>";
}


?>







<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>
