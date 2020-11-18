<script type="text/javascript" src="Ajax/assign.js"></script>

<?php
include'./admin/config.php';	
	$con7=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
	
	$role=$_SESSION['role'];
	if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
		$dept="all";
		$department_7=$dept;
		}

	else{
	$department_7=$_SESSION['section'];
		}


	echo "Manage Course Units of ".strtoupper($department_7)." Department<hr class=bar><br>";
						
	if(($task=='addcourse')&&(isset($_POST['submit']))){
	
	if($dept=="all"){
		$department_7=$_POST['dept'];
				}

	$code_7_sp=$_POST['code_7'];
	$code_7_si=trim($code_7_sp);
	$code_7=strtolower($code_7_si);

$getchar = preg_split('//', $code_7, -1);

	$le_7=$getchar[4];
	/*$sem_71=$getchar[5];
		if($sem_71=='b'){	
			$sem_7=3;
				}
		else{
			$sem_7=$sem_71;
			}*/
	$credit=$getchar[7];
	if($credit=='a'){
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

	$name_7=$_POST['name_7'];
	//$cre_7=$_POST['cre_7'];
	$sem_7=$_POST['se_7'];
	$co_7=$_POST['co_7'];
	$cotyp_7=$_POST['cotyp_7'];
	$lec_7=$_POST['lec_7'];
	//$le_7=$_POST['le_7'];
	$group_7=$_POST['group_7'];
	$availability_7=$_POST['availability_7'];
	$require_7=$_POST['require_7'];
						
	
					
	// Add Courses
			
	$query7_5="insert into courseunit values('$code_7_si','$name_7','$department_7','$cre_7','$co_7','$cotyp_7','$sem_7','$lec_7','$le_7','$group_7','$availability_7','$require_7')";
	//echo$query7_5;

	$usr_add=mysql_query($query7_5);
	if($usr_add){
	echo "<font color=red>Course Added Successfully!</font>";
	}
	}
						
	////// Course Modifying Methods //////////////////////
				
	if($task=='modifycourse'){
				
						
	echo "<h3>You can Assign / Remove Lecturers to course units in this section. <br>Select the Lecturer from drop down list. It is chaged automatically withing few seconds.</h3>";
	echo "<br />";
	$code=$_GET['id'];
		if($dept=="all"){
			$department_7=$_GET['codept'];
				}



	echo $code.", to ";
	$query7_g="select user,l_name,initials from $rmsdb.fohssmis where section='$department_7' and (role='lecturer' or role='general' or role='topadmin' or role='dssc') order by l_name";
	$usr_8=mysql_query($query7_g);
	
	echo "<select name=lecturer id=lecturer onchange=lect_select('$code')><option> Select Name </option>";
  	while($data7=mysql_fetch_array($usr_8)){
	echo '<option value="'.$data7['user'].'">'.$data7['l_name'].' '.$data7['initials'].'</option>';
	}			
	echo "</select>";
	echo "<img style='visibility: hidden' id='loader' src='images/ajax-loader.gif'><div id=assign></div><br /><br />";
	
	echo "<hr class=bar><br>";
						
						
	}
	
	////////// Ending of Course Modifying ///////////////
						
//////////////////////////////////////////////////////////////////////////////////////////////////////

if($task=="rechng"){

	echo"<font color='#330033'><b>Modify Course Unit</b></font>";	

$hidmodcod=$_POST['hidmodcod'];

	
$gtmodcos=$_POST['modcos'];
$gtmodcos2=trim($gtmodcos);

$gtmodcosnm=$_POST['modcosnm'];
$gtmoddept=$_POST['moddept'];
$gtmodcredvl=$_POST['modcredvl'];
$gtmodcore=$_POST['modcore'];
$gtmodcostyp=$_POST['modcostyp'];
$gtmodsem=$_POST['modsem'];
$gtmodlvl=$_POST['modlvl'];
$gtmodlect=$_POST['modlect'];
$gtmodtgtgp=$_POST['modtgtgp'];
$gtmodavle=$_POST['modavle'];
$gtmodprereq=$_POST['modprereq'];


//echo$hidmodcod.$gtmodcos2.$gtmodcosnm.$gtmoddept.$gtmodcredvl.$gtmodcore.$gtmodsem.$gtmodlvl.$gtmodlect.$gtmodtgtgp.$gtmodavle.$gtmodprereq;
	
	$queupcousuni="update courseunit set code='$gtmodcos2', name='$gtmodcosnm', department='$gtmoddept', credits='$gtmodcredvl', core='$gtmodcore', type='$gtmodcostyp', semister='$gtmodsem', lecture='$gtmodlect', level='$gtmodlvl', target_group='$gtmodtgtgp', availability='$gtmodavle', requirment='$gtmodprereq' where  code='$hidmodcod'";
	//echo$queupcousuni;	
	$quupcousuni=mysql_query($queupcousuni);


	echo"<br><h3>Updated Successfully !</h3>";
 
				}



////////////////////////////////////////////////////////////////////////////////////////////////////////						
						
						
	

	///////////// Removing Courses from department

	elseif($task=='chngoption'){
	echo "<font color='#330033'><b>Modify Course Unit</b></font>";
	echo "<br />";
	
	$code=$_GET['id'];
	$dept=$_GET['dept'];
	$con7=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
		//echo$code;

		
////////////////////////////////////////edit by iranga////////////////////////////////////////
		$quechngcos="select * from courseunit where code='$code'";
		$quchngcos=mysql_query($quechngcos);
		while($qchngcos=mysql_fetch_array($quchngcos)){
				$code=$qchngcos['code'];
				$name=$qchngcos['name'];
				$department=$qchngcos['department'];
				$credits=$qchngcos['credits'];
				$core=$qchngcos['core'];
				$type=$qchngcos['type'];
				$semister=$qchngcos['semister'];
				$lecture=$qchngcos['lecture'];
				$level=$qchngcos['level'];
				$target_group=$qchngcos['target_group'];
				$availability=$qchngcos['availability'];
				$requirment=$qchngcos['requirment'];

								}
		//echo$code.$name.$department.$credits.$core.$semister.$lecture.$level.$target_group.$availability.$requirment;
			echo"<form method=POST action='./index.php?view=admin&admin=7&task=rechng'><table border=0 class=bgc width=70%>";
				echo"<tr><td>Course Unit<td>: <input type=hidden value='$code' name=hidmodcod><input type=text name='modcos' value='$code' size=10><font color='red'>[ &#945; = a ] [ &#946; = b ] [ &#948; = d ]</font></tr>";
				echo"<tr><td>Course Name<td>: <input type=text name='modcosnm' value='$name' size=40></tr>";
				echo"<tr><td>Department<td>: ";
					echo"<select name=moddept>";
					
					if(($_SESSION['role']=="administrator")||($_SESSION['role']=="topadmin")||($_SESSION['role']=="sar")){
						$quegtdept="select distinct(department) from courseunit order by department";
						$qugtdept=mysql_query($quegtdept);
							while($qgtdept=mysql_fetch_array($qugtdept)){
								$gtdept=$qgtdept['department'];
									if($gtdept=="$department"){
										echo"<option value='$department' selected>".ucfirst($department)."</option>";
													}
									else{
										echo"<option value='$gtdept'>".ucfirst($gtdept)."</option>";
										}

													}
																								}
					else{
									echo"<option value='$department' selected>".ucfirst($department)."</option>";
							}
													
													
													
													
													
					echo"</select></tr>";
				echo"<tr><td>Credits<td>: <input type=text name='modcredvl' value='$credits' size=4></tr>";
				echo"<tr><td>Core<td>: ";
					echo"<select name=modcore>";
						$quegtcor="select distinct(core) from courseunit order by core";
						$qugtcor=mysql_query($quegtcor);
							while($qgtcor=mysql_fetch_array($qugtcor)){
								$gtcor=$qgtcor['core'];
									switch ($gtcor){
										case "co":
											$vsucor="Compulsory Course Unit";
											break;

										case "op":
											$vsucor="Optional Course Unit";
											break;
										case "nd":
											$vsucor="No Credits Compulsory course";
											break;
										case "nn":
											$vsucor="No Credits other course";
											break;
									default:
										
										$vsucor= "Not Define";
										}	//endswitch;



									if($gtcor==$core){
										echo"<option value=$core selected>$vsucor - ($core)</option>";
												}
									else{
										echo"<option value=$gtcor>$vsucor - ($gtcor)</option>";
										}
													}
					echo"</select></tr>";
				echo"<tr><td>Type<td>: ";
					echo"<select name=modcostyp>";
						if($type=="Theory"){
							echo'<option value="Theory" selected="selected">Theory</option>';
							echo'<option value="Practical">Practical</option>';
							echo'<option value="Th+Pr">Both (Theory/Practical)</option>';
									}
						else if($type=="Practical"){

							echo'<option value="Theory">Theory</option>';
							echo'<option value="Practical" selected="selected">Practical</option>';
							echo'<option value="Th+Pr">Both (Theory/Practical)</option>';
									}
						else if($type=="Th+Pr"){
							echo'<option value="Theory">Theory</option>';
							echo'<option value="Practical">Practical</option>';
							echo'<option value="Th+Pr" selected="selected">Both (Theory/Practical)</option>';
							
							}
						else{
							echo'<option value="Theory">Theory</option>';
							echo'<option value="Practical">Practical</option>';
							echo'<option value="Th+Pr">Both (Theory/Practical)</option>';
							
							}


					echo"</select>";


				echo"<tr><td>Semester<td>: ";
					echo"<select name=modsem>";
						if($semister=="1"){
							echo"<option value='1' selected>Semester One</option>";
							echo"<option value='2'>Semester Two</option>";
							echo"<option value='3'>Both Semester</option>";
								}
						elseif($semister=="2"){
							echo"<option value='1'>Semester One</option>";
							echo"<option value='2'selected>Semester Two</option>";
							echo"<option value='3'>Both Semester</option>";
									}
						else{
							echo"<option value='1'>Semester One</option>";
							echo"<option value='2'selected>Semester Two</option>";
							echo"<option value='3' selected>Both Semester</option>";
							}


					echo"</select></tr>";


				//echo"<input type=text name='modsem' value='$semister' size=2></tr>";

				echo"<tr><td>Level<td>: <input type=text name='modlvl' value='$level' size=2 ></tr>";
				echo"<tr><td>Lecturer<td>: ";
					echo"<select name=modlect>";
									echo"<option value='Add Here'>Add Here</option>";
						$quegtlec="select user,l_name,initials from $rmsdb.fohssmis where (role='lecturer' or role='general' or role='topadmin' or role='dssc') and section='$dept' order by l_name";
						//echo$quegtlec;
						$qugtlec=mysql_query($quegtlec);
							while($qgtlec=mysql_fetch_array($qugtlec)){
								$lecuname=$qgtlec['user'];
								$leclname=$qgtlec['l_name'];
								$leciniti=$qgtlec['initials'];
							
									if($lecuname==$lecture){
										echo"<option value=$lecture selected>".ucfirst($leclname)." $leciniti</option>";
												}
									else{
										
										echo"<option value='$lecuname'>".ucfirst($leclname)." $leciniti</option>";
										}
													}
			
					echo"</select></tr>";
				echo"<tr><td>Target Group<td>: ";
					echo"<select name=modtgtgp>";
						$quegttgtgp="select distinct(target_id),name from target_group order by name";
						$qugttgtgp=mysql_query($quegttgtgp);
							while($qgttgtgp=mysql_fetch_array($qugttgtgp)){
								$gttgtid=$qgttgtgp['target_id'];
								$gttgtgpnm=$qgttgtgp['name'];
									if($gttgtid==$target_group){
										echo"<option value=$target_group selected>$gttgtgpnm</option>";
													}
									else{
										echo"<option value=$gttgtid>$gttgtgpnm</option>";
										}
													}
					echo"</select></tr>";
				echo"<tr><td>Availability<td>: ";
					echo"<select name=modavle>";
						if($availability==1){
							echo"<option value=1 selected>Available</option>";
							echo"<option value=0>Not Available</option>";
									}
						else{
							echo"<option value=1>Available</option>";
							echo"<option value=0 selected>Not Available</option>";
							}
					echo"</select></tr>";
				echo"<tr><td>Requirment<td>: <input type=text name='modprereq' value='$requirment' size=40 ></tr>";
				echo"<tr><td colspan=2 align='center'><input type=submit value='Update Course Unit'></tr>";

			echo"</table></form>";





//////////////////////////////////////////////////////////////////////////////////////////////

/*///////////this made by sathi comment by ira////////////////////////////////////////
	if($task='removecourse'){
	echo "Removing Currently Disabled ";
	//////////////////////////////////////
	//$query7="delete from courseunit where code='$code'";
	/////////////////////////////////////
	$ann_rm=mysql_query($query7);
	}
///////////this made by sathi comment by ira////////////////////////////////////////*/



				}//task removecourse if 
	




	///////////// Ending of Removing Course units
	
	
	
	///////////// View Courses from department
	
	elseif($task=='viewcourse'){
	
	echo "View Single Course Unit";
	echo "<br />";
	$code=$_GET['id'];
	$con7_vw=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
	
	$queryvw="select distinct(c.code), c.name, c.department, c.credits, c.core, c.type, c.semister, c.lecture, c.level, t.name as target_group, c.availability, c.requirment from courseunit c, target_group t where code='$code' and t.target_id=c.target_group";
	//echo$queryvw;
	$cource_vw=mysql_query($queryvw);
	echo '<table border="1"  bordercolor="#993366" align="center">';
	while($data=mysql_fetch_array($cource_vw)){
			$temdiscos=$data['code'];
				////////////////////////////////////////////////////////////////////////////////////////
								$coursegetchr=trim($temdiscos);
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




	echo "<tr><td width=160px>Subject Code <td width=240px>".$fulcode;
	echo "<tr><td>Subject name <td>".ucfirst($data['name']);
	echo "<tr><td>Department <td>".ucfirst($data['department']);
	echo "<tr><td>Number of credits <td>".$data['credits'];	
	echo "<tr><td>Course Core <td>";
	// Defining Core or Optional type of Course
	if(($data['core'])=='co'){
	echo "Compulsory Course";
	}
	elseif(($data['core'])=='op'){
	echo "Optional Course";
	}
	elseif(($data['core'])=='nd'){
	echo "Credits Not Considered, But Compulsory course";
	}
	elseif(($data['core'])=='nn'){
	echo "Credits Not Considered, Not a Compulsory course";
	}
	else{
	echo "Not Available";
	}
	echo "<tr><td>Course Type <td>".ucfirst($data['type']);
	echo "<tr><td>Semester <td>";
	// semester defining
	if(($data['semister'])==3){
	echo "Both Semester";
	}
	else{
	echo $data['semister'];
	}
	//echo "<tr><td>Course Coordinator <td><a href=?view=admin&admin=7&task=modifycourse&id=".$data['code'].">".$data['lecture']."</a>";	
	
	echo "<tr><td>Lecturer <td>".ucfirst($data['lecture']);
	echo "<tr><td>Level <td>".$data['level'];	
	echo "<tr><td>Target Group <td>".$data['target_group'];	
	echo "<tr><td>Availability<td>".$data['availability'];	
	echo "<tr><td>Pre Requirement <td>".ucfirst($data['requirment']);	
	}
	echo "</table><br />";
	echo "<hr class=bar><br>";
	///////////////////////////////////

	
	}
	
	///////////// Ending of View Course units
	
	
	
	
	////// add new course units 
	else{
	
	include 'forms/form_7.php';
	}
	//////// ending form
	
	
	
						
	//Grouping Courses
						
	include 'admin/config.php';
	
	/* Problem occured
	//$department_7='computerscience';
	Corrected Success...
	*/
	if(($role=="administrator")||($role=="topadmin")||($role=="sar")){
		$dept="all";
		$department_7=$dept;
		}

   	echo "<b><center>Courses Summery</center></b>";
	$con7_2=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);		
	if($dept!="all"){
		$query7_2="select * from courseunit where department='$department_7' order by code";
			}
	else{
		$query7_2="select * from courseunit order by department,code";
		}
	$course_details=mysql_query($query7_2);

	$cuno=1;
	if($dept!="all"){
	echo '<table border="0" align="center" width="100%"><tr><th>No<th>Course Unit <th>Credits <th>Core <th>Type <th>Lecturer <th>Semester <th>Level <th>Availability <th>Modify </tr>';
		while($data=mysql_fetch_array($course_details)){
			$temdiscos=$data['code'];
				////////////////////////////////////////////////////////////////////////////////////////
								$coursegetchr=trim($temdiscos);
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
	echo "<tr class=trbgc><td align=center>$cuno<td align=center><a href=?view=admin&admin=7&task=viewcourse&id=".$data['code'].">".$fulcode."</a>";
	echo "<td align=center>".$data['credits']."<td align=center>".$data['core']."<td align=center>".ucfirst($data['type'])."<td align=center><a href=?view=admin&admin=7&task=modifycourse&id=".$data['code'].">".$data['lecture']."</a><td align=center>";
	if(($data['semister'])==3){
	echo "Both";
	}
	else{
	echo $data['semister'];
	}
			if($data['availability']==1){
					$avle="Available";
							}
			else{
					$avle="Not Available";
				}	
			
	echo "<td align=center>".$data['level']."<td align=center>".$avle."<td align=center>";
	echo "<a href=?view=admin&admin=7&task=chngoption&id=".$data['code']."&dept=".$data['department'].">Modify</a></tr>";
	$cuno++;
	}
	echo "</table>";
			}

