<?php
//error_reporting(0);
session_start();
if((isset($_SESSION['login'])=="truefohssmis")){

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from rumisdb.role where role='$role'";
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
if($qpers['id']=="47"){
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
<script type="text/javascript" src="./Ajax/rmexreg.js"></script>

<?php
//...........Edit by Iranga .............
//creating practical sessions and start practical registrations


$due=$_GET['due'];
require_once('./classes/globalClass.php');
$n=new settings();

include './admin/config.php';
$con40=mysql_connect($host,$user,$pass) or die("Unable to connect Database");
mysql_select_db($db);


$queprac="select * from call_registration";
$quprac=mysql_query($queprac);
while($qup=mysql_fetch_array($quprac)){
$seme=$qup['semister'];
$acyart=$qup['acedemic_year'];
}

$getyr=explode("_",$acyart);
$yrpast=$getyr[0];
$ynezt=$getyr[1];
$yelast=$yrpast-6;


echo"Manage Exam Registration Unit";
echo"<hr class=bar>";


echo "<br><form method='POST' action='./index.php?view=admin&admin=47&task=enddate'>";
echo "Examination Registration Closing Date : ";
echo"<span id='date1'><input type='text' name='enddate' size='20'><span class='textfieldRequiredMsg'><font size='-1'> Enter the Closing Date</font></span>";
echo"<span class='textfieldInvalidFormatMsg'><font size='-1'>Invalid format</font></span>";
echo"<select name='status'>";
echo"<option value='1'>Start</option>";
echo"<option value='0'>Stop</option>";
echo"</select>";
echo"<input type='submit' value='Submit'>";
echo "</form><br>";

if($task=="enddate"){

$enddate=$_POST['enddate'];
$status=$_POST['status'];



$quedel="delete from call_exam_registration";
mysql_query($quedel);

$que_ins_prac="insert into call_exam_registration(semester,acc_year,closing_date,status) values($seme,'$acyart','$enddate',$status)";
mysql_query($que_ins_prac);
}

$quesel="select * from call_exam_registration";
$qusel=mysql_query($quesel);
while($qsel=mysql_fetch_array($qusel)){
$sem=$qsel['semester'];
$ye=$qsel['acc_year'];
$ed=$qsel['closing_date'];
$st=$qsel['status'];
echo"<div align='center'><br>";

echo "<table border='0'>";
echo"<tr><th>Semester</th><th>Acedemic_Year</th><th>Closing Date</th><th>Status</th></tr>";

echo "<tr class=selectbg2><td align='center'>$sem</td>";
echo"<td>$ye</td>";
echo"<td>$ed</td>";

if($st=='1')
{echo"<td>Start</td>";}
if($st=='0')
{echo"<td>Stop</td>";}
echo"</tr>";
}
echo"</table>";
////////////////////////////////print admition cards//////////////////////////////

echo"<hr class=bar>";

echo"Printing Admission Cards";
echo"<hr class=bar>";
echo"Print One Admission Card";
echo"<form method=POST action='./forms/form_47.php?task=oneadd'>";
echo"Enter student Number:&nbsp;&nbsp;";
echo"SC/<select name=byear>";
for($i=1;$i<=7;$i++){
$k=$yelast+$i;
echo"<option value=$k>$k</option>";
}
echo"</select>/";

echo'<span id="number1">';
	echo'<input name="exstno" size="6">&nbsp;';
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter a index Number</font></span>';
	echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
	echo'</span>';

echo"<input type=submit value='Submit'></form>";
echo"<hr class=bar>";
echo"Print Group of Admission Cards<br>";
echo"<form method=POST action='./forms/form_47.php?task=gpadd'>";
echo"<input type='submit' name='admission' value='Admissions of Level-1'>";
echo"<input type='submit' name='admission' value=' Admissions of Level-2'>";
echo"<input type='submit' name='admission' value='Admissions of Level-3'>";
echo"<input type='submit' name='admission' value='Admissions of Pass out Student'>";
echo"</form>";
echo"[ <a href='./downloads/Admission-Card-Common-Side.pdf'>Common Side Of Admission Card</a> ]<br><br>";

/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////modify admission///////////////////////////////////////////////////////
echo"<hr class=bar>";
echo"Modification of Examination Registration";
echo"<hr class=bar>";
echo"<form method=POST action='./index.php?view=admin&admin=47&task=modfyadm'>";
echo"Enter student Number:&nbsp;&nbsp;";
echo"SC/<select name=byear2>";
for($i=1;$i<=7;$i++){
$k=$yelast+$i;
echo"<option value=$k>$k</option>";
}
echo"</select>/";

echo'<span id="number2">';
	echo'<input name="exstno2" size="6">&nbsp;';
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter a index Number</font></span>';
	echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
	echo'</span>';

echo"<input type=submit value='Submit'></form>";

if($task=="modfyadm"){
error_reporting(0);
$ye=date('Y');

$dtntm=date("Y-m-d/H:i");
$user=$_SESSION['user_id'];

$upuser=$user."/".$dtntm;


if($_POST['byear2']!=NULL){
$_SESSION['batch']=$_POST['byear2'];
			}
$byaer2=$_SESSION['batch'];


if($_POST['exstno2']!=NULL){
$_SESSION['gtuser_id']=$_POST['exstno2'];
				}
$exstno2=$_SESSION['gtuser_id'];

$name=$n->getName($exstno2);
$batch=$n->getBatch($exstno2);


////////////////////////////////////////////////////modification tasks///////////////////////////////////////////////////
if($due=="cancel"){
//echo"cancel";
$excosid=$_POST['excosid'];
$queudcnseexr="update exam_registration set confirm=0 where id=$excosid";	
mysql_query($queudcnseexr);

$queupdtexdata="update exam_registration set Last_update='$upuser' where id=$excosid";
mysql_query($queupdtexdata);


		}





if($due=="modify"){
//echo"modify";
$excosmd=$_POST['excosmd'];
$exdgst=$_POST['exdgst'];
$cnfstat=$_POST['cnfstat'];

$queuptoel="update exam_registration set confirm=$cnfstat where id=$excosmd ";
mysql_query($queuptoel);
	
$queupdtexdata="update exam_registration set Last_update='$upuser' where id=$excosmd";
mysql_query($queupdtexdata);


		}







if($due=="register"){
//echo"register";
$excosrg=$_POST['excosrg'];
$dgstto=$_POST['dgst'];
$cnfstatnew=$_POST['cnfstatnew'];

$queinsexrgnw="insert into exam_registration (student,course,acedemic_year,semester,degree,confirm,year,Last_update) values('$exstno2','$excosrg','$acyart',$seme,$dgstto,$cnfstatnew,$ye,'$upuser')";
//echo$queinsexrgnw;
mysql_query($queinsexrgnw);

		}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	if($batch==$byaer2){
		echo"<font color='blue'>Course Unit Registration For Examination of&nbsp; SC/".$byaer2."/".$exstno2."</font><br><br>";
		
		
		if($seme==1){
			$quemdadm1="select r.student,r.course,r.degree,c.name from registration r,courseunit c where r.student='$exstno2'and r.semister=1 and r.course=c.code and r.confirm=1";
				}
		else{
			$quemdadm1="select r.student,r.course,r.degree,c.name from registration r,courseunit c  where r.student='$exstno2' and (r.semister=2 or r.semister=3) and r.course=c.code and r.confirm=1";
			}
			//echo$quemdadm1;
			$qumdadm1=mysql_query($quemdadm1);

			echo"<table border='0'><tr>";
			echo"<th>Courses Code</th><th>Courses Name</th><th>Degree Status</th><th>Reg. Status</th><th>Registration</th></tr>";
		if(mysql_num_rows($qumdadm1)!=0){

			while($qmdadm1=mysql_fetch_array($qumdadm1)){
				$gtstnum=$qmdadm1['student'];
				$cors=$qmdadm1['course'];
				
				$dgst=$qmdadm1['degree'];
				if($dgst==1){
					$dgst1="Degree";
						}
				else{
					$dgst1="Non Degree";
					}
				$name=$qmdadm1['name'];
//................................................................................................

$quegtreslt="select grade from results where index_number='$exstno2' and subject='$cors' order by id";
	$qugtreslt=mysql_query($quegtreslt);
	if(mysql_num_rows($qugtreslt)!=0){
	while($qgtreslt=mysql_fetch_array($qugtreslt)){
		$gtreslt=$qgtreslt['grade'];
							}
						}
	else{
		$gtreslt="ND";
		}

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
				    
				default:
					//echo "0";
					$gpavl= "0";
				}	//endswitch;







//................................................................................................
				//echo$gpavl;
				if($gpavl<2){
					//echo$cors." ".$dgst." ".$name."<br>";
				$queckadmi="select id,degree,confirm from exam_registration where student='$exstno2' and acedemic_year='$acyart' and semester=$seme and course='$cors'";
				//echo$queckadmi."<br>";
				$quckadmi=mysql_query($queckadmi);
				if(mysql_num_rows($quckadmi)!=0){
					while($qckadmi=mysql_fetch_array($quckadmi)){
							$exid=$qckadmi['id'];
							$exdgst=$qckadmi['degree'];
								if($exdgst==1){
									$exdgst1="Degree";
										}
								else{
									$exdgst1="Non Degree";
									}	
							$exelist=$qckadmi['confirm'];
								
///////////////////////////////////////////Eligibility modify//////////////////////////////////////////////////////////
						if($exelist==1){
					echo"<form method=POST action='./index.php?view=admin&admin=47&task=modfyadm&due=cancel'><tr bgcolor='#d2a6d9'><td align='center'>".strtoupper($cors)."<input type=hidden  name=excosid value=$exid></td><td>&nbsp;&nbsp; $name</td><td align='center'>$exdgst1</td>";

					echo"<td align='center'>Eligibility ok</td>";
					echo"<td align='center'><input type='submit' value='Cancel'></td></tr></form>";
								}
						else{
					echo"<form method=POST action='./index.php?view=admin&admin=47&task=modfyadm&due=modify'><tr bgcolor='#c6d9bc'><td align='center'>".strtoupper($cors)."<input type=hidden  name=excosmd value=$exid></td><td>&nbsp;&nbsp; $name</td><td align='center'>$exdgst1<input type=hidden  name=exdgst value=$exdgst></td>";
					
					echo"<td align='center'><select name=cnfstat>";
						if($exelist==2){
						echo"<option value='0'>Not Confirmed</option>";
						echo"<option value='1'>Eligible</option>";
						echo"<option value='2' selected>Not Eligible</option>";
								}
						else{
						echo"<option value='0' selected>Not Confirmed</option>";
						echo"<option value='1'>Eligible</option>";
						echo"<option value='2'>Not Eligible</option>";
							}
					echo"</select></td>";
					echo"<td align='center' width=20%><div id=$exid><input type='submit' name='regmod' value='Modify'><input type='button' name='regmod' value='Remove' onClick=removeexreg($exid)></td></tr></form>";
							}

											}
				

								}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////add new course unit to exam regi table//////////////////////////////////////////////
				else{
					echo"<form method=POST action='./index.php?view=admin&admin=47&task=modfyadm&due=register'><tr bgcolor='#edd4dc'><td align='center'>".strtoupper($cors)."<input type=hidden  name=excosrg value=$cors></td><td>&nbsp;&nbsp; $name <font color=red>[** Not Register to the Examination ]</font></td><td align='center'>$dgst1<input type=hidden  name=dgst value=$dgst></td>";

					echo"<td align='center'><select name=cnfstatnew>";
						
						echo"<option value='0'>Not Confirmed</option>";
						echo"<option value='1' selected>Eligible</option>";
						echo"<option value='2'>Not Eligible</option>";
						
					echo"</select></td>";

					echo"<td align='center'><input type='submit' value='Register'></td></tr></form>";
					}



								}
									}//$qumdadm1 while
					}
				else{
					echo"<tr><td colspan='5' align='center' bgcolor='#edd4dc'><font color='red'>Sorry ! Cannot Find Informations. </font></td></tr>";

					}

			echo"</table>";




				}
	else{
		echo"<font color='red'>Invalid Student Number ! </font><br>";
		}

}//modfyadm if


?>










<?php
}
}	
else{

echo "You Have Not Permission To Access This Area!";}
?>

