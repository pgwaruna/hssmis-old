<?php
session_start();
if((isset($_SESSION['login'])=="TRUE")&&($_SESSION['role']!="student")){
?>


<?php


$queprsinf="select * from student_personal_detais where stno='$st'";
		$quprsinf=mysql_query($queprsinf);
		if(mysql_num_rows($quprsinf)!=0){
		while($qprsinf=mysql_fetch_array($quprsinf)){
				
				$nic=$qprsinf['nic'];
				$dob=$qprsinf['dob'];
				$gender=$qprsinf['gender'];
				$padd1=$qprsinf['padd1'];
				$padd2=$qprsinf['padd2'];
				$padd3=$qprsinf['padd3'];
				$padd4=$qprsinf['padd4'];
				$tadd1=$qprsinf['tadd1'];
				$tadd2=$qprsinf['tadd2'];
				$tadd3=$qprsinf['tadd3'];
				$tadd4=$qprsinf['tadd4'];
				$tel_home=$qprsinf['tel_home'];
				$tel_mobile=$qprsinf['tel_mobile'];
				$email=$qprsinf['email'];
				$cstatus=$qprsinf['cstatus'];
				$weight=$qprsinf['weight'];
				$nationality=$qprsinf['nationality'];
				$height=$qprsinf['height'];
				$district=$qprsinf['district'];
				$religion=$qprsinf['religion'];
				$bloodgp=$qprsinf['bloodgp'];
				//$combinations=$qprsinf['combinations'];
				$alyear=$qprsinf['alyear'];
				$alindexno=$qprsinf['alindexno'];
				$zscore=$qprsinf['zscore'];
				$gtmarks=$qprsinf['gtmarks'];
				$physics=$qprsinf['physics'];
				$chemistry=$qprsinf['chemistry'];
				$com_maths=$qprsinf['com_maths'];
				$biology=$qprsinf['biology'];
				$gen_english=$qprsinf['gen_english'];
				$addi_subject=$qprsinf['addi_subject'];
				$add_sub_grd=$qprsinf['add_sub_grd'];
				$olyear=$qprsinf['olyear'];
				$olindexno=$qprsinf['olindexno'];
				$mathematics=$qprsinf['mathematics'];
				$science=$qprsinf['science'];
				$buddhism=$qprsinf['buddhism'];
				$soc_s_n_history=$qprsinf['soc_s_n_history'];
				$sinhala=$qprsinf['sinhala'];
				$engilsh=$qprsinf['engilsh'];
				$art_sub=$qprsinf['art_sub'];
				$art_sub_grd=$qprsinf['art_sub_grd'];
				$other_sub1=$qprsinf['other_sub1'];
				$other_sub1_grd=$qprsinf['other_sub1_grd'];
				$other_sub2=$qprsinf['other_sub2'];
				$other_sub2_grd=$qprsinf['other_sub2_grd'];
				$other_sub3=$qprsinf['other_sub3'];
				$other_sub3_grd=$qprsinf['other_sub3_grd'];
				$other_sub4=$qprsinf['other_sub4'];
				$other_sub4_grd=$qprsinf['other_sub4_grd'];								
				$other_sub5=$qprsinf['other_sub5'];
				$other_sub5_grd=$qprsinf['other_sub5_grd'];
				$athletic_events=$qprsinf['athletic_events'];
				$sports=$qprsinf['sports'];
				$sp_sch_colors=$qprsinf['sp_sch_colors'];
				$spt_others_colors=$qprsinf['spt_others_colors'];
				$spt_zonal_col=$qprsinf['spt_zonal_col'];
				$other_sport=$qprsinf['other_sport'];
				$talent=$qprsinf['talent'];
				$other_talents=$qprsinf['other_talents'];
				$zonal_talents=$qprsinf['zonal_talents'];
				$ict_prg_lgs=$qprsinf['ict_prg_lgs'];
				$ict_certificate=$qprsinf['ict_certificate'];
				$ict_following=$qprsinf['ict_following'];
				$disability=$qprsinf['disability'];
				$hearing=$qprsinf['hearing'];
				$vision=$qprsinf['vision'];
				$phy_disability=$qprsinf['phy_disability'];
				$support=$qprsinf['support'];
				$spt_specify=$qprsinf['spt_specify'];
				$take_medicine=$qprsinf['take_medicine'];
				$medic_specify=$qprsinf['medic_specify'];
				$gr_name=$qprsinf['gr_name'];
				$gr_add=$qprsinf['gr_add'];
				$gr_mobi=$qprsinf['gr_mobi'];
				$gr_hom=$qprsinf['gr_hom'];
				$gr_occup=$qprsinf['gr_occup'];						
								}//while
	
	if($district!=NULL){
	////////first page///////////
	echo"<table border='0' align='center'>";
	echo"<tr bgcolor='#edd4dc'><td colspan='4'>&nbsp;</td></tr>";
	echo"<tr bgcolor='#edd4dc'><td>National Identity Card No:</td><td colspan='3'>$nic</td></tr>";
	echo"<tr bgcolor='#edd4dc'><td>Date Of Birth:</td><td colspan='3'>$dob</td></tr>";
	echo"<tr bgcolor='#edd4dc'><td rowspan='4' valign='top'>Personal Address </td><td>$padd1&nbsp;</td><td rowspan='4' valign='top'>&nbsp;Temporary Address </td><td>$tadd1 &nbsp;</td></tr>";
	echo"<tr bgcolor='#edd4dc'><td>$padd2&nbsp;</td><td>$tadd2 &nbsp;</td></tr>";
	echo"<tr bgcolor='#edd4dc'><td>$padd3&nbsp;</td><td>$tadd3 &nbsp;</td></tr>";
	echo"<tr bgcolor='#edd4dc'><td>$padd4&nbsp;</td><td>$tadd4 &nbsp;</td></tr>";
	echo"<tr bgcolor='#edd4dc'><td colspan='2'>Contact Numbers</td><td>Home:&nbsp;$tel_home</td><td>Mobile:&nbsp;$tel_mobile</td></tr>";
	echo"<tr bgcolor='#edd4dc'><td>Email Address</td><td colspan='3'><a href='mailto:$email'>$email</a>&nbsp;</td></tr>";
	echo"<tr bgcolor='#edd4dc'><td>Civil Status</td><td>$cstatus&nbsp;</td><td align='right'>Nationality</td><td>&nbsp;$nationality</td></tr>";
	echo"<tr bgcolor='#edd4dc'><td>Religion</td><td>$religion&nbsp;</td><td align='right'>District</td><td>$district&nbsp;</td></tr>";
	echo"<tr bgcolor='#edd4dc'><td>Blood Group</td><td>$bloodgp&nbsp;</td><td>Weight:$weight kg</td><td>Height: $height cm</td></tr>";
	echo"<tr bgcolor='#edd4dc'><td colspan='4'>&nbsp;</td></tr>";

	echo"</table>";

		if($gr_name!=NULL){
		/////second page/////////
		echo"<table border='0' align='center'>";
		echo"<tr bgcolor='#edd4dc'><td width='25%'></td><td width='25%'></td><td width='25%'></td><td width='25%'></td></tr>";
		echo"<tr bgcolor='#edd4dc'><td colspan='2'>G.C.E. Advanced Level Result At Entry To University:</td><td>Year: $alyear</td><td>Index No:&nbsp;$alindexno</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td colspan='2' align='center' rowspan='3'>Z-Score: &nbsp;$zscore</td><td align='center'>Subject</td><td align='center'>Grade</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td>Physics</td><td align='center'>$physics&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td> Chemistry</td><td align='center'>$chemistry&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td colspan='2' align='center' rowspan='3'>Genaral Test Marks:&nbsp;$gtmarks</td><td>Combined Mathematics</td><td align='center'>$com_maths&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td>Biology </td><td align='center'>$biology&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td>Genaral English</td><td align='center'>$gen_english&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td colspan='2'>&nbsp;</td><td>$addi_subject&nbsp;</td><td align='center'>$add_sub_grd&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td colspan='2'>G.C.E. Ordinary Level Result :</td><td>Year:$olyear</td><td>Index No:&nbsp$olindexno&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td align='center'>Subject</td><td align='center'>Grade</td><td align='center'>Subject</td><td align='center'>Grade</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td>Mathematics</td><td align='center'>$mathematics&nbsp;</td><td>Science</td><td align='center'>$science&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td>Buddhism</td><td align='center'>$buddhism&nbsp;</td><td>Social Study & History</td><td align='center'>$soc_s_n_history&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td>Sinhala</td><td align='center'>$sinhala&nbsp;</td><td>English</td><td align='center'>$engilsh&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td>$art_sub&nbsp;</td><td align='center'>$art_sub_grd&nbsp;</td><td>$other_sub1&nbsp;</td><td align='center'>$other_sub1_grd&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td>$other_sub2&nbsp;</td><td align='center'>$other_sub2_grd&nbsp;</td><td>$other_sub3&nbsp;</td><td align='center'>$other_sub3_grd&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td>$other_sub4&nbsp;</td><td align='center'>$other_sub4_grd&nbsp;</td><td>$other_sub5&nbsp;</td><td align='center'>$other_sub5_grd&nbsp;</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td colspan='2' align='center'>Sports</td><td colspan='2' align='center'>Other Talents/Skills</td></tr>";

		$tlnt=explode("/",$talent);
		$tlnt1=$tlnt[0];
		$tlnt2=$tlnt[1];
		$tlnt3=$tlnt[2];
		$tlnt4=$tlnt[3];


		echo"<tr bgcolor='#edd4dc'><td colspan='2'>Athletic:&nbsp;$athletic_events</td><td colspan='2'>$tlnt1/$tlnt2/$tlnt3/$tlnt4</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td colspan='2'>Other Sports:&nbsp;$sports&nbsp;,$other_sport</td><td colspan='2'>Performance:&nbsp;$other_talents&nbsp;,$zonal_talents</td></tr>";
		
		echo"<tr bgcolor='#edd4dc'><td colspan='2'>Performance: $spt_others_colors&nbsp;,$spt_zonal_col</td><td colspan='2' align='center'>ICT Computing Skills</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td colspan='2' align='center'>Disability Status</td><td colspan='2'>Programming Language: $ict_prg_lgs</td></tr>";
		
		
		echo"<tr bgcolor='#edd4dc'>";
		if($hearing=="hearing_impairment"){
		echo"<td bgcolor='#edd4dc'>Hearing impairment</td><td>Bad</td>";
							}
		else{
		echo"<td bgcolor='#edd4dc'>Hearing impairment</td><td>ok</td>";
			}

		echo"<td colspan='2'>Certificate/Diploma/Degree Courses-completed: $ict_certificate</td></tr>";

		if($vision=="vision_impairment"){
		echo"<tr bgcolor='#edd4dc'><td>Vision impairment</td><td>Bad</td>";
							}
		else{
		echo"<tr bgcolor='#edd4dc'><td>Vision impairment</td><td>ok</td>";
			}

		echo"<td colspan='2'>Present Following: $ict_following</td></tr>";

		echo"<tr bgcolor='#edd4dc'><td>Physical Disability:</td><td>$phy_disability</td><td colspan='2'>&nbsp;</td></tr>";

		$sptyes=explode("_",$support);
		$spt=$sptyes[1];
		echo"<tr bgcolor='#edd4dc'><td>Need Special Support </td><td>$spt&nbsp;:-$spt_specify</td><td colspan='2' align='center'>Guardian's Informations</td></tr>";

		$tkmedi=explode("_",$take_medicine);
		$tkmd=$tkmedi[1];
		echo"<tr bgcolor='#edd4dc'><td>Take Regular Medicine</td><td>$tkmd:-$medic_specify</td><td colspan='2'>Name With Initials:&nbsp;$gr_name</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td colspan='2' align='center' rowspan='4'><a href='#'><img src='../images/backtotop.png'></a></td><td colspan='2'>Permanent Address:&nbsp;$gr_add</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td colspan='2'>Contact No</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td>Mobile:$gr_mobi&nbsp;</td><td>Home:$gr_hom</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td colspan='2'>Occupation: $gr_occup</td></tr>";
		echo"<tr bgcolor='#edd4dc'><td colspan='4'>&nbsp;</td></tr>";

		
		echo"</table>";		
				}
		else{
		echo"<div align='center'><font color='red'>Personal informations are incomplete.</font></div><br>";

			}






				}

	
	else{
			echo"<div align='center'><font color='red'>Sorry ! can not find personal informations of above student....</font></div><br>";	
			}

							
	


						}//main if
		else{
			echo"<div align='center'><font color='red'>Sorry ! can not find personal informations of above student.</font></div><br>";	
			}



?>
<?php
}	
else{
echo "You Have Not Permission To Access This Area!";
}
?>

		
