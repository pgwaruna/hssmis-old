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
if($qpers['id']=="46"){
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





<?php
//////////////edit by iranga ////////////////////////////////////////////////////
require_once('./classes/globalClass.php');
$vr46=new settings();
/////////////////////////////////////////////////////////////////////////////////



echo"<div align='center'>";
echo"Student Information Center";
echo"<hr class=bar>";
echo"[ Student Information ]<br>";

include './forms/form_46.php';

echo"<hr class=bar>";
echo"[ View Group of Students Information ]";

include './forms/form_46_2.php';
echo"<hr class=bar>";




/*
echo"[ View Special Degree Students Information ]";

include './forms/form_46_3.php';
echo"<hr class=bar>";


if($task=='spviewsum'){

$getsrcvar2=$_POST['stream_3'];
$splevel_32=$_POST['level_3'];

if(($getsrcvar2!=null)&&($splevel_32!=null)){
$_SESSION['tsrcvar']=$getsrcvar2;
$_SESSION['splevel']=$splevel_32;
}

$getsrcvar=$_SESSION['tsrcvar'];
$splevel_3=$_SESSION['splevel'];

if($splevel_3==0){
	$levl="Recently Passout Batch";
		}
else{
$levl="Level ".$splevel_3;
}


$getstem=explode("/",$getsrcvar);

$spstream_3=$getstem[0];
$spdept=$getstem[1];



$fmviweque="$rmsdb.fohssmisStudents fs";  
//echo$spstream_3.$splevel_3.$spdept;
echo "<font size=3px><b><center>  Student List of ".ucfirst($spdept)." Special Degree $levl </center></b></font>";


$spquery8_3="select s.id, s.l_name, s.batch, s.initials from student s, sp_student_levels l, $fmviweque where l.level='$splevel_3' and l.department='$spdept' and l.reg_year=s.year and s.stream='$spstream_3' and concat('sc',s.id)=fs.user_name order by s.id";
//echo$spquery8_3;

$std_detailssp=mysql_query($spquery8_3);

echo '<table border="0"  align="center"><tr><th>No<th>Index No<th>Name with Initials<th>View Details</tr>';


if(mysql_num_rows($std_detailssp)!=0){
						$i=0;
						while($data=mysql_fetch_array($std_detailssp)){
							$i=$i+1;
						echo"<tr class=trbgc>";
						echo"<form method='POST' action='./forms/mentor.php?task=viewinf&bkbtn=spviewsum'>";
							$sid=$data['id'];
							$syr=$data['batch'];

						echo "<td align='center'>$i<td>SC/".$data['batch']."/".$data['id']."<input type='hidden' name='index_8_5' value='$sid'><input type='hidden' name='year_8_5' value='$syr'><td>".$data['l_name']." ".$data['initials']."<td align='center'><input type='submit' value='View'></form></tr>";
						}
						echo "</table>";
						}
											
						else{
						echo"<tr class=trbgc><td colspan='4' align='center'>Sorry! No Student Found</td></tr></table>";
							}







}

*/






if($task=='viewsum'){
						$stream_8_22=$_POST['stream_8_2'];
						$level_8_22=$_POST['level_8_2'];
						$degree_8_2=$_POST['degree_8_2'];


						if(($stream_8_22!=null)&&($level_8_22!=null)){
						$_SESSION['genstream']=$stream_8_22;
						$_SESSION['genlevel']=$level_8_22;
						$_SESSION['gendegre']=$degree_8_2;
						
												}

							$stream_8_2=$_SESSION['genstream'];
							$level_8_2=$_SESSION['genlevel'];
							$degree_8_2=$_SESSION['gendegre'];
							 if($degree_8_2=="All"){
								 $degrevar="(s.stream='General' or s.stream='Special')";
							 }
							 else{
								  $degrevar="s.stream='$degree_8_2'";
							 }							
							
							
							
							
							
						if($stream_8_2=="all"){
							$getmnsunm4pnt="All Student ";
						}
						else{
							$quesubvr="[".$stream_8_2."]";
							$getmnsunm4pnt=$vr46->getmainsubject($stream_8_2);		
						}
						if($level_8_2==0){
							$genlvl="Recently Passout";
								}
						else{
							$genlvl="Level ".$level_8_2."000";
							}


						 $fmviweque="$rmsdb.fohssmis fs";  
                         
						echo "<font size=3px><b><center>Student List of ".ucfirst($getmnsunm4pnt)." at $genlvl in $degree_8_2 Stream</center></b></font>";
	
						if($stream_8_2=="all"){
							$query8_3="select s.id, s.l_name, s.batch, s.initials, s.stream,s.combination,s.mentor_id, l.level from student s, level l, $fmviweque where l.level='$level_8_2' and l.year=s.year and s.id=fs.user and $degrevar order by s.id";
						}
						else{
							$query8_3="select s.id, s.l_name, s.batch, s.initials, s.stream,s.combination,s.mentor_id, l.level from student s, level l, $fmviweque where l.level='$level_8_2' and l.year=s.year and s.combination LIKE '%$quesubvr%'  and $degrevar and s.id=fs.user order by s.id";
						}
						//echo$query8_3;
						
						
						
						$std_details=mysql_query($query8_3);
						echo '<table border="0"  align="center" width=98%><tr><th>#<th>Photo<th  width=15%>Index No<th width=20%>Name with Initials<th>Stream<th>Medium<th  width=35%>Subject Combinations<th width=20%>Name of the Mentor<th>Details</tr>';
						if(mysql_num_rows($std_details)!=0){
						$i=0;
						while($data=mysql_fetch_array($std_details)){
							$i=$i+1;
						echo"<tr class=trbgc align='center'>";
						echo"<form method='POST' action='./forms/mentor.php?task=viewinf&bkbtn=viewsum'>";
							$sid=$data['id'];
							$syr=$data['batch'];
							$stm=$data['stream'];
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
						
							$stprmtnum=$vr46->getStudentNumber($sid); 
							
							if($stprmtnum==null){
								$lstdigts= substr("$sid",2);
								$pntstprmtnum="HS/$syr/$lstdigts<br><font color=red>( Temporary Deactivated ! )</font>";
							}
							else{
								$pntstprmtnum=$stprmtnum;
							}
							echo$pntstprmtnum;
						echo"<input type='hidden' name='year_8_5' value='$syr'><td align=left> &nbsp;".strtoupper($data['initials'])." ".strtoupper($data['l_name']);
						
						echo"<td>$stm Degree";
						echo"<td>";
							$stdgmedim=$vr46->getmedium($sid);
							echo$stdgmedim;
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
							

							
								$subone=$vr46->getmainsubject($puresubid1);

							
								$subtwo=$vr46->getmainsubject($puresubid2);

							
								$subthree=$vr46->getmainsubject($puresubid3);

							echo"<b>$subone";
								if($subtwo!=null){
									echo" + $subtwo";
								}
								if($subthree!=null){
									echo" + $subthree";
								}
							echo"</b>";
							
						////////////////////////////////////////////////////////////////							
						
						
						echo"<td align='center'>";
						$gtmentor_id=$data['mentor_id'];
						
						$nameofmntr=$vr46->getmenorsname($gtmentor_id);
						 echo "<b>".strtoupper($nameofmntr)."</b>";
						
						
						echo"<td align='center'><input type='submit' value='Show'></form></tr>";
						}
						echo "</table>";
						}
											
						else{
						echo"<tr class=trbgc><td colspan='9' align='center'>Sorry! No Student Found</td></tr></table>";
							}



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

