<!--
Edit registration confirmation details. this page can add or remove course unit as you wish with administrator privileges. 
if you add a course unit then confirm field of regestration table update as 1 and if you remove course unit  confirm field of regestration table update as 0.
-->

<script type="text/javascript" src="../Ajax/confirmation.js"></script>
<?php


	//$stream_reg=$_POST['stream'];
	$level_reg=$_POST['level'];
	$acedemic_reg=$_POST['acc_year'];
	$semister_reg=$_POST['sem'];
	

	echo "<center>Confirm Registration of Student - ";
	echo " Accademic Year : ".$acedemic_reg."&nbsp;&nbsp;&nbsp;&nbsp; Level : ".$level_reg."&nbsp;&nbsp;&nbsp;&nbsp; Semister : ".$semister_reg."<hr class=bar></center>";
	
						
	include '../admin/config.php';					
	$con9=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
	mysql_select_db($db);
	echo"<div id='m'>";////////////////////////////////////scroll div
	$query1_2="select distinct r.course from registration r, courseunit c where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and c.code=r.course and c.level='$level_reg' order by r.course";
	$reg_once=mysql_query($query1_2);
	echo '<div align="center"><table border="1"  bordercolor="#993366" bgcolor="#FFFFFF"><tr><th>';
	while($data=mysql_fetch_array($reg_once)){
	echo '<th style="writing-mode:	tb-rl; filter:flipH() flipV()">';
	echo '&nbsp;&nbsp;<font size=2px >'.strtoupper($data['course']).'</font>&nbsp;&nbsp;';
	}

	
