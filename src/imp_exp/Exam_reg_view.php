<?php
//error_reporting(0);
session_start();
if((isset($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){

include'../connection/connection.php';

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole);

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}

$quepers="SELECT id FROM permission WHERE role_id=$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
    
if($qpers['id']=="58"){
$pem="TRUE";
}

}
}
else
{
echo "You Have Not Permission To Access This Area!";
}

if($pem=="TRUE")
{
?>

<?php

require_once('../classes/globalClass.php');
$o=new settings();
echo"<a href='../index.php?view=admin&admin=58'><img border='0' src='../images/small/back.png' align='left'><br>Go Back</a><br><br>";

	//$stream_reg=$_POST['stream'];
	$level_reg=$_POST['stlvl'];
    
        if($level_reg==0){
            $level_reg2="Pass Out";            
        }
        else{
             $level_reg2="Level $level_reg"."000";      
        }
    
    
	$acedemic_reg=$_POST['cracy'];
	$semister_reg=$_POST['crsem'];
	

	echo "<b>Examination Registration Details of ".$level_reg2."&nbsp;Student,&nbsp;&nbsp;&nbsp;";
	echo " Accademic Year : ".$acedemic_reg."&nbsp;&nbsp;&nbsp;&nbsp; Semester : ".$semister_reg."</b><br>";
	echo"<font color=red>Note :[ ND = Not Decided ]&nbsp;&nbsp;,&nbsp;&nbsp;[ EL = Eligible ]&nbsp;&nbsp;,&nbsp;&nbsp;[ NE = Not Eligible ]&nbsp;&nbsp;,&nbsp;&nbsp;[ NA = Not Applied ]";

echo"<br>[ Foundation Course : 1 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ Core Course : 2 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ Core Optional Course : 3 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ Extra optional Course : 4 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ Supplementary Course : 5 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ None Degree Course  : 6 ]&nbsp;&nbsp;,&nbsp;&nbsp;</font>";





	
	include '../admin/config.php';					
	$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
//////////////////////////////////////////////////////////////////////////

    if($semister_reg==1){
            $semister_reg2=1;
                    }
        else{
            $semister_reg2="2 or semister=3";
            }
/////////////////////////////////////////create table <th>/////////////////////////////////////////////////////////////
    if($level_reg==1){
    $query1_2="select code,medium from courseunit where (semister=$semister_reg2) and level=1 and availability=1 order by level,code";
    
            }

    elseif($level_reg==2){
    $query1_2="select code from courseunit where (semister=$semister_reg2  or code='IMT2b2b') and (level='1' or level='2') and availability=1 order by level,code";
                }
    else{
    $query1_2="select code from courseunit where (semister=$semister_reg2 or code='IMT3b1b') and availability=1 order by level,code";

        }
//////////////////////////////////////////////////////////////////////////
	//$query1_2="select distinct ex.course from exam_registration ex, student s,level l, courseunit c where ex.acedemic_year='$acedemic_reg' and (ex.semester='$semister_reg') and l.level='$level_reg' and l.year=s.year and s.id=ex.student and ex.course=c.code order by c.level,ex.course";
	
	//echo$query1_2;
	$reg_once=mysql_query($query1_2);
    if(mysql_num_rows($reg_once)!=0){

    
        
        
    $tclm=0;
    $nofr=1;
	echo '<table border="1"  bordercolor="#993366"><tr><th>#<th>Student No';
	while($data=mysql_fetch_array($reg_once)){
	echo '<th style="writing-mode:	tb-rl; filter:flipH() flipV()">';
	$exsub=$data['code'];
		////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($exsub);

                                $fulcode=strtoupper($coursegetchr);
                                
                                ////////////////////////////////////////////////////
			$course=$fulcode;
		////////////////////////////////////////////////////////////////////
		$quegetmdm="select medium from courseunit where code='$coursegetchr'";
		$qugetmdm=mysql_query($quegetmdm);
		if(mysql_num_rows($qugetmdm)!=0){
			$qgetmdm=mysql_fetch_array($qugetmdm);
				$getmdm=$qgetmdm['medium'];
		}
		if($getmdm==null){
			$getmdm2="SI";
		}
		else{
			$getmdm2=$getmdm;
		}

		////////////////////////////////////////////////////////////////////

		 if($getmdm=="SI+EN"){
			
			 echo "<font color=blue>".$fulcode."-SI</font>";
			 echo '<th style="writing-mode:	tb-rl; filter:flipH() flipV()"><font color=blue>'.$fulcode."-EN</font>";
			
		 }
		 else{
			 echo $fulcode;
		 }



$tclm++;

	}

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $fmviweque="$rmsdb.fohssmisStudents fs";
    
    if($level_reg!=0){
        $query1_3="select distinct(e.std_id),s.batch,s.medium from exam_registration e, level l, student s, $fmviweque where e.std_id=s.id and e.academic_year='$acedemic_reg' and (e.semester='$semister_reg' or e.semester=3) and s.year=l.year and l.level='$level_reg' and e.std_id=fs.user_name order by e.std_id";
    }
    else{
                $quegetintenallvl="select year from level where level<>0 order by year";
                $qugetintenallvl=mysql_query($quegetintenallvl);
                $intlvlyear=array();
                $iy=0;
                while($qgetintenallvl=mysql_fetch_array($qugetintenallvl)){
                    
                    $getintenallvl=$qgetintenallvl['year'];
                               $intlvlyear[$iy]=$getintenallvl;
                   $iy++;
                                                 }
        
        
         $query1_3="select distinct ex.student, s.batch,s.medium from exam_registration ex, student s where ex.acedemic_year='$acedemic_reg' and (ex.semester='$semister_reg') and ex.student=s.id and (s.year<>$intlvlyear[0] and s.year<>$intlvlyear[1] and s.year<>$intlvlyear[2] ) order by ex.student";
   
         
         
         }
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//$query1_3="select distinct ex.student, s.batch,s.medium from exam_registration ex, level l, student s where ex.acedemic_year='$acedemic_reg' and (ex.semester='$semister_reg') and ex.student=s.id and s.year=l.year and l.level='$level_reg' order by ex.student";
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //echo$query1_3;
    
	$reg_two=mysql_query($query1_3);
    if(mysql_num_rows($reg_two)!=0){
   
	while($data2=mysql_fetch_array($reg_two)){
		$stmedm=$data2['medium'];

        /////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////
        
        
        
        /////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////
        $student_select=$data2['std_id'];
			$stnulstnum = substr($student_select,2);
        $stbatch=$data2['batch'];

    $stalreg=array();
    $stcrrreg=array();

	
    
   
        echo '<tr><td align=center>'.$nofr;
			
	    echo "<td>HS/".$stbatch."/".$stnulstnum ;
	
	
 
    
    
    
    
    ///////////////////////////////////////////get all registration/////////////////////////////////
        $quegetalreg="select distinct(course) from registration where student='$student_select' and confirm=1 order by course";
        //echo $quegetalreg;
        $qugetalreg=mysql_query($quegetalreg);
        if(mysql_num_rows($qugetalreg)!=0){
            $alrg=0;
            while($qgetalreg=mysql_fetch_array($qugetalreg)){
                $getalreg=$qgetalreg['course'];
                
                    $getalreg2=trim($getalreg);
                        $getalreg3=strtoupper($getalreg2);
                
                $stalreg[$alrg]="$getalreg3";
                
                $alrg++;
            }
            
            
        }
        else{
            $stalreg[0]="no_reg";
        }
    ////////////////////////////////////end get all registration/////////////////////////////////
    
    /////////////////////////////////// get current registration///////////////////////////////////
    $quegetcrrreg="select distinct(course) from registration where student='$student_select' and acedemic_year='$acedemic_reg' and  (semister=$semister_reg2) and confirm=1 order by course";
      
        $qugetcrrreg=mysql_query($quegetcrrreg);
        if(mysql_num_rows($qugetcrrreg)!=0){
            $crrrg=0;
            while($qgetcrrreg=mysql_fetch_array($qugetcrrreg)){
                $getcrrreg=$qgetcrrreg['course'];
                
                    $getcrrreg2=trim($getcrrreg);
                        $getcrrreg3=strtoupper($getcrrreg2);
                
                $stcrrreg[$crrrg]="$getcrrreg3";
                
                $crrrg++;
            }
            
            
        }
        else{
            $stcrrreg[0]="no_reg";
        }
    
    ///////////////////////////////////end get current registration////////////////////////////////
    
    
    
		$quereg_once=mysql_query($query1_2);
		while($qureg_once=mysql_fetch_array($quereg_once)){
			$exregcos=$qureg_once['code'];
                $exregcos2=trim($exregcos);
                $exregcos3=strtoupper($exregcos2);
				
/////////////////..............................................///////////////////////////
		////////////////////////////////////////////////////////////////////
		$quegetmdm2="select medium from courseunit where code='$exregcos2'";
		$qugetmdm2=mysql_query($quegetmdm2);
		if(mysql_num_rows($qugetmdm2)!=0){
			$qgetmdm2=mysql_fetch_array($qugetmdm2);
				$getmdm2=$qgetmdm2['medium'];
		}
		if($getmdm2==null){
			$getmdm22="SI";
		}
		else{
			$getmdm22=$getmdm2;
		}
		 if($getmdm2=="SI+EN"){
			$flpelmnt=2;
		 }
		 else{
			 $flpelmnt=1;
		 }
/////////////////..............................................///////////////////////////					
				
		for($mdm=0;$mdm<$flpelmnt;$mdm++){
		if($getmdm2=="SI+EN"){
			if($mdm==0){
				$getmdm22="SI";
			}
			if($mdm==1){
				$getmdm22="EN";
			}			
			
		 }			
				

				
            echo"<td align=center>&nbsp;";
            
			/*	
                for($q=0;$q<25;$q++){
                   echo$stalreg[$q].",";
                }
            */
            if(in_array($exregcos3,$stalreg)){

			$quechkexreg="select e.course_code, e.course_type,e.status from exam_registration e, student s where e.std_id='$student_select' and e.course_code='$exregcos' and e.academic_year='$acedemic_reg' and e.semester=$semister_reg and s.id=e.std_id and s.medium='$getmdm22'";
			//echo$quechkexreg;
			$quchkexreg=mysql_query($quechkexreg);
			if(mysql_num_rows($quchkexreg)!=0){
				while($qchkexreg=mysql_fetch_array($quchkexreg)){
					$cnfstcourse_code=$qchkexreg['course_code'];
				
					
					
						$cnfst=$qchkexreg['status'];
						if($cnfst==1){
							echo"EL";
						}
						elseif($cnfst==2){
							echo"NE";
						}
						else{
							echo"ND";
						}
						
						$dgst=$qchkexreg['course_type'];
						$getcsty=explode("-",$dgst);
						echo"<br>".$getcsty[1];
							

											}

								}
			else{
			    if(in_array($exregcos3, $stcrrreg)){
					if($getmdm22==$stmedm){
						echo"NA";
					}
					else{
						echo"&nbsp;";
					}
				}
                else{
                    echo"&nbsp;";
                }

             }
            }
            
            else
            {
                echo"&nbsp;";
            }
		}///4lp cls bkt

									}
	
    $nofr++;
	
	}

}
else{
    $clsp=$tclm+3;
    echo"<tr><td align=left colspan=$clsp><font color=red>Sorry ! There are no registered student for examination.</font>";
}

	echo "</table>";
	}
else{
    echo"<br><font color=red>Sorry ! There are no course unit found.</font>";
}

						
?>



<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}

?>