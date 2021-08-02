<?php
//error_reporting(0);
session_start();
$curriculum = intval($_SESSION['curriculum']);
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













/////////////444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444
echo"<table border=0 width=95%><tr align=center valign=top class=selectbg><td width=50%>";

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



require_once('./classes/globalClass.php');
$vr47=new settings();

$crtacyr=$vr47->getAcc();

//...........get semester..........
$exmseme=$vr47->getSemister();
//.................................................	

echo"<hr class=bar>";
echo"Start Exam Registration";
echo"<hr class=bar>";				
						
						
						// Increase Current Session
					
						if(($task=="calsemreg")&&(isset($_POST['submit']))){
						$nmbr_4=$_POST['numbr'];	
						$lvl_4=$_POST['level'];
						$sem_4=$_POST['semester'];
						$ace_4=$crtacyr;
						$date_4=$_POST['enddate'];
						$reg_4=$_POST['rgstt'];
								//echo$lvl_4.$ace_4.$date_4.$reg_4;			
						if($lvl_4=="all"){
							$a=mysql_query('delete from call_exam_registration');
							$quegetcrntsem="select distinct(level) from level where level<>0";
							$qugetcrntsem=mysql_query($quegetcrntsem);
							$insrw=1;
							while($qgetcrntsem=mysql_fetch_array($qugetcrntsem)){
									$getcrntsem=$qgetcrntsem['level'];
									//echo$getcrntsem;
									$queinsrec="insert into call_exam_registration (level, semester, acc_year, closing_date, status) values('$getcrntsem','$sem_4','$ace_4','$date_4','$reg_4')";
									//echo$queinsrec;
									mysql_query($queinsrec);
									$insrw++;
							}
						}
						else{
									$b=mysql_query("update call_exam_registration set level='$lvl_4',semester=$sem_4,acc_year='$ace_4',closing_date='$date_4',status='$reg_4' where level=$nmbr_4");
						}
						
						
						}
						
						
						// Display Available Session
								
								
				echo"<table border=0>";
				echo"*** On/Off Examination Registration ***<br>";
					echo"<th>Level<th>Semester<th>Closing Date<th>Reg. Status<th>Submit</th>";
					echo"<form method=POST action=./index.php?view=admin&admin=47&task=calsemreg><tr class=trbgc><td align=center>All Levels<input type=hidden name=level value='all'>";
						echo"<td align=center>";
						echo"<select name=semester>";
						if($exmseme==1){
							echo"<option value=1 selected>Semester 1</option>";
							echo"<option value=2>Semester 2</option>";							
						}
						else{
							echo"<option value=1>Semester 1</option>";
							echo"<option value=2 selected>Semester 2</option>";							
						}

						echo"</select>";
						echo"</td>";
	
						echo'<span id="date1">';
						echo"<td align=center><input type=text name=enddate required placeholder='YYYY-MM-DD'>";
							echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter the Closing Date</font></span>';
							echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
						echo"</span>";
						
						
						
						
						echo"<td align=center><select name='rgstt'>";
											echo"<option value=1 selected>Start</option>";
											echo"<option value=0>Stop</option>";
											echo"</select>";

						echo"<td align=center><input type=submit name=submit value=Submit></tr></form>";
						
						
						$quegetcrntsem="select distinct(level) from level where level<>0";
						$qugetcrntsem=mysql_query($quegetcrntsem);
						$rw=1;
						while($qgetcrntsem=mysql_fetch_array($qugetcrntsem)){
									$getcrntsem=$qgetcrntsem['level'];
									if($getcrntsem==0){
										$getcrntsem2="Pass out";
									}
									else{
										$getcrntsem2=$getcrntsem;
									}
									
									echo"<form method=POST action=./index.php?view=admin&admin=47&task=calsemreg><tr class=trbgc><td align=center>Level - $getcrntsem2"."000<input type=hidden name=level value=$getcrntsem><input type=hidden name=numbr value=$getcrntsem>";
															echo"<td align=center>";			
															echo"<select name=semester>";
																				if($exmseme==1){
																					echo"<option value=1 selected>Semester 1</option>";
																					echo"<option value=2>Semester 2</option>";							
																				}
																				else{
																					echo"<option value=1>Semester 1</option>";
																					echo"<option value=2 selected>Semester 2</option>";							
																				}
															echo"</select>";
															echo"</td>";
															
															echo"<td align=center><input type=text name=enddate required placeholder='YYYY-MM-DD'>";
															echo"<td align=center><select name='rgstt'>";
																				echo"<option value=1 selected>Start</option>";
																				echo"<option value=0>Stop</option>";
																				echo"</select>";

															echo"<td align=center><input type=submit  name=submit value=Submit></tr></form>";
															$rw++;
																			}
						
						
						
						
						
						
						

				echo"</table><br><br>";
								
								
								
								
								
								
								
						echo"*** Current Examination Registration Status***<br>";	
						$query4_2="select * from call_exam_registration";
						$reg_details=mysql_query($query4_2);
						echo '<table border="0" ><tr><th>Level<th>Semester<th>Academic Year<th>Closing Date<th>Reg. Status</tr>';
						if(mysql_num_rows($reg_details)==0){
							echo "<tr class=trbgc><td align=center colspan=5>Sorry! There are no data in this table.";
						}
						else{
						while($data=mysql_fetch_array($reg_details)){
							$getcrntsem22=$data['level'];
								if($getcrntsem22==0){
										$getcrntsem23="Pass out";
									}
									else{
										$getcrntsem23=$getcrntsem22."000";
									}
							
						echo "<tr class=trbgc><td align=center>".$getcrntsem23."<td align=center>".$data['semester']."<td align=center>".$data['acc_year']."<td align=center>".$data['closing_date'];
						echo"<td align=center>";
							if($data['status']==1){
								echo"Start";
							}
							else{
								echo"Stop";
							}
						echo "</tr>";
						}
						}
						echo "</table><br>";

	





