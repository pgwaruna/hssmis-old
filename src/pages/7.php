<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){


$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
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
if($qpers['id']=="7"){
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






<script type="text/javascript" src="Ajax/assign.js"></script>



<script>


function upshowamntbx() {

var rgtpval=document.getElementById("upregtp_7").value;

	if(rgtpval=="Limited"){
	document.getElementById("uplmtdno").style.visibility='visible';
			}
	else{
	document.getElementById("uplmtdno").style.visibility='hidden';
		}





}
</script>
<script>
function showgpabx(){

var rgtpval=document.getElementById("modcore").value;

	if(rgtpval=="CO"){
		document.getElementById("gpslbl").style.visibility='hidden';

		document.getElementById("modcostyp").options.length=0;

		var sel = document.getElementById('modcostyp');

		var opt = document.createElement('option');
		opt.appendChild( document.createTextNode('GPA') );
		opt.value = 'GPA';
		sel.appendChild(opt)

			}
	else{
		document.getElementById("gpslbl").style.visibility='visible';
		document.getElementById("modcostyp").options.length=0;

		var sel = document.getElementById('modcostyp');

		var opt = document.createElement('option');
		opt.appendChild( document.createTextNode('GPA') );
		opt.value = 'GPA';
		sel.appendChild(opt)

		var opt1 = document.createElement('option');
		opt1.appendChild( document.createTextNode('NGPA') );
		opt1.value = 'NGPA';
		sel.appendChild(opt1)

		var opt2 = document.createElement('option');
		opt2.appendChild( document.createTextNode('Both (GPA+NGPA)') );
		opt2.value = 'GPA+NGPA';
		sel.appendChild(opt2)



		}

	}


</script>



<script>
function hidelbl() {
	var lblval=document.getElementById("gpslbl").style.visibility='hidden';
					}
</script>




<?php
$gettsk=$_GET['task3'];
if($gettsk!=null){
	$_SESSION['gettsksn']=$gettsk;

}
$task3=$_SESSION['gettsksn'];
//////////////////////////////////////////////////////
///////////// date validation var ////////////////////
//////////////////////////////////////////////////////
//$mdlclsnddate="2018-09-02";
$mdlregofftoup="on";


/*
$mdldvlptoday=date('Y-m-d');

		$date1=date_create("$mdlclsnddate");
		$date2=date_create("$mdldvlptoday");

			$diff=date_diff($date1,$date2);

		$regsta=$diff->format("%R%a days");
//echo$regsta;
if($regsta>0){
	$mdlregofftoup="off";
}
else{
	$mdlregofftoup="on";
}
*/
$task2=$_GET['task2'];

//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////




	$mdlrwno=$_GET['rwid'];
	$role=$_SESSION['role'];
	if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
		$dept="all";
		$department_7=$dept;
		}

	else{
	$department_7=$_SESSION['section'];
		}


	echo "Manage Modules of ".strtoupper($department_7)." Department<hr class=bar><br>";

	if(($task=='addcourse')&&(isset($_POST['submit']))){

	if($dept=="all"){
		$department_7=$_POST['dept'];
				}

	$code_7_sp=$_POST['code_7'];
	$code_7_si=trim($code_7_sp);
	$code_7=strtoupper($code_7_si);

$getchar = preg_split('//', $code_7, -1);

	//$le_7=$getchar[4];
	$sem_71=$getchar[5];

	$credit=$getchar[8];

	$sublvl=$getchar[4];
	/*if($credit=='a'){
		$cre_7=1.5;
			}
	elseif($credit=='b'){
		$cre_7=2.5;
				}

	elseif($credit=='d'){
		$cre_7=1.25;
				}
	else{
		$cre_7=$credit;
		}
*/
	$name_7=$_POST['name_7'];
	//$cre_7=$_POST['cre_7'];
	//$sem_7=$_POST['se_7'];
	$co_7=$_POST['co_7'];
	$getstmvl=$getchar[6];
	if($getstmvl==6){
		$csstrm="Special";
	}
	else{
		$csstrm="General";
	}
	$comdum_7=$_POST['cosmdum'];
	$cotyp_7=$_POST['cotyp_7'];
	$cood_7=$_POST['cood_7'];
		$lec1_7=$_POST['lec1_7'];
		$lec2_7=$_POST['lec2_7'];

		if($lec1_7!="No"){
			$lec1_72="[".$lec1_7."]";
		}

		if($lec2_7!="No"){
			$lec2_72="[".$lec2_7."]";
		}



		if(($lec1_7=="No")&&($lec1_7=="No")){
			$alllects="No";
		}
		else{
			$alllects=$lec1_72.",".$lec2_72;
		}
	//$group_7=$_POST['group_7'];
	$availability_7=$_POST['availability_7'];
	$require_7_1=$_POST['require_7'];


		$require_7_2=$_POST['require_7_2'];
		$require_7_3=$_POST['require_7_3'];


			if($require_7_1!="No"){
				if($require_7_2!="No"){
					if($require_7_3!="No"){
						$require_7=$require_7_1.",".$require_7_2.",".$require_7_3;
					}
					else{
						$require_7=$require_7_1.",".$require_7_2;
					}
				}
				else{
					if($require_7_3!="No"){
						$require_7=$require_7_1.",".$require_7_3;
					}
					else{
						$require_7=$require_7_1;
					}
				}
			}
			else{
				if($require_7_2!="No"){
					if($require_7_3!="No"){
						$require_7=$require_7_2.",".$require_7_3;
					}
					else{
						$require_7=$require_7_2;
					}
				}
				else{
					if($require_7_3!="No"){
						$require_7=$require_7_3;
					}
					else{
						$require_7=$require_7_1;
					}
				}
			}


		//echo$require_7;



	$corgty_7=$_POST['regtp_7'];
	$colmstamt=$_POST['lmtdno'];
		if($corgty_7=="Limited"){
			if($colmstamt!=null){
				$coflrytp=$corgty_7."-".$colmstamt;
								}
			else{
				$coflrytp="Normal";
				}
								}
		else{
			$coflrytp=$corgty_7;
				}
	$curryculm_7=$_POST['curri_7'];

	$getchkbxvl=$_POST['chkbxvl'];
	$getallitmbox=$_POST['allitmbox'];
	//echo$getallitmbox;
	if($getallitmbox=="All"){
		$tgtgrp="All";
	}
	else{

		$tgtgrp=null;
		for($tg=0;$tg<$getchkbxvl;$tg++){
			$vritmboxid="itmbox".$tg;
			$getchksubjct=$_POST[$vritmboxid];
			if($getchksubjct!=null){
				$tgtgrp=$tgtgrp."[".$getchksubjct."],";
			}

		}

	}

	//echo$tgtgrp."<br>";



	//echo$code_7.$name_7.$co_7.$cotyp_7.$coflrytp.$lec_7.$group_7.$department_7.$curryculm_7.$availability_7.$require_7.$colmstamt.$sem_71.$credit;
	// Add Courses

	$query7_5="insert into courseunit(code,name,department,credits,core,stream,medium,course_type,registration_type,semister,coordinator,lecturers,level,target_group,by_low_version,availability,requirement)
	values('$code_7', '$name_7', '$department_7', '$credit', '$co_7','$csstrm','$comdum_7', '$cotyp_7', 'Normal', '$sem_71', '$cood_7','$alllects',$sublvl, '$tgtgrp', '$curryculm_7', '$availability_7', '$require_7_1')";
	//echo$query7_5;

	$usr_add=mysql_query($query7_5);
	if($usr_add){
	echo "<font color=blue>*** Course Unit Successfully Added! ***<br>You can see the Course Unit form following table.</font><br><br>";
	}
	}

	////// Course Modifying Methods //////////////////////

	if($task=='modifycourse'){


	echo "You can Assign Lecturers to course units in this section. <br>Select the Lecturer from drop down list. It is chaged automatically withing few seconds.<br>";
	echo "<br />";
	$code=$_GET['id'];

		if($dept=="all"){
			$department_7=$_GET['codept'];
				}



	echo $code.", to ";
	if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
	$query7_g="select user,l_name,initials from $rmsdb.$facusrvw where section='$department_7' and (role='lecturer' or role='general' or role='topadmin' or role='dssc') order by l_name";
																			}
	else{
	$query7_g="select user,l_name,initials from $rmsdb.$facusrvw where section='$department_7' and (role='lecturer' or role='general' or role='topadmin' or role='dssc') order by l_name";
	}
	$usr_8=mysql_query($query7_g);
	//echo$query7_g;
	echo "<select name=lecturer id=lecturer onchange=lect_select('$code')><option> Select Name </option>";
  	while($data7=mysql_fetch_array($usr_8)){
	echo '<option value="'.$data7['user'].'">'.$data7['initials'].' '.$data7['l_name'].'</option>';
	}
	echo "</select>";
	echo "<img style='visibility: hidden' id='loader' src='images/ajax-loader.gif'><div id=assign></div><br /><br />";

	echo "<hr class=bar><br>";


	}

	////////// Ending of Course Modifying ///////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////

