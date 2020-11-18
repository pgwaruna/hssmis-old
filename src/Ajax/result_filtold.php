<?php

$task=$_GET['task'];
$stnumber=$_GET['stnum'];
$level=$_GET['rlevel'];
$semester=$_GET['csemester'];
$cosunit=$_GET['subcode'];
$sbgrade=$_GET['rgrade'];
$course=$_GET['course'];
$accy=$_GET['accyr'];

include'../admin/config.php';
$con6_7=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
require_once('../classes/attClass.php');
$g=new attendence();
////////////result fintering by level/////////////////////
if($task=="lvlfilt"){

	if($level=='4'){
		echo"<font color='red'  size='3px'>All Results</font>";
			}
	else{
		echo"<font color='red'  size='3px'>Level $level Results</font>";
		}	

		echo"<table border='0' align='center'><tr>";
		echo"<th>Course Unit</th><th>Subject Name</th><th>Grade</th><th>Year</th>";

		if($level=='4'){
			$quegtrstl="select r.subject, r.grade, r.year, c.name from results r, courseunit c  where index_number='$stnumber' and r.subject=c.code order by c.level,c.semister,r.subject,r.id";
			
				}
		else{
			$quegtrstl="select r.subject, r.grade, r.year, c.name from results r, courseunit c  where index_number='$stnumber' and r.subject=c.code and c.level=$level order by c.semister,r.subject,r.id";
			}
		//echo$quegtrstl;
		$qugtrstl=mysql_query($quegtrstl);
		if(mysql_num_rows($qugtrstl)!=0){
		$resub2="nil";
		while($qgtrstl=mysql_fetch_array($qugtrstl)){
			
			$subject=$qgtrstl['subject'];
			$grade=$qgtrstl['grade'];
			$year=$qgtrstl['year'];
			$cname=$qgtrstl['name'];

			if($resub2!=$subject){
			echo"<tr bgcolor='#edd4dc'><td align='center'>$subject</td><td>$cname</td><td align='center'>$grade</td><td align='center'>$year</td></td>";
						}
			else{
			echo"<tr bgcolor='#d2a6d9'><td colspan='2' align='center' >Repeat Attempt [ $subject - $cname ]</td><td align='center'>$grade</td><td align='center'>$year</td></td>";
				}
			$resub2=$subject;
								}
						}
		else{
			echo"<tr bgcolor='#edd4dc'><td colspan='4' align='center'>Result are not available in a system! </td>";
			}
		echo"</table>";
		}
////////////////////////////////////////////////////////////

////////////result fintering by semester/////////////////////
if($task=="semefilt"){

	if($level=='4'){
		echo"<font color='red'  size='3px'>All Semester $semester Results</font>";
			}
	else{
		echo"<font color='red'  size='3px'>Level $level Semester $semester Results</font>";

			}


		echo"<table border='0' align='center'><tr>";
		echo"<th>Course Unit</th><th>Subject Name</th><th>Grade</th><th>Year</th>";
		
	if($level!='4'){
		if($semester==1){
			$quegtrstl="select r.subject, r.grade, r.year, c.name from results r, courseunit c  where index_number='$stnumber' and r.subject=c.code and c.level=$level and c.semister=$semester order by r.subject,r.id";
				}
		else{
			$quegtrstl="select r.subject, r.grade, r.year, c.name from results r, courseunit c  where index_number='$stnumber' and r.subject=c.code and c.level=$level and (c.semister=$semester or c.semister=3) order by r.subject,r.id";
			}
			 }
	else{
		if($semester==1){
			$quegtrstl="select r.subject, r.grade, r.year, c.name from results r, courseunit c  where index_number='$stnumber' and r.subject=c.code and c.semister=$semester order by c.level,c.semister,r.subject,r.id";
				}
		else{
			$quegtrstl="select r.subject, r.grade, r.year, c.name from results r, courseunit c  where index_number='$stnumber' and r.subject=c.code and (c.semister=$semester or c.semister=3) order by c.level,c.semister,r.subject,r.id";
			}

		}

			$qugtrstl=mysql_query($quegtrstl);
			if(mysql_num_rows($qugtrstl)!=0){
			$resub3="nil";
				while($qgtrstl=mysql_fetch_array($qugtrstl)){
			
					$subject=$qgtrstl['subject'];
					$grade=$qgtrstl['grade'];
					$year=$qgtrstl['year'];
					$cname=$qgtrstl['name'];
					
					if($resub3!=$subject){
					echo"<tr bgcolor='#edd4dc'><td align='center'>$subject</td><td>$cname</td><td align='center'>$grade</td><td align='center'>$year</td></td>";
								}
					else{
					echo"<tr bgcolor='#d2a6d9'><td colspan='2' align='center' >Repeat Attempt [ $subject - $cname ]</td><td align='center'>$grade</td><td align='center'>$year</td></td>";
				}
					$resub3=$subject;
						
			
									}
							}
			else{
				echo"<tr bgcolor='#edd4dc'><td colspan='4' align='center'>Result are not available in a system! </td>";
				}
		echo"</table>";
	







		


}
////////////////////////////////////////////////////////////

