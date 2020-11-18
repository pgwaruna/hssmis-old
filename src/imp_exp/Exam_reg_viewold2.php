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
             $level_reg2="Level $level_reg";      
        }
    
    
	$acedemic_reg=$_POST['cracy'];
	$semister_reg=$_POST['crsem'];
	

	echo "<b>Exam Registration Details of ".$level_reg2."&nbsp;Student,&nbsp;&nbsp;&nbsp;";
	echo " Accademic Year : ".$acedemic_reg."&nbsp;&nbsp;&nbsp;&nbsp; Semester : ".$semister_reg."</b><br>";
	echo"<font color=red>Note :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( 0 = Not Decide )&nbsp;&nbsp;&nbsp;( 1 = Eligible )&nbsp;&nbsp;&nbsp;( 2 = Not Eligible )&nbsp;&nbsp;&nbsp;( NA = Not Applied )&nbsp;&nbsp;&nbsp;( [nd] = Non Degree )</font><br>";
						
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
    $query1_2="select code from courseunit where (semister=$semister_reg2 or code='IMT1b2b') and level='1' and availability=1 order by level,code";
    
            }

    elseif($level_reg==2){
    $query1_2="select code from courseunit where (semister=$semister_reg2  or code='IMT2b2b') and (level='1' or level='2') and availability=1 order by level,code";
                }
    else{
    $query1_2="select code from courseunit where (semister=$semister_reg2 or code='IMT3b1b') and availability=1 order by level,code";

        }
//////////////////////////////////////////////////////////////////////////
	//$query1_2="select distinct ex.course from exam_registration ex, student s,level l, courseunit c where ex.acedemic_year='$acedemic_reg' and (ex.semester='$semister_reg') and l.level='$level_reg' and l.year=s.year and s.id=ex.student and ex.course=c.code order by c.level,ex.course";
	

	$reg_once=mysql_query($query1_2);
    if(mysql_num_rows($reg_once)!=0){

    
        
        
    $tclm=0;
	echo '<table border="1"  bordercolor="#993366"><tr><th>Student No<th>Degree Medium';
	while($data=mysql_fetch_array($reg_once)){
	echo '<th style="writing-mode:	tb-rl; filter:flipH() flipV()">';
	$exsub=$data['code'];
		////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($exsub);
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
			$course=$fulcode;


		echo$course;



$tclm++;

	}

	

	
	
	$query1_3="select distinct ex.student, s.batch,s.medium from exam_registration ex, level l, student s where ex.acedemic_year='$acedemic_reg' and (ex.semester='$semister_reg') and ex.student=s.id and s.year=l.year and l.level='$level_reg' order by ex.student";

	$reg_two=mysql_query($query1_3);
    if(mysql_num_rows($reg_two)!=0){
   
	while($data2=mysql_fetch_array($reg_two)){
		$stmedm=$data2['medium'];
		if($stmedm=="select"){
			$stmedm2="-";
					}
		else{
			$stmedm2=$stmedm;
			}

    $stalreg=array();
    $stcrrreg=array();

	echo '<tr>';
	echo "<td>SC/".$data2['batch']."/".strtoupper($data2['student'])."<td align=center>$stmedm2";
	
	$student_select=$data2['student'];
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
            echo"<td align=center>";
            
			/*	
                for($q=0;$q<25;$q++){
                   echo$stalreg[$q].",";
                }
            */
            if(in_array($exregcos3,$stalreg)){

			$quechkexreg="select confirm, degree from exam_registration where student='$student_select' and course='$exregcos' and acedemic_year='$acedemic_reg' and semester=$semister_reg";
			
			$quchkexreg=mysql_query($quechkexreg);
			if(mysql_num_rows($quchkexreg)!=0){
				while($qchkexreg=mysql_fetch_array($quchkexreg)){
						$cnfst=$qchkexreg['confirm'];
						$dgst=$qchkexreg['degree'];
							if($dgst==1){
								$dgst2="&nbsp;";
									}
							else{
								$dgst2="-<font color=red>[nd]</font>";
								}
						echo$cnfst.$dgst2;

											}

								}
			else{
			    if(in_array($exregcos3, $stcrrreg)){
                
                	echo"NA";
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


									}
	
	}

}
else{
    $clsp=$tclm+2;
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