if($task=="rechng"){

	echo"<font color='#330033'><b>Modify Course Unit</b></font>";

$hidmodid=$_POST['hidmodid'];
$hidmodcod=$_POST['hidmodcod'];


$gtmodcos=trim($_POST['modcos']);
$gtmodcosnm=$_POST['modcosnm'];
$gtmodcore=$_POST['modcore'];
$gtmodstrm=$_POST['modstrm'];
$gtmodmdum=$_POST['modcosmdum'];

$gtmodcostyp=$_POST['modcostyp'];
$gtmodsem=$_POST['modsem'];
$gtmodlvl=$_POST['modlvl'];
$gtmodcredvl=$_POST['modcredvl'];
$gtmodcood=$_POST['modlect'];
	$lec1_7=$_POST['lec1_7'];
	$lec2_7=$_POST['lec2_7'];

		if($lec1_7!="No"){
			$lec1_72="[".$lec1_7."]";
		}

		if($lec2_7!="No"){
			$lec2_72="[".$lec2_7."]";
		}



		if(($lec1_7=="No")&&($lec1_7=="No")){
			$alllects="No";
		}
		else{
			$alllects=$lec1_72.",".$lec2_72;
		}



$gtmoddept=$_POST['moddept'];
$gtmodcrrclm=$_POST['upcrrylm'];

	$getchkbxvl=$_POST['chkbxvl'];
	$getallitmbox=$_POST['allitmbox'];
	if($getallitmbox=="All"){
		$tgtgrp="All";
	}
	else{

		$tgtgrp=null;
		for($tg=0;$tg<$getchkbxvl;$tg++){
			$vritmboxid="itmbox".$tg;
			$getchksubjct=$_POST[$vritmboxid];
			if($getchksubjct!=null){
				$tgtgrp=$tgtgrp."[".$getchksubjct."],";
			}

		}

	}



$gtmodprereq=$_POST['modprereq'];
$gtmodavlbl=$_POST['modavle'];

$gtmodcoflrytp="Normal";


/*
$gtmodregtyp=$_POST['upregtp_7'];
	$gtmodmaxstvp=$_POST['uplmtdno'];
	if($gtmodregtyp=="Limited"){
			if($gtmodmaxstvp!=null){
				$gtmodcoflrytp=$gtmodregtyp."-".$gtmodmaxstvp;
								}
			else{
				$gtmodcoflrytp="Normal";
				}
								}
	else{
			$gtmodcoflrytp=$gtmodregtyp;
				}


$gtmodtgtgp=$_POST['modtgtgp'];




	///////////////////////////////////////////////////////
	///////////////////////////////////////////////////////
//$gtmodprereq=$_POST['modprereq'];

		$require_7_2=$_POST['modprereq2'];
		$require_7_3=$_POST['modprereq3'];


			if($require_7_1!="No"){
				if($require_7_2!="No"){
					if($require_7_3!="No"){
						$gtmodprereq=$require_7_1.",".$require_7_2.",".$require_7_3;
					}
					else{
						$gtmodprereq=$require_7_1.",".$require_7_2;
					}
				}
				else{
					if($require_7_3!="No"){
						$gtmodprereq=$require_7_1.",".$require_7_3;
					}
					else{
						$gtmodprereq=$require_7_1;
					}
				}
			}
			else{
				if($require_7_2!="No"){
					if($require_7_3!="No"){
						$gtmodprereq=$require_7_2.",".$require_7_3;
					}
					else{
						$gtmodprereq=$require_7_2;
					}
				}
				else{
					if($require_7_3!="No"){
						$gtmodprereq=$require_7_3;
					}
					else{
						$gtmodprereq=$require_7_1;
					}
				}
			}

*/
		//echo$gtmodprereq;

	///////////////////////////////////////////////////////
	///////////////////////////////////////////////////////
//echo$gtmodcos.$gtmodcosnm.$gtmodcore.$gtmodcostyp.$gtmodsem.$gtmodcredvl.$gtmodregtyp.$gtmodmaxstvp.$gtmodlect.$gtmodtgtgp.$gtmoddept.$gtmodcrrclm.$gtmodavlbl.$gtmodprereq;



if($department_7=="all"){
$queupcousuni="update courseunit set code='$gtmodcos', name='$gtmodcosnm', department='$gtmoddept', credits='$gtmodcredvl', core='$gtmodcore',stream='$gtmodstrm',medium='$gtmodmdum', course_type='$gtmodcostyp',
 registration_type='$gtmodcoflrytp', semister='$gtmodsem',coordinator='$gtmodcood', lecturers='$alllects',level=$gtmodlvl, target_group='$tgtgrp', by_low_version='$gtmodcrrclm', availability='$gtmodavlbl', requirement='$gtmodprereq' where id=$hidmodid and code='$hidmodcod'";
}
else{
$queupcousuni="update courseunit set code='$gtmodcos', name='$gtmodcosnm', department='$gtmoddept', credits='$gtmodcredvl', core='$gtmodcore',stream='$gtmodstrm',medium='$gtmodmdum', course_type='$gtmodcostyp',
 registration_type='$gtmodcoflrytp', semister='$gtmodsem',coordinator='$gtmodcood', lecturers='$alllects',level=$gtmodlvl, target_group='$tgtgrp', by_low_version='$gtmodcrrclm', availability='$gtmodavlbl', requirement='$gtmodprereq' where id=$hidmodid and code='$hidmodcod' and department='$department_7'";
}

 //echo$queupcousuni;

$quupcousuni=mysql_query($queupcousuni);

if($quupcousuni){
	echo "<br><br><font color=blue>*** Course Unit Successfully Updated! ***</font><br>";
	}
	else{
		echo"<br><font color=red>Sorry! Can't modify</font><br>";
	}
			if($_SESSION['vwalsemmdl']=="set"){
				$task2="almdls";
			}

				}



