<?php

/////////////////////////// current date////////////////////////////////
error_reporting(0);
$today=date("Y-m-d");
////////////////////////////////////////////////////////////////////////




/////////////////////// chack call registration status///////////////////////
$queclregis="select closing_date from call_registration where register='1'";
$quclregis=mysql_query($queclregis);
if(mysql_num_rows($quclregis)!='0'){
	$qclregis=mysql_fetch_array($quclregis);
	$clregis=$qclregis['closing_date'];
		//echo$clregis;
		$clregst=strtotime($today) - strtotime($clregis);
		
			if($clregst>=0){
				//echo"regi off";
				$queupregst="update call_registration set register='0'";
				mysql_query($queupregst);
					}

					}//call registration status cl;ose IF
//////////////////////////////////////////////////////////////////////////////




/////////////////////// chack call_combination status///////////////////////
$queclcmb="select closing_date from call_combination where status='1'";
$quclcmb=mysql_query($queclcmb);
if(mysql_num_rows($quclcmb)!='0'){
	$qclcmb=mysql_fetch_array($quclcmb);
	$clcmb=$qclcmb['closing_date'];
		//echo$clcmb;
		$clcmbst=strtotime($today) - strtotime($clcmb);
		
			if($clcmbst>=0){
				//echo"regi off";
				$queupcmbst="update call_combination set status='0'";
				mysql_query($queupcmbst);
					}

					}//call_combination status cl;ose IF
//////////////////////////////////////////////////////////////////////////////





/////////////////////// chack call_exam_registration status///////////////////////
$queclexreg="select closing_date from call_exam_registration where status='1'";
$quclexreg=mysql_query($queclexreg);
if(mysql_num_rows($quclexreg)!='0'){
	$qclexreg=mysql_fetch_array($quclexreg);
	$clexreg=$qclexreg['closing_date'];
		//echo$clexreg;
		$clexregst=strtotime($today) - strtotime($clexreg);
		
			if($clexregst>=0){
				//echo"regi off";
				$queupexregst="update call_exam_registration set status='0'";
				mysql_query($queupexregst);
					}

					}//call_exam_registration status cl;ose IF
//////////////////////////////////////////////////////////////////////////////



/////////////////////// chack call_prac_registration status///////////////////////
$queclpracreg="select end_date from call_prac_registration where status='1'";
$quclpracreg=mysql_query($queclpracreg);
if(mysql_num_rows($quclpracreg)!='0'){
	$qclpracreg=mysql_fetch_array($quclpracreg);
	$clpracreg=$qclpracreg['end_date'];
		//echo$clpracreg;
		$clpracregst=strtotime($today) - strtotime($clpracreg);
		
			if($clpracregst>=0){
				//echo"regi off";
				$queuppracregst="update call_prac_registration set status='0'";
				mysql_query($queuppracregst);
					}

					}//call_prac_registration status cl;ose IF
//////////////////////////////////////////////////////////////////////////////



?>