//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


echo"<td>";
echo"<hr class=bar>";
echo"Printing Admission Cards";
echo"<hr class=bar>";

//////////////////////666666666666666666666666666666666666666666666///////////////////////////
/*///////////remove this cmt after this sem
echo"*** Generate Admission Cards of Students ***<br>";


if($task=="gendd"){
$_SESSION['genok']=0;
$genadbtch=$_POST['admission'];
$setwrds=explode(" ",$genadbtch);
	$btlvl=$setwrds[3];
//echo$btlvl;
if($btlvl=="Recently"){
	$atcllvl=0;
	$prntlvlvr="for Recently Passout Level";
}
else{
$getatcllvl=explode("0",$btlvl);
	$atcllvl=$getatcllvl[0];	
	$prntlvlvr="for $atcllvl"."000 Level";
}







//echo$atcllvl;

/////////////////////////////////////
/////////////////////////////////////

include'47_1.php';


/////================================

$_SESSION['genok']=$atcllvl;

/////////////////////////////////////
/////////////////////////////////////

}

$pntgenokssn=$_SESSION['genok'];
//echo$pntgenokssn;
echo"<form method=POST action='index.php?view=admin&admin=47&task=gendd'>";

if($pntgenokssn==4){
	echo"<input type='submit' name='admission' value='Generate Admissions of 1000 Level'>";
	echo"<input type='submit' name='admission' value='Generate Admissions of 2000 Level'>";	
	echo"<input type='submit' name='admission' value='Generate Admissions of 3000 Level'>";
	echo"<input type='submit' name='admission' value='Generate Admissions of 4000 Level'>";
}
elseif($pntgenokssn==3){
	echo"<input type='submit' name='admission' value='Generate Admissions of 1000 Level'>";
	echo"<input type='submit' name='admission' value='Generate Admissions of 2000 Level'>";	
	echo"<input type='submit' name='admission' value='Generate Admissions of 3000 Level'>";
	echo"<input type='submit' name='admission' value='Generate Admissions of 4000 Level'>";
}
elseif($pntgenokssn==2){
	echo"<input type='submit' name='admission' value='Generate Admissions of 1000 Level'>";
	echo"<input type='submit' name='admission' value='Generate Admissions of 2000 Level'>";	
	echo"<input type='submit' name='admission' value='Generate Admissions of 3000 Level' >";
	echo"<input type='submit' name='admission' value='Generate Admissions of 4000 Level' disabled>";
}
elseif($pntgenokssn==1){
	echo"<input type='submit' name='admission' value='Generate Admissions of 1000 Level'>";
	echo"<input type='submit' name='admission' value='Generate Admissions of 2000 Level'>";	
	echo"<input type='submit' name='admission' value='Generate Admissions of 3000 Level' disabled>";
	echo"<input type='submit' name='admission' value='Generate Admissions of 4000 Level' disabled>";
}
else{
	echo"<input type='submit' name='admission' value='Generate Admissions of 1000 Level'>";
	echo"<input type='submit' name='admission' value='Generate Admissions of 2000 Level' disabled>";	
	echo"<input type='submit' name='admission' value='Generate Admissions of 3000 Level' disabled>";
	echo"<input type='submit' name='admission' value='Generate Admissions of 4000 Level' disabled>";	
}
echo"<input type='submit' name='admission' value='Generate Admissions of Recently Passout Level'>";


echo"</form>";
*/
//////////////////////666666666666666666666666666666666666666666666///////////////////////////