////////////////////////////////////////////////////////////////////////////////////////////////////////




	///////////// Removing Courses from department

	elseif($task=='chngoption'){
		if($getdue!="vw"){
			echo "<font color='#330033'><b>Modify Course Unit</b></font>";
			echo "<br />";
		}
		else{
			echo "<font color='#330033'><b>Course Unit Details</b></font>";
		}
	$code=$_GET['id'];
	$dept=$_GET['dept'];

		//echo$code;


////////////////////////////////////////edit by iranga////////////////////////////////////////
		if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
		$quechngcos="select * from courseunit where id=$mdlrwno and  code='$code'";
																			}
		else{
		$quechngcos="select * from courseunit where id=$mdlrwno and code='$code' and department='$department_7'";
		}
		//echo$quechngcos;
		$quchngcos=mysql_query($quechngcos);
		if(mysql_num_rows($quchngcos)==0){
			echo"<font color=red>You have no permission to access this area! </font><br>";
											}
		else{
		while($qchngcos=mysql_fetch_array($quchngcos)){
						$upid=$qchngcos['id'];
						$uptemdiscos=strtoupper($qchngcos['code']);
						$upname=ucfirst($qchngcos['name']);
						$updepartment=$qchngcos['department'];
						$upcredits=$qchngcos['credits'];
						$upcore=$qchngcos['core'];
						$upstrm=$qchngcos['stream'];
						$upmdim=$qchngcos['medium'];

						$upcourse_type=$qchngcos['course_type'];
						$upregistration_type=$qchngcos['registration_type'];
							if($upregistration_type!="Normal"){
									$gtmaxstamt=explode("-",$upregistration_type);
										$maxstamt=$gtmaxstamt[1];
																}


						$upsemester=$qchngcos['semister'];
						$uplevel=$qchngcos['level'];
						$upcoordinator=$qchngcos['coordinator'];
							$uplecturers=$qchngcos['lecturers'];
						/////////////////////////////////////////////////////////////////
						$getflplst4lec=substr_count($uplecturers,",");

								$divdtgtsub4lec=explode(",",$uplecturers);
								$tggpar4lec=array();
								for($rn4lc=0;$rn4lc<=$getflplst4lec;$rn4lc++){
									$tggpar4lec[$rn4lc]=$divdtgtsub4lec[$rn4lc];

								}

						/////////////////////////////////////////////////////////////////
						$uptarget_group=$qchngcos['target_group'];
						$upby_low_version=$qchngcos['by_low_version'];

						$upavailability=$qchngcos['availability'];
									if($upavailability==1){
										$updavailability="Avaliable";
														}
									elseif($upavailability==2){
										$updavailability="<font color=blue>Not Avaliable only for this Semester</forn>";
															}
									else{
										$updavailability="<font color=red>Total Remove</font>";
											}
						$uprequirement=$qchngcos['requirement'];
							if($uprequirement!="No"){
								$getprecods=explode(",",$uprequirement);
									$uprequirement1=$getprecods[0];
									$uprequirement2=$getprecods[1];
									$uprequirement3=$getprecods[2];
							}


								}
		//echo$code.$name.$department.$credits.$core.$semister.$lecture.$level.$target_group.$availability.$requirment;

		if($getdue!="vw"){
			echo"<table border=0 width=98%>";
			echo"<form method=POST action='./index.php?view=admin&admin=7&task=rechng'>";
		}
		else{
			echo"<table border=0 width=98% class=logbox>";
		}

			echo"<tr class='trbgc'><td width=18%><font color='#800000'>Course Unit Code</font> <td width=32%>: <input type=text name='modcos' value='$uptemdiscos' size=10 required><input type=hidden value='$uptemdiscos' name=hidmodcod><input type=hidden value='$upid' name=hidmodid>";
			echo"&nbsp;	&nbsp;In&nbsp;&nbsp;";
			echo"<select name=modcosmdum>";
				if($upmdim==null){
					echo"<option value='' selected>...</option>";
					echo"<option value='SI' >Sinhala</option>";
					echo"<option value='EN'>English</option>";
					echo"<option value='SI+EN'>Sinhala & English</option>";

				}
				elseif($upmdim=="SI"){
					echo"<option value='SI' selected>Sinhala</option>";
					echo"<option value='EN'>English</option>";
					echo"<option value='SI+EN'>Sinhala & English</option>";

				}
				elseif($upmdim=="EN"){
					echo"<option value='SI'>Sinhala</option>";
					echo"<option value='EN'selected>English</option>";
					echo"<option value='SI+EN'>Sinhala & English</option>";

				}
				elseif($upmdim=="SI+EN"){
					echo"<option value='SI'>Sinhala</option>";
					echo"<option value='EN'>English</option>";
					echo"<option value='SI+EN'selected>Sinhala & English</option>";

				}
				else{
					echo"<option value='SI' selected>Sinhala</option>";
					echo"<option value='EN'>English</option>";
					echo"<option value='SI+EN'>Sinhala & English</option>";
				}

			echo"</select>&nbsp;&nbsp; Medium";



			echo"<td width=18%><font color='#800000'>Course Unit Name</font> <td width=32%>: <input type=text name='modcosnm' value='$upname' size=45 required></tr>";


			echo"<tr class='trbgc'><td><font color='#800000'>Course Unit Core</font> <td>: ";
			echo"<select name=modcore id=modcore'>";
				if($upcore=="co"){
						echo'<option value="co" selected="selected">Compulsory Course Unit</option>';
						echo'<option value="op">Optional Course Unit</option>';
						echo'<option value="nd">No Credits Compulsory Course</option>';
						echo'<option value="nn">No Credits Other Course</option>';
									}
				elseif($upcore=="op"){
						echo'<option value="co">Compulsory Course Unit</option>';
						echo'<option value="op" selected="selected">Optional Course Unit</option>';
						echo'<option value="nd">No Credits Compulsory Course</option>';
						echo'<option value="nn">No Credits Other Course</option>';
										}
				elseif($upcore=="nd"){
						echo'<option value="co">Compulsory Course Unit</option>';
						echo'<option value="op">Optional Course Unit</option>';
						echo'<option value="nd" selected="selected">No Credits Compulsory Course</option>';
						echo'<option value="nn">No Credits Other Course</option>';
										}
				elseif($upcore=="nn"){
						echo'<option value="co">Compulsory Course Unit</option>';
						echo'<option value="op">Optional Course Unit</option>';
						echo'<option value="nd">No Credits Compulsory Course</option>';
						echo'<option value="nn" selected="selected">No Credits Other Course</option>';
									}
				else{
						echo'<option value="co" selected="selected">Compulsory Course Unit</option>';
						echo'<option value="op">Optional Course Unit</option>';
						echo'<option value="nd">No Credits Compulsory Course</option>';
						echo'<option value="nn">No Credits Other Course</option>';
						}

			echo"</select>";
			echo"<td><font color='#800000'> Course Unit Type</font> <td>: ";
			echo"<select name=modcostyp id=modcostyp>";

						if($upcourse_type=="Theory"){
							echo'<option value="Theory" selected="selected">Theory</option>';
							echo'<option value="Practical">Practical</option>';
							echo'<option value="Th+Pr">Both (Theory/Practical)</option>';
							echo'<option value="Other">Other</option>';
														}
						else if($upcourse_type=="Practical"){
							echo'<option value="Theory">Theory</option>';
							echo'<option value="Practical" selected="selected">Practical</option>';
							echo'<option value="Th+Pr">Both (Theory/Practical)</option>';
							echo'<option value="Other">Other</option>';
									}
						else if($upcourse_type=="Th+Pr"){
							echo'<option value="Theory">Theory</option>';
							echo'<option value="Practical">Practical</option>';
							echo'<option value="Th+Pr" selected="selected">Both (Theory/Practical)</option>';
							echo'<option value="Other">Other</option>';

							}
						else if($upcourse_type=="Other"){
							echo'<option value="Theory">Theory</option>';
							echo'<option value="Practical">Practical</option>';
							echo'<option value="Th+Pr">Both (Theory/Practical)</option>';
							echo'<option value="Other" selected="selected">Other</option>';

							}
						else{
							echo'<option value="Theory" selected="selected">Theory</option>';
							echo'<option value="Practical">Practical</option>';
							echo'<option value="Th+Pr">Both (Theory/Practical)</option>';
							echo'<option value="Other">Other</option>';

							}

					echo"</select></tr>";

			echo"<tr class='trbgc'><td><font color='#800000'>Semester</font> <td>: ";
				echo'<span id="number1">';
				echo"<input type=text name=modsem value=$upsemester required size=2>";
					echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid Number</font></span>';
				echo'</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

			echo"<font color='#800000'>Level</font>&nbsp;&nbsp;: <input type=text name=modlvl value='$uplevel' required size=1 style='text-align:right;'>000";
				echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color='#800000'>Stream</font> : ";
				echo"<select name=modstrm id=modstrm'>";
				if($upstrm=="General"){
					echo'<option value="General" selected>General</option>';
					echo'<option value="Special">Special</option>';
				}
				else{
					echo'<option value="General">General</option>';
					echo'<option value="Special" selected>Special</option>';
				}

				echo"</select>";


			echo"<td><font color='#800000'>Credits </font><td>: <input type=text name='modcredvl' value='$upcredits' size=4 required></tr>";


			/*echo"<tr class='trbgc'><td><font color='#800000'>No of Students</font> <td>: ";
					if($upregistration_type!="Normal"){
								echo'<select name="upregtp_7" onchange="upshowamntbx()" id="upregtp_7">';
									echo'<option value="Normal" >Normal</option>';
									echo'<option value="Limited" selected>Limited</option>';
								echo'</select>';
								//echo'<span id="number3">';
								echo"<input type=text name=uplmtdno id=uplmtdno size=6 value=$maxstamt style='visibility: show'  >";
								//	echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid Number</font></span>';
								//echo'</span>';
														}
					else{
								echo'<select name="upregtp_7" onchange="upshowamntbx()" id="upregtp_7">';
									echo'<option value="Normal" selected >Normal</option>';
									echo'<option value="Limited" >Limited</option>';
								echo'</select>';
								//echo'<span id="number3">';
								echo"<input type=text name=uplmtdno id=uplmtdno size=6  style='visibility: hidden' Placeholder=Amount >";
								//	echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid Number</font></span>';
								//echo'</span>';
					}*/
			echo"<tr class='trbgc'><td><font color='#800000'>Coordinator </font><td>: ";
//				$quegtlec="select user,l_name,initials from $rmsdb.fohssmis where (role='lecturer' or role='general' or role='topadmin' or role='dssc') and section='$dept' order by l_name";
				$quegtlec="select user,l_name,initials from $rmsdb.fohssmis where (role='lecturer' or role='general' or role='topadmin' or role='dssc') order by l_name";
				//echo$quegtlec;
			echo"<select name=modlect>";
									echo"<option value='Add Here'>Add Here</option>";

						$qugtlec=mysql_query($quegtlec);
							while($qgtlec=mysql_fetch_array($qugtlec)){
								$lecuname=$qgtlec['user'];
								$leclname=$qgtlec['l_name'];
								$leciniti=$qgtlec['initials'];

									if($lecuname==$upcoordinator){
										echo"<option value=$upcoordinator selected>$leciniti ".ucfirst($leclname)." </option>";
												}
									else{

										echo"<option value='$lecuname'>$leciniti ".ucfirst($leclname)."</option>";
										}
													}

					echo"</select>";
					echo '<td><font color="#800000">Lecturers  </font><td>: ';

					$usr_92=mysql_query($quegtlec);

						echo "<select name=lec1_7>";
						echo"<option value='No'>No</option>";
						while($data82=mysql_fetch_array($usr_92)){
							$lec1="[".$data82['user']."]";
							if (in_array($lec1, $tggpar4lec)){
								echo '<option value="'.$data82['user'].'" selected>'.$data82['l_name'].' '.$data82['initials'].'</option>';
								$currnttchr=$lec1;
							}
							else{
								echo '<option value="'.$data82['user'].'">'.$data82['l_name'].' '.$data82['initials'].'</option>';
							}
						}
						echo "</select>";

						$usr_923=mysql_query($quegtlec);
						echo "<br>:&nbsp;<select name=lec2_7>";
						echo"<option value='No'>No</option>";
						while($data823=mysql_fetch_array($usr_923)){
							$lec2="[".$data823['user']."]";
							if($lec2!=$currnttchr){
							if (in_array($lec2, $tggpar4lec)){
								echo '<option value="'.$data823['user'].'" selected>'.$data823['l_name'].' '.$data823['initials'].'</option>';
							}
							else{
								echo '<option value="'.$data823['user'].'">'.$data823['l_name'].' '.$data823['initials'].'</option>';
							}
							}
							else{
								echo '<option value="'.$data823['user'].'">'.$data823['l_name'].' '.$data823['initials'].'</option>';
							}

						}
						echo "</select>";


			echo"<tr class='trbgc'><td><font color='#800000'>Offering Department</font><td>:";
			echo"<select name=moddept>";

					if(($_SESSION['role']=="administrator")||($_SESSION['role']=="topadmin")||($_SESSION['role']=="sar")){
						$quegtdept="select distinct(dept_name),dept_code from department where status=1 order by dept_name";
						$qugtdept=mysql_query($quegtdept);
							while($qgtdept=mysql_fetch_array($qugtdept)){
								$gtdept=$qgtdept['dept_name'];
								$deptcd=$qgtdept['dept_code'];
									if($deptcd==$updepartment){
										echo"<option value='$deptcd' selected>".strtoupper($gtdept)."</option>";
													}
									else{
										echo"<option value='$deptcd'>".strtoupper($gtdept)."</option>";
										}

													}
																								}
					else{
									echo"<option value='$updepartment' selected>".strtoupper($updepartment)."</option>";
							}





					echo"</select>";

			echo"<td><font color='#800000'>Curriculum </font><td>: ";
			echo"<select name=upcrrylm>";

			/////////////////////////////////////////////////////////////////////////////
			$quegetcrry="select * from  curriculum  order by cr_id DESC";
			$qugetcrry=mysql_query($quegetcrry);
			if(mysql_num_rows($qugetcrry)!=0){
				while($qgetcrry=mysql_fetch_array($qugetcrry)){
					$getcrryvalue=$qgetcrry['cr_value'];
					$getcrryname=$qgetcrry['cr_name'];
					if($getcrryvalue==$upby_low_version){
						echo"<option value=$getcrryvalue selected>$getcrryname</option>";
					}
					else{
						echo"<option value=$getcrryvalue>$getcrryname</option>";
					}


				}
			}
			echo"</select>";
			/////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	echo '<tr class="trbgc" height="30px"align=center><td colspan=4 ><font color="#800000"><br>Relevent subject/(s) for '.$uptemdiscos.'</font><br> ';
	$quegetmnsub="select * from main_subjects where status=1 order by sub_name";
	$qugetmnsub=mysql_query($quegetmnsub);
	if(mysql_num_rows($qugetmnsub)!=0){
		$subtblid=0;
		echo"<table width=100% border=0>";
	while($qgetmnsub=mysql_fetch_array($qugetmnsub)){
		$getmnsub=$qgetmnsub['sub_name'];
		$getmnsubid=$qgetmnsub['sub_id'];
			$setgetmnsubid="[".$getmnsubid."]";

		$dv=fmod($subtblid,4);
		if($dv==0){
			echo"<tr align=center valign=top><td width=20%>";
		}
		else{
			echo"<td width=20%>";
		}
		$getflplst=substr_count($uptarget_group,",");

		$divdtgtsub=explode(",",$uptarget_group);
		$tggpar=array();
		for($rn=0;$rn<$getflplst;$rn++){
			$tggpar[$rn]=$divdtgtsub[$rn];

		}
		if (in_array($setgetmnsubid, $tggpar)){

				echo"<label><table><tr class=selectbg><td><input type=checkbox name=itmbox$subtblid id=itmbox$subtblid value=$getmnsubid checked><td>".ucfirst($getmnsub)."</table></label>";

			}
			else{
				echo"<label><table><tr><td><input type=checkbox name=itmbox$subtblid id=itmbox$subtblid value=$getmnsubid><td>".ucfirst($getmnsub)."</table></label>";
			}
						$subtblid++;
	}
	$dv2=fmod($subtblid,4);
			if($dv2==0){
			echo"<tr align=center valign=top><td width=20%>";
		}
		else{
			echo"<td width=20%>";
		}

	if($uptarget_group=="All"){
	echo"<label><table><tr class=selectbg><td><input type=checkbox name=allitmbox id=allitmbox value='All' checked><td><B>ALL SUBJECTS</B></table></label>";
	}
	else{
	echo"<label><table><tr><td><input type=checkbox name=allitmbox id=allitmbox value='All'><td><B>ALL SUBJECTS</B></table></label>";
	}


	echo"</table>";
	echo"<input type=hidden name=chkbxvl value=$subtblid>";
	}
	else{
		echo"Sorry! Can not find main subjects. Contact administrator.";
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







			echo"<tr class='trbgc'><td><font color='#800000'>Pre Requisites </font><td >: ";
			if($uprequirement=="No"){
				echo"No Pre Requisites, If change please";
										}
			else{
				//echo"If Pre Requisites change please";
				}
			////////////////////////////////////////////////// 1 //////////////////////////////////////////////////////
			echo"<select  name='modprereq'>";
			if($uprequirement=="No"){
				echo"<option value='No'>Select Course Unit</option>";
										}
			else{
				echo"<option value='No'>No Pre Requisites</option>";
				}


				/*if($department_7!="all"){

						$quegetprrqes="select code from courseunit where department='$department_7' and code<>'$code' and availability<>0  order by code";
													}
				else{
						$quegetprrqes="select code from courseunit where code<>'$code' order by department,code";
											}*/
								$quegetprrqes="select distinct c.code, c.by_low_version,cr.cr_code  from courseunit c,curriculum cr where c.availability<>0 and c.by_low_version=cr.cr_value order by c.department,c.code";
								$qugetprrqes=mysql_query($quegetprrqes);
								//echo"<option>$quegetprrqes</option>";
								while($qgetprrqes=mysql_fetch_array($qugetprrqes)){
										$getprrqes=$qgetprrqes['code'];
										$getprrqescdcrry=$qgetprrqes['by_low_version'];
										$getprrqescdcrry_code=$qgetprrqes['cr_code'];

													$crculm=$getprrqescdcrry_code;
										if($uprequirement1==$getprrqes){
											echo"<option value='$getprrqes' selected>".strtoupper($getprrqes)." - (".$crculm.")</option>";
																		}
										else{
											echo"<option value='$getprrqes'>".strtoupper($getprrqes)." - (".$crculm.")</option>";
										}
																							}

			echo"</select>";
			////////////////////////////////////////////////// 1 //////////////////////////////////////////////////////









			echo"<td><font color='#800000'>Availability </font><td>: ";
			echo"<select name=modavle>";
						if($upavailability==1){
							echo"<option value=1 selected>Available</option>";
							echo"<option value=2>Not Available only for this Semester</option>";
							echo"<option value=0 >Total Remove</option>";
									}
						elseif($upavailability==2){
							echo"<option value=1 >Available</option>";
							echo"<option value=2 selected>Not Available only for this Semester</option>";
							echo"<option value=0 >Total Remove</option>";
							}
						elseif($upavailability==0){
							echo"<option value=1 >Available</option>";
							echo"<option value=2 >Not Available only for this Semester</option>";
							echo"<option value=0 selected>Total Remove</option>";
							}
						else{
							echo"<option value=1 >Available</option>";
							echo"<option value=2 >Not Available only for this Semester</option>";
							echo"<option value=0 >Total Remove</option>";
						}
					echo"</select></tr>";












			if($getdue!="vw"){
					echo"<tr class='trbgc'><td colspan=4 align='center'><input type=submit value='Update $uptemdiscos  Course Unit'></form>";
			}
			echo"</table>";

			if($_SESSION['vwalsemmdl']=="set"){
				$task2="almdls";
			}


}


//////////////////////////////////////////////////////////////////////////////////////////////



	}
	////// add new course units
	else{
		if($dept=="all"){
			include 'forms/form_7.php';
		}
		else{
		if($mdlregofftoup=="on"){
			include 'forms/form_7.php';
			}
		}
	}
	//////// ending form




	//Grouping Courses



	/* Problem occured
	//$department_7='computerscience';
	Corrected Success...
	*/
	if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
		$dept="all";
		$department_7=$dept;
		}

   	echo "<br><br><br><b><center>Course Unit Summery</center></b>";

