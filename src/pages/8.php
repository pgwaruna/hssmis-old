<?php
echo "Student Information Unit<hr class=bar>";
///////////////////////////////////////////student information genarating///////////////////////////////
						if($task=='viewsin'){
						if(isset($_POST['submit'])){
						$index_8_5=$_POST['index_8_5'];
						$year_8_5=$_POST['year_8_5'];
						}
						else{
						$index_8_5=$_GET['S_id'];
						$year_8_5=$_GET['S_year'];
						}
						echo"<b>Student Informations</b><br>";			
						echo 	$index_8_5;	
						//$query8_4="select s.id, s.l_name, s.initials, l.year, s.stream, l.level from student s, level l where s.id='$index_8_5' and s.batch=l.year and l.year='$year_8_5'";

						//$query8_4="select s.id, s.l_name, s.initials, s.batch, s.stream, l.level from student s, level l where s.id='$index_8_5' and s.year=l.year and s.batch='$year_8_5'";
						$query8_4="select s.id, s.l_name, s.initials, s.batch, s.stream, l.level from student s, level l where s.id='$index_8_5'  and s.batch='$year_8_5'";


		
						$std_detail=mysql_query($query8_4);
	if(mysql_num_rows($std_detail)!=0){	
					
						while($data=mysql_fetch_array($std_detail)){
						echo "<font color=#656532><table border='0' cellpadding='4' class=bgc><tr><td rowspan='4'>";
						$stid=$data['id'];
						$stpic="sc".$stid.".jpg";
			
						$picname="./../rumis/picture/user_pictures/student_std_pics/fohssmis_pic/$stpic";

						if(file_exists($picname)){
							echo"<image src='$picname' class='stretch' alt='' width=100px height=110px>";
								}
						else{
							echo "<img src=../../rumis/picture/user_pictures/student_std_pics/SCI_Fac_no_picture.png class='stretch' alt='' width=100px height=110px>";
									}


						
						
						
						
						
						
						
						//////////////////////////////////////////////////////////
						/*$file_8='images/std_pics/'.$data['id'].'.jpg';
						if(file_exists($file_8)){
						echo '<img src='.$file_8.' border=1>';
						}
						else{
						echo '<img src=images/std_pics/no_picture.jpg border=1>';
						}*/
						////////////////////////////////////////////////////////////
						echo "</td><td>Index No </td><td>: HS/".$data['batch']."/".$data['id'];
						echo "<tr><td>Name with Initials</td><td>: ".$data['l_name']." ".$data['initials']."<tr><td>Current Level </td><td>: ";
                        if($data['level']!=0){
						  echo"Level ".$data['level'];
						                      }
                        else{echo"Passout Student";}
						echo "<tr><td>Stream </td><td>: ";
						if($data['stream']=='phy')
						echo "Physical Science";
						elseif($data['stream']=='bio')
						echo "Biological Science";
						elseif($data['stream']=='bcs')
						echo "Computer Science";
						echo "</tr></table></font>";
						
						}
						
						
						/////////////////// combination printing /////////////////////////////
						
						echo "<br><b>Subject Combination</b><br>";
						$index_8_8=$_GET['S_id'];

						$query8_5="select c.department as dept, c.subject as sub from combination c, student s where c.id=s.combination and s.id='$index_8_5'";
						
						$std_single=mysql_query($query8_5);
						echo "<table border='0' width='40%'>";
						//echo"<tr><td>ssss</td></tr>";
						while($data8=mysql_fetch_array($std_single)){
						echo "<tr class=trbgc><td width='20px'><li>";
						$sub_name=explode("_",$data8['sub']);
						echo ucfirst($sub_name[0])." ".ucfirst($sub_name[1]);
						echo "</li></td></tr>";
						}
						echo "</table>";
						
						//////////////////// End Printing Combination ////////////////////////
						echo"<br><b>Basic Personal Information</b><br>";
												
						$stno="SC/".$year_8_5."/".$index_8_5;
						//echo$stno;
						$quedata="select * from   student_personal_detais where stno='$stno'";
						$qudata=mysql_query($quedata);
						if(mysql_num_rows($qudata)!=0){
						while($qdata=mysql_fetch_array($qudata)){

							$nic=$qdata['nic'];
							$dob=$qdata['dob'];
							$gender=$qdata['gender'];
							$padd1=$qdata['padd1'];
							$padd2=$qdata['padd2'];
							$padd3=$qdata['padd3'];
							$padd4=$qdata['padd4'];
							$tel_home=$qdata['tel_home'];
							$tel_mobile=$qdata['tel_mobile'];
							$email=$qdata['email'];
							$cstatus=$qdata['cstatus'];
							$nationality=$qdata['nationality'];
							$religion=$qdata['religion'];
							$district=$qdata['district'];
							if($cstatus!=null){
							echo"<table border='0' class=bgc>";
							echo"<tr class=trbgc><td width='50%'>National Identity Card Number</td><td>: $nic</td></tr>";
							echo"<tr class=trbgc><td>Date Of Brith</td><td>: $dob</td></tr>";
							echo"<tr class=trbgc><td>Gender</td><td>: $gender</td></tr>";
							echo"<tr class=trbgc><td rowspan='4' valign='top'>Permenent Address</td><td>: $padd1</td></tr>";
							echo"<tr class=trbgc><td>&nbsp;&nbsp;$padd2</td></tr>";
							echo"<tr class=trbgc><td>&nbsp;&nbsp;$padd3</td></tr>";
							echo"<tr class=trbgc><td>&nbsp;&nbsp;$padd4</td></tr>";
							echo"<tr class=trbgc><td>District</td><td>: $district</td></tr>";
							echo"<tr class=trbgc><td align='right'>Contact:-&nbsp;&nbsp;&nbsp;&nbsp;Home :&nbsp;&nbsp;$tel_home</td><td align='right'>Mobil :&nbsp;&nbsp;$tel_mobile</td></tr>";
							echo"<tr class=trbgc><td>Email</td><td>: <a href='mailto:$email'>$email</a></td></tr>";
							echo"<tr class=trbgc><td>Civil Status</td><td>: $cstatus</td></tr>";
							echo"<tr class=trbgc><td>Nationality</td><td>: $nationality</td></tr>";
							echo"<tr class=trbgc><td>Religion</td><td>: $religion</td></tr>";


							echo"</table>";





										}

							else{
								echo"<font color='red'>Sorry ! Cannot find Basic Personal Information</font><br>";
							}


											}
										}
						else{
							echo"<font color='red'>Sorry ! Cannot find Basic Personal Information</font><br>";
							}
	






			}
						else{
						echo"<font color='red'>Invalid Student Number !</font><br>";
							}
	echo "<hr class=bar>";	
						}
						//else{
