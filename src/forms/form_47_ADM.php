<?php
$curriculum=intval($_SESSION['curriculum']);

$role = $_SESSION['role'];
$querole = "select role_id from $rmsdb.role where role='$role'";
$qurole = mysql_query($querole);
while ($qrole = mysql_fetch_array($qurole)) {
	$roleid = $qrole['role_id'];
}

if($roleid === 6){
	$studentNumber = $admisid;
	$stuNoPrint = $admisid;
}else{
	$studentNumber = "hs".$admisid;
	$stuNoPrint = $admisid;
}
///////////////////START ADMISSION///////////////////////////////
echo"<table border='0' align='center' width='100%' cellspacing='0' cellpadding='0'>";
			/////////////////////////////////////////////admission header////////////////////////////////////////////////
		
			echo"<tr><td colspan=2 align=right>&nbsp;$pntdt47</td></tr>";
			echo"<tr><td colspan=2 height='20px' >&nbsp;</td></tr>";
			echo"<tr><td align='left' width='45%' >EXAMINATION ADMISSION CARD - S7 Form</td>";


			echo"<td  width='80%' align=right><table border='1' cellspacing='0' cellpadding='0'><tr height='30px' ><td><font size='3px'>Index No : HS/$batch/$stuNoPrint</table> </td></tr>";

			echo"<tr><td colspan=2 height='30px' >&nbsp;</td></tr>";
			echo"<tr><td colspan=2 height='50px' align='center' valign='middel'><font size='4px'>UNIVERSITY OF RUHUNA<br>FACULTY OF HUMANITIES AND SOCIAL SCIENCES</font></td></tr>";
			echo"<tr><td colspan=2 height='20px' >&nbsp;</td></tr>";


			echo"<tr height='30px' ><td colspan=2><font size='3px'> Examination : $examname</td>";


			
			echo"<tr height='30px' ><td colspan=2><font size='3px'>Name of Candidate : ".strtoupper($name)."</td>";



			echo"<tr height='30px' ><td colspan=2><font size='3px'>You are allowed to sit for under mentioned course units in part B of the admission card</td></tr>";


			echo"<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo"<img src='../picture/sar.jpg' width=300px></td><td>&nbsp;</tr>";
			

			echo"<tr><td colspan=2><font size='3px'>Senior Assistant Registrar, Faculty of Humanities & Social Science </td></tr>";

			echo"<tr><td colspan=2><hr></td></tr>";
			/////////////////////////////////////////////////////////////////////////////////////////////////
			///////////////////////////////admission body/////////////////////////////////////////////////////
			echo"<tr height='50px' ><td><font size='3px'>Part A <td><font size='3px'>ATTESTATION";

			echo"<tr height='50px' valign=top ><td colspan=2><font size='3px'>Signature of Candidate "; 
			
			echo"<tr height='30px' ><td colspan=2><font size='3px'>I certify that the above candidate who has signed in my presence is known to me."; 
			
			echo"<tr><td colspan=2 >&nbsp;</td></tr>";
			
			echo"<tr height='40px' valign=top ><td colspan=2><font size='3px'>Signature of attester"; 
			
			echo"<tr align=center ><td colspan=2>";
				echo"<table border=0 align=center width=80%>";
					echo"<tr height='30px' ><td width=30%><font size='3px'>Name of Attester<td width=70%>: .....................................................................................................................";
					echo"<tr height='30px' ><td><font size='3px'>Designation <td>: .....................................................................................................................";
					echo"<tr height='30px' ><td><font size='3px'>Address <td>: .....................................................................................................................";
				echo"</table>";
				
				
			echo"<tr height='40px'  align=center><td colspan=2>The attester should be a permanent Teacher/ Staff officer in the University Service or a Staff Officer in the Government service or State Corporation";
			echo"<tr><td colspan=2><hr></td></tr>";
			
			echo"<tr height='30px'  colspan=2><td><font size='3px'>Part B ";
			echo"<tr align=center ><td colspan=2>";
			//;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
			echo"<table border='1' align='center'  cellspacing='0' cellpadding='0' width=100%>";
			echo"<tr height='30px' align='center'  ><td width='3%'>#</td><td width='10%'>Course Unit</td><td width='17%' >Course Unit Type<td width='20%' align='center'>Course Name</td><td width='10%' align='center'>Date</td><td width='16%' align='center'>Signature of Candidate</td><td width='16%' align='center'>Signature of Invigilator</td><td width='8%' align='center'>Status</td></tr>";

			$queprtadm="select er.course_code, er.course_type, er.status, c.name from exam_registration er, courseunit c  where er.academic_year='$acy' and er.semester=$cseme and er.std_id='$studentNumber' and er.course_code=c.code and c.by_low_version=$curriculum order by er.course_code";