if($task2=="almdls"){
	$_SESSION['vwalsemmdl']="set";
}
else{
	$_SESSION['vwalsemmdl']="notset";
}


	/*
	if($_SESSION['vwalsemmdl']=="set"){
		echo"<br><a href='./index.php?view=admin&admin=7&task=vwsemmd'>Click here to view current semesters course units</a><br><br>";
			}
	else{
		echo"<br><a href='./index.php?view=admin&admin=7&task=vwsemmd&task2=almdls'>Click here to view all course units</a><br><br>";
			}
	*/


	echo"<table width=80%><tr align=center class=trbgc height=30px><th colspan=2>Level 1000 <th colspan=2>Level 2000 <th colspan=2>Level 3000 <th colspan=2>Level 4000 ";

	echo"<tr align=center class=trbgc height=30px>";
	echo"<td><a href='./index.php?view=admin&admin=7&task3=vwsemmd&semmd=1&mdlvl=1'>Semester I</a>";
	echo"<td><a href='./index.php?view=admin&admin=7&task3=vwsemmd&semmd=2&mdlvl=1'>Semester II</a>";

	echo"<td><a href='./index.php?view=admin&admin=7&task3=vwsemmd&semmd=1&mdlvl=2'>Semester I</a>";
	echo"<td><a href='./index.php?view=admin&admin=7&task3=vwsemmd&semmd=2&mdlvl=2'>Semester II</a>";

	echo"<td><a href='./index.php?view=admin&admin=7&task3=vwsemmd&semmd=1&mdlvl=3'>Semester I</a>";
	echo"<td><a href='./index.php?view=admin&admin=7&task3=vwsemmd&semmd=2&mdlvl=3'>Semester II</a>";

	echo"<td><a href='./index.php?view=admin&admin=7&task3=vwsemmd&semmd=1&mdlvl=4'>Semester I</a>";
	echo"<td><a href='./index.php?view=admin&admin=7&task3=vwsemmd&semmd=2&mdlvl=4'>Semester II</a>";

	echo"</table><br><br>";



