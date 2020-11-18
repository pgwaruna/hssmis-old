<?php
session_start();
if((($_SESSION['login'])=="TRUE")&&($_SESSION['role']!="student")){
?>


<?php
$queckexreg="select course from exam_registration where acedemic_year='$acy' and semester=$cseme and student='$admisid'";
		$quckexreg=mysql_query($queckexreg);
		if(mysql_num_rows($quckexreg)!=0){
			//echo"student ".$admisid."<br>";
			while($qckexreg=mysql_fetch_array($quckexreg)){
				$excocode=$qckexreg['course'];
				//echo$excocode."{";
				
				$quegtlecids="select distinct(type) from lecture where course='$excocode' and acc_year='$acy'";
				//echo$quegtlecids;
				$qugtlecids=mysql_query($quegtlecids);
				if(mysql_num_rows($qugtlecids)!=0){
				$type="nil";
					$totalall=$m->getTotalAll($excocode, $admisid, $acy);/////////no of total participation lecture hourse/////////////////
					$alllechs=$m->getSubTotalAll($excocode, $acy);/////////no of total lecture hourse/////////////////
					

					$topsg=($totalall/$alllechs)*100;
					$totprs=round($topsg);
					//echo"all ac ses".$alllechs."---";
					//echo"tot party ".$totalall.":::::tot persentage= ".round($topsg)."% <br>";	
						while($qgtlecids=mysql_fetch_array($qugtlecids)){
							$gtlecttp=$qgtlecids['type'];
								if($gtlecttp!=$type){
									if(($gtlecttp=="field")||($gtlecttp=="assignment")){
										continue;
										}
									else{
									$total=$m->getTotal($excocode, $admisid, $gtlecttp, $acy);
									$ctotal=$m->getSubTotal($excocode, $gtlecttp, $acy);
									$cutofmrk=$m->getMax($excocode, $gtlecttp, $acy);
										$ctm=round($cutofmrk);
										//echo"tot $gtlecttp hs=".$ctotal."---";
										//echo"prt $gtlecttp hs=".$total.":::::";
										//echo"cut of mrk=".round($cutofmrk)."% +++++";
										$perpsg=($total/$ctotal)*100;
										$pest=round($perpsg);
											//echo" Current Persentage= ".round($perpsg)."% }";
											$type=$gtlecttp;
												if(($totprs!=0)&&($ctm<=$totprs)||($ctm<=$pest)&&($pest!=0)){
													//echo"<font color=blue>OK Print Admisstion $totprs %</font><br>";
													$qulisub=$excocode;
														}
												else{
													if($gtlecttp=="practical"){
														$fulpermi="no";
																	}
													//echo"<font color=red>Not Eligibility $totprs %</font><br>";
													$ntelisub=$excocode;
													}



										}
											}
												}
						if(($qulisub==$excocode)&&($fulpermi!="no")){
							//echo"<font color=blue>{---------Qulified ".$qulisub."---------}</font>";
							$queupexcm1="update exam_registration set confirm=1 where student='$admisid' and course='$qulisub' and acedemic_year='$acy' and semester=$cseme";
							//echo$queupexcm1;
							mysql_query($queupexcm1);


									}
						else{
							//echo"<font color=red>{---------Not Qulified ".$ntelisub."---------}</font>";
							$queupexcm2="update exam_registration set confirm=2 where student='$admisid' and course='$ntelisub' and acedemic_year='$acy' and semester=$cseme";
							//echo$queupexcm2;
							mysql_query($queupexcm2);


							
							}
						
						


					echo"<br>";

									}
				else{
					//echo"not define}<br>";	
					continue;
					}





									}
			
							}
		else{
			echo"student $admisid not register to the exam<br>";
			continue;
			}







?>





<?php

}	
else{

echo "You Have Not Permission To Access This Area!";}

?>