///////////////////////////////////// end student information genarating///////////////////////////////						        
						        
echo "[ View Single Student Information ]<br><br>";
        include 'forms/form_8_1.php';
                    
                    

echo "<hr class=bar>";
echo "[ View Grouped Student Information ]<br><br>";
include 'forms/form_8_2.php';						
$fmviweque="$rmsdb.fohssmisStudents fs";  												
						//Grouping student details
						
						
						
						if(($task=='viewsum')&&(isset($_POST['submit']))){
						$stream_8_2=$_POST['stream_8_2'];
						
						if($stream_8_2=="phy"){$stream_8_22="Physical Science";}
                        elseif($stream_8_2=="bio"){$stream_8_22="Biological Science";}
                        else{$stream_8_22="Computer Science";}
                        
						$level_8_2=$_POST['level_8_2'];
						
						//	echo "<hr color=#E1E1F4 width=95% ><br>";
						echo "<b><center>Student List for $stream_8_22 Stream and Level $level_8_2</center></b><br>";
						$con8_3=mysql_connect($host,$user,$pass)or die("Unable to connect Database");
						mysql_select_db($db);		
						$query8_3="select s.id, s.l_name, s.batch, s.initials, s.stream, l.level from student s, level l, $fmviweque where l.level='$level_8_2' and l.year=s.year and s.stream='$stream_8_2' and concat('sc',s.id)=fs.user_name";
						$std_details=mysql_query($query8_3);
                        if(mysql_num_rows($std_details)!=0){
						echo '<table border="0" ><tr><th>No<th>Index No<th>Name<th>View Details</tr>';
                        $no=1;
						while($data=mysql_fetch_array($std_details)){
						echo "<tr class=trbgc><td align=center>$no<td align=center>SC/".$data['batch']."/".$data['id']."<td>".$data['l_name']." ".$data['initials']."<td align=center><a href=index.php?view=admin&admin=8&task=viewsin&S_id=".$data['id']."&S_year=".$data['batch'].">View</a></tr>";
						$no++;
                        }
						echo "</table>";
						                                  }
                        else{echo"<font color=red>Sorry! Can not find registered student for $stream_8_22 Stream";}
						}
