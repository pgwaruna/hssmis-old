<?php
session_start();
if(isset($_SESSION['login'])=="truefohssmis"){
?>




<style type="text/css">
@import url('../style/default.css');
</style>


<?php
$student=$_POST['student'];
$task=$_POST['task'];

include '../admin/config.php';
mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);


//...............get acc_year....................
$acc_year="select acedemic_year from acc_year where current='1'";
$ac_year=mysql_query($acc_year);
while($a_y=mysql_fetch_array($ac_year)){
$acy=$a_y['acedemic_year'];
}
$acyer=explode("_",$acy);
$acycur=$acyer[0];
$acynx=$acyer[1];

//.................................................



//.............get student id and name from student table.....

$quepers="select * from student where id='$student'";
$qupers=mysql_query($quepers);
if(mysql_num_rows($qupers)!='0'){
while($qpers=mysql_fetch_array($qupers)){
$idn=$qpers['id'];
$lnm=$qpers['l_name'];
$inin=$qpers['initials'];
$bch=$qpers['batch'];
}
$fst="SC/".$bch."/".$idn;
$fnm=$lnm." ".$inin;
}
else{
$quepers2="select * from rumisdb.fohssmis where user='sc$student'";
//echo$quepers2;
$qupers2=mysql_query($quepers2);
while($qpers2=mysql_fetch_array($qupers2)){
$idn=$qpers2['user'];
$lnm=$qpers2['l_name'];
$inin=$qpers2['initials'];
$fst="SC/".$acycur."/".$student;
$fnm=$lnm." ".$inin;
}
}
//..........................................................
echo"<div id='a'>";
if($task!="regicom"){
echo"<table border='0' width='90%'><tr><td align='center' width='50px'><img border='0' src='../images/small/back.png'>";
echo"<form method='POST' action='../forms/personal_info.php'><input type='hidden' name='task' value='fill'><input type='hidden' name='student' value=$student><input type='submit' value='Go Back'></form></td>";
echo"<td align='center'><h2>Personal Information</h2>"; 
echo"</tr></td></table>";
echo"<table border='0' with='100%' align='center'>";
echo"<tr><td>Student No </td><td>: ";
echo$fst;
echo"</td></tr><tr><td>Name With Initials <td>";
echo": ".$fnm;
echo"</td></tr>";

echo"</table>";
}
if($task=="regis1"){
$nic_2=$_POST['nic'];

	$ye_2=$_POST['year'];
	$mo_2=$_POST['month'];
	$dt_2=$_POST['dated'];
$dob_2=$ye_2."-".$mo_2."-".$dt_2;

$gen_2=$_POST['gender'];
$padd1_2=$_POST['padd1'];
$padd2_2=$_POST['padd2'];
$padd3_2=$_POST['padd3'];
$padd4_2=$_POST['padd4'];
$tadd1_2=$_POST['tadd1'];
$tadd2_2=$_POST['tadd2'];
$tadd3_2=$_POST['tadd3'];
$tadd4_2=$_POST['tadd4'];
$telih_2=$_POST['home'];
$telim_2=$_POST['mobile'];
$email_2=$_POST['email'];
$cstat_2=$_POST['cstate'];
$weight_2=$_POST['weight'];
$nation_2=$_POST['nation'];
$height_2=$_POST['height'];
$distr_2=$_POST['district'];
$relg_2=$_POST['relig'];
$blgp_2=$_POST['blgp'];
$scream_2=$_POST['combination'];
//echo$nic_2.$ye_2.$mo_2.$dt_2.$gen_2.$padd1_2.$padd2_2.$padd3_2.$padd4_2.$tadd1_2.$tadd2_2.$tadd3_2.$tadd4_2.$telih_2.$telim_2.$email_2.$cstat_2.$nation_2.$distr_2.$blgp_2.$dob_2;
$quecknic="select stno,	nic from student_personal_detais where nic='$nic_2'";
$qucknic=mysql_query($quecknic);
if(mysql_num_rows($qucknic)!=0){
while($qcknic=mysql_fetch_array($qucknic)){
$ckstno=$qcknic['stno'];
$cknic=$qcknic['nic'];
					  }
if($ckstno==$fst){
$queupdt="update student_personal_detais set nic='$nic_2', dob='$dob_2',gender='$gen_2', padd1='$padd1_2', padd2='$padd2_2', padd3='$padd3_2', padd4='$padd4_2', tadd1='$tadd1_2', tadd2='$tadd2_2', tadd3='$tadd3_2', tadd4='$tadd4_2', tel_home='$telih_2', tel_mobile='$telim_2', email='$email_2', cstatus='$cstat_2', 	weight='$weight_2', nationality='$nation_2', height='$height_2',district='$distr_2', religion='$relg_2', bloodgp='$blgp_2', combinations='$scream_2'  where stno='$fst'";
//echo$queupdt;
mysql_query($queupdt);
include 'personalB.php';
		}
	else{
		echo"<div align='center'><font size='2px' color='red'>Duplicate National Identity Card(NIC) Number ! </font></div>";
		include 'personal.php';
		}

				}
else{
$queupdt="update student_personal_detais set nic='$nic_2', dob='$dob_2',gender='$gen_2', padd1='$padd1_2', padd2='$padd2_2', padd3='$padd3_2', padd4='$padd4_2', tadd1='$tadd1_2', tadd2='$tadd2_2', tadd3='$tadd3_2', tadd4='$tadd4_2', tel_home='$telih_2', tel_mobile='$telim_2', email='$email_2', cstatus='$cstat_2', 	weight='$weight_2', nationality='$nation_2', height='$height_2',district='$distr_2', religion='$relg_2', bloodgp='$blgp_2', combinations='$scream_2'  where stno='$fst'";
//echo$queupdt;
mysql_query($queupdt);
include 'personalB.php';}
}