if($task3=="vwsemmd"){
	$shwsem=$_GET['semmd'];
	$shwlvl=$_GET['mdlvl'];
		if(($shwsem!=null)&&($shwlvl!=null)){
			$_SESSION['getsem']=$shwsem;
			$_SESSION['getlvl']=$shwlvl;
		}
		$shwsem2=$_SESSION['getsem'];
		$shwlvl2=$_SESSION['getlvl'];



echo '<br><b><center>Summery of Level '.$shwlvl2.'000 and Semester '.$shwsem2.'</center></b>';



	if($task2=="almdls"){
		if($dept!="all"){
		$query7_2="select c.*,cr.cr_name from courseunit c,curriculum cr where c.department='$department_7' and  and c.availability<>0 and c.by_low_version=cr.cr_value  order by c.code";
			}
		else{
		$query7_2="select c.*,cr.cr_name from courseunit c,curriculum cr where c.by_low_version=cr.cr_value  order by c.department,c.code";
		}
		$_SESSION['vwalsemmdl']="set";
	}
	else{
	if($dept!="all"){
		$query7_2="select c.*,cr.cr_name from courseunit c,curriculum cr where c.department='$department_7' and c.availability<>0 and c.semister=$shwsem2 and c.level=$shwlvl2 and c.by_low_version=cr.cr_value  order by c.semister,c.code";
			}
	else{
		$query7_2="select c.*,cr.cr_name from courseunit c,curriculum cr where c.semister=$shwsem2 and c.level=$shwlvl2 and c.by_low_version=cr.cr_value  order by c.department,c.semister,c.code";
		}
		$_SESSION['vwalsemmdl']="notset";
	}
	$course_details=mysql_query($query7_2);

	$cuno=1;
//echo$query7_2;
	if($dept!="all"){
echo '<table border="0" align="center" ><tr><th>No<th>Course Unit<th>Medium<th>Course Unit Name<th>Course Unit Name<th>Core<th>Level<th>Semester<th>Registration Type<th>Credits<th>Target Group <th>Curriculum <th>Availability ';
		if($mdlregofftoup=="on"){
			echo"<th>Modify";
					}
echo"</tr>";

		if(mysql_num_rows($course_details)==0){
			echo "<tr class=trbgc><td align=center colspan=13>Sorry! Can not find any Course Unit</tr>";
		}
		else{
		while($data=mysql_fetch_array($course_details)){
				$mldrwid=$data['id'];
				$disaltemdiscos=$data['code'];
				$disalfulcode=strtoupper(trim($disaltemdiscos));
                $disalname=$data['name']; // course unit name
				$disalmdum=$data['medium'];
				$disaldept=$data['department'];
				$disallect=$data['lecture'];
				$disalcore=$data['core'];
				$disalsem=$data['semister'];
				$disdeptlvl=$data['level'];
				$disalcdt=$data['credits'];
				$disalcotype=$data['course_type'];
				$disalcorgty=$data['registration_type'];
				$disaltarget_group=$data['target_group'];

				$disalbylwvrs2=$data['by_low_version'];
					$disalbylwvrs=$data['cr_name'];
				/*
					if($disalbylwvrs2==1){
						$disalbylwvrs="New Curriculum";
											}
					elseif($disalbylwvrs2==0){
						$disalbylwvrs="Old Curriculum";
												}
					else{
						$disalbylwvrs="Past Curriculum";
						}
					*/
				$disalavlbl=$data['availability'];
						if($disalavlbl==1){
							$disalavlblsts="Avaliable";
											}
						elseif($disalavlbl==2){
							$disalavlblsts="<font color=blue>Not Avaliable for this Semester</forn>";
												}
						else{
							$disalavlblsts="<font color=red>Total Remove</font>";
								}

	echo "<tr class=trbgc><td align=center>$cuno<td align=center><a href=?view=admin&admin=7&task=chngoption&due=vw&id=".$disaltemdiscos."&dept=".$disaldept."&rwid=".$mldrwid.">".$disalfulcode."</a>";
	echo "<td align=center>".strtoupper($disalmdum);
	echo "<td align=center>".strtoupper($disaldept);
//	echo "<td align=center><a href=?view=admin&admin=7&task=modifycourse&id=".$disaltemdiscos."&codept=$disaldept>".$disallect."</a>";
    echo "<td align=center>$disalname";
	echo "<td align=center>$disalcore";
	echo "<td align=center>$disalcotype";

	echo "<td align=center>".$disdeptlvl."000";
	echo "<td align=center>$disalsem";
	echo "<td align=center>$disalcdt";
	//echo "<td align=center>$disalcotype";
	//echo "<td align=center>$depttggpname";

	//echo "<td align=center>$disalcorgty";
	echo "<td align=center>$disaltarget_group";
	echo "<td align=center>$disalbylwvrs";
	echo "<td align=center>$disalavlblsts";

		if($mdlregofftoup=="on"){
			echo"<td align=center><a href=?view=admin&admin=7&task=chngoption&id=".$disaltemdiscos."&dept=".$disaldept."&rwid=".$mldrwid.">Modify[$disalfulcode]<a/>";
		}
	echo"</tr>"	;

	$cuno++;
	}
	}
	echo "</table>";
			}

///////////////////////////////////////////////////////////////////////////////////////////////
	else{


echo '<table border="0" align="center" ><tr><th>#<th>Course Unit<th>Medium<th>Department<th>Course Unit Name<th>Core <th>Registration Type <th>Level<th>Semester<th>Credits  <th>Target Group<th>Curriculum <th>Availability ';
	//if($mdlregofftoup=="on"){
			echo"<th>Modify";
	//				}
echo"</tr>";
		while($data=mysql_fetch_array($course_details)){
				$mldrwid=$data['id'];
				$disaltemdiscos=$data['code'];
				$disalfulcode=strtoupper(trim($disaltemdiscos));
                $disalname=$data['name']; // course unit name
				$disalmdum=$data['medium'];
				$disaldept=$data['department'];
				$disallect=$data['lecture'];
				$disalcore=$data['core'];
				$disalsem=$data['semister'];
				$disdeptlvl=$data['level'];
				$disalcdt=$data['credits'];
				$disalcotype=$data['course_type'];
				$disalcorgty=$data['registration_type'];
				$disaltarget_group=$data['target_group'];

				$disalbylwvrs2=$data['by_low_version'];
					$disalbylwvrs=$data['cr_name'];
				/*
					if($disalbylwvrs2==1){
						$disalbylwvrs="New Curriculum";
											}
					elseif($disalbylwvrs2==0){
						$disalbylwvrs="Old Curriculum";
												}
					else{
						$disalbylwvrs="Past Curriculum";
						}
					*/
				$disalavlbl=$data['availability'];
						if($disalavlbl==1){
							$disalavlblsts="Avaliable";
											}
						elseif($disalavlbl==2){
							$disalavlblsts="<font color=blue>Not Avaliable for this Semester</forn>";
												}
						else{
							$disalavlblsts="<font color=red>Total Remove</font>";
								}

	echo "<tr class=trbgc><td align=center>$cuno<td align=center><a href=?view=admin&admin=7&task=chngoption&due=vw&id=".$disaltemdiscos."&dept=".$disaldept."&rwid=".$mldrwid.">".$disalfulcode."</a>";

	echo "<td align=center>".strtoupper($disalmdum);

	echo "<td align=center>".strtoupper($disaldept);
//	echo "<td align=center><a href=?view=admin&admin=7&task=modifycourse&id=".$disaltemdiscos."&codept=$disaldept>".$disallect."</a>";
	echo "<td align=center>$disalname";
	echo "<td align=center>$disalcore";
	echo "<td align=center>$disalcotype";

	echo "<td align=center>".$disdeptlvl."000";
	echo "<td align=center>$disalsem";
	echo "<td align=center>$disalcdt";
	//echo "<td align=center>$disalcotype";
	//echo "<td align=center>$depttggpname";

	//echo "<td align=center>$disalcorgty";
	echo "<td align=center>$disaltarget_group";
	echo "<td align=center>$disalbylwvrs";
	echo "<td align=center>$disalavlblsts";


		echo"<td align=center><a href=?view=admin&admin=7&task=chngoption&id=".$disaltemdiscos."&dept=".$disaldept."&rwid=".$mldrwid.">Modify[$disalfulcode]<a/>";

	echo"</tr>"	;
	$cuno++;
	}
	echo "</table>";

		}
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