////////////////////////////////print admition cards//////////////////////////////


echo"<br>*** Print Admission Card of Student ***";
echo'<table border="0" cellspacing="1" class="bgc" width="80%"><tr align="center"><td>';
echo"<form method=POST action='./forms/form_47.php?task=oneadd'>";
echo"Student Number :&nbsp;&nbsp;";
echo"HS/<select name=byear>";

for($indx=0;$indx<10;$indx++){
	$olyr=$yrpast-$indx;
	echo"<option value='$olyr'>$olyr</option>";
}


echo"</select>/";

echo'<span id="number1">';
	echo'<input name="exstno" size="6">&nbsp;';
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter a Index Number</font></span>';
	echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
	echo'</span>';
if($pntgenokssn==4){
	echo"<input type=submit value='View Admission'>";
}
else{
	//echo"<input type=submit value='View Admission' disabled>";
	echo"<input type=submit value='View Admission'>";
}
echo"<font color='#FF0000'><center>(<span style='font-size: 10pt'> Ex: HS/2003/15291) </center></span></font></form></table>";

echo"<br><br>*** Print Admission Cards of Group of Students ***<br>";
include './forms/form_47_2.php';






//echo"<br><br>[ <a href='./downloads/Admission-Card-Common-Side.pdf'>Common Side Of Admission Card</a> ]<br><br>";



echo"<tr><td colspan=2 align=center valign=top>";
/////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////modify admission///////////////////////////////////////////////////////
if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
echo"<hr class=bar>";
echo"Modification of Examination Registration";
echo"<hr class=bar>";
echo'<table border="0" cellspacing="1" class="bgc" width="80%"><tr align="center"><td>';
echo"<form method=POST action='./index.php?view=admin&admin=47&task=modfyadm'>";
echo"Enter Student Number :&nbsp;&nbsp;";
echo"HS/<select name=byear2>";
for($i=0;$i<10;$i++){
$k=$yrpast-$i;
echo"<option value=$k>$k</option>";
}
echo"</select>/";

echo'<span id="number2">';
	echo'<input name="exstno2" size="6">&nbsp;';
	echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter a Index Number</font></span>';
	echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
	echo'</span>';

echo"<input type=submit value='View Registration'><br><font color='#FF0000'><center>(<span style='font-size: 10pt'> Ex: HS/2003/15291) </center></span></font></form></table>";
}



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

$stflname=$n->getName($exstno2);
$batch=$n->getBatch($exstno2);