//			echo $queprtadm;
			$quprtadm=mysql_query($queprtadm);
			$rows=0;
			$xidx=0;
			$creaxmrg=array();
			while($qprtadm=mysql_fetch_array($quprtadm)){
			$course3=$qprtadm['course_code'];
			$course2=trim($course3);
			$courseUPC=strtoupper($course2);
				$creaxmrg[$xidx]=$courseUPC;
				$xidx++;
				////////////////////////////////////////////////////////////////////////////////////////
                                $coursegetchr=trim($course3);
						$fulcode=strtoupper($coursegetchr);
				////////////////////////////////////////////////////////////////////////////////////////
					$course=$fulcode;

			$degree=$qprtadm['course_type'];
			$confirm=$qprtadm['status'];
			if($confirm==1){
				$confirm1="EL";
					}
			elseif($confirm==2){
				$confirm1="NE";
					}
			else{
				$confirm1="NC";
				}



			$name=$qprtadm['name'];
			$rows=$rows+1;

			if (in_array($courseUPC, $tnpcourse)) {

			echo"<tr height='25px'><td align='center'>$rows<td align='center'>$course (T)<td>$degree<td>$name - (Theory)<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;$confirm1</tr>";
			$rows=$rows+1;
			echo"<tr height='25px'><td align='center'>$rows<td align='center'>$course (P)<td>$degree<td>$name - (Practical)<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;$confirm1</tr>";

								}
			else{
				if($cseme==1){
					$match=0;
					for($i=0;$i<count($bothsemcourse);$i++){
						if($bothsemcourse[$i]==$course){
							$match=1;
							break;
						}
					}
					if($match==0){
						echo"<tr height='25px'><td align='center'>$rows<td align='center'>$course<td>$degree<td>$name<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;$confirm1</tr>";
					}
				}else{
					echo"<tr height='25px'><td align='center'>$rows<td align='center'>$course<td>$degree<td>$name<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;$confirm1</tr>";
				}
				}
			}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////==========================================//////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////check cos reg//////////////////////////////////

			$quechkcsregfoadm="select r.course, c.name,r.degree from registration r, courseunit c where r.acedemic_year='$acy' and (r.semister=$cseme or r.semister=3) and r.student='hs$admisid' and r.confirm=1 and r.course=c.code and c.by_low_version=$curriculum order by r.course";

			$quchkcsregfoadm=mysql_query($quechkcsregfoadm);
			if(mysql_num_rows($quchkcsregfoadm)!=0){
				while($qchkcsregfoadm=mysql_fetch_array($quchkcsregfoadm)){
						$chkcsregfoadm=trim($qchkcsregfoadm['course']);
							$chkcsregfoadmUPC=strtoupper($chkcsregfoadm);
				////////////////////////////////////////////////////////////////////////////////////////
                                $fulcodeNA=$chkcsregfoadmUPC;
				///////////////////////////////////////////////////////////////////////////////////////				
                               

					$NAcourse=$fulcodeNA;
						$chkcsnameregfoad=ucfirst($qchkcsregfoadm['name']);
					$chkcsdgsttregfoad=ucfirst($qchkcsregfoadm['degree']);
					//////////////////////////////////////////
					if($chkcsdgsttregfoad=="Non Degree"){
						$chkcsdgsttregfoad2="Non Degree Course-(6)";
					}
					else{
						$nastno="hs".$admisid;
						$chkcsdgsttregfoad2=$n->getcostype($chkcsregfoadm,$nastno);
					}
					
					
					//////////////////////////////////////////
						if(!in_array($chkcsregfoadmUPC, $creaxmrg)){
							$rows=$rows+1;

			////////////////////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
							if (in_array($chkcsregfoadmUPC, $tnpcourse)) {

								echo"<tr height='25px'><td align='center'>$rows<td>&nbsp; * $NAcourse (T)<td>$chkcsdgsttregfoad2<td>$chkcsnameregfoad - (Theory)<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;NA</tr>";
								$rows=$rows+1;
								echo"<tr height='25px'><td align='center'>$rows<td>&nbsp; * $NAcourse (P)<td>$chkcsdgsttregfoad2<td>$chkcsnameregfoad - (Practical)<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;NA</tr>";

													}
								else{
								echo"<tr height='25px'><td align='center'>$rows<td>&nbsp; * $NAcourse<td>$chkcsdgsttregfoad2<td>$chkcsnameregfoad <td>&nbsp; <td>&nbsp;<td>&nbsp;<td>&nbsp;&nbsp;NA</tr>";
									}
////////////////////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////////////////
											}
												}
								}
			/////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////==========================================//////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			for($em=1;$em<=2;$em++){
			echo"<tr height='25px'><td align='center'>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;</tr>";
											
			}

		
			echo"<tr height='35px'><td align='center' colspan=8 valign=bottom>EL : Eligible &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NE : Not Eligible &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NC : Not Confirm &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NA : Not Applied</td></tr>";
			echo"</table>";

			//;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

			echo"</td></tr>";
			//////////////////////////////////////////////////////////////////////////////////////////////////////

			/////////////////////////////admission footer/////////////////////////////////////////////////////////
		
			

			echo"</font></table><br>";
			///////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////END ADMISSION///////////////////////////////////////////////
?>
