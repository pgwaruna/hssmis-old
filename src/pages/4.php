<?php
//error_reporting(0);
session_start();
if(($_SESSION['login'])=="truefohssmis"){


$role=$_SESSION['role'];
$pem="FALSE";
$querole="select role_id from $rmsdb.role where role='$role'";
//echo $querole;
$qurole=mysql_query($querole) ;

if($qurole!=NULL)
{
while($qrole=mysql_fetch_array($qurole)){
$roleid=$qrole['role_id'];
}
//echo$qpers['id'];
$quepers="SELECT id FROM permission WHERE role_id =$roleid";
//echo $quepers;
$qupers=mysql_query($quepers);

while($qpers=mysql_fetch_array($qupers)){
if($qpers['id']=="4"){
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
require_once('./classes/globalClass.php');
$vr4=new settings();

$crtacyr=$vr4->getAcc();
echo "Course Unit Registration Announcements<hr class=bar><br>";
					
						
						
						// Increase Current Session
					
						if(($task=="calsemreg")&&(isset($_POST['submit']))){
						$nmbr_4=$_POST['numbr'];	
						$lvl_4=$_POST['level'];
						$sem_4=$_POST['semester'];
						$ace_4=$crtacyr;
						$date_4=$_POST['enddate'];
						$reg_4=$_POST['rgstt'];
								//echo$lvl_4.$ace_4.$date_4.$reg_4;			
						if($lvl_4=="all"){
							$a=mysql_query('delete from call_registration');
							$quegetcrntsem="select distinct(level) from level where level<>0";
							$qugetcrntsem=mysql_query($quegetcrntsem);
							$insrw=1;
							while($qgetcrntsem=mysql_fetch_array($qugetcrntsem)){
									$getcrntsem=$qgetcrntsem['level'];
									//echo$getcrntsem;
									$queinsrec="insert into call_registration (level, semister, acedemic_year, closing_date, register) values('$getcrntsem','$sem_4','$ace_4','$date_4','$reg_4')";
									//echo$queinsrec;
									mysql_query($queinsrec);
									$insrw++;
							}
						}
						else{
									$b=mysql_query("update call_registration set level='$lvl_4',semister=$sem_4,acedemic_year='$ace_4',closing_date='$date_4',register='$reg_4' where level=$nmbr_4");
						}
						
						
						}
						
						
						// Display Available Session
								
								
				echo"<table border=0>";
					echo"<th>Level<th>Semester<th>Closing Date<th>Reg. Status<th>Submit</th>";
					echo"<form method=POST action=./index.php?view=admin&admin=4&task=calsemreg><tr class=trbgc><td align=center>All Levels<input type=hidden name=level value='all'>";
						echo"<td align=center>";
						echo"<select name=semester>";
							echo"<option value=1>Semester 1</option>";
							echo"<option value=2>Semester 2</option>";
						echo"</select>";
						echo"</td>";
	
						echo'<span id="date1">';
						echo"<td align=center><input type=text name=enddate required placeholder='YYYY-MM-DD'>";
							echo'<span class="textfieldRequiredMsg"><font size="-1"> Enter the Closing Date</font></span>';
							echo'<span class="textfieldInvalidFormatMsg"><font size="-1">Invalid format</font></span>';
						echo"</span>";
						
						
						
						
						echo"<td align=center><select name='rgstt'>";
											echo"<option value=1 selected>Start</option>";
											echo"<option value=0>Stop</option>";
											echo"</select>";

						echo"<td align=center><input type=submit name=submit value=Submit></tr></form>";
						
						
						$quegetcrntsem="select distinct(level) from level where level<>0";
						$qugetcrntsem=mysql_query($quegetcrntsem);
						$rw=1;
						while($qgetcrntsem=mysql_fetch_array($qugetcrntsem)){
									$getcrntsem=$qgetcrntsem['level'];
									if($getcrntsem==0){
										$getcrntsem2="Pass out";
									}
									else{
										$getcrntsem2=$getcrntsem;
									}
									
									echo"<form method=POST action=./index.php?view=admin&admin=4&task=calsemreg><tr class=trbgc><td align=center>Level - $getcrntsem2"."000<input type=hidden name=level value=$getcrntsem><input type=hidden name=numbr value=$getcrntsem>";
															echo"<td align=center>";			
																		echo"<select name=semester>";
																		echo"<option value=1>Semester 1</option>";
																		echo"<option value=2>Semester 2</option>";
															echo"</select>";
															echo"</td>";
															
															echo"<td align=center><input type=text name=enddate required placeholder='YYYY-MM-DD'>";
															echo"<td align=center><select name='rgstt'>";
																				echo"<option value=1 selected>Start</option>";
																				echo"<option value=0>Stop</option>";
																				echo"</select>";

															echo"<td align=center><input type=submit  name=submit value=Submit></tr></form>";
															$rw++;
																			}
						
						
						
						
						
						
						

				echo"</table><br><br>";
								
								
								
								
								
								
								
								
						$query4_2="select * from call_registration where level<>0";
						$reg_details=mysql_query($query4_2);
						echo '<table border="0" ><tr><th>Level<th>Semester<th>Acedemic Year<th>Closing Date<th>Reg. Status</tr>';
						if(mysql_num_rows($reg_details)==0){
							echo "<tr class=trbgc><td align=center colspan=5>Sorry! There are no data in this table.";
						}
						else{
						while($data=mysql_fetch_array($reg_details)){
							$getcrntsem22=$data['level'];
								if($getcrntsem22==0){
										$getcrntsem23="Pass out";
									}
									else{
										$getcrntsem23=$getcrntsem22."000";
									}
							
						echo "<tr class=trbgc><td align=center>".$getcrntsem23."<td align=center>".$data['semister']."<td align=center>".$data['acedemic_year']."<td align=center>".$data['closing_date'];
						echo"<td align=center>";
							if($data['register']==1){
								echo"Start";
							}
							else{
								echo"Stop";
							}
						echo "</tr>";
						}
						}
						echo "</table><br>";
echo"<hr class=bar>";
	


						?>


	

	
	
	


<?php
}
else{

echo "You Have Not Permission To Access This Area!";}


}   
else{

echo "You Have Not Permission To Access This Area!";}
?>



