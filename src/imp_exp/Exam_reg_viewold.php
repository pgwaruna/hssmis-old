<?php
//error_reporting(0);
session_start();
if((isset($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){

include'../connection/connection.php';

$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from rumisdb.role where role='$role'";
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
echo"<a href='../index.php?view=admin&admin=58'><img border='0' src='../images/small/back.png' align='left'><br>Go Back</a><br><br>";

	//$stream_reg=$_POST['stream'];
	$level_reg=$_POST['stlvl'];
	$acedemic_reg=$_POST['cracy'];
	$semister_reg=$_POST['crsem'];
	

	echo "<b>Exam Registration Details of Level ".$level_reg."&nbsp;Student,&nbsp;&nbsp;&nbsp;";
	echo " Accademic Year : ".$acedemic_reg."&nbsp;&nbsp;&nbsp;&nbsp; Semester : ".$semister_reg."</b><br>";
	echo"<font color=red>Note :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( 0 = Not Decide )&nbsp;&nbsp;&nbsp;( 1 = Eligible )&nbsp;&nbsp;&nbsp;( 2 = Not Eligible )&nbsp;&nbsp;&nbsp;( [nd] = Non Degree )</font><br>";
						
	include '../admin/config.php';					
	$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);


	$query1_2="select distinct ex.course from exam_registration ex, student s,level l, courseunit c where ex.acedemic_year='$acedemic_reg' and (ex.semester='$semister_reg') and l.level='$level_reg' and l.year=s.year and s.id=ex.student and ex.course=c.code order by c.level,ex.course";
	

	$reg_once=mysql_query($query1_2);
    if(mysql_num_rows($reg_once)){

	echo '<table border="1"  bordercolor="#993366"><tr><th>Student No<th>Degree Medium';
	while($data=mysql_fetch_array($reg_once)){
	echo '<th style="writing-mode:	tb-rl; filter:flipH() flipV()">';
	$exsub=$data['course'];
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





	}

	

	
	
	$query1_3="select distinct ex.student, s.batch,s.medium from exam_registration ex, level l, student s where ex.acedemic_year='$acedemic_reg' and (ex.semester='$semister_reg') and ex.student=s.id and s.year=l.year and l.level='$level_reg' order by ex.student";

	$reg_two=mysql_query($query1_3);
	while($data2=mysql_fetch_array($reg_two)){
		$stmedm=$data2['medium'];
		if($stmedm=="select"){
			$stmedm2="-";
					}
		else{
			$stmedm2=$stmedm;
			}

	echo '<tr>';
	echo "<td>SC/".$data2['batch']."/".strtoupper($data2['student'])."<td align=center>$stmedm2";
	
	$student_select=$data2['student'];

		$quereg_once=mysql_query($query1_2);
		while($qureg_once=mysql_fetch_array($quereg_once)){
			$exregcos=$qureg_once['course'];
				echo"<td align=center>";

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
				echo"&nbsp;";
				}




									}
	
	}
	echo "</table>";
	}
else{
    echo"<br><font color=red>Sorry ! There are no registered student for examination.</font>";
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

