<!--
Edit Repeat registration confirmation details. this page can add or remove course unit as you wish with administrator privileges. 
if you add a course unit then confirm field of regestration table update as 1 and if you remove course unit  confirm field of regestration table update as 0.
-->

<script type="text/javascript" src="../Ajax/repeat_exam_reg_confirmation.js"></script>
<?php
require_once('../classes/globalClass.php');
$brp=new settings();

	
	$level_reg=$_POST['rpcnflvl'];

	if($level_reg=="all"){
		$level_reg_lbl="All Levels Student";
				}
	elseif($level_reg=="0"){
		$level_reg_lbl="Passout Student";
				}
	else{
		$level_reg_lbl="Level ".$level_reg." Students";
		}


	$acedemic_reg=$_POST['cracy'];
	$semister_reg=$_POST['crsem'];
	

	echo "<font color=blue>Confirm Repeat Exam Registration of Currently ";
	echo $level_reg_lbl;
	echo"</font><hr class=bar>";
						
	include '../admin/config.php';					
	$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
	echo"<div id='m'>";////////////////////////////////////scroll div



		if($semister_reg==1){
			$semister_reg2=1;
					}
		else{
			$semister_reg2="2 or semister=3";
			}
/////////////////////////////////////////create table <th>/////////////////////////////////////////////////////////////
	if($level_reg==2){
	$quegetrepcos="select code,core from courseunit where (semister=$semister_reg2) and level='1' order by level,code";
			}

	elseif($level_reg==3){
	$quegetrepcos="select code,core from courseunit where (semister=$semister_reg2) and (level='1' or level='2')  order by level,code";
				}
	else{
	$quegetrepcos="select code,core from courseunit where (semister=$semister_reg2) order by level,code";

		}

	echo"<table border=1 cellspacing=0 ><th>Student No";

	$qugetrepcos=mysql_query($quegetrepcos);

	while($qgetrepcos=mysql_fetch_array($qugetrepcos)){	
		
		$getrepcos=$qgetrepcos['code'];


			$course2=trim($getrepcos);
			$ccdwoutcrd=substr("$course2", 0, -1);
			$getchar = preg_split('//', $course2, -1);
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

			$course=strtoupper($ccdwoutcrd.$credit);

		


		echo"<th><font size=2px>&nbsp;$course&nbsp;</font></th>";
								}

///////////////////////////////////////end create table <th>/////////////////////////////////////////////////////////////

