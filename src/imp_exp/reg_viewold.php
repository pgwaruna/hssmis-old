<?php
session_start();
if(isset($_SESSION['login'])=="turefohssmis"){
?>






<?php
echo"<a href='../index.php?view=admin&admin=3'><img border='0' src='../images/small/back.png' align='left'><br>Go Back</a><br><br>";

	//$stream_reg=$_POST['stream'];
	$level_reg=$_POST['level'];
	$acedemic_reg=$_POST['acc_year'];
	$semister_reg=$_POST['sem'];
	

	echo "View Registration Details of Student - ";
	echo " Accademic Year : ".$acedemic_reg."&nbsp;&nbsp;&nbsp;&nbsp; Level : ".$level_reg."&nbsp;&nbsp;&nbsp;&nbsp; Semester : ".$semister_reg."<hr class=bar>";
	
						
	include '../admin/config.php';					
	$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
	
	$query1_2="select distinct r.course from registration r, courseunit c where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and c.code=r.course and c.level='$level_reg' order by r.course";
	$reg_once=mysql_query($query1_2);
	echo '<table border="1"  bordercolor="#993366"><tr><th>';
	while($data=mysql_fetch_array($reg_once)){
	echo '<th style="writing-mode:	tb-rl; filter:flipH() flipV()">';
        $thsubcode=$data['course'];
        //.....................................................................//
            ////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($thsubcode);
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
        
        
        //.....................................................................//
        
        
	echo $fulcode;
	}

	
//	$query1_3="select distinct student from registration where acedemic_year='$acedemic_reg' and semister='$semister_reg'";
	
	
	$query1_3="select distinct r.student, s.batch from registration r, level l, student s where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and r.student=s.id and s.year=l.year and l.level='$level_reg' order by r.student";

	$reg_two=mysql_query($query1_3);
	while($data2=mysql_fetch_array($reg_two)){
	echo '<tr>';
	echo "<td>SC/".$data2['batch']."/".strtoupper($data2['student']);
	
	$student_select=$data2['student'];
	/// Student Registration Information
	
	$query1_4="select distinct r.course from registration r, courseunit c where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and c.code=r.course and c.level='$level_reg' order by r.course";
	$reg_three=mysql_query($query1_4);
	
	while($data3=mysql_fetch_array($reg_three)){
	echo '<td align=center>&nbsp;';
	
	$course_select=$data3['course'];
	
	//echo $data3['course'];
	
	// Checking for the registration
	
	$query1_5="select confirm, degree from registration where acedemic_year='$acedemic_reg' and (semister='$semister_reg' or semister=3) and course='$course_select' and student='$student_select'";
	$reg_four=mysql_query($query1_5);
	
	while($data4=mysql_fetch_array($reg_four)){
		$dgst=$data4['degree'];	
			if($dgst=="2"){
				$dgst2=" (nd)";
					}
	
	if(($data4['confirm'])==1)
	echo "1";
	
	if(($data4['confirm'])==0)
	echo "0";
	echo$dgst2;
	$dgst2=null;
	}
	
	
	// End of the checking Registration
	}
		
	// End Student Registration Information	
	
	}
	echo "</table>";
	

						
?>



<?php
}
else{
echo "You Have Not Permission To Access This Area!";}
?>
