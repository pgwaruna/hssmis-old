<?php
session_start();
if((($_SESSION['login'])=="truefohssmis")&&($_SESSION['role']!="student")){
error_reporting(0);
?>
<style type="text/css">
@import url('../style/default.css');
</style>
<link href="../css/fosmiscss.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="../Ajax/result_filt.js"></script>

<?php
include'../admin/config.php';
$con6_7=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
mysql_select_db($db);
////////////////////////////get ac year//////////////////////////
$queacyear="select acedemic_year from acc_year where current=1";
$quacyear=mysql_query($queacyear);
$qacyear=mysql_fetch_array($quacyear);
$acyear=$qacyear['acedemic_year'];
/////////////////////////////////////////////////////////////////

///////////////get semester//////////////////////////////////////
$queseme="select DISTINCT semister from level";
$quseme=mysql_query($queseme);
$qseme=mysql_fetch_array($quseme);
$seme=$qseme['semister'];
//////////////////////////////////////////////////////////////////
$vfrom=$_POST['vfrom'];
$vfromtp=$_POST['vfromtp'];
$task=$_GET['task'];

require_once('../classes/attClass.php');
$at=new attendence();


echo"<div id='a'>";
echo"<table border='0'  width='100%' style='background-image: url(../picture/bgpic.jpg); background-repeat: no-repeat' >";
echo"<tr>";
echo"<td width='15%' align='center' ><image src='../animations/UoRlogo3.png'></td>";
echo"<td colspan='1'  valign='middle'><font size='6' >Faculty of Science";
echo"<br><font size='5'>Management Information System";
echo"<br>[ F O S M I S ]";
echo"</font></td></tr>";
echo"<tr class=newsbar>";
//echo"<td colspan='3' bgcolor='e98ff1'>&nbsp;</td></tr>";
	


echo"<td colspan='3'><div><marquee scrollamount='3' onmouseover='this.stop();' onmouseout='this.start();'>Welcome To The Management Information System!&nbsp;&nbsp;&nbsp;";
include "../news.php";
echo"</marquee></div></td>";




echo"<tr><td colspan='3' align='center' >";
echo"<table border='0' width='100%' ><tr><td align='center' width=25%>";


if($task=="viewinf"){
/////////////////////////////////////////////////////////////////////come from 56//////////////////////////////////////////////////////////
if($vfrom==56){
$bttnm56=$_POST['year_8_5'];
$stno56=$_POST['index_8_5'];
if(($bttnm56!=NULL)&&($stno56!=NULL)){
$_SESSION['bttnm56']=$bttnm56;
$_SESSION['stno56']=$stno56;
					}

$bttnm56gt=$_SESSION['bttnm56'];
$stno56gt=$_SESSION['stno56'];


if($vfromtp=="one"){		
	echo"<form method=POST action='../index.php?view=admin&admin=56&task=onest'><img src='../images/small/back.png'><br><input type=submit value='Back'><input type=hidden name='index56' value='$stno56gt'> <input type=hidden name='year56' value='$bttnm56gt'></form></td>";
			}
else{

echo"<form method=POST action='../index.php?view=admin&admin=56&task=lvlflt'><img src='../images/small/back.png'><br><input type=submit value='Back'></form></td>";


	}
		}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
else{
echo"<a href='../index.php?view=admin&admin=46' name='top'><img src='../images/small/back.png'><br>&nbsp;Back to Home</a></td>";
	}

}
else{
echo"<a href='../index.php?view=admin' name='top'><img src='../images/small/back.png'><br>&nbsp;Back to Home</a></td>";
}
echo"<td align='center' width=50%>";



if($task=="viewinf"){
echo"<h3>Student Information </h3></td>";
}
else{
echo"<h3>Details of Your Mentoring Student </h3></td>";

}

if($task!="viewinf"){
echo"<td align='center'><a href='../forms/mentor.php?task=check' ><img border='0' src='../images/small/edit-redo.png' ><br>Back to Name List</a></td>";
}
else{
echo"<td align='center' width=25%>";

$stpic=$_POST['index_8_5'];
if($stpic!=""){
$_SESSION['stpicnm']="sc".$stpic;
}
//echo$_SESSION['stpicnm'];
$picname="../../rumis/picture/user_pictures/student_std_pics/fohssmis_pic/".$_SESSION['stpicnm'].".jpg";
    
        if(file_exists($picname)){
            echo"<img src='$picname' class='stretch' alt='' width=100px height=110px border=3>";
                                }
        else{
            echo "<img src=../../rumis/picture/user_pictures/student_std_pics/SCI_Fac_no_picture.png class='stretch' alt='' width=100px height=110px>";
                                }





echo"</td>";}

echo"</tr></table>";
echo"<tr><td colspan='3'>";




///////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////stat main///////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////

$due=$_GET['due'];
$check=$_GET['check'];
$mntid1=$_SESSION['Smntid'];
$st=$_POST['stno'];
$submit=$_POST['bttnm'];
$level=$_POST['level'];
$flname=$_POST['flname'];
	$name=explode("-",$flname);
	$lname=$name[0];
	$initi=$name[1];

///////////////////////////////////////////////////////////////////////////////////////////////////////////	
////////////////////////////////////student personal information menu//////////////////////////////////////
////////////////////////////////////////////task=="viewinf" ///////////////////////////////////////////////
if($task=="viewinf"){
$infstno=$_POST['stno'];
$subm=$_POST['bttnm'];

if($subm==null){
$stno1=$_POST['index_8_5'];
$stye=$_POST['year_8_5'];
}
else{
$gtinfstno=explode("/",$infstno);
$stno1=$gtinfstno[2];
$stye=$gtinfstno[1];
}



$quegtst="select * from student where id='$stno1' and batch=$stye";
	//echo$quegtst;
	$qugtst=mysql_query($quegtst);
	if(mysql_num_rows($qugtst)==0){
		echo"<div align='center'><font color='red'>Invalid student number !  Recheck student number.</font></div><br>";
					}
	else{
		while($qgtst=mysql_fetch_array($qugtst)){
		$id=$qgtst['id'];
		$l_name=$qgtst['l_name'];
		$initials=$qgtst['initials'];
		$batch=$qgtst['batch'];
		$stream=$qgtst['stream'];
		$combi=$qgtst['combination'];
		$year=$qgtst['year'];



	echo"<table border='0' align='center'><tr>";
	echo"<th>Student Number</th><th>Name with Initials</th><th>Stream</th><th>Current Level</th><th colspan='3' align='center'>View Details</th></tr>";
echo"<form method='POST' action='?task=viewinf&due=prew'>";	
	echo"<tr class=trbgc><td align='center'>SC/$batch/$id<input type='hidden' name='stno' value='SC/$batch/$id'></td><td align='center'>$l_name $initials<input type='hidden' name='flname' value='$l_name-$initials'></td><td align='center'>";
		
	if($stream=="phy"){
		echo"Physical Science";
				}
	elseif($stream=="bio"){
		echo"Biological Science";
				}
	else{
		echo"Computer Science";
		}
	echo"</td><td align='center'>";
			$quegtlvl="select level from level where year=$year";
			$qugtlvl=mysql_query($quegtlvl);
			while($qgtlvl=mysql_fetch_array($qugtlvl)){
				$gtlvl=$qgtlvl['level'];
								    }
	if($gtlvl!=0){
	echo"Level ".$gtlvl."<input type='hidden' name='level' value='$gtlvl'>";
			}
	else{
	echo"Passout Student<input type='hidden' name='level' value='$gtlvl'>";
		}
	if($gtlvl!=0){
	echo"</td><td align='center'><input type='submit' value='Personal' name='bttnm'>";
	    echo"<input type='submit' value='Hostel' name='bttnm'></td>";
	echo"<td align='center'><input type='submit' value='Results' name='bttnm'></td>";
	echo"<td align='center'><input type='submit' value='Current Attendence' name='bttnm'>";
		echo"<input type='submit' value='All Attendence' name='bttnm'>";
		echo"<input type='submit' value='Course Registration' name='bttnm'></td>";
	
	
	}
	else{
	echo"</td><td align='center'><input type='submit' value='Personal' name='bttnm'>";
        echo"<input type='submit' value='Hostel' name='bttnm'></td>";
	echo"<td align='center'><input type='submit' value='Results' name='bttnm'></td>";
	//echo"<td align='center'><input type='submit' value='Attendence' name='bttnm'></td>";
	echo"<td align='center'><input type='submit' value='All Attendence' name='bttnm'>";
		echo"<input type='submit' value='Course Registration' name='bttnm'></td>";
	
	}
	echo"<input type=hidden name=vfrom value='$vfrom'> <input type=hidden name=vfromtp value='$vfromtp'></form></tr>";
	
		
						}
	echo"</table>";
	

		}

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////end task=="viewinf"///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
		
	
	
	
///////////////////////////////////////////////////////////////////////////////////////////////////////////	
//............./////////////..................due=='prew //////................//////////////...../////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
if($due=='prew'){
$gtnum=explode("/",$st);
$byear=$gtnum[1];
$stnum=$gtnum[2];

echo"<br><div align='center'><h4>$submit Details of &nbsp;$lname &nbsp;$initi ($st) </h4></div>";

////////////////////////////////////////////////////////////////////
////////view student's personal information process/////////////////
////////////////////////////////////////////////////////////////////
	
	if($submit=="Personal"){
		include 'disp_p_info.php';
			}//end p info

////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
////////view student's results process//////////////////////////////
////////////////////////////////////////////////////////////////////
	if($submit=="Results"){
	 
	echo"<table border='0' align='center'><tr class=trbgc><td>";
		echo'<select name="level" size="4" id="'.$stnum.'level" onclick="levelfilter('.$stnum.')">';
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
	echo"<table border='0' align='center'><tr><td align='center'>";
	echo "<img style='visibility: hidden' id='ldr$stnum' src='../images/ajax-loader.gif'>";
	  echo"<div align='center' id='result$stnum'>";
		
		//////all results///////
		echo"<h4>All Results</h4>";
		echo"<table border='0' align='center'><tr>";
		echo"<th>Course Unit</th><th>Subject Name</th><th>Grade</th><th>Year</th>";		
	   
		$quegtrstl="select r.subject, r.grade, r.year, c.name from results r, courseunit c  where index_number='$stnum' and r.subject=c.code order by c.level,c.semister,r.subject,r.year,r.id";
		//echo$quegtrstl;
		$qugtrstl=mysql_query($quegtrstl);
		if(mysql_num_rows($qugtrstl)!=0){
		$resub="nil";
			while($qgtrstl=mysql_fetch_array($qugtrstl)){
			
				$subject2=$qgtrstl['subject'];
				$subject=trim($subject2);
					////////////////////////////////////////////////////////////////////////////////////////
					$coursegetchr=trim($subject2);
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

					$subjectallrest=strtoupper($ccdwoutcrd.$credit);
					///////////////////////////////////////////////////////////////////////////////////////
				
				
				
				$grade=$qgtrstl['grade'];
				$year=$qgtrstl['year'];
				$cname=$qgtrstl['name'];

				if($resub!=$subject){
				echo"<tr class=trbgc><td align='center'>$subjectallrest</td><td>$cname</td><td align='center'>$grade</td><td align='center'>$year</td></td>";
							}
				else{
				echo"<tr class=selectbg><td colspan='2' align='center' >Repeat Attempt [ $subjectallrest - $cname ]</td><td align='center'>$grade</td><td align='center'>$year</td></td>";
					}
				$resub=$subject;
			
								}
						}
		else{
			echo"<tr class=trbgc><td colspan='4' align='center'>Result are not available in a system! </td>";
			}

		echo"</table></div>";
		//////////////////////
		
	echo"</td></tr></table>";
				}// end result

	///////////////////////////////////////////////////////////////////
	//////////////Ajax base response stop for result//////////////////
	///////////////////////////////////////////////////////////////////
				
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
////////view student's attendence process///////////////////////////
////////////////////////////////////////////////////////////////////
	if($submit=="Current Attendence"){
		$quecourse="select course from registration where student='$stnum' and acedemic_year='$acyear' and (semister='$seme' or semister='3') and confirm=1";
		//echo$quecourse;
		$qucourse=mysql_query($quecourse);
	
			echo"<table border='0' align='center' width='80%'><tr><th>Course Unit<th>Progress</tr>";
			if(mysql_num_rows($qucourse)!=0){	
			echo"<tr class=trbgc><td width='20%' align='center' valign='top'>";		
			
			while($qcourse=mysql_fetch_array($qucourse)){
				$course2=$qcourse['course'];
				$course=strtoupper($course2);
				echo"<input type=\"button\" value=\"$course\" onclick=\"getattenpgs('".$stnum."','".$course."','".$acyear."')\"><br>";

				
					}//main while

			

			echo"</td><td valign='top' align='center'>";
			echo "<img style='visibility: hidden' id='load' src='../images/ajax-loader.gif'>";
			echo'<div id="dispatt"></div>';
				
			echo"</td></tr></table>";
								}

			else{
			echo"<tr class=trbgc><td width='20%'>&nbsp;</td><td align='center'><font color='red'>Student was not register to the course units.</font></td></tr></table>";
				}
				}//end attendence
			

			
	//////////////////////////All attendence/////////////////////////////////////////////			
	if($submit=="All Attendence"){
			//echo$stnum.$submit;	
			$quegtallatt="select r.course,c.name,r.acedemic_year,r.semister,r.degree from registration r ,courseunit c where r.student='$stnum' and r.confirm=1 and r.course=c.code order by r.acedemic_year,r.semister,r.course";		
			$qugtallatt=mysql_query($quegtallatt);
			if(mysql_num_rows($qugtallatt)!=0){
				echo"<table border=0><th>Course Unit<th>Course Name<th>Reg.Acedamic Year<th>Reg.Semester<th>Degree Status<th>Total Hours <th>Present Hours <th>Present (%)";
					while($qgtallatt=mysql_fetch_array($qugtallatt)){
						$course=$qgtallatt['course'];
						////////////////////////////////////////////////////////////////////////////////////////
							$coursegetchr=trim($course);
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

							$subjectallatt=strtoupper($ccdwoutcrd.$credit);
							///////////////////////////////////////////////////////////////////////////////////////
				
						$name=$qgtallatt['name'];
						$acedemic_year=$qgtallatt['acedemic_year'];
						$semister=$qgtallatt['semister'];
							if($semister==3){
									$semister=2;
											}
						$degree=$qgtallatt['degree'];
						if($degree==1){
									$degree1="Degree";
												}
								else{
									$degree1="<font color='red'>Non Degree</font>";
									}
							echo"<tr class=trbgc><td align='center'>$subjectallatt<td>$name<td align='center'>$acedemic_year<td align='center'>Semester $semister<td align='center'>$degree1<td align='center'>";
								$practgp=$at->getprctgp($stnum,$course,$acedemic_year);
									$totlecths=$at->getSubTotalAll($course, $acedemic_year,$practgp);
									
										echo"<b>".$totlecths."</b><br>";	

										$quelettp="select distinct(type) from lecture where course='$course' and acc_year='$acedemic_year'";
										$qulettp=mysql_query($quelettp);
										if(mysql_num_rows($qulettp)!=0){
										$alllectype=array();
										$totlecthotp=array();
										$i=0;
											while($qlettp=mysql_fetch_array($qulettp)){
													$lettp=$qlettp['type'];
														$trelet=substr("$lettp", 0,4);
														
														
														
													echo"[".ucfirst($trelet).":";
													$alllectype[$i]=ucfirst($trelet);
													
														$totlecbytp=$at->getSubTotal($course, $lettp, $acedemic_year, $practgp);
														echo$totlecbytp."] ";
														$totlecthotp[$i]=$totlecbytp;
														$i=$i+1;
																						}
																		}
						
							
							echo"<td align='center'>&nbsp;";
																											
									$getpesall=$at->getTotalAll($course, $stnum, $acedemic_year);
										
										echo"<b>".$getpesall."</b><br>";
																												
										$quelettp1="select distinct(type) from lecture where course='$course' and acc_year='$acedemic_year'";
										$qulettp1=mysql_query($quelettp1);
										if(mysql_num_rows($qulettp1)!=0){
										$prtyhours=array();
										$j=0;
											while($qlettp1=mysql_fetch_array($qulettp1)){
													$lettp1=$qlettp1['type'];
														$trelet1=substr("$lettp1", 0,4);
													echo"[".ucfirst($trelet1).":"; 
													
												$totprs=$at->getTotal($course, $stnum, $lettp1, $acedemic_year);
														echo$totprs."]<br>";
														$prtyhours[$j]=$totprs;
														$j=$j+1;
																							}
																		
																		}
							
							echo"<td align='center'>";
						
								$ppecen=($getpesall/$totlecths)*100;
								echo"<b>".round($ppecen,2)."%</b><br>";
								if($ppecen!=0){
									for($k=0;$k<$i;$k++){
										echo"[".$alllectype[$k].":";
										
											$typecn=($prtyhours[$k]/$totlecthotp[$k])*100;
									
											echo round($typecn,2)."%]<br>";
															
								//echo$totlecthotp[$k]."--".$prtyhours[$k]." ";
															
															
															}
												}
						
						
							echo"</tr>";
						
						
						
						
						
						
						
																	}
				
				echo"</table><br>";
												}
			else{
				echo"<font color=red>Sorry ! Can not find Attendence.</font>";
				}
					
					
										}
	////////////////////////////////end All attendence////////////////////////////////////
	
	
	
	
	//////////////////////////// Course Registration/////////////////////////////////////////
	if($submit=="Course Registration"){
			//echo$stnum.$submit;
			$quegetallcredit="select sum(c.credits) as totcredit from courseunit c, registration r where r.student='$stnum' and r.course=c.code and r.confirm=1 and r.degree=1" ;
			//echo$quegetallcredit;
			$qugetallcredit=mysql_query($quegetallcredit);
			if(mysql_num_rows($qugetallcredit)!=0){
				$qgetallcredit=mysql_fetch_array($qugetallcredit);
					$totcredit=$qgetallcredit['totcredit'];
					
			echo"<p align='center'><font color='blue'>Total no of registered credits up today : ".$totcredit."</font></p><br>"; 
													}
			
			
			///////////////////// display course detaials//////////////////
				$quegeallcosreg="select r.*,c.name from registration r,courseunit c where r.student='$stnum' and r.confirm=1 and r.course=c.code order by r.acedemic_year,r.semister,r.course";
				//echo$quegeallcosreg;
				$qugeallcosreg=mysql_query($quegeallcosreg);
				if(mysql_num_rows($qugeallcosreg)!=0){
				
				echo"<table border=0 align='center'><th>Course Unit<th>Course Name<th>Reg. Acedamic Year<th>Reg. Semester<th>Degree Status<th>Final Result and Year"; 
				
						while($qgeallcosreg=mysql_fetch_array($qugeallcosreg)){
							$allcors=$qgeallcosreg['course'];
								////////////////////////////////////////////////////////////////////////////////////////
									$coursegetchr=trim($allcors);
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

									$subjectallcos=strtoupper($ccdwoutcrd.$credit);
									///////////////////////////////////////////////////////////////////////////////////////
				
							$allacyear=$qgeallcosreg['acedemic_year'];
							$allseme=$qgeallcosreg['semister'];
								if($allseme==3){
									$allseme=2;
												}
							$alldgst=$qgeallcosreg['degree'];
								if($alldgst==1){
									$alldgst1="Degree";
												}
								else{
									$alldgst1="<font color='red'>Non Degree</font>";
									}
							$allconame=$qgeallcosreg['name'];
							
							//echo$allcors.$allconame.$allacyear.$allseme.$alldgst."<br>";
							echo"<tr class=trbgc><td align=center>$subjectallcos<td>&nbsp; $allconame<td align=center>$allacyear<td align=center>Semester $allseme<td align=center>$alldgst1<td align=center>";
							
									$quegetres="select grade,year from results where index_number='$stnum' and subject='$allcors' order by id";
									//echo$quegetres;
									$qugetres=mysql_query($quegetres);
									if(mysql_num_rows($qugetres)!=0){
										while($qgetres=mysql_fetch_array($qugetres)){
											$allgrede=$qgetres['grade'];
											$allgdyear=$qgetres['year'];
															
																}
										echo$allgrede." &nbsp; [".$allgdyear." ]";
																		}
									else{
										echo"Can't Find";
											}
									
							
																				}
				echo"</tr></table><br>";
													}
				else{
					echo"<p align='center'><font color='red'>Sorry ! Can not find Course Registration Details.</font></p><br>";
					}
														}
				
	//////////////////////////////////end course registrationa ///////////////////////////////
	
	
	///////////////////////////// hostal information/////////////////////////////////////////////
	if($submit=="Hostel"){
	    $hsstyr=$byear;
        $hsstnmb=$stnum;

//echo$hsstyr.$hsstnmb;
       $quegethostinf="select  h.* from $rmsdb.fohssmis_hostel h ,$rmsdb. fohssmisStudents fs where fs.user_name='sc$hsstnmb' and fs.SSID=h.SSID order by AcademicYear";
            //echo$quegethostinf;
            $qugethostinf=mysql_query($quegethostinf);
            
            if(mysql_num_rows($qugethostinf)==0){
            echo"<div align=center><font color=red>Sorry ! Can not find informations </font></div><br>";
            }
            else{
            echo"<table> ";
            echo"<th>#<th>Registered Academic Year<th>Used Level<th>Name of Hostel<th>Room Number<th>Selection Method<th>Charges Paid<th>Bill No<th>Hostel Facility Used";
            $hr=1;
            while($qgethostinf=mysql_fetch_array($qugethostinf)){
                
                $AcademicYear=$qgethostinf['AcademicYear'];
                $NameOfHostel=$qgethostinf['NameOfHostel'];
                $SelectedMethod=$qgethostinf['SelectedMethod'];
                $ChargesPaid=$qgethostinf['ChargesPaid'];
                $BillNO=$qgethostinf['BillNO'];
                $HostelFacilityUsed=$qgethostinf['HostelFacilityUsed'];
                $Level=$qgethostinf['Level'];
                $RoomNumber=$qgethostinf['RoomNumber'];
            
            echo"<tr class=trbgc align=center height=30px><td>$hr<td>$AcademicYear<td>$Level<td>$NameOfHostel<td>$RoomNumber<td>$SelectedMethod<td>$ChargesPaid<td>$BillNO<td>$HostelFacilityUsed";
            
            $hr++;
            }
            
            
            
            echo"</table><br>";
        
    }

    }
	/////////////////////////////end hostal information//////////////////////////////////////////
	
	
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////

}//end prew if


/////////////////////////////////////////////////////////////////////////////////////////////////////////
//........../////////////.............../end due=='prew/................///////////////........//////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////
////////////////////////task=='check' //////////////////////////////////
////////////////////////////////////////////////////////////////////////
if($task=='check'){

	$quegtst="select * from student where mentor_id= '$mntid1' order by id DESC";
	$qugtst=mysql_query($quegtst);
	if(mysql_num_rows($qugtst)==0){
		echo"<div align='center'>Sorry ! You have not initiate any student.</div>";
					}
	else{
	
	echo"<table border='0' align='center'><tr>";
	echo"<th>Photo<th>Student Number</th><th>Name with Initials</th><th>Stream</th><th>Current Level</th><th colspan='3' align='center'>View Details</th></tr>";

	while($qgtst=mysql_fetch_array($qugtst)){
		$id=$qgtst['id'];
		$l_name=$qgtst['l_name'];
		$initials=$qgtst['initials'];
		$batch=$qgtst['batch'];
		$stream=$qgtst['stream'];
		$combi=$qgtst['combination'];
		$year=$qgtst['year'];
	echo"<form method='POST' action='?task=check&due=prew'>";	
	echo"<tr class=trbgc>";
        echo"<td align='center'>"; 
    ////////////////////////////////////////////////
    $stpic=$id;
        if($stpic!=""){
        $_SESSION['stpicnm']="sc".$stpic;
            }
        //echo$_SESSION['stpicnm'];
        $picname="../../rumis/picture/user_pictures/student_std_pics/fohssmis_pic/".$_SESSION['stpicnm'].".jpg";
    
        if(file_exists($picname)){
            echo"<image src='$picname' class='stretch' alt='' width=100px height=110px border=3>";
                                }
        else{
            echo "<img src=../../rumis/picture/user_pictures/student_std_pics/SCI_Fac_no_picture.png class='stretch' alt='' width=100px height=110px>";
                                }





echo"</td>";
                        
    ///////////////////////////////////////////////
    
    
    
    
	
	echo"<td align='center'>SC/$batch/$id<input type='hidden' name='stno' value='SC/$batch/$id'></td><td align='center'>$l_name $initials<input type='hidden' name='flname' value='$l_name-$initials'></td><td align='center'>";

	if($stream=="phy"){
		echo"Physical Science";
				}
	elseif($stream=="bio"){
		echo"Biological Science";
				}
	else{
		echo"Computer Science";
		}
	echo"</td><td align='center'>";
			$quegtlvl="select level from level where year=$year";
			$qugtlvl=mysql_query($quegtlvl);
			while($qgtlvl=mysql_fetch_array($qugtlvl)){
				$gtlvl=$qgtlvl['level'];
								    }
									
	if($gtlvl!=0){
	echo"Level ".$gtlvl."<input type='hidden' name='level' value='$gtlvl'>";
			}
	else{
	echo"Passout Student<input type='hidden' name='level' value='$gtlvl'>";
		}
	if($gtlvl!=0){
	echo"</td><td align='center'><input type='submit' value='Personal' name='bttnm'>";
        echo"<input type='submit' value='Hostel' name='bttnm'></td>";
	echo"<td align='center'><input type='submit' value='Results' name='bttnm'></td>";
	echo"<td align='center'><input type='submit' value='Current Attendence' name='bttnm'>";
		echo"<input type='submit' value='All Attendence' name='bttnm'>";
		echo"<input type='submit' value='Course Registration' name='bttnm'></td>";
	
	}
	else{
	echo"</td><td align='center'><input type='submit' value='Personal' name='bttnm'>";
	   echo"<input type='submit' value='Hostel' name='bttnm'></td>";
	echo"<td align='center'><input type='submit' value='Results' name='bttnm'></td>";
	echo"<td align='center'><input type='submit' value='All Attendence' name='bttnm'>";
		echo"<input type='submit' value='Course Registration' name='bttnm'></td>";
	
	
	}								

	echo"</form></tr>";
	
		
						}
	echo"</table>";
	

		}
	     }
//////////////////////////////////////////////////////////////////////////////////
///////////////////////////end task=='check'//////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////



		 




//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////end main////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
echo"</td></tr><tr><td colspan='3' align='center'> © Faculty of Science, University of Ruhuna. <a href='../profile.php'>About FOSMIS</a>&nbsp;</td></tr>";
echo"</table>";
echo"</div>";
?>




<?php
}	
else{
echo "You Have Not Permission To Access This Area!";
}
?>

