<?php
require_once('./classes/attClass.php');
$vratt47=new attendence();




$quegetexmregst="select distinct(ex.std_id) from  exam_registration ex, student s ,level l where l.level=$atcllvl and l.year=s.year and s.id=ex.std_id order by ex.std_id";
//echo$quegetexmregst;
$qugetexmregst=mysql_query($quegetexmregst);
if(mysql_num_rows($qugetexmregst)==0){
	echo"<br><font color=red> Sorry! Cannot find any registered student for examination.</font>";
}
else{
	while($qgetexmregst=mysql_fetch_array($qugetexmregst)){
		$getexmregst=$qgetexmregst['std_id'];
		//echo"$getexmregst<br>";
		$queckexreg="select ex.course_code,ex.status,ex.Last_update, c.level from exam_registration ex , courseunit c where ex.academic_year='$crtacyr' and ex.semester=$exmseme and ex.std_id='$getexmregst' and ex.course_code=c.code";
		//echo$queckexreg;
		$quckexreg=mysql_query($queckexreg);
		if(mysql_num_rows($quckexreg)!=0){
			while($qckexreg=mysql_fetch_array($quckexreg)){
				$qulisub="noqlsub";
				$ntelisub="noelsub";
				$ckexreg=$qckexreg['course_code'];
					$ckexregstatus=$qckexreg['status'];
					$ckexregupdt=$qckexreg['Last_update'];
				
				$ckexreglvl=$qckexreg['level'];
		//	echo$ckexreg."/";
				
				if($ckexreglvl<$atcllvl){
					$queupdtrptsub="update exam_registration set status=1 where std_id='$getexmregst' and course_code='$ckexreg' and academic_year='$crtacyr' and semester=$exmseme";
					//echo"<br>$queupdtrptsub";
					$quupdtrptsub=mysql_query($queupdtrptsub);////////uncomnt B4 upld script
				}
				else{
					///////////////////////////////////////////////////////////////
					//////////////////////////check 80%////////////////////////////
					$practgp=$vratt47->getprctgp($getexmregst,$ckexreg,$crtacyr);
				//	echo"$practgp]";
					
					///////////////mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm/////////////
				$quegtlecids="select distinct(type) from lecture where course='$ckexreg' and acc_year='$crtacyr'";
				//echo$quegtlecids;
				$qugtlecids=mysql_query($quegtlecids);
				if(mysql_num_rows($qugtlecids)!=0){
				$type="nil";
					$totalall=$vratt47->getTotalAll($ckexreg, $getexmregst, $crtacyr);/////////no of total participation lecture hourse/////////////////
					$alllechs=$vratt47->getSubTotalAll($ckexreg, $crtacyr,$practgp);/////////no of total lecture hourse/////////////////


					$topsg=($totalall/$alllechs)*100;
					$totprs=round($topsg);
					//echo"all ac ses ".$alllechs."---";
					//echo"tot party ".$totalall.":::::tot persentage= ".round($topsg)."% <br>";
						while($qgtlecids=mysql_fetch_array($qugtlecids)){
							$gtlecttp=$qgtlecids['type'];
							$fulpermi="null";
								if($gtlecttp!=$type){
									if($gtlecttp=="field"){
										continue;
										}
									else{

									$total=$vratt47->getTotal($ckexreg, $getexmregst, $gtlecttp, $crtacyr);
									$ctotal=$vratt47->getSubTotal($ckexreg, $gtlecttp, $crtacyr,$practgp);
									$cutofmrk=$vratt47->getMax($ckexreg, $gtlecttp, $crtacyr);
										if($cutofmrk=="nd"){
											$cutofmrk=80;
													}
										$ctm=round($cutofmrk);

										if($cutofmrk!="nd"){

										//echo"tot $gtlecttp hs=".$ctotal."---";
										//echo"prt $gtlecttp hs=".$total.":::::";
										//echo"cut of mrk=".round($cutofmrk)."% +++++";
										$perpsg=($total/$ctotal)*100;
										$pest=round($perpsg);
											//echo" Current Persentage= ".round($perpsg)."% }";
											$type=$gtlecttp;
												if(($totprs!=0)&&($ctm<=$pest)){
													//echo"<font color=blue>OK Print Admisstion $totprs %</font><br>";
													$qulisub=$ckexreg;

														}
												else{
													if($gtlecttp=="practical"){
														$fulpermi="no";

																	}
													//echo"<font color=red>Not Eligibility $totprs %</font><br>";
													$ntelisub=$ckexreg;
													}




											}

										}
											}
												}
						if(($qulisub==$ckexreg)&&($qulisub!=$ntelisub)&&($fulpermi!="no")){
							
							$quechkassely="select status from  assignment_eligibility where stu_no='$getexmregst' and course='$ckexreg' and ac_year='$crtacyr'";
							$quchkassely=mysql_query($quechkassely);
							
							if(mysql_num_rows($quchkassely)==0){
								//echo"<font color=blue>{---------Qulified ".$qulisub."------$ntelisub---}</font>";
								$queupexcm1="update exam_registration set status=1 where std_id='$getexmregst' and course_code='$qulisub' and academic_year='$crtacyr' and semester=$exmseme";
								//echo$queupexcm1;
								mysql_query($queupexcm1);								
								}
							else{
								//echo"<font color=red>{---------Not Qulified ".$ntelisub."---------}</font>";
								if(($ckexregstatus==0)||($ckexregupdt==null)){
									$queupexcm2="update exam_registration set status=2 where std_id='$getexmregst' and course_code='$ckexreg' and academic_year='$crtacyr' and semester=$exmseme";
									//echo$queupexcm2;
									mysql_query($queupexcm2);
								}
								
																
							}

									}
						else{
							//echo"<font color=red>{---------Not Qulified ".$ntelisub."---------}</font>";
							
							if(($ckexregstatus==0)||($ckexregupdt==null)){
							$queupexcm2="update exam_registration set status=2 where std_id='$getexmregst' and course_code='$ntelisub' and academic_year='$crtacyr' and semester=$exmseme";
							//echo$queupexcm2;
							mysql_query($queupexcm2);
							}
							}
							//echo$queupexcm2
				}

					///////////////mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm/////////////
					
					
					
					//////////////////////end check 80%////////////////////////////
					///////////////////////////////////////////////////////////////
				}
					//echo"<br>";
			}///exm reg sub whl
			//echo"<br>";
		}
		

	}///main whl
	echo"<br><font color=blue>Successfully Admission Generated $prntlvlvr !</font><br>";
}//main els



									
?>