//////////////////////////create 1st column student number/////////////////////////////////////////////////////

		if($level_reg=="all"){
			$quegetrepst="select s.id, s.batch from student s, level l where s.year=l.year and (l.level=2 or l.level=3 ) order by l.level,s.id";
					}
		else{
			$quegetrepst="select s.id, s.batch from student s, level l where s.year=l.year and l.level=$level_reg  order by s.id";
			}
		//echo$quegetrepst;
			$qugetrepst=mysql_query($quegetrepst);
			
			while($qgetrepst=mysql_fetch_array($qugetrepst)){
			
				$getrepstid=$qgetrepst['id'];
				$getrepstbt=$qgetrepst['batch'];

					//$a='$rpary'.$getrepstid;
					$rptsubar=array();
					$rarel=0;



////////////////////////end create 1st column student number//////////////////////////////////////////////////
			$querepgetrepcos="select course from registration where student='$getrepstid' and acedemic_year<>'$acedemic_reg' and (semister=$semister_reg2) and confirm=1  order by course";

			$qurepgetrepcos=mysql_query($querepgetrepcos);
			if(mysql_num_rows($qurepgetrepcos)!=0){
			$stbrp="0";
			while($qrepgetrepcos=mysql_fetch_array($qurepgetrepcos)){	
					$getrepcos2=$qrepgetrepcos['course'];
					$getrepcos=trim($getrepcos2);
						$chkbrp=$brp->checkrepeat($getrepstid,$getrepcos);

	
				if($chkbrp=="yes"){
					$stbrp="1";
					$rptsubar[$rarel]=$getrepcos;
					$rarel=$rarel+1;
							}
				else{
					continue;
					}
										}
								
			if($stbrp=="1"){
				echo"<tr><td align=center  class=tdbgc><b>SC/$getrepstbt/$getrepstid</b></td>";
				
						
////////////////////////end create 1st column student number//////////////////////////////////////////////////


				$qu2ndgetrepcos=mysql_query($quegetrepcos);
				while($q2ndgetrepcos=mysql_fetch_array($qu2ndgetrepcos)){
						$sndgetrepcos=$q2ndgetrepcos['code'];
						$sndgetrepcore=$q2ndgetrepcos['core'];
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////repeat corse display/////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////				
					if(in_array($sndgetrepcos, $rptsubar)){
					echo"<td align=center>";
						echo"<table border=0><tr>";
						$quecheckrpexreg="select id, confirm from exam_registration where student='$getrepstid' and course='$sndgetrepcos'";
						$qucheckrpexreg=mysql_query($quecheckrpexreg);
						if(mysql_num_rows($qucheckrpexreg)!=0){
							echo"<td align=center>";
						
						echo "<div id=rm".$sndgetrepcos."-".$getrepstid.">";///////////////////remove respons text div start////////////////////////
							echo "<div id=cnf".$sndgetrepcos."-".$getrepstid.">";///////////////////confirmation respons text div start//
							while($qcheckrpexreg=mysql_fetch_array($qucheckrpexreg)){
									$rpsubid=$qcheckrpexreg['id'];
									$rpsubcnf=$qcheckrpexreg['confirm'];
														}
				/////////////////////// already confirmed if cancel/////////////////////////////////////////
								if($rpsubcnf==1){
									///$simdi="cnf".$sndgetrepcos."img".$getrepstid;
									//echo$simdi;
									echo "<img id=cnf".$sndgetrepcos."img".$getrepstid." src=../images/ntcnf.png onClick=change('$sndgetrepcos','$getrepstid','$rpsubcnf',$rpsubid)>";
									echo"<br><font color=green><b>$rpsubcnf</b></font>";

									
										}
				/////////////////////// end already confirmed if cancel/////////////////////////////////////////




				/////////////////////// already not confirmed if confirmed/////////////////////////////////////////
								else{
									
									echo "<img id=cnf".$sndgetrepcos."img".$getrepstid." src=../images/conf31.png onClick=change('$sndgetrepcos','$getrepstid','$rpsubcnf',$rpsubid)>";
									echo"<br><font color=red><b>$rpsubcnf</b></font>";
									

									}
				/////////////////////// end already not confirmed if confirmed/////////////////////////////////////////

							echo"</div></td>";///////////////////confirmation respons text div stop///////////////////


				/////////////////////// remove exam registration////////////////////////////////////////////////////////
								echo"<td align=center>";
									echo "<img id=rm".$sndgetrepcos."img".$getrepstid." src=../images/rm.png onClick=removecu('$sndgetrepcos','$getrepstid',$rpsubid)>";
									echo"<br>&nbsp;";
									echo"</div></td>";///////////////////remove respons text div stop////////////////////////

				/////////////////////// end remove exam registration////////////////////////////////////////////////////////



											}


				/////////////////////////////// new exam registration/////////////////////////////////////////////////////////////
						else{
			
							echo"<td align=center>";
							echo "<div id=adnew".$sndgetrepcos."-".$getrepstid.">";///////////////////confirmation respons text div
									echo "<img id=adn".$sndgetrepcos."img".$getrepstid." src=../images/conf2.png onClick=changeAdd('$sndgetrepcos','$getrepstid','$sndgetrepcore')>";
									
									echo"</div></td>";


							}
				////////////////////////////////end  new exam registration////////////////////////////////////////////////////////
						
							
							
						echo"</tr></table>";
						echo"$sndgetrepcos<br>-$getrepstid-";


					echo"</td>";
										}//inarray if
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////repeat corse display/////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////				


					else{
					echo"<td align=center>&nbsp;</td>";
						
						}
												}

				echo"</tr>";

						}//repeat st genarate if
										}
				else{
					continue;
					}
										}



	echo"</table>";


	echo "</div>";////////////////////////////////////scroll div
	

						
?>
