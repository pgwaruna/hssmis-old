<?php


	$stream_reg=$_GET['stream'];
	$level_reg=$_GET['level'];
	$acedemic_reg=$_GET['acc_year'];
	$semister_reg=$_GET['sem'];
	

	echo "View Registration Details of Student - ";
	echo " Accademic Year : ".$acedemic_reg."&nbsp;&nbsp;&nbsp;&nbsp; Level : ".$level_reg."&nbsp;&nbsp;&nbsp;&nbsp; Semister : ".$semister_reg."<hr color=#E1E1F4 width=95%>";
	
						
	include '../admin/config.php';					
	$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
	
	$query1_2="select distinct r.course from registration r, courseunit c where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and c.code=r.course and c.level='$level_reg'";
	$reg_once=mysql_query($query1_2);
	echo '<table border="1"  bordercolor="#993366"><tr><th>';
	while($data=mysql_fetch_array($reg_once)){
	echo '<th style="writing-mode:	tb-rl; filter:flipH() flipV()">';
	echo strtoupper($data['course']);
	}

	
//	$query1_3="select distinct student from registration where acedemic_year='$acedemic_reg' and semister='$semister_reg'";
	
	
	$query1_3="select distinct r.student, s.year from registration r, level l, student s where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and r.student=s.id and s.year=l.year and l.level='$level_reg'";

	$reg_two=mysql_query($query1_3);
	while($data2=mysql_fetch_array($reg_two)){
	echo '<tr>';
	echo "<td>sc/".$data2['year']."/".strtoupper($data2['student']);
	
	$student_select=$data2['student'];
	/// Student Registration Information
	
	$query1_4="select distinct r.course from registration r, courseunit c where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and c.code=r.course and c.level='$level_reg'";
	$reg_three=mysql_query($query1_4);
	
	while($data3=mysql_fetch_array($reg_three)){
	echo '<td>&nbsp;';
	
	$course_select=$data3['course'];
	
	//echo $data3['course'];
	
	// Checking for the registration
	
	$query1_5="select confirm from registration where acedemic_year='$acedemic_reg' and semister='$semister_reg' and course='$course_select' and student='$student_select'";
	$reg_four=mysql_query($query1_5);
	
	while($data4=mysql_fetch_array($reg_four)){
	echo $data4['confirm'];
	}
	
	
	// End of the checking Registration
	}
		
	// End Student Registration Information	
	
	}
	echo "</table>";
	

						
?>