//	$query1_3="select distinct student from registration where acedemic_year='$acedemic_reg' and semister='$semister_reg'";
	
	
	$query1_3="select distinct r.student, s.batch from registration r, level l, student s where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and r.student=s.id and s.year=l.year and l.level='$level_reg' order by r.student";

	$reg_two=mysql_query($query1_3);
	while($data2=mysql_fetch_array($reg_two)){
	echo '<tr>';
	echo "<td><font color=64563d size=2>&nbsp;<b>SC/".$data2['batch']."/".strtoupper($data2['student'])."</b>&nbsp;</font>";
	
	$student_select=$data2['student'];
	/// Student Registration Information


	
	$query1_4="select distinct r.course from registration r, courseunit c where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and c.code=r.course and c.level='$level_reg' order by r.course";
	
	
$reg_three=mysql_query($query1_4);
	
	while($data3=mysql_fetch_array($reg_three)){
	echo '<td align="center">&nbsp;';
	
	$course_select=$data3['course'];
	
	//echo $data3['course'];
	
	// Checking for the registration




	$query1_5="select confirm from registration where acedemic_year='$acedemic_reg' and (semister='$semister_reg' or semister=3) and course='$course_select' and student='$student_select'";

	$reg_four=mysql_query($query1_5);
	
	$idname=$course_select."-".$student_select;
	$idnamedata="Registration of ".$course_select.", for Student ID : ".$student_select;
	//$data4=mysql_fetch_array($reg_four);
	$rows1=mysql_num_rows ($reg_four);
	while($data4=mysql_fetch_array($reg_four)){
	if(($data4['confirm'])==1 ){
	
echo"<table border=0 width=100% cellspacing=0 cellspadding=0><tr><td align='center'>";

echo "<div id=rm".$course_select."-".$student_select.">";


	echo "<div id=".$course_select."-".$student_select.">";

	echo "<img id=".$course_select."img".$student_select." src=../images/ntcnf.png onClick=change('$course_select','$student_select')>";
echo"<br><font color=green><b>1</b></font>";
echo"<td align='center'>";
	echo '<div>';
echo "<img id=rm".$course_select."img".$student_select." src=../images/rm.png onClick=removecu('$course_select','$student_select')>";
echo"<br><font color=green><b>&nbsp;</b></font>";
	echo '<div>';


	echo"</tr></table>";









	echo strtoupper($course_select)."<br>-".$student_select."-";

	
    }








    
    elseif(($data4['confirm'])==0){

echo"<table border=0 width=100% cellspacing=0 cellspadding=0><tr><td align='center'>";

echo "<div id=rm".$course_select."-".$student_select.">";

	echo "<div id=".$course_select."-".$student_select.">";
	echo "<img id=".$course_select."img".$student_select." src=../images/conf31.png onClick=change('$course_select','$student_select')>";
	echo"<br><font color=red><b>0</b></font>";
	echo"<td align='center'>";
	echo '<div>';






	
	echo "<img id=rm".$course_select."img".$student_select." src=../images/rm.png onClick=removecu('$course_select','$student_select')>";
	echo"<br><font color=red><b>&nbsp;</b></font>";
	echo '<div>';


	echo"</tr></table>";



	echo strtoupper($course_select)."<br>-".$student_select."-";
    }


	}
	













//.................edited by iranga...................
//.....................print courses which a student can select............... 

$query_stu="select distinct c.code from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$student_select' and o.subject=t.subject and t.target_id=c.target_group and c.core='co' and c.level='$level_reg' and (c.semister='$semister_reg' or c.semister=3) and c.code='$course_select'";
$course_stu=mysql_query($query_stu);
$rowsCT=mysql_num_rows($course_stu);

$queALL_op="select distinct c.code from courseunit c, combination o, student s , target_group t where o.id=s.combination and s.id='$student_select' and o.subject=t.subject and t.target_id=c.target_group and (c.core='op' or c.core='nd' or c.core='nn') and c.level='$level_reg' and c.semister='$semister_reg'and c.code='$course_select'";
$course_op=mysql_query($queALL_op);
$rowsOP=mysql_num_rows($course_op);

	
/*
$que_core= "select core from courseunit where code='$course_select'";
$core=mysql_query($que_core);
$co=mysql_fetch_array($core);
*/




 if($rows1==0 && $rowsCT==1){

		echo "<div id=".$course_select."-".$student_select.">";
	echo "<font color=red>&nbsp;&nbsp;Add</font> &nbsp;<img id=".$course_select."img".$student_select." src=../images/conf2.png onClick=changeAdd('$course_select','$student_select')><br>";
	echo strtoupper($course_select)."<br>-".$student_select."-";

	?>
<!--//////////////////comment by iranga////////////////////////////////////////////////////////
<p><a href="#" class="<?php echo $idname;?>" title="<?php echo $idnamedata;?>">Check</a></p> 
////////////////////////////////////////////////////////////////////////////////////////////-->

<!--[if IE 6]> 
<p><select name=""> 
<option>IE 6 Test</option> 
</select></p> 
<![endif]--> 

<!--//////////////////comment by iranga////////////////////////////////////////////////////////
<script type="text/javascript"> 
$('.<?php echo $idname;?>').tooltip(); 
</script>
////////////////////////////////////////////////////////////////////////////////////////////-->

	<?php 
	
	echo '<div>';
    }
	

 if($rows1==0 && $rowsOP==1){
$dd=$course_select."-".$student_select;
		echo "<div id=".$course_select."-".$student_select.">";
	echo "<font color=red>&nbsp;&nbsp;Add</font> &nbsp;<img id=".$course_select."img".$student_select." src=../images/conf2.png onClick=changeAddOptional('$course_select','$student_select','$co','$dd')>";
	echo strtoupper($course_select)."<br>-".$student_select."-";

	?>
<!--//////////////////comment by iranga////////////////////////////////////////////////////////
<p><a href="#" class="<?php echo $idname;?>" title="<?php echo $idnamedata;?>">Check</a></p> 
////////////////////////////////////////////////////////////////////////////////////////////-->


<!--[if IE 6]> 
<p><select name=""> 
<option>IE 6 Test</option> 
</select></p> 

<![endif]--> 


<!--//////////////////comment by iranga////////////////////////////////////////////////////////
<script type="text/javascript"> 
$('.<?php echo $idname;?>').tooltip(); 
</script>
////////////////////////////////////////////////////////////////////////////////////////////-->

	<?php 
	
	echo '<div>';
    }

//...................................................

	// End of the checking Registration
}
		
	// End Student Registration Information	
	
	}
	echo "</table></div>";
	

						
?>