echo "<hr class=bar>";
echo"Course Unit Registrations Summery";
echo "<hr class=bar>";

$quecurr="select acedemic_year from acc_year where current=1";
$qucurr=mysql_query($quecurr);
$qcurr=mysql_fetch_array($qucurr);
$curr=$qcurr['acedemic_year'];

$quecurrsem="select semister from call_registration";
$qucurrsem=mysql_query($quecurrsem);
$qcurrsem=mysql_fetch_array($qucurrsem);
$crrsem=$qcurrsem['semister'];



$quegtaccyear="select acedemic_year from acc_year";
$qugtaccyear=mysql_query($quegtaccyear);
echo"<form method=POST action='./index.php?view=admin&admin=8&task=crssumr'>";
echo"Academic Year  : ";
echo"<select name=coursesum>";


while($qgtaccyear=mysql_fetch_array($qugtaccyear)){
	$gtaccyear=$qgtaccyear['acedemic_year'];
if($gtaccyear==$curr){
echo"<option value='$gtaccyear' selected>$gtaccyear</option>";
			}
else{
echo"<option value='$gtaccyear'>$gtaccyear</option>";

	}
}
echo"</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo"Semester : ";
echo"<select name=semester>";
if($crrsem==1){
echo"<option value=1 selected>One</option>";
echo"<option value=2>Two</option>";
		}

else{
echo"<option value=1>One</option>";
echo"<option value=2 selected>Two</option>";
}


echo"</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

echo"<input type=submit value=Submit></form>";
//echo "<hr class=bar>";


if($task=="crssumr"){
$rqacc=$_POST['coursesum'];
$rqsem=$_POST['semester'];

echo"Couse Unit Registration Details Of<font color=red> $rqacc </font>Academic Year and Semester<font color=red> $rqsem </font><br>";
echo"<table border='0' ><tr>";
echo"<th>Course Unit <th> Course Name <th>Department<th> No of Registered Student </tr>";

$quecur="select distinct r.course, c.name,c.department from registration r, courseunit c where r.acedemic_year='$rqacc' and (r.semister=$rqsem or r.semister=3)and r.confirm=1 and r.course=c.code order by c.department,c.code";
$qucur=mysql_query($quecur);
while($qcur=mysql_fetch_array($qucur)){
	$cur=$qcur['course'];
	$cname=$qcur['name'];
	$cdept2=$qcur['department'];
	$cdept=ucfirst($cdept2);




if(($nexdept!=$cdept)&&($nexdept!=null)){

echo"<tr class=selectbg><td colspan=2 align='left'>[ No of Course Unit offered by  <font color=red>Department of $nexdept </font>: <font color=blue>$cosum </font>]</td><td colspan=2 align='right'>";
//echo"[ Total no of Registered Student<font color=blue> : $regst </font>]";
echo"</td></tr>";
$cosum=0;
$regst=0;
			}
echo"<tr class=trbgc><td align='center' width='12%'>$cur</td><td width='38%'>&nbsp;&nbsp;&nbsp;&nbsp;$cname</td><td align='center' width='20%'>$cdept</td><td align='center' width='30%'>";


	$quegtcudt="select count(student) as total from registration where course='$cur' and acedemic_year='$rqacc' and (semister=$rqsem or semister=3) and confirm=1";
	$qugtcudt=mysql_query($quegtcudt);
	$qgtcudt=mysql_fetch_array($qugtcudt);
	$gtcudt=$qgtcudt['total'];

		echo$gtcudt."</td></tr>";
	$nexdept=$cdept;
	$cosum=$cosum+1;
	$regst=$gtcudt+$regst;



					}
echo"<tr class=selectbg><td colspan=2 align='left'>[ No of Course Unit offered by  <font color=red>Department of $nexdept </font>: <font color=blue>$cosum </font>]</td><td colspan=2 align='right'> ";
//echo"[ Total no of Registered Student<font color=blue> : $regst </font>]";
echo"</td></tr>";
echo"</table>";
		}//if












?>