////////////result fintering by course unit/////////////////////
if($task=="subfilt"){
//echo$stnumber.$cosunit;
$quechkcu="select distinct(r.subject), c.name from courseunit c,results r where r.subject LIKE '$cosunit' and r.subject=c.code and r.index_number='$stnumber' order by r.subject";
//echo$quechkcu;

//$quechkcu="select code,name from courseunit where code LIKE '$cosunit'";
$quchkcu=mysql_query($quechkcu);
	if(mysql_num_rows($quchkcu)==0){
		echo"<font color='red'  size='3px'>Invalid Course Unit..!</font>";
					}
	else{
	if(mysql_num_rows($quchkcu)!=1){
			echo"<font color='red'  size='3px'>Search Results of Student.</font>";	
					}
			echo"<table border='0' align='center'><tr>";
			echo"<th>Course Unit</th><th>Subject Name</th><th>Grade</th><th>Year</th>";

	while($qchkcu=mysql_fetch_array($quchkcu)){
		$cocode=$qchkcu['subject'];
		$coname=$qchkcu['name'];
				if(mysql_num_rows($quchkcu)==1){
					echo"<font color='red'  size='3px'>$cocode ($coname) Results of Student.</font>";
								}		
								
						
			$quegtsbres="select subject,grade,year from results where subject='$cocode' and index_number='$stnumber' order by id";
			$qugtsbres=mysql_query($quegtsbres);
			if(mysql_num_rows($qugtsbres)!=0){
			$resub4="nil";
				while($qgtsbres=mysql_fetch_array($qugtsbres)){
					$subject=$qgtsbres['subject'];
					$grade=$qgtsbres['grade'];
					$year=$qgtsbres['year'];
					if($resub4!=$subject){
					echo"<tr bgcolor='#edd4dc'><td align='center'>$cocode</td><td>$coname</td><td align='center'>$grade</td><td align='center'>$year</td></td>";
								}
					else{
					echo"<tr bgcolor='#d2a6d9'><td colspan='2' align='center' >Repeat Attempt [ $cocode - $coname ]</td><td align='center'>$grade</td><td align='center'>$year</td></td>";
				}
					$resub4=$subject;


										}
							   }
			else{
				echo"<tr bgcolor='#edd4dc'><td colspan='4' align='center'>$cocode Result are not available in a system for this Student. </td>";
				}

				}//while
			echo"</table>";
		}
////////////////////////////////////////////////////////////////////////////////////////////////
	



			
///////////////////////////////////////////////////////////////////////////////////////////////
}
////////////////////////////////////////////////////////////

////////////result fintering by grade/////////////////////
if($task=="grdfilt"){
//echo$stnumber.$sbgrade;
   if($sbgrade=="find"){
		echo"<font color='red'  size='3px'>Select Grade to find Results!</font>";
			}
   else{
	echo"<font color='red'  size='3px'>All [ $sbgrade ] Results of Above Student.</font><br>";
		
		$quegttot="select count(r.subject) as tot from results r, courseunit c  where index_number='$stnumber' and r.subject=c.code and r.grade='$sbgrade'";
		$qugttot=mysql_query($quegttot);
		$qgttot=mysql_fetch_array($qugttot);
		$gdtot=$qgttot['tot'];
		if($gdtot!=0){
			echo"There are <font color='red'>$gdtot</font> $sbgrade obtained to this student";
						}
		
	echo"<table border='0' align='center'><tr>";
	echo"<th>Course Unit</th><th>Subject Name</th><th>Grade</th><th>Year</th>";
		$quegtrstl="select r.subject, r.grade, r.year, c.name from results r, courseunit c  where index_number='$stnumber' and r.subject=c.code and r.grade='$sbgrade' order by c.level,c.semister,r.subject,r.id";

		$qugtrstl=mysql_query($quegtrstl);
			if(mysql_num_rows($qugtrstl)!=0){
			$resub5="nil";
				while($qgtrstl=mysql_fetch_array($qugtrstl)){
			
					$subject=$qgtrstl['subject'];
					$grade=$qgtrstl['grade'];
					$year=$qgtrstl['year'];
					$cname=$qgtrstl['name'];
					if($resub5!=$subject){
					echo"<tr bgcolor='#edd4dc'><td align='center'>$subject</td><td>$cname</td><td align='center'>$grade</td><td align='center'>$year</td></td>";	
								}
					else{
					echo"<tr bgcolor='#d2a6d9'><td colspan='2' align='center' >Repeat Attempt [ $subject - $cname ]</td><td align='center'>$grade</td><td align='center'>$year</td></td>";
				}	
					$resub5=$subject;
			
									}
							}
			else{
				echo"<tr bgcolor='#edd4dc'><td colspan='4' align='center'>This student haven't obtain $sbgrade results</td>";
				}
		echo"</table>";
	}

}
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////

