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
	$stream_reg=$_POST['stream'];	


//////////////edit by iranga ////////////////////////////////////////////////////
require_once('../classes/globalClass.php');
$vrcnfrg=new settings();
/////////////////////////////////////////////////////////////////////////////////	

	echo "<center>Confirm Registration of $stream_reg Student - ";
	echo " Accademic Year : ".$acedemic_reg."&nbsp;&nbsp;&nbsp;&nbsp; Level : ".$level_reg."000&nbsp;&nbsp;&nbsp;&nbsp; Semister : ".$semister_reg;
	echo"<br>[ Foundation Course : 1 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ Core Course : 2 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ Core Optional Course : 3 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ Extra optional Course : 4 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ Supplementary Course : 5 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	echo"[ None Degree Course  : 6 ]&nbsp;&nbsp;,&nbsp;&nbsp;";
	
	
	echo"[ Not Confirmed : 0 ]";
	echo"<hr class=bar></center>";
	
						
	include '../admin/config.php';					
	$con9=mysql_connect($host,$user,$pass);
	mysql_select_db($db);
	echo"<div id='m'>";////////////////////////////////////scroll div
	//$query1_2="select distinct r.course from registration r, courseunit c where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and c.code=r.course and c.level='$level_reg' order by r.course";
	if($stream_reg=="All"){
		$query1_2="select distinct code,medium from  courseunit  where (semister='$semister_reg' or semister=3) and level='$level_reg' and availability=1 order by code";
	}
	elseif($stream_reg=="Special Sinhala Medium"){
		$query1_2="select distinct code,medium from  courseunit  where (semister='$semister_reg' or semister=3) and level='$level_reg' and availability=1 and stream='Special' and ( medium='SI' or medium='SI+EN' )  order by code";
	}	
	elseif($stream_reg=="Special English Medium"){
		$query1_2="select distinct code,medium from  courseunit  where (semister='$semister_reg' or semister=3) and level='$level_reg' and availability=1 and stream='Special' and ( medium='EN' or medium='SI+EN' ) order by code";
	}	
	else{
		$query1_2="select distinct code,medium from  courseunit  where (semister='$semister_reg' or semister=3) and level='$level_reg' and availability=1 and stream='$stream_reg' order by code";
	}
	//echo$query1_2;
	$reg_once=mysql_query($query1_2);

	echo '<div align="center"><table border="1"  bordercolor="#993366" bgcolor="#FFFFFF" width=100%><tr align=center><th>#<th align=center  width=220px >Student_Number';
	$nwadtblrw=1;
	while($data=mysql_fetch_array($reg_once)){
	echo '<th style="writing-mode:	tb-lr; filter:flipH() flipV()" align=center height=30px>';
		$rgcnflcd=strtoupper($data['code']);
	/////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////
		$rgcnfmdm=$data['medium'];
		if($rgcnfmdm==null){
			$rgcnfmdm2="SI";
		}
		else{
			$rgcnfmdm2=$rgcnfmdm;
		}
		if($rgcnfmdm=="SI+EN"){
			
			 echo $rgcnflcd."<br><font size=1px >( SI )</font>";
			 echo '<th style="writing-mode:	tb-lr; filter:flipH() flipV()" align=center height=30px>'.$rgcnflcd."<br><font size=1px >( EN )</font>";
			
		 }
		 else{
			echo '&nbsp;&nbsp;<font size=2px >'.$rgcnflcd.'</font>&nbsp;&nbsp;';
		 }
	
	/////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////
	}

	
	//$query1_3="select distinct r.student, s.batch from registration r, level l, student s where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and r.student=s.id and s.year=l.year and l.level='$level_reg' order by r.student";
   // $query1_3="select distinct s.id, s.batch from  level l, student s where s.year=l.year and l.level='$level_reg' order by s.id";
    
    $fmviweque="$rmsdb.fohssmisStudents fs";
	if($stream_reg=="All"){
    //$query1_3="select s.id, s.batch, s.combination,s.stream,s.medium from student s, level l, $fmviweque where l.level='$level_reg' and l.year=s.year and  s.id=fs.user_name order by s.id";
	$query1_3="select s.* from student s, level l, $fmviweque where l.level='$level_reg' and l.year=s.year and  s.id=fs.user_name order by s.id";
	

	}
	else{
	//$query1_3="select s.id, s.batch, s.combination,s.stream,s.medium from student s, level l, $fmviweque where l.level='$level_reg' and l.year=s.year and s.stream='$stream_reg' and  s.id=fs.user_name order by s.id";
	$query1_3="select s.* from student s, level l, $fmviweque where l.level='$level_reg' and l.year=s.year and s.stream='$stream_reg' and  s.id=fs.user_name order by s.id";
			
		}

	$reg_two=mysql_query($query1_3);
	while($data2=mysql_fetch_array($reg_two)){
	echo '<tr><td align=center>'.$nwadtblrw;
		///////////////////////////////////////////////////////
	$regstlstnunm=$data2['id'];
	$regstlststream=$data2['stream'];	
	$regstlstmedium=$data2['medium'];	
	$regstlstcurriculum=$data2['curriculum'];
	
	$lstdigts= substr("$regstlstnunm",2);
	//////////////////////////////////////////////////////
	echo "<td align=center><font><b>HS/".$data2['batch']."/".$lstdigts."</b></font>";
	
	$stmnsucnmb=$data2['combination'];
		$getsubjct=explode("+",$stmnsucnmb);
			$getsubjct1=$getsubjct[0];
			$getsubjct2=$getsubjct[1];
			$getsubjct3=$getsubjct[2];	
			
			if(($getsubjct2==null)&&($getsubjct3==null)){
				$cmbqury="c.target_group LIKE '%$getsubjct1%'";
			}
			else{
				$cmbqury="c.target_group LIKE '%$getsubjct1%' or  c.target_group LIKE '%$getsubjct2%' or  c.target_group LIKE '%$getsubjct3%'";
			}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($stream_reg=="All"){
		//$quegetaddbtn="select distinct(c.code),stream from courseunit c,curriculum cr where c.availability=1 and c.by_low_version=cr.cr_value and cr.status=1 and ( c.target_group LIKE '%All%' or $cmbqury) and c.level='$level_reg' and (c.semister='$semister_reg' or c.semister=3) order by c.code";
		$quegetaddbtn="select distinct(c.code),c.stream from courseunit c where c.availability=1 and c.by_low_version=$regstlstcurriculum  and ( c.target_group LIKE '%All%' or $cmbqury) and c.level='$level_reg' and (c.semister='$semister_reg' or c.semister=3) order by c.code";
	}
	else{
		//$quegetaddbtn="select distinct(c.code),stream from courseunit c,curriculum cr where c.availability=1 and c.by_low_version=cr.cr_value and cr.status=1 and ( c.target_group LIKE '%All%' or c.target_group LIKE '%$getsubjct1%' ) and c.level='$level_reg' and (c.semister='$semister_reg' or c.semister=3)  and c.stream='$stream_reg'  order by c.code";
		$quegetaddbtn="select distinct(c.code),c.stream from courseunit c where c.availability=1 and c.by_low_version=$regstlstcurriculum and ( c.target_group LIKE '%All%' or c.target_group LIKE '%$getsubjct1%' ) and c.level='$level_reg' and (c.semister='$semister_reg' or c.semister=3)  and c.stream='$stream_reg'  order by c.code";

	}	
			
		//	echo$quegetaddbtn;
		$qugetaddbtn=mysql_query($quegetaddbtn);
		if(mysql_num_rows($qugetaddbtn)!=0){
			$adbtncs=array();
			$adbtncsindx=0;
			$adbtn="yes";
			while($qgetaddbtn=mysql_fetch_array($qugetaddbtn)){
					$getaddbtn=$qgetaddbtn['code'];
					$getaddbtnstream=$qgetaddbtn['stream'];	
					
					if($getaddbtnstream==$regstlststream){
						$adbtncs[$adbtncsindx]=$getaddbtn;
						$adbtncsindx++;
					}
					
					
					
			}
		}
			
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			
			
	$student_select=$data2['id'];
	/// Student Registration Information


	
	//$query1_4="select distinct r.course from registration r, courseunit c where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and c.code=r.course and c.level='$level_reg' order by r.course";
	if($stream_reg=="All"){
	$query1_4="select distinct code,medium,stream,by_low_version from  courseunit  where (semister='$semister_reg' or semister=3) and level='$level_reg' and availability=1 order by code";
	}
	else{
	$query1_4="select distinct code,medium,stream,by_low_version from  courseunit  where (semister='$semister_reg' or semister=3) and level='$level_reg' and availability=1 and stream='$stream_reg' order by code";
		
	}
	
$reg_three=mysql_query($query1_4);
	$strcdclno=1;
	while($data3=mysql_fetch_array($reg_three)){
		$adbtn="yes";
	$course_select=$data3['code'];
	$course_stream=$data3['stream'];	
	$course_by_low_version=$data3['by_low_version'];
	
	///////////////////////////////////////////////
	$course_medium=$data3['medium'];
		if($course_medium==null){
			$course_medium2="SI";
		}
		else{
			$course_medium2=$course_medium;
		}
		 if($course_medium=="SI+EN"){
			$flpelmnt=2;
		 }
		 else{
			 $flpelmnt=1;
		 }
	//////////////////////////////////////////////

	for($mdm=0;$mdm<$flpelmnt;$mdm++){
		if($course_medium=="SI+EN"){
			if($mdm==0){
				$course_medium2="SI";
			}
			if($mdm==1){
				$course_medium2="EN";
			}			
			
		 }	


///////////////////////////////////////**************************************************************//////////////////////////////////////////////
	echo '<td align="center">&nbsp;';
	if(($course_stream==$regstlststream)&&($course_medium2==$regstlstmedium)&&($course_by_low_version==$regstlstcurriculum)){
	//if($course_stream==$regstlststream){
	//echo $data3['code']."-".$course_medium2;
	
	// Checking for the registration

	$idname=$course_select."-".$student_select;
	$idnamedata="Registration of ".$course_select.", for Student ID : ".$student_select;
	//$data4=mysql_fetch_array($reg_four);
	
	$alldgst4cnf=$vrcnfrg->getcostype($course_select,$student_select);	
	$dgstnumber=explode("-",$alldgst4cnf);
	
	$query1_5="select r.confirm,r.degree from registration r where r.acedemic_year='$acedemic_reg' and (r.semister='$semister_reg' or r.semister=3) and r.course='$course_select' and r.student='$student_select'";
	//echo$query1_5;
	$reg_four=mysql_query($query1_5);	
	$rows1=mysql_num_rows ($reg_four);
	
	if(mysql_num_rows($reg_four)==0){
		echo"<table border=1 cellspacing=0><tr class=selectbg><td>$dgstnumber[1]</table>";
	}
	else{
	while($data4=mysql_fetch_array($reg_four)){
//////////........................................................................///////////////////////
		$cnfdgstt=$data4['degree'];
	if($cnfdgstt=="Non Degree"){
		echo"<table border=1 cellspacing=0><tr class=selectbg><td>(6)</table>";
	}
	else{
		if($alldgst4cnf!="ND"){
			echo"<table border=1 cellspacing=0><tr class=selectbg><td>$dgstnumber[1]</table>";
		}
		else{
			echo"<table border=1 cellspacing=0><tr class=selectbg><td>ND</table>";
		}
	}
//////////........................................................................///////////////////////		
	if(($data4['confirm'])==1 ){
	$adbtn="no";
echo"<table border=0 width=100% cellspacing=0 cellspadding=0><tr><td align='center'>";

echo "<div id=rm".$course_select."-".$student_select.">";


	echo "<div id=".$course_select."-".$student_select.">";

	echo "<img id=".$course_select."img".$student_select." src=../images/ntcnf.png onClick=change('$course_select','$student_select')>";
echo"<br><font color=green size=1px><b>Y</b></font>";
echo"<td align='center'>";
	echo '<div>';
echo "<img id=rm".$course_select."img".$student_select." src=../images/rm.png onClick=removecu('$course_select','$student_select')>";
echo"<br><font color=green><b>&nbsp;</b></font>";
	echo '<div>';


	echo"</tr></table>";









	echo strtoupper($course_select);
		if($course_medium=="SI+EN"){
			if($mdm==0){
				echo"<font size=1px>-(SI)</font>";
			}
			if($mdm==1){
				echo"<font size=1px>-(EN)</font>";
			}			
			
		 }
	
	echo"<br>-".$student_select."-";

	
    }








    
    elseif(($data4['confirm'])==0){
	$adbtn="no";
echo"<table border=0 width=100% cellspacing=0 cellspadding=0><tr><td align='center'>";

echo "<div id=rm".$course_select."-".$student_select.">";

	echo "<div id=".$course_select."-".$student_select.">";
	echo "<img id=".$course_select."img".$student_select." src=../images/conf31.png onClick=change('$course_select','$student_select')>";
	echo"<br><font color=red size=2px><b>0</b></font>";
	echo"<td align='center'>";
	echo '<div>';






	
	echo "<img id=rm".$course_select."img".$student_select." src=../images/rm.png onClick=removecu('$course_select','$student_select')>";
	echo"<br><font color=red><b>&nbsp;</b></font>";
	echo '<div>';


	echo"</tr></table>";



	echo strtoupper($course_select);
			if($course_medium=="SI+EN"){
			if($mdm==0){
				echo"<font size=1px>-(SI)</font>";
			}
			if($mdm==1){
				echo"<font size=1px>-(EN)</font>";
			}			
			
		 }
	echo"<br>-".$student_select."-";
    }

	}
	}
	













//.................edited by iranga...................
//.....................print courses which a student can select............... 

if(in_array("$course_select",$adbtncs)){
	if($adbtn=="yes"){
		//echo$course_select;

		echo "<div id=".$course_select."-".$student_select.">";
			echo "<font color=red>&nbsp;&nbsp;Add</font> &nbsp;<img id=".$course_select."img".$student_select." src=../images/conf2.png onClick=changeAdd('$course_select','$student_select')><br>";
			echo strtoupper($course_select);
			if($course_medium=="SI+EN"){
					if($mdm==0){
						echo"<font size=1px>-(SI)</font>";
					}
					if($mdm==1){
						echo"<font size=1px>-(EN)</font>";
					}			
			
		 }
			echo"<br>-".$student_select."-";
		
	}
}
else{
	if($adbtn=="yes"){
	$dd=$course_select."-".$student_select;
	echo "<div id=".$course_select."-".$student_select.">";
	$imgalt="-- $course_select &nbsp; | &nbsp; $student_select --";
	echo "<img title='$imgalt' id=".$course_select."img".$student_select." src=../images/conf22.png onClick=changeAddOptional('$course_select','$student_select','$co','$dd')><br>";
			if($course_medium=="SI+EN"){
			if($mdm==0){
				echo"<font size=1px>(SI)</font>";
			}
			if($mdm==1){
				echo"<font size=1px>(EN)</font>";
			}			
			
		 }
	
	
	}

}








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

	}
//...................................................
///////////////////////////////////////**************************************************************//////////////////////////////////////////////
	$strcdclno++;
	}	// End of the checking Registration

}
		
	// End Student Registration Information	
	$nwadtblrw++;
	}
	echo "</table></div>";
	

						
?>
