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
	$stream_reg=$_POST['stream'];	

	echo "Registration Details of $stream_reg Student - ";
	echo " Accademic Year : ".$acedemic_reg."&nbsp;&nbsp;&nbsp;&nbsp; Level : ".$level_reg."000 &nbsp;&nbsp;&nbsp;&nbsp; Semester : ".$semister_reg;
	echo"<br>[ Foundation Course : 1 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ Core Course : 2 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ Core Optional Course : 3 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ Extra optional Course : 4 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ Supplementary Course : 5 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ None Degree Course  : 6 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	
	echo"[ Not Confirmed : 0 ]";
	
	echo"<br>[ SI : Sinhala &nbsp;&nbsp;,&nbsp;&nbsp; EN : English ]";
	echo"<hr class=bar>";
						
	include '../admin/config.php';					
	$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
	
	if($stream_reg=="All"){
	$query1_2="select distinct r.course from registration r, courseunit c where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and c.code=r.course and c.level='$level_reg' order by r.course";
	}
	else{
	$query1_2="select distinct r.course from registration r, courseunit c where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and c.code=r.course and c.level='$level_reg' and c.stream='$stream_reg' order by r.course";
		
	}
	
	
	$reg_once=mysql_query($query1_2);
	echo '<table border="1"  bordercolor="#993366"><tr><th>#<th>Student No';
	while($data=mysql_fetch_array($reg_once)){
	echo '<th style="writing-mode:	tb-rl; filter:flipH() flipV()">';
        $thsubcode=$data['course'];
		
		$coursegetchr=trim($thsubcode);
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
        
         $fulcode=strtoupper($coursegetchr);
		 
		 if($getmdm=="SI+EN"){
			
			 echo "<font color=blue>".$fulcode."-SI</font>";
			 echo '<th style="writing-mode:	tb-rl; filter:flipH() flipV()"><font color=blue>'.$fulcode."-EN</font>";
			
		 }
		 else{
			 echo $fulcode;
		 }
	
	}

	