/////// display attendence//////////////////////////////////


if($task=="dispatt"){
///////////////get semester//////////////////////////////////////

$stgp=$g->getprctgp($stnumber,$course,$accy); 

$queseme="select DISTINCT semister from level";
$quseme=mysql_query($queseme);
$qseme=mysql_fetch_array($quseme);
$seme=$qseme['semister'];
//////////////////////////////////////////////////////////////////
	echo"<font size='3px'>Attendence Details of $course</font><br>";
	echo"(Semester <font color='blue'>$seme</font> of <font color='blue'>$accy</font> Acedamic Year)";
	echo"<hr>";
//echo$stnumber.$task.$course.$accy;
	$quegtlecid="select * from lecture where  course='$course'and acc_year='$accy' order by date,time";
	//echo$quegtlecid;
	$qugtlecid=mysql_query($quegtlecid);
		if(mysql_num_rows($qugtlecid)!=0){
			$lec=0;
			$tue=0;
			$prct=0;
			$fild=0;
			$ass=0;
			$cntlid_l=0;
			$cntlid_t=0;
			$cntlid_p=0;
			$cntlid_f=0;
			$cntlid_a=0;



			while($qgtlecid=mysql_fetch_array($qugtlecid)){
						$lid=$qgtlecid['lecture_id'];
						$dt=$qgtlecid['date'];
							$mmdd=substr($dt,5,5);		
						$ho=$qgtlecid['hours'];
						$tm=$qgtlecid['time'];
							$hhmm=substr($tm,0,5);
						$typ=$qgtlecid['type'];
						$att_group=	$qgtlecid['att_group'];		
						
							
				
					if($typ=="lecture"){
					$cntlid_l=$g->getSubTotal($course, $typ, $accy,$stgp);
					$lec=$g->getTotal($course, $stnumber, $typ, $accy);
									} 	
				
							
					if($typ=="tute"){
					$cntlid_t=$g->getSubTotal($course, $typ, $accy,$stgp);
					$tue=$g->getTotal($course, $stnumber, $typ, $accy);
									}
							 
					if($typ=="practical"){
					$cntlid_p=$g->getSubTotal($course, $typ, $accy,$stgp);
					$prct=$g->getTotal($course, $stnumber, $typ, $accy);	
									} 

							
					if($typ=="field"){
					$cntlid_f=$g->getSubTotal($course, $typ, $accy,$stgp);
					$fild=$g->getTotal($course, $stnumber, $typ, $accy);
									} 
			

					if($typ=="assignment"){
					$cntlid_a=$g->getSubTotal($course, $typ, $accy,$stgp);
					$ass=$g->getTotal($course, $stnumber, $typ, $accy);
									} 

							
					
					}//main while
				
			echo"<table border='0'>";
			echo"<tr><td width=50%>&nbsp;</td><td width=50%>&nbsp;</td></tr>";

			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				if($cntlid_l!=0){
						echo"<tr bgcolor='#ffffff'> <td>Number of Total Lecture Hours</td><td>&nbsp;&nbsp; &nbsp;&nbsp;$cntlid_l</td></tr>";
						echo"<tr bgcolor='#ffffff'><td>Present Lecture Hours</td><td>&nbsp;&nbsp; &nbsp;&nbsp;$lec</td></tr>";
								
									$abs_l=$cntlid_l-$lec;
									$pes_l=($lec/$cntlid_l)*100;
									$abpes_l=100-$pes_l;
						echo"<tr bgcolor='#ffffff'><td align='center'>Present Percentage:&nbsp;&nbsp;<font color='blue'>".round($pes_l)."%</font><td align='center'>Absent Percentage:&nbsp;&nbsp;<font color='red'>".round($abpes_l)."%</font></td></tr>";
						echo"<tr><td colspan='2'>&nbsp;</td></tr>";
								}
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				if($cntlid_t!=0){
						echo"<tr bgcolor='#ffffff'><td>Number of Total Tutorial Hours</td><td>&nbsp;&nbsp; &nbsp;&nbsp;$cntlid_t</td></tr>";
						echo"<tr bgcolor='#ffffff'><td>Present Tutorial Hours</td><td>&nbsp;&nbsp; &nbsp;&nbsp;$tue</td></tr>";

									$abs_t=$cntlid_t-$tue;
									$pes_t=($tue/$cntlid_t)*100;
									$abpes_t=100-$pes_t;
						echo"<tr bgcolor='#ffffff'><td align='center'>Present Percentage:&nbsp;&nbsp;<font color='blue'>".round($pes_t)."%</font><td align='center'>Absent Percentage:&nbsp;&nbsp;<font color='red'>".round($abpes_t)."%</font></td></tr>";
						echo"<tr><td colspan='2'>&nbsp;</td></tr>";
									}
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				if($cntlid_p!=0){
						echo"<tr bgcolor='#ffffff'><td>Number of Total Practicals Hours</td><td>&nbsp;&nbsp; &nbsp;&nbsp;$cntlid_p</td></tr>";
						echo"<tr bgcolor='#ffffff'><td>Present Practicals Hours</td><td>&nbsp;&nbsp; &nbsp;&nbsp;$prct</td></tr>";

									$abs_p=$cntlid_p-$prct;
									$pes_p=($prct/$cntlid_p)*100;
									$abpes_p=100-$pes_p;

						echo"<tr bgcolor='#ffffff'><td align='center'>Present Percentage:&nbsp;&nbsp;<font color='blue'>".round($pes_p)."%</font><td align='center'>Absent Percentage:&nbsp;&nbsp;<font color='red'>".round($abpes_p)."%</font></td></tr>";
						echo"<tr><td colspan='2'>&nbsp;</td></tr>";
									}
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				if($cntlid_f!=0){
						echo"<tr bgcolor='#ffffff'><td>Number of Total Field Visit Hours</td><td>&nbsp;&nbsp; &nbsp;&nbsp;$cntlid_f</td></tr>";
						echo"<tr bgcolor='#ffffff'><td>Present Field Visit Hours</td><td>&nbsp;&nbsp; &nbsp;&nbsp;$fild</td></tr>";

								
									$abs_f=$cntlid_f-$fild;
									$pes_f=($fild/$cntlid_f)*100;
									$abpes_f=100-$pes_f;
						echo"<tr bgcolor='#ffffff'><td align='center'>Present Percentage:&nbsp;&nbsp;<font color='blue'>".round($pes_f)."%</font><td align='center'>Absent Percentage:&nbsp;&nbsp;<font color='red'>".round($abpes_f)."%</font></td></tr>";
						echo"<tr><td colspan='2'>&nbsp;</td></tr>";
								}
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				if($cntlid_a!=0){
						echo"<tr bgcolor='#ffffff'><td>Number of Total Assignment Hours</td><td>&nbsp;&nbsp; &nbsp;&nbsp;$cntlid_a</td></tr>";
						echo"<tr bgcolor='#ffffff'><td>Present Assignment Hours</td><td>&nbsp;&nbsp; &nbsp;&nbsp;$ass</td></tr>";

								
									$abs_a=$cntlid_a-$ass;
									$pes_a=($ass/$cntlid_a)*100;
									$abpes_a=100-$pes_a;

						echo"<tr bgcolor='#ffffff'><td align='center'>Present Percentage:&nbsp;&nbsp;<font color='blue'>".round($pes_a)."%</font><td align='center'>Absent Percentage:&nbsp;&nbsp;<font color='red'>".round($abpes_a)."%</font></td></tr>";
						echo"<tr><td colspan='2'>&nbsp;</td></tr>";
									}
			//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



						
			
				$totlid=$cntlid_l+$cntlid_t+$cntlid_p+$cntlid_f+$cntlid_a;
				echo"Total Academic Session hours: [ <font color='blue'>$totlid</font> ]<br>";		


				$totpes=$lec+$tue+$prct+$fild+$ass;
				echo"Total Participation hours :[<font color='blue'> $totpes </font>]<br>";
				
				$avgpce=($totpes/$totlid)*100;
				echo"Average Participation Percentage :[ <font color='blue'>".round($avgpce)."%</font> ]<br>";
			echo"</table>";
						}
		else{
			echo"<font color='red'>Sorry! Lecture IDs are not define.</font>";
			}

		}//main if of dispatt



//////////////////////////////////////////////////////////////




?>