if($batch==$byaer2){
        echo"<br><font color='blue'>Course Unit Registration For Examination of HS/".$byaer2."/".$exstno2." ( ".strtoupper($stflname)." )</font><br><br>";
////////////////////////////////////////////////////modification tasks///////////////////////////////////////////////////
if($due=="cancel"){
//echo"cancel";
$excosid=$_POST['excosid'];
$queudcnseexr="update exam_registration set status=0 where id=$excosid";	
mysql_query($queudcnseexr);

$queupdtexdata="update exam_registration set Last_update='$upuser' where id=$excosid";
mysql_query($queupdtexdata);


		}





if($due=="modify"){
//echo"modify";
$excosmd=$_POST['excosmd'];
$exdgst=$_POST['exdgst'];
$cnfstat=$_POST['cnfstat'];
$regmod=$_POST['regmod'];

if($regmod=="Modify"){

$queuptoel="update exam_registration set status=$cnfstat, Last_update='$upuser' where id=$excosmd ";
mysql_query($queuptoel);
echo"<font color=red>Curse Unit Modified Successfully!</font><br>";
		}



		}







if($due=="register"){
//echo"register";
$excosrg=$_POST['excosrg'];
$dgstto=$_POST['dgst'];
$cnfstatnew=$_POST['cnfstatnew'];

$queinsexrgnw="insert into exam_registration (std_id,course_code,academic_year,semester,course_type,status,Last_update) values('hs$exstno2','$excosrg','$acyart',$seme,'$dgstto',$cnfstatnew,'$upuser')";
//echo$queinsexrgnw;
mysql_query($queinsexrgnw);

		}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	
		
		
		
			$quemdadm1="select r.student,r.course,r.degree,c.name from registration r,courseunit c where r.student='hs$exstno2'and (r.semister=$seme or r.semister=3) and r.course=c.code and r.confirm=1 and c.by_low_version=$curriculum order by r.id,r.course";
		
			//echo$quemdadm1;
			$qumdadm1=mysql_query($quemdadm1);

			echo"<table border='0' width='100%'><tr>";
			echo"<th>#<th>Courses Code</th><th>Courses Name</th><th>Degree Status</th><th>Eligibility  Status</th><th>Submission</th></tr>";
		if(mysql_num_rows($qumdadm1)!=0){
			$mdfexrcd=1;
			while($qmdadm1=mysql_fetch_array($qumdadm1)){
				$gtstnum=$qmdadm1['student'];
				$cors=$qmdadm1['course'];
                ////////////////////////////////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($cors);
  
                                $fulcode=strtoupper($coursegetchr);
                                
                                ////////////////////////////////////////////////////
                
                
                
                
                /////////////////////////////////////////////////////////////////////////
				$dgst=$qmdadm1['degree'];
					if($dgst=="Non Degree"){
						$dgst1="Non Degree Course-(6)";
					}
					else{
						$stno="hs".$elgst;
						$dgst1=$n->getcostype($coursegetchr,$gtstnum);
					}
					
				
				
				
				$name=$qmdadm1['name'];
//................................................................................................

$chkrptsub=$n->checkrepeat($gtstnum,$coursegetchr);

//................................................................................................
				//echo$gpavl;
				if($chkrptsub=="yes"){
					//echo$cors." ".$dgst." ".$name."<br>";
				$queckadmi="select id,course_type,status from exam_registration where std_id='hs$exstno2' and academic_year='$acyart' and semester=$seme and course_code='$cors'";
				//echo$queckadmi."<br>";
				$quckadmi=mysql_query($queckadmi);
				if(mysql_num_rows($quckadmi)!=0){
					while($qckadmi=mysql_fetch_array($quckadmi)){
							$exid=$qckadmi['id'];
							$exdgst1=$qckadmi['course_type'];

							$exelist=$qckadmi['status'];
								
///////////////////////////////////////////Eligibility modify//////////////////////////////////////////////////////////
						if($exelist==1){
					echo"<form method=POST action='./index.php?view=admin&admin=47&task=modfyadm&due=cancel'><tr class=selectbg><td align='center'>$mdfexrcd<td align='center'>".$fulcode."<input type=hidden  name=excosid value=$exid></td><td>&nbsp;&nbsp; ".ucfirst($name)."</td><td align='center'>$exdgst1</td>";

					echo"<td align='center'>Eligibled</td>";
					echo"<td align='center'><input type='submit' value='Cancel'></td></tr></form>";
					$mdfexrcd++;
								}
						else{
					echo"<form method=POST action='./index.php?view=admin&admin=47&task=modfyadm&due=modify'><tr class=selectbg4><td align='center'>$mdfexrcd<td align='center'>".$fulcode."<input type=hidden  name=excosmd value=$exid></td><td>&nbsp;&nbsp; ".ucfirst($name)."</td><td align='center'>$exdgst1<input type=hidden  name=exdgst value=$exdgst></td>";
					
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
							$mdfexrcd++;
							}

							
											}
				

								}
////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////add new course unit to exam regi table//////////////////////////////////////////////
				else{
					echo"<form method=POST action='./index.php?view=admin&admin=47&task=modfyadm&due=register'><tr class=trbgc><td align='center'>$mdfexrcd<td align='center'>".$fulcode."<input type=hidden  name=excosrg value=$cors></td><td>&nbsp;&nbsp; ".ucfirst($name)." <font color=red>[** Not Register to the Examination ]</font></td><td align='center'>$dgst1<input type=hidden  name=dgst value='$dgst1'></td>";

					echo"<td align='center'><select name=cnfstatnew>";
						
						echo"<option value='0'>Not Confirmed</option>";
						echo"<option value='1' selected>Eligible</option>";
						echo"<option value='2'>Not Eligible</option>";
						
					echo"</select></td>";

					echo"<td align='center'><input type='submit' value='Register'></td></tr></form>";
					$mdfexrcd++;
					}



								}
								
									}//$qumdadm1 while
					}
				else{
					echo"<tr class=trbgc><td colspan='6' align='center'><font color='red'>Sorry ! Cannot Find Informations. </font></td></tr>";

					}

			echo"</table>";




				}
	else{
		echo"<br><font color='red'>Sorry!  HS$byaer2/$exstno2 is Invalid Student Number. </font><br>";
		}

}//modfyadm if

echo"</table>";
/////////////444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444
?>










<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>