//	$query1_3="select distinct student from registration where acedemic_year='$acedemic_reg' and semister='$semister_reg'";
	
	$fmviweque="rumisdb.fohssmisStudents fs";
	if($stream_reg=="All"){
	$query1_3="select distinct(r.student), s.batch from registration r, level l, student s, $fmviweque where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and r.student=s.id and s.year=l.year and l.level='$level_reg' and r.student=fs.user_name  order by r.student";
	}
	else{
	$query1_3="select distinct(r.student), s.batch from registration r, level l, student s, $fmviweque where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and r.student=s.id and s.year=l.year and l.level='$level_reg' and r.student=fs.user_name and s.stream='$stream_reg'  order by r.student";
	}
	$reg_two=mysql_query($query1_3);
    $rst=1;
	while($data2=mysql_fetch_array($reg_two)){
	echo '<tr><td align=center>'.$rst;
	///////////////////////////////////////////////////////
	$regstlstnunm=$data2['student'];
	$lstdigts= substr("$regstlstnunm",2);
	//////////////////////////////////////////////////////
	
	echo "<td align=center width=120px>HS/".$data2['batch']."/".$lstdigts;
	
	$student_select=$data2['student'];
	/// Student Registration Information
	if($stream_reg=="All"){
		$query1_4="select distinct r.course from registration r, courseunit c where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and c.code=r.course and c.level='$level_reg' order by r.course";
	}
	else{
		$query1_4="select distinct r.course from registration r, courseunit c where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and c.code=r.course and c.level='$level_reg' and c.stream='$stream_reg'  order by r.course";
		
	}
	
	
	$reg_three=mysql_query($query1_4);
	
	while($data3=mysql_fetch_array($reg_three)){

	
	$course_select=$data3['course'];
		////////////////////////////////////////////////////////////////////
		$quegetmdm2="select medium from courseunit where code='$course_select'";
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
	
	/////////////////////////////eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee///////////////////////////////////////	
	for($mdm=0;$mdm<$flpelmnt;$mdm++){
		if($getmdm2=="SI+EN"){
			if($mdm==0){
				$getmdm22="SI";
			}
			if($mdm==1){
				$getmdm22="EN";
			}			
			
		 }	
	echo '<td align=center>&nbsp;';	
		
		////////////////////////////////////////////////////////////////////
	//echo $data3['course'];
	
	// Checking for the registration
	
	$query1_5="select r.confirm, r.degree from registration r, student s where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and r.course='$course_select' and r.student='$student_select' and r.student=s.id and s.medium='$getmdm22'";
	//echo$query1_5;
	$reg_four=mysql_query($query1_5);
	
	while($data4=mysql_fetch_array($reg_four)){
		$dgst=$data4['degree'];	

	
	if(($data4['confirm'])==1){
	///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////
	
	if($dgst=="Non Degree"){
		echo"6";
	}
	else{	
	$course_fifix2=substr("$course_select",0,3);
		$course_fifix=strtoupper($course_fifix2);
	if($course_fifix=="FDN"){
		echo"1";
	}
	elseif($course_fifix=="SUP"){
		echo"5";
	}
	else{
		$quegetCUpropts="select c.core,c.target_group,s.combination,s.stream 	 from courseunit c , student s where c.code='$course_select' and s.id='$regstlstnunm' and s.stream=c.stream and s.curriculum=c.by_low_version";
		//echo$quegetCUpropts;
		$qugetCUpropts=mysql_query($quegetCUpropts);
		if(mysql_num_rows($qugetCUpropts)==0){
			echo"ND";
		}
		else{
			$tgtgpary=array();
			while($qgetCUpropts=mysql_fetch_array($qugetCUpropts)){
				$getCUproptsCO=$qgetCUpropts['core'];
				$getCUproptsTGP=$qgetCUpropts['target_group'];
					$divtgp=explode(",",$getCUproptsTGP);
					$flpvl=substr_count($getCUproptsTGP, ','); 
					
					for($tg4=0;$tg4<=$flpvl;$tg4++){
						$tgtgpary[$tg4]=$divtgp[$tg4];
					}
				$getCUproptsCMB=$qgetCUpropts['combination'];
				$getCUproptsSTRM=$qgetCUpropts['stream'];
					
			}
			if($getCUproptsTGP=="All"){
				////////////////////////////////
				if($getCUproptsCO=="co"){
					echo"2";
				}
				elseif($getCUproptsCO=="op"){
					echo"3";
				}
				else{
					echo"*";
				}
				////////////////////////////////				
			}
			
			else{
				
				if($getCUproptsSTRM=="Special"){
					////////////////////////////////
					if($getCUproptsCO=="co"){
						echo"2";
					}
					else{
						if(in_array($getCUproptsCMB,$tgtgpary)){
							echo"3";
						}
						else{
							echo"4";
						}									
					}
					////////////////////////////////	
				}
				else{
					//echo$getCUproptsCMB.$tgtgpary[0];
				////////////////////////////////
				if($getCUproptsCO=="co"){
					echo"2";
				}
				else{
					$divtgpGENST=explode("+",$getCUproptsCMB);
					$relsub="no";
					for($gnsttg=0;$gnsttg<=2;$gnsttg++){
						if(in_array($divtgpGENST[$gnsttg],$tgtgpary)){
							$relsub="yes";
							break;
						}
						else{
							$relsub="no";
						}
					}
					if($relsub=="yes"){
						echo"3";
					}
					else{
						echo"4";
					}
					
					
				}
				////////////////////////////////					
				}	
				
			}
			
			
			

			
			
			
			
		}
		

	}

	}
	
	//echo "$course_fifix";
	///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////
	}	
	else{
				echo "0";
	}
////////////////////////////////////////////////////////	
///////////////////////////////////////////////////////
	}
	}
	//////////////////////eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee///////////////////////////////////////
	echo"&nbsp;";
	// End of the checking Registration
	}
		
	// End Student Registration Information	
	$rst++;
	}
	echo "</table>";
	

						
?>



<?php
}
else{
echo "You Have Not Permission To Access This Area!";}
?>
