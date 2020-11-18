<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){


$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole) or die(mysql_error());

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}
echo$qpers['role_id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="93"){
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


<style type="text/css">
@media print {
input#btnPrint {
display: none;
}
}
</style>


<?php
//////////////edit by iranga ////////////////////////////////////////////////////
require_once('./classes/globalClass.php');
$vr93=new settings();

$currentacyear=$vr93->getAcc();

$currentsemester=$vr93->getSemister();
/////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////
require_once('./classes/attClass.php');
$g=new attendence();
/////////////////////////////////////////////////////////////////////////////////


echo"<div align='center'>";
echo"Attendance Progress of Students in Current Academic Year";
echo"<hr class=bar>";
echo"[ Individual Student's Progress  ]<br>";

include './forms/form_93.php';

echo"<hr class=bar>";
echo"[ Group of Student's Progress ]";

include './forms/form_93_2.php';
echo"<hr class=bar>";







if($task=='viewsum'){
echo'<p style="page-break-before: always">';		
	$duty=$_GET['due'];
						$stream_8_22=$_POST['stream_8_2'];
						$level_8_22=$_POST['level_8_2'];


						if(($stream_8_22!=null)&&($level_8_22!=null)){
						$_SESSION['genstream']=$stream_8_22;
						$_SESSION['genlevel']=$level_8_22;
												}

							$stream_8_2=$_SESSION['genstream'];
							$level_8_2=$_SESSION['genlevel'];
						if($stream_8_2=="all"){
							$getmnsunm4pnt="All Student ";
						}
						else{
							$quesubvr="[".$stream_8_2."]";
							$getmnsunm4pnt=$vr93->getmainsubject($stream_8_2);		
						}
						if($level_8_2==0){
							$genlvl="Recently Passout";
								}
						else{
							$genlvl="Level ".$level_8_2."000";
							}


						 $fmviweque="$rmsdb.fohssmis fs";  
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
                    
$prntday=date("d");
$prntdasup=date("S");
$prntmntnyr=date("M Y");						
echo"<table border='0' width='100%'><tr><td align='left' valign='top'>";
echo"<form method='POST' action='index.php?view=admin&admin=93'>";
echo"<input type='submit' value='Close' id='btnPrint'>";
echo"</form>";
echo"</td><td align='right' valign='top'>";
echo"Printed Date : ".$prntday."<sup>".$prntdasup."</sup> ".$prntmntnyr;
echo "<input type='button' id='btnPrint' onclick='window.print();' value='Print Page' /></td></tr></table>";	
	

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

						if($duty=="one"){
							$onestnum=$_POST['index_8_5'];
							$onestbatch=$_POST['year_8_5'];
							
							$getonestbt=$vr93->getBatch($onestnum);
							if($getonestbt==$onestbatch){
								echo "<font size=3px><b><center>Attendance Progress of HS/$onestbatch/$onestnum</center></b></font>";
								$query8_3="select s.id, s.l_name, s.batch, s.initials, s.stream,s.combination from student s, $fmviweque where s.id='hs$onestnum'  and s.id=fs.user order by s.id";
							}
							else{
								echo "<font size=2px color=red><b><center>Invalid Student Number ( HS/$onestbatch/$onestnum )</center></b></font>";
							}
							
						}
						else{
							echo "<font size=3px><b><center>Attendance Progress of ".ucfirst($getmnsunm4pnt)." in $genlvl</center></b></font>";
							if($stream_8_2=="all"){
								$query8_3="select s.id, s.l_name, s.batch, s.initials, s.stream,s.combination, l.level from student s, level l, $fmviweque where l.level='$level_8_2' and l.year=s.year and s.id=fs.user order by s.id";
							}
							else{
								$query8_3="select s.id, s.l_name, s.batch, s.initials, s.stream,s.combination, l.level from student s, level l, $fmviweque where l.level='$level_8_2' and l.year=s.year and s.combination LIKE '%$quesubvr%' and s.id=fs.user order by s.id";
							}
						}
						//echo$query8_3;
						
			





			
						
						$std_details=mysql_query($query8_3);
						echo "<table border='1'  align='center' width=95% cellspacing=0 cellspadding=0><tr><th width=3%>#<th width=5%>Photo<th  width=10%>Index No<th width=16%>Name with Initials<th>Attendance Precentage of Current Semester<br><font size=2px></b>( $currentacyear Academic Year , Semester $currentsemester )</font><b><th  width=5%>Weighted Average</tr>";
						if(mysql_num_rows($std_details)!=0){
						$i=0;
						while($data=mysql_fetch_array($std_details)){
							$i=$i+1;
						echo"<tr class=trbgc align='center'>";
						$weghtavg=0;
							$sid=$data['id'];
							$syr=$data['batch'];
							

						echo "<td align='center'>$i<td align='center'>";
						////////////////////////////////////////////////////////////////////////////////////////////////////////////
						$infostpicnm=$sid.".jpg";
					
						$picname="./../rumis/picture/user_pictures/student_std_pics/fohssmis_pic/$infostpicnm";
						//echo$picname;
						 if(file_exists($picname)){
							echo"<img src='$picname' class='stretch' alt='' width=60px border=1>";
                                }
						else{
							echo "<img src=../../rumis/picture/user_pictures/student_std_pics/SCI_Fac_no_picture.png class='stretch' alt='No Picture' width=60px border=1>";
												}
										
						////////////////////////////////////////////////////////////////////////////////////////////////////////////
						
						echo"<td><input type='hidden' name='index_8_5' value='$sid'>";
						
							$stprmtnum=$vr93->getStudentNumber($sid); 
							
							if($stprmtnum==null){
								$lstdigts= substr("$sid",2);
								$pntstprmtnum="HS/$syr/$lstdigts<br><font color=red>( Temporary Deactivated ! )</font>";
							}
							else{
								$pntstprmtnum=$stprmtnum;
							}
							echo$pntstprmtnum;
						echo"<input type='hidden' name='year_8_5' value='$syr'><td align=left> &nbsp;".$data['l_name']." ".$data['initials'];
						
						echo"<td>";
						////////////////////////////////////////////////////////////////
							$combi=$data['combination'];
						$getsubjct=explode("+",$combi);

							$rmopbckt=explode("[",$getsubjct[0]);
								$rmclbkt=explode("]",$rmopbckt[1]);
							$puresubid1=$rmclbkt[0];

							$rmopbckt2=explode("[",$getsubjct[1]);
								$rmclbkt2=explode("]",$rmopbckt2[1]);
							$puresubid2=$rmclbkt2[0];	
							
							$rmopbckt3=explode("[",$getsubjct[2]);
								$rmclbkt3=explode("]",$rmopbckt3[1]);
							$puresubid3=$rmclbkt3[0];	
							

							
								$subone=$vr93->getmainsubject($puresubid1);

							
								$subtwo=$vr93->getmainsubject($puresubid2);

							
								$subthree=$vr93->getmainsubject($puresubid3);

							echo"[ $subone + $subtwo + $subthree ]<br><br>";
							
						////////////////////////////////////////////////////////////////							
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////						
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////						
						$quecourse="select course from registration where student='$sid' and acedemic_year='$currentacyear' and (semister='$currentsemester' or semister='3') and confirm=1";
						//echo$quecourse;
						$qucourse=mysql_query($quecourse);
						if(mysql_num_rows($qucourse)!=0){
							$totcuhs=0;
							$allaryindx=0;
							$totallechsary=array();
							$totalpsntptg=array();
							while($qcourse=mysql_fetch_array($qucourse)){
								
								$course=$qcourse['course'];
								$course2=strtoupper($course);
								echo"[ $course2 ";
								/////////////////////////////////////////////////////////////////////////////////////
								/////////////////////////////////////////////////////////////////////////////////////
														
								
									$practgp=$g->getprctgp($stnumber,$course,$currentacyear);
									$quegtlecid="select * from lecture where  course='$course'and acc_year='$currentacyear' order by date,time";
									//echo$quegtlecid;
									$qugtlecid=mysql_query($quegtlecid);
										if(mysql_num_rows($qugtlecid)!=0){

											$cntlid_l=0;
											$cntlid_t=0;
											$cntlid_p=0;
											$cntlid_f=0;
											$cntlid_a=0;



											while($qgtlecid=mysql_fetch_array($qugtlecid)){

														$typ=$qgtlecid['type'];




													if($typ=="lecture"){
													$cntlid_l=$g->getSubTotal($course, $typ, $currentacyear, $practgp);

																	}


													if($typ=="tute"){
													$cntlid_t=$g->getSubTotal($course, $typ, $currentacyear, $practgp);
												
																	}

													if($typ=="practical"){
													$cntlid_p=$g->getSubTotal($course, $typ, $currentacyear, $practgp);
												
																	}


													if($typ=="field"){
													$cntlid_f=$g->getSubTotal($course, $typ, $currentacyear, $practgp);
													
																	}


													if($typ=="assignment"){
													$cntlid_a=$g->getSubTotal($course, $typ, $currentacyear, $practgp);
													
																	}



													}//main while
							
										$totlid=$cntlid_l+$cntlid_t+$cntlid_p+$cntlid_f+$cntlid_a;
 										}
										else{
											$totlid=0;
											echo"<font color='red'>- ND</font>";
										}
								/////////////////////////////////////////////////////////////////////////////////////
								/////////////////////////////////////////////////////////////////////////////////////
								$allprtylec=$g->getTotalAll($course, $sid, $currentacyear);
								//echo$allprtylec;
								//echo"/$totlid";
								
									$totallechsary[$allaryindx]=$totlid;
								
								$totattptg=($allprtylec/$totlid)*100;
								
									$totalpsntptg[$allaryindx]=$totattptg;
								if($totattptg!=0){
									echo" - ". round($totattptg)."%";
								}
								$totcuhs=$totcuhs+$totlid;
								
		
								

								
								
								
								echo" ] ";
								$allaryindx++;
							}
						}
						else{
							echo"<br><font color='red'>Sorry! Can not find course registration for current semester.</font>";
						}
						
						
						
						
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////						
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////						
					/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////						

					echo"<td align='center'>";
						//echo$totcuhs."<br>";
					for($w=0;$w<$allaryindx;$w++){
						$wgtop=$totallechsary[$w];
						
						$realwgt=round($wgtop/$totcuhs,2);
						//echo$realwgt."-";
						
						$realwgtptg=round($totalpsntptg[$w]*$realwgt,2);
						
						//echo$realwgtptg."<br>";
						$weghtavg=$weghtavg+$realwgtptg;
					}
					
					
					
					$shwwgavg=round($weghtavg,2);
					
					$pntshwwgavg = sprintf('%0.2f', $shwwgavg);
					
					echo"<b>$pntshwwgavg</b>";
					
					echo"</tr>";
						}
						echo "</table>";
						}
											
						else{
						echo"<tr class=trbgc><td colspan='6' align='center'>Sorry! No Student Found</td></tr></table>";
							}

echo"</p>";

										}
echo"</div>";						
?>





<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>

