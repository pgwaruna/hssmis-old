<?php

/////////////////////////// current date////////////////////////////////
error_reporting(0);
$today=date("Y-m-d");
////////////////////////////////////////////////////////////////////////




/////////////////////// chack call registration status///////////////////////
$queclregis="select closing_date, level from call_registration where register='1'";
$quclregis=mysql_query($queclregis);
if(mysql_num_rows($quclregis)!='0'){
	while($qclregis=mysql_fetch_array($quclregis)){
	$clregis=$qclregis['closing_date'];
	$level=$qclregis['level'];
		//echo$clregis;
		$clregst=strtotime($today) - strtotime($clregis);
		
			if($clregst>0){
				//echo"regi off";
				$queupregst="update call_registration set register='0' where level=$level";
				mysql_query($queupregst);
					}
	}
					}//call registration status close IF
//////////////////////////////////////////////////////////////////////////////




/////////////////////// chack call_combination status///////////////////////
$queclcmb="select closing_date from call_combination where status='1'";
$quclcmb=mysql_query($queclcmb);
if(mysql_num_rows($quclcmb)!='0'){
	$qclcmb=mysql_fetch_array($quclcmb);
	$clcmb=$qclcmb['closing_date'];
		//echo$clcmb;
		$clcmbst=strtotime($today) - strtotime($clcmb);
		
			if($clcmbst>0){
				//echo"regi off";
				$queupcmbst="update call_combination set status='0'";
				mysql_query($queupcmbst);
					}

					}//call_combination status close IF
//////////////////////////////////////////////////////////////////////////////





/////////////////////// chack call_exam_registration status///////////////////////
$queclexreg="select closing_date from call_exam_registration where status='1'";
$quclexreg=mysql_query($queclexreg);
if(mysql_num_rows($quclexreg)!='0'){
	$qclexreg=mysql_fetch_array($quclexreg);
	$clexreg=$qclexreg['closing_date'];
		//echo$clexreg;
		$clexregst=strtotime($today) - strtotime($clexreg);
		
			if($clexregst>0){
				//echo"regi off";
				$queupexregst="update call_exam_registration set status='0'";
				mysql_query($queupexregst);
					}

					}//call_exam_registration status close IF
//////////////////////////////////////////////////////////////////////////////



/////////////////////// chack call_prac_registration status///////////////////////
$queclpracreg="select end_date from call_prac_registration where status='1'";
$quclpracreg=mysql_query($queclpracreg);
if(mysql_num_rows($quclpracreg)!='0'){
	$qclpracreg=mysql_fetch_array($quclpracreg);
	$clpracreg=$qclpracreg['end_date'];
		//echo$clpracreg;
		$clpracregst=strtotime($today) - strtotime($clpracreg);
		
			if($clpracregst>0){
				//echo"regi off";
				$queuppracregst="update call_prac_registration set status='0'";
				mysql_query($queuppracregst);
					}

					}//call_prac_registration status close IF
//////////////////////////////////////////////////////////////////////////////////



/////////////////////// chack call_special_application///////////////////////
$queclspreg="select end_data from call_special_application where status='1'";
$quclspreg=mysql_query($queclspreg);
if(mysql_num_rows($quclspreg)!='0'){
    $qclspreg=mysql_fetch_array($quclspreg);
    $clspreg=$qclspreg['end_data'];
        //echo$clspreg;
        $clspregst=strtotime($today) - strtotime($clspreg);

            if($clspregst>0){
                //echo"regi off";
                $queupspregst="update call_special_application set status='0'";
              	mysql_query($queupspregst);

                    }

                    }//call_special_application status close IF
/////////////////////////////////////////////////////////////////////////////////////



////////////////////// check special registration////////////////////////////////////
$queclsreg="select * from sp_call_registration where status=1";
$quclsreg=mysql_query($queclsreg);
if(mysql_num_rows($quclsreg)!=0){
    while($qclsreg=mysql_fetch_array($quclsreg)){
            $regend_date=$qclsreg['end_date'];
        
                $regend_datediff=strtotime($today) - strtotime($regend_date);
                
                if($regend_datediff>0){
                    $department=$qclsreg['department'];
                    $academic_year=$qclsreg['academic_year'];
                    $level=$qclsreg['level'];
                    $semester=$qclsreg['semester'];
                     
                        $queupdtonrow="update sp_call_registration set status=0 where department='$department' and  academic_year='$academic_year' and level=$level and semester=$semester";
                        //echo$queupdtonrow;
                        mysql_query($queupdtonrow);
                }
                
                
                
        
    }
    
    
}
/////////////////////////////////////////////////////////////////////////////////////










mysql_close($condatevalidation);
?>
