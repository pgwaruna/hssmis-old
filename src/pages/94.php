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
if($qpers['id']=="94"){
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


<script type="text/javascript" src="./Ajax/confirm_cmb.js"></script>


<?php
//////////////edit by iranga ////////////////////////////////////////////////////
require_once('./classes/globalClass.php');
$vr94=new settings();

$currentacyear=$vr94->getAcc();

$currentsemester=$vr94->getSemister();
/////////////////////////////////////////////////////////////////////////////////




echo"<div align='center'>";
echo"Registration for the Special Streams";
echo"<hr class=bar>";
echo"[ Individual Student ]<br>";

include './forms/form_94.php';

echo"<hr class=bar>";
echo"[ Group of Student ]";

include './forms/form_94_2.php';
echo"<hr class=bar>";







if($task=='viewsum'){

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
							$getmnsunm4pnt=$vr94->getmainsubject($stream_8_2);		
						}
						if($level_8_2==0){
							$genlvl="Recently Passout";
								}
						else{
							$genlvl="Level ".$level_8_2."000";
							}


						 $fmviweque="$rmsdb.fohssmis fs";  


						if($duty=="one"){
							$onestnum=$_POST['index_8_5'];
							$onestbatch=$_POST['year_8_5'];
							
							$getonestbt=$vr94->getBatch($onestnum);
							if($getonestbt==$onestbatch){
								echo "<font size=3px><b><center>Registration of the HS/$onestbatch/$onestnum</center></b></font>";
								$query8_3="select s.id, s.l_name, s.batch, s.initials, s.stream,s.combination from student s, $fmviweque where s.id='hs$onestnum'  and s.id=fs.user order by s.id";
							}
							else{
								echo "<font size=2px color=red><b><center>Invalid Student Number ( HS/$onestbatch/$onestnum )</center></b></font>";
							}
							
						}
						else{
							echo "<font size=3px><b><center>Registration of the ".ucfirst($getmnsunm4pnt)." in $genlvl</center></b></font>";
							if($stream_8_2=="all"){
								$query8_3="select s.id, s.l_name, s.batch, s.initials, s.stream,s.combination, l.level from student s, level l, $fmviweque where l.level='$level_8_2' and l.year=s.year and s.id=fs.user order by s.id";
							}
							else{
								$query8_3="select s.id, s.l_name, s.batch, s.initials, s.stream,s.combination, l.level from student s, level l, $fmviweque where l.level='$level_8_2' and l.year=s.year and s.combination LIKE '%$quesubvr%' and s.id=fs.user order by s.id";
							}
						}
						//echo$query8_3;
						
			





			
						
						$std_details=mysql_query($query8_3);
						echo "<table border='1'  align='center' width=95% cellspacing=0 cellspadding=0><tr><th width=3%>#<th width=5%>Photo<th  width=10%>Index No<th width=16%>Name with Initials<th>Subject Combination<th>New Special Strerams<th  width=15%>Rigister / Restore</tr>";
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
						
							$stprmtnum=$vr94->getStudentNumber($sid); 
							
							if($stprmtnum==null){
								$lstdigts= substr("$sid",2);
								$pntstprmtnum="HS/$syr/$lstdigts<br><font color=red>( Temporary Deactivated ! )</font>";
							}
							else{
								$pntstprmtnum=$stprmtnum;
							}
							echo$pntstprmtnum;
						echo"<input type='hidden' name='year_8_5' value='$syr'><td align=left> &nbsp;".$data['l_name']." ".$data['initials'];
						
						
						////////////////////////////////////////////////////////////////
							$getstream4spreg=$data['stream'];
							if($getstream4spreg=="General"){
								$combi=$data['combination'];
							}
							else{
								//////////////9999999999999999999999999999999999///////////////
									$quegetpresbcmbi="select sub_combination from pre_sub_combination where st_num='$sid'";
									$qugetpresbcmbi=mysql_query($quegetpresbcmbi);
										$qgetpresbcmbi=mysql_fetch_array($qugetpresbcmbi);
												$combi=$qgetpresbcmbi['sub_combination'];
								//////////////9999999999999999999999999999999999///////////////
							}
							
							
							
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
							

							
								$subone=$vr94->getmainsubject($puresubid1);

							
								$subtwo=$vr94->getmainsubject($puresubid2);

							
								$subthree=$vr94->getmainsubject($puresubid3);
							if($getstream4spreg=="General"){
								echo"<td align=left valign=bottom>";
								echo"<ul><li>$subone<li>$subtwo<li>$subthree</ul>";
							}
							else{
								echo"<td align=left valign=middle>";
								$combisp=$data['combination'];
								$rmopbcktsp=explode("[",$combisp);
								$rmclbktsp=explode("]",$rmopbcktsp[1]);
								$puresubid1sp=$rmclbktsp[0];
								
								$subonesp=$vr94->getmainsubject($puresubid1sp);
								
								echo "<ul><li>$subonesp</ul>";
							}
						////////////////////////////////////////////////////////////////							
						
						/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						echo"<td>";

								
								echo "<div id='div$sid'> ";
								
								echo'<select name="spclstrm"  id="'.$sid.'spclstrm" style="width : 90%;"><option value=0 selected>Select Subject</option>';

									echo"<option value=$puresubid1>$subone</option>";
									echo"<option value=$puresubid2>$subtwo</option>";
									echo"<option value=$puresubid3>$subthree</option>";
									
									
								echo"</select>";
								
								echo"</div>";
							
						//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					
					
					
					
					
					
					echo"<td align='center'>";
					echo"<table width=95%><tr>";
						echo"<td><img style='visibility: hidden' id='ldr$sid' src='./images/ajax-loader.gif'>";
						echo"<td><img id='img$sid' src='./images/sbm.png' onclick=spclsubrg('$sid') title='Register'>";
						
							echo"<td><img width=35px style='visibility: hidden' id='sho$sid' src='./images/excu.png' onclick=spclsubrgundo('$sid') title='Restore to General Combination'>";

					echo"</table>";
					
					echo"</tr>";
						}
						echo "</table>";
						}
											
						else{
						echo"<tr class=trbgc><td colspan='7' align='center'>Sorry! No Student Found</td></tr></table>";
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