if($task=="regicom"){
$alyear_2=$_POST['alyear'];
$alindexno_2=$_POST['alindex'];
$zscore_2=$_POST['zscore'];
$gtmarks_2=$_POST['gent'];
$physics_2=$_POST['phy'];
$chemistry_2=$_POST['che'];
$com_maths_2=$_POST['cmath'];
$biology_2=$_POST['bio'];
$gen_english_2=$_POST['eng'];
$addi_subject_2=$_POST['adisub'];
$add_sub_grd_2=$_POST['othg'];
$olyear_2=$_POST['olyear'];
$olindexno_2=$_POST['olindex'];
$mathematics_2=$_POST['olsmg'];
$science_2=$_POST['olssg'];
$buddhism_2=$_POST['olsbg'];
$soc_s_n_history_2=$_POST['olssshg'];
$sinhala_2=$_POST['olssig'];
$engilsh_2=$_POST['olseg'];
$art_sub_2=$_POST['art'];
$art_sub_grd_2=$_POST['olsag'];
$other_sub1_2=$_POST['ols1'];
$other_sub1_grd_2=$_POST['ols1g'];
$other_sub2_2=$_POST['ols2'];
$other_sub2_grd_2=$_POST['ols2g'];
$other_sub3_2=$_POST['ols3'];
$other_sub3_grd_2=$_POST['ols3g'];
$other_sub4_2=$_POST['ols4'];
$other_sub4_grd_2=$_POST['ols4g'];
$other_sub5_2=$_POST['ols5'];
$other_sub5_grd_2=$_POST['ols5g'];

$ath_eve1=$_POST['event1'];
$ath_eve2=$_POST['event2'];
$ath_eve3=$_POST['event3'];
$ath_eve4=$_POST['event4'];
$ath_eve5=$_POST['event5'];
$ath_events=$ath_eve1."/".$ath_eve2."/".$ath_eve3."/".$ath_eve4."/".$ath_eve5;

$spt1=$_POST['ckt'];
$spt2=$_POST['rgr'];
$spt3=$_POST['ftb'];
$spt4=$_POST['vbl'];
$spt5=$_POST['swm'];
$spt6=$_POST['jod'];
$spt7=$_POST['btm'];
$spt8=$_POST['krt'];
$sports=$spt1."/".$spt2."/".$spt3."/".$spt4."/".$spt5."/".$spt6."/".$spt7."/".$spt8;

$other_spt=$_POST['other'];
$scho_col=$_POST['ssc_col'];
$other_spt_col=$_POST['sscl_oth'];
$zonal_spt=$_POST['szon'];	

$disability=$_POST['dsbl_stat'];
$hearing=$_POST['hearing'];
$vision=$_POST['vision'];
$phy_dise=$_POST['phycaldsb'];
$support=$_POST['spt'];
$spt_spec=$_POST['sptyes'];
$take_medi=$_POST['deses'];
$medic_spec=$_POST['desesyes'];

$tlnt1=$_POST['drw'];
$tlnt2=$_POST['mus'];
$tlnt3=$_POST['dac'];
$tlnt4=$_POST['sin'];
$tlnt_col=$_POST['s_col'];
$talent=$tlnt1."/".$tlnt2."/".$tlnt3."/".$tlnt4."/".$tlnt_col;

$other_tlnt=$_POST['scl_oth'];
$zonal_tlnt=$_POST['zon'];

$it_pg_lg1=$_POST['ictplg1'];
$it_pg_lg2=$_POST['ictplg2'];
$it_pg_lg3=$_POST['ictplg3'];
$it_pg_lg4=$_POST['ictplg4'];
$it_pg_lg5=$_POST['ictplg5'];
$ict_pg_lgs=$it_pg_lg1."/".$it_pg_lg2."/".$it_pg_lg3."/".$it_pg_lg4."/".$it_pg_lg5;

$ict_certi1=$_POST['ictceti1'];
$ict_certi2=$_POST['ictceti2'];
$ict_cetificate=$ict_certi1."/".$ict_certi2;

$ict_fol1=$_POST['ictfol1'];
$ict_fol2=$_POST['ictfol2'];
$ict_following=$ict_fol1."/".$ict_fol2;

$gr_name_2=$_POST['pname'];
$gr_add_2=$_POST['padd'];
$gr_mobi_2=$_POST['pmobi'];
$gr_hom_2=$_POST['phm'];
$gr_occup_2=$_POST['occu'];

$valid=$_POST['valid'];

echo"<div align='center'>";
echo"<br>";
echo"<table border='0' width='100%'><tr>";
echo"<td align='center'><h2>Personal Information</h2>"; 
echo"</tr></td></table>";
echo"<table border='0' with='100%' align='center'>";
echo"<tr><td>Student No </td><td>: ";
echo$fst;
echo"</td></tr><tr><td>Name With Initials <td>";
echo": ".$fnm;
echo"</td></tr>";
echo"<tr><td colspan='2'>&nbsp;</td></tr>";


if(($valid=="reload")&&($disability=="yes")){

$queupdt2="update student_personal_detais set alyear='$alyear_2', alindexno='$alindexno_2', zscore='$zscore_2', gtmarks='$gtmarks_2', physics='$physics_2', chemistry='$chemistry_2', com_maths='$com_maths_2', biology='$biology_2', gen_english='$gen_english_2', addi_subject='$addi_subject_2', add_sub_grd='$add_sub_grd_2', olyear='$olyear_2', olindexno='$olindexno_2', mathematics='$mathematics_2', science='$science_2', buddhism='$buddhism_2', soc_s_n_history='$soc_s_n_history_2', sinhala='$sinhala_2', engilsh='$engilsh_2', art_sub='$art_sub_2', art_sub_grd='$art_sub_grd_2', other_sub1='$other_sub1_2', other_sub1_grd='$other_sub1_grd_2', other_sub2='$other_sub2_2', other_sub2_grd='$other_sub2_grd_2', other_sub3='$other_sub3_2', other_sub3_grd='$other_sub3_grd_2', other_sub4='$other_sub4_2', other_sub4_grd='$other_sub4_grd_2', other_sub5='$other_sub5_2', other_sub5_grd='$other_sub5_grd_2', athletic_events='$ath_events', sports='$sports', other_sport='$other_spt', sp_sch_colors='$scho_col', spt_others_colors='$other_spt_col', spt_zonal_col='$zonal_spt', disability='$disability', hearing='$hearing', vision='$vision', phy_disability='$phy_dise', support='$support', spt_specify='$spt_spec', take_medicine='$take_medi',  medic_specify='$medic_spec', talent='$talent', other_talents='$other_tlnt', zonal_talents='$zonal_tlnt', ict_prg_lgs='$ict_pg_lgs', ict_certificate='$ict_cetificate', ict_following='$ict_following', gr_name='$gr_name_2', gr_add='$gr_add_2', gr_mobi='$gr_mobi_2', gr_hom='$gr_hom_2', gr_occup='$gr_occup_2' where stno='$fst'";

}

else{
$queupdt2="update student_personal_detais set alyear='$alyear_2', alindexno='$alindexno_2', zscore='$zscore_2', gtmarks='$gtmarks_2', physics='$physics_2', chemistry='$chemistry_2', com_maths='$com_maths_2', biology='$biology_2', gen_english='$gen_english_2', addi_subject='$addi_subject_2', add_sub_grd='$add_sub_grd_2', olyear='$olyear_2', olindexno='$olindexno_2', mathematics='$mathematics_2', science='$science_2', buddhism='$buddhism_2', soc_s_n_history='$soc_s_n_history_2', sinhala='$sinhala_2', engilsh='$engilsh_2', art_sub='$art_sub_2', art_sub_grd='$art_sub_grd_2', other_sub1='$other_sub1_2', other_sub1_grd='$other_sub1_grd_2', other_sub2='$other_sub2_2', other_sub2_grd='$other_sub2_grd_2', other_sub3='$other_sub3_2', other_sub3_grd='$other_sub3_grd_2', other_sub4='$other_sub4_2', other_sub4_grd='$other_sub4_grd_2', other_sub5='$other_sub5_2', other_sub5_grd='$other_sub5_grd_2', athletic_events='$ath_events', sports='$sports', other_sport='$other_spt', sp_sch_colors='$scho_col', spt_others_colors='$other_spt_col', spt_zonal_col='$zonal_spt', talent='$talent', other_talents='$other_tlnt', zonal_talents='$zonal_tlnt', ict_prg_lgs='$ict_pg_lgs', ict_certificate='$ict_cetificate', ict_following='$ict_following', gr_name='$gr_name_2', gr_add='$gr_add_2', gr_mobi='$gr_mobi_2', gr_hom='$gr_hom_2', gr_occup='$gr_occup_2' where stno='$fst'";
}
mysql_query($queupdt2);
echo"<tr><td colspan='2' align='center'><h2>Data Successfully Inserted</h2></td></tr>";
echo"<tr><td colspan='2' align='center'><a href='../index.php?view=admin'><img border='0' src='../images/small/back.png'><br>Back to Home</a></td></tr>";
echo"</table>";
echo"<br><br>";	
echo"<div>";
}




?>














<?php
}
else{
echo "You Have Not Permission To Access This Area!";}
?>