///////////////////////////////////////////////////////////////////////////////////////////////
	else{


echo '<table border="0" align="center" ><tr><th>No<th>Course Unit <th>Credits <th>Core <th>Type <th>Department <th>Lecturer <th>Semester <th>Level <th>Availability <th>Modify </tr>';
		while($data=mysql_fetch_array($course_details)){
				$temdiscos=$data['code'];
				////////////////////////////////////////////////////////////////////////////////////////
								$coursegetchr=trim($temdiscos);
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

	echo "<tr class=trbgc><td align=center>$cuno<td align=center><a href=?view=admin&admin=7&task=viewcourse&id=".$data['code'].">".$fulcode."</a>";
	echo "<td align=center>".$data['credits']."<td align=center>".$data['core']."<td align=center>".ucfirst($data['type'])."<td align=center>".ucfirst($data['department'])." <td align=center><a href=?view=admin&admin=7&task=modifycourse&id=".$data['code']."&codept=".$data['department'].">".$data['lecture']."</a><td align=center>";
	if(($data['semister'])==3){
	echo "Both";
	}
	else{
	echo $data['semister'];
	}
			if($data['availability']==1){
					$avle="Available";
							}
			else{
					$avle="Not Available";
				}


	echo "<td align=center>".$data['level']."<td align=center>".$avle."<td align=center>";
	echo "<a href=?view=admin&admin=7&task=chngoption&id=".$data['code']."&dept=".$data['department'].">Modify</a></tr>";
	$cuno++;
	}
	echo "</table>";




		}










?>
