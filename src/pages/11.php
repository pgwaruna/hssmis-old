
<head>
<meta http-equiv="Content-Language" content>
</head>




<script type="text/javascript" src="./Ajax/result_filt_st.js"></script>
<?php
//////////////edit by iranga ////////////////////////////////////////////////////
require_once('./classes/globalClass.php');
$vr11=new settings();
/////////////////////////////////////////////////////////////////////////////////
echo "All Results of Students<hr class=bar>";
						//include 'forms/form_11.php';

//echo$_SESSION['user_id'].$_SESSION['Lname'].$_SESSION['initials'];
$stnum=$_SESSION['user_id'];












/////////////////////////////////////////////////////////////////////////////////////
/*	 
	echo"<table border='0' align='center'><tr class=trbgc><td>";
		echo'<select name="level" size="4" id="'.$stnum.'level" onclick="levelfilter2('.$stnum.')">';
			echo"<option value=1>Level 1</option>";
			echo"<option value=2>Level 2</option>";
			echo"<option value=3>Level 3</option>";
			echo"<option value=4 selected>All</option>";
		echo"</select></td>";

		echo'<td><select name="semester" size="2" id="'.$stnum.'semester" onclick="semesterfilter('.$stnum.')">';
			echo"<option value=1>Semester 1</option>";
			echo"<option value=2>Semester 2</option>";
			
		echo"</select></td>";

		echo"<td align='center'>Enter Subject Code<br>";
			echo'<input type="text" name="subcd" id="'.$stnum.'subcd" size="8">';
			echo'<input type="button" value="Find" onclick="subjectfilter('.$stnum.')">';
                echo"<br>[&#945; = a ]&nbsp;&nbsp;[&#946; = b]&nbsp;&nbsp;[&#948; = d]</td>";
                
		echo"<td align='center'>Select Grade<br>";
			echo'<select name="grade" id="'.$stnum.'grade" onchange="gradefilter('.$stnum.')">';
				echo"<option value='find'>Find</option>";
				echo"<option value='A%2B'>A+</option>";
				echo"<option value='A'>A</option>";
				echo"<option value='A-'>A-</option>";
				echo"<option value='B%2B'>B+</option>";
				echo"<option value='B'>B</option>";
				echo"<option value='B-'>B-</option>";
				echo"<option value='C%2B'>C+</option>";
				echo"<option value='C'>C</option>";
				echo"<option value='C-'>C-</option>";
				echo"<option value='D%2B'>D+</option>";
				echo"<option value='D'>D</option>";
				echo"<option value='D-'>D-</option>";
				echo"<option value='E'>E</option>";
				echo"<option value='E*'>E*</option>";
				echo"<option value='MC'>MC</option>";
			echo"</select>";

	echo"</tr></table>";
	///////////////////////////////////////////////////////////////////
	//////////////Ajax base response start for result//////////////////
	///////////////////////////////////////////////////////////////////
*/
	echo"<table border='0' align='center'><tr><td>";
	echo "<div align=center><img style='visibility: hidden' id='ldr2$stnum' src='./images/ajax-loader.gif'></div>";
	  echo"<div align='center' id='result2$stnum'>";
		
		//////all results///////
		//echo"<h4>All Results</h4>";
		echo"<table border='0' align='center'><tr>";
		
		echo"<th colspan=5>";
		
		$stprmntnu=$vr11->getStudentNumber($stnum);
		$lstdigts= substr("$stnum",2);
		$stprmname=$vr11->getName($lstdigts);
		if($stprmntnu!=null){
			echo$stprmntnu;
		}
		
		echo"&nbsp;( ".strtoupper($stprmname)." )";
		echo"<tr><th>#<th>Course Unit</th><th>Course Name</th><th>Grade</th><th>Date</th>";		
	   
		//$quegtrstl="select r.subject, r.grade, r.year, c.name from results r, courseunit c  where index_number='$stnum' and r.subject=c.code order by c.level,c.semister,r.subject,r.id";
		$quegtrstl="select r.subject_code, r.grade, r.Date, c.name from $rmsdb.fohssmisResult r, courseunit c, student s  where r.userName='$stnum' and r.subject_code=c.code and r.userName=s.id and s.curriculum=c.by_low_version order by c.level,c.semister,r.subject_code,r.Date";
	
		
		//echo$quegtrstl;
		$qugtrstl=mysql_query($quegtrstl);
		if(mysql_num_rows($qugtrstl)!=0){
			$reslttblrw=1;
		$resub="nil";
			while($qgtrstl=mysql_fetch_array($qugtrstl)){
			
				$subject=$qgtrstl['subject_code'];
                
                ////////////////////////////////////////////////////////////////////////////////////////
                $coursegetchr=trim($subject);

                $subjectwtabc=strtoupper($coursegetchr);
                ///////////////////////////////////////////////////////////////////////////////////////
				$grade=$qgtrstl['grade'];
				$year=$qgtrstl['Date'];
				$cname=$qgtrstl['name'];

				if($resub!=$subject){
				echo"<tr class=trbgc><td align='center'>$reslttblrw<td align='center'>$subjectwtabc</td><td>$cname</td><td align='center'>$grade</td><td align='center'>$year</td></td>";
							}
				else{
				echo"<tr class=selectbg><td align='center'>$reslttblrw<td colspan='2' align='center' >Re Attempt [ $subjectwtabc - $cname ]</td><td align='center'>$grade</td><td align='center'>$year</td></td>";
					}
				$resub=$subject;
			$reslttblrw++;
								}
						}
		else{
			echo"<tr class=trbgc><td colspan='5' align='center'>Result are not available in a system! </td>";
			}

		echo"</table>";
		//////////////////////
		echo "</div>";
	echo"</td></tr></table>";
				



//////////////////////////////////////////////////////////////////////////////////////	
					
						echo "<hr class=bar><br>";
						?>


