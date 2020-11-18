<?php
include'../admin/config.php';
mysql_connect($host,$user,$pass);
mysql_select_db($db);
$quepdata2="select * from student_personal_detais where stno='$fst'";
//echo$quepdata2;
$qupdata2=mysql_query($quepdata2);
while($qpdata2=mysql_fetch_array($qupdata2)){
$alyear=$qpdata2['alyear'];
$alindexno=$qpdata2['alindexno'];
$zscore=$qpdata2['zscore'];
$gtmarks=$qpdata2['gtmarks'];
$physics=$qpdata2['physics'];
$chemistry=$qpdata2['chemistry'];
$com_maths=$qpdata2['com_maths'];
$biology=$qpdata2['biology'];
$gen_english=$qpdata2['gen_english'];
$addi_subject=$qpdata2['addi_subject'];
$add_sub_grd=$qpdata2['add_sub_grd'];
$olyear=$qpdata2['olyear'];
$olindexno=$qpdata2['olindexno'];
$mathematics=$qpdata2['mathematics'];
$science=$qpdata2['science'];
$buddhism=$qpdata2['buddhism'];
$soc_s_n_history=$qpdata2['soc_s_n_history'];
$sinhala=$qpdata2['sinhala'];
$engilsh=$qpdata2['engilsh'];
$art_sub=$qpdata2['art_sub'];
$art_sub_grd=$qpdata2['art_sub_grd'];
$other_sub1=$qpdata2['other_sub1'];
$other_sub1_grd=$qpdata2['other_sub1_grd'];
$other_sub2=$qpdata2['other_sub2'];
$other_sub2_grd=$qpdata2['other_sub2_grd'];
$other_sub3=$qpdata2['other_sub3'];
$other_sub3_grd=$qpdata2['other_sub3_grd'];
$other_sub4=$qpdata2['other_sub4'];
$other_sub4_grd=$qpdata2['other_sub4_grd'];
$other_sub5=$qpdata2['other_sub5'];
$other_sub5_grd=$qpdata2['other_sub5_grd'];

$events=$qpdata2['athletic_events'];
$at_evets = explode("/", $events);
$event1=$at_evets[0];
$event2=$at_evets[1];
$event3=$at_evets[2];
$event4=$at_evets[3];
$event5=$at_evets[4];

$sportsall=$qpdata2['sports'];
$allspt=explode("/", $sportsall);
$Criket= $allspt[0];
$Rugger= $allspt[1];
$Football= $allspt[2];
$Volyball= $allspt[3];
$Swimming= $allspt[4];
$Judo= $allspt[5];
$Batminton= $allspt[6];
$Karate= $allspt[7];

$other_sport=$qpdata2['other_sport'];
$sp_sch_colors=$qpdata2['sp_sch_colors'];
$spt_others_colors=$qpdata2['spt_others_colors'];
$spt_zonal_col=$qpdata2['spt_zonal_col'];

$talentall=$qpdata2['talent'];
$alltent=explode("/", $talentall);
$Drawing=$alltent[0];
$Music=$alltent[1];
$Dancing=$alltent[2];
$Singing=$alltent[3];
$Sch_Lvl_Cls=$alltent[4];

$other_talents=$qpdata2['other_talents'];
$zonal_talents=$qpdata2['zonal_talents'];

$ict_prg_lgsall=$qpdata2['ict_prg_lgs'];
$all_pglgs=explode("/", $ict_prg_lgsall);
$pglg1=$all_pglgs[0];
$pglg2=$all_pglgs[1];
$pglg3=$all_pglgs[2];
$pglg4=$all_pglgs[3];
$pglg5=$all_pglgs[4];

$ict_certificateall=$qpdata2['ict_certificate'];
$cetifi=explode("/", $ict_certificateall);
$cetif1=$cetifi[0];
$cetif2=$cetifi[1];

$ict_followingall=$qpdata2['ict_following'];
$follwing=explode("/", $ict_followingall);
$follow1=$follwing[0];
$follow2=$follwing[1];

$disabilityst=$qpdata2['disability'];
$herg=$qpdata2['hearing'];
$visn=$qpdata2['vision'];
$phy_disability=$qpdata2['phy_disability'];
$supt=$qpdata2['support'];
$spt_specify=$qpdata2['spt_specify'];
$take_medicine=$qpdata2['take_medicine'];
$medic_specify=$qpdata2['medic_specify'];

//$=$qpdata2[''];

$gr_name=$qpdata2['gr_name'];
$gr_add=$qpdata2['gr_add'];
$gr_mobi=$qpdata2['gr_mobi'];
$gr_hom=$qpdata2['gr_hom'];
$gr_occup=$qpdata2['gr_occup'];

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Personal Information 2nd Form</title>
<style type="text/css">
<!--
.style1 {font-size: 24px}
.style2 {font-size: 18px}
-->
</style>

<script type="text/javascript" src="../Ajax/disable_form.js"></script>
<script type="text/javascript" src="../Ajax/disable_form1.js"></script>
<script type="text/javascript">
function checkgr(gr){
	
	if(gr.art.value=="--Enter Your Art Subject--"){
		alert("Enter Your Art Subject Name");
		gr.art.focus();
		return false;		
		}
	if(gr.pname.value==""){
		alert("Enter your Guardian's Name With Initials ");
		gr.pname.focus();
		return false;
		}
	if(gr.padd.value==""){
		alert("Enter Your Guardian's Permanent Address");
		gr.padd.focus();
		return false;
		}
}


</script>
</head>

<body>
<form method="POST" action="personal_2.php">
<table width="90%" border="0" align="center">
  <tr>
    <td colspan="4"><div align="center" class="style2">Education Qualifications</div></td>
  </tr>
  <tr>
    <td><input type="hidden" name="task" value="regicom"></td>
    <td><input type="hidden" name="student" value="<?php echo$student;?>"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="20%">G.C.E. Advanced Level Result At Entry To University:- </td>
    <td width="20%"><div align="left">Year:    
        <input type="text" name="alyear" size="8" value="<?php echo$alyear; ?>"/>
    </div></td>
    <td width="25%"><div align="left">Index No: 
      <input type="text" name="alindex" size="15" value="<?php echo$alindexno;?>"/>
    </div></td>
    <td width="25%">&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">Z-Score</div></td>
    <td><div align="center">Subject</div></td>
    <td><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grade</div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">
      <input type="text" name="zscore" size="12" value="<?php echo$zscore;?>"/>
    </div></td>
    <td>&nbsp;&nbsp;&nbsp;Physics</td>
    <td>
      <div align="left">
        <input type="text" name="phy" size="8" value="<?php echo$physics;?>"/>
        </div></td><td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;Chemistry</td>
    <td>
      <div align="left">
        <input type="text" name="che"  size="8" value="<?php echo$chemistry;?>"/>
        </div></td><td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">Genaral Test Marks </div></td>
    <td>&nbsp;&nbsp;&nbsp;Combined Mathematics </td>
    <td>
      <div align="left">
        <input type="text" name="cmath"  size="8" value="<?php echo$com_maths;?>"/>
        </div></td><td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">
      <input type="text" name="gent"  size="12" value="<?php echo$gtmarks;?>"/>
    </div></td>
    <td>&nbsp;&nbsp;&nbsp;Biology </td>
    <td>
      <div align="left">
        <input type="text" name="bio"  size="8" value="<?php echo$biology;?>"/>
        </div></td><td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;Genaral English </td>
    <td>
      <div align="left">
        <input type="text" name="eng"  size="8" value="<?php echo$gen_english;?>"/>
        </div></td><td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="text" name="adisub" size="15" value="<?php echo$addi_subject;?>"/></td>
    <td>
      <div align="left">
        <input type="text" name="othg"  size="8" value="<?php echo$add_sub_grd;?>"/>
        </div></td><td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>G.C.E. (O/L) :- </td>
    <td><div align="left">Year
      <input type="text" name="olyear" size="8" value="<?php echo$olyear;?>" />
    </div></td>
    <td><div align="left">Index No
      <input type="text" name="olindex" size="15" value="<?php echo$olindexno;?>"/>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">Subject</div></td>
    <td><div align="center">Grade</div></td>
    <td><div align="center">Subject</div></td>
    <td><div align="center">Grade</div></td>
  </tr>
  <tr>
    <td>Mathematics</td>
    <td><div align="center">
      <input type="text" name="olsmg" size="8" value="<?php echo$mathematics;?>"/>
    </div></td>
    <td>Science
    </div></td>
    <td><div align="center">
      <input type="text" name="olssg" size="8" value="<?php echo$science;?>"/>
    </div></td>
  </tr>
  <tr>
    <td>Buddhism</td>
    <td><div align="center">
      <input type="text" name="olsbg" size="8" value="<?php echo$buddhism;?>"/>
    </div></td>
    <td>Social Study & History
    </div></td>
    <td><div align="center">
      <input type="text" name="olssshg" size="8" value="<?php echo$soc_s_n_history;?>"/>
    </div></td>
  </tr>
  <tr>
    <td>Sinhala</td>
    <td><div align="center">
      <input type="text" name="olssig" size="8" value="<?php echo$sinhala;?>"/>
    </div></td>
    <td>English
    </div></td>
    <td><div align="center">
      <input type="text" name="olseg" size="8" value="<?php echo$engilsh;?>"/>
    </div></td>
  </tr>
  <tr> <?php
	if($art_sub==NULL){
    		echo"<td><input type='text' name='art'  value='--Enter Your Art Subject--'/></td>";
		}
	else{
		echo"<td><input type='text' name='art'  value='$art_sub'/></td>";
		}
	?>
    <td><div align="center">
      <input type="text" name="olsag" size="8" value="<?php echo$art_sub_grd;?>"/>
    </div></td>
    <td>
      <input type="text" name="ols1" value="<?php echo$other_sub1;?>" />
    </div></td>
    <td><div align="center">
      <input type="text" name="ols1g" size="8" value="<?php echo$other_sub1_grd;?>"/>
    </div></td>
  </tr>
  <tr>
    <td><input type="text" name="ols2" value="<?php echo$other_sub2;?>" /></td>
    <td><div align="center">
      <input type="text" name="ols2g" size="8" value="<?php echo$other_sub2_grd;?>"/>
    </div></td>
    <td>
      <input type="text" name="ols3" value="<?php echo$other_sub3;?>" />
    </div></td>
    <td><div align="center">
      <input type="text" name="ols3g" size="8" value="<?php echo$other_sub3_grd;?>"/>
    </div></td>
  </tr>
  <tr>
    <td><input type="text" name="ols4" value="<?php echo$other_sub4;?>" /></td>
    <td><div align="center">
      <input type="text" name="ols4g" size="8" value="<?php echo$other_sub4_grd;?>"/>
    </div></td>
    <td>
      <input type="text" name="ols5" value="<?php echo$other_sub5;?>" />
    </div></td>
    <td><div align="center">
      <input type="text" name="ols5g" size="8" value="<?php echo$other_sub5_grd;?>"/>
    </div></td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" colspan="2" >Sports<br>
		<table border="0" align="center" with="100%" bgcolor="#e3cce7"> 
     		
		<tr><td>Athletic:-</td><td colspan="3">Please mention the event</td></tr>
		<tr><td align="right">1.</td><td colspan="3"><input type="text" name="event1" size="20" value="<?php echo$event1;?>"></tr>
		<tr><td align="right">2.</td><td colspan="3"><input type="text" name="event2" size="20" value="<?php echo$event2;?>"></tr>
		<tr><td align="right">3.</td><td colspan="3"><input type="text" name="event3" size="20" value="<?php echo$event3;?>"></tr>
		<tr><td align="right">4.</td><td colspan="3"><input type="text" name="event4" size="20" value="<?php echo$event4;?>"></tr>
		<tr><td align="right">5.</td><td colspan="3"><input type="text" name="event5" size="20" value="<?php echo$event5;?>"></tr>
		
		<tr><td>Criket</td><td align="left">
		<?php
		if($Criket=="Criket"){
			echo'<input type="checkbox" name="ckt" value="Criket" checked></td>';
					}
		else{echo'<input type="checkbox" name="ckt" value="Criket"></td>';}
		?>
		<td>Rugger</td><td align="left">
		<?php
		if($Rugger=="Rugger"){
			echo'<input type="checkbox" name="rgr" value="Rugger" checked></td></tr>';
					}
		else{echo'<input type="checkbox" name="rgr" value="Rugger"></td></tr>';}
		?>
		<tr><td>Football</td><td align="left">
		<?php
		if($Football=="Football"){
			echo'<input type="checkbox" name="ftb" value="Football" checked></td>';
					  }
		else{echo'<input type="checkbox" name="ftb" value="Football"></td>';}
		?>
		<td>Volyball</td><td align="left">
		<?php
		if($Volyball=="Volyball"){
			echo'<input type="checkbox" name="vbl" value="Volyball" checked></td></tr>';
					   }
		else{echo'<input type="checkbox" name="vbl" value="Volyball"></td></tr>';}
		?>
		<tr><td>Swimming</td><td align="left">
		<?php
		if($Swimming=="Swimming"){
			echo'<input type="checkbox" name="swm" value="Swimming" checked></td>';
					  }
		else{echo'<input type="checkbox" name="swm" value="Swimming"></td>';}

		?>
		<td>Judo</td><td align="left">
		<?php
		if($Judo=="Judo"){
			echo'<input type="checkbox" name="jod" value="Judo" checked></td></tr>';
				   }
		else{echo'<input type="checkbox" name="jod" value="Judo"></td></tr>';}

		?>
		<tr><td>Batminton</td><td align="left">
		<?php
		if($Batminton=="Batminton"){
			echo'<input type="checkbox" name="btm" value="Batminton" checked></td>';
						}
		else{echo'<input type="checkbox" name="btm" value="Batminton"></td>';}

		?>
		<td>Karate</td><td align="left">
		<?php
		if($Karate=="Karate"){
			echo'<input type="checkbox" name="krt" value="Karate" checked></td></tr>';
					}
		else{echo'<input type="checkbox" name="krt" value="Karate"></td></tr>';}

		?>
		
		<tr><td>Other Sports:-</td><td colspan="3"><input type="text" name="other" size="20" value="<?php echo$other_sport;?>"></td></tr>
		<tr><td colspan="4" align="center">Performance at</td></tr>
		<tr><td align="right">School Level<br> Colours</td><td align="left" colspan="3">
		<?php
		if($sp_sch_colors=="sp_sch_col_yes"){
			echo'<input type="checkbox" name="ssc_col" value="sp_sch_col_yes" checked></td></tr>';
							}
		else{echo'<input type="checkbox" name="ssc_col" value="sp_sch_col_yes"></td></tr>';}
		
		?>
		<tr><td>Other</td><td colspan="3"><input type="text" name="sscl_oth" size="17" value="<?php echo$spt_others_colors;?>"></td></tr>
		<tr><td>Zonal /District, <br>National Level</td><td colspan="3"><textarea name="szon" cols="20" rows="2"><?php echo$spt_zonal_col;?></textarea></td></tr>
    
		</table>    
		<?php
		if($disabilityst=="nil"){
		echo "<br>Do you have any known disabilities?:";
		echo"<input type='hidden' name='valid' value='reload'>";
		echo"&nbsp;&nbsp;&nbsp;<a href=# onclick=senddata('yes','$fst')>Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo"<a href=# onclick=senddata('no','$fst')>No</a> ";
				
		echo '<table border="0" cellpadding="3" cellspacing="0" width="325px" align="center">';
		echo '<tr><td width="250px" align="center">';
		echo "<img style='visibility: hidden' id='loader' src='../images/ajax-loader.gif'>";
		echo '<div id="disabl"></div>';
		echo'</table>';
		}
		elseif($disabilityst=="no"){
		    echo"<br>You have no any disability<br>";
			echo "Do you want update disability status?:";
			echo"<input type='hidden' name='valid' value='reload'>";
			echo"&nbsp;&nbsp;&nbsp;<a href=# onclick=senddata('yes','$fst')>Yes</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo"<a href=# onclick=senddata('no','$fst')>No</a> ";
				
			echo '<table border="0" cellpadding="3" cellspacing="0" width="325px" align="center">';
			echo '<tr><td width="250px" align="center">';
			echo "<img style='visibility: hidden' id='loader' src='../images/ajax-loader.gif'>";
			echo '<div id="disabl"></div>';
			echo'</table>';
						}
		elseif($disabilityst=="yes"){
			echo"<br>";
			echo"<input type='hidden' name='valid' value='reload'>";
			echo"Display My Disability Status&nbsp;&nbsp;&nbsp;<a href=# onclick=dispdata('disp','$fst','$herg','$visn','$phy_disability','$supt','$spt_specify','$take_medicine','$medic_specify')>Show</a>";
			
			//echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=# >Hide</a>";
			
			//echo "<br>If you want Delete your disability status ?   ";
			//echo"<a href=# onclick=senddata('del','$fst')>Delete</a> ";
			
			echo '<table border="0" cellpadding="3" cellspacing="0" width="325px" align="center">';
			echo '<tr><td width="250px" align="center">';
			echo "<img style='visibility: hidden' id='loader' src='../images/ajax-loader.gif'>";
			echo '<div id="disabl"></div>';
			echo'</table>';
	
			
									}
		

		?>
	</td>
	<td valign="top" colspan="2">Other Talents/Skills<br>
     		<table border="0" align="center" with="350px" bgcolor="#e3cce7"> 
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td> Drawing & Painting </td><td align="center">
		<?php
		if($Drawing=="Drawing"){

 			echo'<input type="checkbox" name="drw" value="Drawing" checked></td></tr>';
					}
		else{echo'<input type="checkbox" name="drw" value="Drawing"></td></tr>';}
		?>
		<tr><td> Music </td><td align="center">
		<?php
		if($Music=="Music"){
			echo'<input type="checkbox" name="mus" value="Music" checked></td></tr>';
					}
		else{echo'<input type="checkbox" name="mus" value="Music"></td></tr>';}
		?>
		<tr><td> Dancing </td><td align="center">
		<?php
		if($Dancing=="Dancing"){
			echo'<input type="checkbox" name="dac" value="Dancing" checked></td></tr>';
					}
		else{echo'<input type="checkbox" name="dac" value="Dancing"></td></tr>';}
		?>
		<tr><td> Singing </td><td align="center">
		<?php
		if($Singing=="Singing"){
			echo'<input type="checkbox" name="sin" value="Singing" checked></td></tr>';
					}
		else{echo'<input type="checkbox" name="sin" value="Singing"></td></tr>';}
		?>
		<tr><td colspan="2" align="center">Performance at</td></tr>
		<tr><td align="right">School Level<br> Colours</td><td align="left">
		<?php
		if($Sch_Lvl_Cls=="tale_col_yes"){
			echo'<input type="checkbox" name="s_col" value="tale_col_yes" checked></td></tr>';
						  }
		else{echo'<input type="checkbox" name="s_col" value="tale_col_yes"></td></tr>';}
		?>
		<tr><td>Other</td><td><input type="text" name="scl_oth" size="19" value="<?php echo$other_talents;?>"></td></tr>
		<tr><td>Zonal /District, <br>National Level</td><td><textarea name="zon" cols="22" rows="2"><?php echo$zonal_talents;?></textarea></td></tr>
		</table>
      
    	<br>ICT Computing Skills
		<table border="0" align="center" with="100%" bgcolor="#e3cce7"> 
		<tr><td>Programming Language</td><td><input type="text" name="ictplg1" size="14" value="<?php echo$pglg1;?>"></td></tr>
		<tr><td>&nbsp;</td><td><input type="text" name="ictplg2" size="14" value="<?php echo$pglg2;?>"></td></tr>
		<tr><td>&nbsp;</td><td><input type="text" name="ictplg3" size="14" value="<?php echo$pglg3;?>"></td></tr>
		<tr><td>&nbsp;</td><td><input type="text" name="ictplg4" size="14" value="<?php echo$pglg4;?>"></td></tr>
		<tr><td>&nbsp;</td><td><input type="text" name="ictplg5" size="14" value="<?php echo$pglg5;?>"></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td>Certificate/Diploma/Degree<br>Courses:completted</td><td><input type="text" name="ictceti1" size="14" value="<?php echo$cetif1;?>"></td></tr>
		<tr><td>&nbsp;</td><td><input type="text" name="ictceti2" size="14" value="<?php echo$cetif2;?>"></td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td>Present Following</td><td><input type="text" name="ictfol1" size="14" value="<?php echo$follow1;?>"></td></tr>
		<tr><td>&nbsp;</td><td><input type="text" name="ictfol2" size="14" value="<?php echo$follow2;?>"></td></tr>
		</table>



		
	</td>
    	
	
  </tr>
	
  <tr>
    <td colspan="4"><div align="center"><span class="style2">Guardian's Informations </span></div></td>
    
  </tr>
  <tr>
    <td>Name With Initials </td>
    <td colspan="2">
      <input type="text" name="pname" size="50" value="<?php echo$gr_name;?>"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">Permanent Address</td>
    <td colspan="2" valign="top">
      <textarea name="padd" cols="40" rows="3" ><?php echo$gr_add;?></textarea></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Contact No :- </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">Mobile</div></td>
    <td>:
      <input type="text" name="pmobi" size="16" value="<?php echo$gr_mobi;?>"/></td>
    <td><div align="left">Home:
        <input type="text" name="phm" size="16" value="<?php echo$gr_hom;?>"/>
    </div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Occupation</td>
    <td colspan="2">
      <input type="text" name="occu"  size="50" value="<?php echo$gr_occup;?>"/></td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><form id="form2" name="form2" method="post" action="">

        <div align="right">
          <input type="submit" name="Submit" value="Finish" onclick="return checkgr(this.form)"/>
        </div>
    </form>    </td>
    <td><input type="reset" value="Reset" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
