<?php

include '../../admin/config.php';
//$host="localhost";  $db="sathiska";  $user="sathiska";  $pass="sathiska852";
$con=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);

echo "creating Table student_personal_detais.....<br>";

$data1="CREATE TABLE student_personal_detais (
  stno varchar(16)  NOT NULL,
  lname varchar(50)  NOT NULL,
  initials varchar(20)  NOT NULL,
  nic varchar(16) DEFAULT NULL,
  dob date DEFAULT NULL,
  gender varchar(8) DEFAULT NULL,
  padd1 varchar(50) DEFAULT NULL,
  padd2 varchar(50) DEFAULT NULL,
  padd3 varchar(50) DEFAULT NULL,
  padd4 varchar(50) DEFAULT NULL,
  tadd1 varchar(50) DEFAULT NULL,
  tadd2 varchar(50) DEFAULT NULL,
  tadd3 varchar(50) DEFAULT NULL,
  tadd4 varchar(50) DEFAULT NULL,
  tel_home varchar(20) DEFAULT NULL,
  tel_mobile varchar(20) DEFAULT NULL,
  email varchar(50) DEFAULT NULL,
  cstatus varchar(12) DEFAULT NULL,
  weight float DEFAULT NULL,
  nationality varchar(20) DEFAULT NULL,
  height float DEFAULT NULL,
  district varchar(20) DEFAULT NULL,
  religion varchar(20) DEFAULT NULL,
  bloodgp varchar(5) DEFAULT NULL,
  combinations varchar(20) DEFAULT NULL,
  alyear varchar(8) DEFAULT NULL,
  alindexno varchar(12) DEFAULT NULL,
  zscore float DEFAULT NULL,
  gtmarks int(5) DEFAULT NULL,
  physics varchar(5) DEFAULT NULL,
  chemistry varchar(5) DEFAULT NULL,
  com_maths varchar(5) DEFAULT NULL,
  biology varchar(5) DEFAULT NULL,
  gen_english varchar(5) DEFAULT NULL,
  addi_subject varchar(20) DEFAULT NULL,
  add_sub_grd varchar(5) DEFAULT NULL,
  olyear varchar(8) DEFAULT NULL,
  olindexno varchar(12) DEFAULT NULL,
  mathematics varchar(5) DEFAULT NULL,
  science varchar(5) DEFAULT NULL,
  buddhism varchar(5) DEFAULT NULL,
  soc_s_n_history varchar(5) DEFAULT NULL,
  sinhala varchar(5) DEFAULT NULL,
  engilsh varchar(5) DEFAULT NULL,
  art_sub varchar(20) DEFAULT NULL,
  art_sub_grd varchar(5) DEFAULT NULL,
  other_sub1 varchar(20) DEFAULT NULL,
  other_sub1_grd varchar(5) DEFAULT NULL,
  other_sub2 varchar(20) DEFAULT NULL,
  other_sub2_grd varchar(5) DEFAULT NULL,
  other_sub3 varchar(20) DEFAULT NULL,
  other_sub3_grd varchar(5) DEFAULT NULL,
  other_sub4 varchar(20) DEFAULT NULL,
  other_sub4_grd varchar(5) DEFAULT NULL,
  other_sub5 varchar(20) DEFAULT NULL,
  other_sub5_grd varchar(5) DEFAULT NULL,
  athletic_events varchar(50) DEFAULT NULL,
  sports varchar(100) DEFAULT NULL,
  sp_sch_colors varchar(50) DEFAULT NULL,
  spt_others_colors varchar(50) DEFAULT NULL,
  spt_zonal_col text ,
  other_sport varchar(20) DEFAULT NULL,
  talent varchar(50) DEFAULT NULL,
  other_talents varchar(100) DEFAULT NULL,
  zonal_talents text ,
  ict_prg_lgs varchar(50) DEFAULT NULL,
  ict_certificate varchar(250) DEFAULT NULL,
  ict_following varchar(250) DEFAULT NULL,
  disability varchar(5) NOT NULL DEFAULT 'nil',
  hearing varchar(20) NOT NULL DEFAULT 'ok',
  vision varchar(20) NOT NULL DEFAULT 'ok',
  phy_disability text ,
  support varchar(15) NOT NULL,
  spt_specify text ,
  take_medicine varchar(15) NOT NULL,
  medic_specify text ,
  gr_name varchar(70) DEFAULT NULL,
  gr_add text ,
  gr_mobi varchar(20) DEFAULT NULL,
  gr_hom varchar(20) DEFAULT NULL,
  gr_occup varchar(50) DEFAULT NULL,
  PRIMARY KEY (stno),
  UNIQUE KEY nic(nic))";
$add=mysql_query($data1);
if($add){
echo "student_personal_detais created successfully<br><br>";
}
else{
echo "Cannot create student_personal_detais Table...<br> ";
}
mysql_close($con);

?>
