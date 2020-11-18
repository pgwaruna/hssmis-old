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
		$level_reg_lbl="All Repeate Student";
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
	$con9=mysql_connect($host,$user,$pass);
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
////////////////////////////////////////////////////////////////////////////////////////
								$coursegetchr=trim($getrepcos);
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


		


		echo"<th><font size=2px>&nbsp;$fulcode&nbsp;</font></th>";
								}

///////////////////////////////////////end create table <th>/////////////////////////////////////////////////////////////

//////////////////////////create 1st column student number/////////////////////////////////////////////////////
        
        ///////////////////////////////////////////////////////////////////////
        ///////////////////get student year////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////
        $quegetintenallvl="select year from level where level<>0 order by year";
                $qugetintenallvl=mysql_query($quegetintenallvl);
                $intlvlyear=array();
                $iy=0;
                while($qgetintenallvl=mysql_fetch_array($qugetintenallvl)){
                    
                    $getintenallvl=$qgetintenallvl['year'];
                               $intlvlyear[$iy]=$getintenallvl;
                   $iy++;
                                                 }
        
        ///////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////

            $fmviweque="$rmsdb.fohssmisStudents fs";

		if($level_reg=="all"){
		    			$quegetrepst="select s.id, s.batch from student s, $fmviweque  where s.year<>$intlvlyear[2] and concat('sc',s.id)=fs.user_name order by s.id";
					}
        
        elseif($level_reg=="0"){
                        $quegetrepst="select s.id, s.batch from student s, $fmviweque  where (s.year<>$intlvlyear[0] and s.year<>$intlvlyear[1] and s.year<>$intlvlyear[2]) and concat('sc',s.id)=fs.user_name order by s.id";
        }
		else{
			$quegetrepst="select s.id, s.batch from student s, level l, $fmviweque where s.year=l.year and l.level=$level_reg and concat('sc',s.id)=fs.user_name  order by s.id";
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
					$rpcosfst3=substr($getrepcos, 0, 3);
					$rpcoslast4=substr($getrepcos, -4);

						$rpcosnewcos=strtoupper($rpcosfst3).$rpcoslast4;

					$rptsubar[$rarel]=$rpcosnewcos;
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
							$getchkrepcos=trim($sndgetrepcos);
							$cosfst3=substr($getchkrepcos, 0, 3);
							$coslast4=substr($getchkrepcos, -4);

							$cosnewcos=strtoupper($cosfst3).$coslast4;
	
						$sndgetrepcore=$q2ndgetrepcos['core'];
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////repeat corse display/////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////				
					if(in_array($cosnewcos, $rptsubar)){
					echo"<td align=center>";
						echo"<table border=0><tr>";
						$quecheckrpexreg="select id, confirm from exam_registration where student='$getrepstid' and course='$sndgetrepcos' and acedemic_year='$acedemic_reg'";
//echo$quecheckrpexreg;
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
						echo"$cosnewcos<br>-$getrepstid-";


					echo"</td>";
										}//inarray if
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////repeat corse display/////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////				


					else{
					echo"<td align=center>&nbsp;";
					/*for($i=0;$i<count($rptsubar);$i++){
						echo$rptsubar[$i]."-";
										}*/

					echo"</td>";
						
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
